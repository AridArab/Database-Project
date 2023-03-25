<?php
session_start();
?>
<!DOCTYPE html>
<html>
<header>
    <link rel="stylesheet" href="../index.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Manager</title>
</header>

<body>
    <ul>
        <li style="float:left"> <a href="./home.php">Home</a> </li>
        <?php
        if (isset($_SESSION['obj'])) { //Given a user has logged in we want to display 
            if($_SESSION['obj']['Is_Manager'] == 1){
                echo '<li style="float:left"> <a href="./view_Management.php">Manage</a> </li>';
            }
            echo '<li style="float:left"> <a href="./view_Projects.php">Projects</a> </li>';
            echo '<li> <a href="./view_Profile.php">See Profile</a> </li>';
            echo '<li> <a href="../Logic/logout.php">Logout</a> </li>';
        } 
        else {
            header('Location: ../');
            exit();
        }
        ?>
    </ul>
</body>

</html>