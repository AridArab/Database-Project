<?php include './Navbar.php' ?>

<html>

<body>
    <img style="position: absolute; height: 100%; width: 80%; left: 10%" src="../Images/Team_image.jpg" alt="Example_Team" />
    <center>
        <h1>
            <?php
            if (isset($_SESSION['obj'])) {
                echo "Hello " . $_SESSION['obj']['First_Name'] . ",";
            }
            ?>
        </h1>
    </center>

    <center style="transform: translate(0, -24px)">
        <h1>Welcome to the Project Managment Website!</h1>
        <p>Please select one of the links on top</p>
    </center>
</body>

</html>