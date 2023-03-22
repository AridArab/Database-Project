<?php
session_start();
$id = $_SESSION['ID'];
?>

<!DOCTYPE html>
<html>
<header>
    <link rel="stylesheet" href="./index.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Successful Signup Page</title>
</header>

<body>
    <center>
        <h1>Successful Signup!</h1>
        <h1>Your ID is
            <?php echo $id ?>
        </h1>
        <h1><a href="../"> Login!</a></h1>
    </center>
</body>

</html>