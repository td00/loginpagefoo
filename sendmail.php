<?php
//Thats not sendmail (the well known php function)
//It's merely a little try to reimplement some basic features for this project.
//And YES! I'm aware that this is hacky as shit!

//Sending Address:
$sender = 'forgotpassword@invalid.example.com';
//ReplyTo (should at least be valid!):
$replyto = 'spamme+somephpshit@td00.de';
session_start();
$mailrcpt = $_SESSION['mailrcpt'];
$mailsubject = $_SESSION['mailsubject'];
$mailbody = $_SESSION['mailbody'];

$to      = $mailrcpt;
$subject = $mailsubject;
$message = $mailbody;
$headers = 'From: '.$sender.' '. "\r\n" .
    'Reply-To: '.$replyto.' '. "\r\n" .
    'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);
?> 
