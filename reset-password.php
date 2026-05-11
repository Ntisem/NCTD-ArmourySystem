<?php
require_once('connections/connect-db.php');
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$token = $_GET['token'] ?? '';
$valid_token = false;

if (!empty($token)) {
    // Validate token and expiry
    $stmt = $pdo->prepare("SELECT adminID FROM admin_lists WHERE reset_token = ? AND token_expiry > NOW() LIMIT 1");
    $stmt->execute([$token]);
    if ($stmt->fetch()) {
        $valid_token = true;
    }
}

// Handle new password submission
if (isset($_POST['update_password'])) {
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];
    $current_token = $_POST['token'];

    if ($new_pass === $confirm_pass) {
        // Use MD5 to match your existing login system
        $hashed_pass = md5($new_pass);
        
        // Update password and clear the token to prevent reuse
        $update = $pdo->prepare("UPDATE admin_lists SET password = ?, reset_token = NULL, token_expiry = NULL WHERE reset_token = ?");
        $update->execute([$hashed_pass, $current_token]);

        $_SESSION['status'] = "CIPHER_UPDATED: ACCESS_RESTORED";
        $_SESSION['status_code'] = "success";
        header("Location: login.php");
        exit();
    } else {
        $_SESSION['status'] = "MISMATCH_DETECTED: VERIFY_PASSWORDS";
        $_SESSION['status_code'] = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>RESET_TERMINAL | PALADIN</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@300;500&display=swap" rel="stylesheet">
    <style>
        :root { --neon: #00f2ff; --bg-deep: #05070a; --card-bg: #0d1117; }
        body { background: var(--bg-deep); color: var(--neon); font-family: 'Roboto Mono', monospace; height: 100vh; display: flex; align-items: center; justify-content: center; margin: 0; }
        .reset-box { border: 1px solid var(--neon); padding: 40px; background: var(--card-bg); width: 100%; max-width: 400px; box-shadow: 0 0 15px rgba(0, 242, 255, 0.2); }
        .form-control { background: #000 !important; border: 1px solid #333 !important; color: var(--neon) !important; padding: 12px; width: 100%; margin-bottom: 20px; border-radius: 0; }
        .btn-tactical { background: var(--neon); color: #000; border: none; padding: 12px; width: 100%; font-family: 'Orbitron'; font-weight: bold; cursor: pointer; transition: 0.3s; }
        .btn-tactical:hover { background: #fff; box-shadow: 0 0 20px var(--neon); }
        label { font-size: 10px; letter-spacing: 1px; display: block; margin-bottom: 5px; }
    </style>
</head>
<body>
    <div class="reset-box">
        <?php if ($valid_token): ?>
            <h3 style="text-align:center; font-family: 'Orbitron'; margin-bottom: 25px;">[ NEW_CIPHER_ENTRY ]</h3>
            <form action="" method="POST">
                <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">
                
                <label>ENTER_NEW_PASSWORD</label>
                <input type="password" name="new_password" class="form-control" required minlength="8">
                
                <label>CONFIRM_NEW_PASSWORD</label>
                <input type="password" name="confirm_password" class="form-control" required>
                
                <button type="submit" name="update_password" class="btn-tactical">COMMIT_CHANGES</button>
            </form>
        <?php else: ?>
            <div style="text-align:center; color:#ff3e3e;">
                <h4 style="font-family: 'Orbitron';">[ INVALID_OR_EXPIRED_UPLINK ]</h4>
                <p style="font-size: 12px; color: #666;">The security token is no longer valid.</p>
                <a href="forgot-password.php" style="color:var(--neon); text-decoration:none; font-size: 11px;">RETRY_RECOVERY</a>
            </div>
        <?php endif; ?>
    </div>
</body>
</html>