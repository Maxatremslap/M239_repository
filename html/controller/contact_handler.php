<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

// Make sure the vendor autoload file exists
$vendor_autoload = __DIR__ . '/../../vendor/autoload.php';
if (!file_exists($vendor_autoload)) {
    $_SESSION['mail_status'] = "Server configuration error: PHPMailer is missing. Please contact the administrator.";
    $_SESSION['mail_status_type'] = "danger";
    header("Location: ../view/contact.php");
    exit;
}

require $vendor_autoload;

// Basic input validation
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['subject']) || empty($_POST['message']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $_SESSION['mail_status'] = "Invalid input. Please fill out all fields correctly.";
        $_SESSION['mail_status_type'] = "warning";
        header("Location: ../view/contact.php");
        exit;
    }

    $name = strip_tags(trim($_POST["name"]));
    $email = strip_tags(trim($_POST["email"]));
    $subject = strip_tags(trim($_POST["subject"]));
    $message = strip_tags(trim($_POST["message"]));

    $mail = new PHPMailer(true);

    try {
        // Server settings for hMailServer on Windows VM
        $mail->isSMTP();
        $mail->Host       = 'mail.furniturestoresl239.ch'; // The hostname you configured in DNS
        $mail->SMTPAuth   = true;
        $mail->Username   = 'admin@furniturestoresl239.ch'; // The email account you created in hMailServer
        $mail->Password   = 'gJ3k#9!sL*2a'; // The password for that email account
        $mail->SMTPSecure = false; // No encryption
        $mail->SMTPAutoTLS = false;
        $mail->Port       = 25; // Port for SMTP

        // Recipients
        $mail->setFrom('admin@furniturestoresl239.ch', 'Contact Form'); // This should be the same as the username
        $mail->addAddress('laemmler.max@gmail.com', 'Max Laemmler'); // Where the email will be sent
        $mail->addReplyTo($email, $name);

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'New Contact Form Submission: ' . $subject;
        $mail->Body    = "You have received a new message from your website contact form.<br><br>" .
                         "<b>Name:</b> " . htmlspecialchars($name) . "<br>" .
                         "<b>Email:</b> " . htmlspecialchars($email) . "<br>" .
                         "<b>Subject:</b> " . htmlspecialchars($subject) . "<br>" .
                         "<b>Message:</b><br>" . nl2br(htmlspecialchars($message));
        $mail->AltBody = "You have received a new message from your website contact form.\n\n" .
                         "Name: " . $name . "\n" .
                         "Email: " . $email . "\n" .
                         "Subject: " . $subject . "\n" .
                         "Message:\n" . $message;

        $mail->send();
        $_SESSION['mail_status'] = 'Message has been sent successfully!';
        $_SESSION['mail_status_type'] = 'success';
    } catch (Exception $e) {
        $_SESSION['mail_status'] = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        $_SESSION['mail_status_type'] = 'danger';
    }

    header("Location: ../view/contact.php");
    exit();
} else {
    // Redirect if accessed directly
    header("Location: ../view/contact.php");
    exit();
}
