<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

// 1. ROUTING LOGIC: Map the 'type' from the search results to specific detail pages or logic
$type = $_GET['type'] ?? '';
$id = $_GET['id'] ?? '';

if (empty($type) || empty($id)) {
    header("Location: intel-hub");
    exit();
}

// Define destination mapping
$redirect_map = [
    'firearm'       => 'firearm-details.php',
    'ammunition'    => 'ammo-details.php',
    'officer'       => 'officer-details.php',
    'admin'         => 'admin-details.php',
    'faulty_weapon' => 'faulty-firearm-details.php',
    'faulty_ammo'   => 'faulty-ammo-details.php'
];

// If a specific detail page exists, redirect there with the ID
if (array_key_exists($type, $redirect_map)) {
    header("Location: " . $redirect_map[$type] . "?id=" . $id);
    exit();
}

// Fallback: If no specific page exists, display a generic tactical data view
try {
    // Determine table and primary key based on type
    $table_info = [
        'firearm' => ['table' => 'firearms', 'pk' => 'firearmID'],
        'officer' => ['table' => 'officers', 'pk' => 'officerID'],
        'ammunition' => ['table' => 'ammunitions', 'pk' => 'ammoID'],
        'admin' => ['table' => 'admin_lists', 'pk' => 'adminID'],
    ];

    $current_table = $table_info[$type]['table'] ?? null;
    $current_pk = $table_info[$type]['pk'] ?? null;

    if ($current_table) {
        $stmt = $pdo->prepare("SELECT * FROM $current_table WHERE $current_pk = ?");
        $stmt->execute([$id]);
        $data = $stmt->fetch(PDO::FETCH_ASSOC);
    }
} catch (PDOException $e) {
    $error = $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>INTEL_EXTRACT | DATA_NODE_<?php echo strtoupper($id); ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=JetBrains+Mono&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root {
            --neon-cyan: #00f2ff;
            --neon-red: #ff3e3e;
            --cmd-bg: #05070a;
            --panel-bg: rgba(13, 17, 23, 0.95);
        }
        body {
            background-color: var(--cmd-bg);
            font-family: 'JetBrains Mono', monospace;
            color: #fff;
            background-image: radial-gradient(circle at 50% 50%, rgba(0, 242, 255, 0.05) 0%, transparent 80%);
            min-height: 100vh;
        }
        .detail-card {
            background: var(--panel-bg);
            border: 1px solid rgba(0, 242, 255, 0.2);
            box-shadow: 0 0 30px rgba(0,0,0,0.5);
            margin-top: 40px;
            padding: 30px;
            position: relative;
            overflow: hidden;
        }
        .detail-card::before {
            content: "";
            position: absolute;
            top: 0; left: 0; width: 100%; height: 2px;
            background: linear-gradient(90deg, transparent, var(--neon-cyan), transparent);
        }
        .header-status {
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 2px;
            color: var(--neon-cyan);
            border-bottom: 1px solid rgba(0, 242, 255, 0.1);
            padding-bottom: 15px;
            margin-bottom: 25px;
        }
        .data-label {
            color: rgba(0, 242, 255, 0.6);
            font-size: 0.75rem;
            text-transform: uppercase;
            margin-bottom: 2px;
        }
        .data-value {
            color: #fff;
            font-size: 1.1rem;
            margin-bottom: 20px;
            border-left: 2px solid var(--neon-cyan);
            padding-left: 10px;
        }
        .btn-tactical {
            background: transparent;
            border: 1px solid var(--neon-cyan);
            color: var(--neon-cyan);
            font-family: 'Orbitron';
            padding: 10px 25px;
            transition: 0.3s;
        }
        .btn-tactical:hover {
            background: var(--neon-cyan);
            color: #000;
            box-shadow: 0 0 15px var(--neon-cyan);
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="detail-card">
                    <div class="d-flex justify-content-between align-items-center header-status">
                        <span><i class="mdi mdi-database-search mr-2"></i> DATA_QUERY: <?php echo strtoupper($type); ?></span>
                        <span class="small">SECURE_LINK_ACTIVE</span>
                    </div>

                    <?php if (isset($data) && $data): ?>
                        <div class="row">
                            <?php foreach ($data as $key => $value): ?>
                                <?php if (!is_numeric($key)): // Only show associative keys ?>
                                <div class="col-md-6">
                                    <div class="data-label"><?php echo str_replace('_', ' ', strtoupper($key)); ?></div>
                                    <div class="data-value"><?php echo htmlspecialchars($value); ?></div>
                                </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <div class="text-center py-5">
                            <i class="mdi mdi-alert-octagon text-danger d-block mb-3" style="font-size: 3rem;"></i>
                            <h4 class="text-danger font-weight-bold">RECORD_NOT_FOUND</h4>
                            <p class="text-muted">The requested identifier does not exist in the active database nodes.</p>
                        </div>
                    <?php endif; ?>

                    <div class="mt-4 pt-3 border-top border-dark d-flex justify-content-between">
                        <button onclick="window.history.back()" class="btn btn-tactical">
                            <i class="mdi mdi-arrow-left"></i> RETURN
                        </button>
                        <button onclick="window.print()" class="btn btn-outline-secondary text-white border-secondary">
                            <i class="mdi mdi-printer"></i> PRINT_LOG
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>