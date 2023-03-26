<?php
    include "Navbar.php";

    $serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
    $connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);

    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if($conn === false) {
        die( print_r( sqlsrv_errors(), true));
    }

    if($_POST['job_title'] == null || $_POST['project_id'] == null || $_POST['description'] == null || $_POST['deadline'] == null){
        header('Location: give_Task.php?id='. $_GET['id']);
        exit();
    }

    $sql = "INSERT INTO WORKS_ON (Job_Title, Start_Date, End_Date, Total_Hours, Employee_ID, Project_ID, Description, Progress, Deadline) VALUES (?,?,?,?,?,?,?,?,?)";

    $curr_Date = date("Y/m/d");
    $params = array($_POST['job_title'], $curr_Date, null, 0, $_GET['id'], $_POST['project_id'], $_POST['description'], 0, $_POST['deadline']);

    $stmt = sqlsrv_query( $conn, $sql, $params);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    sqlsrv_close($conn);

    

    header('Location: view_Management.php');
    exit();

    //Mostly finished