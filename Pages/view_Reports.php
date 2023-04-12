<?php
include './navbar.php';
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
            background-color: rgba(225, 225, 225, 0.75);
        }
        .grb {
            display: grid;
            width: 700px;
            padding: 10px;
                    
            background-color: rgba(225, 225, 225, 0.75);
            border-color:rgb(0, 0, 0);
            border-style: solid;
            border-radius: 10px;
        }
    </style>
</header>

<body>
    <center>
        <h1>View Reports</h1>
    </center>
    <?php
    $conn = sqlsrv_connect($serverName, $connectionInfo);
    if(!$conn)
        {
            exit("<p> Connection Error: " . sqlsrv_connect_error() . "</p>");
        }
    
    ?>
    <center> 
    <script type="text/javascript">
        function hide(i){
            var temp = document.getElementById(i);
            temp.style.display = "none";
        }
        function showHide(i){
            var temp = document.getElementById(i);
            if(temp.style.display === "none")
                temp.style.display = "block";
            else
                temp.style.display = "none";
        }
    </script>
    <h3 class="top">Generate Report</h3>
    Select Report Type:
    <select id="report" onchange="hide('department');hide('employee');hide('project');showHide(value)">
        <option value="" disabled selected>Select</option>
        <option value="department">Departments</option>
        <?php if($_SESSION['obj']['Is_Manager'] == 1){echo '<option value="employee">Employees</option>';}?>
        <option value="project">Projects</option>
    </select>
    <p></p>
            <div class = "grb" id="department" style="display:none">
                <form action="report_Department.php" method ="POST">
                    <label for="ddept">Department:</label>
                    <input type="text" id="ddept" name="ddept">
                    <p></p>
                    <input type="submit" id="submit" value="Generate Report">
                </form>
            </div>
            <div class = "grb" id="employee" style="display:none">
                <form action="report_Employee.php" method ="POST">
                    <label for="edept">Department:</label>
                    <input type="text" id="edept" name="edept">
                    <p></p>
                    <input type="submit" id="submit" value="Generate Report">
                </form>
            </div>
            <div class = "grb" id="project" style="display:none">
                        <form action="report_Projects.php" method ="POST">
                        
                        <?php
                            if (isset($_SESSION['obj'])) { 
                                if ($_SESSION['obj']['Is_Manager'] == 1) {
                                    echo '<label for="employees">Include Employees?</label>';
                                    echo '<input type="checkbox" id="employees" name="employees" value="true"><br>';
                                }
                            }
                        ?>
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
                                <input type="text" id="from" name="from" pattern="\d{4}-\d{2}-\d{2}" title="Please enter a date in the format yyyy-mm-dd" placeholder="yyyy-mm-dd"required><br>
                                
                                <label for="to">To:</label>
                                <input type="text" id="to" name="to" pattern="\d{4}-\d{2}-\d{2}" title="Please enter a date in the format yyyy-mm-dd" placeholder="yyyy-mm-dd"required><br>
                                
                                

                                

                                <input type="submit" value="Generate Report">
                        </form>
            </div>
    
    <!-- <h2>All Projects ( -->
    <?php 
    // $conn = connect();
    // echo select_query("select count(*) as Projects from 
    // Project where isActive = 1", $conn)[0]['Projects'] 
    ?>
    <!-- )</h2>
    <table> -->
        <?php
        // $query = "SELECT * FROM Project";
        // $activeQuery = "SELECT isActive FROM Project";
        // $result = sqlsrv_query($conn, $query);
        // if(!$result)
        //     {
        //         exit("<p> Query Error: " . sqlsrv_error($conn) . "</p>");
        //     }

        // if(!$activeQuery)
        //     {
        //         exit("<p> Query Error: " . sqlsrv_error($conn) . "</p>");
        //     }
        ?>
        

        <!-- <tr>
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
        </tr> -->
        
        <?php
            // while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
            //     if($row['isActive'] == 1){
            //         echo "<tr><td>$row[Progress]</td>
            //         <td>$row[ID]</td>
            //         <td>$row[Name]</td>
            //         <td>$row[Total_Cost]</td>
            //         <td>$row[Street_Address]</td>
            //         <td>$row[City]</td>
            //         <td>$row[State]</td>
            //         <td>$row[Zip_Code]</td>
            //         <td>$row[Department_ID]</td>
            //         <td>$row[Budget]</td>

            //         </tr>";
            // }
        ?>
        
    <!-- </table> -->
    
    </center>

</body>


</html>
