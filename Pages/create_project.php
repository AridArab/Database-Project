<?php
include './Navbar.php';
include '../Logic/sqlconn.php';

$name = $cost = $addr = $city = $state = $zip_code =
    $d_id = $budget = '';

$nameErr = $costErr = $addrErr = $cityErr = $stateErr = $zip_codeErr =
    $d_idErr = $budgetErr = '';

if (isset($_POST['submit'])) {
    if (empty($_POST['name'])) {
        $nameErr = 'Name of project is required';
    } else {
        $name = filter_input(
            INPUT_POST,
            'name',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }
    if (empty($_POST['cost'])) {
        $costErr = 'Cost is required';
    } else {
        $cost = filter_input(
            INPUT_POST,
            'cost',
            FILTER_SANITIZE_NUMBER_INT
        );
    }
    if (empty($_POST['addr'])) {
        $addrErr = 'Sreet Address is required';
    } else {
        $addr = filter_input(
            INPUT_POST,
            'addr',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }
    if (empty($_POST['city'])) {
        $cityErr = 'City is required';
    } else {
        $city = filter_input(
            INPUT_POST,
            'city',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }
    if (empty($_POST['state'])) {
        $stateErr = 'State is required';
    } else {
        $state = filter_input(
            INPUT_POST,
            'state',
            FILTER_SANITIZE_FULL_SPECIAL_CHARS
        );
    }
    if (empty($_POST['zip_code'])) {
        $zip_codeErr = 'Zip Code is required';
    } else {
        $zip_code = filter_input(
            INPUT_POST,
            'zip_code',
            FILTER_SANITIZE_NUMBER_INT
        );
    }
    if (empty($_POST['budget'])) {
        $budgetErr = 'Budget is required';
    } else {
        $budget = filter_input(
            INPUT_POST,
            'budget',
            FILTER_SANITIZE_NUMBER_INT
        );
    }
    if (
        $nameErr == '' && $costErr == '' && $addrErr == '' && $cityErr == '' && $stateErr == '' && $zip_codeErr = '' &&
        $d_idErr == '' && $budgetErr == ''
    ) {

        $conn = connect();

        insert_query(
            "insert into Project (Progress, Name, Total_Cost, Street_Address, City, State, Zip_Code, Department_ID, Budget) values ('$name', '$cost', '$addr', 
            '$city', '$state', $zip_code, '1', '$budget')",
            $conn
        );


        sqlsrv_close($conn);

        session_start();
        $_SESSION['ID'] = $obj['ID'];

        header('Location: ./view_Projects.php');
    } else {
        echo 'Invalid info';
    }
}

?>

<html>
<header>
    <link rel="stylesheet" href="./signup.css">
</header>

<body>
    <center>
        <h1>Signup!</h1>
        <p>Please Enter Account Information</p>
        <form action="
        <?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>
        " method="POST" class="mt-4 w-75">
            <div class="mb-3">
                <label for="fName" class="form-label">First Name:</label>
                <input type="text" class="form-control 
            <?php echo $fNameErr ? 'is-invalid' : null ?>
            " id="fName" name="fName" placeholder="Enter your First Name">
                <div class="invalid-feedback">
                    <?php echo $fNameErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="lName" class="form-label">Last Name:</label>
                <input type="text" class="form-control 
            <?php echo $lNameErr ? 'is-invalid' : null ?>
            " id="lName" name="lName" placeholder="Enter your Last Name">
                <div class="invalid-feedback">
                    <?php echo $lNameErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="mName" class="form-label">Middle Initial:</label>
                <input type="text" class="form-control 
            <?php echo $mNameErr ? 'is-invalid' : null ?>
            " id="mName" name="mName" placeholder="Enter your Middle Initial">
                <div class="invalid-feedback">
                    <?php echo $mNameErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="birthday" class="form-label">Birthday:</label>
                <input type="text" class="form-control 
            <?php echo $birthdayErr ? 'is-invalid' : null ?>
            " id="birthday" name="birthday" placeholder="YYYY-MM-DD">
                <div class="invalid-feedback">
                    <?php echo $birthdayErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="city" class="form-label">City:</label>
                <input type="text" class="form-control 
            <?php echo $cityErr ? 'is-invalid' : null ?>
            " id="city" name="city" placeholder="Enter your City">
                <div class="invalid-feedback">
                    <?php echo $cityErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="state" class="form-label">State:</label>
                <input type="text" class="form-control 
            <?php echo $stateErr ? 'is-invalid' : null ?>
            " id="state" name="state" placeholder="Enter your State">
                <div class="invalid-feedback">
                    <?php echo $stateErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="zip_code" class="form-label">Zip Code:</label>
                <input type="text" class="form-control 
            <?php echo $zip_codeErr ? 'is-invalid' : null ?>
            " id="zip_code" name="zip_code" placeholder="Enter your Zip Code">
                <div class="invalid-feedback">
                    <?php echo $zip_codeErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="street" class="form-label">Street:</label>
                <input type="text" class="form-control 
            <?php echo $streetErr ? 'is-invalid' : null ?>
            " id="street" name="street" placeholder="Enter your Street">
                <div class="invalid-feedback">
                    <?php echo $streetErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="sex" class="form-label">Sex:</label>
                <input type="text" class="form-control 
            <?php echo $sexErr ? 'is-invalid' : null ?>
            " id="sex" name="sex" placeholder="Enter your Sex">
                <div class="invalid-feedback">
                    <?php echo $sexErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="phone" class="form-label">Phone Number:</label>
                <input type="text" class="form-control 
            <?php echo $phoneErr ? 'is-invalid' : null ?>
            " id="phone" name="phone" placeholder='No dash/space'>
                <div class="invalid-feedback">
                    <?php echo $phoneErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="mail" class="form-label">Email:</label>
                <input type="text" class="form-control 
            <?php echo $mailErr ? 'is-invalid' : null ?>
            " id="mail" name="mail" placeholder="Enter your Email">
                <div class="invalid-feedback">
                    <?php echo $mailErr; ?>
                </div>
            </div>
            <div class="mb-3">
                <label for="pass" class="form-label">Password:</label>
                <input type="text" class="form-control 
            <?php echo $passErr ? 'is-invalid' : null ?>
            " id="pass" name="pass" placeholder="Enter your Password">
                <div class="invalid-feedback">
                    <?php echo $passErr; ?>
                </div>
            </div>
            <p>Job Status:</p>
            <input type="radio" id="employee" name="isManager" value="Employee" style="margin-left: 75px" checked />
            <label for="html" style="text-align: left">Employee</label><br>
            <input type="radio" id="manager" name="isManager" value="Manager" style="margin-left: 75px">
            <label for="css" style="text-align: left">Manager</label><br>
            <p></p>
            <div class="mb-3">
                <input type="submit" name="submit" value="Send" class="btn btn-dark w-100">
            </div>
        </form>
        <a href="../">Login</a>
    </center>
</body>

</html>