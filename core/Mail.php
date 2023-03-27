<?php
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../vendor/PHPMailer/src/Exception.php';
require '../vendor/PHPMailer/src/PHPMailer.php';
require '../vendor/PHPMailer/src/SMTP.php';
class Mail {

    function mailto($to,$subject,$message){
        $mail = new PHPMailer(true);
    
        try {
            //Server settings
            $mail->SMTPDebug = 0;                      //Enable verbose debug output
            $mail->isSMTP();                                            //Send using SMTP
            $mail->Host       = 'ssl://smtp.titan.email';                     //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
            $mail->Username   = ADMIN_MAIL;                     //SMTP username
            $mail->Password   = ADMIN_MAIL_PASSWORD ;                               //SMTP password
            $mail->SMTPSecure = 'SSL';            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        
            //Recipients
            $mail->setFrom(ADMIN_MAIL, ADMIN_MAIL_NAME);
            $mail->addAddress($to);               //Name is optional
            $mail->addReplyTo(ADMIN_MAIL, ADMIN_MAIL_NAME);
          
        
          
            //Content
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = $subject;
            $mail->Body    = $message;
            $mail->AltBody = 'Non html body';
        
            $mail->send();
            $mailsent = "Message sent successfully";
        } catch (Exception $e) {
            // echo "Email could not be sent. Mailer Error: </br> </br>{$mail->ErrorInfo}";
        }
    
    }

}