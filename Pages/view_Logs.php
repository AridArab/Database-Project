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
        "select * from Logs"
    );
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
        <table>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Date</td>
            </tr>
            <?php
            //TODO: Need to add option to remove old logs
                while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                    $date = $row['Date_Logged']->format('Y-m-d H:i:s');
                    echo
                    "<tr>
                        <td>$row[Project_ID]</td>
                        <td>$row[Message]</td>
                        <td>$date</td>
                    </tr>";
                }
                sqlsrv_close($conn);
            ?>
        </table>
    </center>
</body>

</html>