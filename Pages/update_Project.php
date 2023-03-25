<?php
include_once ".env.php";

$conn = sqlsrv_connect(serverName, connectionInfo);
if($conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$column = ($_POST['column']);


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
header('Location: view_Projects.php');

exit();