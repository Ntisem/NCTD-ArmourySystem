<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

if (isset($_POST['confirm_restore'])) {
    $id = $_POST['restore_id'];
    try {
        $pdo->beginTransaction();

        // 1. Restore the asset
        $stmt = $pdo->prepare("UPDATE firearms SET is_deleted = 0, booking_status = 'Available' WHERE firearmID = ?");
        $stmt->execute([$id]);

        // 2. Log the restoration
        $log_action = "RESTORED_ASSET: ID " . $id;
        $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
        $log->execute([$_SESSION['adminID'], $_SESSION['fullname'], $log_action, $_SESSION['user_role']]);

        $action_details = "Restored Firearm [ ID: " . $id . " ]";
        logDailyActivity($pdo, $action_details, '', 'Firearm Management');

        $pdo->commit();
        header("Location: firearm-archive?status=success");
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        header("Location: firearm-archive?status=error");
        exit();
    }
}