<?php include './Navbar.php' ?>

<html>

<body>
    <center>
        <h1>
            <?php
            if (isset($_SESSION['obj'])) {
                echo "Hello " . $_SESSION['obj']['First_Name'] . "!";
            }
            ?>
        </h1>
    </center>

    <center>
        <h1>Welcome to the Project Managment website!</h1>
        <p>Please select one of the links on top</p>
        <img src="../Images/Team_image.jpg" alt="Example_Team" />
    </center>
</body>

</html>