<?php 
    include '../Logic/sqlconn.php';
    include "./Navbar.php";

    $conn = connect();

    if(isset($_GET['id'])){
        $result = select_query("select * from Employee where ID = ".$_GET['id'],$conn);
    }
    else {
        header('Location: ./home.php');
        exit();
      }

    
    
?>

<html>
    <?php echo "<h1>Give Task to $result[First_Name] $result[Last_Name]</h1> " ?>
    <form action="add_Task.php" method ="POST">
        <label for="project_id">Project ID: </label>
        <input type="text" id="project_id" name="project_id" placeholder="Enter Project ID"><br>
        <label for="job_title">Task Name: </label>
        <input type="text" id="job_title" name="job_title" placeholder="Enter Task Name"><br>
        <label for="description">Description:</label>
        <input type="text" id="description" name="description" placeholder="Enter Description"><br>
        <label for="deadline">Deadline:</label>
        <input type="text" id="deadline" name="deadline" placeholder="YYYY/MM/DD"><br>

        <input type="submit" value="Give Task"><br>
    </form>
</html>