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
    // include './navbar.php';
    include '../Logic/sqlconn.php';

    if(!isset($_POST['edept'])){
        echo '<script type="text/javascript">';
        echo "window.location.href='../'";
        echo '</script>';
    }

    $serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
    $connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 31, "Encrypt" => 1, "TrustServerCertificate" => 1);
    
    $conn = sqlsrv_connect($serverName, $connectionInfo);

    $stmt = "";

    if($_POST['edept'] != ''){
        $stmt = "SELECT Employee.ID AS EID, * FROM Employee, Department WHERE Department_ID = ".$_POST['edept']." AND Department.ID = ".$_POST['edept'];
    }
    else{
        $stmt = "SELECT Employee.ID AS EID, * FROM Employee LEFT JOIN Department ON Department.ID = Department_ID";
    }

    $sql = sqlsrv_query($conn, $stmt);

    echo "
        <center>
            <a href='./home.php'>Home</a>
            <table>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Department ID</td>
                <td>Department</td>
            </tr>";

    while($result = sqlsrv_fetch_array($sql, SQLSRV_FETCH_ASSOC)){
        echo
            "<tr>
                <td>".$result['EID']."</td>
                <td>".$result['First_Name']." ".$result['Middle_Initial']." ".$result['Last_Name']."</td>
                <td>".$result['Department_ID']."</td>
                <td>".$result['Dept_Name']."</td>
            </tr>";
    }

    echo "
        </table>
    </center>";

    sqlsrv_close($conn);

    exit();
?>