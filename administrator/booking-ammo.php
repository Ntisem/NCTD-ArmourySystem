<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}

$stmt = $pdo->prepare("SELECT adminID, fullname, rank FROM admin_lists WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$admin = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>COMMAND_TERMINAL | AMMO_BOOKING</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root { --neon: #00f2ff; --bg-deep: #020408; --card-bg: #0a0d12; --danger: #ff3333; }
        body { background: var(--bg-deep); font-family: 'JetBrains Mono', monospace; color: #e0e0e0; }
        
        .tactical-card { 
            background: var(--card-bg) !important; 
            border: 1px solid rgba(0, 242, 255, 0.2) !important; 
            border-radius: 0;
            box-shadow: inset 0 0 50px rgba(0,0,0,0.8);
        }

        .tactical-section { 
            border: 1px solid rgba(0, 242, 255, 0.1); 
            padding: 25px; 
            margin-bottom: 30px; 
            background: rgba(0, 242, 255, 0.01);
            position: relative;
        }

        .section-header { 
            position: absolute; top: -12px; left: 15px; 
            background: var(--card-bg); padding: 0 10px; 
            color: var(--neon); font-size: 11px; letter-spacing: 2px;
        }

        .form-control { 
            background: #000 !important; 
            border: 1px solid var(--neon) !important; /* Tactical Border */
            color: var(--neon) !important; 
            border-radius: 0 !important; 
        }

        .form-control:focus { box-shadow: 0 0 15px rgba(0, 242, 255, 0.4); }
        
        label { color: #8b949e; text-transform: uppercase; font-size: 10px; margin-bottom: 8px; display: block; }

        #toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; }
        .t-toast { background: #000; border: 1px solid var(--neon); color: #fff; padding: 15px 25px; margin-bottom: 10px; min-width: 250px; display:none; border-left: 5px solid var(--neon); }
        .t-success { border-left-color: #00ff88; }
        .t-error { border-left-color: var(--danger); }
        
        .ui-autocomplete { background: #000 !important; border: 1px solid var(--neon) !important; color: var(--neon) !important; }
    </style>
</head>
<body>    
    <div id="toast-container"></div>
    <div class="container-scroller">
        <?php include_once('includes/sidebar.php');?>
        <div class="container-fluid page-body-wrapper">
            <?php include_once('includes/navbar.php');?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="card" style="margin-bottom:30px;">
                         <div class="card-body">
                            <a href="booking" type="button" class="btn btn-outline-info btn-fw ">[ Firearm ]</a>
                            <a href="booking-ammo" type="button" class="btn btn-outline-danger btn-fw">[ Ammunition ]</a>
                           </div>
                        </div>
                    <div class="tactical-card card">
                        <div class="card-body">
                            <h3 class="mb-5 text-info text-center">[ AMMUNITION_DEPLOYMENT_ORDER ]</h3>
                            
                            <form id="ammoForm" action="process-booking-ammo.php" method="POST">
                                <div class="tactical-section">
                                    <span class="section-header">01_PERSONNEL_IDENTIFICATION</span>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>ASSIGN_TO_OFFICER</label>
                                            <input type="text" id="to_officer" name="to_officer" class="form-control" placeholder="SEARCH_SERVICE_NO..." required>
                                            <input type="hidden" name="officerID" id="officerID">
                                            <input type="hidden" name="officer_image" id="officer_image">
                                        </div>
                                        <div class="col-md-6">
                                            <label>ISSUING_administrator</label>
                                            <input type="text" class="form-control" value="<?php echo $admin['rank'] . ' ' . $admin['fullname']?>" readonly>
                                            <input type="hidden" name="administrator_issuer" value="<?php echo $admin['rank'] . ' ' . $admin['fullname']?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="tactical-section">
                                    <span class="section-header">02_STOCK_SELECTION</span>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label>AMMO_TYPE_NAME</label>
                                            <input type="text" id="ammo_name" name="ammo_name" class="form-control" placeholder="CALIBER..." required>
                                            <input type="hidden" name="ammoID" id="ammoID">
                                        </div>
                                        <div class="col-md-4">
                                            <label>CURRENT_STOCK_LEVEL</label>
                                            <input type="text" id="ammo_total_rounds" class="form-control" readonly>
                                        </div>
                                        <div class="col-md-4">
                                            <label>QUANTITY_TO_ISSUE</label>
                                            <input type="number" name="ammo_rounds" class="form-control" value="0" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="tactical-section">
                                    <span class="section-header">03_MISSION_DATA</span>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label>DUTY_CATEGORY</label>
                                            <select name="duty_type" class="form-control">
                                                <option value="General Duty">General Duty</option>
                                                <option value="Escort">Escort</option>
                                                <option value="Patrol">Patrol</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>LOCATION_SECTOR</label>
                                            <input type="text" name="duty_location" class="form-control" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label>ESTIMATED_DURATION</label>
                                            <div id="duration-container">
                                                <select id="duration_select" name="duty_duration" class="form-control" onchange="checkCustomDuration(this)">
                                                    <option value="12 Hours">12 Hours</option>
                                                    <option value="24 Hours">24 Hours</option>
                                                    <option value="7 Days">7 Days</option>
                                                    <option value="custom">[ MANUAL_ENTRY ]</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>POST_ORDERS_REMARKS</label>
                                            <textarea name="ammo_comment" class="form-control" rows="6"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" name="booking_ammo" class="btn btn-block btn-outline-info btn-lg">EXECUTE_RELEASE</button>
                            </form>
                        </div>
                    </div>
                </div>
                    <?php include_once('includes/footer.php');?>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
    $(document).ready(function() {
        function showToast(msg, type) {
            const toast = $(`<div class="t-toast ${type}">[SIGNAL]: ${msg}</div>`);
            $("#toast-container").append(toast);
            toast.fadeIn().delay(4000).fadeOut(function() { $(this).remove(); });
        }

        // Officer Autocomplete
        $("#to_officer").autocomplete({
            source: function(req, res) { $.post("fetchData_officer.php", { search: req.term }, res, "json"); },
            select: function(event, ui) {
                $("#to_officer").val(ui.item.label);
                $("#officerID").val(ui.item.value);
                $("#officer_image").val(ui.item.value2);
                return false;
            }
        });

        // Ammo Autocomplete + Stock Autofill
        $("#ammo_name").autocomplete({
            source: function(req, res) { $.post("fetchData_ammo.php", { search: req.term }, res, "json"); },
            select: function(event, ui) {
                $("#ammo_name").val(ui.item.label);
                $("#ammoID").val(ui.item.value);
                // Standardizing to 'value2' which matches your fetchData_ammo.php
                $("#ammo_total_rounds").val(ui.item.value2 || ui.item.stock); 
                return false;
            }
        });

        const urlParams = new URLSearchParams(window.location.search);
        if(urlParams.get('status') === 'success') showToast('TRANSACTION_COMMITTED', 't-success');
        if(urlParams.get('status') === 'error') showToast('TRANSACTION_FAILED', 't-error');
    });

    function checkCustomDuration(select) {
        if (select.value === 'custom') {
            document.getElementById('duration-container').innerHTML = `
                <div class="input-group">
                    <input type="text" name="duty_duration" class="form-control" placeholder="e.g. 45 Days" autofocus required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-info" type="button" onclick="location.reload()"><i class="mdi mdi-refresh"></i></button>
                    </div>
                </div>`;
        }
    }
    </script>
</body>
</html>