<?php
    error_reporting(E_ERROR | E_PARSE);
    include './Navbar.php';
    include '../Logic/sqlconn.php';

    if($_SESSION['obj']['Is_Manager'] != 2){
        echo '<script type="text/javascript">';
        echo "window.location.href='./home.php'";
        echo '</script>';
        exit();
    }

    $conn = connect();

    $result = sqlsrv_query($conn,
        "SELECT D.Phone_Number, D.Dept_Name, D.Email_Address, D.Dept_Budget, D.ID, D.Manager_ID, E.First_Name, E.Last_Name, DL.Street_Address, DL.City, DL.State, DL.Zip_Code FROM Department AS D, Employee AS E, Dept_Locations AS DL WHERE E.ID = D.Manager_ID and DL.Department_ID = D.ID and D.IsActive = 1"
    );

    $connName = connect();
    
    $resultName = sqlsrv_query($connName, 
        "select D.Dept_Name, D.ID from Department AS D WHERE D.IsActive = 1" 
    );

    $depts = array();

    while($rowName = sqlsrv_fetch_array($resultName, SQLSRV_FETCH_ASSOC)){
        array_push($depts, $rowName);
    }

    $resultManager = sqlsrv_query($connName,
        "SELECT E.First_Name, E.Last_Name, E.ID FROM Employee AS E WHERE E.Is_Manager = 1"
    );

    $mangs = array();

    while ($rowManage = sqlsrv_fetch_array($resultManager, SQLSRV_FETCH_ASSOC)){
        array_push($mangs, $rowManage);
    }

    $resultAdmin = sqlsrv_query($connName,
        "SELECT E.First_Name, E.Last_Name, E.ID FROM Employee AS E WHERE E.Is_Manager = 2"
    );

    $admins = array();

    while ($rowAdmin = sqlsrv_fetch_array($resultAdmin, SQLSRV_FETCH_ASSOC)) {
        array_push($admins, $rowAdmin);
    }

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
        .department {
            border: 1px solid rgb(0, 0, 0);
            text-align: left;
            padding-left: 25px;
            padding-right: 25px;
            padding-top: 40px;
            padding-bottom: 40px;
            margin-top: 10px;
            margin-bottom: 10px;
            width: 65%;
            background-color: rgba(225, 225, 225, 0.75);
            border-radius: 25px;            
        }
        .forms {
            border: 2px solid rgb(0, 0, 0);
            text-align: center;
            padding-left: 8px;
            padding-right: 8px;
            padding-top: 4px;
            padding-bottom: 4px;
            margin-top: 5px;
            margin-bottom: 5px;
            margin-left: 2px;
            margin-right: 2px;
            width: 35%;
            background-color: rgba(108, 200, 150, 0.75);
            border-radius: 25px;
        }
    </style>
</header>

<body>
    <center>
        <h1>Admin</h1><br>
        <button id = "see" style="width: 20ch;" onClick="showHide('add');"
        class="showButton">Add Departments</button>
        <button id = "hide" onClick="showHide('add');"
        style="display:none" class="showButton">Hide Add Departments</button>
        <div id="add" style="display:none">
        <table><div class="forms">
        <form action="add_Department.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" onblur="validateName()" required>
            <label for="mail">Email:</label>
            <input type="email" id="mail" name="mail" onblur="validateMail()" required><br>
            <span id="nameError" style="color: red;"></span>
            <span id="mailError" style="color: red;"></span><br>
            <script>
                function validateName() {
                    const nameInput = document.getElementById("name");
                    const nameError = document.getElementById("nameError")

                    if (nameInput.value.length > 50) {
                        nameError.textContent = "Please enter a department name with a maximum length of 50 characters.";
                        nameInput.focus();
                    } else {
                        nameError.textContent = "";
                    }
                }
                function validateMail() {
                    const mailInput = document.getElementById("mail");
                    const mailError = document.getElementById("mailError");

                    if (mailInput.value.length > 50) {
                        mailError.textContent = "Please enter an email address with a maxiumum length of 50 characters.";
                        mailInput.focus()
                    } else {
                        mailError.textContent = "";
                    }
                }
            </script>
            <label for="phone">Phone:</label>
            <input type="number" id="phone" name="phone" onblur="validatePhone()" required>    
            <label for="budget">Budget:</label>
            <input type="number" id="budget" name="budget" onblur="validateBudget()"><br>
            <span id="budgetError" style="color: red;"></span>
            <span id="phoneError" style="color: red;"></span><br>
            <script>
                function validatePhone() {
                    const phoneInput = document.getElementById("phone");
                    const phoneError = document.getElementById("phoneError")
                    const phoneRegex = /^\d+$/;

                    if (!phoneRegex.test(phoneInput.value) && phoneInput.value.length > 10) {
                        phoneError.textContent = "Please enter a valid phone number";
                        phoneInput.focus()
                    } else {
                        phoneError.textContent = "";
                    }
                }
                function validatebudget() {
                    const budgetInput = document.getElementById("budget");
                    const budgetError = document.getElementById("budgetError");
                    const budgetRegex = /^\d+$/;

                    if (!budgetRegex.test(budgetInput.value)) {
                        budgetError.textContent = "Please enter a valid numerical budget.";
                        budgetInput.focus();
                    } else {
                        budgetError.textContent = "";
                    }
                }
            </script>
            <label for="street">Street:</label>
            <input type="text" id="street" name="street" onblur="validateStreet()" required>
            <label for="city">City:</label>
            <input type="text" id="city" name="city" onblur="validateCity()" required><br>
            <span id="streetError" style="color: red;"></span>
            <span id="cityError" style="color: red;"></span><br>
            <script>
                function validateStreet() {
                    const streetInput = document.getElementById("street");
                    const streetError = document.getElementById("streetError");

                    if (streetInput.value.length > 50) {
                        streetError.textContent = "Please enter a street address with a maximum length of 50 characters";
                        streetInput.focus();
                    } else {
                        streetError.textContent = "";
                    }
                }
                function validateCity() {
                    const cityInput = document.getElementById("city");
                    const cityError = document.getElementById("cityError");

                    if (cityInput.value.length > 50) {
                        cityError.textContent = "Please enter a city with a maximum length of 50 characters";
                        cityInput.focus();
                    } else {
                        cityError.textContent = "";
                    }
                }
            </script>
            <label for="state">State:</label>
            <input type="text" id="state" name="stateName" onblur="validateState()"required>
            <span id="stateError" style="color: red;"></span>
            <script>
                function validateState() {
                const stateNameInput = document.getElementById("state");
                const stateNameError = document.getElementById("stateError");

                if (stateNameInput.value.length != 2) {
                    stateNameError.textContent = "Abbrevation only.";
                    stateNameInput.focus();
                } else {
                    stateNameError.textContent = "";
                }
                }
            </script>
            <label for="zipcode">Zipcode:</label>
            <input type="number" id="zipcode" name="zipcode" onblur="validateZipCode()"required><br>
            <span id="zipError" style="color: red;"></span><br>


            <script>
            function validateZipCode() {
                const zipCodeInput = document.getElementById("zipcode");
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

                      
            <label for="manager">Manager ID:</label>
            <input type="number" name="manager" id="manager"><br><br>
            <input type="submit" value="Add Department">
            <span id="managerError" style="color:red;"></span><br>    
            <script>
                function validateZipCode() {
                    const managerInput = document.getElementById("zipcode");
                    const managerError = document.getElementById("zipError");
                    const managerRegex = /^\d+$/; // Regex to validate 5 digits

                    if (!managerRegex.test(managerInput.value)) {
                        mangaerError.textContent = "Please enter a valid 5-digit zipcode.";
                        managerInput.focus();
                    } else {
                        managerError.textContent = "";
                    }
                }
            </script>
        </form>
        </div>
        </table>
        </div>
        <div>
            <button id="see-update" onClick="showHide('update');" style="width: 20ch;" class="showButton">Update Department</button>
            <button id="hide-update" onClick="showHide('update');" style="display:none" class="showButton">Hide Update Departments</button>
            <div id="update" style="display:none">
                    <table>
                        <div class="forms">
                        <form action="update_Department.php" method="POST">
                            <select required name="update_id">
                                <option value="" selected>Choose Department</option>
                                <?php foreach ($depts as $dept) : ?>
                                    <option value="<?php echo $dept['ID']; ?>">
                                        <?php echo $dept['Dept_Name'] . ' ID: ' . $dept['ID']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <br>
                            <label for="column">Select Category:</label>
                            <select name="dropdown_Select">
                                <option value="Name">Name</option>
                                <option value="Email">Email</option>
                                <option value="Phone Number">Phone Number</option>
                                <option value="Street Address">Street Address</option>
                                <option value="City">City</option>
                                <option value="State">State</option>
                                <option value="Zip Code">Zip Code</option>
                                <option value="Budget">Budget</option>
                            </select>
                            <br>
                            <label for="update">Enter new value:</label>
                            <input type="text" id="update" name="update" required><br>
                            <div id="errorMessage"></div>
                            <input type="submit" value="Update Department">
                        </form>
                        </div>
                    </table>
                </div>
                    </div>
                <div>
            <button id="see-delete" onClick="showHide('delete');" style="width: 20ch;" class="showButton">Delete Department</button>
            <button id="hide-delete" onClick="showHide('delete');" style="display:none" class="showButton">Hide Delete Departments</button>
            <div id="delete" style="display:none">
                <table>
                    <div class="forms">
                        <form action="delete_Department.php" method="POST">
                            <select required name="delete_id">
                                <option value="" selected>Choose Department</option>
                                <?php foreach ($depts as $dept) : ?>
                                    <option value="<?php echo $dept['ID']; ?>">
                                        <?php echo $dept['Dept_Name'] . ' ID: ' . $dept['ID']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <br>
                            <input type="submit" value="Delete Department">
                            </form>
                        </div>
                    </table>
                </div>
            </div>
            <button id="see-admin-add" onClick="showHide('administrate-add');" style="width: 20ch;" class="showButton">Add Admin</button>
            <button id="hide-admin-add" onClick="showHide('administrate-add');" style="display:none" class="showButton">Hide Add Admin</button>
            <div id="administrate-add" style="display:none">
                <table>
                    <div class="forms">
                        <form action="add_Admin.php" method="POST">
                            <select required name="add_admin">
                                <option value="" selected>Choose Manager</option>
                                <?php foreach ($mangs as $mang) : ?>
                                    <option value="<?php echo $mang['ID']; ?>">
                                        <?php echo $mang['First_Name'] . ' ' . $mang['Last_Name'] . ' ID: ' . $mang['ID']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <br>
                            <input type="submit" value="Add Admin">
                        </form>
                    </div>
                </table>
            </div>
            <br>
            <button id="see-admin-remove" onClick="showHide('administrate-remove');" style="width: 20ch;" class="showButton">Remove Admin</button>
            <button id="hide-admin-remove" onClick="showHide('administrate-remove');" style="display:none" class="showButton">Hide Remove Admin</button>
            <div id="administrate-remove" style="display:none">
                <table>
                    <div class="forms">
                        <form action="remove_Admin.php" method="POST">
                            <select required name="remove_admin">
                                <option value="" selected>Choose Admin</option>
                                <?php foreach ($admins as $admin) : ?>
                                    <option value="<?php echo $admin['ID']; ?>">
                                        <?php echo $admin['First_Name'] . ' ' . $admin['Last_Name'] . ' ID: ' . $admin['ID']; ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                            <br>
                            <input type="submit" value="Remove Admin">
                        </form>
                    </div>
                </table>
            </div>
        </div>
        <p><?php
         $query = "SELECT * FROM Department WHERE isActive = 1";
         $resultDisplay = sqlsrv_query($conn, $query);

         while($rowDisplay=sqlsrv_fetch_array($resultDisplay, SQLSRV_FETCH_ASSOC)){
             if($rowDisplay['isActive'] == 1){
                while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                    echo
                    "<div class='department'>
                    $row[Dept_Name]<br>
                    Email: $row[Email_Address]<br>
                    Phone: $row[Phone_Number]<br>
                    Address: $row[Street_Address] $row[City], $row[State] $row[Zip_Code]<br>
                    Manager: $row[First_Name] $row[Last_Name]<br>
                    Budget: \$$row[Dept_Budget]
                    </div>";
                    }
            }
        }
            ?></p>
    </center>
</body>

</html>