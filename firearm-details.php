<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

$id = $_GET['id'] ?? 0;
$stmt = $pdo->prepare("SELECT * FROM firearms WHERE firearmID = ?");
$stmt->execute([$id]);
$asset = $stmt->fetch();

if (!$asset) { die("[CRITICAL_ERROR]: ASSET_NOT_FOUND"); }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>HQ | DEEP_DIVE: <?= $asset['firearm_serial_no'] ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        body { background: #05070a; color: #e0e0e0; font-family: 'JetBrains Mono', monospace; }
        .detail-box { border-left: 4px solid #00f2ff; background: #0a0c10; padding: 15px; margin-bottom: 15px; transition: 0.3s; }
        .detail-box:hover { background: #12151e; }
        .meta-tag { font-size: 0.65rem; color: #00f2ff; text-transform: uppercase; letter-spacing: 1px; }
        .meta-val { font-size: 1.1rem; font-weight: bold; color: #fff; margin-top: 5px; }
        .text-cyan { color: #00f2ff; }
        .btn-return { border: 1px solid #00f2ff; color: #00f2ff; text-transform: uppercase; font-size: 0.75rem; letter-spacing: 1px; }
        .btn-return:hover { background: rgba(0, 242, 255, 0.1); color: #fff; }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="d-flex justify-content-between align-items-center mb-5 border-bottom border-secondary pb-3">
            <h2 class="text-cyan">[ASSET_PROFILE]: <?= htmlspecialchars($asset['firearm_serial_no']) ?></h2>
            <a href="firearm-names.php" class="btn btn-return"> << RETURN_TO_INVENTORY </a>
        </div>

        <div class="row">
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

        <div class="card bg-dark mt-4 border-info">
            <div class="card-body">
                <h5 class="text-cyan mb-3">[REMARKS_LOG]</h5>
                <p class="text-white"><?= !empty($asset['remarks']) ? htmlspecialchars($asset['remarks']) : "No additional remarks logged for this asset." ?></p>
                <hr class="border-secondary">
                <div class="d-flex justify-content-between align-items-center">
                    <span class="small text-muted">CURRENT_STATE: <strong class="text-success"><?= $asset['firearm_state'] ?></strong></span>
                    <a href="update-firearm.php?firearmID=<?= $asset['firearmID'] ?>" class="btn btn-sm btn-info">INITIALIZE_MODIFICATION</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>