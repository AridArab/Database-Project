<?php
    error_reporting(E_ERROR | E_PARSE);
    include './navbar.php';
    include '../Logic/sqlconn.php';

    if($_SESSION['obj']['Is_Manager'] != 2){
        echo '<script type="text/javascript">';
        echo "window.location.href='./home.php'";
        echo '</script>';
        exit();
    }
?>

<html>

<header>
    <style>

    </style>
</header>

<body>
    <center>
        <h1>Admin</h1>
    </center>
</body>

</html>