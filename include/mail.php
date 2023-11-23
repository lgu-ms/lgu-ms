<?php
use PHPMailer\PHPMailer\PHPMailer;

function initMail($directory, $mailrecepient, $mailrecepientname, $mailsubject, $mailbody) {
    include("config.php");
    require_once $directory . 'vendor/autoload.php';
    $mail = new PHPMailer;
    $mail->isSMTP();
    $mail->Host = $mailhost;
    $mail->Port = $mailport;
    $mail->SMTPDebug = 0;
    $mail->SMTPAuth = true;
    $mail->Username = 'support@digitalbarangay.com';
    $mail->Password = $mailpassword;
    $mail->setFrom('support@digitalbarangay.com', 'DigitalBarangay.com Support');
    $mail->addAddress($mailrecepient, $mailrecepientname);

    $mail->Subject = $mailsubject;
    $mail->isHTML(true);
    $mail->Body = $mailbody;
    return $mail;
}

function sendMail($mail) {
    return $mail -> send();
}
?>