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
//$mysqli = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
//if($mysqli === false){
//   die("ERROR: Could not connect. " . $mysqli->connect_error);
//}

//try{
//    $mysqli = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
//    $mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//} catch(PDOException $e){
//    die("ERROR: Could not connect. " . $e->getMessage());
//}

$host = 'remotemysql.com';
$db = 'UPc1x6hhWL';
$user = 'UPc1x6hhWL';
$pass = 'xaeSCnp1RQ';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";

try{
   $mysqli = new PDO($dsn, $user, $pass);
    // Set the PDO error mode to exception
    $mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
?>

</body>
</html>