<?php
// PHP Data Objects(PDO) Sample Code:
try {
    $conn = new PDO("sqlsrv:server = tcp:uhteam6-database-server.database.windows.net,1433; Database = UMADATABASE_TEAM6", 
    "DATABASE_TEAM_6", "Umapass321");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

// SQL Server Extension Sample Code:
$connectionInfo = array("UID" => "DATABASE_TEAM_6", "pwd" => "Umapass321", 
"Database" => "UMADATABASE_TEAM6", "LoginTimeout" => 30, "Encrypt" => 1, "TrustServerCertificate" => 0);
$serverName = "tcp:uhteam6-database-server.database.windows.net,1433";
$conn = sqlsrv_connect($serverName, $connectionInfo);

//$tsql = "select * from employee";

//$stmt = sqlsrv_query($conn, $tsql);

//if($stmt == false){
//    echo 'Error';
//}


function create_query($input, $conn) {
    $stmt = sqlsrv_query($conn, $input);
    $obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_BOTH);
    sqlsrv_free_stmt($stmt);
    return $obj;
}



$obj = create_query('select * from employee', $conn);

echo $obj['First_Name'].'</br>';


/*
while($obj = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)){
    echo $obj['First_Name'].'</br>';
}
*/
sqlsrv_close($conn);
?>