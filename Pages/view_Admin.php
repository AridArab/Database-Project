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
    </style>
</header>

<body>
    <center>
        <h1>Admin</h1>
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