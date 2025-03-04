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
    $mail->setFrom('no-reply@sintro.eu', 'SINTRO Website Contact Form');
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

                     if($mail->send()) {
                        echo "<script>document.getElementById('modal-message').innerText = 'Ihre Nachricht wurde erfolgreich gesendet. Vielen Dank für Ihre Anfrage und Ihr Interesse an unserem Unternehmen. Ihre Anfrage wird mit höchster Priorität behandelt und umgehend bearbeitet. Unser engagiertes Team wird sich kurzfristig bei Ihnen melden.'; document.getElementById('myModal').style.display = 'block';</script>";
                    } else {
                        echo 'There was an error sending your message. Please try again later or send a mail to contact@sintro.eu. ' . $mail->ErrorInfo;
                    }
                } catch (Exception $e) {
                    echo 'There was an error sending your message. Please try again later or send a mail to contact@sintro.eu. ' . $mail->ErrorInfo;
                }
?>