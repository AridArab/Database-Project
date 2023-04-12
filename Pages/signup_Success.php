<?php
session_start();
$id = $_SESSION['id'];
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
    <center style="transform: translate(0, -12px)">
        <h1 style="background-color:rgb(0, 0, 0); color: white; width: 80%;" >Successful Signup!</h1>
        <h1 style="background-color:rgb(0, 0, 0); color: yellow; position:absolute; top: 80%; left: 10%; width: 80%;" 
        >Your ID is
            <?php echo $id ?>
        </h1>
        <h1><a href="../" style="position:absolute; top: 250%; left: 47%"> Login!</a></h1>
    </center>

    <div class="container">
        <div class="rectangle" style="left: 0%; top: 0%">
        </div>
        <div class="rectangle" style="left: 90%; top: 0%; transform: scaleX(-1)">
        </div>
    </div>
</body>

</html>