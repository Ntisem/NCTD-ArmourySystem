<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

$status = '';
$status_code = '';

if (isset($_POST['update_password'])) {
    $current_pass = md5($_POST['current_password']);
    $new_pass = $_POST['new_password'];
    $confirm_pass = $_POST['confirm_password'];
    $username = $_SESSION['username'];

    // 1. Verify Current Password
    $stmt = $pdo->prepare("SELECT password FROM admin_lists WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && $current_pass === $user['password']) {
        if ($new_pass === $confirm_pass) {
            // 2. Update to New Password
            $hashed_new = md5($new_pass);
            $update = $pdo->prepare("UPDATE admin_lists SET password = ? WHERE username = ?");
            if ($update->execute([$hashed_new, $username])) {
                $status = "CIPHER_UPDATED: Credentials synchronized.";
                $status_code = "success";
            }
        } else {
            $status = "MISMATCH: New password confirmation failed.";
            $status_code = "error";
        }
    } else {
        $status = "AUTH_FAILURE: Current password incorrect.";
        $status_code = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>COMMAND NCTD | SECURITY_UPDATE</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        body { background: #05070a; font-family: 'Roboto Mono', monospace; color: #fff; }
        .tactical-box { 
            border: 1px solid #00f2ff; 
            background: #0d1117; 
            padding: 30px; 
            margin-top: 50px;
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.1);
        }
        .form-control { background: #000 !important; color: #00f2ff !important; border: 1px solid #333 !important; border-radius: 0; }
        .btn-update { border: 1px solid #00f2ff; color: #00f2ff; background: transparent; width: 100%; padding: 10px; }
        .btn-update:hover { background: #00f2ff; color: #000; }
        label { color: #00f2ff; font-size: 11px; text-transform: uppercase; }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="tactical-box">
                    <h4 class="text-center mb-4" style="font-family: 'Orbitron';">UPDATE_CREDENTIALS</h4>
                    
                    <?php if($status): ?>
                        <div class="alert alert-<?= $status_code == 'success' ? 'info' : 'danger' ?> bg-dark text-white border-0" style="font-size: 12px;">
                            [STATUS]: <?= $status ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST">
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="password" name="new_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Confirm New Password</label>
                            <input type="password" name="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" name="update_password" class="btn btn-update mt-3">EXECUTE_RE-ENCRYPTION</button>
                    </form>
                    <div class="text-center mt-3">
                        <a href="armourer-profile" style="color: #ff3e3e; font-size: 15px; font-weight: bold; text-decoration: none;">ABORT_OPERATION</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <div class="text-center mt-4">
        <small style="color: #555; font-size: 10px;">COMMAND NCTD // SECURITY_UPDATE_MODULE</small>
    </div>
     <?php include_once('includes/footer.php');?>
</body>
</html>