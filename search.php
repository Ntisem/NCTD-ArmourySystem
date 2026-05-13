<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>INTEL_HUB | CROSS_SCAN</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=JetBrains+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root {
            --neon-cyan: #00f2ff;
            --cmd-bg: #05070a;
            --panel-alpha: rgba(13, 17, 23, 0.98);
        }
        body { background-color: var(--cmd-bg); font-family: 'JetBrains Mono', monospace; }
        
        .main-panel { background: var(--cmd-bg); }
        
        .tactical-card {
            background: var(--panel-alpha);
            border: 1px solid rgba(0, 242, 255, 0.15);
            box-shadow: 0 0 40px rgba(0, 0, 0, 0.8);
            border-radius: 0;
            padding: 40px;
        }
        
        .scanner-bar {
            background: #000 !important;
            border: 1px solid var(--neon-cyan) !important;
            color: var(--neon-cyan) !important;
            height: 70px;
            font-size: 1.4rem;
            text-transform: uppercase;
            letter-spacing: 3px;
            border-radius: 0;
            font-family: 'Orbitron', sans-serif;
        }

        .tactical-result-item {
            background: rgba(255, 255, 255, 0.02) !important;
            border: 1px solid rgba(255, 255, 255, 0.05) !important;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .tactical-result-item:hover {
            background: rgba(0, 242, 255, 0.08) !important;
            border-color: var(--neon-cyan) !important;
            transform: scale(1.01);
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.1);
        }

        .status-available { width: 8px; height: 8px; background: var(--neon-cyan); border-radius: 50%; box-shadow: 0 0 10px var(--neon-cyan); }
        .status-busy { width: 8px; height: 8px; background: #ff3e3e; border-radius: 50%; box-shadow: 0 0 10px #ff3e3e; }
        
        .status-available-badge { border: 1px solid var(--neon-cyan); color: var(--neon-cyan); background: transparent; font-size: 0.65rem; letter-spacing: 1px; }
        .status-busy-badge { border: 1px solid #ff3e3e; color: #ff3e3e; background: transparent; font-size: 0.65rem; letter-spacing: 1px; }
        
        .tracking-wider { letter-spacing: 2px; }
    </style>
</head>
<body>
    <div class="container-scroller">
        <?php include('includes/sidebar.php'); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include('includes/navbar.php'); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row justify-content-center">
                        <div class="col-lg-11">
                            <div class="tactical-card">
                                <div class="d-flex justify-content-between align-items-end mb-4">
                                    <div>
                                        <h1 class="mb-1" style="font-family: 'Orbitron'; color: var(--neon-cyan); text-shadow: 0 0 10px rgba(0, 242, 255, 0.3);">INTEL_DATABASE_SCAN</h1>
                                        <p class="text-muted small mb-0">AUTHORIZED PERSONNEL ONLY // CROSS-LINKING 6 CORE TABLES</p>
                                    </div>
                                    <div class="text-right d-none d-md-block">
                                        <span class="text-info small font-weight-bold tracking-wider">SYSTEM_STATUS: ACTIVE</span>
                                    </div>
                                </div>

                                <div class="form-group position-relative">
                                    <input type="text" id="intel_search_input" class="form-control scanner-bar" placeholder="INITIATE COMMAND SEQUENCE..." autocomplete="off">
                                    <div class="mt-2 text-right">
                                        <small class="text-muted italic" style="font-size: 0.7rem;">SEARCH_BY: SERIAL, NAME, SERVICE_NO, OR ASSET_CLASS</small>
                                    </div>
                                </div>

                                <div id="intel_results_display" class="mt-5" style="display:none;">
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include('includes/footer.php'); ?>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script>
    $(document).ready(function(){
        $('#intel_search_input').on('keyup', function(){
            let val = $(this).val();
            if(val.length > 1) {
                $.ajax({
                    url: "search-intel-backend.php",
                    method: "POST",
                    data: { query: val },
                    beforeSend: function() {
                        // Optional: Add a processing state to the border
                        $('.scanner-bar').css('border-color', '#f9a602');
                    },
                    success: function(response) {
                        $('.scanner-bar').css('border-color', '#00f2ff');
                        $('#intel_results_display').fadeIn(200).html(response);
                    }
                });
            } else {
                $('#intel_results_display').fadeOut(100);
            }
        });
    });
    </script>
</body>
</html>