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
        "SELECT * FROM Department"
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
        //Unsure how to retrieve first and last name from query -Zohair
         while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
            $manager = select_query("SELECT Employee.First_Name, Employee.Last_Name FROM Department, Employee WHERE Employee.ID = Department.Manager_ID", $conn);
            echo
            "<div class='department'>
            $row[Dept_Name]<br>
            Email: $row[Email_Address]<br>
            Phone: $row[Phone_Number]<br>
            Manager: $manager[1]
            </div>";
         }
        ?></p>
    </center>
</body>

</html>