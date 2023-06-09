<?php 
    error_reporting(E_ERROR | E_PARSE);
    include './navbar.php';
    include '../Logic/sqlconn.php';

    if($_SESSION['obj']['Is_Manager'] == 0){
        echo '<script type="text/javascript">';
        echo "window.location.href='./home.php'";
        echo '</script>';
        exit();
    }
    $conn = connect();
    if($_SESSION['obj']['Is_Manager'] == 1 && select_query("select * from Employee where 
    ID = ".$_SESSION['obj']['ID'], $conn)[0]['Department_ID'] == null){
        echo '<script type="text/javascript">';
        echo "window.location.href='./assign_Dept.php'";
        echo '</script>';
        sqlsrv_close($conn);
        exit();
    }

    $unassignedEmployees = array();
    $result = sqlsrv_query($conn, "select First_Name, Middle_Initial, Last_Name, ID from Employee where Department_ID IS NULL OR NOT Department_ID = ".$_SESSION['obj']['Department_ID']);
    while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
        array_push($unassignedEmployees, $row);
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
                echo '<script type="text/javascript">';
                echo "window.location.href='./view_Management.php'";
                echo '</script>';
            }
        }
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
        
        .vae {
            display: grid;
            width: 200px;
                    
            background-color: rgba(225, 225, 225, 0.75);
            border-color:rgb(0, 0, 0);
            border-style: solid;
            border-radius: 10px;
        }
    </style>
</header>

<body>
    <center>
        <h1>Management</h1>
        <button id = "see" onClick="showHide('add'); showHide('see'); showHide('hide')" 
        class="showButton">Add Employee</button>
        <button id = "hide" onClick="showHide('add'); showHide('see'); showHide('hide')" 
        style="display:none" class="showButton">Hide Add Employee</button>
        <p></p>
        <div id="add" class="vae" style="padding:10px; display:none">
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" 
        method="POST" class="mt-4 w-75">
            <div class="mb-3">
                <select class="form-control 
                    <?php echo $EIDErr ? 'is-invalid' : null ?>
                    " id="addEmployee" name="addEmployee" style="width: 160px">
                    <option selected ="selected"> Choose Employee </option>
                    <?php
                        foreach($unassignedEmployees as $employee){
                            echo "<option value = $employee[ID]> $employee[First_Name] $employee[Middle_Initial]. $employee[Last_Name] - ID: $employee[ID] </option>";
                        }
                    ?>
                </select>
            </div>
            <p></p>
            <input type="submit" name="submit" value="Submit" class="btn btn-dark w-100">
        </form>
        </div>
        <div class="invalid-feedback" style="color: rgb(255, 0, 0)">
            <?php echo $EIDErr; ?>
        </div>
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