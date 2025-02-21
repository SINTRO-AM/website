<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

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
    echo 'Your message has been sent successfully.';
} catch (Exception $e) {
    echo 'There was an error sending your message. Please try again later or send a mail to contact@sintro.eu. ' . $mail->ErrorInfo;
}
?>