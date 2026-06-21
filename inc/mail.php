<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . "/../vendor/autoload.php";


function send($to, $subject, $message)
{
	$mail = new PHPMailer(true);

	try {
		$mail->isSMTP();
		$mail->Host       = 'smtp.gmail.com'; // Change if using a different SMTP provider
		$mail->SMTPAuth   = true;
		$mail->Username   = 'dopymonster@gmail.com'; // Your email address
		$mail->Password   = 'ewzvlofdvddedtqy'; // Use App Password if using Gmail
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port       = 587;

		$mail->setFrom('yourgmail@gmail.com', 'System');
		$mail->addAddress($to);

		$mail->isHTML(true);
		$mail->Subject = $subject;
		$mail->Body    = $message;

		return $mail->send();
	} catch (Exception $e) {
		return false;
	}
}
