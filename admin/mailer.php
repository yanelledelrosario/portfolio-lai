<?php
// admin/mailer.php
// Uses PHPMailer via Composer or manual include
// Run in your project root: composer require phpmailer/phpmailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require dirname(__DIR__) . '/vendor/autoload.php';

function sendReply($to_email, $to_name, $subject, $body) {
    $mail = new PHPMailer(true);

    try {
        // SMTP config — fill in your Gmail credentials
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'lairaymundo21@gmail.com'; // your Gmail
        $mail->Password   = 'YOUR_APP_PASSWORD';        // Gmail App Password (not your login password)
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;

        // Sender
        $mail->setFrom('lairaymundo21@gmail.com', 'Lai Rache');
        $mail->addReplyTo('lairaymundo21@gmail.com', 'Lai Rache');

        // Recipient
        $mail->addAddress($to_email, $to_name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = nl2br(htmlspecialchars($body));
        $mail->AltBody = $body;

        $mail->send();
        return ['success' => true];
    } catch (Exception $e) {
        return ['success' => false, 'error' => $mail->ErrorInfo];
    }
}