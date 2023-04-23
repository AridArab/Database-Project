<?php
include '../Logic/sqlconn.php';
$serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
$connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);

$conn = sqlsrv_connect($serverName, $connectionInfo);
if($conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$demotedAdmin = ($_POST['remove_admin']);

$sql = "UPDATE Employee SET Is_Manager = 1 WHERE ID = ?";

$params = array($demotedAdmin);

$stmt = sqlsrv_query($conn, $sql, $params);
if ( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true ));
}




sqlsrv_close($conn);
echo '<script type="text/javascript">';
echo "window.location.href='./view_Admin.php'";
echo '</script>';

exit();