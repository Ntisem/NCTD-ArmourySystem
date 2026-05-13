<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded

// Access Control
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
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
            logDailyActivity($pdo, $log_action, '', 'Firearm Management');

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