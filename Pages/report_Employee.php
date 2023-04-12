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
    include './navbar.php';
    include '../Logic/sqlconn.php';
    
    $conn = connect();

    $stmt = "";

    if($_POST['edept'] != ''){
        $stmt = "SELECT * FROM Employee, Department WHERE Department_ID = ".$_POST['edept']." AND Department.ID = ".$_POST['edept'];
    }
    else{
        $stmt = "SELECT * FROM Employee LEFT JOIN Department ON Department.ID = Department_ID";
    }

    select_query($stmt, $conn);

    echo "
        <center>
            <table>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Department ID</td>
                <td>Department</td>
            </tr>";

    $result = select_query($stmt, $conn);

    foreach($result as $row){
        echo
            "<tr>
                <td>".$row['ID']."</td>
                <td>".$row['First_Name']." ".$row['Middle_Initial']." ".$row['Last_Name']."</td>
                <td>".$row['Department_ID']."</td>
                <td>".$row['Dept_Name']."</td>
            </tr>";
    }

    echo "
        </table>
    </center>";

    sqlsrv_close($conn);

    exit();
?>