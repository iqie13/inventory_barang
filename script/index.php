<?php
require_once('phpmailer/class.phpmailer.php');
//include("phpmailer/class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded

define('GUSER', 'admin@antiemaho.com'); // Gmail username
define('GPWD', 'qwe123'); // Gmail password

function smtpmailer($to, $from, $from_name, $subject, $body) {
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 1;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = 'antiemaho.com';
	$mail->Port = 587;
	$mail->Username = 'admin@antiemaho.com';
	$mail->Password = 'qwe123';
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
	if(!$mail->Send()) {
		$error = 'Mail error: '.$mail->ErrorInfo;
		return false;
	} else {
		$error = 'Message sent!';
		return true;
	}
}
smtpmailer('denny@rumahweb.co.id', 'admin@antiemaho.com', 'dennyc', 'test mail message', 'Hello World!');