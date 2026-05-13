<?php
/**
 * TERMINAL | ASSET INDUCTION PROCESSOR
 * SYSTEM: P.A.L.A.D.I.N. (GPS ARMOURY)
 */

require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); 

if (!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}

// Logic triggered by 'add_weapon' name from the form
if (isset($_POST['add_weapon'])) {
    try {
        $pdo->beginTransaction();

        $serial_no      = strtoupper(trim($_POST['firearm_serial_no']));
        $manufacturer   = trim($_POST['manufacturer']);
        $type           = $_POST['firearm_type'];
        $name           = $_POST['firearm_name'];
        $caliber        = $_POST['firearm_caliber'];
        $capacity       = $_POST['firearm_capacity'] ?? 0;
        $class          = $_POST['firearm_class'];
        $state          = $_POST['firearm_state'];
        $booking_status = $_POST['booking_status'];
        $remarks        = trim($_POST['remarks']);
        
        $adminID        = $_POST['adminID']; 
        $recorded_by    = $_POST['recorded_by'] ?? $_SESSION["username"]; 

        // Corrected SQL: 14 Columns including automatic timestamps and defaults
        $sql = "INSERT INTO firearms (
                    firearm_serial_no, manufacturer, firearm_type, firearm_name, 
                    firearm_caliber, firearm_capacity, quantity, firearm_class, 
                    firearm_state, booking_status, adminID, recorded_by, remarks, is_deleted, datetime
                ) VALUES (?, ?, ?, ?, ?, ?, 1, ?, ?, ?, ?, ?, ?, 0, NOW())";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $serial_no, 
            $manufacturer, 
            $type, 
            $name, 
            $caliber, 
            $capacity, 
            $class, 
            $state, 
            $booking_status,
            $adminID,
            $recorded_by,
            $remarks
        ]);

        $action_details = "INDUCTED_NEW_ASSET: [ " . $name . " | SN: " . $serial_no . " ]";
        logDailyActivity($pdo, $action_details, '', 'Asset Management');

        $pdo->commit();

        $_SESSION['status'] = "UPLINK_SUCCESS: ASSET_REGISTERED";
        $_SESSION['status_code'] = "success";
        header("Location: add-new-weapon?signal=committed");
        exit();

    } catch (Exception $e) {
        if ($pdo->inTransaction()) { $pdo->rollBack(); }
        $_SESSION['status'] = "DATABASE_FAILURE: " . $e->getMessage();
        $_SESSION['status_code'] = "error";
        header("Location: add-new-weapon?signal=failed");
        exit();
    }
} else {
    // Redirect if page is accessed directly without POST
    header("Location: add-new-weapon");
    exit();
}