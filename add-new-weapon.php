<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

$username = $_SESSION['username']; 
$stmt = $pdo->prepare("SELECT adminID, fullname, service_no, rank FROM admin_lists WHERE username = ?");
$stmt->execute([$username]);
$admin_data = $stmt->fetch(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TERMINAL | WEAPON INDUCTION</title>
    
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root {
            --neon-cyan: #00f2ff;
            --neon-amber: #f9a602;
            --tactical-bg: #05070a;
            --panel-bg: #0d1117;
            --border-dim: #30363d;
            --danger-red: #ff3e3e;
            --success-green: #00ff41;
        }

        body { font-family: 'JetBrains Mono', monospace; background-color: var(--tactical-bg) !important; color: #c9d1d9; }
        .card { background: var(--panel-bg) !important; border: 1px solid var(--border-dim) !important; border-radius: 0; position: relative; }
        .form-control { background: #161b22 !important; border: 1px solid var(--border-dim) !important; border-radius: 0; color: #fff !important; }
        .form-control:focus { border-color: var(--neon-cyan) !important; box-shadow: 0 0 10px rgba(0, 242, 255, 0.1); }
        .btn-tactical { border-radius: 0; text-transform: uppercase; font-weight: 700; font-size: 11px; padding: 15px 25px; transition: 0.3s; }
        .btn-commit { background: transparent; border: 1px solid var(--neon-cyan); color: var(--neon-cyan); }
        .btn-commit:hover { background: var(--neon-cyan); color: #000; box-shadow: 0 0 15px var(--neon-cyan); }
        label{
                font-size: 12px; 
                text-transform: uppercase; 
                color: var(--neon-cyan); 
                margin-bottom: 8px;
                display: block;
            }
            small { font-size: 14px; text-transform: uppercase; color: var(--neon-amber); }
            hr { border-color: var(--border-dim); margin-top: 5px; margin-bottom: 15px; }       
   
        /* Tactical Toast Styles */
        #toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; }
        .t-toast {
            background: var(--panel-bg);
            border: 1px solid var(--border-dim);
            color: #fff;
            padding: 15px 25px;
            margin-bottom: 10px;
            font-size: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
            border-left: 4px solid var(--neon-cyan);
            animation: slideIn 0.3s ease-forwards;
        }
        .t-toast.success { border-left-color: var(--success-green); color: var(--success-green); }
        .t-toast.error { border-left-color: var(--danger-red); color: var(--danger-red); }
        @keyframes slideIn { from { transform: translateX(100%); opacity: 0; } to { transform: translateX(0); opacity: 1; } }
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
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="page-title">[ ASSET_INDUCTION_SEQUENCE ]</h3>
                    </div>

                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body p-5">
                                    <form method="POST" action="process-weapon-entry.php" class="forms-sample" id="inductionForm">
                                         <input type="hidden" name="adminID" value="<?php echo htmlspecialchars($admin_data['adminID']); ?>">
                                        <input type="hidden" name="recorded_by" value="<?php echo htmlspecialchars($admin_data['service_no'].' '.$admin_data['rank'].' '.$admin_data['fullname']); ?>">
                                        <input type="hidden" name="booking_status" value="Available">
                                        <div class="row mb-4">
                                        <div class="col-md-12 mb-3">
                                            <small style="color:var(--neon-amber)">01_IDENTIFICATION_WEAPON</small>
                                            <hr>
                                        </div>
                                         <div class="row mb-4">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Serial_Identity (S/N)</label>
                                                    <input type="text" name="firearm_serial_no" id="firearm_serial_no" class="form-control" onInput="checkSerial()" placeholder="C01235" required>
                                                    <span id="serial-status" class="status-msg"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Manufacturer/Origin</label>
                                                    <select name="manufacturer" class="form-control" required>
                                                        <option value="">~ SELECT ~</option>
                                                        <?php
                                                        $stmtM = $pdo->query("SELECT DISTINCT firearm_manufacturer FROM firearm_manufacturers ORDER BY firearm_manufacturer ASC");
                                                        while($row = $stmtM->fetch(PDO::FETCH_ASSOC)) {
                                                            echo "<option value='".$row['firearm_manufacturer']."'>".$row['firearm_manufacturer']."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="col-md-12 mb-3">
                                                <small style="color:var(--neon-amber)">02_TECHNICAL_SPECIFICATIONS</small>
                                                <hr>
                                            </div>
                                        <div class="row mb-4">
                                            <div class="col-md-4">
                                                <label>Model Name</label>
                                                <select name="firearm_name" class="form-control" required>
                                                    <option value="">~ SELECT ~</option>
                                                    <?php
                                                    $stmtN = $pdo->query("SELECT DISTINCT firearm_name FROM firearm_name ORDER BY firearm_name ASC");
                                                    while($row = $stmtN->fetch(PDO::FETCH_ASSOC)) { echo "<option value='".$row['firearm_name']."'>".$row['firearm_name']."</option>"; }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Classification</label>
                                                <select name="firearm_type" class="form-control" required>
                                                    <option value="">~ SELECT ~</option>
                                                    <?php
                                                    $stmtC = $pdo->query("SELECT DISTINCT firearm_category FROM firearm_categories ORDER BY firearm_category ASC");
                                                    while($row = $stmtC->fetch(PDO::FETCH_ASSOC)) { echo "<option value='".$row['firearm_category']."'>".$row['firearm_category']."</option>"; }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Caliber_Spec</label>
                                                <select name="firearm_caliber" class="form-control" required>
                                                    <option value="">~ SELECT ~</option>
                                                    <?php
                                                    $stmtCal = $pdo->query("SELECT DISTINCT firearm_caliber FROM firearm_calibers ORDER BY firearm_caliber ASC");
                                                    while($row = $stmtCal->fetch(PDO::FETCH_ASSOC)) { echo "<option value='".$row['firearm_caliber']."'>".$row['firearm_caliber']."</option>"; }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="row mb-4">
                                            <div class="col-md-4">
                                                <label>Mag Capacity (RNDS)</label>
                                                <input type="number" name="firearm_capacity" class="form-control" placeholder="00">
                                            </div>
                                            <div class="col-md-4">
                                                <label>Operational Class</label>
                                                <select name="firearm_class" class="form-control">
                                                        <option value="Duty-Weapon">DUTY ASSET</option>
                                                        <option value="Spare-Weapon">RESERVE</option>
                                                        <option value="Training-Weapon">TRAINING ONLY</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4">
                                                <label>Serviceability Status</label>
                                                <select name="firearm_state" class="form-control">
                                                   <option value="Not-Faulty">FULLY OPERATIONAL</option>
                                                    <option value="Faulty">MAINTENANCE REQUIRED</option>
                                                    <option value="None">PENDING INSPECTION</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <label>ASSET REMARKS / HISTORY</label>
                                            <textarea name="remarks" class="form-control" placeholder="Enter any remarks or history for this weapon..." rows="4"></textarea>
                                        </div>
                                        <div class="mt-5">
                                            <button type="submit" name="add_weapon" id="submit-btn" class="btn btn-tactical btn-commit">
                                                <i class="mdi mdi-shield-check"></i> COMMIT_TO_REGISTRY
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                    <div class="card mt-4">
                      <div class="card-body p-4">
                            <small style="color:var(--neon-amber)">WEAPON_INDUCTION_PROTOCOL</small>
                            <hr>
                            <p style="font-size: 13px; color: #c9d1d9;">
                                1. Ensure all weapon details are accurate and verifiable before submission.<br>
                                2. Serial numbers must be unique; duplicates will be flagged by the system.<br>
                                3. Inducted weapons will undergo a mandatory inspection before being marked as "Available".<br>
                                4. Any discrepancies or issues found during induction should be reported to the Armoury Supervisor immediately.<br>
                                5. Maintain confidentiality of weapon details and do not share registry information without proper authorization.
                            </p>
                        </div>
                    </div>    
                </div>
                
          </div>
             <?php require_once('includes/footer.php'); ?>
        </div>
    </div>

    <!-- JS Assets -->


    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script>
        // Tactical Alert Engine
        function triggerAlert(msg, type) {
            const container = document.getElementById('toast-container');
            const toast = document.createElement('div');
            toast.className = `t-toast ${type}`;
            toast.innerHTML = `<i class="mdi ${type === 'success' ? 'mdi-check-circle' : 'mdi-alert-octagon'}"></i> ${msg}`;
            container.appendChild(toast);
            setTimeout(() => { toast.style.opacity = '0'; setTimeout(() => toast.remove(), 500); }, 4000);
        }

        // Process PHP Session Messages
        <?php if(isset($_SESSION['status'])): ?>
            triggerAlert("<?php echo $_SESSION['status']; ?>", "<?php echo $_SESSION['status_code']; ?>");
            <?php unset($_SESSION['status']); unset($_SESSION['status_code']); ?>
        <?php endif; ?>

        function checkSerial() {
            let sn = $("#firearm_serial_no").val();
            if(sn.length < 3) { $("#serial-status").html(""); return; }
            $.post("checkAvailability.php", { firearm_serial_no: sn }, function(data) {
                $("#serial-status").html(data);
                if(data.includes("ALREADY")) {
                    $("#submit-btn").prop('disabled', true).css('opacity', '0.5');
                } else {
                    $("#submit-btn").prop('disabled', false).css('opacity', '1');
                }
            });
        }
    </script>
</body>
</html>