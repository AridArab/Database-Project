<?php
$serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
$connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);

$conn = sqlsrv_connect($serverName, $connectionInfo);
if($conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$column = ($_POST['dropdown_Select']);


if($column == 'Progress')
    $sql = "UPDATE Project SET Progress = ? WHERE ID = ?";

if($column == 'Name')
    $sql = "UPDATE Project SET Name = ? WHERE ID = ?";

if($column == 'Total Cost')
    $sql = "UPDATE Project SET Total_Cost = ? WHERE ID = ?";

if($column == 'Street Address')
    $sql = "UPDATE Project SET Street_Address = ? WHERE ID = ?";

if($column == 'City')
    $sql = "UPDATE Project SET City = ? WHERE ID = ?";

if($column == 'State')
    $sql = "UPDATE Project SET State = ? WHERE ID = ?";

if($column == 'Zip Code')
    $sql = "UPDATE Project SET Zip_Code = ? WHERE ID = ?";

if($column == 'Department ID')
    $sql = "UPDATE Project SET Department_ID = ? WHERE ID = ?";

if($column == 'Budget')
    $sql = "UPDATE Project SET Budget = ? WHERE ID = ?";


$params = array($_POST['update'], $_POST['projectID']);



$stmt = sqlsrv_query($conn, $sql, $params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}

sqlsrv_close($conn);
header('Location: edit_Project.php');

exit();