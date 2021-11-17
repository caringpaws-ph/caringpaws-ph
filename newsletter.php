<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/vendor/autoload.php';
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

$mail = new PHPMailer(true);
## SEND MESSGAE ##

 // Settings
 $mail->SMTPDebug  = 1;    // enables SMTP debug information (for testing)
 $mail->SMTPAuth   = true;                  // enable SMTP authentication
 $mail->SMTPSecure = 'ssl';
 $mail->Host       = "smtp.gmail.com";    // SMTP server example
 $mail->Port       = 465;                    // set the SMTP port for the GMAIL server
 
 $mail->IsSMTP();
 
 $mail->Username   = "lawrs.rds@gmail.com";            // SMTP account username example
 $mail->Password   = "pbokmttytvoxhter";            // SMTP account password example

 $mail->setFrom($sender, 'Newsletter Subscriber');
 $mail->addAddress($recipient);
 
 $mail->isHTML(true);
 
 $mail->Subject = $subject;
 $mail->Body = $body;

 if(!$mail->send()) //output success or failure messages
 {   
   $_SESSION["failed2"] = "<center><div style='" . "margin-bottom: 100px;" . "' class=\"alert alert-danger\">Something went wrong. Please try again.</div><center>"; 
   header("location: index.php");
   exit;

 }else{
   $_SESSION["success2"] = "<center><div style='" . "margin-bottom: 100px;" . "' class=\"alert alert-success\">You are now subscribed, Thank you!</div><center>";
   header("location: index.php");   
   exit;
 }
}

?>