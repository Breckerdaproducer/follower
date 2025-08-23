<?php
// Start the session FIRST
session_start();

include('../../assets/db/db.php');

$email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);

if (empty($email)) {
    echo 'Email is required';
    die();
}

if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo 'Email is not a valid email';
    die();
}
$otp = rand(100000, 999999);

$select = $conn->prepare('SELECT * FROM users WHERE email = ?');
$select->bind_param('s', $email);
$select->execute();
$result = $select->get_result();

if ($result->num_rows < 1) {
    echo 'Email address does not exist';
    die();
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

$mail = new PHPMailer(true);


try {
    // Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'medizmedinclusive@gmail.com';
    $mail->Password = 'eybx vswz eacs kxxz';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('medizmedinclusive@gmail.com', 'Mediz Med Inclusive');
    $mail->addAddress($email);

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'Your OTP code';
    $mail->Body = "
    <html>
        <head>
            <title>OTP Verification</title>
        </head>
        <body>
            <h2>Your OTP Code</h2>
            <p>Your One-Time Password is: <strong style='font-size: 24px; color: #007cba;'>$otp</strong></p>
            <p>This code will expire in 5 minutes.</p>
            <p>If you didn't request this code, please ignore this email.</p>
        </body>
    </html>";

    $mail->send();

    // Now the session will work because we started it at the top
    $_SESSION['otp'] = $otp;
    $_SESSION['otp_time'] = time(); // Optional: store timestamp for expiration
    $_SESSION['email'] = $email;

    echo 'success';
} catch (Exception $e) {
    echo "Otp code could not be sent.";
}