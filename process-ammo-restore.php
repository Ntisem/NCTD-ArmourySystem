<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['restore_id'];
    try {
        $stmt = $pdo->prepare("UPDATE ammunitions SET is_deleted = 0 WHERE ammoID = ?");
        $stmt->execute([$id]);
        
        $action_details = "Restored Ammunition [ ID: " . $id . " ]";
        logDailyActivity($pdo, $action_details, '', 'Ammunition Management');
        
        header("Location: ammo-archive?status=success");
    } catch (Exception $e) {
        header("Location: ammo-archive?status=error");
    }
}