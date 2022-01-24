<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/vendor/autoload.php';

session_start();

if (isset($_POST['submit'])) {


   $name2 = trim(stripslashes($_POST['name3']));
   $email2 = trim(stripslashes($_POST['email3']));
   $to = 'caringpawsph@gmail.com';
   $subject2 = trim(stripslashes($_POST['subject3']));;
   $contact_message2 = trim(stripslashes($_POST['message3']));

   $mail = new PHPMailer(true);
   
	if ($subject2 == '') { 
        $subject2 = "New message from " . $name2 . " "; 
   }

    // Settings
    $mail->SMTPDebug  = 1;    // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = 'ssl';
    $mail->Host       = "smtp.gmail.com";    // SMTP server example
    $mail->Port       = 465;                    // set the SMTP port for the GMAIL server
    
    $mail->IsSMTP();
    
    $mail->Username   = "caringpaws.ph.new@gmail.com";            // SMTP account username example
    $mail->Password   = "ykcrhcfqvmlciahg";            // SMTP account password example

    $mail->setFrom($email2, 'New from Contact');
    $mail->addAddress($to);
    $mail->addReplyTo($email2, $name2);
    
    $mail->isHTML(true);
    
    $mail->Subject = $subject2;
    $mail->Body = $contact_message2;

  if(!$mail->send()) //output success or failure messages
  {   
   $_SESSION["failed2"] = "<div style='" . "margin: 80 80; margin-bottom: 100px;" . "' class=\"alert alert-danger\">Your message failed! Please try again!</div>"; 
   header("location: contact.php");
   exit; 
      
  }else{
   $_SESSION["success2"] = "<div style='" . "margin: 80 80; margin-bottom: 100px;" . "' class=\"alert alert-success\">Your message has been sent! Thank you!</div>";
   header("location: contact.php");   
   exit;

  }

}
?>