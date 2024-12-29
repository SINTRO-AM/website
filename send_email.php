<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require 'vendor/autoload.php'; // Autoloader für PHPMailer (Composer erforderlich)

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $company = htmlspecialchars($_POST['company']);
    $investorType = htmlspecialchars($_POST['investor-type']);
    $aum = htmlspecialchars($_POST['aum']);

    $mail = new PHPMailer(true);

    try {
        // Server-Einstellungen
        $mail->isSMTP();
        $mail->Host = 'smtp.goneo.de'; // SMTP-Server
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@sintro.eu'; // SMTP-Benutzername
        $mail->Password = 'Rwentz37'; // SMTP-Passwort
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // STARTTLS für Verschlüsselung
        $mail->Port = 465 ; // SMTP-Port für STARTTLS

        // Empfänger und Absender
        $mail->setFrom('no-reply@sintro.eu', 'SINTRO Contact');
        $mail->addAddress('contact@sintro.eu'); // Zieladresse

        // E-Mail-Inhalt
        $mail->Subject = "New Investor Inquiry from $name";
        $mail->Body = "
        Name: $name\n
        Email: $email\n
        Phone: $phone\n
        Company Name: $company\n
        Investor Type: $investorType\n
        Company AUM: $aum\n
        ";

        $mail->send();
        echo "Your message has been sent successfully.";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>
