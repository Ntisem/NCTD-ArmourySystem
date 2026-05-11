<?php
// session_start();

// Check if user is not logged in
if (!isset($_SESSION["username"])) {
    // Capture the current full URL (including query parameters like ?id=123)
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http";
    $current_url = $protocol . "://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    
    // Store coordinates and timestamp (3600 seconds persistence)
    $_SESSION['redirect_url'] = $current_url;
    $_SESSION['redirect_timestamp'] = time();

    header("Location: login");
    exit();
}
?>