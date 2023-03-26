<?php 
    error_reporting(E_ERROR | E_PARSE);
    include "./Navbar.php";
    include "../Logic/sqlconn.php";

    if (isset($_GET["id"])) {
      $id = $_GET["id"];
    } 
    else {
      header('Location: ./home.php');
      exit();
    }

    $conn = connect();

    $result = sqlsrv_query($conn, "select * from WORKS_ON where Employee_ID = ".$id);

    $employee = select_query("select * from Employee where ID = ".$id, $conn);
?>

<html>
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
        label {
            display: inline-block;
            width: 125px;
            text-align: right;
        }
    </style>
    <center>
    <h1>Tasks assigned to <?php echo $employee['First_Name']." ".
            $employee['Middle_Initial']." ".$employee['Last_Name']?></h1>
        <h2>Give employee a task</h2>
        <?php $_SESSION['taskE'] = $employee; ?>
        <p><a href='./give_Task.php'>Add Task</a></p>
        <h2>View Tasks (<?php echo select_query("select count(*) as Tasks from 
        WORKS_ON where Employee_ID = ".$employee['ID'], $conn)['Tasks'] ?>)</h2>
        <table>
            <tr>
                <td>ID</td>
                <td>Job Title</td>
                <td>Description</td>
                <td>Project ID</td>
                <td>Deadline</td>
                <td>Progress</td>
                <td>Total_Hours</td>
                <td>Start Date</td>
                <td>End Date</td>
            </tr>
            <?php
                while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                    if($row['End_Date'] == null){
                        $eDate = '';
                    }
                    else{
                        $eDate = $row['End_Date']->format('Y-m-d');
                    }

                    echo
                    "<tr>
                        <td>$row[ID]</td>
                        <td>$row[Job_Title]</td>
                        <td>$row[Description]</td>
                        <td>$row[Project_ID]</td>
                        <td>".$row['Deadline']->format('Y-m-d')."</td>
                        <td>$row[Progress]</td>
                        <td>$row[Total_Hours]</td>
                        <td>".$row['Start_Date']->format('Y-m-d')."</td>
                        <td>$eDate</td>
                    </tr>";
                }

                sqlsrv_close($conn);
            ?>
        </table>
    </center>
</html>