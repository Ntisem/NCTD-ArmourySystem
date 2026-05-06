<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
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
    <title>INTEL_HUB | VERTEX</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        .tactical-search-container {
            background: rgba(5, 10, 15, 0.95);
            border: 1px solid rgba(0, 242, 255, 0.2);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.8);
            padding: 30px;
        }
        #global_search {
            background: #000 !important;
            border: 1px solid var(--neon-cyan);
            color: var(--neon-cyan) !important;
            font-family: 'JetBrains Mono', monospace;
            height: 60px;
            font-size: 1.2rem;
        }
        #intel_results_list {
            position: absolute;
            z-index: 1000;
            width: 100%;
            max-width: 93%;
            box-shadow: 0 10px 30px rgba(0,0,0,0.5);
        }
        
    </style>
</head>
<body class="sidebar-fixed">
    <div class="container-scroller">
        <?php include('includes/sidebar.php'); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include('includes/navbar.php'); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="tactical-search-container">
                                <h3 class="text-white mb-4" style="font-family: 'Orbitron'; letter-spacing: 2px;">
                                    GLOBAL_INTEL_SCANNER
                                </h3>
                                <div class="form-group position-relative">
                                    <input type="text" id="global_search" class="form-control" autocomplete="off" placeholder="SCANNING_FOR: SERIAL_NO, OFFICER_NAME, OR ASSET_ID...">
                                    <div id="intel_results_list"></div>
                                </div>
                                <div class="mt-4 text-muted small">
                                    <i class="mdi mdi-information-outline mr-2 text-info"></i>
                                    ACTIVE TABLES: firearms, officers, ammunitions, locations
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script>
    $(document).ready(function(){
        $('#global_search').on('keyup', function(){
            var query = $(this).val();
            if(query.length > 1) {
                $.ajax({
                    url: "search-intel-backend.php",
                    method: "POST",
                    data: {query: query},
                    success: function(data) {
                        $('#intel_results_list').fadeIn().html(data);
                    }
                });
            } else {
                $('#intel_results_list').fadeOut();
            }
        });
    });
    </script>
</body>
</html>