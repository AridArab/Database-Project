<?php 
    error_reporting(E_ERROR | E_PARSE);
    include './navbar.php';
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
            border-radius: 25px;
        }
    </style>
</header>
<body>
    
    <center>
        <h1>Messages</h1>
        <p><?php
        while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            $date = $row['Date_Sent']->format('Y-m-d');
            echo
            "<div class='message'>
            $row[Message]<br>
            Date Recieved: $date
            </div>";
        }
        ?></p>
    </center>
</body>

</html>