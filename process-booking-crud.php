<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

if (isset($_POST['soft_delete'])) {
    $id = (int)$_POST['delete_id'];
    
    try {
        if ($id <= 0) {
            throw new Exception("Invalid ID provided.");
        }
        
        if (!isset($pdo)) {
            throw new Exception("Database connection not found.");
        }

        $pdo->beginTransaction();

        // 1. Mark as deleted instead of deleting row
        $stmt = $pdo->prepare("UPDATE bookings SET is_deleted = 1 WHERE bookingID = ?");
        $stmt->execute([$id]);

        // 2. Audit Trail
        $adminID   = isset($_SESSION['adminID']) ? $_SESSION['adminID'] : 0;
        $fullname  = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'System Administrator';
        $user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'Armourer';

        $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
        $log_action = "ARCHIVED_BOOKING_RECORD: ID " . $id;
        $log->execute([$adminID, $fullname, $log_action, $user_role]);
        
        $action_details = "Archived Booking Record [ ID: " . $id . "]";
        logDailyActivity($pdo, $action_details, '', 'Booking Management');

        $pdo->commit();
        header("Location: booked-firearms?status=success");
        exit();

    } catch (Exception $e) {
        if (isset($pdo) && $pdo->inTransaction()) {
            $pdo->rollBack();
        }
        header("Location: booked-firearms?status=error");
        exit();
    }
}
?>