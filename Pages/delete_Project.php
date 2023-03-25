<?php
include_once ".env.php";

$conn = sqlsrv_connect(serverName, connectionInfo);
if($conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

//TODO: Need to change schema so that there is an isActive column
$sql = "UPDATE Project SET isActive = 0 WHERE ID = ?";
$params = array($_POST['projectID']);

$stmt = sqlsrv_query($conn, $sql, $params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}

sqlsrv_close($conn);
header('Location: view_Projects.php');

exit();