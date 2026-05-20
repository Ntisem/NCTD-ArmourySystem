<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

// Access Control
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';

if (empty($type) || empty($id)) {
    header("Location: search");
    exit();
}

// Define destination mapping
// Ensure 'officer' points to the correct file name
$redirect_map = [
    'firearm'       => 'firearm-details',
    'ammunition'    => 'ammo-details',
    'officer'       => 'searched-officer-details', 
    'admin'         => 'admin-details',
    'faulty_weapon' => 'faulty-firearm-details',
    'faulty_ammo'   => 'faulty-ammo-details'
];

// If the type is officer, we must pass it as 'officerID' to match your page logic
if ($type === 'officer') {
    header("Location: searched-officer-details?officerID=" . $id);
    exit();
}

// For other types, use the standard map
if (array_key_exists($type, $redirect_map)) {
    header("Location: " . $redirect_map[$type] . "?id=" . $id);
    exit();
}

// Fallback: Generic View (Rest of your existing code remains same)
try {
    $table_info = [
        'firearm' => ['table' => 'firearms', 'pk' => 'firearmID'],
        'ammunition' => ['table' => 'ammunitions', 'pk' => 'ammoID'],
        'officer' => ['table' => 'officers', 'pk' => 'officerID']
    ];

    if (!isset($table_info[$type])) { throw new Exception("INVALID_NODE"); }

    $info = $table_info[$type];
    $stmt = $pdo->prepare("SELECT * FROM {$info['table']} WHERE {$info['pk']} = ?");
    $stmt->execute([$id]);
    $data = $stmt->fetch(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    $data = null;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DATA_SCAN | RESULT</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body style="background:#05070a; color:#fff; font-family:'JetBrains Mono';">
    <div class="container p-5">
        <div class="card bg-dark border-info">
            <div class="card-body">
                <?php if($data): ?>
                    <h3 class="text-info">[ RAW_DATA_DUMP ]</h3>
                    <pre class="text-success"><?php print_r($data); ?></pre>
                <?php else: ?>
                    <h3 class="text-danger">NODE_NOT_FOUND</h3>
                <?php endif; ?>
                <button onclick="window.history.back()" class="btn btn-outline-info mt-3">RETURN</button>
            </div>
        </div>
    </div>
</body>
</html>