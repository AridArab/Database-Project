<?php 
    include ".env.php";
    include "./Navbar.php";

    $conn = sqlsrv_connect(serverName, connectionInfo);
    if($conn === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
?>

<html>
    <h1>Tasks Assigned</h1>
    <?php 
        $query =   
           "SELECT T.Job_Title, T.Description, T.Deadline, T.End_Date, P.Name, P.Progress
            FROM WORKS_ON as T, Employee as E, Project as P 
            WHERE T.Employee_ID = E.ID AND T.Project_ID = P.ID";
        $result = sqlsrv_query($conn, $query);
        if($result){
            $row=sqlsrv_fetch_object($result, SQLSRV_FETCH_BOTH);
            if(!$row){
                echo "<p>No tasks assigned</p>";
            }
            else{
                do{
                    echo "<p>$row[0]</p>
                            <p>$row[1]</p>";
                }
                while($row=sqlsrv_fetch_object($result, SQLSRV_FETCH_BOTH));
            }
        }
        else{
            exit("<p> Query Error </p>");
        }
    ?>
</html>