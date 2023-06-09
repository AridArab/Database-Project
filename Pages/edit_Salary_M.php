<?php 
    include './navbar.php';
    include '../Logic/sqlconn.php';

    $conn = connect();

    if ( 
        select_query("select * from Employee where ID = 
        ".$_SESSION['salaryE']['ID'], $conn)[0]['Department_ID'] != $_SESSION['obj']['Department_ID']
        ) {
        echo '<script type="text/javascript">';
        echo "window.location.href='./home.php'";
        echo '</script>';
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
                where ID = ".$_SESSION['salaryE']['ID']
            );
            
            echo '<script type="text/javascript">';
            echo "window.location.href='./view_Profile_M.php?id=".$_SESSION['salaryE']['ID']."'";
            echo '</script>';

            sqlsrv_close($conn);
        }
    }
?>

<html>
<header>
    <style>
        
        .vas {
            display: grid;
            width: 200px;
            padding: 10px;
                    
            background-color: rgba(225, 225, 225, 0.75);
            border-color:rgb(0, 0, 0);
            border-style: solid;
            border-radius: 10px;
        }
    </style>
</header>

<body>
    <center>
        <h1>
            Edit Salary for <?php echo $_SESSION['salaryE']['First_Name']." ".
            $_SESSION['salaryE']['Middle_Initial']." ".$_SESSION['salaryE']['Last_Name']?>
        </h1>
        <div class="vas">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
        method="POST" class="mt-4 w-75">
            <div class="mb-3">
                <input type="text" class="form-control 
                    <?php echo $salaryErr ? 'is-invalid' : null ?>
                    " id="editSalary" name="editSalary" style="width: 95px" 
                    placeholder="New Salary">
                <div class="invalid-feedback" style="color: rgb(255, 0, 0)">
                    <?php echo $salaryErr; ?>
                </div>
            </div>
            <p></p>
            <input type="submit" name="submit" value="Submit" class="btn btn-dark w-100">
        </form>
    </div>
    </center>
</body>

</html>