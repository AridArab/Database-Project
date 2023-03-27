<?php
$serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
$connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);

$conn = sqlsrv_connect($serverName, $connectionInfo);

    $serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
    $connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);

    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if($conn === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
?>

<html>
    <center>
    <h1>Tasks Assigned</h1>
    <?php 
        $query =   
           "SELECT *
            FROM WORKS_ON as T, Employee as E, Project as P
            WHERE T.Employee_ID = E.ID AND T.Project_ID = P.ID;";
        $result = sqlsrv_query($conn, $query);
        if($result){
            $row=sqlsrv_fetch_array($result, SQLSRV_FETCH_BOTH);
            if($row == null){
                echo "<p>No tasks assigned</p>";
            }
            else{
                do{
                    if($row['Employee_ID'] == $_SESSION['obj']['ID'] && $row['isActive'] == 1){
                        $assign_date = $row['Start_Date']->format('Y-m-d');
                        $deadline = $row['Deadline']->format('Y-m-d');
                        
                        echo "<p>Task: $row[Job_Title]</p>
                              <p>Description: $row[Description]</p>
                              <p>Assigned: $assign_date</p>
                              <p>Deadline: $deadline</p>
                              <p>For Project: $row[Name], ID: $row[Project_ID]</p>";

                       
                        if($row['End_Date'] != null){
                            echo "<p>Complete</p>";
                        }
                        else{
                            echo "<p>Incomplete</p>";
                        }
                    }
                    else if($row['isActive'] == 0){
                        echo "<p>Task \"$row[Job_Title]\" belongs to inactive project (Name: $row[Name], ID: $row[Project_ID])</p>";
                    }
                }
                while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_BOTH));
            }
        }
        else{
            exit("<p> Query Error </p>");
        }
    ?>
    </center>
</html>