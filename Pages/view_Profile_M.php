<?php 
    include './navbar.php';
    include '../Logic/sqlconn.php';

    if (isset($_GET["id"])) {
      $id = $_GET["id"];
    } 
    else {
      echo '<script type="text/javascript">';
      echo "window.location.href='./home.php'";
      echo '</script>';
      exit();
    }

    $salary = '';
    $salaryErr = '';

    $conn = connect();

    $result = select_query("select * from Employee where ID = ".$id, $conn)[0];

    if ($result['Department_ID'] != $_SESSION['obj']['Department_ID']) {
      echo '<script type="text/javascript">';
      echo "window.location.href='./home.php'";
      echo '</script>';
      exit();
    }
    
    sqlsrv_close($conn);
?>

<html>
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
    </style>
</header>

<body>
    <center>
        <h1><?php echo $result['First_Name']." ".
            $result['Middle_Initial']." ".$result['Last_Name']?>'s Profile</h1>
            <a href='./edit_Salary_M.php'>Edit Salary</a>
            <p></p>
            <?php $_SESSION['salaryE'] = $result; ?>
        <table>
          <tr>
            <td>Name</td>
            <td>
                <?php 
                echo $result['First_Name']." ".$result['Middle_Initial'].
                " ".$result['Last_Name'];
                ?>
            </td>
          </tr>
          <tr>
            <td>ID</td>
            <td>
                <?php 
                echo $result['ID'];
                ?>
            </td>
          </tr>
          <tr>
            <td>Job Status</td>
            <td>
                <?php 
                if ($result['Is_Manager'] == 1){
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
                echo $result['Department_ID'];
                ?>
            </td>
          </tr>
          <tr>
            <td>Email</td>
            <td>
                <?php 
                echo $result['Email_Address'];
                ?>
            </td>
          </tr>
          <tr>
            <td>Phone</td>
            <td>
                <?php 
                echo $result['Phone_Number'];
                ?>
            </td>
          </tr>
          <tr>
            <td>Address</td>
            <td>
                <?php 
                echo $result['Street_Address']." ".$result['City'].", ".
                $result['State']." ".$result['Zip_Code'];
                ?>
            </td>
          </tr>
          <tr>
            <td>Birthday (M/D/Y)</td>
            <td>
                <?php 
                echo ($result['Birthday']->format('m-d-Y'));
                ?>
            </td>
          </tr>
          <tr>
            <td>Sex</td>
            <td>
                <?php 
                echo $result['Sex'];
                ?>
            </td>
          </tr>
          <tr>
            <td>Salary</td>
            <td>
                <?php 
                    echo $result['Salary'];
                ?>
            </td>
          </tr>
        </table>
    </center>
</body>

</html>