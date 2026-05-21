<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded

// Force JSON output header for DataTables/AJAX integration
header('Content-Type: application/json');

if (!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    echo json_encode(['status' => 'error', 'message' => 'UNAUTHORIZED_ACCESS_DENIED']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    try {
        // --- HANDLE UPDATE & INVENTORY RESTORATION ---
        if ($action === 'update') {
            $id = isset($_POST['book_ammoID']) ? (int)$_POST['book_ammoID'] : 0;
            $rounds_issued = isset($_POST['ammo_rounds']) ? (int)$_POST['ammo_rounds'] : 0;
            $rounds_returned = isset($_POST['ammo_returned']) ? (int)$_POST['ammo_returned'] : 0;
            $status = $_POST['ammo_returns'] ?? 'Not-Return';
            $returned_time = ($status === 'Returned') ? date("F j, Y, g:i a") : ' ';

            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'INVALID_TARGET_LOG_ID']);
                exit();
            }

            // Begin ACID Transaction to preserve system integrity
            $pdo->beginTransaction();

            // Step 1: Fetch the existing booking record to check previous state and ammunition link
            $checkStmt = $pdo->prepare("SELECT ammo_returns, ammo_name, ammo_rounds, ammo_returned FROM ammo_bookings WHERE book_ammoID = ?");
            $checkStmt->execute([$id]);
            $currentBooking = $checkStmt->fetch(PDO::FETCH_ASSOC);

            if (!$currentBooking) {
                $pdo->rollBack();
                echo json_encode(['status' => 'error', 'message' => 'BOOKING_RECORD_NOT_FOUND']);
                exit();
            }

            // Step 2: Handle restocking inventory calculations safely
            if ($status === 'Returned') {
                // Calculate the true delta to restock (handles modifications or first-time transitions)
                $previous_returned = (int)$currentBooking['ammo_returned'];
                $net_restock_qty = $rounds_returned - $previous_returned;

                if ($net_restock_qty > 0) {
                    // Update main inventory stock pool dynamically based on ammunition name
                    $updateStock = $pdo->prepare("UPDATE ammunitions SET ammo_rounds = ammo_rounds + ? WHERE ammo_name = ?");
                    $updateStock->execute([$net_restock_qty, $currentBooking['ammo_name']]);
                }
            }

            // Step 3: Update the booking log entry
            $stmt = $pdo->prepare("UPDATE ammo_bookings SET ammo_rounds = ?, ammo_returned = ?, ammo_returns = ?, returned_time = ? WHERE book_ammoID = ?");
            $stmt->execute([$rounds_issued, $rounds_returned, $status, $returned_time, $id]);

            // Step 4: System Audit Logging
            $action_details = "AMMO_RETURN_COMPLETED: Log ID [ " . $id . " ] updated. State: " . $status . ". Returned Qty: " . $rounds_returned . " rounds.";
            logDailyActivity($pdo, $action_details, '', 'Ammunition Management');

            $pdo->commit();
            echo json_encode(['status' => 'success']);
            exit();
        }

        // --- HANDLE PURGE / DELETE ---
        if ($action === 'delete') {
            $id = isset($_POST['book_ammoID']) ? (int)$_POST['book_ammoID'] : 0;

            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'MISSING_TARGET_IDENTIFIER']);
                exit();
            }

            $stmt = $pdo->prepare("DELETE FROM ammo_bookings WHERE book_ammoID = ?");
            $stmt->execute([$id]);

            $action_details = "PURGE_LOG: Permanently deleted deployment log Entry [ ID: " . $id . " ] from the system.";
            logDailyActivity($pdo, $action_details, '', 'Ammunition Management');

            echo json_encode(['status' => 'success']);
            exit();
        }

        echo json_encode(['status' => 'error', 'message' => 'UNRECOGNIZED_ACTION_REQUEST']);
        exit();

    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        echo json_encode(['status' => 'error', 'message' => 'DATABASE_EXCEPTION: ' . $e->getMessage()]);
        exit();
    }
}
echo json_encode(['status' => 'error', 'message' => 'BAD_HTTP_METHOD']);
exit();
?>