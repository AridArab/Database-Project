<?php
$serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
$connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 31, "Encrypt" => 1, "TrustServerCertificate" => 1);

$conn = sqlsrv_connect($serverName, $connectionInfo);;
if($conn === false ) {
     die( print_r( sqlsrv_errors(), true));
}

if(isset($_POST['employees'])) 
{
  $includeEmployee = true;
} 
else 
{
  $includeEmployee = false;
}


function generateQuery($progress, $budget, $totalCost, $includeEmployee)
  {
    if ($includeEmployee) 
    {
      $sql = "SELECT E.First_Name, E.Last_Name, E.Salary, E.Department_ID, E.ID, W.Job_Title, W.Total_Hours, P.Name, P.ID FROM Employee as E, WORKS_ON as W, Project as P WHERE isActive = 1 ";
    }
    else
    {
      $sql = "SELECT P.Name, P.ID, W.Job_Title, W.Total_Hours FROM Project as P, WORKS_ON as W WHERE isActive = 1 ";
    }

  if ($progress === 'Greater than') 
    {
      $sql .= "AND P.progress >= ? ";
    } 
  else if ($progress === 'Less than') 
    {
      $sql .= "AND P.progress <= ? ";
    }

  if ($budget === 'Greater than') 
    {
      $sql .= "AND P.budget >= ? ";
    } 
  else if ($budget === 'Less than') 
    {
      $sql .= "AND P.budget <= ? ";
    }

  if ($totalCost === 'Greater than') 
    {
      $sql .= "AND P.Total_Cost >= ? ";
    } 
  else if ($totalCost === 'Less than') 
    {
      $sql .= "AND P.Total_Cost <= ? ";
    }

    $sql .= "AND W.Start_Date >= ? AND W.End_Date <= ? ";
    return $sql;
}


$sql = generateQuery($_POST['dropdown_Progress'], $_POST['dropdown_Budget'], $_POST['dropdown_TotalCost'], $includeEmployee);


$params = array($_POST['progress'], $_POST['budget'], $_POST['totalCost'], $_POST['from'], $_POST['to']);

$stmt = sqlsrv_query($conn, $sql, $params);
if ($stmt === false) 
{
  die(print_r(sqlsrv_errors(), true));
}

$metadata = sqlsrv_field_metadata($stmt);
$num_cols = sqlsrv_num_fields($stmt);

$column_names = array();
for ($i = 0; $i < $num_cols; $i++) 
{
  $field = sqlsrv_get_field($stmt, $i);
  $column_names[] = $metadata[$i]['Name'];
}

echo "<table>";
echo "<tr>";
foreach ($column_names as $column) 
{
  echo "<th>" . $column . "</th>";
}
echo "</tr>";

while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) 
{
  echo "<tr>";
  foreach ($column_names as $column) 
  {
    echo "<td>" . $row[$column] . "</td>";
  }
  echo "</tr>";
}
echo "</table>";


       
sqlsrv_close($conn);
// header('Location: view_Projects.php');


exit();