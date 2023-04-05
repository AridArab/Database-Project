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
                        <div class="form-group">
                        <label for="progress">Progress:</label>
                        <input type="text" id="progress" name="progress" onblur="validateProgress()"><br>
                        <span id="progressError" style="color: red;"></span>
                        </div>
                        
                        <script>
                        function validateProgress() {
                          const progressInput = document.getElementById("progress");
                          const progressError = document.getElementById("progressError");
                          const progressRegex = /^\d+$/; // Regex to validate positive integers
                        
                          if (!progressRegex.test(progressInput.value) || progressInput.value < 0 || progressInput.value > 100) {
                            progressError.textContent = "Please enter a valid progress value between 0 and 100.";
                            progressInput.focus();
                          } else {
                            progressError.textContent = "";
                          }
                        }
                        </script>
                        
                            <label for="projectID">ID:</label>
                            <input type="text" id="projectID" name="projectID"><br>

                            <div class="form-group">
                            <label for="projectName">Name:</label>
                            <input type="text" id="projectName" name="projectName" onblur="validateProjectName()"><br>
                            <span id="projectNameError" style="color: red;"></span>
                            </div>

                            <script>
                            function validateProjectName() {
                            const projectNameInput = document.getElementById("projectName");
                            const projectNameError = document.getElementById("projectNameError");

                            if (projectNameInput.value.length > 50) {
                                projectNameError.textContent = "Please enter a project name with a maximum length of 50 characters.";
                                projectNameInput.focus();
                            } else {
                                projectNameError.textContent = "";
                            }
                            }
                            </script>

                            <div class="form-group">
                            <label for="cost">Total Cost:</label>
                            <input type="text" id="cost" name="cost" onblur="validateCost()"><br>
                            <span id="costError" style="color: red;"></span>
                            </div>

                            <script>
                            function validateCost() {
                            const costInput = document.getElementById("cost");
                            const costError = document.getElementById("costError");
                            const costRegex = /^\d+$/; // Regex to validate positive integers

                            if (!costRegex.test(costInput.value)) {
                                costError.textContent = "Please enter a valid numerical cost value.";
                                costInput.focus();
                            } else {
                                costError.textContent = "";
                            }
                            }
                            </script>

                            <div class="form-group">
                            <label for="address">Street Address:</label>
                            <input type="text" id="address" name="address" onblur="validateAddress()"><br>
                            <span id="addressError" style="color: red;"></span>
                            </div>

                            <script>
                            function validateAddress() {
                            const addressInput = document.getElementById("address");
                            const addressError = document.getElementById("addressError");

                            if (addressInput.value.length > 50) {
                                addressError.textContent = "Please enter a street address with a maximum length of 50 characters.";
                                addressInput.focus();
                            } else {
                                addressError.textContent = "";
                            }
                            }
                            </script>

                            <div class="form-group">
                            <label for="city">City:</label>
                            <input type="text" id="city" name="city" onblur="validateCity()"><br>
                            <span id="cityError" style="color: red;"></span>
                            </div>

                            <script>
                            function validateCity() {
                            const cityInput = document.getElementById("city");
                            const cityError = document.getElementById("cityError");

                            if (cityInput.value.length > 50) {
                                cityError.textContent = "Please enter a city name with a maximum length of 50 characters.";
                                cityInput.focus();
                            } else {
                                cityError.textContent = "";
                            }
                            }
                            </script>

                            <label for="state">State:</label>
                            <input type="text" id="state" name="state"><br>

                            <div class="form-group">
                            <label for="zip">ZipCode:</label>
                            <input type="text" id="zip" name="zip" onblur="validateZipCode()"><br>
                            <span id="zipError" style="color: red;"></span>
                            </div>

                            <script>
                            function validateZipCode() {
                            const zipCodeInput = document.getElementById("zip");
                            const zipCodeError = document.getElementById("zipError");
                            const zipCodeRegex = /^\d{5}$/; // Regex to validate 5 digits

                            if (!zipCodeRegex.test(zipCodeInput.value)) {
                                zipCodeError.textContent = "Please enter a valid 5-digit zipcode.";
                                zipCodeInput.focus();
                            } else {
                                zipCodeError.textContent = "";
                            }
                            }
                            </script>

                            <label for="deptID">Department ID:</label>
                            <input type="text" id="deptID" name="deptID"><br>

                            <div class="form-group">
                            <label for="budget">Budget:</label>
                            <input type="text" id="budget" name="budget" onblur="validateBudget()"><br>
                            <span id="budgetError" style="color: red;"></span>
                            </div>
                            
                            <script>
                            function validateBudget() {
                              const budgetInput = document.getElementById("budget");
                              const budgetError = document.getElementById("budgetError");
                            
                              if (isNaN(budgetInput.value)) {
                                budgetError.textContent = "Please enter a valid numerical budget value.";
                                budgetInput.focus();
                              } else {
                                budgetError.textContent = "";
                              }
                            }
                            </script>
                            
                            
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

                    <h3 class="top">Remove Project</h3>
                        <form action="delete_Project.php" method ="POST">
                            <label for="projectID">Enter ID:</label>
                            <input type="text" id="projectID" name="projectID"><br>

                            <input type="submit" value="Remove Project">
                        </form>
                    <h3 class="top">Generate Report</h3>
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

                                <input type="submit" value="Generate Report">
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
