<?php 
  error_reporting(E_ERROR | E_PARSE);
  include './navbar.php';
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
              $input = "'".$input."'";
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
  
          $obj = select_query("select * from Employee where ID = ".$_SESSION['obj']['ID'], $conn)[0];
  
          $_SESSION['obj'] = $obj;
  
          sqlsrv_close($conn);
      }
      else{
        $invalid = true;
      }
  
  }
?>

<html>
    <script type="text/javascript">
        function showHide(idName){
            var temp = document.getElementById(idName);
            if(temp.style.display === "none")
                temp.style.display = "block";
            else
                temp.style.display = "none";
        }
    </script>
<header>
    <style>
        table {
          width: 50%;
        }

        td {
          border: 1px solid rgb(0, 0, 0);
          text-align: left;
        }

        tr:nth-child(even) {
            background-color: rgba(225, 225, 225, 0.75);
        }
        
        .vpb {
            display: grid;
            width: 450px;
                    
            background-color: rgba(225, 225, 225, 0.75);
            border-color:rgb(0, 0, 0);
            border-style: solid;
            border-radius: 10px;
        }
    </style>
</header>

<body>
    <center>
        <h1>Your Profile</h1>
        <button id = "see" onClick="showHide('edit'); showHide('see'); showHide('hide')" 
        class="showButton">Edit Profile</button>
        <button id = "hide" onClick="showHide('edit'); showHide('see'); showHide('hide')" 
        style="display:none" class="showButton">Hide Edit Profile</button>
        <p></p>
        <div id="edit" class = "vpb" style="padding:10px; display:none">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="POST" class="mt-4 w-75">
        <label style="display:inline-block; width:auto" for="column" class="form-label">Select a row:</label>
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
            <?php 
                if($_SESSION['obj']['Is_Manager'] == 1){
                  echo "<option value='Salary'>Salary</option>";
                }
            ?>
        </select>  
        <p></p>
        <div class="mb-3">
            <label style="width:auto" for="setInput" class="form-label">New Value:</label>
            <input style="width:300px" type="text" class="form-control 
        <?php echo $inputErr ? 'is-invalid' : null ?>
        " id="setInput" name="setInput" placeholder='Enter a new value'>
        </div>
        <p></p>
        <div class="mb-3">
            <input type="submit" name="submit" value="Submit" class="btn btn-dark w-100">
        </div>
        </form>  
        </div>
        <div class="invalid-feedback" style="color: rgb(255, 0, 0)">
            <?php echo $inputErr; ?>
        </div>
        <p></p>
        <table>
          <tr>
            <td>Name</td>
            <td>
                <?php 
                echo $_SESSION['obj']['First_Name']." ".$_SESSION['obj']['Middle_Initial'].
                " ".$_SESSION['obj']['Last_Name'];
                ?>
            </td>
          </tr>
          <tr>
            <td>ID</td>
            <td>
                <?php 
                echo $_SESSION['obj']['ID'];
                ?>
            </td>
          </tr>
          <tr>
            <td>Job Status</td>
            <td>
                <?php 
                if ($_SESSION['obj']['Is_Manager'] == 2){
                    echo "Admin";
                    }
                else if ($_SESSION['obj']['Is_Manager'] == 1){
                  echo "Manager";
                }
                else{
                  echo "Employee";
                }
                ?>
            </td>
          </tr>
          <tr>
            <td>Department</td>
            <td>
                <?php 
                echo $_SESSION['obj']['Department_ID'];
                ?>
            </td>
          </tr>
          <tr>
            <td>Email</td>
            <td>
                <?php 
                echo $_SESSION['obj']['Email_Address'];
                ?>
            </td>
          </tr>
          <tr>
            <td>Phone</td>
            <td>
                <?php 
                echo $_SESSION['obj']['Phone_Number'];
                ?>
            </td>
          </tr>
          <tr>
            <td>Address</td>
            <td>
                <?php 
                echo $_SESSION['obj']['Street_Address']." ".$_SESSION['obj']['City'].", ".
                $_SESSION['obj']['State']." ".$_SESSION['obj']['Zip_Code'];
                ?>
            </td>
          </tr>
          <tr>
            <td>Birthday (M/D/Y)</td>
            <td>
                <?php 
                echo ($_SESSION['obj']['Birthday']->format('m-d-Y'));
                ?>
            </td>
          </tr>
          <tr>
            <td>Sex</td>
            <td>
                <?php 
                echo $_SESSION['obj']['Sex'];
                ?>
            </td>
          </tr>
          <tr>
            <td>Salary</td>
            <td>
                <?php 
                echo $_SESSION['obj']['Salary'];
                ?>
            </td>
          </tr>
        </table>
    </center>
</body>

</html>