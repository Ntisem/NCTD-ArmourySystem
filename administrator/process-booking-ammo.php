<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded

// Access Control
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}


if (isset($_POST['booking_ammo'])) {
    // 1. Capture Inputs
    $ammoID        = $_POST['ammoID'];
    $officerID     = $_POST['officerID'];
    $rounds_issued = (int)$_POST['ammo_rounds'];
    $adminID       = $_SESSION['adminID'];
    $booking_time  = date("F j, Y, g:i a");

    try {
        $pdo->beginTransaction();

        // 2. Insert into the correct table: ammo_bookings
        // Including all required fields found in your .sql file
        $sql = "INSERT INTO ammo_bookings (
                    ammoID, officerID, armourer_issuer, officer_image, to_officer, 
                    booking_time, ammo_name, ammo_rounds, ammo_returned, 
                    ammo_state, no_faulty_ammo, duty_type, duty_location, 
                    duty_duration, ammo_comment, ammo_returns, returned_time, bookingCode
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 0, ' ', 0, ?, ?, ?, ?, 'Not-Return', ' ', '')";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $ammoID, 
            $officerID, 
            $_POST['armourer_issuer'], 
            $_POST['officer_image'],
            $_POST['to_officer'], 
            $booking_time, 
            $_POST['ammo_name'], 
            $rounds_issued,
            $_POST['duty_type'], 
            $_POST['duty_location'], 
            $_POST['duty_duration'], 
            $_POST['ammo_comment']
        ]);

        // 3. Update Inventory Stock
        $updateStock = $pdo->prepare("UPDATE ammunitions SET ammo_rounds = ammo_rounds - ? WHERE ammoID = ?");
        $updateStock->execute([$rounds_issued, $ammoID]);

        // 4. Create Audit Log Entry
        $action = "AMMO_DEPLOYED: " . $rounds_issued . " rounds of " . $_POST['ammo_name'] . " issued to " . $_POST['to_officer'];
        $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
        $log->execute([$adminID, $_SESSION['fullname'], $action, $_SESSION['user_role']]);

        // ... inside the try{} block ...
        $action_details = "Booked Ammunition [ " . $_POST['ammo_name'] . " (" . $rounds_issued . " ) ]";
        logDailyActivity($pdo, $action_details, '', 'Ammunition Management');

        $pdo->commit();
        header("Location: booking-ammo?status=success");
        exit();

    } catch (Exception $e) {
        $pdo->rollBack();
        // Log actual error for the developer (you can check your server error logs)
        error_log("Database Error: " . $e->getMessage());
        header("Location: booking-ammo?status=error");
        exit();
    }
}