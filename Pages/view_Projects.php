<?php
include_once ".env.php";
include './Navbar.php';
?>

<html>

<body>
    <center>
        <h1>Projects</h1>
    </center>
    <?php
    $conn = sqlsrv_connect(serverName, connectionInfo);
    if(!$conn)
        {
            exit("<p> Connection Error: " . sqlsrv_connect_error() . "</p>");
        }
    
    ?>
    <table>
        <?php
        $query = "SELECT * FROM Project";
        $result = sqlsrv_query($conn, $query);
        if(!$result)
            {
                exit("<p> Query Error: " . sqlsrv_error($conn) . "</p>");
            }
        ?>
        <tr>
            <th>Progress</th>
            <th>ID</th>
            <th>Name</th>
            <th>Total Cost</th>
            <th>Street Address</th>
            <th>City</th>
            <th>State</th>
            <th>Zip Code</th>
            <th>Department ID</th>
            <th>Budget</th>
        </tr>
        <?php
            while($row=sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC))
                echo "<tr><td>$row[Progress]</td>
                <td>$row[ID]</td>
                <td>$row[Name]</td>
                <td>$row[Total_Cost]</td>
                <td>$row[Street_Address]</td>
                <td>$row[City]</td>
                <td>$row[State]</td>
                <td>$row[Zip_Code]</td>
                <td>$row[Department_ID]</td>
                <td>$row[Budget]</td>

                </tr>";
        ?>
        </table>

    <table>
    <h3 class="top">Add Project</h3>
                <form action="add_Project.php" method ="POST">
                    <label for="progress">Progress</label>
                    <input type="text" id="progress" name="progress"><br>
                    <label for="projectID">ID</label>
                    <input type="text" id="projectID" name="projectID"><br>
                    <label for="projectName">Name</label>
                    <input type="text" id="projectName" name="projectName"><br>
                    <label for="cost">Total Cost</label>
                    <input type="text" id="cost" name="cost"><br>
                    <label for="address">Street Address</label>
                    <input type="text" id="address" name="address"><br>
                    <label for="city">City</label>
                    <input type="text" id="city" name="city"><br>
                    <label for="state">State</label>
                    <input type="text" id="state" name="state"><br>
                    <label for="zip">ZipCode</label>
                    <input type="text" id="zip" name="zip"><br>
                    <label for="deptID">Department ID</label>
                    <input type="text" id="deptID" name="deptID"><br>
                    <label for="budget">Budget</label>
                    <input type="text" id="budget" name="budget"><br>
                    <input type="submit" value="Add Project">
                </form>


    </table>

</body>


</html>