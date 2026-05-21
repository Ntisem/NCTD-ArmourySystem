<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded

// Ensure strict JSON return format for clean client-side AJAX execution
header('Content-Type: application/json');

if (!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    echo json_encode(['status' => 'error', 'message' => 'UNAUTHORIZED_ACCESS']);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action'])) {
    $action = $_POST['action'];

    try {
        // --- HANDLE STOCK METRIC UPDATE & RESTOCK OPERATIONS ---
        if ($action == 'update') {
            $id = isset($_POST['blank_ammoID']) ? (int)$_POST['blank_ammoID'] : 0; 
            $rounds_returned = isset($_POST['faulty_ammo_returned']) ? (int)$_POST['faulty_ammo_returned'] : 0;
            $status = $_POST['faulty_returns_state'] ?? 'Not-Return'; 
            $returned_time = ($status == 'Returned') ? date("F j, Y, g:i a") : ' ';

            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'INVALID_RECORD_IDENTIFIER']);
                exit();
            }

            // Begin safe database transaction block
            $pdo->beginTransaction();

            // Step 1: Fetch state and pull faulty_ammoID directly from database row as priority safety option
            $checkState = $pdo->prepare("SELECT faulty_ammoID, faulty_returns_state, faulty_ammo_name, faulty_ammo_rounds, faulty_ammo_returned FROM blank_ammo_bookings WHERE blank_ammoID = ?");
            $checkState->execute([$id]);
            $currentLog = $checkState->fetch(PDO::FETCH_ASSOC);

            if (!$currentLog) {
                $pdo->rollBack();
                echo json_encode(['status' => 'error', 'message' => 'LOG_RECORD_NOT_FOUND']);
                exit();
            }

            // Core safety resolution hierarchy for index reference keys
            $faulty_ammoID = isset($_POST['faulty_ammoID']) && (int)$_POST['faulty_ammoID'] > 0 
                ? (int)$_POST['faulty_ammoID'] 
                : (int)$currentLog['faulty_ammoID'];

            // Automated Fallback: Query mapping via asset classification string name if key is still missing
            if ($faulty_ammoID <= 0) {
                $lookUp = $pdo->prepare("SELECT faulty_ammoID FROM faulty_ammo WHERE faulty_ammo_name = ? LIMIT 1");
                $lookUp->execute([$currentLog['faulty_ammo_name']]);
                $faulty_ammoID = (int)$lookUp->fetchColumn();
            }

            if ($faulty_ammoID <= 0) {
                $pdo->rollBack();
                echo json_encode(['status' => 'error', 'message' => 'STOCK_LINK_FAILURE: Reference identifier key for faulty_ammo table line could not be resolved.']);
                exit();
            }

            $rounds_issued = (int)$currentLog['faulty_ammo_rounds'];
            $previous_returned = (int)$currentLog['faulty_ammo_returned'];

            if ($rounds_returned > $rounds_issued) {
                $pdo->rollBack();
                echo json_encode(['status' => 'error', 'message' => 'VALIDATION_ERROR: Returned quantity breaks issuance bounds.']);
                exit();
            }

            // Step 2: Calculate Delta Adjustments for the faulty_ammo table stockpile
            if ($status === 'Returned') {
                // Determine true delta modifications accurately (handles modification edits perfectly)
                $net_stock_delta = $rounds_returned - $previous_returned;

                if ($net_stock_delta != 0) {
                    $restock = $pdo->prepare("UPDATE faulty_ammo SET faulty_ammo_quantity = faulty_ammo_quantity + ? WHERE faulty_ammoID = ?");
                    $restock->execute([$net_stock_delta, $faulty_ammoID]);
                }
            } 
            elseif ($status === 'Not-Return' && $previous_returned > 0) {
                // Reverse previous return declarations if status is shifted back to outstanding/unreturned
                $deduct = $pdo->prepare("UPDATE faulty_ammo SET faulty_ammo_quantity = faulty_ammo_quantity - ? WHERE faulty_ammoID = ?");
                $deduct->execute([$previous_returned, $faulty_ammoID]);
                $rounds_returned = 0; 
            }

            // Step 3: Run primary update statement
            $stmt = $pdo->prepare("UPDATE blank_ammo_bookings SET faulty_ammoID = ?, faulty_ammo_returned = ?, faulty_returns_state = ?, returned_time = ? WHERE blank_ammoID = ?");
            $stmt->execute([$faulty_ammoID, $rounds_returned, $status, $returned_time, $id]);
            
            // System Audit Log entry creation
            $action_details = "Updated Booked Ammunition Entry [ ID: " . $id . " ] to state [" . $status . "] with " . $rounds_returned . " rounds returned and restocked.";
            logDailyActivity($pdo, $action_details, '', 'Ammunition Management');
            
            $pdo->commit();
            echo json_encode(['status' => 'success']);
            exit();
        }

        // --- HANDLE PURGE / DELETION OPERATIONS ---
        if ($action == 'delete') {
            $id = isset($_POST['blank_ammoID']) ? (int)$_POST['blank_ammoID'] : 0;
            
            if ($id <= 0) {
                echo json_encode(['status' => 'error', 'message' => 'MISSING_TARGET_IDENTIFIER']);
                exit();
            }

            $stmt = $pdo->prepare("DELETE FROM blank_ammo_bookings WHERE blank_ammoID = ?");
            $stmt->execute([$id]);
            
            $action_details = "PURGE_LOG: Permanently Deleted Booked Ammunition Entry [ ID: " . $id . " ] from active logs.";
            logDailyActivity($pdo, $action_details, '', 'Ammunition Management');
            
            echo json_encode(['status' => 'success']);
            exit();
        }
        
        echo json_encode(['status' => 'error', 'message' => 'INVALID_ACTION_REQUEST']);
        exit();

    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        echo json_encode(['status' => 'error', 'message' => 'DATABASE_EXCEPTION: ' . $e->getMessage()]);
        exit();
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'BAD_REQUEST_METHOD']);
    exit();
}
?>