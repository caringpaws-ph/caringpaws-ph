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
 
/* Attempt to connect to MySQL database */
$mysqli = mysqli_connect('remotemysql.com', 'UPc1x6hhWL', 'xaeSCnp1RQ', 'UPc1x6hhWL', '3306');
 
// Check connection
if($mysqli === false){
    die("ERROR: Could not connect. " . $mysqli->mysqli_connect_error());
}

//try{
//    $mysqli = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
//    $mysqli->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//} catch(PDOException $e){
//    die("ERROR: Could not connect. " . $e->getMessage());
//}
?>

</body>
</html>