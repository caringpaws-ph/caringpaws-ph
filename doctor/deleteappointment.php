<?php
include_once '../assets2/conn/dbconnect.php';
// Get the variables.
$appid = $_POST['id'];
// echo $appid;

$delete = mysqli_query($con,"DELETE FROM appointment WHERE appId=$appid");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }



?>

