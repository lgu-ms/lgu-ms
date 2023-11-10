<?php
include("config.php");
use PHPMailer\PHPMailer\PHPMailer;

$msg = '';
require 'vendor/autoload.php';
$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host = $mailhost;
$mail->Port = $mailport;
if ($debug) {
    $mail->SMTPDebug = 2;
} else {
    $mail->SMTPDebug = 0;
}
$mail->SMTPAuth = true;
$mail->Username = 'support@digitalbarangay.com';
$mail->Password = $mailpassword;
$mail->setFrom('support@digitalbarangay.com', 'DigitalBarangay.com Support');
$mail->addAddress($mailrecepient, $mailrecepientname);

$mail->Subject = $mailsubject;
$mail->isHTML(false);
$mail->Body = $mailbody;
$mail->send();

?>