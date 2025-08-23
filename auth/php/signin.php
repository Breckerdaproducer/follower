<?php
session_start();
include_once "../../assets/db/db.php";

// Configuration 
$maxFailedAttempts = 3;
$lockoutDuration = 200; // seconds (4 minutes)
$loginAttemptsSessionKey = 'login_attempts';
$lockoutExpirySessionKey = 'lockout_expiry';



// Initialize session variables if not set
if (!isset($_SESSION[$loginAttemptsSessionKey])) {
    $_SESSION[$loginAttemptsSessionKey] = 0;
}
if (!isset($_SESSION[$lockoutExpirySessionKey])) {
    $_SESSION[$lockoutExpirySessionKey] = 0;
}

// Check if account is locked
if (isset($_SESSION[$lockoutExpirySessionKey]) && time() < $_SESSION[$lockoutExpirySessionKey]) {
    $remainingTime = $_SESSION[$lockoutExpirySessionKey] - time();
    echo "Too many failed attempts. Please try again later."; // Don't provide specific timing
    exit;
}

// Validate required fields
$email = filter_var(trim($_POST['email'] ?? ''), FILTER_SANITIZE_EMAIL);
$password = trim($_POST['password'] ?? '');


if (empty($email)) {
    echo "Email is required";
    exit;
}
if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
    echo 'Email is not a valid email';
    die();
}
if (empty($password)) {
    echo "Password is required";
    exit;
}



// Use prepared statements instead of string interpolation
$stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    // Use generic error message to prevent username enumeration
    record_failed_attempt();

    echo "Email does not exist";
    exit;
}

$user = $result->fetch_assoc();

// Verify password using correct ordering of operations
if (!password_verify($password, $user['password'])) {
    record_failed_attempt();

    echo "Wrong Password";
    exit;
}
if ($user['status'] === 'Suspended') {
    record_failed_attempt();

    echo "Your account has been suspended";
    exit;
}



// Login successful
$_SESSION['luxin_user'] = $user['user_id'];
if (isset($_POST['remember'])) {
    ini_set('session.cookie_lifetime', 30 * 24 * 3600);
    ini_set('session.gc_maxlifetime', 30 * 24 * 3600);

}
$_SESSION[$loginAttemptsSessionKey] = 0; // Reset attempts
$_SESSION[$lockoutExpirySessionKey] = 0; // Reset lockout
echo "success";

// Function to record failed attempts and handle lockouts
function record_failed_attempt()
{
    global $loginAttemptsSessionKey, $lockoutExpirySessionKey, $maxFailedAttempts, $lockoutDuration;

    $_SESSION[$loginAttemptsSessionKey]++;
    if ($_SESSION[$loginAttemptsSessionKey] >= $maxFailedAttempts) {
        $_SESSION[$lockoutExpirySessionKey] = time() + $lockoutDuration;
    }
}
?>