<?php
$serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
$connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);

$conn = sqlsrv_connect($serverName, $connectionInfo);
if($conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$sql = "UPDATE Project SET isActive = 0 WHERE ID = ?";


$params = array($_POST['projectID']);

$stmt = sqlsrv_query($conn, $sql, $params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}

sqlsrv_close($conn);
echo '<script type="text/javascript">';
echo "window.location.href='./edit_Project.php'";
echo '</script>';

exit();