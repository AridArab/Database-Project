<?php
$serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
$connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);

$conn = sqlsrv_connect($serverName, $connectionInfo);
if($conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

$column = ($_POST['dropdown_Select']);
$deptName = $_POST['deptName'];
$updateValue = $_POST['update'];



if($column == 'Name')
    $sql = "UPDATE Project SET Dept_Name = ? WHERE Dept_Name = ?";

if($column == 'Email')
    $sql = "UPDATE Project SET Email_Address = ? WHERE Dept_Name = ?";

if($column == 'Phone Number')
    $sql = "UPDATE Project SET Phone_Number = ? WHERE Dept_Name = ?";

if($column == 'Address')
    $sql = "UPDATE Project SET Address = ? WHERE Dept_Name = ?";

if($column == 'Manager')
    $sql = "UPDATE Project SET Manager = ? WHERE Dept_Name = ?";

if($column == 'Budget')
    $sql = "UPDATE Project SET Dept_budget = ? WHERE Dept_Name = ?";




$params = array($_POST['update'], $_POST['deptName']);

$nameExists = false;
$checkNameQuery = "SELECT ID FROM Project WHERE ID = ?";
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