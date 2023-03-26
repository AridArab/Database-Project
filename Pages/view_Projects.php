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
        <h1>Projects</h1>
    </center>
    <?php
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if(!$conn)
        {
            exit("<p> Connection Error: " . sqlsrv_connect_error() . "</p>");
        }
    
    ?>
    <center>
    <?php 
        if($_SESSION['obj']['Is_Manager'] == 1) {
            echo '<table>
                    <h3 class="top">Add Project</h3>
                        <form action="add_Project.php" method ="POST">
                            <label for="progress">Progress:</label>
                            <input type="text" id="progress" name="progress"><br>
                            <label for="projectID">ID:</label>
                            <input type="text" id="projectID" name="projectID"><br>
                            <label for="projectName">Name:</label>
                            <input type="text" id="projectName" name="projectName"><br>
                            <label for="cost">Total Cost:</label>
                            <input type="text" id="cost" name="cost"><br>
                            <label for="address">Street Address:</label>
                            <input type="text" id="address" name="address"><br>
                            <label for="city">City:</label>
                            <input type="text" id="city" name="city"><br>
                            <label for="state">State:</label>
                            <input type="text" id="state" name="state"><br>
                            <label for="zip">ZipCode:</label>
                            <input type="text" id="zip" name="zip"><br>
                            <label for="deptID">Department ID:</label>
                            <input type="text" id="deptID" name="deptID"><br>
                            <label for="budget">Budget:</label>
                            <input type="text" id="budget" name="budget"><br>
                            
                            <input type="submit" value="Add Project">
                        </form>

                    <h3 class="top">Update Project</h3>
                        <form action="update_Project.php" method ="POST">
                            <label for="projectID">Enter ID:</label>
                            <input type="text" id="projectID" name="projectID"><br>
                            <label for="column">Select Category:</label>
                            <input type="text" id="column" name="column"><br>
                            <label for="update">Enter new value:</label>
                            <input type="text" id="update" name="update"><br>

                            <input type="submit" value="Update Project">
                        </form>

                    <h3 class="top">Delete Project</h3>
                        <form action="delete_Project.php" method ="POST">
                            <label for="projectID">Enter ID:</label>
                            <input type="text" id="projectID" name="projectID"><br>

                            <input type="submit" value="Delete Project">
                        </form>
                </table>';
        }
    ?>
    <h2>View Projects (<?php 
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