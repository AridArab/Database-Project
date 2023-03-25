<?php 
    include './Navbar.php';
    include '../Logic/sqlconn.php';

    $conn = connect();

    if ($_SESSION['obj']['Is_Manager'] == 0 || 
    select_query("select Super_ID from Employee where ID = 
    ".$_SESSION['salaryID'], $conn)['Super_ID'] != $_SESSION['obj']['ID']) {
      header('Location: ./home.php');
      exit();
    }

    $salary = '';
    $salaryErr = '';

    if (isset($_POST['submit'])) {
        if (empty($_POST['editSalary'])) {
            $salaryErr = 'Please enter new salary';
        }
        else if (!is_numeric($_POST['editSalary'])){
            $salaryErr = 'Salary needs to be a number';
        }  
        else {
            $salary = filter_input(
                INPUT_POST,
                'editSalary',
                FILTER_SANITIZE_NUMBER_INT
            );
        }
        if ($salaryErr == ''){
            sqlsrv_query($conn, 
                "update Employee set Salary = ".$_POST['editSalary']." 
                where ID = ".$_SESSION['salaryID']
            );
            
            header("Location: ./view_Profile_M.php?id=".$_SESSION['salaryID']);

            sqlsrv_close($conn);
        }
    }
?>

<html>
<header>
    <style>
    </style>
</header>

<body>
    <center>
        <h1>Edit Salary</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
        method="POST" class="mt-4 w-75">
            <div class="mb-3">
                <input type="text" class="form-control 
                    <?php echo $salaryErr ? 'is-invalid' : null ?>
                    " id="editSalary" name="editSalary" style="width: 69px" 
                    placeholder="New Salary">
                <div class="invalid-feedback" style="color: rgb(255, 0, 0)">
                    <?php echo $salaryErr; ?>
                </div>
            </div>
            <p></p>
            <input type="submit" name="submit" value="Submit" class="btn btn-dark w-100">
        </form>
    </center>
</body>

</html>