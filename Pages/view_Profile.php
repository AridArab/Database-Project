<?php include './Navbar.php' ?>

<html>
<header>
    <style>
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
        <h1>Your Profile</h1>
        <p><a href='./edit_Profile.php'>Edit Profile</a></p>
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
                if ($_SESSION['obj']['Is_Manager'] == 1){
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