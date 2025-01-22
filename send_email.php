<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'path/to/PHPMailer/src/Exception.php';
require 'path/to/PHPMailer/src/PHPMailer.php';
require 'path/to/PHPMailer/src/SMTP.php';

$mail = new PHPMailer(true); // Passing `true` enables exceptions

try {
    // Server settings
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.goneo.de';                        // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'no-replyl@sintro.eu';              // SMTP username
    $mail->Password = 'Rwentz37-';                     // SMTP password
    $mail->SMTPSecure = 'ssl';                            // Enable SSL encryption, `tls` also accepted with port 587
    $mail->Port = 465;                                    // TCP port to connect to

    // Recipients
    $mail->setFrom('no-reply@sintro.eu', 'Sintro Contact Form');
    $mail->addAddress('contact@sintro.eu', 'Sintro Contact');     // Add a recipient

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "New Inquiry from Website";
    $mail->Body    = "Name: " . htmlspecialchars($_POST['name']) . "<br>" .
                     "Email: " . htmlspecialchars($_POST['email']) . "<br>" .
                     "Phone: " . htmlspecialchars($_POST['phone']) . "<br>" .
                     "Company Name: " . htmlspecialchars($_POST['company']) . "<br>" .
                     "Investor Type: " . htmlspecialchars($_POST['investor-type']) . "<br>" .
                     
                     "Company AUM: " . htmlspecialchars($_POST['aum']) . "<br>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo 'Message could not be sent. Mailer Error: ' . $mail->ErrorInfo;
}
?>
