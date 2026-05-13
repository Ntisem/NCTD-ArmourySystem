<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php');


// Access Control
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}


if (isset($_POST['confirm_restore'])) {
    $id = $_POST['restore_id'];
    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("UPDATE firearms SET is_deleted = 0, booking_status = 'Available' WHERE firearmID = ?");
        $stmt->execute([$id]);

        $log_action = "RESTORED_ASSET: ID " . $id;
        logDailyActivity($pdo, $log_action, '', 'Firearm Management');

        $pdo->commit();
        $_SESSION['status'] = "REDEPLOYMENT_COMPLETE: ASSET_ACTIVE";
        $_SESSION['status_code'] = "success";
        header("Location: firearm-archive");
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        $_SESSION['status'] = "REDEPLOYMENT_FAILED: SYSTEM_ERROR";
        $_SESSION['status_code'] = "error";
        header("Location: firearm-archive");
        exit();
    }
} else {
    $_SESSION['status'] = "INVALID_REQUEST: NO_ACTION_TAKEN";
    $_SESSION['status_code'] = "error";
    header("Location: firearm-archive");
    exit();
}