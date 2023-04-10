<?php 
    error_reporting(E_ERROR | E_PARSE);
    include './Navbar.php';
    include '../Logic/sqlconn.php';

    if($_SESSION['obj']['Is_Manager'] == 0){
        header('Location: ./home.php');
        exit();
    }
    $conn = connect();
    if($_SESSION['obj']['Is_Manager'] == 1 && select_query("select * from Employee where 
    ID = ".$_SESSION['obj']['ID'], $conn)[0]['Department_ID'] == null){
        header('Location: ./assign_dept.php');
        sqlsrv_close($conn);
        exit();
    }

    $result = select_query("select * from Employee where Department_ID = ".$_SESSION['obj']['Department_ID'], $conn
    );

    $EID = '';
    $EIDErr = '';

    if (isset($_POST['submit'])) {
        if (empty($_POST['addEmployee'])) {
            $EIDErr = 'Please enter employee ID';
        }
        else if (!is_numeric($_POST['addEmployee'])){
            $EIDErr = 'ID needs to be a number';
        }  
        else {
            $EID = filter_input(
                INPUT_POST,
                'addEmployee',
                FILTER_SANITIZE_NUMBER_INT
            );
        }
        if ($EIDErr == ''){
            $temp = select_query("select * from Employee where ID = ".$_POST['addEmployee'], $conn)[0];
            if($temp['ID'] == null || $temp['Is_Manager'] == 1){
                $EIDErr = 'Not a valid ID';
            }
            else{
                sqlsrv_query($conn, 
                    "update Employee set Department_ID = ".$_SESSION['obj']['Department_ID']." 
                    where ID = ".$_POST['addEmployee']
                );
            }
        }
    }
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
            background-color: rgba(225, 225, 225, 0.75);
        }
    </style>
</header>

<body>
    <center>
        <h1>Management</h1>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
        method="POST" class="mt-4 w-75">
            <div class="mb-3">
                <label for="addEmployee" style="display: block; width:auto; text-align: center; margin-bottom: 10px"
                class="form-label">Add an Employee:</label>
                <input type="text" class="form-control 
                    <?php echo $EIDErr ? 'is-invalid' : null ?>
                    " id="addEmployee" name="addEmployee" style="width: 151px" 
                    placeholder="Enter Employee ID">
                <div class="invalid-feedback" style="color: rgb(255, 0, 0)">
                    <?php echo $EIDErr; ?>
                </div>
            </div>
            <p></p>
            <input type="submit" name="submit" value="Submit" class="btn btn-dark w-100">
        </form>
        <p></p>
        <h2>View Employees (<?php echo select_query("select count(*) as Employees from 
        Employee where Department_ID = ".$_SESSION['obj']['Department_ID']." 
        and not ID = ".$_SESSION['obj']['ID'], $conn)[0]['Employees'] ?>)
        </h2>
        <table>
            <tr>
                <td>ID</td>
                <td>Name</td>
                <td>Profile</td>
                <td>Tasks</td>
            </tr>
            <?php
                foreach($result as $row){
                    if($row['ID'] != $_SESSION['obj']['ID'] && $row['ID'] != null){
                        echo
                        "<tr>
                            <td>$row[ID]</td>
                            <td>$row[First_Name]"." "."$row[Middle_Initial]"." "."$row[Last_Name]</td>
                            <td><a href='./view_Profile_M.php?id=".$row['ID']."'>View Profile</a></td>
                            <td><a href='./view_Tasks_M.php?id=".$row['ID']."'>View Tasks</a></td>
                        </tr>";
                    }
                }

                sqlsrv_close($conn);
            ?>
        </table>
    </center>
</body>

</html>