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
 
$db_host        = 'remotemysql.com';

$db_user        = 'UPc1x6hhWL';

$db_pass        = 'xaeSCnp1RQ';

$db_database    = 'UPc1x6hhWL'; 

$db_port        = '3306';

/* Attempt to connect to MySQL database */
$conn = mysqli_connect($db_host , $db_user , $db_pass, $db_database ,$db_port);
 
// Check connection
if($conn === false){
    die("ERROR: Could not connect. " . $mysqli->mysqli_connect_error());
}

//try{
//    $conn = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
//    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//} catch(PDOException $e){
//    die("ERROR: Could not connect. " . $e->getMessage());
//}?>

</body>
</html>