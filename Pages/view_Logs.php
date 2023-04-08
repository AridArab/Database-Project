<?php 
    error_reporting(E_ERROR | E_PARSE);
    include './Navbar.php';
    include '../Logic/sqlconn.php';

    if($_SESSION['obj']['Is_Manager'] == 0){
        header('Location: ./home.php');
        exit();
    }
    $conn = connect();

    $result = sqlsrv_query($conn, 
        "SELECT * FROM Logs WHERE isActive = 1"
    );


    if (isset($_POST['deleteItem']) and is_numeric($_POST['deleteItem'])) {
        $ID = array($_POST['deleteItem']);
        $sql = "UPDATE Logs SET isActive = 0 WHERE LogID = ?";
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
        table {
          width: 75%;
        }

        td {
          border: 1px solid rgb(0, 0, 0);
          text-align: left;
        }

        tr:nth-child(even) {
          background-color: rgb(225, 225, 225);
        }
    </style>
</header>

<body>
    <center>
        <h1>Logs</h1>
        <form action="" method="post">
            <table>
                <tr>
                    <td>ID</td>
                    <td>Name</td>
                    <td>Date</td>
                </tr>
                <?php
                    while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                        $date = $row['Date_Logged']->format('Y-m-d H:i:s');
                        echo
                        "<tr>
                            <td>$row[Project_ID]</td>
                            <td>$row[Message]</td>
                            <td>$date</td>
                            <td><button type=submit name=deleteItem value=$row[LogID]>Delete</button></td>
                        </tr>";
                    }
                    sqlsrv_close($conn);
                ?>
            </table>
        </form>
    </center>
</body>

</html>