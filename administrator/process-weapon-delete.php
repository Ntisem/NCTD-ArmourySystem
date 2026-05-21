<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php');

header('Content-Type: application/json');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    echo json_encode(['status' => 'error', 'message' => 'UNAUTHORIZED_ACCESS_DENIED']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    $id = isset($_POST['delete_id']) ? (int)$_POST['delete_id'] : 0;

    if ($id <= 0) {
        echo json_encode(['status' => 'error', 'message' => 'PURGE_REJECTED: Missing asset identifier.']);
        exit();
    }

    try {
        $pdo->beginTransaction();

        // Soft delete update deployment map
        $stmt = $pdo->prepare("UPDATE firearms SET is_deleted = 1 WHERE firearmID = ?");
        $stmt->execute([$id]);

        $action_details = "ASSET_PURGED_FROM_ACTIVE_REGISTRY: Record ID [ " . $id . " ] dropped from inventory view metrics.";
        logDailyActivity($pdo, $action_details, '', 'Firearm Management');

        $pdo->commit();
        echo json_encode([
            'status' => 'success', 
            'message' => 'SYS_SIGNAL: ASSET_PURGED_SUCCESSFULLY'
        ]);
        exit();

    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        echo json_encode(['status' => 'error', 'message' => 'PURGE_ABORTED: ' . $e->getMessage()]);
        exit();
    }
}