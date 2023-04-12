<?php
$serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
$connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);

$conn = sqlsrv_connect($serverName, $connectionInfo);
if($conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$column = ($_POST['dropdown_Select']);
$projectID = $_POST['projectID'];
$updateValue = $_POST['update'];


if($column == 'Progress')
{
    if($_POST['update'] == '100'){
        $sql = "UPDATE Project SET Progress = ?, isActive = 0 WHERE ID = ?";
    }
    else{
        $sql = "UPDATE Project SET Progress = ? WHERE ID = ?";
    }
}

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

$idExists = false;
$checkIdQuery = "SELECT ID FROM Project WHERE ID = ?";
$params = array($projectID);
$checkIdStmt = sqlsrv_query($conn, $checkIdQuery, $params);
if ($checkIdStmt !== false) {
    if (sqlsrv_has_rows($checkIdStmt)) {
        $idExists = true;
    }
    sqlsrv_free_stmt($checkIdStmt);
}

if (!$idExists) {
    echo "<p>The project ID entered does not exist .</p>";
} else {
    $params = array($updateValue, $projectID);
}

$stmt = sqlsrv_query($conn, $sql, $params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}



sqlsrv_close($conn);
echo '<script type="text/javascript">';
echo "window.location.href='./edit_Project.php'";
echo '</script>';

exit();