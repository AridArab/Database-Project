<?php 
    error_reporting(E_ERROR | E_PARSE);
    include '../Logic/sqlconn.php';
    include "./Navbar.php";
    
    $pID = $job = $desc = $deadline = '';
    $pIDErr = $jobErr = $descErr = $deadlineErr = '';

    $conn = connect();

if (isset($_POST['submit'])) {
    //Checks post
    if (empty($_POST['pID'])) {
        $pIDErr = 'Project ID is required';
    }
    else if (!is_numeric($_POST['pID'])){
        $pIDErr = 'Project ID needs to be a number';
    }  
    else {
        $pID = filter_input(
            INPUT_POST,
            'pID',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }
    if (empty($_POST['job'])) {
        $jobErr = 'Job title is required';
    }
    else if (strlen($_POST['job']) > 50){
        $jobErr = 'Job title is too long';
    } 
    else {
        $job = filter_input(
            INPUT_POST,
            'job',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
        $job = strtoupper($job);
    }
    if (empty($_POST['desc'])) {
        $desc = "null";
    }
    else if (strlen($_POST['desc']) > 255){
        $descErr = 'Description is too long';
    } 
    else {
        $desc = filter_input(
            INPUT_POST,
            'desc',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
        $desc = "'".($desc)."'";
    }
    if (empty($_POST['deadline'])) {
        $deadlineErr = 'Deadline is required';
    }
    else if (!is_numeric(substr($_POST['deadline'], 0, 4)) || substr($_POST['deadline'], 4, 1) != '-' ||
    !is_numeric(substr($_POST['deadline'], 5, 2)) || substr($_POST['deadline'], 7, 1) != '-' ||
    !is_numeric(substr($_POST['deadline'], 8, 2))) {
        $deadlineErr = 'Deadline needs to be in YYYY-MM-DD';
    }
    else if (!checkdate((int)substr($_POST['deadline'], 5, 7), (int)substr($_POST['deadline'], 8, 10), 
    (int)substr($_POST['deadline'], 0, 4))){
        $deadlineErr = 'Deadline needs to be a real date';
    }
    else {
        $deadline = filter_input(
            INPUT_POST,
            'deadline',
            FILTER_SANITIZE_NUMBER_INT
        );
    }
    if ($pIDErr == '' && $jobErr == '' && $descErr == '' && $deadlineErr == '') {
        if(select_query("select * from Project where ID = $pID", $conn)[0]['ID'] == null){
            $pIDErr = 'Not a valid project';
        }
        else{
            //Code to query adding tasks to an employee
            $sql = "INSERT INTO WORKS_ON (Job_Title, Start_Date, End_Date, Total_Hours, Employee_ID, Project_ID, Description, Progress, Deadline) VALUES (?,?,?,?,?,?,?,?,?)";

            $curr_Date = date("Y/m/d");
            $params = array($job, $curr_Date, null, 0, $_SESSION['taskE']['ID'], $pID, $desc, 0, $deadline);

            $stmt = sqlsrv_query($conn, $sql, $params);
            if( $stmt === false ) {
                die( print_r( sqlsrv_errors(), true));
            }
            sqlsrv_close($conn);
            echo '<script type="text/javascript">';
            echo "window.location.href='./view_Tasks_M.php?id=".$_SESSION["taskE"]["ID"]."'";
            echo '</script>';
        }
    }
}
    
?>

<html>
    <header >
        <style>
            div {
                margin-bottom: 10px;
            }

            label {
                display: inline-block;
                width: 125px;
                text-align: right;
            }

            input {
                width: 140px;
            }
        
            .vgt {
                display: grid;
                width: 300px;
                padding: 10px;
                        
                background-color: rgba(225, 225, 225, 0.75);
                border-color:rgb(0, 0, 0);
                border-style: solid;
                border-radius: 10px;
            }
        </style>
    </header>
    <center>
    <h1>
        Give Task to <?php echo $_SESSION['taskE']['First_Name']." ".
        $_SESSION['taskE']['Middle_Initial']." ".$_SESSION['taskE']['Last_Name']?>
    </h1>
    <div class="vgt">
    <form action="
        <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>
        " method="POST" class="mt-4 w-75" style="position:relative; left: -5%">
            <div class="mb-3">
                <label for="pID" class="form-label">Project ID:</label>
                <input type="text" class="form-control 
            <?php echo $pIDErr ? 'is-invalid' : null ?>
            " id="pID" name="pID" placeholder="Enter Project ID">
                <div class="invalid-feedback" style="color: rgb(255, 0, 0)">
                    <?php echo $pIDErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="job" class="form-label">Job Title:</label>
                <input type="text" class="form-control 
            <?php echo $jobErr ? 'is-invalid' : null ?>
            " id="job" name="job" placeholder="Enter job title">
                <div class="invalid-feedback" style="color: rgb(255, 0, 0)">
                    <?php echo $jobErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="desc" class="form-label">Description:</label>
                <input type="text" class="form-control 
            <?php echo $descErr ? 'is-invalid' : null ?>
            " id="desc" name="desc" placeholder="Enter description">
                <div class="invalid-feedback" style="color: rgb(255, 0, 0)">
                    <?php echo $descErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="deadline" class="form-label">Deadline:</label>
                <input type="text" class="form-control 
            <?php echo $deadlineErr ? 'is-invalid' : null ?>
            " id="deadline" name="deadline" placeholder="YYYY-MM-DD">
                <div class="invalid-feedback" style="color: rgb(255, 0, 0)">
                    <?php echo $deadlineErr; ?>
                </div>
            </div>
            <div class="mb-3" style="position:relative; left: 5%">
                <input type="submit" name="submit" value="Submit" class="btn btn-dark w-100" style="width: auto">
            </div>
        </form>
        </div>
    </center>
</html>