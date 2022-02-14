<link rel="icon" href="pagelogo.png" sizes="16x16" type="image/png">
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/vendor/autoload.php';
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

   $name2 = trim(stripslashes($_POST['name2']));
   $email2 = trim(stripslashes($_POST['email2']));
   $subject2 = '';
   $contact_message2 = trim(stripslashes($_POST['message2']));

    $mail = new PHPMailer(true);
    ## SEND MESSGAE ##
    
     // Settings
     $mail->SMTPDebug  = 1;    // enables SMTP debug information (for testing)
     $mail->SMTPAuth   = true;                  // enable SMTP authentication
     $mail->SMTPSecure = 'ssl';
     $mail->Host       = "smtp.gmail.com";    // SMTP server example
     $mail->Port       = 465;                    // set the SMTP port for the GMAIL server
     
     $mail->IsSMTP();
     
     $mail->Username   = "phcaringpaws@gmail.com";            // SMTP account username example
     $mail->Password   = "gblbihvpqosasoed";            // SMTP account password example

      if ($subject2 == '') { 
            $mail->setFrom($email2, 'Asked by ' . $name2);
      }
     
     $mail->addAddress($to);
     $mail->isHTML(true);

   $mail->Subject = $subject2;
   $mail->Body = $contact_message2;

  if(!$mail->send()) //output success or failure messages
  {   
   $_SESSION["failed2"] = "<center><div style='" . "margin-bottom: 100px;" . "' class=\"alert alert-danger\">Your message has not been sent! Please try again!</div><center>"; 
   header("location: index.php");
   exit; 
 
  }else{
   $_SESSION["success2"] = "<center><div style='" . "margin-bottom: 100px;" . "' class=\"alert alert-success\">Your message has been sent! Thank you!</div><center>";
   header("location: index.php");   
   exit;
  }
 }
}
?>