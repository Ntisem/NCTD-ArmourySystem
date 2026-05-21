<?php
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}

$officerID = isset($_GET['officerID']) ? (int)$_GET['officerID'] : 0;

// Fetch core personnel details
$officerStmt = $pdo->prepare("SELECT * FROM officers WHERE officerID = ?");
$officerStmt->execute([$officerID]);
$officer = $officerStmt->fetch();

if(!$officer) {
    die("<h3 style='color:#ff3333; background:#000; padding:30px; font-family:monospace;'>[ ERROR ] PERSONNEL_RECORD_NOT_FOUND IN NCTD MASTER_ARCHIVES.</h3>");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>NCTD ARMOURY SYSTEM - TRACKING_MATRIX | <?= strtoupper(htmlspecialchars($officer['full_name'])) ?></title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@300;500&display=swap" rel="stylesheet">
    <style>
        :root { --neon: #00f2ff; --bg-deep: #020408; --card-bg: #0a0d12; --danger: #ff3333; --success: #00ff88; }
        body { background: var(--bg-deep); font-family: 'Roboto Mono', monospace; color: #e0e0e0; }
        .tactical-card { background: var(--card-bg) !important; border: 1px solid rgba(0, 242, 255, 0.2); border-radius: 0; box-shadow: inset 0 0 40px rgba(0,0,0,0.8); }
        .matrix-title { font-family: 'Orbitron'; color: var(--neon); letter-spacing: 2px; }
        .meta-label { color: #8b949e; font-size: 11px; text-transform: uppercase; }
        .meta-value { color: #fff; font-weight: bold; font-size: 14px; }
        .nav-tabs .nav-link { color: #8b949e; border-radius: 0; border: 1px solid transparent; background: transparent; font-family: 'Orbitron'; font-size: 11px; margin-right: 5px; }
        .nav-tabs .nav-link.active { color: var(--neon); background: rgba(0,242,255,0.05); border: 1px solid var(--neon); border-bottom-color: transparent; }
        .table-matrix { background: #000; font-size: 12px; }
        .table-matrix thead th { border-bottom: 2px solid var(--neon) !important; color: var(--neon); font-family: 'Orbitron'; font-size: 10px; }
        .badge-tactical { border-radius:0; font-size:10px; padding: 5px 10px; font-family:'Orbitron'; }
    </style>
</head>
<body>
    <div class="container-fluid p-4">
        <div class="row mb-4">
            <div class="col-md-8">
                <h4 class="matrix-title">[ PERSONNEL_BLANK_AMMUNITION_TRACKING_MATRIX ]</h4>
            </div>
            <div class="col-md-4 text-right">
                <a href="javascript:history.back()" class="btn btn-outline-info" style="border-radius:0;"><i class="mdi mdi-arrow-left"></i>BACK</a>
            </div>
        </div>

        <div class="card tactical-card mb-4">
            <div class="card-body">
                <div class="row align-items-center">
                    <div class="col-md-2 text-center">
                        <img src="assets/images/officer_images/<?= !empty($officer['officer_image']) ? htmlspecialchars($officer['officer_image']) : 'profile_placeholder.jpg' ?>" class="img-fluid" style="border: 2px solid var(--neon); max-height: 130px; object-fit: cover;">
                    </div>
                    <div class="col-md-10">
                        <div class="row">
                            <div class="col-md-4 mb-2"><span class="meta-label">FULLNAME:</span><br><span class="meta-value"><?= strtoupper(htmlspecialchars($officer['full_name'])) ?></span></div>
                            <div class="col-md-4 mb-2"><span class="meta-label">SERVICE NO / ID:</span><br><span class="meta-value text-info"><?= strtoupper(htmlspecialchars($officer['officer_service_no'] ?? $officer['officer_id'] ?? 'N/A')) ?></span></div>
                            <div class="col-md-4 mb-2"><span class="meta-label">RANK RATING:</span><br><span class="meta-value"><?= strtoupper(htmlspecialchars($officer['rank'] ?? 'OFFICER')) ?></span></div>
                            <div class="col-md-4"><span class="meta-label">DEPLOYMENT DIVISION:</span><br><span class="meta-value">NCTD OPERATIONAL FORCE</span></div>
                            <div class="col-md-4"><span class="meta-label">RECORD ACCOUNTABILITY:</span><br><span class="badge badge-tactical badge-outline-success">[ VERIFIED_ACTIVE ]</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card tactical-card">
            <div class="card-body">
                <ul class="nav nav-tabs border-bottom rgba(0,242,255,0.2) mb-4" role="tablist">
                    <li class="nav-item"><a class="nav-link active" data-toggle="tab" href="#blankAmmoTab">[ 01_BLANK_MUNITIONS ]</a></li>
                    <!-- <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#liveAmmoTab">[ 02_LIVE_AMMUNITION ]</a></li>
                    <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#firearmsTab">[ 03_FIREARM_ASSETS ]</a></li> -->
                </ul>

                <div class="tab-content">
                    <div class="tab-pane fade show active" id="blankAmmoTab">
                        <table class="table table-dark table-matrix table-hover">
                            <thead>
                                <tr>
                                    <th>CALIBER LINE</th>
                                    <th>QTY ISSUED</th>
                                    <th>QTY RETURNED</th>
                                    <th>DUTY CATEGORY</th>
                                    <th>STATUS</th>
                                    <th>TIMESTAMP</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $bStmt = $pdo->prepare("SELECT * FROM blank_ammo_bookings WHERE officerID = ? ORDER BY blank_ammoID DESC");
                                $bStmt->execute([$officerID]);
                                $hasBlanks = false;
                                while($bRow = $bStmt->fetch()) { $hasBlanks = true;
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($bRow['faulty_ammo_name']) ?></td>
                                    <td><?= $bRow['faulty_ammo_rounds'] ?></td>
                                    <td><?= $bRow['faulty_ammo_returned'] ?></td>
                                    <td><?= htmlspecialchars($bRow['duty_type']) ?></td>
                                    <td>
                                        <span class="badge badge-tactical <?= $bRow['faulty_returns_state']=='Returned' ? 'badge-outline-success' : 'badge-outline-danger' ?>">
                                            <?= $bRow['faulty_returns_state']=='Returned' ? 'ACCOUNTED' : 'OUTSTANDING' ?>
                                        </span>
                                    </td>
                                    <td><?= $bRow['booking_time'] ?></td>
                                </tr>
                                <?php } if(!$hasBlanks) echo "<tr><td colspan='6' class='text-center text-muted'>NO RECORDED BLANK DEPLOYMENT ORDERS FOUND FOR THIS PERSONNEL.</td></tr>"; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="liveAmmoTab">
                        <table class="table table-dark table-matrix table-hover">
                            <thead>
                                <tr>
                                    <th>AMMO TYPE / CALIBER</th>
                                    <th>ROUNDS DEPLOYED</th>
                                    <th>MISSION DATA</th>
                                    <th>STATUS</th>
                                    <th>RECORDED DATE</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Direct lookup against standard combat ammo bookings
                                $lStmt = $pdo->prepare("SELECT * FROM ammo_bookings WHERE officerID = ? ORDER BY book_ammoID DESC");
                                $lStmt->execute([$officerID]);
                                $hasLive = false;
                                while($lRow = $lStmt->fetch()) { $hasLive = true;
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($lRow['ammo_name'] ?? 'Standard Caliber') ?></td>
                                    <td><?= $lRow['ammo_rounds'] ?? $lRow['rounds_issued'] ?></td>
                                    <td><?= htmlspecialchars($lRow['duty_type'] ?? 'Operational Duty') ?></td>
                                    <td>
                                        <span class="badge badge-tactical <?= ($lRow['ammo_returns'] ?? $lRow['status'] ?? '') == 'Returned' ? 'badge-outline-success' : 'badge-outline-danger' ?>">
                                            <?= ($lRow['ammo_returns'] ?? $lRow['status'] ?? '') == 'Returned' ? 'RETURNED' : 'OUT_FIELD' ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($lRow['booking_time'] ?? 'N/A') ?></td>
                                </tr>
                                <?php } if(!$hasLive) echo "<tr><td colspan='5' class='text-center text-muted'>NO RECORDED COMBAT AMMUNITION ENTRIES MATCHING PERSONNEL ID.</td></tr>"; ?>
                            </tbody>
                        </table>
                    </div>

                    <div class="tab-pane fade" id="firearmsTab">
                        <table class="table table-dark table-matrix table-hover">
                            <thead>
                                <tr>
                                    <th>WEAPON MODEL</th>
                                    <th>SERIAL NO</th>
                                    <th>ASSIGNED PURPOSE</th>
                                    <th>TRACK STATUS</th>
                                    <th>DEPLOYMENT UPLINK</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                // Direct lookup against firearm deployment registries
                                $fStmt = $pdo->prepare("SELECT * FROM bookings WHERE officerID = ? ORDER BY book_weaponID DESC");
                                $fStmt->execute([$officerID]);
                                $hasWeapons = false;
                                while($fRow = $fStmt->fetch()) { $hasWeapons = true;
                                ?>
                                <tr>
                                    <td><?= htmlspecialchars($fRow['weapon_name']) ?></td>
                                    <td class="text-warning"><?= htmlspecialchars($fRow['weapon_serial_no']) ?></td>
                                    <td><?= htmlspecialchars($fRow['duty_type']) ?></td>
                                    <td>
                                        <span class="badge badge-tactical <?= ($fRow['weapon_returns'] ?? '') == 'Returned' ? 'badge-outline-success' : 'badge-outline-danger' ?>">
                                            <?= ($fRow['weapon_returns'] ?? '') == 'Returned' ? 'IN_ARMOURY' : 'FIELD_CARRIED' ?>
                                        </span>
                                    </td>
                                    <td><?= htmlspecialchars($fRow['booking_time']) ?></td>
                                </tr>
                                <?php } if(!$hasWeapons) echo "<tr><td colspan='5' class='text-center text-muted'>NO ASSIGNED FIREARM REGISTERED UNDER THIS REGISTRY LOG.</td></tr>"; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php  require_once('includes/footer.php');?>
            </div>
        </div>
    </div>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
</body>
</html>