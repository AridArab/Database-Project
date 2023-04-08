<?php 
    include './Navbar.php';
    include '../Logic/sqlconn.php';

    $conn = connect();

    $hide = 'yes';
?>

<html>
<header>
    <style>
    </style>
</header>

<body>
    <center>
        <h1>Edit Your Salary</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
        method="POST" class="mt-4 w-75">
            <button id="theButton" onclick="$hide = 'no'">Click me!</button>
            <?php 
                if($hide == 'no'){
                    echo '<input type="text" name="popup" id="popup" display="block">';
                }
            ?>
        </form>
    </center>
</body>

</html>