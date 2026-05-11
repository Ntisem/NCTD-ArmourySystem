<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_weapon'])) {
    // 1. Validate Session Data
    if (!isset($_SESSION['adminID']) || !isset($_SESSION['fullname'])) {
        header("Location: firearm-names.php?status=error&msg=Session_Expired");
        exit();
    }

    // 2. Extract and Sanitize Inputs
    $id           = $_POST['f_id'];
    $serial       = trim($_POST['f_serial']);
    $manufacturer = $_POST['f_manufacturer'];
    $type         = $_POST['f_type'];
    $name         = $_POST['f_name'];
    $caliber      = $_POST['f_caliber'];
    $capacity     = $_POST['f_capacity'];
    $class        = $_POST['f_class'];
    $state        = $_POST['f_state'];
    $booking      = $_POST['f_booking_status'];
    $remarks      = $_POST['f_remarks'];

    try {
        $pdo->beginTransaction();

        // 3. Execute Update
        $sql = "UPDATE firearms SET 
                firearm_serial_no = ?, 
                manufacturer = ?, 
                firearm_type = ?, 
                firearm_name = ?, 
                firearm_caliber = ?, 
                firearm_capacity = ?, 
                firearm_class = ?, 
                firearm_state = ?, 
                booking_status = ?, 
                adminID = ?, 
                armourer_admin_name = ?, 
                remarks = ? 
                WHERE firearmID = ?";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $serial, $manufacturer, $type, $name, $caliber, 
            $capacity, $class, $state, $booking, 
            $_SESSION['adminID'], $_SESSION['fullname'], 
            $remarks, $id
        ]);

        // 4. Audit Log
        $log_action = "MODIFIED_ASSET: " . $serial . " [" . $name . "]";
        $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
        $log->execute([$_SESSION['adminID'], $_SESSION['fullname'], $log_action, $_SESSION['user_role']]);

        $pdo->commit();
        header("Location: firearm-names?firearm-name=" . urlencode($name) . "&status=success");
        exit();

    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        // Redirect with detailed error for debugging
        header("Location: firearm-names?status=error&details=" . urlencode($e->getMessage()));
        exit();
    }
}