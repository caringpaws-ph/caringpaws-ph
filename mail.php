<?php 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'phpmailer/vendor/autoload.php';

session_start();	

if(isset($_POST["send_message"])){

   	$fromname = $_POST["fullname"];
    $fromemail = $_POST["email"];
    $to = 'caringpawsph@gmail.com';
    $subject = $_POST["subject"];
    $message = $_POST["message"];

    $mail = new PHPMailer(true);
    
	//$mgs = "".$message;
	//$message        = filter_var($mgs, FILTER_SANITIZE_STRING); //capture message

    $attachments = $_FILES['my_files'];
    $file_count = count($attachments['name']); //count total files attached
    $boundary = md5(""); 
    
    //construct a message body to be sent to recipient
    //$message_body =  "------------------------------\n";

    $message_body =  "$message\n";


    if($file_count > 0){ //if attachment exists

        // Settings
        $mail->SMTPDebug  = 0;    // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = true;                  // enable SMTP authentication
        $mail->SMTPSecure = 'ssl';
        $mail->Host       = "smtp.gmail.com";    // SMTP server example
        $mail->Port       = 465;                    // set the SMTP port for the GMAIL server
        
        $mail->IsSMTP();
        
        $mail->Username   = "lawrs.rds@gmail.com";            // SMTP account username example
        $mail->Password   = "pbokmttytvoxhter";            // SMTP account password example
        
        //header
        $body = $message_body;

        $mail->setFrom($fromemail, 'Ask A Vet Question');
        $mail->addAddress($to);
        $mail->addReplyTo($fromemail, $fromname);

        $mail->isHTML(true);

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
                $file_name2 = $attachments['tmp_name'][$x];

                $mail->AddAttachment($file_name2, $file_name);
                
                $mail->isHTML(true);       
                $mail->Subject = $subject;
                $mail->Body = $body;
                

                if(!$mail->send()) //output success or failure messages
                {   
                    $_SESSION["failed"] = "Could not send mail! Please try again."; 
                    header("location: main.php");
                    exit;
                    
                }else{
                    $_SESSION["success"] = "Thank you for your question!\nWe will reply as soon as possible.";
                    header("location: main.php");   
                    exit;
                }
                
            }
        }
        

    }else{ //send plain email otherwise
	// FULL HEADER
    $body = $message_body;

    } 

    // Settings
    $mail->SMTPDebug  = 1;    // enables SMTP debug information (for testing)
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = 'ssl';
    $mail->Host       = "smtp.gmail.com";    // SMTP server example
    $mail->Port       = 465;                    // set the SMTP port for the GMAIL server
    
    $mail->IsSMTP();
    
    $mail->Username   = "lawrs.rds@gmail.com";            // SMTP account username example
    $mail->Password   = "pbokmttytvoxhter";            // SMTP account password example

    $mail->setFrom($fromemail, 'Ask A Vet Question');
    $mail->addAddress($to);
    $mail->addReplyTo($fromemail, $fromname);
    
    $mail->isHTML(true);
    
    $mail->Subject = $subject;
    $mail->Body = $body;

    if(!$mail->send()) //output success or failure messages
    {   
        $_SESSION["failed"] = "Could not send mail! Please try again."; 
        header("location: index.php");
        exit;
        
    }else{
        $_SESSION["success"] = "Thank you for your question!\nWe will reply as soon as possible.";
        header("location: index.php");   
        exit;
    }
}
?>