<?php
session_start();
if (isset($_POST['subscribe'])) {
## CONFIG ##

# LIST EMAIL ADDRESS
$recipient = "caringpawsph@gmail.com";

# SUBJECT (Subscribe/Remove)
$subject = "New Subscriber!";

## FORM VALUES ##

# SENDER - WE ALSO USE THE RECIPIENT AS SENDER IN THIS SAMPLE
# DON'T INCLUDE UNFILTERED USER INPUT IN THE MAIL HEADER!
$sender = trim(stripslashes($_POST['email3']));

# MAIL BODY
$body = "Email: ".$_POST['email3']." \n";
# add more fields here if required

## SEND MESSGAE ##

$mail2 = mail( $recipient, $subject, $body, "From: $sender" ) or die ("Mail could not be sent.");

if ($mail2) { 
    $_SESSION["success2"] = "<center><div style='" . "margin-bottom: 100px;" . "' class=\"alert alert-success\">You are now subscribed, Thank you!</div><center>";
    header("location: main.php");   
    exit;
 }
  else { 
    $_SESSION["failed2"] = "<center><div style='" . "margin-bottom: 100px;" . "' class=\"alert alert-danger\">Something went wrong. Please try again.</div><center>"; 
    header("location: main.php");
    exit; 
 }
}
?>