<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>INTEL_HUB | COMMAND_CENTER</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=JetBrains+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root {
            --neon-cyan: #00f2ff;
            --cmd-bg: #05070a;
            --panel-alpha: rgba(13, 17, 23, 0.95);
        }
        body { 
            background-color: var(--cmd-bg); 
            font-family: 'JetBrains Mono', monospace; 
            color: #fff;
            overflow-x: hidden;
        }
        .intel-container {
            border: 1px solid rgba(0, 242, 255, 0.2);
            background: var(--panel-alpha);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.9);
            padding: 40px;
            margin-top: 80px;
            position: relative;
        }
        .intel-container::before {
            content: "";
            position: absolute;
            top: 0; left: 0; width: 100%; height: 2px;
            background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
            animation: scanline 4s linear infinite;
        }
        @keyframes scanline {
            0% { top: 0; } 100% { top: 100%; }
        }
        .scanner-input {
            background: #000 !important;
            border: 1px solid var(--neon-cyan) !important;
            color: var(--neon-cyan) !important;
            height: 60px;
            font-size: 1.2rem;
            letter-spacing: 2px;
            text-transform: uppercase;
        }
        .tactical-result-item {
            background: rgba(255, 255, 255, 0.02) !important;
            border: none !important;
            border-left: 4px solid transparent !important;
            margin-bottom: 8px;
            transition: all 0.3s ease;
        }
        .tactical-result-item:hover {
            background: rgba(0, 242, 255, 0.08) !important;
            border-left: 4px solid var(--neon-cyan) !important;
            transform: translateX(10px);
        }
        .tracking-wider { letter-spacing: 1.5px; }
    </style>
</head>
<body>
    <?php include('includes/navbar.php'); ?>
    
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 intel-container">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3 style="font-family: 'Orbitron'; color: var(--neon-cyan);">DATABASE_INTEL_SCANNER</h3>
                    <small class="text-muted">SYSTEM_STATUS: <span class="text-success">ENCRYPTED</span></small>
                </div>
                
                <div class="form-group position-relative">
                    <input type="text" id="intel_query" class="form-control scanner-input" placeholder="INPUT SEARCH PARAMETERS (NAME, SERIAL, SERVICE_NO)..." autocomplete="off">
                </div>

                <div id="intel_output" class="mt-4" style="display:none;">
                    </div>

                <div class="mt-5 small text-muted border-top pt-3 opacity-5">
                    <div class="row">
                        <div class="col-md-6">ACTIVE_NODES: FIREARMS, AMMO, OFFICERS, ADMIN</div>
                        <div class="col-md-6 text-right">PROTOCOL: PDO_SQL_SECURE</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
    /* Fixed Tactical Footer Styling */
    .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: #0a0c10 !important;
        border-top: 2px solid #f9a602;
        padding: 15px 0;
        z-index: 1030; /* Ensures it stays above page content */
        box-shadow: 0 -5px 20px rgba(249, 166, 2, 0.15);
    }

    /* Prevent content from being hidden behind the footer */
    body {
        padding-bottom: 70px; /* Match this to the footer height */
    }

    .tactical-alert {
        background-color: #05070a !important;
        border: 1px solid var(--neon-cyan) !important;
    }
    
    .swal-title { color: var(--neon-cyan) !important; font-family: 'Orbitron'; }
    .swal-text { color: #8a8d93 !important; font-family: 'Roboto Mono'; }
    
    /* Back to top adjustment for fixed footer */
    .back-to-top {
        position: fixed; 
        bottom: 80px; /* Moved up to sit above the fixed footer */
        right: 20px;
        background: #f9a602;
        padding: 10px;
        border-radius: 2px;
        box-shadow: 0 0 10px rgba(249, 166, 2, 0.5);
        z-index: 1031;
    }
</style>

<footer class="footer">
    <div class="container-fluid">
        <div class="d-sm-flex justify-content-center justify-content-sm-between align-items-center">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block" style="color: #fff !important;">
                <span style="color: #f9a602;">[SECURE_SYSTEM: <span style="color: #28a745;">ACTIVE</span>]</span> GPS | NATIONAL COUNTER TERRORISM DEPT.
            </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center" style="color: #6c7293; font-size: 0.8rem; font-family: 'JetBrains Mono', monospace;">
                DEV: <span>C/INSPR W. NTISEM</span> | &copy; <?php echo date("Y"); ?>
            </span>
        </div>
    </div>
</footer>

<a href="#" class="back-to-top">
    <i class="mdi mdi-arrow-up-bold"></i>
</a>

<script src="assets/js/sweetalert.min.js"></script>
<script src="assets/js/clock.js"></script>

<script>
<?php if(isset($_SESSION['status']) && $_SESSION['status'] != ''): ?>
    swal({
        title: "<?php echo $_SESSION['status'];?>",
        icon: "<?php echo $_SESSION['status_code'];?>",
        button: "ACKNOWLEDGE",
        className: "tactical-alert"
    });
<?php unset($_SESSION['status']); endif; ?>
</script>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script>
    $(document).ready(function(){
        $('#intel_query').on('keyup', function(){
            let query = $(this).val();
            if(query.length > 1) {
                $.ajax({
                    url: "search-intel-backend.php",
                    method: "POST",
                    data: { query: query },
                    beforeSend: function() {
                        // Optional: Add a subtle loading pulse to the input
                    },
                    success: function(data) {
                        $('#intel_output').fadeIn(200).html(data);
                    }
                });
            } else {
                $('#intel_output').fadeOut(100);
            }
        });
    });
    </script>
</body>
</html>