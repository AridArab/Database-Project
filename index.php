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

        $obj = select_query("select * from Employee where ID = $id", $conn);

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
</header>

<body>
    <center>
        <h1>Welcome to the Project Managment website!</h1>
        <div class = "outerDiv">
            <h2 style="font-size: 25px; margin: 2%">Login</h2>
            <form action="
            <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>
            " method="POST" class="mt-4 w-75">
                <p style="color: rgb(255, 0, 0)">
                <?php if ($unauth) {
                    echo "Invalid Login";
                } ?>
                </p>
                <div class="mb-3">
                    <label for="id" class="form-label">User ID:</label>
                    <input type="text" class="form-control 
                <?php echo $idErr ? 'is-invalid' : null ?>
                " id="id" name="id" placeholder="Enter your User ID">
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
                <div style="margin-top: 2.5%;">
                    <input type="submit" name="submit" value="Submit" class="btn btn-dark w-100">
                </div>
            </form>
            <p>No account? <a href="./pages/signup.php">Sign Up Here!</a></p>
        </div>
    </center>
</body>

</html>