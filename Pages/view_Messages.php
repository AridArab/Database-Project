<?php 
    error_reporting(E_ERROR | E_PARSE);
    include './Navbar.php';
    include '../Logic/sqlconn.php';

    $conn = connect();

    $user = $_SESSION['obj']['ID'];

    $result = sqlsrv_query($conn,
        "SELECT * FROM Message WHERE RecipientID = $user");
    
    $employees = sqlsrv_query($conn,
        "SELECT * FROM Employee");

?>

<html>
<header>
    <style>
        .message {
            border: 1px solid rgb(0, 0, 0);
            text-align: left;
            padding-left: 25px;
            padding-right: 25px;
            padding-top: 40px;
            padding-bottom: 40px;
            margin-top: 10px;
            margin-bottom: 10px;
            width: 65%;
            background-color: rgba(225, 225, 225, 0.75);
        }
    </style>
</header>
<body>
    
    <center>
        <h1>Messages</h1>
        <p><?php
        while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            $sentid = $row['SenderID'];
            $sender = select_query( 
            "SELECT * FROM Employee WHERE ID = ".$sentid, $conn)[0];
            echo
            "<div class='message'>
            $row[Message]<br>
            From: $sender[First_Name]
            </div>";
        }
        ?></p>
    </center>
</body>

</html>