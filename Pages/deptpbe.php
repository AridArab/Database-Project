<?php 
    error_reporting(E_ERROR | E_PARSE);
    include './navbar.php';
    include '../Logic/sqlconn.php';

    $id = $start = $end = -1;

    if(isset($_GET["id"])){
        if (isset($_GET["start"]) && isset($_GET["end"])){
            $id = $_GET["id"];
            $start = $_GET["start"];
            $end = $_GET["end"];
        }
        else if(isset($_GET["start"])){
            $id = $_GET["id"];
            $start = $_GET["start"];
        }
        else if(isset($_GET["end"])){
            $id = $_GET["id"];
            $end = $_GET["end"];
        }

        else
            $id = $_GET["id"];
    }
    else {
        echo '<script type="text/javascript">';
        echo "window.location.href='./home.php'";
        echo '</script>';
        exit();
    }

    $conn = connect();

    $result = sqlsrv_query($conn, "select * from Project where Start_Date IS NOT NULL AND Department_ID = ".$id);

    $projects = array();

    echo "<center>[".$id."]  [".$start."]  [".$end."]</center>";

    if($start == -1 && $end == -1)
        while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            array_push($projects, $row);
        }
    else if($end == -1)
        while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            if($row['Start_Date']->format("Y-m-d") >= date("Y-m-d", strtotime($start)))
                array_push($projects, $row);
        }
    else if($start == -1)
        while($row['Start_Date']->format("Y-m-d") <= date("Y-m-d", strtotime($end))){
            if($row['Start_Date'] < date_parse($end))
                array_push($projects, $row);
        }
    else
        while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            if($row['Start_Date']->format("Y-m-d") >= date("Y-m-d", strtotime($start)) && $row['Start_Date']->format("Y-m-d") <= date("Y-m-d", strtotime($end)))
                array_push($projects, $row);
        }

    
    sqlsrv_close($conn);
?>

<html>
<header>
    <style>
        table {
          width: 50%;
        }

        td {
          border: 1px solid rgb(0, 0, 0);
          text-align: left;
        }

        tr:nth-child(even) {
            background-color: rgba(225, 225, 225, 0.75);
        }
    </style>
</header>

<body>
    <center>
        <a href='./view_Reports.php'>Back</a>
        <table>
            <tr>
                <td>ID</td>
                <td>Project</td>
                <td>Budget</td>
                <td>Expense</td>
            </tr>
            <?php
                foreach($projects as $row){
                    echo
                        "<tr>
                            <td>".$row['ID']."</td>
                            <td>".$row['Name']."</td>
                            <td>".$row['Budget']."</td>
                            <td>".$row['Total_Cost']."</td>
                        </tr>";
                }
            ?>
        </table>
    </center>
</body>

</html>