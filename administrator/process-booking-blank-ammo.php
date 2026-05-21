<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded

if (!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['booking_blank_ammo'])) {
    // 1. Capture and Sanitize Inputs
    $faulty_ammoID  = $_POST['faulty_ammoID'];
    $officerID      = $_POST['officerID'];
    $rounds_issued  = (int)$_POST['faulty_ammo_rounds'];
    $booking_time   = date("F j, Y, g:i a");

    $to_officer          = $_POST['to_officer'] ?? '';
    $armourer_issuer     = $_POST['armourer_issuer'] ?? '';
    $officer_image       = $_POST['officer_image'] ?? '';
    $faulty_ammo_name    = $_POST['faulty_ammo_name'] ?? '';
    $duty_type           = $_POST['duty_type'] ?? '';
    $duty_location       = $_POST['duty_location'] ?? '';
    $duty_duration       = $_POST['duty_duration'] ?? '';
    $faulty_ammo_comment = $_POST['faulty_ammo_comment'] ?? '';

    // Secure Verification: Retrieve adminID directly via current session user to prevent Null Constraint Violations
    $adminID = $_SESSION['adminID'] ?? null;
    if (empty($adminID)) {
        $adminStmt = $pdo->prepare("SELECT adminID FROM admin_lists WHERE username = ?");
        $adminStmt->execute([$_SESSION['username']]);
        $adminID = $adminStmt->fetchColumn();
    }

    // Abort processing safely if user entity is unresolvable
    if (!$adminID) {
        header("Location: booking-blank-ammo?status=error&msg=" . urlencode("UNRESOLVED_ADMIN_IDENTITY"));
        exit();
    }

    if ($rounds_issued <= 0 || empty($faulty_ammoID) || empty($officerID)) {
        header("Location: booking-blank-ammo?status=error&msg=" . urlencode("INVALID_INPUT_PARAMETERS"));
        exit();
    }

    try {
        $pdo->beginTransaction();

        // 2. Structural Stock Audit Check
        $stockCheck = $pdo->prepare("SELECT faulty_ammo_quantity FROM faulty_ammo WHERE faulty_ammoID = ? FOR UPDATE");
        $stockCheck->execute([$faulty_ammoID]);
        $current_stock = $stockCheck->fetchColumn();

        if ($current_stock === false || $current_stock < $rounds_issued) {
            header("Location: booking-blank-ammo?status=error&msg=" . urlencode("INSUFFICIENT_STOCK_LEVELS"));
            $pdo->rollBack();
            exit();
        }

        // 3. Complete Field Data Sync Execution
        $sql = "INSERT INTO blank_ammo_bookings (
                    officerID, faulty_ammoID, armourer_issuer, officer_image, to_officer, 
                    booking_time, faulty_ammo_name, faulty_ammo_rounds, faulty_ammo_returned, 
                    duty_type, duty_location, duty_duration, faulty_ammo_comment, 
                    faulty_returns_state, returned_time
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, ?, ?, ?, ?, 'Not-Return', ' ')";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $officerID,
            $faulty_ammoID,
            $armourer_issuer,
            $officer_image,
            $to_officer,
            $booking_time,
            $faulty_ammo_name,
            $rounds_issued,
            $duty_type,
            $duty_location,
            $duty_duration,
            $faulty_ammo_comment
        ]);

        $last_inserted_id = $pdo->lastInsertId();

        // 4. Deduct Stock safely from Inventory
        $updateStock = $pdo->prepare("UPDATE faulty_ammo SET faulty_ammo_quantity = faulty_ammo_quantity - ? WHERE faulty_ammoID = ?");
        $updateStock->execute([$rounds_issued, $faulty_ammoID]);

        // 5. Create Audit Log Entries with valid resolved adminID
        $action_summary = "AMMO_DEPLOYED: " . $rounds_issued . " rounds of " . $faulty_ammo_name . " issued to " . $to_officer;
        
        $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
        $log->execute([$adminID, $_SESSION['fullname'] ?? $armourer_issuer, $action_summary, $_SESSION['user_role']]);

        $action_details = "Booked Blank Ammunition [ Log ID: " . $last_inserted_id . " ] - " . $rounds_issued . " rounds of " . $faulty_ammo_name . " issued to " . $to_officer;
        logDailyActivity($pdo, $action_details, '', 'Ammunition Management');

        $pdo->commit();
        header("Location: booking-blank-ammo?status=success");
        exit();

    } catch (Exception $e) {
        if ($pdo->inTransaction()) {
            $pdo->rollBack();
        }
        header("Location: booking-blank-ammo?status=error&msg=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    header("Location: booking-blank-ammo");
    exit();
}