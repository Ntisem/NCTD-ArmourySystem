<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!isset($_GET['id']) || !isset($_SESSION["username"])) {
    header("location: ammunition");
    exit();
}

$ammoID = $_GET['id'];

// Fetch Ammo Details
$stmt = $pdo->prepare("SELECT * FROM ammunitions WHERE ammoID = ?");
$stmt->execute([$ammoID]);
$ammo = $stmt->fetch();

if(!$ammo) { header("location: ammunition"); exit(); }

// Calculate stock percentage for progress bar
$max_capacity = 5000; // Example threshold for visual scaling
$stock_percent = ($ammo['ammo_rounds'] / $max_capacity) * 100;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TERMINAL | AMMO_DEEP_SCAN: <?= $ammo['ammo_name'] ?></title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
        :root { --neon-cyan: #00f2ff; --neon-amber: #f9a602; --bg-dark: #05070a; --panel: #0d1117; }
        body { background: var(--bg-dark); color: #adc4b2; font-family: 'JetBrains Mono', monospace; }
        .card { background: var(--panel); border: 1px solid #30363d; border-radius: 0; margin-bottom: 20px; }
        .stat-box { border-left: 3px solid var(--neon-cyan); padding: 15px; background: rgba(0, 242, 255, 0.05); }
        .progress { background: #161b22; height: 10px; border-radius: 0; border: 1px solid #30363d; }
        .progress-bar { background: var(--neon-cyan); box-shadow: 0 0 10px var(--neon-cyan); }
        .spec-label { color: #6c7293; font-size: 10px; text-transform: uppercase; }
        .spec-value { color: #fff; font-size: 14px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container-fluid p-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2 class="text-cyan mb-0">[ AMMO_ASSET_DATA_SCAN ]</h2>
                <small class="text-muted">UUID: <?= bin2hex($ammo['ammoID']) ?> | STATUS: NOMINAL</small>
            </div>
            <button class="btn btn-outline-warning" onclick="window.history.back()">
                <i class="mdi mdi-arrow-left"></i> RETURN_TO_LIST
            </button>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-cyan mb-3">CURRENT_STOCK_LEVEL</h5>
                        <div class="text-center py-4">
                            <h1 style="font-size: 60px; color: #fff;"><?= number_format($ammo['ammo_rounds']) ?></h1>
                            <p class="text-muted">REMAINING ROUNDS</p>
                        </div>
                        <div class="progress mb-2">
                            <div class="progress-bar" style="width: <?= $stock_percent ?>%"></div>
                        </div>
                        <div class="d-flex justify-content-between small">
                            <span>MIN: 0</span>
                            <span>CRITICAL_THRESHOLD: 500</span>
                        </div>
                    </div>
                </div>

            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-cyan mb-3">TECHNICAL_SPECIFICATIONS</h5>
                        <div class="row mb-3">
                            <div class="col-6">
                                <p class="spec-label">MANUFACTURER</p>
                                <p class="spec-value"><?= $ammo['manufacturer'] ?></p>
                            </div>
                            <div class="col-6">
                                <p class="spec-label">AMMO NAME</p>
                                <p class="spec-value"><?= $ammo['ammo_name'] ?></p>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <p class="spec-label">ACQUISITION_DATE</p>
                                <p class="spec-value"><?= date('d M Y', strtotime($ammo['datetime'])) ?></p>
                            </div>
                            <div class="col-6">
                                <p class="spec-label">BATCH_ID</p>
                                <p class="spec-value">#BT-<?= $ammo['ammoID'] ?>-NCTD</p>
                            </div>
                        </div>
                    </div>
                </div>
                 </div>
            </div>

            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5 class="text-cyan mb-3">REMARKS_&_NOTES</h5>
                        <p class="text-white bg-dark p-3 border border-secondary">
                            <?= !empty($ammo['remarks']) ? $ammo['remarks'] : "NO ADDITIONAL REMARKS LOGGED FOR THIS ASSET." ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include_once('includes/footer.php'); ?>
</body>
</html>