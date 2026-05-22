<?php
require_once('connections/connect-db.php');
require_once('functions.php'); // Loaded for formatting or helper continuity
require_once('includes/user_auth.php');
require_once('central-logging-engine.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM firearms WHERE firearmID = ?");
$stmt->execute([$id]);
$asset = $stmt->fetch();

if (!$asset) { die("[CRITICAL_ERROR]: ASSET_NOT_FOUND"); }

// Log activity safely
if (function_exists('logDailyActivity')) {
    logDailyActivity($pdo, "VIEWED_FIREARM_DETAILS: Serial [ " . $asset['firearm_serial_no'] . " ] checked by " . $_SESSION['username'], '', 'Ammunition Management');
} elseif (function_exists('logActivity')) {
    logActivity($_SESSION['username'], "VIEWED_FIREARM_DETAILS", "Viewed details for firearm: {$asset['firearm_serial_no']} - {$asset['firearm_name']}");
}

// FETCH LAST 5 OFFICERS WHO BOOKED THIS FIREARM
// Note: Adjusted table and column names to align with your deployment/booking schema structures
$historyStmt = $pdo->prepare("
    SELECT 
        b.to_officer, 
        b.officerID,
        b.booking_time, 
        b.duty_type, 
        b.duty_location,
        b.returns
    FROM bookings b
    WHERE b.firearm_serial_no = ?
    ORDER BY b.bookingID DESC 
    LIMIT 5
");
$historyStmt->execute([$asset['firearm_serial_no']]);
$bookingHistory = $historyStmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>HQ | DEEP_DIVE: <?= htmlspecialchars($asset['firearm_serial_no']) ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <style>
        body { background: #05070a; color: #e0e0e0; font-family: 'JetBrains Mono', monospace; }
        .detail-box { border-left: 4px solid #00f2ff; background: #0a0c10; padding: 15px; margin-bottom: 15px; transition: 0.3s; }
        .detail-box:hover { background: #12151e; }
        .meta-tag { font-size: 0.65rem; color: #00f2ff; text-transform: uppercase; letter-spacing: 1px; }
        .meta-val { font-size: 1.1rem; font-weight: bold; color: #fff; margin-top: 5px; }
        .text-cyan { color: #00f2ff; }
        .btn-return { border: 1px solid #00f2ff; color: #00f2ff; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; }
        .btn-return:hover { background: rgba(0, 242, 255, 0.1); color: #fff; }
        
        /* Tactical Matrix Table styling */
        .tactical-table { background: #0a0c10; border: 1px solid #1a2230; }
        .tactical-table th { background: #0f131a; color: #00f2ff; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 1px; border-bottom: 2px solid #1a2230 !important; }
        .tactical-table td { border-color: #1a2230 !important; vertical-align: middle; font-size: 0.85rem; }
        .badge-tactical { border-radius: 0; padding: 5px 10px; font-size: 0.7rem; font-weight: bold; }
        .badge-outline-success { border: 1px solid #00ff88; color: #00ff88; background: transparent; }
        .badge-outline-danger { border: 1px solid #ff3333; color: #ff3333; background: transparent; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5 border-bottom border-secondary pb-3">
            <h2 class="text-cyan">[ASSET_PROFILE]: <?= htmlspecialchars($asset['firearm_serial_no']) ?></h2>
            <a href="firearm-names.php" class="btn btn-return"> << RETURN_TO_INVENTORY </a>
        </div>

        <div class="row mb-4">
            <?php
            $fields = [
                'Serial No' => $asset['firearm_serial_no'],
                'Type' => $asset['firearm_type'],
                'Manufacturer' => $asset['manufacturer'] ?? 'N/A',
                'Designation' => $asset['firearm_name'],
                'Calibre' => $asset['firearm_caliber'],
                'Capacity' => $asset['firearm_capacity'] . " RNDS",
                'Class' => $asset['firearm_class'] ?? 'N/A',
                'Registry Date' => $asset['datetime']
            ];
            foreach($fields as $label => $val): ?>
                <div class="col-md-3">
                    <div class="detail-box">
                        <span class="meta-tag"><?= $label ?></span>
                        <div class="meta-val"><?= htmlspecialchars($val) ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="card bg-dark border-secondary mb-4">
            <div class="card-body p-0">
                <div class="p-3 border-bottom border-secondary d-flex justify-content-between align-items-center">
                    <h5 class="text-cyan mb-0"><i class="mdi mdi-history"></i> [TACTICAL_DEPLOYMENT_HISTORY - LAST 5 ENGAGEMENTS]</h5>
                    <span class="badge badge-secondary"><?= count($bookingHistory) ?> RECORDS FOUND</span>
                </div>
                <div class="table-responsive">
                    <table class="table table-dark table-hover tactical-table mb-0">
                        <thead>
                            <tr>
                                <th>Personnel Name / ID</th>
                                <th>Assignment Parameters</th>
                                <th>Operational Theatre</th>
                                <th>Deployment Timestamp</th>
                                <th>Current Log Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if (!empty($bookingHistory)): ?>
                                <?php foreach ($bookingHistory as $row): ?>
                                    <tr>
                                        <td>
                                            <div class="font-weight-bold text-white"><?= htmlspecialchars($row['to_officer']) ?></div>
                                            <small class="text-muted">ID: <?= htmlspecialchars($row['officerID']) ?></small>
                                        </td>
                                        <td><span class="text-info"><?= htmlspecialchars($row['duty_type']) ?></span></td>
                                        <td><?= htmlspecialchars($row['duty_location']) ?></td>
                                        <td><small class="text-muted"><?= htmlspecialchars($row['booking_time']) ?></small></td>
                                        <td>
                                            <span class="badge badge-tactical <?= ($row['returns'] ?? '') == 'Returned' ? 'badge-outline-success' : 'badge-outline-danger' ?>">
                                                <?= ($row['returns'] ?? '') == 'Returned' ? 'IN_ARMOURY' : 'FIELD_CARRIED' ?>
                                            </span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        <i class="mdi mdi-alert-circle-outline"></i> NO ASSIGNED DEPLOYMENT RECORDS FOUND FOR THIS ASSET IN REGISTRY LOGS.
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="card bg-dark border-info">
            <div class="card-body">
                <h5 class="text-cyan mb-3">[REMARKS_LOG]</h5>
                <p class="text-white"><?= !empty($asset['remarks']) ? htmlspecialchars($asset['remarks']) : "No additional remarks logged for this asset." ?></p>
                <hr class="border-secondary">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="small text-muted">CURRENT_STATE: <strong class="text-success"><?= htmlspecialchars($asset['firearm_state']) ?></strong></span>
                    <a href="javascript:history.back()" class="btn btn-sm btn-info"><i class="mdi mdi-arrow-left-bold"></i></a>
                </div>
            </div>
        </div>
    </div>
    <?php require_once('includes/footer.php');?>
</body>
</html>