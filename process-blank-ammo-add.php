<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_ammo'])) {
    
    // 1. Extract and Sanitize
    $name         = trim($_POST['ammo_name']);
    $manufacturer = trim($_POST['manufacturer']);
    $rounds       = (int)$_POST['ammo_rounds'];
    $app          = $_POST['ammo_application'];
    $status       = $_POST['booking_status'];
    $remarks      = trim($_POST['remarks']);
    $ammo_type    = $_POST['ammo_type'];

    // 2. CRITICAL FIX FOR ERROR 1048
    // If the session is empty, we use a fallback ID (e.g., 0 or 1) 
    // to prevent the integrity constraint violation.
    $sessionAdminID   = $_SESSION['adminID'] ?? 0; 
    $sessionFullname  = $_SESSION['fullname'] ?? 'System Armourer';
    $sessionUserRole  = $_SESSION['user_role'] ?? 'Armourer';

    try {
        $pdo->beginTransaction();

        // 3. Insert into ammunitions table
        $sql = "INSERT INTO ammunitions (
                    manufacturer, ammo_type, ammo_name, ammo_application, 
                    ammo_rounds, booking_status, adminID, 
                    armourer_admin_name, remarks, is_deleted
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, 0)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $manufacturer, 
            $ammo_type,
            $name, 
            $app, 
            $rounds, 
            $status,
            $sessionAdminID, 
            $sessionFullname, 
            $remarks
        ]);

        // 4. Create Audit Log Entry
        $log_action = "NEW_BLANK_AMMO_REGISTERED: " . $name . " [Qty: " . $rounds . "] [" . $ammo_type . "]";
        $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
        $log->execute([$sessionAdminID, $sessionFullname, $log_action, $sessionUserRole]);
        
        $action_details = "Added Ammunition [ " . $name . "  ".$manufacturer." (" . $rounds . " ) ] Type: " . $ammo_type;
        logDailyActivity($pdo, $action_details, '', 'Ammunition Management');

        $pdo->commit();
        
        // 5. DYNAMIC TARGET ROUTING BASED ON ASSET TYPE MATCHING
        if (strcasecmp($ammo_type, 'Live-Ammo') === 0) {
            header("Location: ammunition?status=success");
        } elseif (strcasecmp($ammo_type, 'Blank-Ammo') === 0) {
            header("Location: blank-ammo?status=success");
        } else {
            // Standard fallback fallback route if type mismatch occurs
            header("Location: blank-ammo?status=success");
        }
        exit();

    } catch (Exception $e) {
        $pdo->rollBack();
        // Displays the exact SQL exception diagnostics inside tactical toast panels
        if (strcasecmp($ammo_type, 'Blank-Ammo') === 0) {
            header("Location: blank-ammo?status=error&msg=" . urlencode($e->getMessage()));
        } else {
            header("Location: ammunition?status=error&msg=" . urlencode($e->getMessage()));
        }
        exit();
    }
} else {
    header("Location: blank-ammo");
    exit();
}