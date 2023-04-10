<?php
    error_reporting(E_ERROR | E_PARSE);
    include './Navbar.php';
    include '../Logic/sqlconn.php';
    if($_SESSION['obj']['Is_Manager'] == 0){
        header('Location: ./home.php');
        exit();
    }

    $AssignDept = '';
    $AssignDeptErr = '';

    if (isset($_POST['submit'])) {
        if (empty($_POST['assignDept'])) {
            $AssignDeptErr = 'Please enter department ID';
        }
        else if (!is_numeric($_POST['assignDept'])){
            $AssignDeptErr = 'ID needs to be a number';
        }  
        else {
            $AssignDept = filter_input(
                INPUT_POST,
                'assignDept',
                FILTER_SANITIZE_NUMBER_INT
            );
        }
        if ($AssignDeptErr == ''){
            $conn = connect();

            $check = select_query("select * from Department where 
            ID = ".$_POST['assignDept'], $conn)[0];

            if($check['ID'] == null){
                $AssignDeptErr = 'Department does not exist';
            }
            else if($check['Manager_ID'] != null){
                $AssignDeptErr = 'Department already managed';
            }
            else{
                sqlsrv_query($conn, 
                    "update Department set Manager_ID = ".$_SESSION['obj']['ID']." 
                    where ID = ".$_POST['assignDept']
                );
                sqlsrv_query($conn, 
                    "update Employee set Department_ID = ".$_POST['assignDept']." 
                    where ID = ".$_SESSION['obj']['ID']
                );
                $_SESSION['obj']['Department_ID'] = (int)$_POST['assignDept'];
                
                header('Location: ./view_Management.php');
            }
            sqlsrv_close($conn);
        }
    }
?>

<html>

<body>
    <center>
        <h1>You are not currently managing a department!</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
        method="POST" class="mt-4 w-75">
            <div class="mb-3">
                <label for="assignDept" style="display: block; margin-bottom: 10px"
                class="form-label">Assign to a Department:</label>
                <input type="text" class="form-control 
                    <?php echo $AssignDeptErr ? 'is-invalid' : null ?>
                    " id="assignDept" name="assignDept" style="width: 125px" 
                    placeholder="Enter Department ID">
                <div class="invalid-feedback" style="color: rgb(255, 0, 0)">
                    <?php echo $AssignDeptErr; ?>
                </div>
            </div>
            <p></p>
            <input type="submit" name="submit" value="Submit" class="btn btn-dark w-100">
        </form>
    </center>
</body>

</html>