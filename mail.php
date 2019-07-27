<?php

function send_mail($to, $mail_subject,$mail_content, $attachments = array()){
    /*$to 		= adminMail;
     $subject 	= $mail_subject;
     $txt 		= $mail_content;
     $headers 	= "MIME-Version: 1.0" . "\r\n";
     $headers 	.= "Content-type:text/html;charset=UTF-8" . "\r\n";
     if(!empty($to) && !empty($subject) ){
     if(mail($to,$subject,$txt,$headers)){
     $success = "Thank you for contacting us we will get back to you soon.";
     return $success;
     }
     }*/
    
    require_once('phpmailer/class.phpmailer.php');
    
    //error_reporting(E_STRICT);
    
    //print_r($attachments);
    
    $mail = new PHPMailer();
    
    $mail->IsSMTP(); // telling the class to use SMTP
    $mail->Host       = "mail.yourdomain.com"; // SMTP server
    $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth   = true;                  // enable SMTP authentication
    $mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
    $mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
    $mail->Port       = 465;                   // set the SMTP port for the GMAIL server
    $mail->Username   = "intelacc18@gmail.com";  // GMAIL username
    $mail->Password   = "IntelAccounts@112233";            // GMAIL password
    
    $mail->SetFrom('pd@intelaccounts.com', 'TYA Suite EMS');
    
    $mail->AddReplyTo("pd@intelaccounts.com","TYA Suite EMS");
    
    $mail->Subject    = $mail_subject;
    
    $mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
    
    $mail->MsgHTML($mail_content);
    
    if(!empty($attachments))
    {
        for($i=0; $i<sizeof($attachments); $i++)
        {
            $mail->addAttachment($attachments[$i]);
        }
    }
    
    //$address = adminMail;
    
    $address = $to;
    
    $mail->AddAddress($address);
    
    if($mail->Send())
    {
//         $success = "Thank you for contacting us we will get back to you soon.";
//         return $success;
    }
}
?>