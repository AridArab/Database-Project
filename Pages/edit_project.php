<?php
include './navbar.php';
include '../Logic/sqlconn.php';

$serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
$connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", "Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
?>

<html>
    <header>
    <script type="text/javascript">
        function showHide(idName){
            var temp = document.getElementById(idName);
            if(temp.style.display === "none")
                temp.style.display = "block";
            else
                temp.style.display = "none";
        }
    </script>
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

    tr:nth-child(even) {
        background-color: rgba(225, 225, 225, 0.75);
    }

    form {
        width: 100%; 
        max-width: 600px; 
        background-color: rgba(225, 225, 225, 0.75);
        border-color: rgb(0, 0, 0);
        border-style: solid;
        border-radius: 10px;
        padding: 20px;
        margin-bottom: 20px;
    }

    form h3 {
        margin-top: 0;
        margin-bottom: 20px;
        font-size: 24px;
    }

    @media (max-width: 768px) {
        form {
            padding: 10px; 
            font-size: 14px; 
        }
        label {
            width: 100%; 
            text-align: left; 
        }
    }
</style>

    </header>

    <body>
        <center>
            <h1>Projects</h1>
        </center>
        <?php
        $connName = connect();
    
        $resultName = sqlsrv_query($connName, 
            "select P.Name, P.ID 
            from Employee AS M, Department AS D, Project AS P
            where M.ID = ".$_SESSION['obj']['ID']." AND D.Manager_ID = M.ID AND P.Department_ID = D.ID and P.IsActive = 1" 
        );

        $projects = array();

        while($row = sqlsrv_fetch_array($resultName, SQLSRV_FETCH_ASSOC)){
            array_push($projects, $row);
        }
    
        $conn = sqlsrv_connect($serverName, $connectionInfo);
        if(!$conn) {
            exit("<p> Connection Error: " . sqlsrv_connect_error() . "</p>");
        }
        ?>
            <center>
            <button id = "see" onClick="showHide('edit'); showHide('see'); showHide('hide')" 
            class="showButton">Edit Projects</button>
            <button id = "hide" onClick="showHide('edit'); showHide('see'); showHide('hide')" 
            style="display:none" class="showButton">Hide Edits Project</button>
            <div id="edit" style="display:none">
            <table>
                <tr>
                    <td>
                        <h3 class="top">Add Project</h3>
                        <form action="add_Project.php" method ="POST">
                        <div class="form-group">

                        <label for="progress">Progress:</label>
                        <input type="text" id="progress" name="progress" onblur="validateProgress()" required><br>
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


                            <div class="form-group">
                            <label for="projectName">Name:</label>
                            <input type="text" id="projectName" name="projectName" onblur="validateProjectName()"required><br>
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
                            <input type="text" id="cost" name="cost" onblur="validateCost()"required><br>
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
                            <input type="text" id="address" name="address" onblur="validateAddress()"required><br>
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
                            <input type="text" id="city" name="city" onblur="validateCity()"required><br>
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
                            <input type="text" id="zip" name="zip" onblur="validateZipCode()"required><br>
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
                            <div>
                            <label for="deptID">Department ID:</label>
                            <input type="text" id="deptID" name="deptID" onblur="validatedeptID()" required><br>
                            <span id="deptidError" style="color: red;"></span>
                            </div>

                            <script>
                                function validatedeptID() {
                                const deptID = document.getElementById("deptID");
                                const deptidError = document.getElementById("deptidError");
                                const costRegex = /^\d+$/; // Regex to validate positive integers

                                if (!costRegex.test(deptID.value)) {
                                    deptidError.textContent = "Please enter a valid numerical Dept ID value.";
                                    deptID.focus();
                                } else {
                                    deptidError.textContent = "";
                                }
                                }
                                </script>

                            <div class="form-group">
                            <label for="budget">Budget:</label>
                            <input type="text" id="budget" name="budget" onblur="validateBudget()"required><br>
                            <span id="budgetError" style="color: red;"></span>
                            </div>
                            
                            <script>
                            function validateBudget() {
                            const budgetInput = document.getElementById("budget");
                            const budgetError = document.getElementById("budgetError");
                            const budgetRegex = /^\d+$/; // Regex to validate positive integers

                            if (!budgetRegex.test(budgetInput.value)) {
                                budgetError.textContent = "Please enter a valid numerical budget value.";
                                budgetInput.focus();
                            } else {
                                budgetError.textContent = "";
                            }
                            }
                            </script>


                            <label for="startdate">Start Date:</label>
                            <input type="text" id="startdate" name="startdate" pattern="\d{4}-\d{2}-\d{2}" title="Please enter a date in the format yyyy-mm-dd" placeholder="yyyy-mm-dd"><br>

                            <label for="deadline">Deadline:</label>
                            <input type="text" id="deadline" name="deadline" pattern="\d{4}-\d{2}-\d{2}" title="Please enter a date in the format yyyy-mm-dd" placeholder="yyyy-mm-dd"><br>
                            <input type="submit" value="Add Project">
                        </form>
                    </td>
                    <td>

                    <h3 class="top">Update Project</h3>
                        <form action="update_Project.php" method="POST" onsubmit="return validateUpdateForm()">
                        <select name="project_id">
                            <option selected>Choose Project</option>
                            <?php foreach ($projects as $project) : ?>
                                <option value="<?php echo $project['ID']; ?>">
                                    <?php echo $project['Name'] . ' ID: ' . $project['ID']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                            <br>
                            <label for="column">Select Category:</label>
                            <select name="dropdown_Select">
                                <option value="Progress">Progress</option>
                                <option value="Name">Name</option>
                                <option value="Total Cost">Total Cost</option>
                                <option value="Street Address">Street Address</option>
                                <option value="City">City</option>
                                <option value="State">State</option>
                                <option value="Zip Code">Zip Code</option>
                                <option value="Department ID">Department ID</option>
                                <option value="Budget">Budget</option>
                            </select><br>

                            <label for="update">Enter new value:</label>
                            <input type="text" id="update" name="update" required><br>
                            <div id="errorMessage"></div>
                            <input type="submit" value="Update Project">
                        </form>

                        <script>
                        function validateUpdateForm() {
                            var category = document.getElementsByName("dropdown_Select")[0].value;
                            var value = document.getElementById("update").value;

                            if (category === "Zip Code") {
                                if (!/^\d{5}$/.test(value)) {
                                    alert("Zip Code must be a 5-digit number");
                                    return false;
                                }
                            } else if (category === "Progress") {
                                if (isNaN(value) || value < 0 || value > 100) {
                                    alert("Progress must be a number between 0 and 100");
                                    return false;
                                }
                            } else if (category === "Total Cost") {
                                if (isNaN(value)) {
                                    alert("Total Cost must be a numerical value");
                                    return false;
                                }
                            } else if (category === "Department ID") {
                                if (isNaN(value)) {
                                    alert("Department ID must be a numerical value");
                                    return false;
                                }
                            } else if (category === "Budget") {
                                if (isNaN(value)) {
                                    alert("Budget must be a numerical value");
                                    return false;
                                }
                            }

                            return true;
                        }
                        </script>

                    </td>
                    <td>
                    <h3 class="top">Remove Project</h3>
                    <form action="delete_Project.php" method="POST">
                        <select name="project_id">
                            <option selected>Choose Project</option>
                            <?php foreach ($projects as $project) : ?>
                                <option value="<?php echo $project['ID']; ?>">
                                    <?php echo $project['Name'] . ' ID: ' . $project['ID']; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                        <input type="submit" value="Remove Project">
                    </form>
                    </td>
                </tr>

            </table>
        </div>
    <?php
        // check if a search ID was submitted
    if(isset($_POST['searchID']) && $_POST['searchID'] != '') {
            $searchID = $_POST['searchID'];
            $query = "SELECT * FROM Project WHERE Project.Name LIKE '%$searchID%' AND isActive = 1";
        } else {
            $query = "SELECT * FROM Project WHERE isActive = 1";
        }

        // execute the query
        $result = sqlsrv_query($conn, $query);
        if(!$result) {
            exit("<p> Query Error: " . sqlsrv_error($conn) . "</p>");
        }
    ?>
    <p></p>
    <button id = "seep" onClick="showHide('searchp'); showHide('seep'); showHide('hidep')" 
    class="showButton">Search Projects</button>
    <button id = "hidep" onClick="showHide('searchp'); showHide('seep'); showHide('hidep')" 
    style="display:none" class="showButton">Hide Search Projects</button>
    <div id="searchp" style="display:none">
    <h3 class="top">Search Project</h3>
    <form action="edit_Project.php" method="POST">
        <label for="searchID">Search:</label>
        <input type="text" id="searchID" name="searchID" placeholder="Search project name" required>
        <input type="submit" value="Search">
        <button type="button" onclick="window.location.href='edit_Project.php'">Show All Projects</button>
        </form>
    </div>
    <p></p>
    <table>
        <tr>
            <td>ID</td>
            <td>Progress</td>
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
            while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)) {
                if($row['isActive'] == 1){
                echo "<tr><td>$row[ID]</td>
                <td>$row[Progress]</td>
                <td>$row[Name]</td>
                <td>\$$row[Total_Cost]</td>
                <td>$row[Street_Address]</td>
                <td>$row[City]</td>
                <td>$row[State]</td>
                <td>$row[Zip_Code]</td>
                <td>$row[Department_ID]</td>
                <td>\$$row[Budget]</td></tr>";
            }
        }
        ?>
    </table>

            </center>
        </body>
    </html>