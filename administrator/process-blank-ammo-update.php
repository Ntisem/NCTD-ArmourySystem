<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}   

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_ammo'])) {
    $id           = $_POST['ammo_id'];
    $name         = $_POST['ammo_name'];
    $manufacturer = $_POST['manufacturer'];
    $rounds       = $_POST['ammo_rounds'];
    $app          = $_POST['ammo_application'];
    $status       = $_POST['booking_status'];
    $remarks      = $_POST['remarks'];

    try {
        $pdo->beginTransaction();

        // Matching your SQL columns: ammo_name, manufacturer, ammo_rounds, ammo_application, booking_status, remarks
        $sql = "UPDATE ammunitions SET 
                ammo_name = ?, 
                manufacturer = ?, 
                ammo_rounds = ?, 
                ammo_application = ?, 
                booking_status = ?, 
                remarks = ? 
                WHERE ammoID = ? AND ammo_type = 'Blank-Ammo'";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$name, $manufacturer, $rounds, $app, $status, $remarks, $id]);

        // Audit Log
        $adminID = $_SESSION['adminID'] ?? 0;
        $adminName = $_SESSION['fullname'] ?? 'System';
        $log_action = "UPDATED_AMMO_STOCK: " . $name;
        
        $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
        $log->execute([$adminID, $adminName, $log_action, $_SESSION['user_role']]);
        
        $action_details = "Updated Ammunition [ ID: " . $id . " ]";
        logDailyActivity($pdo, $action_details, '', 'Ammunition Management');

        $pdo->commit();
        header("Location: blank-ammo?status=success");
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        header("Location: blank-ammo?status=error&msg=" . urlencode($e->getMessage()));
        exit();
    }
}