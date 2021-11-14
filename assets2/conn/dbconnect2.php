<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
<?php
/* Database credentials. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
//define('DB_SERVER', 'localhost');
//define('DB_USERNAME', 'root');
//define('DB_PASSWORD', '');
//define('DB_NAME', 'db_healthcare');

//define('DB_SERVER', 'remotemysql.com');
//define('DB_USERNAME', 'UPc1x6hhWL');
//define('DB_PASSWORD', 'xaeSCnp1RQ');
//define('DB_NAME', 'UPc1x6hhWL');
 
/* Attempt to connect to MySQL database */
//$conn = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
//if($conn === false){
//    die("ERROR: Could not connect. " . $mysqli->connect_error);
//}

$host = 'remotemysql.com';
$db = 'UPc1x6hhWL';
$user = 'UPc1x6hhWL';
$pass = 'xaeSCnp1RQ';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try{
   $conn = new PDO($dsn, $user, $pass);
    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}

?>

</body>
</html>