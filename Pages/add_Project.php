<?php
include_once ".env.php";

$conn = sqlsrv_connect(serverName, connectionInfo);
if($conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$sql = "INSERT INTO Project (Progress, ID, Name, Total_Cost, Street_Address, City, State, Zip_Code, Department_ID, Budget) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$params = array($_POST['progress'], $_POST['projectID'], $_POST['projectName'], $_POST['cost'], 
$_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['deptID'], $_POST['budget']);

$stmt = sqlsrv_query( $conn, $sql, $params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}

sqlsrv_close($conn);
header('Location: view_Projects.php');

exit();