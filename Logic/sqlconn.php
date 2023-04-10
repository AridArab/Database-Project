<?php
// PHP Data Objects(PDO) Sample Code:
function connect() {
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

    return $conn;
}

function select_query($input, $conn) {
    $stmt = sqlsrv_query($conn, $input);
    $obj = array();
    while($obj[] = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_BOTH)){}
    sqlsrv_free_stmt($stmt);
    return $obj;
}

// function insert_query($input, $conn) {
//     $stmt = sqlsrv_query($conn, $input);
//     sqlsrv_free_stmt($stmt);
// }
?>