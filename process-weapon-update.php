<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded

// Enforce clean structured API response parsing
header('Content-Type: application/json');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    echo json_encode(['status' => 'error', 'message' => 'UNAUTHORIZED_ACCESS_DENIED']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_weapon'])) {
    
    // 1. Session Integrity Auditing
    if (!isset($_SESSION['adminID']) || !isset($_SESSION['fullname'])) {
        echo json_encode(['status' => 'error', 'message' => 'CRITICAL_EXCEPTION: Armourer Session Corrupted.']);
        exit();
    }

    // 2. Variable Structural Normalization
    $id           = isset($_POST['f_id']) ? (int)$_POST['f_id'] : 0;
    $serial       = isset($_POST['f_serial']) ? trim($_POST['f_serial']) : '';
    $manufacturer = isset($_POST['f_manufacturer']) ? trim($_POST['f_manufacturer']) : '';
    $type         = isset($_POST['f_type']) ? trim($_POST['f_type']) : '';
    $name         = isset($_POST['f_name']) ? trim($_POST['f_name']) : '';
    $caliber      = isset($_POST['f_caliber']) ? trim($_POST['f_caliber']) : '';
    $capacity     = isset($_POST['f_capacity']) ? trim($_POST['f_capacity']) : '';
    $class        = isset($_POST['f_class']) ? trim($_POST['f_class']) : 'Duty-Weapon';
    $state        = isset($_POST['f_state']) ? trim($_POST['f_state']) : 'Not-Faulty';
    $booking      = isset($_POST['f_booking_status']) ? trim($_POST['f_booking_status']) : 'Available';
    $remarks      = isset($_POST['f_remarks']) ? trim($_POST['f_remarks']) : '';
    $armourer_admin_name = isset($_POST['armourer_admin_name']) ? trim($_POST['armourer_admin_name']) : $_SESSION['fullname'];

    if ($id <= 0 || empty($serial)) {
        echo json_encode(['status' => 'error', 'message' => 'VALIDATION_FAILED: Target key identifiers missing.']);
        exit();
    }

    try {
        $pdo->beginTransaction();

        // 3. Dynamic Column Fallback Execution Map
        // Inspects target table blueprints to handle 'manufacturer' vs 'firearm_manufacturer' structurally
        $columnsStmt = $pdo->prepare("DESCRIBE firearms");
        $columnsStmt->execute();
        $columns = $columnsStmt->fetchAll(PDO::FETCH_COLUMN);

        $manufacturerColumn = in_array('firearm_manufacturer', $columns) ? 'firearm_manufacturer' : 'manufacturer';

        $sql = "UPDATE firearms SET 
                    firearm_serial_no = ?, 
                    {$manufacturerColumn} = ?, 
                    firearm_type = ?, 
                    firearm_name = ?, 
                    firearm_caliber = ?, 
                    firearm_capacity = ?, 
                    firearm_class = ?, 
                    firearm_state = ?, 
                    booking_status = ?, 
                    adminID = ?, 
                    remarks = ? 
                WHERE firearmID = ?";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $serial, $manufacturer, $type, $name, $caliber, 
            $capacity, $class, $state, $booking, 
            $_SESSION['adminID'],
            $remarks, $id
        ]);

        // 4. Activity Log and System Security Reporting
        $action_details = "MODIFIED_ASSET_METRICS: Serial [" . $serial . "] under Class [" . $name . "] modified by terminal admin.";
        logDailyActivity($pdo, $action_details, '', 'Firearm Management');

        $pdo->commit();
        
        // Return clear status response packet for AJAX Toast engine mapping
        echo json_encode([
            'status' => 'success', 
            'message' => "ASSET_REGISTRY_UPDATED: Serial [ " . $serial . " ] successfully overwritten."
        ]);
        exit();

    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        echo json_encode([
            'status' => 'error', 
            'message' => 'DATABASE_CORE_EXCEPTION: ' . $e->getMessage()
        ]);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'METHOD_REJECTED: Malformed Action Query Header.']);
    exit();
}