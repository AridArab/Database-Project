<?php
error_reporting(E_ERROR | E_PARSE);
include './Logic/sqlconn.php';

$unauth = false;
$id = $pass = '';
$idErr = $passErr = '';

if (isset($_POST['submit'])) {
    if (empty($_POST['id'])) {
        $idErr = 'ID is required';
    } 
    else if (!is_numeric($_POST['id'])){
        $idErr = 'ID needs to be a number';
    }
    else {
        $id = filter_input(
            INPUT_POST,
            'id',
            FILTER_SANITIZE_NUMBER_INT
        );
    }
    if (empty($_POST['pass'])) {
        $passErr = 'Password is required';
    } 
    else {
        $pass = $_POST['pass'];
    }
    if ($idErr == '' && $passErr == '') {
        $conn = connect();

        $obj = select_query("select * from employee where ID = $id", $conn);

        if (password_verify($_POST['pass'], $obj['Password'])) { //Credential check logic
            session_start(); //Starts session
            $_SESSION['obj'] = $obj;
            header('Location: ./Pages/home.php');
        } 
        else {

            $unauth = true;
        }
        sqlsrv_close($conn);
    }
}
?>

<!DOCTYPE html>
<html>
<header>
    <link rel="stylesheet" href="./index.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <style>
        div {
            margin-bottom: 10px;
        }

        label {
            display: inline-block;
            width: 75px;
            text-align: right;
        }
    </style>
</header>

<body>
    <center>
        <h1>Welcome to the Project Managment website!</h1>
        <h2>Login</h2>
        <p>Please Enter Login information</p>
        <form action="
        <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>
        " method="POST" class="mt-4 w-75">
            <p style="color: rgb(255, 0, 0)">
            <?php if ($unauth) {
                echo "Invalid Login";
            } ?>
            </p>
            <p></p>
            <div class="mb-3">
                <label for="id" class="form-label">ID:</label>
                <input type="text" class="form-control 
            <?php echo $idErr ? 'is-invalid' : null ?>
            " id="id" name="id" placeholder="Enter your ID">
                <div class="invalid-feedback" style="color: rgb(255, 0, 0)">
                    <?php echo $idErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password:</label>
                <input type="text" class="form-control 
            <?php echo $passErr ? 'is-invalid' : null ?>
            " id="pass" name="pass" placeholder="Enter your Password">
                <div class="invalid-feedback" style="color: rgb(255, 0, 0)">
                    <?php echo $passErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
            </div>
        </form>
        <p>No account? <a href="./pages/signup.php">Sign Up!</a></p>
    </center>
</body>

</html>