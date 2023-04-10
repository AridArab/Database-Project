<?php 
    error_reporting(E_ERROR | E_PARSE);
    include "./Navbar.php";
    include "../Logic/sqlconn.php";

    if (isset($_GET["id"])) {
      $id = $_GET["id"];
    } 
    else {
      header('Location: ./home.php');
      exit();
    }

    $conn = connect();

    $result = sqlsrv_query($conn, 
        "select W.*, P.Name from WORKS_ON AS W, Project AS P where W.Project_ID = P.ID AND W.Employee_ID = ".$id
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

    $employee = select_query("select * from Employee where ID = ".$id, $conn)[0];

    sqlsrv_close($conn);
?>

<html>
    <script type="text/javascript">
        function showHide(idName){
            var temp = document.getElementById(idName);
            if(temp.style.display === "none")
                temp.style.display = "block";
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
          background-color: rgb(225, 225, 225,0.75);
        }
        label {
            display: inline-block;
            width: 125px;
            text-align: right;
        }
        input {
            width: 140px;
        }
    </style>
    <center>
    <h1>Tasks assigned to <?php echo $employee['First_Name']." ".
            $employee['Middle_Initial']." ".$employee['Last_Name']?></h1>
        <?php $_SESSION['taskE'] = $employee; ?>
        <div style='margin:20px;'>
            <a href='./give_Task.php'>Assign Task</a>
        </div>
        <h2>Incomplete Tasks (<?php echo (count($overdueTasks) + count($incompleteTasks));?>)</h2>
        <table>
            <tr>
                <td style = "width: 150px;">Task</td>
                <td>ID</td>
                <td>Project</td>
                <td>Date Assigned</td>
                <td>Deadline</td>
                <td>Progress</td>
                <td>Hours Spent</td>
            </tr>
            <?php
                while($task=array_pop($overdueTasks)){
                    echo
                    "<tr class='overdue'>
                        <td class = 'taskName'>
                            <h5>$task[Job_Title]</h5>
                            <p>$task[Description]</p>
                        </td>
                        <td>$task[ID]</td>
                        <td>$task[Name]</td>
                        <td>".$task['Start_Date']->format('m-d-Y')."</td>
                        <td>".$task['Deadline']->format('m-d-Y')."</td>
                        <td>$task[Progress]</td>
                        <td>$task[Total_Hours]</td>
                    </tr>";
                }
                while($task=array_pop($incompleteTasks)){
                    echo
                    "<tr>
                        <td class = 'taskName'>
                            <h5>$task[Job_Title]</h5>
                            <p>$task[Description]</p>
                        </td>
                        <td>$task[ID]</td>
                        <td>$task[Name]</td>
                        <td>".$task['Start_Date']->format('m-d-Y')."</td>
                        <td>".$task['Deadline']->format('m-d-Y')."</td>
                        <td>$task[Progress]</td>
                        <td>$task[Total_Hours]</td>
                    </tr>";
                }
            ?>
        </table>
        <div>
            <button id = "see" onClick="showHide('complete'); showHide('see'); showHide('hide')" class="showButton">See Completed Tasks</button>
            <button id = "hide" onClick="showHide('complete'); showHide('see'); showHide('hide')" style="display:none" class="showButton">Hide Completed Tasks</button>
            <div id = 'complete' style="display:none">
                <h2>Completed Tasks (<?php echo (count($completedTasks)); ?>)</h2>
                <table>
                    <tr>
                        <td style = "width: 150px;">Task</td>
                        <td>ID</td>
                        <td>Project</td>
                        <td>Date Assigned</td>
                        <td>Deadline</td>
                        <td>Progress</td>
                        <td>Hours Spent</td>
                    </tr>
                    <?php
                        while($task = array_pop($completedTasks)){
                            echo
                            "<tr class='complete'>
                                <td class = 'taskName'>
                                    <h5>$task[Job_Title]</h5>
                                    <p>$task[Description]</p>
                                </td>
                                <td>$task[ID]</td>
                                <td>$task[Name]</td>
                                <td>".$task['Start_Date']->format('m-d-Y')."</td>
                                <td>".$task['Deadline']->format('m-d-Y')."</td>
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