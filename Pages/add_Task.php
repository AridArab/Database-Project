<?php
    include_once ".env.php";

    $conn = sqlsrv_connect(serverName, connectionInfo);
    if($conn === false) {
        die( print_r( sqlsrv_errors(), true));
    }

    if(!$_SESSION['obj']){
        header('Location: ../');
        exit();
    }
    else if(!($_SESSION['obj']['Is_Manager'] == 1) || !$_POST['submit'] ){
        header('Location: home.php');
        exit();
    }

    $sql = "INSERT INTO WORKS_ON (Job_Title, Start_Date, End_Date, Total_Hours, Employee_ID, Project_ID, Description, Progress, Deadline) VALUES (?,?,?,?,?,?,?,?,?)";

    $curr_Date = date("Y/m/d");

    $params = array($_POST['job_title'], $curr_Date, null, 0, $_POST['id'], $_POST['project_id'], $_POST['description'], 0, $_POST['deadline']);

    $stmt = sqlsrv_query( $conn, $sql, $params);
    if( $stmt === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
    sqlsrv_close($conn);

    

    header('Location: view_Management.php');
    exit();

    //Mostly finished