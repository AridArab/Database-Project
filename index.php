<?php
error_reporting(E_ERROR | E_PARSE);
include './Logic/sqlconn.php';

$unauth = false;
$id = $pass = '';
$idErr = $passErr = '';

if (isset($_POST['submit'])) {
    if (empty($_POST['id'])) {
        $idErr = 'ID is required';
    } else {
        $id = filter_input(
            INPUT_POST,
            'id',
            FILTER_SANITIZE_NUMBER_INT
        );
    }
    if (empty($_POST['pass'])) {
        $passErr = 'Password is required';
    } else {
        $pass = $_POST['pass'];
    }
    if ($idErr == '' && $passErr == '') {
        $conn = connect();

        $obj = select_query("select ID, Password, First_Name from employee where ID = $id", $conn);

        if ($obj['ID'] != null && $obj['Password'] == $pass) { //Credential check logic
            sqlsrv_close($conn);
            session_start(); //Starts session
            $_SESSION['loggedIn'] = true; //Sets loggedIn to true
            $_SESSION['name'] = $obj['First_Name'];
            header('Location: ./Pages/home.php');
        } else {
            sqlsrv_close($conn);
            $unauth = true;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<header>
    <link rel="stylesheet" href="./index.css">
    <link rel="stylesheet" href="./login.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
</header>

<body>
    <center>
        <h1>Welcome to the Project Managment website!</h1>
        <h2>Login</h2>
        <p>Please Enter Login information</p>
        <form action="
        <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>
        " method="POST" class="mt-4 w-75">
            <?php if ($unauth) {
                echo "Invalid Login";
            } ?>
            <p></p>
            <div class="mb-3">
                <label for="id" class="form-label">ID:</label>
                <input type="text" class="form-control 
            <?php echo $idErr ? 'is-invalid' : null ?>
            " id="id" name="id" placeholder="Enter your ID">
                <div class="invalid-feedback">
                    <?php echo $idErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password:</label>
                <input type="text" class="form-control 
            <?php echo $passErr ? 'is-invalid' : null ?>
            " id="pass" name="pass" placeholder="Enter your Password">
                <div class="invalid-feedback">
                    <?php echo $passErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
            </div>
        </form>
        <a href="./pages/signup.php">Sign Up</a>
    </center>
</body>

</html>