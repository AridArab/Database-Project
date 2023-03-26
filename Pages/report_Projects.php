<?php
$serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
$connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);

$conn = sqlsrv_connect($serverName, $connectionInfo);;
if($conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}


if ($_POST['dropdown_Progress'] == 'Greater than' && $_POST['dropdown_Budget'] == 'Greater than') {

    $sql = "SELECT * FROM Project 
    WHERE progress >= ? and budget >= ?";
  }
  

if ($_POST['dropdown_Progress'] == 'Greater than' &&  $_POST['dropdown_Budget'] == 'Less than')
{
    $sql = "SELECT * FROM Project 
    WHERE progress >= ? and budget <= ?";
}

if ($_POST['dropdown_Progress'] == 'Less than' &&  $_POST['dropdown_Budget'] == 'Greater than')
{
    $sql = "SELECT * FROM Project 
    WHERE progress <= ? and budget >= ?";
}

if ($_POST['dropdown_Progress'] == 'Less than' &&  $_POST['dropdown_Budget'] == 'Less than')
{
    $sql = "SELECT * FROM Project 
    WHERE progress <= ? and budget <= ?";
}


$params = array($_POST['progress'], $_POST['budget']);

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) {
  die(print_r(sqlsrv_errors(), true));
}

echo "<table>";
echo "<tr><th>Progress</th><th>ID</th><th>Name</th><th>Total Cost</th><th>City</th><th>State</th><th>Zip Code</th><th>Department ID</th><th>Budget</th></tr>";

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
  echo "<tr>";
  echo "<td>" . $row['Progress'] . "</td>";
  echo "<td>" . $row['ID'] . "</td>";
  echo "<td>" . $row['Name'] . "</td>";
  echo "<td>" . $row['Total_Cost'] . "</td>";
  echo "<td>" . $row['City'] . "</td>";
  echo "<td>" . $row['State'] . "</td>";
  echo "<td>" . $row['Zip_Code'] . "</td>";
  echo "<td>" . $row['Department_ID'] . "</td>";
  echo "<td>" . $row['Budget'] . "</td>";
  echo "</tr>";
}

echo "</table>";

       
sqlsrv_close($conn);
// header('Location: view_Projects.php');


exit();