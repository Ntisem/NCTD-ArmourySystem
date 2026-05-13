<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

if (isset($_POST['confirm_delete'])) {
    $id = $_POST['delete_id'] ?? null;

    if ($id) {
        try {
            $pdo->beginTransaction();

            // 1. SOFT DELETE: Update the status instead of deleting
            $stmt = $pdo->prepare("UPDATE firearms SET is_deleted = 1, booking_status = 'Archived' WHERE firearmID = ?");
            $stmt->execute([$id]);

            // 2. AUDIT LOG: Always log who performed the removal
            $log_action = "SOFT_DELETE_PERFORMED on Asset ID: " . $id;
            $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
            $log->execute([$_SESSION['adminID'], $_SESSION['fullname'], $log_action, $_SESSION['user_role']]);

            $action_details = "Archived Firearm [ ID: " . $id . " ]";
            logDailyActivity($pdo, $action_details, '', 'Firearm Management');
    
            $pdo->commit();
            header("Location: firearm-names?status=success&msg=Asset_Archived");
            exit();
        } catch (Exception $e) {
            $pdo->rollBack();
            header("Location: firearm-names?status=error");
            exit();
        }
    }
}