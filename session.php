
<?php 

session_start();
include_once './assets2/conn/dbconnect.php';
$_SESSION['icPatient'] = $_POST['icPatient'];
echo $_SESSION['icPatient'];

?>