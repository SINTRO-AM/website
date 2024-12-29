<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $company = htmlspecialchars($_POST['company']);
    $investorType = htmlspecialchars($_POST['investor-type']);
    $aum = htmlspecialchars($_POST['aum']);

    $to = "contact@sintro.eu";
    $subject = "New Investor Inquiry from $name";
    $message = "
    Name: $name\n
    Email: $email\n
    Phone: $phone\n
    Company Name: $company\n
    Investor Type: $investorType\n
    Company AUM: $aum\n
    ";
    $headers = "From: $email";

    if (mail($to, $subject, $message, $headers)) {
        echo "Your message has been sent successfully.";
    } else {
        echo "There was an error sending your message. Please try again later.";
    }
}
?>
