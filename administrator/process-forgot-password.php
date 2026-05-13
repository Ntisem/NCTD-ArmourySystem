<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded

// if (session_status() === PHP_SESSION_NONE) {
//     session_start();
// }

// Import PHPMailer classes
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Points to the vendor folder created by Composer
require 'vendor/autoload.php'; 

if (isset($_POST['recover_access'])) {
    $email = trim($_POST['email']);

    // 1. Verify Email exists in system
    $stmt = $pdo->prepare("SELECT fullname FROM admin_lists WHERE admin_email = ? LIMIT 1");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user) {
        // 2. Generate Tactical Token & Expiry (Valid for 30 mins)
        $token = bin2hex(random_bytes(32));
        $expiry = date("Y-m-d H:i:s", strtotime("+30 minutes"));

        // 3. Update Database with Token
        $update = $pdo->prepare("UPDATE admin_lists SET reset_token = ?, token_expiry = ? WHERE admin_email = ?");
        $update->execute([$token, $expiry, $email]);

        // 4. Dispatch Email via PHPMailer
        $mail = new PHPMailer(true);

        try {
            // LOCALHOST SMTP SETTINGS (Mailtrap Example)
            $mail->isSMTP();
            $mail->Host       = 'sandbox.smtp.mailtrap.io'; 
            $mail->SMTPAuth   = true;
            $mail->Username   = 'YOUR_MAILTRAP_USERNAME'; // REPLACE THIS
            $mail->Password   = 'YOUR_MAILTRAP_PASSWORD'; // REPLACE THIS
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = 587;

            // Recipients
            $mail->setFrom('system@nctd-armoury.gov.gh', 'NCTD_SECURE_SERVER');
            $mail->addAddress($email, $user['fullname']);

            // Content
            $reset_link = "http://localhost/GPSArmourySystem/reset-password.php?token=" . $token;
            
            $mail->isHTML(true);
            $mail->Subject = '[URGENT] ACCESS_RECOVERY_PROTOCOL';
            $mail->Body    = "
                <div style='background:#05070a; color:#ffffff; padding:20px; font-family:monospace; border:1px solid #00f2ff;'>
                    <h2 style='color:#00f2ff;'>RECOVERY_UPLINK_GENERATED</h2>
                    <p>Personnel Name: " . strtoupper($user['fullname']) . "</p>
                    <p>A request has been made to reset your command terminal password. Click the link below to verify identity:</p>
                    <div style='margin: 20px 0;'>
                        <a href='$reset_link' style='background:#00f2ff; color:#000; padding:10px 20px; text-decoration:none; font-weight:bold;'>INITIALIZE_RESET</a>
                    </div>
                    <p style='margin-top:20px; font-size:10px; color:#444;'>THIS_LINK_EXPIRES_IN_30_MINUTES</p>
                </div>";

            $mail->send();
            $_SESSION['status'] = "SIGNAL_DISPATCHED: CHECK_YOUR_COMM_CHANNEL";
            $_SESSION['status_code'] = "success";

        } catch (Exception $e) {
            $_SESSION['status'] = "MAIL_DISPATCH_FAILURE: " . $mail->ErrorInfo;
            $_SESSION['status_code'] = "error";
        }
    } else {
        // Obfuscate response for security
        $_SESSION['status'] = "SIGNAL_DISPATCHED: CHECK_YOUR_COMM_CHANNEL";
        $_SESSION['status_code'] = "success";
    }
   
    header("Location: forgot-password.php");
    exit();
}