<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>RECOVERY_TERMINAL | PASSWORD_RESET</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@300;500&display=swap" rel="stylesheet">
   <link rel="shortcut icon" href="assets/images/favicon.png" />
   <style>
        :root { --neon: #00f2ff; --bg-deep: #05070a; --card-bg: #0d1117; --danger: #ff3e3e; }
        body { background: var(--bg-deep); font-family: 'Roboto Mono', monospace; color: #c0c5ce; height: 100vh; display: flex; align-items: center; }
        .recovery-card { background: var(--card-bg) !important; border: 1px solid var(--neon); width: 100%; max-width: 450px; margin: auto; padding: 30px; box-shadow: 0 0 20px rgba(0, 242, 255, 0.1); }
        .form-control { background: #000 !important; color: var(--neon) !important; border: 1px solid #333 !important; border-radius: 0; }
        .btn-comm { background: transparent; border: 1px solid var(--neon); color: var(--neon); font-family: 'Orbitron'; width: 100%; padding: 12px; transition: 0.4s; }
        .btn-comm:hover { background: var(--neon); color: #000; }
        #toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; }
        .t-toast { background: rgba(0,0,0,0.9); border-left: 5px solid var(--neon); padding: 15px; margin-bottom: 10px; font-size: 12px; }
    </style>
</head>
<body>
    <div id="toast-container"></div>
    <div class="recovery-card">
        <h4 style="font-family: 'Orbitron'; text-align: center;">[ ACCESS_RECOVERY ]</h4>
        <p style="font-size: 11px; color: #666; text-align: center;" class="mb-4">ENTER_REGISTERED_EMAIL_TO_RECEIVE_RESET_TOKEN</p>
        
        <form action="process-forgot-password.php" method="POST">
            <div class="form-group">
                <label style="font-size: 10px; color: var(--neon);">IDENTIFIED_EMAIL_NODE</label>
                <input type="email" name="email" class="form-control" placeholder="admin@nctd.gov.gh" required>
            </div>
            <button type="submit" name="recover_access" class="btn-comm mt-3">INITIATE_RECOVERY</button>
            <div class="text-center mt-4">
                <a href="login" style="color: red; font-weight: bold; font-size: 11px;  text-decoration: none;">RETURN_TO_LOGIN</a>
            </div>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <?php if(isset($_SESSION['status'])): ?>
    <script>
        const msg = "<?= $_SESSION['status'] ?>";
        const type = "<?= $_SESSION['status_code'] ?>";
        $(`<div class="t-toast" style="border-color: ${type === 'error' ? '#ff3e3e' : '#00f2ff'}">[SIGNAL]: ${msg}</div>`)
            .appendTo('#toast-container').delay(5000).fadeOut();
    </script>
    <?php unset($_SESSION['status']); unset($_SESSION['status_code']); endif; ?>
</body>
</html>