<?php
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

// Access Control
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

/** * TACTICAL DATA ACQUISITION ENGINE (PDO)
 */
try {
    // 1. Total Firearm Inventory
    $stmtFirearms = $pdo->query("SELECT COUNT(*) FROM firearms WHERE is_deleted = 0");
    $totalFirearms = $stmtFirearms->fetchColumn();

    // 2. Live Munition Rounds (Sum of all rounds)
    $stmtAmmo = $pdo->query("SELECT SUM(ammo_rounds) FROM ammunitions WHERE is_deleted = 0 AND ammo_type = 'Live-Ammo'");
    $totalAmmoRounds = $stmtAmmo->fetchColumn() ?: 0;

     // 2. Blank Munition Rounds (Sum of all rounds)
    $stmtBlankAmmo = $pdo->query("SELECT SUM(ammo_rounds) FROM ammunitions WHERE is_deleted = 0 AND ammo_type = 'Blank-Ammo'");
    $totalBlankAmmoRounds = $stmtBlankAmmo->fetchColumn() ?: 0;

    // 3. Active Deployments (Not Returned)
    $stmtActive = $pdo->query("SELECT COUNT(*) FROM bookings WHERE TRIM(returns) = 'Not-Return' AND is_deleted = 0");
    $activeDeployments = $stmtActive->fetchColumn();

    // 4. Deployed Ammunition (Total rounds currently in the field)
    $stmtDepAmmo = $pdo->query("SELECT SUM(number_of_rounds) FROM bookings WHERE TRIM(returns) = 'Not-Return' AND is_deleted = 0");
    $deployedAmmo = $stmtDepAmmo->fetchColumn() ?: 0;

    // 5. Faulty Assets (Weapons + Ammo entries)
    $stmtFaultyW = $pdo->query("SELECT COUNT(*) FROM faulty_weapons WHERE faulty_nature != 'Serviceable'");
    $faultyWeapons = $stmtFaultyW->fetchColumn();
    
    $stmtFaultyA = $pdo->query("SELECT SUM(faulty_ammo_quantity) FROM faulty_ammo");
    $faultyAmmo = $stmtFaultyA->fetchColumn() ?: 0;

    // 6. Active Personnel (Total Officers)
    $stmtOfficers = $pdo->query("SELECT COUNT(*) FROM officers WHERE officer_status = 'Active In Service'");
    $activeOfficers = $stmtOfficers->fetchColumn();

    // 7. Firearm Distribution (Analytical Chart Data)
    $stmtDist = $pdo->query("SELECT firearm_type, COUNT(*) as count FROM firearms GROUP BY firearm_type");
    $distributionData = $stmtDist->fetchAll(PDO::FETCH_ASSOC);

} catch (PDOException $e) {
    die("CRITICAL_SYSTEM_FAILURE: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NCTD_ARMORY_SYSTEM</title>
    
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@300;500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root {
            --cmd-bg: #05070a;
            --neon-cyan: #00f2ff;
            --neon-amber: #f9a602;
            --neon-red: #ff3e3e;
            --panel-bg: rgba(13, 17, 23, 0.9);
            --tactical-border: 1px solid rgba(0, 242, 255, 0.2);
        }

        body {
            background-color: var(--cmd-bg) !important;
            font-family: 'Roboto Mono', monospace;
            color: #c0c5ce;
        }

        /* Tactical Scanline Effect */
        .main-panel::before {
            content: " ";
            display: block;
            position: absolute;
            top: 0; left: 0; bottom: 0; right: 0;
            background: linear-gradient(rgba(18, 16, 16, 0) 50%, rgba(0, 0, 0, 0.1) 50%), 
                        linear-gradient(90deg, rgba(255, 0, 0, 0.02), rgba(0, 255, 0, 0.01), rgba(0, 0, 255, 0.02));
            z-index: 10;
            background-size: 100% 3px, 3px 100%;
            pointer-events: none;
        }

        .tactical-card {
            background: var(--panel-bg) !important;
            border: var(--tactical-border);
            border-radius: 2px;
            position: relative;
            overflow: hidden;
            transition: all 0.3s ease;
        }

        .tactical-card:hover {
            border-color: var(--neon-cyan);
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.15);
        }

        .tactical-card::after {
            content: "";
            position: absolute;
            top: 0; right: 0;
            width: 0; height: 0;
            border-style: solid;
            border-width: 0 15px 15px 0;
            border-color: transparent var(--neon-cyan) transparent transparent;
            opacity: 0.4;
        }

        .header-title {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-cyan);
            letter-spacing: 2px;
            text-transform: uppercase;
            text-shadow: 0 0 5px rgba(0, 242, 255, 0.5);
        }

        .stat-value {
            font-family: 'Orbitron', sans-serif;
            font-size: 1.8rem;
            font-weight: 700;
        }

        .blink {
            animation: blink-animation 1.5s steps(5, start) infinite;
        }
        @keyframes blink-animation { to { visibility: hidden; } }

        .chart-container { position: relative; height: 260px; width: 100%; }
    </style>
</head>
<body>
    <div class="container-scroller">
        <?php include_once('includes/sidebar.php');?>
        
        <div class="container-fluid page-body-wrapper">
            <?php include_once('includes/navbar.php');?>
            
            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <div class="row mb-4">
                        <div class="col-12 d-flex justify-content-between align-items-center">
                            <div>
                                <h3 class="header-title mb-0">NCTD_Armoury_Command</h3>
                                <span class="text-muted small">[ STATUS: <span class="text-success blink">OPERATIONAL</span> ]</span>
                            </div>
                            <div class="text-right">
                                <div id="live-clock" class="text-info font-weight-bold"></div>
                                <span class="text-muted small">LOCATION: NHQ_ACCRA</span>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 grid-margin">
                            <div class="card tactical-card">
                                <div class="card-body">
                                    <h6 class="text-muted small mb-3">TOTAL_FIREARM_INVENTORY</h6>
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div class="stat-value text-white"><?= number_format($totalFirearms) ?></div>
                                        <i class="mdi mdi-pistol text-info" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 grid-margin">
                            <div class="card tactical-card">
                                <div class="card-body">
                                    <h6 class="text-muted small mb-3">LIVE_MUNITION_ROUNDS</h6>
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div class="stat-value text-warning"><?= number_format($totalAmmoRounds) ?></div>
                                        <i class="mdi mdi-ammunition text-warning" style="font-size: 2rem;"></i>
                                    </div>
                                    <hr>
                                     <div class="text-muted small mt-1">[<strong class="text-light"><?= $totalBlankAmmoRounds ?></strong> Rds]<strong class="text-warning">Blank-Ammo</strong></div>
                                </div>
                            </div>
                        </div>
                           <div class="col-md-3 grid-margin">
                            <div class="card tactical-card" style="border-color: var(--neon-red);">
                                <div class="card-body">
                                    <h6 class="text-muted small mb-3">HARDWARE_FAULTS</h6>
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div class="stat-value text-danger"><?= $faultyWeapons ?> <small style="font-size: 12px;">WPN</small></div>
                                        <i class="mdi mdi-alert-decagram text-danger blink" style="font-size: 2rem;"></i>
                                    </div>
                                        <hr>
                                    <div class="text-muted small mt-1">[<strong class="text-light"><?= $faultyAmmo ?></strong> Rds]<strong class="text-danger">Faulty-Ammo</strong></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 grid-margin">
                            <div class="card tactical-card">
                                <div class="card-body">
                                    <h6 class="text-muted small mb-3">ACTIVE_PERSONNEL</h6>
                                    <div class="d-flex justify-content-between align-items-end">
                                        <div class="stat-value text-success"><?= $activeOfficers ?></div>
                                        <i class="mdi mdi-account-group text-success" style="font-size: 2rem;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                     
                    </div>
      <div class="row">
                        <div class="col-lg-12 grid-margin stretch-card">
                            <div class="card tactical-card">
                        <div class="card tactical-card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="header-title mb-0" style="font-size: 1rem;">
                                    <i class="mdi mdi-radar mr-2 text-cyan"></i>WEAPON_DISTRIBUTION_MAP
                                </h4>
                                <span class="text-muted small" style="letter-spacing: 2px;">[ SCAN_MODE: FULL_INVENTORY ]</span>
                            </div>

                            <div class="row no-gutters">
                                <?php
                                /** * TACTICAL DATA RETRIEVAL
                                 * Dynamic PDO discovery of all active firearm names
                                 */
                                try {
                                    // Fetch unique names and counts in one efficient query
                                    $stmt = $pdo->query("
                                        SELECT firearm_name, COUNT(*) as qty 
                                        FROM firearms 
                                        WHERE is_deleted = 0 
                                        GROUP BY firearm_name 
                                        ORDER BY qty DESC  LIMIT 12
                                    ");

                                    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)):
                                        $name = htmlspecialchars($row['firearm_name']);
                                        $qty = $row['qty'];
                                        
                                        // Logic: Visual alert if stock is below critical threshold
                                        $isCritical = ($qty < 3);
                                        $accentColor = $isCritical ? 'var(--neon-amber)' : 'var(--neon-cyan)';
                                ?>
                                    <div class="col-md-3 p-1">
                                        <div class="asset-grid-item" style="border-left: 3px solid <?= $accentColor ?>;">
                                            <div class="d-flex justify-content-between align-items-start">
                                                <div class="asset-meta">
                                                    <span class="d-block text-muted" style="font-size: 0.6rem;">UNIT_TYPE</span>
                                                    <span class="asset-label text-white"><?= strtoupper($name) ?></span>
                                                </div>
                                                <div class="asset-status">
                                                    <i class="mdi mdi-circle-medium <?= $isCritical ? 'blink text-warning' : 'text-success' ?>"></i>
                                                </div>
                                            </div>
                                            
                                            <div class="d-flex align-items-baseline mt-2">
                                                <span class="stat-value" style="color: <?= $accentColor ?>;">
                                                    <?= str_pad($qty, 2, "0", STR_PAD_LEFT) ?>
                                                </span>
                                                <span class="ml-2 text-muted small" style="font-size: 0.7rem;">READY_UNITS</span>
                                            </div>
                                            
                                            <div class="scan-bar mt-2">
                                                <div class="scan-progress" style="width: <?= min(($qty/50)*100, 100) ?>%; background: <?= $accentColor ?>;"></div>
                                            </div>
                                        </div>
                                    </div>
                                <?php 
                                    endwhile;
                                } catch (PDOException $e) {
                                    echo '<div class="col-12 text-danger small">[SYSTEM_ERR]: DATA_LINK_FAILURE</div>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-7 grid-margin stretch-card">
                            <div class="card tactical-card">
                                <div class="card-body">
                                    <h4 class="header-title mb-4" style="font-size: 0.9rem;">Distribution_by_Class</h4>
                                    <div class="chart-container">
                                        <canvas id="distributionChart"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5 grid-margin stretch-card">
                            <div class="card tactical-card">
                                <div class="card-body">
                                    <h4 class="header-title mb-4" style="font-size: 0.9rem;">Field_Deployment_Status</h4>
                                    <div class="text-center py-3">
                                        <div class="stat-value text-info mb-2"><?= $activeDeployments ?></div>
                                        <p class="text-muted">FIREARMS_IN_FIELD</p>
                                    </div>
                                    <hr style="border-top: 1px dashed rgba(255,255,255,0.1);">
                                    <div class="d-flex justify-content-between mb-3">
                                        <span class="small">Deployed Munitions</span>
                                        <span class="text-warning small"><?= number_format($deployedAmmo) ?> RNDS</span>
                                    </div>
                                    <div class="progress progress-md bg-dark">
                                        <div class="progress-bar bg-info" style="width: <?= ($totalFirearms > 0) ? ($activeDeployments/$totalFirearms)*100 : 0 ?>%"></div>
                                    </div>
                                    <small class="text-muted mt-2 d-block">System Load: <?= round(($activeDeployments/$totalFirearms)*100, 1) ?>% Capacity</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    

                    <style>
                    /* --- LANDSCAPE COMMAND STYLING --- */
                    .asset-grid-item {
                        background: rgba(0, 242, 255, 0.03);
                        padding: 12px;
                        border: 1px solid rgba(255, 255, 255, 0.05);
                        margin: 4px;
                        position: relative;
                        transition: all 0.2s ease;
                    }

                    .asset-grid-item:hover {
                        background: rgba(0, 242, 255, 0.08);
                        border-color: rgba(0, 242, 255, 0.3);
                        transform: translateY(-2px);
                    }

                    .asset-label {
                        font-family: 'Orbitron', sans-serif;
                        font-size: 0.85rem;
                        letter-spacing: 1px;
                    }

                    .stat-value {
                        font-family: 'Orbitron', sans-serif;
                        font-size: 1.5rem;
                        font-weight: 700;
                        line-height: 1;
                    }

                    .scan-bar {
                        height: 2px;
                        width: 100%;
                        background: rgba(255, 255, 255, 0.05);
                        overflow: hidden;
                    }

                    .scan-progress {
                        height: 100%;
                        box-shadow: 0 0 5px currentColor;
                    }

                    .blink {
                        animation: tactical-blink 1s steps(2, start) infinite;
                    }

                    @keyframes tactical-blink {
                        to { visibility: hidden; }
                    }

                    /* Custom horizontal scroll for many assets if needed */
                    .row.no-gutters {
                        display: flex;
                        flex-wrap: wrap;
                    }
                    </style>
                    </div>   
                    </div>     
                    </div>      

                </div>
                <?php include_once('includes/footer.php');?>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    
    <script>
        // Real-time Clock
        function updateClock() {
            const now = new Date();
            document.getElementById('live-clock').innerText = now.toLocaleString('en-GB', { hour12: false }).toUpperCase();
        }
        setInterval(updateClock, 1000);
        updateClock();

        // Analytical Chart: Firearm Distribution
        const distCtx = document.getElementById('distributionChart').getContext('2d');
        new Chart(distCtx, {
            type: 'bar',
            data: {
                labels: <?= json_encode(array_column($distributionData, 'firearm_type')) ?>,
                datasets: [{
                    label: 'STOCK_COUNT',
                    data: <?= json_encode(array_column($distributionData, 'count')) ?>,
                    backgroundColor: 'rgba(0, 242, 255, 0.2)',
                    borderColor: '#00f2ff',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    yAxes: [{ gridLines: { color: 'rgba(255,255,255,0.05)' }, ticks: { fontColor: '#8a8d93', beginAtZero: true } }],
                    xAxes: [{ gridLines: { display: false }, ticks: { fontColor: '#8a8d93' } }]
                },
                legend: { display: false }
            }
        });
    </script>
</body>
</html>