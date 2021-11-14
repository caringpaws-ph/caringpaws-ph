<?php
include_once '../assets2/conn/dbconnect.php';
// Get the variables.
$icPatient = $_POST['ic'];
// echo $appid;

$delete = mysqli_query($con,"DELETE FROM patient WHERE icPatient=$icPatient");
// if(isset($delete)) {
//    echo "YES";
// } else {
//    echo "NO";
// }



?>

