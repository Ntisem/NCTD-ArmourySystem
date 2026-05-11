<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if (isset($_POST['booking_firearm'])) {
    $fID = $_POST['firearmID'];
    $aID = $_POST['ammoID'];
    $oID = $_POST['officerID'];
    $qty = (int)$_POST['number_of_rounds'];

    try {
        $pdo->beginTransaction();

        // 1. Insert Booking - Fixed SQL string concatenation/formatting
        $sql = "INSERT INTO bookings (firearmID, ammoID, officerID, booking_time, armourer_issuer,
                to_officer, firearm_name, firearm_serial_no, firearm_class, firearm_state, ammunition_name,
                number_of_rounds, duty_type, duty_location, duty_duration, returns, comment) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?, ?, 'Not-Return', ?)";
        
        $pdo->prepare($sql)->execute([
            $fID, $aID, $oID, date("F j, Y, g:i a"), $_POST['armourer_issuer'],
            $_POST['to_officer'], $_POST['firearm_name'], $_POST['firearm_serial_no'],
            $_POST['firearm_class'],$_POST['firearm_state'], $_POST['ammunition_name'],
            $qty, $_POST['duty_type'], $_POST['duty_location'], $_POST['duty_duration'], $_POST['comment']
        ]);

        // 2. Update Firearm Availability
        $pdo->prepare("UPDATE firearms SET booking_status = 'Not-Available' WHERE firearmID = ?")->execute([$fID]);

        // 3. Deduct Stock
        if($qty > 0 && !empty($aID)) {
            $pdo->prepare("UPDATE ammunitions SET ammo_rounds = ammo_rounds - ? WHERE ammoID = ?")->execute([$qty, $aID]);
        }

        $pdo->commit();
        header("Location: booking?status=success");
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        header("Location: booking?status=error");
        exit();
    }
}