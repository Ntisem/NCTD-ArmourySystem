<?php
require_once('connections/connect-db.php');
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    
    // Capture the page they are leaving
    $last_page = $_SERVER['HTTP_REFERER'] ?? 'index';

    try {
        $stmt = $pdo->prepare("SELECT loginID, admin_username, user_role FROM `login_activity` WHERE `admin_username` = ? ORDER BY loginID DESC LIMIT 1");
        $stmt->execute([$username]);
        $row = $stmt->fetch();

        if ($row) {
            $loginID = $row['loginID'];
            $admin_username = $row['admin_username'];
            $user_role = $row['user_role'];
            $last_logout_time = gmdate("l jS \of F Y h:i:s A");

            $log_stmt = $pdo->prepare("INSERT INTO `logout_activity` (`loginID`, `admin_username`, `user_role`, `last_logout_time`) VALUES (?, ?, ?, ?)");
            $log_stmt->execute([$loginID, $admin_username, $user_role, $last_logout_time]);
        }
    } catch (PDOException $e) {
        error_log("Logout Logging Failed: " . $e->getMessage());
    }

    // Terminate authentication but preserve redirect intent
    unset($_SESSION['username']);
    unset($_SESSION['IS_LOGIN']);
    unset($_SESSION['user_role']);
    
    $_SESSION['redirect_url'] = $last_page;
    $_SESSION['redirect_timestamp'] = time();
}

header("Location: login");
exit();
?>