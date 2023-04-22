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
    $sql = "SELECT DISTINCT E.ID AS Employee_ID, E.First_Name, E.Last_Name, E.Salary, E.Department_ID, WO.Total_Hours, P.Name AS Project_Name, P.ID AS Project_ID, P.Progress, P.Total_Cost, P.Budget, 
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
  
  function employeeQuery($includeEmployee)
  {
    $employeeSql = "SELECT DISTINCT E.ID, E.First_Name, E.Last_Name, E.Sex, E.City, E.State, E.Email_Address, E.Department_ID FROM Employee as E, Project as P WHERE P.isActive = ?"; 
    return $employeeSql;
    
  }
  
  function worksOnQuery($includeEmployee)
  {
    $worksOnSql = "SELECT DISTINCT W.ID, W.Job_Title, W.Total_Hours, W.Employee_ID, W.Project_ID, W.Progress FROM WORKS_ON as W, Project as P WHERE P.isActive = ?"; 
    return $worksOnSql;
    
  }
  
  $sql = generateQuery($_POST['dropdown_Progress'], $_POST['dropdown_Budget'], $_POST['dropdown_TotalCost'], $includeEmployee);
  $employeeSql = employeeQuery($includeEmployee);
  $worksOnSql = worksOnQuery($includeEmployee);
  
  $params = array($_POST['progress'], $_POST['budget'], $_POST['totalCost'], $_POST['from'], $_POST['to']);
  $employeeParams = array(1);
  $worksOnParams = array(1);
  
  
  $stmt = sqlsrv_query($conn, $sql, $params);
  $employeeStmt = sqlsrv_query($conn, $employeeSql, $employeeParams);
  $worksOnStmt = sqlsrv_query($conn, $worksOnSql, $worksOnParams);
  
  $title = "Projects Report from " . $_POST['from'] . " to " . $_POST['to'];

    if ($_POST['dropdown_Progress'] === 'Greater than') 
    {
      $title .= " (Progress > " . $_POST['progress'] . ")";
      
    } 
    else if ($_POST['dropdown_Progress'] === 'Less than') 
    {
      $title .= " (Progress < " . $_POST['progress'] . ")";
    }

  
  
    if ($_POST['dropdown_TotalCost'] === 'Greater than') 
    {
      $title .= " (Total Cost > " . $_POST['totalCost'] . ")";
      
    } 
    else if ($_POST['dropdown_TotalCost'] === 'Less than') 
    {
      $title .= " (Total Cost < " . $_POST['totalCost'] . ")";
    }

  

    if ($_POST['dropdown_Budget'] === 'Greater than') 
    {
      $title .= " (Budget > " . $_POST['budget'] . ")";
      
    } 
    else if ($_POST['dropdown_Budget'] === 'Less than') 
    {
      $title .= " (Budget < " . $_POST['budget'] . ")";
    }


  

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
echo "<a href='./home.php'>Home</a>";
echo "<style>";
echo "table { margin: 20px; }";
echo "td, th { padding: 10px; }";
echo "</style>";



echo "<table>";
echo "<caption style='font-size: 1.5em; font-weight: bold; margin-bottom: 10px;'>" . $title . "</caption>";
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

if ($includeEmployee)
{
echo "<table>";
echo "<caption style='font-size: 1.5em; font-weight: bold; margin-bottom: 10px;'>Joined from Employee table: </caption>";
echo "<tr><th>ID</th><th>First Name</th><th>Last Name</th><th>Sex</th><th>City</th><th>State</th><th>Email Address</th><th>Department ID</th></tr>";
while( $row = sqlsrv_fetch_array( $employeeStmt, SQLSRV_FETCH_ASSOC) ) {
    echo "<tr>";
    echo "<td>".$row['ID']."</td>";
    echo "<td>".$row['First_Name']."</td>";
    echo "<td>".$row['Last_Name']."</td>";
    echo "<td>".$row['Sex']."</td>";
    echo "<td>".$row['City']."</td>";
    echo "<td>".$row['State']."</td>";
    echo "<td>".$row['Email_Address']."</td>";
    echo "<td>".$row['Department_ID']."</td>";
    echo "</tr>";
}
echo "</table>";

echo "<table>";
echo "<caption style='font-size: 1.5em; font-weight: bold; margin-bottom: 10px;'>Joined from Works On table: </caption>";
echo '<tr><th>ID</th><th>Job Title</th><th>Total Hours</th><th>Employee ID</th><th>Project ID</th><th>Progress</th></tr>';
while( $row = sqlsrv_fetch_array( $worksOnStmt, SQLSRV_FETCH_ASSOC) ) {
  echo '<tr>';
  echo '<td>' . $row['ID'] . '</td>';
  echo '<td>' . $row['Job_Title'] . '</td>';
  echo '<td>' . $row['Total_Hours'] . '</td>';
  echo '<td>' . $row['Employee_ID'] . '</td>';
  echo '<td>' . $row['Project_ID'] . '</td>';
  echo '<td>' . $row['Progress'] . '</td>';
  echo '</tr>';
}

echo '</table>';

}
sqlsrv_close($conn);
// header('Location: display_Projects.php');


exit();