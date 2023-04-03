<?php
include '../Logic/sqlconn.php';
include './Navbar.php';

$conn = connect();

    $result = sqlsrv_query($conn, 
        "select W.*, P.Name from WORKS_ON AS W, Project AS P where W.Project_ID = P.ID AND W.Employee_ID = ".$_SESSION['obj']['ID']
    );

    $tID = $progress = $hours = $end = '';
    $tIDErr = $progressErr = $hoursErr = $endErr = '';

    if (isset($_POST['submit'])) {
        if (empty($_POST['tID'])) {
            $tIDErr = 'Please enter task ID';
        }
        else if (!is_numeric($_POST['tID'])){
            $tIDErr = 'ID needs to be a number';
        }  
        else {
            $tID = filter_input(
                INPUT_POST,
                'tID',
                FILTER_SANITIZE_NUMBER_INT
            );
        }
        if (!is_numeric($_POST['progress']) && !empty($_POST['progress'])){
            $progressErr = 'Progress needs to be a number';
        }  
        else {
            $progress = filter_input(
                INPUT_POST,
                'progress',
                FILTER_SANITIZE_NUMBER_INT
            );
        }
        if (!is_numeric($_POST['hours']) && !empty($_POST['hours'])){
            $hoursErr = 'Total hours needs to be a number';
        }  
        else {
            $hours = filter_input(
                INPUT_POST,
                'hours',
                FILTER_SANITIZE_NUMBER_INT
            );
        }
        if ((!is_numeric(substr($_POST['end'], 0, 4)) || substr($_POST['end'], 4, 1) != '-' ||
        !is_numeric(substr($_POST['end'], 5, 2)) || substr($_POST['end'], 7, 1) != '-' ||
        !is_numeric(substr($_POST['end'], 8, 2))) && !empty($_POST['end'])) {
            $endErr = 'End date needs to be in YYYY-MM-DD';
        }
        else if ((!checkdate((int)substr($_POST['end'], 5, 7), (int)substr($_POST['end'], 8, 10), 
        (int)substr($_POST['end'], 0, 4))) && !empty($_POST['end'])){
            $endErr = 'End date needs to be a real date';
        }
        else {
            $end = filter_input(
                INPUT_POST,
                'end',
                FILTER_SANITIZE_NUMBER_INT
            );
        }
        if ($tIDErr == '' && $progressErr == '' && $hoursErr == '' && $endErr == ''){
            if(select_query("select ID from WORKS_ON where 
                ID = ".$tID, $conn)['ID'] == null){
                $tIDErr = 'Not a valid ID';
            }
            else{
                if ($progress != '' && $progressErr == ''){
                    sqlsrv_query($conn, 
                        "update WORKS_ON set Progress = ".$progress." 
                        where ID = ".$tID
                    );
                }
                if ($hours != '' && $hoursErr == ''){
                    sqlsrv_query($conn, 
                        "update WORKS_ON set Total_Hours = ".$hours." 
                        where ID = ".$tID
                    );
                }
                if ($end != '' && $endErr == ''){
                    sqlsrv_query($conn, 
                        "update WORKS_ON set End_Date = '".$end."'
                        where ID = ".$tID
                    );
                }
            }
            header('Location: ./view_Tasks.php');
        }
    }
?>

<html>
    <style>
        table {
          width: 75%;
        }
        td {
          border: 1px solid rgb(0, 0, 0);
          text-align: center;
        }
        h5{
            font-size: 15px;
            margin: 0;
        }
        p{
            font-size: 12px;
            margin: 0;
        }
        button{
            background-color: lightgray;
            width: 100%;
            height: 100%;
            padding: 5px;
        }
        .overdue{
            background-color: rgb(255, 50, 50, 0.25);
        }
        .complete{
            background-color: rgb(50, 255, 50, 0.25);
        }
        .taskName{
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
    </style>
    <center>
    <h1>Tasks Assigned to You</h1>
        <h2>Edit Tasks</h2>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
        method="POST" class="mt-4 w-75">
            <div class="mb-3">
                <label for="tID" style="margin-bottom: 10px"
                class="form-label">Task ID:</label>
                <input type="text" class="form-control 
                    <?php echo $tIDErr ? 'is-invalid' : null ?>
                    " id="tID" name="tID" placeholder="Enter Task ID">
                <div class="invalid-feedback" style="color: rgb(255, 0, 0)">
                    <?php echo $tIDErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="progress" style="margin-bottom: 10px"
                class="form-label">Add Progress:</label>
                <input type="text" class="form-control 
                    <?php echo $progressErr ? 'is-invalid' : null ?>
                    " id="progress" name="progress" placeholder="Enter Progress">
                <div class="invalid-feedback" style="color: rgb(255, 0, 0)">
                    <?php echo $progressErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="hours" style="margin-bottom: 10px"
                class="form-label">Add Hours:</label>
                <input type="text" class="form-control 
                    <?php echo $hoursErr ? 'is-invalid' : null ?>
                    " id="hours" name="hours" placeholder="Enter Total Hours">
                <div class="invalid-feedback" style="color: rgb(255, 0, 0)">
                    <?php echo $hoursErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="end" style="margin-bottom: 10px"
                class="form-label">Set End Date:</label>
                <input type="text" class="form-control 
                    <?php echo $endErr ? 'is-invalid' : null ?>
                    " id="end" name="end" placeholder="YYYY-MM-DD">
                <div class="invalid-feedback" style="color: rgb(255, 0, 0)">
                    <?php echo $endErr; ?>
                </div>
            </div>
            <p></p>
            <input type="submit" name="submit" value="Submit" class="btn btn-dark w-100" style="width: auto">
        </form>
        <h2>Pending Tasks (<?php echo select_query("select count(*) as Tasks from 
        WORKS_ON where Employee_ID = ".$_SESSION['obj']['ID'], $conn)['Tasks'] ?>)</h2>
        <table>
            <tr>
                <td>Task</td>
                <td>ID</td>
                <td>For Project</td>
                <td>Due Date</td>
                <td>Progress</td>
                <td>Status</td>
            </tr>
            <?php
                while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                    if($row['End_Date'] == null && $row['Deadline']->format('Y-m-d') > date('Y-m-d')){
                        $display = 'Incomplete';
                        $style = 'button';
                    }
                    else if($row['End_Date'] == null && $row['Deadline']->format('Y-m-d') < date('Y-m-d')){
                        $display = 'Overdue';
                        $style = 'overdue';
                    }
                    else{
                        $display = 'Complete';
                        $style = 'complete';
                    }

                    echo
                    "<tr>
                        <td class = 'taskName'>
                            <h5>$row[Job_Title]</h5>
                            <p>$row[Description]</p>
                        </td>
                        <td>$row[ID]</td>
                        <td>$row[Name]</td>
                        <td>".$row['Deadline']->format('m-d-Y')."</td>
                        <td>$row[Progress]</td>
                        <td class=$style>$display</td>
                    </tr>";
                }

                sqlsrv_close($conn);
            ?>
        </table>
    </center>
</html>