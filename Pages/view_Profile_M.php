<?php 
    include './Navbar.php';
    include '../Logic/sqlconn.php';

    if (isset($_GET["id"])) {
      $id = $_GET["id"];
    } 
    else {
      header('Location: ./home.php');
      exit();
    }

    $salary = '';
    $salaryErr = '';

    $conn = connect();

    $result = select_query("select * from Employee where ID = ".$id, $conn);
    
    sqlsrv_close($conn);
?>

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
        <h1>Profile</h1>
        <table>
          <tr>
            <td>Name</td>
            <td>
                <?php 
                echo $result['First_Name']." ".$result['Middle_Initial'].
                ". ".$result['Last_Name'];
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
            <td>Supervisor</td>
            <td>
                <?php 
                echo $result['Super_ID'];
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
            <td>Birthday(YYYY-MM-DD)</td>
            <td>
                <?php 
                echo ($result['Birthday']->format('Y-m-d'));
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
                    echo $result['Salary']." <a href='./edit_Salary.php'>Edit Salary</a>"; 
                    $_SESSION['salaryID'] = $id;
                ?>
            </td>
          </tr>
        </table>
    </center>
</body>

</html>