<?php
session_start(); // Start the session at the very beginning

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
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.goneo.de';
    $mail->SMTPAuth = true;
    $mail->Username = 'no-reply@sintro.eu';
    $mail->Password = 'Dk366049551'; // Replace with your real password
    $mail->SMTPSecure = 'ssl';
    $mail->Port = 465;

    // Recipients
    $mail->setFrom('no-reply@sintro.eu', 'SINTRO Website Contact Form');
    $mail->addAddress('contact@sintro.eu');

    // Email content
    $mail->isHTML(true);
    $mail->Subject = 'New contact request from the website';
    $mail->Body    = 'Here are the details:<br>' .
                     'Name: ' . htmlspecialchars($_POST['name']) . '<br>' .
                     'Email: ' . htmlspecialchars($_POST['email']) . '<br>' .
                     'Phone: ' . htmlspecialchars($_POST['phone']) . '<br>' .
                     'Company: ' . htmlspecialchars($_POST['company']) . '<br>' .
                     'Investor Type: ' . htmlspecialchars($_POST['investor-type']);

    if ($mail->send()) {
        $_SESSION['message'] = "Your message has been sent successfully. Thank you for your inquiry and interest in our organization. Your request is being handled with top priority and we will process it promptly. Our dedicated team will get back to you shortly.";
    } else {
        $_SESSION['message'] = "There was an error sending your message. Please try again later or send a mail to contact@sintro.eu.";
    }
    // Redirect back to the form page (or to any specific page you want)
    header("Location: index.php"); // Make sure to specify the correct path to your form page
    exit;
} catch (Exception $e) {
    $_SESSION['message'] = "There was an error sending your message. Please try again later or send a mail to contact@sintro.eu. " . $mail->ErrorInfo;
    // Redirect even if an exception occurs
    header("Location: index.php"); // Make sure to specify the correct path to your form page
    exit;
}
?>
