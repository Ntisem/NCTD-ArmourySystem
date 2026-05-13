<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
function logDailyActivity($pdo, $action_details, $ip = '', $category = 'General') {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $adminID   = $_SESSION['adminID'] ?? 0;
    $fullname  = $_SESSION['fullname'] ?? 'System';
    $user_role = $_SESSION['user_role'] ?? 'Unknown';

    try {
        $sql = "INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role, category, ip_address, datetime) 
                VALUES (?, ?, ?, ?, ?, ?, NOW())";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$adminID, $fullname, $action_details, $user_role, $category, $ip]);
        return true;
    } catch (PDOException $e) {
        // Silently fail or log to error_log to prevent breaking the main process
        error_log("Logging Error: " . $e->getMessage());
        return false;
    }
}
?>