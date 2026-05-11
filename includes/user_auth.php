<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/**
 * TACTICAL SESSION MONITOR
 * Inactivity Limit: 600 Seconds (10 Minutes)
 */
$inactivity_limit = 600; 

if (isset($_SESSION['username'])) {
    if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactivity_limit)) {
        // Session expired due to inactivity
        header("Location: logout.php?reason=timeout");
        exit();
    }
    // Update activity timestamp
    $_SESSION['last_activity'] = time();
} else {
    // Unauthorized access attempt: Capture coordinates for potential re-entry
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $current_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    $_SESSION['redirect_url'] = $current_url;
    $_SESSION['redirect_timestamp'] = time();

    header("Location: login");
    exit();
}
?>