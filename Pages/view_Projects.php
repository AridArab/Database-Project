<?php
include './Navbar.php';
include '../Logic/sqlconn.php';

$serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
$connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
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

<body>
    <center>
        <h1>View Projects</h1>
    </center>
    <?php
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if(!$conn)
        {
            exit("<p> Connection Error: " . sqlsrv_connect_error() . "</p>");
        }
    
    ?>
    <center>
    
                <table>

                    <h3 class="top">Generate Projects Report</h3>
                        <form action="report_Projects.php" method ="POST">
   
                            <label for="employees">Include Employees?</label>
                            <input type="checkbox" id="employees" name="employees" value="true"><br>
                        
                            <select name="dropdown_Progress">
                                <option value="Greater than">Greater than</option>
                                <option value="Less than">Less than</option>
                            </select>  
                                <label for="progress">Progress:</label>
                                <input type="text" id="progress" name="progress"><br>
                                
                            <select name="dropdown_TotalCost">
                                <option value="Greater than">Greater than</option>
                                <option value="Less than">Less than</option>
                            </select>  
                                <label for="totalCost">Total Cost:</label>
                                <input type="text" id="totalCost" name="totalCost"><br>

                            <select name="dropdown_Budget">
                                <option value="Greater than">Greater than</option>
                                <option value="Less than">Less than</option>
                            </select>
                                <label for="budget">Budget:</label>
                                <input type="text" id="budget" name="budget"><br>

                                <label for="from">From:</label>
                                <input type="text" id="from" name="from" pattern="\d{4}-\d{2}-\d{2}" title="Please enter a date in the format yyyy-mm-dd" placeholder="yyyy-mm-dd"><br>
                                
                                <label for="to">To:</label>
                                <input type="text" id="to" name="to" pattern="\d{4}-\d{2}-\d{2}" title="Please enter a date in the format yyyy-mm-dd" placeholder="yyyy-mm-dd"><br>
                                
                                

                                

                                <input type="submit" value="Generate Report">
                        </form>
                </table>
    
    <h2>All Projects (<?php 
    $conn = connect();
    echo select_query("select count(*) as Projects from 
    Project where isActive = 1", $conn)['Projects'] ?>)</h2>
    <table>
        <?php
        $query = "SELECT * FROM Project";
        $activeQuery = "SELECT isActive FROM Project";
        $result = sqlsrv_query($conn, $query);
        if(!$result)
            {
                exit("<p> Query Error: " . sqlsrv_error($conn) . "</p>");
            }

        if(!$activeQuery)
            {
                exit("<p> Query Error: " . sqlsrv_error($conn) . "</p>");
            }
        ?>

        <tr>
            <td>Progress</td>
            <td>ID</td>
            <td>Name</td>
            <td>Total Cost</td>
            <td>Street Address</td>
            <td>City</td>
            <td>State</td>
            <td>Zip Code</td>
            <td>Department ID</td>
            <td>Budget</td>
        </tr>
        
        <?php
            while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
                if($row['isActive'] == 1){
                    echo "<tr><td>$row[Progress]</td>
                    <td>$row[ID]</td>
                    <td>$row[Name]</td>
                    <td>$row[Total_Cost]</td>
                    <td>$row[Street_Address]</td>
                    <td>$row[City]</td>
                    <td>$row[State]</td>
                    <td>$row[Zip_Code]</td>
                    <td>$row[Department_ID]</td>
                    <td>$row[Budget]</td>

                    </tr>";
            }
        ?>
        
    </table>
    </center>

</body>


</html>
