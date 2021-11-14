<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
// Initialize the session
session_start();

$Arr_not_destoy_session = array('checker');

        foreach($_SESSION as $sees_key => $sess_val ){
            if(!in_array($sees_key, $Arr_not_destoy_session)){
                unset($_SESSION[$sees_key]);    
            }   
        }

// Redirect to login page
header("location: index.php");
exit;
?>
</body>
</html>