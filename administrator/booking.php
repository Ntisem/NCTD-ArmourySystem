<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded


// Access Control
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}

$stmt = $pdo->prepare("SELECT adminID, fullname FROM admin_lists WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$admin = $stmt->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>COMMAND_TERMINAL | ASSET_BOOKING</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root { --neon: #00f2ff; --bg-deep: #020408; --card-bg: #0a0d12; --input-border: #00f2ff; --danger: #ff3333; }
        body { background: var(--bg-deep); font-family: 'JetBrains Mono', monospace; color: #e0e0e0; }
        .tactical-card { background: var(--card-bg) !important; border: 1px solid rgba(0, 242, 255, 0.2) !important; border-radius: 0; box-shadow: 0 10px 30px rgba(0,0,0,0.5); }
        .tactical-section { border: 1px solid rgba(0, 242, 255, 0.1); padding: 25px; margin-bottom: 30px; background: rgba(0, 242, 255, 0.02); position: relative; }
        .section-header { position: absolute; top: -12px; left: 15px; background: var(--card-bg); padding: 0 10px; color: var(--neon); font-size: 11px; letter-spacing: 2px; font-weight: bold; }
        .form-control { background: #000 !important; border: 1px solid var(--input-border) !important; color: var(--neon) !important; border-radius: 0 !important; }
        .form-control:focus { box-shadow: 0 0 15px rgba(0, 242, 255, 0.4); }
        label { color: #8b949e; text-transform: uppercase; font-size: 10px; margin-bottom: 8px; display: block; }
        #toast-container { position: fixed; top: 20px; right: 20px; z-index: 10000; }
        .t-toast { background: #000; border: 1px solid var(--neon); color: #fff; padding: 15px 25px; margin-bottom: 10px; min-width: 280px; display:none; }
        .t-success { border-left: 5px solid #00ff88; }
        .t-error { border-left: 5px solid var(--danger); }
        .low-stock { color: var(--danger); font-weight: bold; animation: blink 1s infinite; }
        @keyframes blink { 50% { opacity: 0; } }
        .ui-autocomplete { background: #000 !important; border: 1px solid var(--neon) !important; color: var(--neon) !important; z-index: 10001; }
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
                            <a href="booking" type="button" class="btn btn-outline-info btn-fw">[ Firearm ]</a>
                            <a href="booking-ammo" type="button" class="btn btn-outline-danger btn-fw">[ Ammunition ]</a>
                           </div>
                        </div>
                    <div class="tactical-card card">
                        <div class="card-body">
                            <h3 class="mb-5 text-info text-center">[ FIREARM_DEPLOYMENT_ORDER ]</h3>
                            <form id="bookingForm" action="process-booking.php" method="POST">
                                <div class="tactical-section">
                                    <span class="section-header">01_PERSONNEL_DATA</span>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>TO_OFFICER (Name/Service No)</label>
                                            <input type="text" id="to_officer" name="to_officer" class="form-control" placeholder="SEARCH..." required>
                                            <input type="hidden" name="officerID" id="officerID">
                                        </div>
                                        <div class="col-md-6">
                                            <label>ISSUING_administrator</label>
                                            <input type="text" class="form-control" value="<?php echo $admin['fullname']; ?>" readonly>
                                            <input type="hidden" name="administrator_issuer" value="<?php echo $admin['fullname']; ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="tactical-section">
                                    <span class="section-header">02_ASSET_ALLOCATION</span>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label>FIREARM_SERIAL_NO</label>
                                            <input type="text" id="firearm_serial_no" name="firearm_serial_no" class="form-control" placeholder="SCAN_SERIAL..." required>
                                            <input type="hidden" name="firearmID" id="firearmID">
                                        </div>
                                        <div class="col-md-4">
                                            <label>FIREARM_NAME (AUTOFILL)</label>
                                            <input type="text" id="firearm_name" name="firearm_name" class="form-control" readonly>
                                        </div>
                                         <div class="col-md-6 p-2">
                                            <label>FIREARM_CLASS</label>
                                            <select name="firearm_class" class="form-control">
                                                <!-- <option value="None">~Select~</option> -->
                                                <option value="Duty-Weapon">Duty Weapon</option>                              
                                                <option value="Training-Weapon">Training Weapon</option>  
                                                <option value="Spare-Weapon">Spare Weapon</option> 
                                            </select>
                                        </div>
                                          <div class="col-md-6 p-2">
                                            <label>FIREARM_STATE</label>
                                            <select name="firearm_state" class="form-control">
                                              <option value="Not-Faulty">Not Faulty</option>                              
                                            <option value="Faulty">Faulty</option>    
                                            <option value="None">None</option>
                                           </select>
                                        </div>
                                        <div class="col-md-6 p-2">
                                            <label>AMMUNITION_TYPE</label>
                                            <input type="text" id="ammunition_name" name="ammunition_name" class="form-control" placeholder="SEARCH_AMMO...">
                                            <input type="hidden" name="ammoID" id="ammoID">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>AVAILABLE_STOCK (AUTOFILL)</label>
                                            <input type="text" id="ammo_total_rounds" class="form-control" readonly>
                                            <span id="stock-status" style="font-size: 10px;"></span>
                                        </div>
                                        <div class="col-md-6">
                                            <label>QUANTITY_ISSUED</label>
                                            <input type="number" name="number_of_rounds" class="form-control" value="0">
                                        </div>
                                    </div>
                                </div>

                                <div class="tactical-section">
                                    <span class="section-header">03_MISSION_LOGISTICS</span>
                                    <div class="row mb-3">
                                        <div class="col-md-4">
                                            <label>TYPE_OF_DUTY</label>
                                            <select name="duty_type" class="form-control">
                                                <option value="General Duty">General Duty</option>
                                                <option value="Escort">Escort</option>
                                                <option value="Special Operation">Special Operation</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label>LOCATION</label>
                                            <input type="text" name="duty_location" class="form-control" placeholder="Eg: Interior, Kwabenya" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label>DURATION</label>
                                        <div id="duration-container">
                                            <select id="duration_select" name="duty_duration" class="form-control" onchange="checkCustomDuration(this)">
                                            <option value="8 Hours">8 Hours</option>
                                            <option value="12 Hours">12 Hours</option>
                                            <option value="24 Hours">24 Hours</option>
                                            <option value="7 Days">7 Days</option>
                                            <option value="custom">[ CUSTOM_TIMEFRAME ]</option>
                                            </select>
                                        </div>
                                    </div>
                                     </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label>COMMAND_REMARKS</label>
                                            <textarea name="comment" class="form-control" rows="6" placeholder="ENTER_POST_ORDERS..."></textarea>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" name="booking_firearm" class="btn btn-block btn-outline-info btn-lg">EXECUTE_DEPLOYMENT</button>
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
    $(document).ready(function() {
        function showToast(msg, type) {
            const toast = $(`<div class="t-toast ${type}">[SIGNAL]: ${msg}</div>`);
            $("#toast-container").append(toast);
            toast.fadeIn().delay(4000).fadeOut(function() { $(this).remove(); });
        }

        // Firearm Autocomplete
        $("#firearm_serial_no").autocomplete({
            source: function(req, res) {
                $.post("fetchData.php", { search: req.term }, res, "json");
            },
            select: function(event, ui) {
                $("#firearm_serial_no").val(ui.item.serial); 
                $("#firearm_name").val(ui.item.name);
                $("#firearmID").val(ui.item.value); 
                return false;
            }
        });

        // Officer Autocomplete
        $("#to_officer").autocomplete({
            source: function(req, res) {
                $.post("fetchData_officer.php", { search: req.term }, res, "json");
            },
            select: function(event, ui) {
                $("#to_officer").val(ui.item.label);
                $("#officerID").val(ui.item.value);
                return false;
            }
        });

        // Ammo Autocomplete + Stock Autofill
        $("#ammunition_name").autocomplete({
            source: function(req, res) {
                $.post("fetchData_ammo.php", { search: req.term }, res, "json");
            },
            select: function(event, ui) {
                $("#ammunition_name").val(ui.item.label);
                $("#ammoID").val(ui.item.value);
                $("#ammo_total_rounds").val(ui.item.stock);
                
                if(parseInt(ui.item.stock) < 50) {
                    $("#stock-status").html("[!] CRITICAL_LOW_STOCK").addClass("low-stock");
                } else {
                    $("#stock-status").html("STOCK_STABLE").removeClass("low-stock");
                }
                return false;
            }
        });

        // URL Status Toast Trigger
        const urlParams = new URLSearchParams(window.location.search);
        if(urlParams.get('status') === 'success') showToast('DEPLOYMENT_RECORDED_SUCCESSFULLY', 't-success');
        if(urlParams.get('status') === 'error') showToast('CRITICAL_TRANSACTION_FAILURE', 't-error');
    });

      function checkCustomDuration(select) {
        if (select.value === 'custom') {
            document.getElementById('duration-container').innerHTML = `
                <div class="input-group">
                    <input type="text" name="duty_duration" class="form-control" placeholder="e.g. 30 Days" autofocus required>
                    <div class="input-group-append">
                        <button class="btn btn-outline-info" type="button" onclick="location.reload()"><i class="mdi mdi-refresh"></i></button>
                    </div>
                </div>`;
        }
    }
    </script>
</body>
</html>