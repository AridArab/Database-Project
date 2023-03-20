<?php
session_start();
?>
<!DOCTYPE html>
<html>
<header>
    <link rel="stylesheet" href="./index.css">
    <meta charset="UTF-8">
    <meata http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Project Manager</title>
</header>

<body>
    <ul>
        <li style="float:left"> <a href="./">Home</a> </li>
        <?php
        if (isset($_SESSION['loggedIn'])) { //Given a user has logged in we want to display 
            echo '<li style="float:left"> <a href="./Pages/view_Team.php">Team</a> </li>';
            echo '<li style="float:left"> <a href="./Pages/view_Projects.php">Projects</a> </li>';
            echo '<li> <a href="./Pages/view_Profile.php">See Profile</a> </li>';
        }
        ?>
        <?php
        if (isset($_SESSION['loggedIn']) && $_SESSION['loggedIn']) {
            echo '<li> <a href="./Pages/logout.php">Logout</a> </li>';
        } else {
            echo '<li> <a href="./Pages/login.php">Login</a> </li>';
            echo '<li> <a href="./Pages/signup.php">Sign Up</a> </li>';
        }
        ?>
    </ul>

    <center>
        <h1>Welcome to the Project Managment website!</h1>
        <p>Please select one of the following links</p>
        <img src="./Images/Team_image.jpg" alt="Example_Team" />
    </center>
</body>

</html>