<?php
    error_reporting(E_ERROR | E_PARSE);
    include './navbar.php';
    include '../Logic/sqlconn.php';

    if($_SESSION['obj']['Is_Manager'] != 2){
        echo '<script type="text/javascript">';
        echo "window.location.href='./home.php'";
        echo '</script>';
        exit();
    }

    $conn = connect();

    $result = sqlsrv_query($conn,
        "SELECT D.Phone_Number, D.Dept_Name, D.Number_of_Employees, D.Email_Address, D.Dept_Budget, D.ID, D.Manager_ID, E.First_Name, E.Last_Name, DL.Street_Address, DL.City, DL.State, DL.Zip_Code FROM Department AS D, Employee AS E, Dept_Locations AS DL WHERE E.ID = D.Manager_ID and DL.Department_ID = D.ID"
    );

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
        <button id = "see" onClick="showHide('add');"
        class="showButton">Add Departments</button>
        <button id = "hide" onClick="showHide('add');"
        style="display:none" class="showButton">Hide Add Departments</button>
        <div id="add" style="display:none">
        <table><div class="forms">
        <form action="" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" required>
            <label for="mail">Email:</label>
            <input type="email" id="mail" required><br>
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
            <input type="number" id="phone" required>    
            <label for="budget">Budget:</label>
            <input type="number" id="budget"><br>
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
            <input type="text" id="street" required>
            <label for="city">City:</label>
            <input type="text" id="city" required><br>
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
            <input type="text" id="state" required>
            <label for="zipcode">Zipcode:</label>
            <input type="number" id="zipcode" required><br>
            <span id="stateError" style="color: red;"></span>
            <span id="zipcodeError" style="color: red;"></span><br>
            <label for="manager">Manager:</label>
            <input type="text" id="manager">
            <input type="submit" value="Add Department">         
        </form>
        </div>
        </table>
        </div>
        
        <p><?php
         while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            echo
            "<div class='department'>
            $row[Dept_Name]<br>
            Email: $row[Email_Address]<br>
            Phone: $row[Phone_Number]<br>
            Address: $row[Street_Address] $row[City], $row[State] $row[Zip_Code]<br>
            Manager: $row[First_Name] $row[Last_Name]<br>
            Employee Count: $row[Number_of_Employees]<br>
            Budget: \$$row[Dept_Budget]
            </div>";
         }
        ?></p>
    </center>
</body>

</html>