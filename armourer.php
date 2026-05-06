<?php  
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

// Security check for Armourer access
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

/** * TACTICAL ANALYTICS ENGINE 
 * We use PDO fetchColumn() and rowCount() for precision data retrieval.
 */

// 1. Firearm Inventory Logic
$stmtFirearms = $pdo->query("SELECT COUNT(*) FROM `firearms` WHERE `firearm_state` LIKE 'Not%Faulty'");
$totalFirearms = $stmtFirearms->fetchColumn();

// 2. Ammunition Inventory Logic
$stmtAmmo = $pdo->query("SELECT SUM(ammo_rounds) FROM `ammunitions` ");
$totalAmmo = $stmtAmmo->fetchColumn() ?: 0;

// 3. Personnel Count
$stmtOfficers = $pdo->query("SELECT COUNT(*) FROM `officers` WHERE officer_status LIKE 'Active%'");
$totalOfficers = $stmtOfficers->fetchColumn();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>TERMINAL | GPS ARMOURY SYSTEM</title>
    
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=JetBrains+Mono:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
     <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root {
            --neon-cyan: #00f2ff;
            --tactical-red: #ff3e3e;
            --panel-bg: rgba(5, 10, 15, 0.98);
        }

        body { font-family: 'JetBrains Mono', monospace; background: #010203; }

        /* Tactical Command Card Redesign */
        .tactical-card {
            background: var(--panel-bg) !important;
            border: 1px solid rgba(0, 242, 255, 0.15) !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.5);
            position: relative;
            overflow: hidden;
        }

        .tactical-card::before {
            content: "";
            position: absolute;
            top: 0; left: 0; width: 100%; height: 2px;
            background: linear-gradient(90deg, var(--neon-cyan), transparent);
        }

        .stat-value {
            font-family: 'Orbitron', sans-serif;
            font-size: 2.2rem;
            color: var(--neon-cyan);
            text-shadow: 0 0 10px rgba(0, 242, 255, 0.4);
        }

        .stat-label {
            text-transform: uppercase;
            letter-spacing: 2px;
            font-size: 0.7rem;
            color: rgba(255,255,255,0.5);
        }

        .asset-list-item {
            border-bottom: 1px solid rgba(255,255,255,0.05);
            padding: 12px 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .badge-tactical {
            background: rgba(0, 242, 255, 0.1);
            color: var(--neon-cyan);
            border: 1px solid var(--neon-cyan);
            font-size: 10px;
            padding: 2px 8px;
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <?php require_once('includes/sidebar.php');?>
        
        <div class="container-fluid page-body-wrapper">
            <?php require_once('includes/navbar.php');?>
            
            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card tactical-card p-3">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h4 class="mb-1 text-white font-weight-bold">NCTD_ARMOURY_SYSTEM</h4>
                                        <p class="text-muted small mb-0">//NATIONAL COUNTER TERRORISM DEPARTMENT</p>
                                    </div>
                                    <div class="text-right">
                                        <span class="badge badge-tactical">UPLINK_SECURE</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card tactical-card">
                                <div class="card-body">
                                    <h6 class="stat-label">Total Firearm Inventory</h6>
                                    <div class="d-flex align-items-end justify-content-between mt-3">
                                        <span class="stat-value"><?= number_format($totalFirearms) ?></span>
                                        <i class="mdi mdi-pistol text-success" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card tactical-card">
                                <div class="card-body">
                                    <h6 class="stat-label">Live Munition Rounds</h6>
                                    <div class="d-flex align-items-end justify-content-between mt-3">
                                        <span class="stat-value"><?= number_format($totalAmmo) ?></span>
                                        <i class="mdi mdi-ammunition text-warning" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4 grid-margin stretch-card">
                            <div class="card tactical-card">
                                <div class="card-body">
                                    <h6 class="stat-label">Personnel Active Duty</h6>
                                    <div class="d-flex align-items-end justify-content-between mt-3">
                                        <span class="stat-value"><?= $totalOfficers ?></span>
                                        <i class="mdi mdi-account-group text-info" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-7 grid-margin stretch-card">
                            <div class="card tactical-card">
                                <div class="card-body">
                                    <h4 class="card-title text-white">FIREARM_DISTRIBUTION</h4>
                                    <div class="preview-list mt-4">
                                        <?php
                                        // Example of dynamic PDO loop for asset breakdown
                                        $assets = ['AK47', 'BERETTA-M9', 'CZ-SCORPION', 'SIGPRO'];
                                        foreach($assets as $asset):
                                            $s = $pdo->prepare("SELECT COUNT(*) FROM firearms WHERE firearm_name = ?");
                                            $s->execute([$asset]);
                                            $count = $s->fetchColumn();
                                        ?>
                                        <div class="asset-list-item">
                                            <div>
                                                <i class="mdi mdi-target-variant mr-2 text-cyan"></i>
                                                <span class="text-white"><?= $asset ?></span>
                                            </div>
                                            <span class="font-weight-bold text-info"><?= $count ?> UNIT</span>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-5 grid-margin stretch-card">
                            <div class="card tactical-card">
                                <div class="card-body">
                                    <h4 class="card-title text-white">SECURITY_TELEMETRY</h4>
                                    <div class="text-center py-4">
                                        <h1 class="text-danger mb-0" style="font-family: Orbitron;">
                                            <?php
                                                $stmtFaulty = $pdo->query("SELECT COUNT(*) FROM faulty_weapons");
                                                echo $stmtFaulty->fetchColumn();
                                            ?>
                                        </h1>
                                        <p class="text-muted small">CRITICAL_FAULTS_DETECTED</p>
                                        <hr style="border-color: rgba(255,255,255,0.05)">
                                        <div class="d-flex justify-content-around mt-3">
                                            <div>
                                                <p class="mb-0 text-white font-weight-bold">98%</p>
                                                <p class="text-muted small">STABILITY</p>
                                            </div>
                                            <div>
                                                <p class="mb-0 text-white font-weight-bold">1.2s</p>
                                                <p class="text-muted small">LATENCY</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once('includes/footer.php');?>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
</body>
</html>