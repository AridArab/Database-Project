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
    <?php include './Navbar.php' ?>
    <center>
        <h1>
            <?php
            if (isset($_SESSION['id'])) {
                echo "Hello " . $_SESSION['name'] . "!";
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