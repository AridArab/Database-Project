<html>
<header>
    <style>
        label {
            margin-bottom: 10px;
            padding-right: 5px;
            display: inline-block;
            width: 125px;
            text-align: right;
        }
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
        
    </style>
</header>

<?php
    error_reporting(E_ERROR | E_PARSE);
    // include './navbar.php';
    include '../Logic/sqlconn.php';

    if(!isset($_POST['ddept'])){
        echo '<script type="text/javascript">';
        echo "window.location.href='../'";
        echo '</script>';
    }

    $conn = connect();
    
    $stmt = "SELECT Department.ID, Department.Dept_Name, SUM(Budget) AS Budget, 
    SUM(Total_Cost) AS Expenses FROM Project INNER JOIN Department ON Department.ID = Department_ID 
    GROUP BY Department.ID, Department.Dept_Name";
    
    #Checks if at least 1 project in the department fits into the specified range of start dates.
    $stmt2 = "SELECT Department.ID, MIN(Start_Date) AS DSTART, MAX(Start_Date) AS DEND FROM Department
    LEFT JOIN Project ON Department.ID = Department_ID GROUP BY Department.ID";

    $sql2 = sqlsrv_query($conn, $stmt2);
    $sql3 = sqlsrv_query($conn, $stmt2);

    $invalidDate = [];

    if($_POST['pfrom'] != null){
        $allProjInvalid = true;
        while($dates = sqlsrv_fetch_array($sql2, SQLSRV_FETCH_ASSOC)){
            if($dates['DSTART'] == null || $dates['DSTART']->format("Y-m-d") >= date("Y-m-d", strtotime($_POST['pfrom']))){
                array_push($invalidDate, $dates['ID']);
            }
            else{
                $allProjInvalid = false;
            }
        }
        if(!$allProjInvalid){
            $invalidDate = [];
        }
    }
    if($_POST['pto'] != null){
        $tmp = $invalidDate;
        $allProjInvalid = true;
        while($dates2 = sqlsrv_fetch_array($sql3, SQLSRV_FETCH_ASSOC)){
            if($dates2['DEND'] == null || $dates2['DEND']->format("Y-m-d") <= date("Y-m-d", strtotime($_POST['pto']))){
                array_push($invalidDate, $dates2['ID']);
            }
            else{
                $allProjInvalid = false;
            }
        }
        if(!$allProjInvalid){
            $invalidDate = $tmp;
        }
    }

    echo "
        <center>
            <a href='./view_Reports.php'>Back</a>
            <table>
            <tr>
                <td>Department ID</td>
                <td>Department</td>
                <td>Budget</td>
                <td>Expenses</td>
                <td>Projects</td>
            </tr>";

    $result = select_query($stmt, $conn);

    if($_POST['ddept'] != ''){
        if(!empty($invalidDate)){
            foreach($result as $row){
                if((str_contains(strtoupper($row['Dept_Name']), strtoupper($_POST['ddept'])) || $row['ID'] == $_POST['ddept'])
                && !in_array($row['ID'], $invalidDate) && $row['ID'] != null){
                    echo
                        "<tr>
                            <td>".$row['ID']."</td>
                            <td>".$row['Dept_Name']." ".$row['Middle_Initial']." ".$row['Last_Name']."</td>
                            <td>".$row['Budget']."</td>
                            <td>".$row['Expenses']."</td>";
                        
                    if($_POST['pfrom'] != null && $_POST['pto'] != null)
                        echo "<td><a href='./deptpbe.php?id=".$row['ID']."&start=".$_POST['pfrom']."&end=".$_POST['pto']."'>View Projects</a></td>";
                    else if($_POST['pfrom'] != null)
                        echo "<td><a href='./deptpbe.php?id=".$row['ID']."&start=".$_POST['pfrom']."'>View Projects</a></td>";
                    else if($_POST['pto'] != null)
                        echo "<td><a href='./deptpbe.php?id="."&end=".$_POST['pto']."'>View Projects</a></td>";
                    else
                        echo "<td><a href='./deptpbe.php?id=".$row['ID']."'>View Projects</a></td>";

                    echo "</tr>";
                }
            }
        }
        else{
            foreach($result as $row){
                if(str_contains(strtoupper($row['Dept_Name']), strtoupper($_POST['ddept'])) || $row['ID'] == $_POST['ddept']
                && $row['ID'] != null){
                    echo
                        "<tr>
                            <td>".$row['ID']."</td>
                            <td>".$row['Dept_Name']." ".$row['Middle_Initial']." ".$row['Last_Name']."</td>
                            <td>".$row['Budget']."</td>
                            <td>".$row['Expenses']."</td>";
                        
                    if($_POST['pfrom'] != null && $_POST['pto'] != null)
                        echo "<td><a href='./deptpbe.php?id=".$row['ID']."&start=".$_POST['pfrom']."&end=".$_POST['pto']."'>View Projects</a></td>";
                    else if($_POST['pfrom'] != null)
                        echo "<td><a href='./deptpbe.php?id=".$row['ID']."&start=".$_POST['pfrom']."'>View Projects</a></td>";
                    else if($_POST['pto'] != null)
                        echo "<td><a href='./deptpbe.php?id="."&end=".$_POST['pto']."'>View Projects</a></td>";
                    else
                        echo "<td><a href='./deptpbe.php?id=".$row['ID']."'>View Projects</a></td>";

                    echo "</tr>";
                }
            }
        }
    }
    else{
        if(!empty($invalidDate)){
            foreach($result as $row){
                if(!in_array($row['ID'], $invalidDate) && $row['ID'] != null){
                    echo
                        "<tr>
                            <td>".$row['ID']."</td>
                            <td>".$row['Dept_Name']." ".$row['Middle_Initial']." ".$row['Last_Name']."</td>
                            <td>".$row['Budget']."</td>
                            <td>".$row['Expenses']."</td>";
                        
                    if($_POST['pfrom'] != null && $_POST['pto'] != null)
                        echo "<td><a href='./deptpbe.php?id=".$row['ID']."&start=".$_POST['pfrom']."&end=".$_POST['pto']."'>View Projects</a></td>";
                    else if($_POST['pfrom'] != null)
                        echo "<td><a href='./deptpbe.php?id=".$row['ID']."&start=".$_POST['pfrom']."'>View Projects</a></td>";
                    else if($_POST['pto'] != null)
                        echo "<td><a href='./deptpbe.php?id="."&end=".$_POST['pto']."'>View Projects</a></td>";
                    else
                        echo "<td><a href='./deptpbe.php?id=".$row['ID']."'>View Projects</a></td>";

                    echo "</tr>";
                }
            }
        }
        else{
            foreach($result as $row){
                if($row['ID'] != null){
                    echo
                        "<tr>
                            <td>".$row['ID']."</td>
                            <td>".$row['Dept_Name']." ".$row['Middle_Initial']." ".$row['Last_Name']."</td>
                            <td>".$row['Budget']."</td>
                            <td>".$row['Expenses']."</td>";
                        
                    if($_POST['pfrom'] != null && $_POST['pto'] != null)
                        echo "<td><a href='./deptpbe.php?id=".$row['ID']."&start=".$_POST['pfrom']."&end=".$_POST['pto']."'>View Projects</a></td>";
                    else if($_POST['pfrom'] != null)
                        echo "<td><a href='./deptpbe.php?id=".$row['ID']."&start=".$_POST['pfrom']."'>View Projects</a></td>";
                    else if($_POST['pto'] != null)
                        echo "<td><a href='./deptpbe.php?id="."&end=".$_POST['pto']."'>View Projects</a></td>";
                    else
                        echo "<td><a href='./deptpbe.php?id=".$row['ID']."'>View Projects</a></td>";

                    echo "</tr>";
                }
            }
        }
    }

    echo "
        </table>
    </center>";

    sqlsrv_close($conn);

    exit();
?>