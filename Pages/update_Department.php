<?php
$serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
$connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);

$conn = sqlsrv_connect($serverName, $connectionInfo);
if($conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$column = ($_POST['dropdown_Select']);
$deptName = ($_POST['update_id']);
$updateValue = $_POST['update'];


if($column == 'Name')
    $sql = "UPDATE Department SET Dept_Name = ? WHERE ID = ?";

if($column == 'Email')
    $sql = "UPDATE Department SET Email_Address = ? WHERE ID = ?";

if($column == 'Phone Number')
    $sql = "UPDATE Department SET Phone_Number = ? WHERE ID = ?";

if($column == 'Street Address')
    $sql = "UPDATE Dept_Locations SET Street_Address = ? WHERE Department_ID = ?";

if($column == 'Zip Code')
    $sql = "UPDATE Dept_Locations SET Zip_Code = ? WHERE Department_ID = ?";

if($column == 'City')
    $sql = "UPDATE Dept_Locations SET City = ? WHERE Department_ID = ?";

if($column == 'State')
    $sql = "UPDATE Dept_Locations SET State = ? WHERE Department_ID = ?";

if($column == 'Manager')
    $sql = "UPDATE Department SET Manager = ? WHERE ID = ?";

if($column == 'Budget')
    $sql = "UPDATE Department SET Dept_budget = ? WHERE ID = ?";




$params = array($_POST['update'], ($_POST['project_id']));

$nameExists = false;
$checkNameQuery = "SELECT ID FROM Department WHERE ID = ?";
$params = array($deptName);
$checkNameStmt = sqlsrv_query($conn, $checkNameQuery, $params);
if ($checkNameStmt !== false) {
    if (sqlsrv_has_rows($checkNameStmt)) {
        $nameExists = true;
    }
    sqlsrv_free_stmt($checkNameStmt);
}

if (!$nameExists) {
    echo "<p>The Dept Name entered does not exist .</p>";
} else {
    $params = array($updateValue, $deptName);
}

$stmt = sqlsrv_query($conn, $sql, $params);
if( $stmt === false ) {
     die( print_r( sqlsrv_errors(), true));
}



sqlsrv_close($conn);
echo '<script type="text/javascript">';
echo "window.location.href='./view_Admin.php'";
echo '</script>';

exit();