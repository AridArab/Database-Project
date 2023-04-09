<?php 
include './Navbar.php';
include '../Logic/sqlconn.php';

$input = '';
$inputErr = '';

if (isset($_POST['submit'])) {
    if (empty($_POST["setInput"]) && $_POST["column"] != 'Middle_Initial') {
        $inputErr = 'Please enter an input';
    }
    else if ($_POST["column"] == 'First_Name') {
        if(strlen($_POST['setInput']) > 50){
            $inputErr = 'First Name is too long';
        }
        else{
            $input = filter_input(
                INPUT_POST,
                'setInput',
                FILTER_SANITIZE_FULL_SPECIAL_CHARS
            );
            $input = "'".strtoupper($input)."'";
        }
    }
    else if ($_POST["column"] == 'Last_Name') {
        if(strlen($_POST['setInput']) > 50){
            $inputErr = 'Last Name is too long';
        }
        else{
            $input = filter_input(
                INPUT_POST,
                'setInput',
                FILTER_SANITIZE_FULL_SPECIAL_CHARS
            );
            
            $input = "'".strtoupper($input)."'";
        }
    }
    else if ($_POST["column"] == 'Middle_Initial') {
        if (empty($_POST['setInput'])) {
            $input = "null";
        }
        else if(strlen($_POST['setInput']) > 1){
            $inputErr = 'Only enter the initial';
        }
        else{
            $input = filter_input(
                INPUT_POST,
                'setInput',
                FILTER_SANITIZE_FULL_SPECIAL_CHARS
            );
            $input = "'".strtoupper($input)."'";
        }
    }
    else if ($_POST["column"] == 'Birthday') {
        if (!is_numeric(substr($_POST['setInput'], 0, 4)) || substr($_POST['setInput'], 4, 1) != '-' ||
        !is_numeric(substr($_POST['setInput'], 5, 2)) || substr($_POST['setInput'], 7, 1) != '-' ||
        !is_numeric(substr($_POST['setInput'], 8, 2))) {
            $inputErr = 'Birthday needs to be in YYYY-MM-DD';
        }
        else if (!checkdate((int)substr($_POST['setInput'], 5, 7), (int)substr($_POST['setInput'], 8, 10), 
        (int)substr($_POST['setInput'], 0, 4))){
            $inputErr = 'Birthday needs to be a real date';
        }
        else{
            $input = filter_input(
                INPUT_POST,
                'setInput',
                FILTER_SANITIZE_NUMBER_INT
            );
        }
    }
    else if ($_POST["column"] == 'City') {
        if(strlen($_POST['setInput']) > 50){
            $inputErr = 'City is too long';
        }
        else{
            $input = filter_input(
                INPUT_POST,
                'setInput',
                FILTER_SANITIZE_FULL_SPECIAL_CHARS
            );
            
            $input = "'".strtoupper($input)."'";
        }
    }
    else if ($_POST["column"] == 'State') {
        if(strlen($_POST['setInput']) > 50){
            $inputErr = 'State is too long';
        }
        else{
            $input = filter_input(
                INPUT_POST,
                'setInput',
                FILTER_SANITIZE_FULL_SPECIAL_CHARS
            );
            
            $input = "'".strtoupper($input)."'";
        }
    }
    else if ($_POST["column"] == 'Zip_Code') {
        if (!is_numeric($_POST['setInput'])){
            $inputErr = 'Zip Code needs to be a number';
        }
        else if (strlen($_POST['setInput']) != 5){
            $inputErr = 'Zip Code is 5 digits';
        }  
        else{
            $input = filter_input(
                INPUT_POST,
                'setInput',
                FILTER_SANITIZE_NUMBER_INT
            );
        }
    }
    else if ($_POST["column"] == 'Street_Address') {
        if(strlen($_POST['setInput']) > 50){
            $inputErr = 'Street address is too long';
        }
        else{
            $input = filter_input(
                INPUT_POST,
                'setInput',
                FILTER_SANITIZE_FULL_SPECIAL_CHARS
            );
            
            $input = "'".strtoupper($input)."'";
        }
    }
    else if ($_POST["column"] == 'Sex') {
        if(strlen($_POST['setInput']) > 50){
            $inputErr = 'Sex is too long';
        }
        else{
            $input = filter_input(
                INPUT_POST,
                'setInput',
                FILTER_SANITIZE_FULL_SPECIAL_CHARS
            );
            
            $input = "'".strtoupper($input)."'";
        }
    }
    else if ($_POST["column"] == 'Phone_Number') {
        if (!is_numeric($_POST['setInput'])){
            $inputErr = 'Phone needs to be a number';
        }
        else if (strlen($_POST['setInput']) != 10){
            $inputErr = 'Phone is 10 digits';
        }  
        else{
            $input = filter_input(
                INPUT_POST,
                'setInput',
                FILTER_SANITIZE_NUMBER_INT
            );
        }
    }
    else if ($_POST["column"] == 'Email_Address') {
        if(strlen($_POST['setInput']) > 50){
            $inputErr = 'Email is too long';
        }
        else if (!str_contains($_POST['setInput'], '@')){
            $inputErr = 'Not a valid Email';
        }   
        else{
            $input = filter_input(
                INPUT_POST,
                'setInput',
                FILTER_SANITIZE_EMAIL
            );
            
            $input = "'".strtolower($input)."'";
        }
    }
    else if ($_POST["column"] == 'Password') {
        if(strlen($_POST['setInput']) > 255){
            $inputErr = 'Password is too long';
        }
        else{
            $input = password_hash($_POST["setInput"], PASSWORD_DEFAULT);
        }
    }
    else if ($_POST["column"] == 'Is_Manager') {
        if($_POST['setInput'] == '1'){
            $input = $_POST['setInput'];
        }
        else if($_POST['setInput'] == '0'){
            $input = $_POST['setInput'];
        }
        else{
            $inputErr = 'Please enter 1 for manager or 0 for employee';
        }
    }
    else if ($_POST["column"] == 'Salary') {
        if (!is_numeric($_POST['setInput'])){
            $inputErr = 'Salary needs to be a number';
        }
        else{
            $input = filter_input(
                INPUT_POST,
                'setInput',
                FILTER_SANITIZE_NUMBER_INT
            );
        }
    }
    if ($inputErr == '') {
        $conn = connect();

        sqlsrv_query($conn, "update Employee set ".$_POST['column']." = $input where ID = ".$_SESSION['obj']['ID']);

        $obj = select_query("select * from Employee where ID = ".$_SESSION['obj']['ID'], $conn);

        $_SESSION['obj'] = $obj;

        sqlsrv_close($conn);

        header('Location: ./view_Profile.php');
    }
}
?>

<html>
<header>
    <style>
        label {
            display: inline-block;
            width: 125px;
            text-align: right;
        }
    </style>
</header>

<body>
    <center>
        <h1>Edit Your Profile</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="POST" class="mt-4 w-75">
        <select name="column">
            <option value="First_Name">First Name</option>
            <option value="Last_Name">Last Name</option>
            <option value="Middle_Initial">Middle Initial</option>
            <option value="Birthday">Birthday</option>
            <option value="City">City</option>
            <option value="State">State</option>
            <option value="Zip_Code">Zip Code</option>
            <option value="Street_Address">Address</option>
            <option value="Sex">Sex</option>
            <option value="Phone_Number">Phone</option>
            <option value="Email_Address">Email</option>
            <option value="Password">Password</option>
            <option value="Is_Manager">Manager Status</option>
            <?php 
                if($_SESSION['obj']['Is_Manager'] == 1){
                  echo "<option value='Salary'>Salary</option>";
                }
            ?>
        </select>  
        <p></p>
        <div class="mb-3" style="position:relative; left:-65px">
            <label for="setInput" class="form-label">Value:</label>
            <input style="width:142px" type="text" class="form-control 
        <?php echo $inputErr ? 'is-invalid' : null ?>
        " id="setInput" name="setInput" placeholder='Enter a Value'>
            <div class="invalid-feedback" style="color: rgb(255, 0, 0); position:relative; left:65px">
                <?php echo $inputErr; ?>
            </div>
        </div>
        <p></p>
        <div class="mb-3">
            <input type="submit" name="submit" value="Submit" class="btn btn-dark w-100">
        </div>
        </form>
    </center>
</body>

</html>