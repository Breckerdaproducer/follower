<?php
include('../../assets/db/db.php');
include('ip.php');
// Include PHPMailer classes at the top
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../email/vendor/autoload.php';

session_start();

$username = htmlspecialchars(trim(filter_var($_POST['userName'] ?? '', FILTER_SANITIZE_FULL_SPECIAL_CHARS)), ENT_QUOTES, 'UTF-8');
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$comfirm_password = trim($_POST['comfirm_password'] ?? '');
$password = trim($_POST['password'] ?? '');



if (empty($email)) {
    echo 'Email address is required';
    die();
}
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo 'Email is not a valid email';
    die();
}
$selct = $conn->prepare('SELECT * FROM users WHERE email = ?');
$selct->bind_param('s', $email);
$selct->execute();
$s_email = $selct->get_result();
if ($s_email->num_rows > 0) {
    echo 'Email address already exist';
    die();
}
if (empty($username)) {
    echo 'Username is required';
    die();
}
if ((strlen($username) <= 5)) {
    echo 'Username must be atleast 6 characters long';
    die();
}
$selct_user = $conn->prepare('SELECT * FROM users WHERE user_name = ?');
$selct_user->bind_param('s', $username);
$selct_user->execute();
$s_user = $selct_user->get_result();
if ($s_user->num_rows > 0) {
    echo 'Username already exist';
    die();
}


if (empty($password)) {
    echo 'Password is required';
    die();
}

if ((strlen($password) <= 7)) {
    echo 'Password must be atleast 8 characters long';
    die();
}
if (empty($comfirm_password)) {
    echo 'Confirm password is required';
    die();
}
if ($password != $comfirm_password) {
    echo 'Password does not match';
    die();
}
if (!isset($_POST['terms'])) {
    echo 'You must agree to the terms and condition';
    die();
}
$status = 'active';
$hash = password_hash($password, PASSWORD_BCRYPT);
$unique_id = rand(time(), 10000000);
$sql = $conn->prepare('INSERT INTO users SET user_id=?, ip= ?, status=?, user_name=?,  password = ?, email=?,  date_time = NOW()');
$sql->bind_param('ssssss', $unique_id, $ip, $status, $username, $hash, $email, );

if ($sql->execute()) {
    // Send notification email to admin
    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'luxinboost@gmail.com';
        $mail->Password = 'kxpm zajr vgug rqqk';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port = 587;

        // Recipients
        $mail->setFrom('luxinboost@gmail.com', 'Luxin Boost');
        $mail->addAddress($email); // Your notification email

        // Content
        $mail->isHTML(true);
        $mail->Subject = 'Welcome to Luxin Boost - Account Created Successfully!';
        $mail->Body = "
        <html>
            <head>
                <title>Welcome to Our Platform</title>
                <style>
                    body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f4f4f4; }
                    .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                    .header { background-color: #007cba; color: white; padding: 25px; text-align: center; border-radius: 8px 8px 0 0; }
                    .content { padding: 30px; background-color: white; border-radius: 0 0 8px 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
                    .welcome-title { font-size: 28px; margin: 0; font-weight: bold; }
                    .subtitle { font-size: 16px; margin: 10px 0 0 0; opacity: 0.9; }
                    .user-info { background-color: #f8f9fa; padding: 20px; border-radius: 8px; margin: 25px 0; border-left: 4px solid #007cba; }
                    .label { font-weight: bold; color: #333; display: inline-block; width: 90px; }
                    .value { color: #555; }
                    .message { color: #666; line-height: 1.6; margin: 20px 0; }
                    .footer { text-align: center; margin-top: 30px; color: #888; font-size: 14px; font-style: italic; }
                    .checkmark { color: #007cba; font-size: 48px; text-align: center; margin-bottom: 20px; }
                </style>
            </head>
            <body>
                <div class='container'>
                    <div class='header'>
                        <div class='checkmark'>✓</div>
                        <h1 class='welcome-title'>Account Created Successfully!</h1>
                        <p class='subtitle'>Welcome to our platform</p>
                    </div>
                    <div class='content'>
                        <p class='message'>Congratulations! Your account has been created successfully. You can now start exploring all the features our platform has to offer.</p>

                        <div class='user-info'>
                            <h3 style='margin-top: 0; color: #007cba;'>Your Account Details:</h3>
                            <p><span class='label'>Username:</span> <br> <span class='value'>$username</span></p>
                            <p><span class='label'>Email:</span> <span class='value'>$email</span></p>
                        </div>

                        <p class='message'>Thank you for joining us! If you have any questions or need assistance, please don't hesitate to reach out to our support team.</p>
                        
                        <div class='footer'>
                            <p>Best regards,<br>The Luxin Boost Team</p>
                        </div>
                    </div>
                </div>
            </body>
        </html>";
        $mail->send();
    } catch (Exception $e) {
        // Log the error but don't stop the registration process
        error_log("Admin notification email failed: " . $mail->ErrorInfo);
    }

    echo 'success';
    $_SESSION['luxin_user'] = $unique_id;
}
?>