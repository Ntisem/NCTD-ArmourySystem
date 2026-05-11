<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['submit_ammo'])) {
    
    // 1. Extract and Sanitize
    $name         = trim($_POST['ammo_name']);
    $manufacturer = trim($_POST['manufacturer']);
    $rounds       = (int)$_POST['ammo_rounds'];
    $app          = $_POST['ammo_application'];
    $status       = $_POST['booking_status'];
    $remarks      = trim($_POST['remarks']);

    // 2. CRITICAL FIX FOR ERROR 1048
    // If the session is empty, we use a fallback ID (e.g., 0 or 1) 
    // to prevent the integrity constraint violation.
    $sessionAdminID   = $_SESSION['adminID'] ?? 0; 
    $sessionFullname  = $_SESSION['fullname'] ?? 'System Administrator';
    $sessionUserRole  = $_SESSION['user_role'] ?? 'Administrator';

    try {
        $pdo->beginTransaction();

        // 3. Insert into ammunitions table
        // Included ammo_type as empty string to match your SQL structure requirement
        $sql = "INSERT INTO ammunitions (
                    manufacturer, ammo_type, ammo_name, ammo_application, 
                    ammo_rounds, booking_status, adminID, 
                    armourer_admin_name, remarks, is_deleted
                ) VALUES (?, '', ?, ?, ?, ?, ?, ?, ?, 0)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $manufacturer, 
            $name, 
            $app, 
            $rounds, 
            $status,
            $sessionAdminID, 
            $sessionFullname, 
            $remarks
        ]);

        // 4. Create Audit Log Entry
        $log_action = "NEW_AMMO_REGISTERED: " . $name . " [Qty: " . $rounds . "]";
        $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
        $log->execute([$sessionAdminID, $sessionFullname, $log_action, $sessionUserRole]);

        $pdo->commit();
        
        // Success Redirect
        header("Location: ammunition?status=success");
        exit();

    } catch (Exception $e) {
        $pdo->rollBack();
        // This will now show the specific SQL error in your toast alert for debugging
        header("Location: ammunition?status=error&msg=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: ammunition");
    exit();
}