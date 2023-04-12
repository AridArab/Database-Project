<?php
$serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
$connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 31, "Encrypt" => 1, "TrustServerCertificate" => 1);
?>
<html>
<header>
    <style>
        label {
            margin-bottom: 10px;
            padding-right: 5px;
            display: inline-block;
            width: 125px;
            text-align: right;
        }
        table {
            width: 75%;
        }
        td {
            border: 1px solid rgb(0, 0, 0);
            text-align: left;
        }
        tr:nth-child(even) {
            background-color: rgb(225, 225, 225);
        }
        
    </style>
</header>

<?php
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
      $sql = "SELECT DISTINCT E.ID AS Employee_ID, E.First_Name, E.Last_Name, E.Salary, E.Department_ID, P.Name AS Project_Name, P.ID AS Project_ID, P.Total_Cost, P.Budget, 
      P.City
      FROM Employee E 
      INNER JOIN WORKS_ON WO ON E.ID = WO.Employee_ID 
      INNER JOIN Project P ON WO.Project_ID = P.ID 
      WHERE P.isActive = 1
       ";
    }
    else
    {
      $sql = "SELECT P.Name, P.ID, P.Progress, P.Total_Cost, P.Budget, P.City FROM Project as P WHERE P.isActive = 1 ";
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

    $sql .= "AND P.Start_Date >= ? AND P.Deadline <= ? ";
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
    if ($column == "Start_Date") 
    { 
      $startDate = $row['Start_Date']->format('Y-m-d');
      echo "<td>" . $startDate . "</td>";
    } 
    elseif ($column == "Deadline") 
    { 
      $deadline = $row['Deadline']->format('Y-m-d');
      echo "<td>" . $deadline . "</td>";
    }
    else 
    {
      echo "<td>" . $row[$column] . "</td>";
    }
  }
  echo "</tr>";
}
echo "</table>";



       
sqlsrv_close($conn);
// header('Location: display_Projects.php');


exit();