
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
// Initialize the session
session_start();
 
// Unset all of the session variables
// $_SESSION = array();

//PAG NAKACOMMENT TONG NASA TAAS, NAKARETAIN UNG LOGIN
 
// Destroy the session.
// session_destroy();

unset($_SESSION['patientSession']);
// Redirect to login page
header("location: ./../index.php");
//exit;
?>
</body>
</html>