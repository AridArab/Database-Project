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
    // include '../Logic/sqlconn.php';

    $conn = connect();
    
    $stmt = "";

    if($_POST['ddept'] != ''){
        $stmt = "SELECT Department.ID, Department.Dept_Name, SUM(Budget) AS Budget, 
        SUM(Total_Cost) AS Expenses FROM Project INNER JOIN Department ON Department.ID = ".$_POST['ddept']."
        GROUP BY Department.ID, Department.Dept_Name";
    }
    else{
        $stmt = "SELECT Department.ID, Department.Dept_Name, SUM(Budget) AS Budget, 
        SUM(Total_Cost) AS Expenses FROM Project INNER JOIN Department ON Department.ID = Department_ID 
        GROUP BY Department.ID, Department.Dept_Name";
    }
    select_query($stmt, $conn);

    echo "
        <center>
            <table>
            <tr>
                <td>Department ID</td>
                <td>Department</td>
                <td>Budget</td>
                <td>Expenses</td>
            </tr>";

    $result = select_query($stmt, $conn);

    foreach($result as $row){
        echo
            "<tr>
                <td>".$row['ID']."</td>
                <td>".$row['Dept_Name']." ".$row['Middle_Initial']." ".$row['Last_Name']."</td>
                <td>".$row['Budget']."</td>
                <td>".$row['Expenses']."</td>
            </tr>";
    }

    echo "
        </table>
    </center>";

    sqlsrv_close($conn);

    exit();
?>