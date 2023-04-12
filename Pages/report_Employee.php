<html>
<header>
    <style>
        label {
            margin-bottom: 10px;
            padding-right: 5px;
            display: inline-block;
            width: 125px;
            text-align: right;
        }
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

<?php
    error_reporting(E_ERROR | E_PARSE);
    include './Navbar.php';
    include '../Logic/sqlconn.php';

    if($_SESSION['obj']['Is_Manager'] == 0){
        echo '<script type="text/javascript">';
        echo "window.location.href='./home.php'";
        echo '</script>';
        exit();
    }

    $conn = connect();

    $stmt = "SELECT * FROM Employee";

    if($_POST['edept'] != ''){
        $stmt .= ", Department WHERE Department_ID = ".$_POST['edept']." AND Department.ID = ".$_POST['edept'];
    }

    select_query($stmt, $conn);

    echo "
        <center>
            <table>
            <tr>
                <td>ID</td>
                <td>First Name</td>
                <td>Department</td>
            </tr>";

    $result = select_query($stmt, $conn);

    foreach($result as $row){
        echo
            "<tr>
                <td>".$row['ID']."</td>
                <td>".$row['First_Name']."</td>
                <td>".$row['Middle_Initial']."</td>
                <td>".$row['Last_Name']."</td>
                <td>".$row['Department_ID']."</td>
                <td>".$row['Name']."</td>
            </tr>";
    }

    echo "
        </table>
    </center>";

    sqlsrv_close($conn);

    exit();
?>