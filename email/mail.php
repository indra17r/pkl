<?php
include('../vendor/autoload.php');
$mail = new PHPMailer();
//$mail->IsSMTP(); // telling the class to use SMTP
//$mail->Host = "localhost"; // SMTP server
//IsSMTP(); // send via SMTP
$mail->Host     = "ssl://smtp.gmail.com"; // SMTP server Gmail
$mail->Mailer   = "smtp";
$mail->SMTPAuth = true; // turn on SMTP authentication
$mail->Username = "muslimodernshop@gmail.com"; // 
$mail->Password = "muslim123"; // SMTP password
$webmaster_email = "muslimodernshop@gmail"; //Reply to this email ID
$mail->From = $webmaster_email;
$mail->FromName = "musliModern.com";

$mail->AddReplyTo($webmaster_email,"musliModern.com");
$mail->WordWrap = 50; // set word wrap
//$mail->AddAttachment("/var/tmp/file.tar.gz"); // attachment
//$mail->AddAttachment("/tmp/image.jpg", "new.jpg"); // attachment
$mail->IsHTML(true); // send as HTML

//$mail->AltBody = $altbody; //Text Body 
?>