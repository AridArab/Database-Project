<?php 
    include ".env.php";
    include "./Navbar.php";

    $conn = sqlsrv_connect(serverName, connectionInfo);
    if($conn === false ) {
        die( print_r( sqlsrv_errors(), true));
    }
?>

<html>
    <h1>Make Task</h1>
    <form action="add_Task.php" method ="POST">
        <label for="job_title">Task Name </label>
        <input type="text" id="job_title" name="job_title"><br>
        <label for="description">Task Name </label>
        <input type="text" id="description" name="description"><br>
        <label for="employee_id">Task Name </label>
        <input type="text" id="employee_id" name="employee_id"><br>
        <label for="deadline">Task Name </label>
        <input type="date" id="deadline" name="deadline"><br>

        <input type="submit" value="make_Task"><br>
    </form>
</html>