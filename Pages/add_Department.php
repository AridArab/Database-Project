<?php
include '../Logic/sqlconn.php';
$serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
$connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);

$conn = sqlsrv_connect($serverName, $connectionInfo);
if($conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}


$sqlDept = "INSERT INTO Department (Phone_Number, Dept_Name, Email_Address, Dept_Budget, Manager_ID) VALUES (?, ?, ?, ?, ?)";
$paramsDept = array($_POST['phone'], $_POST['name'], $_POST['mail'], $_POST['budget'], $_POST['manager']);
$stmt = sqlsrv_query( $conn, $sqlDept, $paramsDept );
if( $stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}

$DeptID = select_query("SELECT Department.ID FROM Department WHERE Department.Dept_Name = '".$_POST['name']."'", $conn)[0];

$sqlLoc = "INSERT INTO Dept_Locations (Street_Address, City, State, Zip_Code, Department_ID) VALUES (?, ?, ?, ?, ?)";
$paramsLoc = array($_POST['street'], $_POST['city'], $_POST['stateName'], $_POST['zipcode'], $DeptID['ID']);

$stmttwo = sqlsrv_query( $conn, $sqlLoc, $paramsLoc);
if ($stmt === false ) {
    die( print_r( sqlsrv_errors(), true));
}





sqlsrv_close($conn);
echo '<script type="text/javascript">';
echo "window.location.href='./view_Admin.php'";
echo '</script>';

exit();