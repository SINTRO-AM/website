<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    // Servereinstellungen
    $mail->isSMTP();
    $mail->Host = 'smtp.goneo.de';
    $mail->SMTPAuth = true;
    $mail->Username = 'no-reply@sintro.eu';
    $mail->Password = 'Dk366049551';
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Empfänger
    $mail->setFrom('no-reply@sintro.eu', 'Sintro Form');
    $mail->addAddress('contact@sintro.eu');

    // E-Mail Inhalt
    $mail->isHTML(true);
    $mail->Subject = 'Neue Kontaktanfrage von der Website';
    $mail->Body    = 'Hier sind die Details:<br>' . 
                     'Name: ' . htmlspecialchars($_POST['name']) . '<br>' .
                     'Email: ' . htmlspecialchars($_POST['email']) . '<br>' .
                     'Telefon: ' . htmlspecialchars($_POST['phone']) . '<br>' .
                     'Firma: ' . htmlspecialchars($_POST['company']) . '<br>' .
                     'Investortyp: ' . htmlspecialchars($_POST['investor-type']);

    $mail->send();
    echo 'Your message has been sent successfully. Thank you for your inquiry and interest in our organization.

We would like to assure you that your request is a top priority and we will process it promptly. Our dedicated team will get back to you shortly.

In the meantime, please do not hesitate to contact us by phone (+49 176 34334208) and we look forward to a successful cooperation.

With kind regards,

Your SINTRO Service Team
';
} catch (Exception $e) {
    echo 'There was an error sending your message. Please try again later or send a mail to contact@sintro.eu. ' . $mail->ErrorInfo;
}
?>