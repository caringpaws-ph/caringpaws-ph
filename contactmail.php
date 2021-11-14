<?php
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
   $mail = mail($to, $subject2, $message, $headers);

	if ($mail) { 
        $_SESSION["success2"] = "<div style='" . "margin: 80 80; margin-bottom: 100px;" . "' class=\"alert alert-success\">Your message has been sent! Thank you!</div>";
        header("location: contact.php");   
        exit;
  }
   else { 
        $_SESSION["failed2"] = "<div style='" . "margin: 80 80; margin-bottom: 100px;" . "' class=\"alert alert-danger\">Your message has been sent! Thank you!</div>"; 
        header("location: contact.php");
        exit; 
  }
 }
}
?>