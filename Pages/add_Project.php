<?php
$serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
$connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);

$conn = sqlsrv_connect($serverName, $connectionInfo);
if($conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}



$sql = "INSERT INTO Project (Progress, ID, Name, Total_Cost, Street_Address, City, State, Zip_Code, Department_ID, Budget, isActive) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$params = array($_POST['progress'], $_POST['projectID'], $_POST['projectName'], $_POST['cost'], 
$_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['deptID'], $_POST['budget'], 1);

$stmt = sqlsrv_query( $conn, $sql, $params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}

sqlsrv_close($conn);
header('Location: view_Projects.php');

exit();