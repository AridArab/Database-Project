<?php
    include_once ".env.php";

    $conn = sqlsrv_connect(serverName, connectionInfo);
    if($conn === false ) {
        die( print_r( sqlsrv_errors(), true));
    }

    $sql = "INSERT INTO WORKS_ON (Job_Title, Start_Date, End_Date, Total_Hours, Employee_ID, Project_ID, Description, Progress, Deadline) VALUES (?,?,?,?,?,?,?,?,?)";