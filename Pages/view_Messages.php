<?php 
    error_reporting(E_ERROR | E_PARSE);
    include './navbar.php';
    include '../Logic/sqlconn.php';

    $conn = connect();

    $user = $_SESSION['obj']['ID'];

    $result = sqlsrv_query($conn,
        "SELECT * FROM Message WHERE RecipientID = $user and isActive = 1");
    
    $employees = sqlsrv_query($conn,
        "SELECT * FROM Employee");
    

    if (isset($_POST['deleteMessage']) and is_numeric($_POST['deleteMessage'])) {
        $ID = array($_POST['deleteMessage']);
        $sql = "UPDATE Message SET isActive = 0 WHERE MessageID = ?";
        $stmt = sqlsrv_query($conn, $sql, $ID);
        if( $stmt === false ) {
            die( print_r( sqlsrv_errors(), true ) );
        }
        else {
            header("Refresh:0");
        }
    }


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
        <form action="" method="POST">
        <p><?php
        while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            $date = $row['Date_Sent']->format('Y-m-d');
            echo
            "<div class='message'>
            $row[Message]<br>
            Date Recieved: $date
            <button type=submit name=deleteMessage value=$row[MessageID]>Delete</button>
            </div>";
        }
        ?></p>
        </form>
    </center>
</body>

</html>