<?php
require_once('connections/connect-db.php');
session_start();

/**
 * TACTICAL LOGOUT ENGINE
 * This script records the final session state before terminating the uplink.
 */

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    
    try {
        // 1. Retrieve the most recent login record for this user
        $stmt = $pdo->prepare("SELECT loginID, admin_username, user_role FROM `login_activity` WHERE `admin_username` = ? ORDER BY loginID DESC LIMIT 1");
        $stmt->execute([$username]);
        $row = $stmt->fetch();

        if ($row) {
            $loginID = $row['loginID'];
            $admin_username = $row['admin_username'];
            $user_role = $row['user_role'];
            $last_logout_time = gmdate("l jS \of F Y h:i:s A");

            // 2. Insert logout activity using PDO
            $log_sql = "INSERT INTO `logout_activity` (`loginID`, `admin_username`, `user_role`, `last_logout_time`) VALUES (?, ?, ?, ?)";
            $log_stmt = $pdo->prepare($log_sql);
            $log_stmt->execute([$loginID, $admin_username, $user_role, $last_logout_time]);
        }
    } catch (PDOException $e) {
        // Fail silently to the user but log error if needed
        error_log("Logout Logging Failed: " . $e->getMessage());
    }
}

// 3. Clear all session data
$_SESSION = array();

// 4. Destroy the session cookie if it exists
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// 5. Final termination
session_destroy();
header("Location: login.php");
exit();
?>