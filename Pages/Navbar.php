<?php
session_start();
?>
<!DOCTYPE html>
<html>
<header>
    <link rel="stylesheet" href="../index.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project Management</title>
</header>

<body>
    <center>
    <ul>
        <li style="float:left"> <a href="./home.php">Home</a> </li>
        <?php
        if (isset($_SESSION['obj'])) { //Given a user has logged in we want to display 
            if($_SESSION['obj']['Is_Manager'] == 1 || $_SESSION['obj']['Is_Manager'] == 2){
                echo '<li style="float:left"> <a href="./view_Management.php">Manage</a> </li>';
                echo '<li style="float:left"> <a href="./view_Logs.php">Logs</a> </li>';
                echo '<li style="float:left"> <a href="./edit_Project.php?id='.$_SESSION['obj']['ID'].'">Projects</a> </li>';
                if($_SESSION['obj']['Is_Manager'] == 2){
                    echo '<li style="float:left"> <a href="./view_Admin.php">Admin</a> </li>';
                }
            }
            else{
                echo '<li style="float:left"> <a href="./view_Tasks.php">Tasks</a> </li>';
            }
            echo '<li style="float:left"> <a href="./view_Reports.php">Reports</a> </li>';
            echo '<li style="float:left"> <a href="./view_Messages.php">Messages</a> </li>';
            echo '<li> <a href="./view_Profile.php">Profile</a> </li>';
            echo '<li> <a href="../Logic/logout.php">Logout</a> </li>';
            
        } 
        else {
            echo '<script type="text/javascript">';
            echo "window.location.href='../'";
            echo '</script>';
            exit();
        }
        ?>
    </ul>
    </center>

    <div class="container">
        <div class="rectangle" style="left: 0%; top: 0%">
        </div>
        <div class="rectangle" style="left: 90%; top: 0%; transform: scaleX(-1)">
        </div>
    </div>
</body>

</html>