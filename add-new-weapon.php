<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

// 1. Authorization & Session Check
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

// 2. Fetch Admin Data using PDO
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
    <title>TERMINAL | ASSET INDUCTION</title>
    
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
        }

        body { 
            font-family: 'JetBrains Mono', monospace; 
            background-color: var(--tactical-bg) !important; 
            color: #c9d1d9;
            letter-spacing: -0.5px;
        }

        .content-wrapper { background: var(--tactical-bg); }

        .card { 
            background: var(--panel-bg) !important; 
            border: 1px solid var(--border-dim) !important; 
            border-radius: 0;
            box-shadow: 0 0 20px rgba(0,0,0,0.5);
            position: relative;
        }

        .card::before {
            content: "SYSTEM_ACTIVE";
            position: absolute;
            top: -10px;
            right: 10px;
            font-size: 8px;
            color: var(--neon-cyan);
            background: var(--tactical-bg);
            padding: 0 5px;
        }

        .page-title { 
            color: var(--neon-cyan); 
            text-transform: uppercase; 
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 2rem;
        }

        label { 
            font-size: 10px; 
            text-transform: uppercase; 
            color: #8b949e; 
            margin-bottom: 8px;
            display: block;
        }

        .form-control { 
            background: #161b22 !important; 
            border: 1px solid var(--border-dim) !important; 
            border-radius: 0;
            color: #fff !important;
            font-size: 13px;
            padding: 12px;
            transition: all 0.3s;
        }

        .form-control:focus { 
            border-color: var(--neon-cyan) !important; 
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.1); 
        }

        .btn-tactical {
            border-radius: 0;
            text-transform: uppercase;
            font-weight: 700;
            font-size: 11px;
            padding: 15px 25px;
            letter-spacing: 1px;
            transition: 0.3s;
        }

        .btn-commit {
            background: transparent;
            border: 1px solid var(--neon-cyan);
            color: var(--neon-cyan);
        }

        .btn-commit:hover {
            background: var(--neon-cyan);
            color: #000;
            box-shadow: 0 0 15px var(--neon-cyan);
        }

        .btn-abort {
            background: transparent;
            border: 1px solid var(--danger-red);
            color: var(--danger-red);
        }

        .btn-abort:hover {
            background: var(--danger-red);
            color: #fff;
            box-shadow: 0 0 15px var(--danger-red);
        }

        .status-msg { font-size: 10px; margin-top: 5px; display: block; height: 15px; }

        .module-link {
            border: 1px solid var(--border-dim);
            padding: 8px 15px;
            color: #8b949e;
            text-decoration: none;
            font-size: 11px;
            margin-right: 10px;
        }

        .module-link.active {
            border-color: var(--neon-cyan);
            color: var(--neon-cyan);
        }

        hr { border-top: 1px solid var(--border-dim); opacity: 0.5; }
    </style>
</head>

<body>
    <div class="container-scroller">
        <?php include_once('includes/sidebar.php');?>
        <div class="container-fluid page-body-wrapper">
            <?php include_once('includes/navbar.php');?>
            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h3 class="page-title">[ ASSET_INDUCTION_SEQUENCE ]</h3>
                        <div>
                            <a href="add-new-weapon" class="module-link active">WEAPON_ENTRY</a>
                            <a href="add-new-ammo" class="module-link">AMMO_ENTRY</a>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12 grid-margin">
                            <div class="card">
                                <div class="card-body p-5">
                                    <form method="POST" action="functions-inventory.php" class="forms-sample" id="inductionForm">
                                        
                                        <div class="row mb-4">
                                            <div class="col-md-12 mb-3">
                                                <small style="color:var(--neon-amber)">01_IDENTIFICATION_WEAPON</small>
                                                <hr>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Serial_Identity (S/N)</label>
                                                    <input type="text" name="firearm_serial_no" id="firearm_serial_no" class="form-control" placeholder="SCAN OR TYPE SERIAL..." onInput="checkSerial()" required>
                                                    <span id="serial-status" class="status-msg"></span>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Manufacturer/Origin</label>
                                                    <select name="manufacturer" class="form-control" required>
                                                        <option value="">~ SELECT ORIGIN ~</option>
                                                        <?php
                                                        // PDO implementation for manufacturer dropdown
                                                        $stmtM = $pdo->query("SELECT DISTINCT firearm_manufacturer FROM firearm_categories ORDER BY firearm_manufacturer ASC");
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
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>FIREARM NAME (Model Name)</label>
                                                    <select name="firearm_name" class="form-control" required>
                                                        <option value="">~ SELECT FIREARM NAME ~</option>
                                                        <?php
                                                        // PDO implementation for firearm name
                                                        $stmtN = $pdo->query("SELECT DISTINCT firearm_name FROM firearm_name ORDER BY firearm_name ASC");
                                                        while($row = $stmtN->fetch(PDO::FETCH_ASSOC)) {
                                                            echo "<option value='".$row['firearm_name']."'>".$row['firearm_name']."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Classification (Firearam Type)</label>
                                                    <select name="firearm_type" class="form-control" required>
                                                        <option value="">~ SELECT TYPE ~</option>
                                                        <?php
                                                        // PDO implementation for categories
                                                        $stmtC = $pdo->query("SELECT DISTINCT firearm_category FROM firearm_categories ORDER BY firearm_category ASC");
                                                        while($row = $stmtC->fetch(PDO::FETCH_ASSOC)) {
                                                            echo "<option value='".$row['firearm_category']."'>".$row['firearm_category']."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Caliber_Spec</label>
                                                    <select name="firearm_caliber" class="form-control" required>
                                                        <option value="">~ SELECT CALIBER ~</option>
                                                        <?php
                                                        // PDO implementation for caliber
                                                        $stmtCal = $pdo->query("SELECT DISTINCT firearm_caliber FROM firearm_categories ORDER BY firearm_caliber ASC");
                                                        while($row = $stmtCal->fetch(PDO::FETCH_ASSOC)) {
                                                            echo "<option value='".$row['firearm_caliber']."'>".$row['firearm_caliber']."</option>";
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Mag Capacity (RNDS)</label>
                                                    <input type="number" name="firearm_capacity" class="form-control" placeholder="00">
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label>Operational Class</label>
                                                    <select name="firearm_class" class="form-control">
                                                        <option value="Duty-Weapon">DUTY ASSET</option>
                                                        <option value="Spare-Weapon">RESERVE</option>
                                                        <option value="Training-Weapon">TRAINING ONLY</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>Serviceability Status</label>
                                                    <select name="firearm_state" class="form-control">
                                                        <option value="Not-Faulty">FULLY OPERATIONAL</option>
                                                        <option value="Faulty">MAINTENANCE REQUIRED</option>
                                                        <option value="None">PENDING INSPECTION</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <div class="form-group">
                                                    <label>ASSET REMARKS / HISTORY</label>
                                                    <textarea name="remarks" class="form-control" rows="5" placeholder="Enter service history or specific notes..."></textarea>
                                                </div>
                                            </div>
                                        </div>

                                        <input type="hidden" name="adminID" value="<?php echo htmlspecialchars($admin_data['adminID']); ?>">
                                        <input type="hidden" name="recorded_by" value="<?php echo htmlspecialchars($admin_data['service_no'].' '.$admin_data['rank'].' '.$admin_data['fullname']); ?>">
                                        <input type="hidden" name="booking_status" value="Available">

                                        <div class="row mt-5">
                                            <div class="col-md-12 d-flex gap-3">
                                                <button type="submit" name="add_new_weapon" id="submit-btn" class="btn btn-tactical btn-commit me-3">
                                                    <i class="mdi mdi-shield-check"></i> COMMIT_TO_REGISTRY
                                                </button>
                                                <button type="reset" class="btn btn-tactical btn-abort">
                                                    <i class="mdi mdi-close-octagon"></i> ABORT_ENTRY
                                                </button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include_once('includes/footer.php');?>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script>
    function checkSerial() {
        let sn = $("#firearm_serial_no").val();
        if(sn.length < 3) { 
            $("#serial-status").html(""); 
            $("#submit-btn").prop('disabled', false).css('opacity', '1');
            return; 
        }
        // AJAX still works with your backend checkAvailability.php
        $.post("checkAvailability.php", { firearm_serial_no: sn }, function(data) {
            $("#serial-status").html(data);
        });
    }

    $('button[type="reset"]').on('click', function() {
        $("#serial-status").html("");
        $("#submit-btn").prop('disabled', false).css('opacity', '1');
    });
    </script>
</body>
</html>