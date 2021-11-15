<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'PHPMailer-master/src/Exception.php';
require 'PHPMailer-master/src/PHPMailer.php';
require 'PHPMailer-master/src/SMTP.php';
session_start();						
if(isset($_POST["send_message"])){
   						$fromname = $_POST["fullname"];
                        $fromemail = $_POST["email"];
                        $to = 'caringpawsph@gmail.com';
                        $subject = $_POST["subject"];
                        $message = $_POST["message"];


    $subject        = filter_var($_POST["subject"], FILTER_SANITIZE_STRING);
	//$mgs = "".$message;
	//$message        = filter_var($mgs, FILTER_SANITIZE_STRING); //capture message

    $attachments = $_FILES['my_files'];
    
    $file_count = count($attachments['name']); //count total files attached
    $boundary = md5(""); 
    
    //construct a message body to be sent to recipient
    //$message_body =  "------------------------------\n";
    $message_body =  "$message\n";

    
    if($file_count > 0){ //if attachment exists
        //header
        $headers = "MIME-Version: 1.0\r\n";
        $headers  = "From: ".$fromname . "\r\n";
        $headers .= "Reply-To: ".$fromemail . "\r\n";
    	// $headers .= "To: Mary <mary@example.com>, Kelly <kelly@example.com>" . "\r\n";
		// $headers .= "Cc: sendacopy@here.com" . "\r\n";
		// $headers .= "Bcc: sendablindcopy@here.com" . "\r\n";
		// $headers .= "X-Sender: testsite < mail@testsite.com >" . "\r\n";
		// $headers .= "Return-Path: " . $fromFull . "\r\n";
		// $headers .= "Content-Type: text/html; charset=ISO-8859-1" . "\r\n";
	    $headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
	    $headers .= "X-Priority: 1" . "\r\n";
	
        $headers .= "Content-Type: multipart/mixed; boundary = $boundary\r\n\r\n"; 
        
        //message text
        $body = "--$boundary\r\n";
        $body .= "Content-Type: text/plain; charset=ISO-8859-1\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n"; 
        $body .= chunk_split(base64_encode($message_body)); 

        //attachments
        for ($x = 0; $x < $file_count; $x++){       
            if(!empty($attachments['name'][$x])){
                
                if($attachments['error'][$x]>0) //exit script and output error if we encounter any
                {
                    $mymsg = array( 
                    1=>"The uploaded file exceeds the upload_max_filesize", 
                    2=>"The uploaded file exceeds the MAX_FILE_SIZE", 
                    3=>"The uploaded file was only partially uploaded", 
                    4=>"No file was uploaded", 
                    6=>"Missing a temporary folder" ); 
                    print  $mymsg[$attachments['error'][$x]]; 
                    exit;
                }
                

                //get file info
                $file_name = $attachments['name'][$x];
                $file_size = $attachments['size'][$x];
                $file_type = $attachments['type'][$x];
                
                //read file 
                $handle = fopen($attachments['tmp_name'][$x], "r");
                $content = fread($handle, $file_size);
                fclose($handle);
                $encoded_content = chunk_split(base64_encode($content)); //split into smaller chunks (RFC 2045)
                
                $body .= "--$boundary\r\n";
                $body .="Content-Type: $file_type; name=".$file_name."\r\n";
                $body .="Content-Disposition: attachment; filename=".$file_name."\r\n";
                $body .="Content-Transfer-Encoding: base64\r\n";
                $body .="X-Attachment-Id: ".rand(1000,99999)."\r\n\r\n"; 
                $body .= $encoded_content; 
            }
        }

    }else{ //send plain email otherwise
	// FULL HEADER
	$headers  = "From: ".$fromname . "\r\n";
	$headers .= "Reply-To: ".$fromemail . "\r\n";
	// $headers .= "To: Mary <mary@example.com>, Kelly <kelly@example.com>" . "\r\n";
	// $headers .= "Cc: sendacopy@here.com" . "\r\n";
	// $headers .= "Bcc: sendablindcopy@here.com" . "\r\n";
	// $headers .= "X-Sender: testsite < mail@testsite.com >" . "\r\n";
	// $headers .= "Return-Path: " . $fromFull . "\r\n";
	// $headers .= "Content-Type: text/html; charset=ISO-8859-1" . "\r\n";
	$headers .= "X-Mailer: PHP/" . phpversion() . "\r\n";
	$headers .= "X-Priority: 1" . "\r\n";
	$headers .= "MIME-Version: 1.0" . "\r\n";
        $body = $message_body;
    }
    
    $mail = mail($to, $subject, $body, $headers);
    
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

    if(!$mail->send()) //output success or failure messages
    {   
        $_SESSION["failed"] = "Could not send mail! Please try again."; 
        header("location: index.php");
        exit;
        
    }else{
        $_SESSION["success"] = "Thank you for your question!\nWe will reply as soon as possible.";
        header("location: index.php");   
        var_dump($mail); 
        exit;
    }
}
?>