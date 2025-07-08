<?php
session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Adjust the path to the Composer autoloader
require '../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Basic validation
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message'])) {
        $_SESSION['mail_status'] = "Please fill out all fields.";
        $_SESSION['mail_status_type'] = "danger";
        header("Location: ../view/contact.php");
        exit;
    }

    $name = strip_tags(htmlspecialchars($_POST['name']));
    $email = strip_tags(htmlspecialchars($_POST['email']));
    $subject = strip_tags(htmlspecialchars($_POST['subject']));
    $message_body = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        // --- Server settings ---
        // You will get these details from your email provider (e.g., SendGrid, Mailgun, or your own mail server)
        $mail->isSMTP();
        $mail->Host       = 'smtp.example.com'; // Your SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = 'user@example.com'; // Your SMTP username
        $mail->Password   = 'your_smtp_password'; // Your SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port       = 587;

        // --- Recipients ---
        // The 'From' address MUST be the same as your SMTP username for many providers
        $mail->setFrom('user@example.com', $name); 
        // This is the address where you want to receive the contact form submissions
        $mail->addAddress('contact@furniturestoresl239.ch', 'Max\'s Möbel');
        // Add a reply-to address, so you can reply directly to the user
        $mail->addReplyTo($email, $name);

        // --- Content ---
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Message: ' . $subject;
        $mail->Body    = "You have received a new message from your website contact form.<br><br>" .
                         "<b>Name:</b> " . $name . "<br>" .
                         "<b>Email:</b> " . $email . "<br><br>" .
                         "<b>Message:</b><br>" . nl2br($message_body);
        $mail->AltBody = "You have received a new message from your website contact form.\n\n" .
                         "Name: " . $name . "\n" .
                         "Email: " . $email . "\n\n" .
                         "Message:\n" . $message_body;

        $mail->send();
        $_SESSION['mail_status'] = 'Your message has been sent successfully. We will get back to you soon!';
        $_SESSION['mail_status_type'] = 'success';
    } catch (Exception $e) {
        // You can log the detailed error message for debugging instead of showing it to the user
        // error_log("Message could not be sent. Mailer Error: {$mail->ErrorInfo}");
        $_SESSION['mail_status'] = "Failed to send message. Please try again later.";
        $_SESSION['mail_status_type'] = 'danger';
    }

    header("Location: ../view/contact.php");
    exit;
} else {
    // If not a POST request, redirect back
    header("Location: ../view/contact.php");
    exit;
} 