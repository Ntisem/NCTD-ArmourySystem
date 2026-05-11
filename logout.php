<?php
require_once('connections/connect-db.php');
session_start();

/**
 * TACTICAL LOGOUT ENGINE
 * Terminates the uplink while caching last known coordinates.
 */

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    $last_page = $_SERVER['HTTP_REFERER'] ?? 'armourer';

    try {
        // Retrieve the most recent login record
        $stmt = $pdo->prepare("SELECT loginID, admin_username, user_role FROM `login_activity` WHERE `admin_username` = ? ORDER BY loginID DESC LIMIT 1");
        $stmt->execute([$username]);
        $row = $stmt->fetch();

        if ($row) {
            $last_logout_time = gmdate("l jS \of F Y h:i:s A");
            $log_stmt = $pdo->prepare("INSERT INTO `logout_activity` (`loginID`, `admin_username`, `user_role`, `last_logout_time`) VALUES (?, ?, ?, ?)");
            $log_stmt->execute([$row['loginID'], $row['admin_username'], $row['user_role'], $last_logout_time]);
        }
    } catch (PDOException $e) {
        error_log("Logout Logging Failed: " . $e->getMessage());
    }

    // Preserve redirection data before clearing session
    $cached_url = $last_page;
    $cached_time = time();

    // Wipe session but re-insert redirection tokens
    $_SESSION = array();
    session_destroy();
    session_start();

    $_SESSION['redirect_url'] = $cached_url;
    $_SESSION['redirect_timestamp'] = $cached_time;
    
    if(isset($_GET['reason']) && $_GET['reason'] == 'timeout') {
        $_SESSION['status'] = "SESSION_EXPIRED: INACTIVITY_TIMEOUT";
        $_SESSION['status_code'] = "error";
    } else {
        $_SESSION['status'] = "UPLINK_TERMINATED: SECURE_LOGOUT";
        $_SESSION['status_code'] = "success";
    }
}

header("Location: login");
exit();