<?php
include '../Logic/sqlconn.php';
include './navbar.php';

$conn = connect();

    $result = sqlsrv_query($conn, 
        "select W.*, P.Name from WORKS_ON AS W, Project AS P where W.Project_ID = P.ID AND W.Employee_ID = ".$_SESSION['obj']['ID']
    );
    //Setting some globals
    $overdueTasks = array();
    $incompleteTasks = array();
    $completedTasks = array();

    while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
        if($row['End_Date'] == null && $row['Deadline']->format('Y-m-d') > date('Y-m-d')){
            array_push($incompleteTasks, $row);
        }
        else if($row['End_Date'] == null && $row['Deadline']->format('Y-m-d') < date('Y-m-d')){
            array_push($overdueTasks, $row);
        }
        else{
            array_push($completedTasks, $row);
        }
    }
    $col = array_column($overdueTasks, "Progress");
    array_multisort($col, SORT_ASC, $overdueTasks);
    $col = array_column($incompleteTasks, "Progress");
    array_multisort($col, SORT_ASC, $incompleteTasks);
    $col = array_column($completedTasks, "Progress");
    array_multisort($col, SORT_ASC, $completedTasks);

    $progress = $hours = $end = '';
?>

<html>
    <script type="text/javascript">
        function showHide(idName, dispType){
            var temp = document.getElementById(idName);
            
            if(temp.style.display === "none")
                temp.style.display = dispType;
            else
                temp.style.display = "none";
        }
    </script>
    <style>
        table {
          width: 75%;
        }
        td {
          border: 1px solid rgb(0, 0, 0);
          text-align: center;
        }
        h5{
            font-size: 16px;
            margin: 0;
        }
        p{
            font-size: 10px;
            margin: 0;
        }
        .showButton{
            margin-top: 20px;
            margin-bottom: 7px;
        }
        .overdue{
            background-color: rgb(255, 50, 50, 0.25);
        }
        .overdue:nth-child(even){
            background-color: rgb(200, 50, 50, 0.50);
        }
        .complete{
            background-color: rgb(50, 255, 50, 0.25);
        }
        .complete:nth-child(even){
            background-color: rgb(50, 200, 50, 0.50);
        }
        .taskName{
            width: 250px;
            display: grid;
            text-align: left;
        }
        tr:nth-child(even) {
          background-color: rgb(225, 225, 225);
        }
        label {
            display: inline-block;
            width: 125px;
            text-align: right;
        }
        input {
            width: 140px;
        }
        .interaction:hover {
            background-color:lightskyblue;
        }
        .vt {
            display: grid;
            width: 300px;
            padding: 10px;
                    
            background-color: rgba(225, 225, 225, 0.75);
            border-color:rgb(0, 0, 0);
            border-style: solid;
            border-radius: 10px;
        }
    </style>
    <center>
        <h2>Pending Tasks (<?php echo (count($overdueTasks) + count($incompleteTasks)); ?>)</h2>
        <form action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" method='POST' id = "edit">
        <table>
            <tr>
                <td style = "width: 250px;">Task</td>
                <td>For Project</td>
                <td>Assignment Date</td>
                <td>Due Date</td>
                <td>Progress</td>
                <td>Hours Logged</td>
                <td>Mark Progress</td>
            </tr>
            <?php
                while($task = array_pop($overdueTasks)){
                    $progressID = "progress_".$task['ID'];
                    $hoursID = "hours_".$task['ID'];
                    $progressInput = "progressInput_".$task['ID'];
                    $hoursInput = "hoursInput_".$task['ID'];
                    $type = "table-cell";

                    if (isset($_POST['submit'])) {
                        if(isset($_POST['prog_'.$task['ID']]) && is_numeric($_POST['prog_'.$task['ID']]) && (int)$_POST['prog_'.$task['ID']] >= 0){
                            $progress = filter_input(
                                INPUT_POST,
                                'prog_'.$task['ID'],
                                FILTER_SANITIZE_NUMBER_INT
                            );
                            if((int)$progress >= 100){
                                $end = date("Y/m/d");
                                sqlsrv_query($conn, 
                                    "update WORKS_ON set Progress = 100, End_Date = '".$end."'
                                    where ID = ".$task['ID']
                                );
                            }
                            else{
                                sqlsrv_query($conn, 
                                    "update WORKS_ON set Progress = ".$progress."
                                    where ID = ".$task['ID']
                                );
                            }
                        }

                        if(isset($_POST['hrs_'.$task['ID']]) && is_numeric($_POST['hrs_'.$task['ID']]) && (int)$_POST['hrs_'.$task['ID']] >= 0){
                            $hours = filter_input(
                                INPUT_POST,
                                'hrs_'.$task['ID'],
                                FILTER_SANITIZE_NUMBER_INT
                            );
                            sqlsrv_query($conn, 
                                "update WORKS_ON set Total_Hours = ".$hours."
                                where ID = ".$task['ID']
                            );
                        }
                        
                    }

                    echo
                    "<tr class='overdue'>
                        <td class = 'taskName'>
                            <h5>$task[Job_Title]</h5>
                            <p>$task[Description]</p>
                        </td>
                        <td>$task[Name]</td>
                        <td>".$task['Start_Date']->format('m-d-Y')."</td>
                        <td>!! ".$task['Deadline']->format('m-d-Y')." !!</td>

                        <td id = '$progressID'>$task[Progress]</td>
                        <td id = '$hoursID'>$task[Total_Hours]</td>

                        <td id = '$progressInput' style='display:none'>
                            <input type='text' id='prog_".$task['ID']."' name = 'prog_".$task['ID']."' style='text-align:center; width:45px;' placeholder='$task[Progress]'></input>
                        </td>
                        <td id = '$hoursInput' style='display:none'>
                            <input type='text' id='hrs_".$task['ID']."' name = 'hrs_".$task['ID']."' style='text-align:center; width:45px;' placeholder='$task[Total_Hours]'></input>
                        </td>

                        <td 
                            onClick=\"showHide('$progressID','$type'); 
                                      showHide('$progressInput','$type');
                                      showHide('$hoursID','$type');
                                      showHide('$hoursInput','$type');\" 
                                      class='interaction'
                        >
                            [ Edit ]
                        </td>
                    </tr>";
                }
                while($task = array_pop($incompleteTasks)){
                    $progressID = "progress_".$task['ID'];
                    $hoursID = "hours_".$task['ID'];
                    $progressInput = "progressInput_".$task['ID'];
                    $hoursInput = "hoursInput_".$task['ID'];
                    $type = "table-cell";

                    if (isset($_POST['submit'])) {
                        if(isset($_POST['prog_'.$task['ID']]) && is_numeric($_POST['prog_'.$task['ID']]) && (int)$_POST['prog_'.$task['ID']] >= 0){
                            $progress = filter_input(
                                INPUT_POST,
                                'prog_'.$task['ID'],
                                FILTER_SANITIZE_NUMBER_INT
                            );
                            if((int)$progress >= 100){
                                $end = date("Y/m/d");
                                sqlsrv_query($conn, 
                                    "update WORKS_ON set Progress = 100, End_Date = '".$end."'
                                    where ID = ".$task['ID']
                                );
                            }
                            else{
                                sqlsrv_query($conn, 
                                    "update WORKS_ON set Progress = ".$progress."
                                    where ID = ".$task['ID']
                                );
                            }
                        }

                        if(isset($_POST['hrs_'.$task['ID']]) && is_numeric($_POST['hrs_'.$task['ID']]) && (int)$_POST['hrs_'.$task['ID']] >= 0){
                            $hours = filter_input(
                                INPUT_POST,
                                'hrs_'.$task['ID'],
                                FILTER_SANITIZE_NUMBER_INT
                            );
                            sqlsrv_query($conn, 
                                "update WORKS_ON set Total_Hours = ".$hours."
                                where ID = ".$task['ID']
                            );
                        }
                    }

                    echo
                    "<tr>
                        <td class = 'taskName'>
                            <h5>$task[Job_Title]</h5>
                            <p>$task[Description]</p>
                        </td>
                        <td>$task[Name]</td>
                        <td>".$task['Start_Date']->format('m-d-Y')."</td>
                        <td>".$task['Deadline']->format('m-d-Y')."</td>

                        <td id = '$progressID'>$task[Progress]</td>
                        <td id = '$hoursID'>$task[Total_Hours]</td>

                        <td id = '$progressInput' style='display:none'>
                            <input type='text' id='prog_".$task['ID']."' name = 'prog_".$task['ID']."' style='text-align:center; width:45px;' placeholder='$task[Progress]'></input>
                        </td>
                        <td id = '$hoursInput' style='display:none'>
                            <input type='text' id='hrs_".$task['ID']."' name = 'hrs_".$task['ID']."' style='text-align:center; width:45px;' placeholder='$task[Total_Hours]'></input>
                        </td>
                        <td 
                            onClick=\"showHide('$progressID','$type'); 
                                      showHide('$progressInput','$type');
                                      showHide('$hoursID','$type');
                                      showHide('$hoursInput','$type');\" 
                                      class='interaction'
                        >
                            [ Edit ]
                        </td>
                    </tr>";
                }
            ?>
        </table>
        <input type='submit' name='submit' value='Commit Changes' class='btn btn-dark w-100' style='width: auto; margin-bottom: 50px;'></input>
        </form>

        <div>
            <button id = "see" onClick="showHide('complete', 'block'); showHide('see', 'block'); showHide('hide', 'block')" class="showButton">See Completed Tasks</button>
            <button id = "hide" onClick="showHide('complete', 'block'); showHide('see', 'block'); showHide('hide', 'block')" style="display:none" class="showButton">Hide Completed Tasks</button>
            <div id = 'complete' style="display:none">
                <h2>Completed Tasks (<?php echo (count($completedTasks)); ?>)</h2>
                <table>
                    <tr>
                        <td style = "width: 250px;">Task</td>
                        <td>For Project</td>
                        <td>Assignment Date</td>
                        <td>Due Date</td>
                        <td>Completed</td>
                        <td>Progress</td>
                        <td>Hours Logged</td>
                    </tr>
                    <?php
                        while($task = array_pop($completedTasks)){
                            echo
                            "<tr class='complete'>
                                <td class = 'taskName'>
                                    <h5>$task[Job_Title]</h5>
                                    <p>$task[Description]</p>
                                </td>
                                <td>$task[Name]</td>
                                <td>".$task['Start_Date']->format('m-d-Y')."</td>
                                <td>".$task['Deadline']->format('m-d-Y')."</td>
                                <td>".$task['End_Date']->format('m-d-Y')."</td>
                                <td>$task[Progress]</td>
                                <td>$task[Total_Hours]</td>
                            </tr>";
                        }
                    ?>
                </table>
            </div>
        </div>
    </center>
</html>

<?php sqlsrv_close($conn); ?>