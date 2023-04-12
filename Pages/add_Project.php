<?php
$serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
$connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);

$conn = sqlsrv_connect($serverName, $connectionInfo);
if($conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}


$sql = "INSERT INTO Project (Progress, Name, Total_Cost, Street_Address, City, State, Zip_Code, Department_ID, Budget, isActive, Start_Date, End_Date, Deadline) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$params = array($_POST['progress'], $_POST['projectName'], $_POST['cost'], 
$_POST['address'], $_POST['city'], $_POST['state'], $_POST['zip'], $_POST['deptID'], $_POST['budget'], 1, $_POST['startdate'], NULL, $_POST['deadline']);

$stmt = sqlsrv_query( $conn, $sql, $params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}

sqlsrv_close($conn);
echo '<script type="text/javascript">';
echo "window.location.href='./edit_Project.php'";
echo '</script>';

exit();