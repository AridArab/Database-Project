<?php 
    error_reporting(E_ERROR | E_PARSE);
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

    $conn = connect();

    $result = select_query("select * from Project where Department_ID = ".$id, $conn);
    
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
        <a href='./view_Reports.php'>Back</a>
        <table>
            <tr>
                <td>ID</td>
                <td>Project</td>
                <td>Budget</td>
                <td>Expense</td>
            </tr>
            <?php
                foreach($result as $row){
                    echo
                        "<tr>
                            <td>".$row['ID']."</td>
                            <td>".$row['Name']."</td>
                            <td>".$row['Budget']."</td>
                            <td>".$row['Total_Cost']."</td>
                        </tr>";
                }
            ?>
        </table>
    </center>
</body>

</html>