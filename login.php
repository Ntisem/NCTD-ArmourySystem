<?php
require_once('connections/connect-db.php');
require_once('includes/redirect.php');

if (isset($_POST['username'])) {
    $username = trim($_POST['username']);
    $password = md5($_POST['password']); 
    $last_login_time = gmdate("l jS \of F Y h:i:s A");

    try {
        $stmt = $pdo->prepare("SELECT * FROM `admin_lists` WHERE username = :user AND `password` = :pass LIMIT 1");
        $stmt->execute(['user' => $username, 'pass' => $password]);
        $row = $stmt->fetch();

        if ($row) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['IS_LOGIN'] = 'yes';
            $_SESSION['fullname'] = $row['fullname'];
            $_SESSION['rank'] = $row['rank'];
            $_SESSION['user_role'] = $row['user_role'];
            
            $log_stmt = $pdo->prepare("INSERT INTO `login_activity`(`admin_username`, `user_role`, `last_login_time`) VALUES (?, ?, ?)");
            $log_stmt->execute([$row['username'], $row['user_role'], $last_login_time]);

            $_SESSION['status'] = "UPLINK ESTABLISHED: WELCOME " . strtoupper($row['rank']) . " " . strtoupper($row['fullname']);
            $_SESSION['status_code'] = "success";

            $redirect_link = $_REQUEST['page_url'] ?? "";
            $location = ($row['user_role'] == "Administrator") 
                ? (($redirect_link == "") ? "administrator/index" : $redirect_link)
                : (($redirect_link == "") ? "armourer" : $redirect_link);
            
            $_SESSION['redirect_to'] = $location;
        } else {
            $_SESSION['status'] = "CRITICAL: AUTHENTICATION FAILURE - INVALID CREDENTIALS";
            $_SESSION['status_code'] = "error";
        }
    } catch (PDOException $e) {
        $_SESSION['status'] = "SYS_ERR: " . strtoupper($e->getMessage());
        $_SESSION['status_code'] = "error";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TERMINAL LOGIN | VERTEX OS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=JetBrains+Mono:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="plugins/icon-kit/dist/css/iconkit.min.css">
    
    <style>
        :root {
            --neon-cyan: #00f2ff;
            --tactical-bg: #020406;
            --panel-bg: rgba(5, 10, 15, 0.95);
            --tactical-red: #ff3e3e;
            --glass-cyan: rgba(0, 242, 255, 0.1);
        }

        body {
            background-color: var(--tactical-bg);
            font-family: 'JetBrains Mono', monospace;
            margin: 0;
            overflow: hidden;
        }

        #matrix-canvas {
            position: fixed;
            top: 0; left: 0; width: 100%; height: 100%;
            z-index: -1;
            opacity: 0.5;
        }

        .auth-wrapper {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .tactical-frame {
            position: relative;
            background: var(--panel-bg);
            border: 2px solid #1a202c;
            width: 100%;
            max-width: 480px;
            padding: 50px 40px;
            box-shadow: 0 0 50px rgba(0, 0, 0, 0.8);
            clip-path: polygon(20px 0, 100% 0, 100% calc(100% - 20px), calc(100% - 20px) 100%, 0 100%, 0 20px);
        }

        h3 {
            font-family: 'Orbitron', sans-serif;
            color: #fff;
            text-transform: uppercase;
            font-size: 1.1rem;
            letter-spacing: 4px;
            margin-bottom: 40px;
            text-align: center;
        }

        .input-box {
            position: relative;
            margin-bottom: 30px;
            border-bottom: 1px solid rgba(0, 242, 255, 0.2);
        }

        .form-control {
            background: transparent !important;
            border: none !important;
            color: var(--neon-cyan) !important;
            padding-left: 35px;
            font-size: 0.85rem;
            height: 45px;
            width: 100%;
            outline: none;
        }
        
        .corner-tag {
            position: absolute;
            font-size: 9px;
            color: var(--neon-cyan);
            opacity: 0.6;
            letter-spacing: 1.5px;
        }
        .top-right { top: 10px; right: 20px; }
        .bottom-left { bottom: 10px; left: 20px; }


        .btn-initialize {
            width: 100%;
            background: var(--glass-cyan);
            border: 1px solid var(--neon-cyan);
            color: var(--neon-cyan);
            font-family: 'Orbitron', sans-serif;
            padding: 15px;
            cursor: pointer;
            transition: 0.3s;
        }
  .telemetry {
            display: flex;
            justify-content: space-between;
            margin-top: 25px;
            font-size: 10px;
            color: rgba(255, 255, 255, 0.3);
            border-top: 1px solid rgba(255, 255, 255, 0.05);
            padding-top: 15px;
        }

        .btn-initialize:hover {
            background: var(--neon-cyan);
            color: #000;
            box-shadow: 0 0 25px var(--neon-cyan);
        }

        /* Sweep UI Styles */
        #sweep-container { display: none; margin-top: 25px; }
        .sweep-label { font-size: 9px; color: var(--neon-cyan); margin-bottom: 5px; display: flex; justify-content: space-between; }
        .sweep-bar { height: 4px; background: rgba(0, 242, 255, 0.1); position: relative; overflow: hidden; }
        .sweep-progress { width: 0%; height: 100%; background: var(--neon-cyan); box-shadow: 0 0 15px var(--neon-cyan); transition: width 1.2s ease-out; }

        /* Toast Styles */
        #toast-container { position: fixed; top: 20px; right: 20px; z-index: 1000; }
        .tactical-toast { min-width: 300px; padding: 15px; background: rgba(5, 10, 15, 0.95); border-left: 4px solid var(--neon-cyan); color: #fff; font-size: 12px; margin-bottom: 10px; display: flex; align-items: center; gap: 15px; border: 1px solid rgba(255,255,255,0.1); border-left-width: 4px; }
        .tactical-toast.error { border-left-color: var(--tactical-red); }
    </style>
</head>

<body>
    <canvas id="matrix-canvas"></canvas>
    <div id="toast-container"></div>
    
    <div class="auth-wrapper">
        <div class="tactical-frame">
             <span class="corner-tag top-right">SRC_ADDR: 127.0.0.1</span>
            <div class="text-center mb-4">
                <img src="assets/images/gps_logo_blue.png" alt="GPS" width="70">
            </div>
            <h3>NCTD ARMOURY SYSTEM</h3>
             <h3>USER ACCESS PORTAL</h3>
            <form method="POST" action="" id="login-form">
                <div class="input-box">
                    <i class="ik ik-terminal" style="position:absolute; left:0; top:12px; color:var(--neon-cyan)"></i>
                    <input type="text" name="username" class="form-control" placeholder="ID // USERNAME" required>
                </div>
                <div class="input-box">
                    <i class="ik ik-shield" style="position:absolute; left:0; top:12px; color:var(--neon-cyan)"></i>
                    <input type="password" name="password" class="form-control" placeholder="KEY // PASSWORD" required>
                </div>

                <button class="btn-initialize" type="submit" id="btn-submit">
                    [ INITIALIZE UPLINK ]
                </button>

                <div id="sweep-container">
                    <div class="sweep-label">
                        <span>SECURITY_SWEEP_IN_PROGRESS...</span>
                        <span id="sweep-percent">0%</span>
                    </div>
                    <div class="sweep-bar">
                        <div class="sweep-progress" id="progress-line"></div>
                    </div>
                </div>
            <div class="telemetry">
                    <span>SYS_STATE: <span style="color:#0f0">ACTIVE</span></span>
                    <span id="system-clock">00:00:00 UTC</span>
                </div>
            </form>
            
            <span class="corner-tag bottom-left">NCTD ARMOURY SYSTEM // v2.0.6</span>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
        // Matrix Rain
        const canvas = document.getElementById('matrix-canvas');
        const ctx = canvas.getContext('2d');
        canvas.width = window.innerWidth;
        canvas.height = window.innerHeight;
        const alphabet = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        const rainDrops = Array.from({ length: canvas.width / 16 }).fill(1);
        function draw() {
            ctx.fillStyle = 'rgba(2, 4, 6, 0.05)';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
            ctx.fillStyle = '#00f2ff';
            ctx.font = '16px monospace';
            rainDrops.forEach((y, i) => {
                const text = alphabet.charAt(Math.floor(Math.random() * alphabet.length));
                ctx.fillText(text, i * 16, y * 16);
                if (y * 16 > canvas.height && Math.random() > 0.975) rainDrops[i] = 0;
                rainDrops[i]++;
            });
        }
        setInterval(draw, 35);

        // Toast Engine
        function showToast(msg, type) {
            const toast = document.createElement('div');
            toast.className = `tactical-toast ${type}`;
            toast.innerHTML = `<i class="ik ik-info"></i><div>${msg}</div>`;
            document.getElementById('toast-container').appendChild(toast);
            setTimeout(() => toast.remove(), 4000);
        }

        // Form Submission Sweep
        document.getElementById('login-form').onsubmit = function() {
            document.getElementById('btn-submit').style.display = 'none';
            document.getElementById('sweep-container').style.display = 'block';
            
            let progress = 0;
            const line = document.getElementById('progress-line');
            const pct = document.getElementById('sweep-percent');
            
            const interval = setInterval(() => {
                progress += Math.floor(Math.random() * 15);
                if (progress >= 100) {
                    progress = 100;
                    clearInterval(interval);
                }
                line.style.width = progress + '%';
                pct.textContent = progress + '%';
            }, 100);
        };
    </script>

    <?php if(isset($_SESSION['status'])): ?>
    <script>
        showToast("<?php echo $_SESSION['status'];?>", "<?php echo $_SESSION['status_code'];?>");
        <?php if($_SESSION['status_code'] === 'success' && isset($_SESSION['redirect_to'])): ?>
            setTimeout(() => { window.location.href = "<?php echo $_SESSION['redirect_to']; ?>"; }, 1500);
        <?php endif; ?>
    </script>
    <?php unset($_SESSION['status']); unset($_SESSION['status_code']); unset($_SESSION['redirect_to']); endif; ?>
</body>
</html>