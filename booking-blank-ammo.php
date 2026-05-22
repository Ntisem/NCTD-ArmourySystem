<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

$stmt = $pdo->prepare("SELECT adminID, fullname, rank FROM admin_lists WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$admin = $stmt->fetch();
$adminID = $admin['adminID'];
$_SESSION['adminID'] = $adminID; // Store adminID in session for later use
$adminName = $admin['fullname'];
$_SESSION['adminName'] = $adminName; // Store admin name in session for later use   
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>COMMAND_TERMINAL | BLANK AMMO_BOOKING</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root { --neon: #00f2ff; --bg-deep: #020408; --card-bg: #0a0d12; --danger: #ff3333; --success: #00ff88; }
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
            font-weight: bold;
        }

        .form-control { 
            background: #000 !important; 
            border: 1px solid var(--neon) !important;
            color: var(--neon) !important; 
            border-radius: 0 !important; 
            font-family: 'JetBrains Mono', monospace;
        }

        .form-control:focus { box-shadow: 0 0 15px rgba(0, 242, 255, 0.4); }
        
        label { color: #8b949e; text-transform: uppercase; font-size: 10px; margin-bottom: 8px; display: block; letter-spacing: 1px; }

        #tactical-toast-container { position: fixed; top: 20px; right: 20px; z-index: 99999; }
        .t-toast { 
            background: #05070a; 
            border: 1px solid var(--neon); 
            color: #fff; 
            padding: 15px 25px; 
            margin-bottom: 10px; 
            min-width: 300px; 
            border-left: 5px solid var(--neon);
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            letter-spacing: 1px;
            box-shadow: 0 0 20px rgba(0, 242, 255, 0.2);
            display: none;
        }
        .t-success { border-left-color: var(--success); border-color: rgba(0, 255, 136, 0.5); }
        .t-error { border-left-color: var(--danger); border-color: rgba(255, 51, 51, 0.5); }
        
        .ui-autocomplete { 
            background: #05070a !important; 
            border: 1px solid var(--neon) !important; 
            color: var(--neon) !important;
            border-radius: 0 !important;
        }
        .ui-menu-item-wrapper:hover {
            background: var(--neon) !important;
            color: #000 !important;
        }
        .btn-neon {
            border: 1px solid var(--neon);
            color: var(--neon);
            background: transparent;
            border-radius: 0;
            font-size: 12px;
            letter-spacing: 1px;
            transition: all 0.3s ease;
        }
        .btn-neon:hover {
            background: var(--neon);
            color: #000;
            box-shadow: 0 0 15px var(--neon);
        }
    </style>
</head>
<body>    
    <div id="tactical-toast-container"></div>
    <div class="container-scroller">
        <?php include_once('includes/sidebar.php');?>
        <div class="container-fluid page-body-wrapper">
            <?php include_once('includes/navbar.php');?>
            <div class="main-panel">
                <div class="content-wrapper">
                   <a href="booked-blank-ammo" class="btn btn-neon mb-4"><i class="mdi mdi-arrow-left"></i> [ VIEW_REGISTRY_LOGS ]</a>
                   <div class="tactical-card card">
                        <div class="card-body">
                            <h3 class="mb-5 text-center" style="color: var(--neon); font-family: 'JetBrains Mono'; font-weight: bold;">[ BLANK_AMMO_DEPLOYMENT_ORDER ]</h3>
                            
                            <form id="ammoForm" action="process-booking-blank-ammo.php" method="POST">
                                <div class="tactical-section">
                                    <span class="section-header">01_PERSONNEL_IDENTIFICATION</span>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>ASSIGN_TO_OFFICER</label>
                                            <input type="text" id="to_officer" name="to_officer" class="form-control" placeholder="SEARCH_SERVICE_NO..." autocomplete="off" required>
                                            <input type="hidden" name="officerID" id="officerID">
                                            <input type="hidden" name="officer_image" id="officer_image">
                                        </div>
                                        <div class="col-md-6">
                                            <label>ISSUING_ARMOURER</label>
                                            <input type="text" class="form-control" value="<?php echo $admin['rank'] . ' ' . $admin['fullname']?>" readonly>
                                            <input type="hidden" name="armourer_issuer" value="<?php echo $admin['rank'] . ' ' . $admin['fullname']?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="tactical-section">
                                    <span class="section-header">02_STOCK_SELECTION</span>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label>AMMO_TYPE_NAME</label>
                                            <input type="text" id="faulty_ammo_name" name="faulty_ammo_name" class="form-control" placeholder="CALIBER..." autocomplete="off" required>
                                            <input type="hidden" name="faulty_ammoID" id="faulty_ammoID">
                                        </div>
                                        <div class="col-md-4">
                                            <label>CURRENT_STOCK_LEVEL</label>
                                            <input type="text" id="faulty_ammo_stock" class="form-control" readonly placeholder="0">
                                        </div>
                                        <div class="col-md-4">
                                            <label>QUANTITY_TO_ISSUE</label>
                                            <input type="number" name="faulty_ammo_rounds" id="faulty_ammo_rounds" class="form-control" min="1" required>
                                        </div>
                                    </div>
                                </div>

                                <div class="tactical-section">
                                    <span class="section-header">03_MISSION_DATA</span>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label>DUTY_CATEGORY</label>
                                            <select name="duty_type" class="form-control" required>
                                                <option value="">~Select Duty Category~</option>
                                                <option value="Training">Training</option>
                                                <option value="General Duty">General Duty</option>
                                                <option value="Escort">Escort</option>
                                                <option value="Patrol">Patrol</option>
                                                <option value="Trash/Dump">Trash/Dump</option>
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
                                            <textarea name="faulty_ammo_comment" class="form-control" rows="4"></textarea>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" name="booking_blank_ammo" class="btn btn-block btn-neon btn-lg">EXECUTE_RELEASE</button>
                            </form>
                        </div>
                    </div>
                </div>
                <?php require_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
    <script>
    function showToast(msg, type) {
        const toast = $(`<div class="t-toast ${type}">[TERMINAL]: ${msg}</div>`);
        $("#tactical-toast-container").append(toast);
        toast.slideDown(200).delay(4000).slideUp(200, function() { $(this).remove(); });
    }

    $(document).ready(function() {
        $("#to_officer").autocomplete({
            source: function(req, res) { $.post("fetchData_officer.php", { search: req.term }, res, "json"); },
            select: function(event, ui) {
                $("#to_officer").val(ui.item.label);
                $("#officerID").val(ui.item.value);
                $("#officer_image").val(ui.item.value2);
                return false;
            }
        });

        $("#faulty_ammo_name").autocomplete({
            source: function(req, res) { $.post("fetch-blank-ammo.php", { search: req.term }, res, "json"); },
            select: function(event, ui) {
                $("#faulty_ammo_name").val(ui.item.label);
                $("#faulty_ammoID").val(ui.item.value);
                $("#faulty_ammo_stock").val(ui.item.stock); 
                return false;
            }
        });

        const urlParams = new URLSearchParams(window.location.search);
        if(urlParams.get('status') === 'success') showToast('TRANSACTION_COMMITTED_SUCCESSFULLY', 't-success');
        if(urlParams.get('status') === 'error') {
            let msg = urlParams.get('msg') || 'TRANSACTION_FAILED_EXCEPTION';
            showToast('ERROR: ' + msg, 't-error');
        }
    });

    function checkCustomDuration(select) {
        if (select.value === 'custom') {
            document.getElementById('duration-container').innerHTML = `
                <div class="input-group">
                    <input type="text" name="duty_duration" class="form-control" placeholder="e.g. 45 Days" autofocus required>
                    <div class="input-group-append">
                        <button class="btn btn-neon" type="button" onclick="location.reload()"><i class="mdi mdi-refresh"></i></button>
                    </div>
                </div>`;
        }
    }
    </script>
</body>
</html>