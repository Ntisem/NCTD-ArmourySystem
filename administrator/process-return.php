<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if (isset($_POST['update_status'])) {
    $id            = (int)$_POST['bookingID'];
    $status        = $_POST['return_status']; // 'Returned' or 'Not-Return'
    $ammo_returned = (int)$_POST['ammo_returned'];
    $firearm_state = $_POST['firearm_state'];
    $remarks       = trim($_POST['remarks']);

    try {
        if (!isset($pdo)) {
            throw new Exception("Database connection not found.");
        }

        $pdo->beginTransaction();

        // 1. Get current booking info
        $stmt = $pdo->prepare("SELECT * FROM bookings WHERE bookingID = ?");
        $stmt->execute([$id]);
        $b = $stmt->fetch();

        if (!$b) {
            throw new Exception("Booking record not found for ID: " . $id);
        }

        $returned_time = date("F j, Y, g:i a");

        if ($status == 'Returned' && $b['returns'] !== 'Returned') {
            // 2. Update Booking Status & Return Details
            $update = $pdo->prepare("UPDATE bookings SET returns = 'Returned', firearm_state = ?, comment = ?, ammo_returned = ?, returned_time = ? WHERE bookingID = ?");
            $update->execute([$firearm_state, $remarks, $ammo_returned, $returned_time, $id]);

            // 3. Restock Firearm: Set to 'Available' only if firearmID is not empty/null
            if (!empty($b['firearmID'])) {
                $pdo->prepare("UPDATE firearms SET booking_status = 'Available' WHERE firearmID = ?")
                    ->execute([$b['firearmID']]);
            }

            // 4. Restock Ammo: Add returned/leftover rounds to inventory stock, only if ammoID is not empty
            if (!empty($b['ammoID'])) {
                $pdo->prepare("UPDATE ammunitions SET ammo_rounds = ammo_rounds + ? WHERE ammoID = ?")
                    ->execute([$ammo_returned, $b['ammoID']]);
            }
            
            $log_msg = "ASSET_RECOVERY: Restocked " . $b['firearm_name'] . " and " . $ammo_returned . " rounds. State: " . $firearm_state;
        } else {
            // Update state and remarks if not returned or status is maintained
            $update = $pdo->prepare("UPDATE bookings SET returns = ?, firearm_state = ?, comment = ?, ammo_returned = ? WHERE bookingID = ?");
            $update->execute([$status, $firearm_state, $remarks, $ammo_returned, $id]);
            $log_msg = "STATUS_UPDATE: Booking ID " . $id . " set to " . $status . ".";
        }

        // 5. Log activity
        $adminID   = isset($_SESSION['adminID']) ? $_SESSION['adminID'] : 0;
        $fullname  = isset($_SESSION['fullname']) ? $_SESSION['fullname'] : 'System Administrator';
        $user_role = isset($_SESSION['user_role']) ? $_SESSION['user_role'] : 'Armourer';
        
        $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
        $log->execute([$adminID, $fullname, $log_msg, $user_role]);

        $pdo->commit();
        header("Location: booked-firearms.php?status=success");
        exit();

    } catch (Exception $e) {
        if (isset($pdo) && $pdo->inTransaction()) {
            $pdo->rollBack();
        }
        // Redirect with error
        header("Location: booked-firearms.php?status=error");
        exit();
    }
}
?>