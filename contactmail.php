
<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';

session_start();

if (isset($_POST['submit'])) {

// Replace this with your own email address
$to = 'caringpawsph@gmail.com';

function url(){
  return sprintf(
    "%s://%s",
    isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' ? 'https' : 'http',
    $_SERVER['SERVER_NAME']
  );
}

if($_POST) {

   $name2 = trim(stripslashes($_POST['name3']));
   $email2 = trim(stripslashes($_POST['email3']));
   $subject2 = trim(stripslashes($_POST['subject3']));;
   $contact_message2 = trim(stripslashes($_POST['message3']));

   
	if ($subject2 == '') { 
        $subject2 = "Asked by " . $name2 . " "; 
    }

   // Set Message
   $message = "Email from: " . $name2 . "<br />";
   $message .= "Email address: " . $email2 . "<br />";
   $message .= "Message: <br />";
   $message .= nl2br($contact_message2);
   $message .= "<br /> ----- <br /> This email was sent from " . url() . " Copyright @ 2021 Caring Paws . <br />";

   // Set From: header
   $from =  $name2 . " <" . $email2 . ">";

   // Email Headers
	$headers = "From: " . $from . "\r\n";
	$headers .= "Reply-To: ". $email2 . "\r\n";
 	$headers .= "MIME-Version: 1.0\r\n";
	$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

   ini_set("sendmail_from", $to); // for windows server

   $mail = new PHPMailer();

   // Settings
   $mail->IsSMTP();
   $mail->CharSet = 'UTF-8';

   $mail->Host       = "smtp.gmail.com";    // SMTP server example
   $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
   $mail->SMTPAuth   = true;                  // enable SMTP authentication
   $mail->Port       = 587;                    // set the SMTP port for the GMAIL server
   $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
   $mail->Username   = "caringpawsph@gmail.com";            // SMTP account username example
   $mail->Password   = "vqxvwuivpewpiato";            // SMTP account password example

   $mail = mail($to, $subject2, $message, $headers);

	if (!$mail->send()) { 
        $_SESSION["failed2"] = "<div style='" . "margin: 80 80; margin-bottom: 100px;" . "' class=\"alert alert-danger\">Your message has been sent! Thank you!</div>"; 
        header("location: contact.php");
        var_dump($mail); 
        exit;
  }
   else { 
         $_SESSION["success2"] = "<div style='" . "margin: 80 80; margin-bottom: 100px;" . "' class=\"alert alert-success\">Your message has been sent! Thank you!</div>";
         header("location: contact.php");  
         exit; 
  }
 }
}
?>