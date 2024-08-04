<?php
/**
 * send_email.php
 *
 * This script handles form submissions, sending an email to the website owner
 * and a confirmation email to the client. It uses PHP's mail function.
 *
 * Ensure the following configurations are correctly set:
 *  - The 'to' email address (your email address)
 *  - The 'from' email address (an email address configured on your server)
 *
 * @package   Submit Form Get Email
 * @version   1.0.0
 */

// Check if the request method is POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $email = 'hydromafant@gmail.com'; // The email address to receive client confirmations
    $name = htmlspecialchars($_POST['name']);
    $contact = htmlspecialchars($_POST['contact']);
    $message = htmlspecialchars($_POST['message']);

    // Email configuration for receiving new contact submissions
    $to = 'hydromafant@gmail.com; // Replace with your email address
    $subject = 'NEW CLIENT! Contact Form Submission';
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

    // Email content for receiving new contact submissions
    $body = "
    <html>
    <head>
        <title>Contact Form Submission from $name</title>
    </head>
    <body style='font-family: Arial, sans-serif; font-size: 18px; padding: 20px;'>
        <h2>Contact Form Submission</h2>
        <p><strong>Name:</strong> $name</p>
        <p><strong>Contact:</strong> $contact</p>
        <p><strong>Message:</strong></p>
        <p>$message</p>
    </body>
    </html>";

    // Send email to yourself
    if (mail($to, $subject, $body, $headers)) {
        // Email configuration for sending confirmation to the client
        $client_subject = "Thank you for contacting us";
        $client_body = "
        <html>
        <head>
            <title>Thank you for contacting us</title>
        </head>
        <body>
            <h2>Dear $name,</h2>
            <p>Thank you for reaching out. We have received your message and will get back to you shortly.</p>
            <p>Best regards,<br>Your Company</p>
        </body>
        </html>";
        $client_headers = "From: your-email@yourdomain.com\r\n"; // Replace with your email address
        $client_headers .= "Reply-To: your-email@yourdomain.com\r\n";
        $client_headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        // Send confirmation email to the client
        mail($email, $client_subject, $client_body, $client_headers);
    }

    // Redirect back to the homepage or a thank you page
    header('Location: /');
    exit;
}
?>
