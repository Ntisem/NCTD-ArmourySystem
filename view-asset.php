<?php
require_once('connections/connect-db.php');
session_start();

$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? 0;

// 1. Dynamic Data Retrieval based on Asset Type
switch($type) {
    case 'firearm':
        $stmt = $pdo->prepare("SELECT * FROM firearms WHERE firearmID = ?");
        $table_label = "FIREARM_ASSET_FILE";
        break;
    case 'officer':
        $stmt = $pdo->prepare("SELECT * FROM officers WHERE officerID = ?");
        $table_label = "PERSONNEL_DOSSIER";
        break;
    case 'ammo':
        $stmt = $pdo->prepare("SELECT * FROM ammunitions WHERE ammoID = ?");
        $table_label = "AMMUNITION_STOCK_RECORD";
        break;
    default:
        die("ACCESS_DENIED: INVALID_ASSET_TYPE");
}

$stmt->execute([$id]);
$asset = $stmt->fetch();

if(!$asset) die("ERR: ASSET_OFFLINE");

// 2. Resolve Asset Name for History (Using schema-correct keys)
$asset_name = $asset['firearm_name'] ?? $asset['fullname'] ?? $asset['ammunition_name'] ?? 'Unknown Asset';

// 3. Update Recently Viewed History
if (!isset($_SESSION['recently_viewed'])) {
    $_SESSION['recently_viewed'] = [];
}

$current_view = [
    'id' => $id,
    'name' => $asset_name,
    'type' => $type,
    'time' => date('H:i')
];

// Remove duplicates if the user re-visits the same asset
foreach ($_SESSION['recently_viewed'] as $key => $past_view) {
    if ($past_view['id'] == $id && $past_view['type'] == $type) {
        unset($_SESSION['recently_viewed'][$key]);
    }
}

// Add to front and keep only the last 5 views
array_unshift($_SESSION['recently_viewed'], $current_view);
$_SESSION['recently_viewed'] = array_slice($_SESSION['recently_viewed'], 0, 5);
?>

<div class="card tactical-card">
    <div class="card-body">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <h4 class="text-info mb-0"><?= $table_label ?> // ID_<?= htmlspecialchars($id) ?></h4>
                <small class="text-muted">SYSTEM_TIME: <?= date('Y-m-d H:i:s') ?></small>
            </div>
            <button onclick="window.print()" class="btn btn-outline-light btn-xs">GENERATE_HARDCOPY</button>
        </div>
        
        <hr style="border-color: rgba(0, 242, 255, 0.1)">
        
        <div class="row">
            <?php foreach($asset as $key => $value): ?>
                <?php if(!is_numeric($key)): // Skip PDO's numeric indexes ?>
                <div class="col-md-4 mb-3">
                    <label class="text-muted small text-uppercase" style="letter-spacing: 1px;">
                        <?= str_replace('_', ' ', $key) ?>
                    </label>
                    <p class="text-white font-weight-bold mb-0">
                        <?= htmlspecialchars($value ?? 'N/A') ?>
                    </p>
                </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>
    </div>
</div>