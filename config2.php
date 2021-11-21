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

define('DB_SERVER', 'sql6.freemysqlhosting.net');
define('DB_USERNAME', 'sql6452642');
define('DB_PASSWORD', '4Is8Q2EqT2');
define('DB_NAME', 'sql6452642');
 
/* Attempt to connect to MySQL database */
$mysqli2 = new mysqli(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
 
// Check connection
if($mysqli2 === false){
    die("ERROR: Could not connect. " . $mysqli2->connect_error);
}

//try{
//    $mysqli2 = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
//    $mysqli2->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//} catch(PDOException $e){
//    die("ERROR: Could not connect. " . $e->getMessage());
//}

?>


</body>
</html>