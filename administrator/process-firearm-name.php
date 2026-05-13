<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded
// session_start();

// Access Control
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}


// CREATE
if (isset($_POST['add_firearm'])) {
    $name = strtoupper(trim($_POST['new_firearm_name']));
    
    // Check if exists first (Double safety)
    $check = $pdo->prepare("SELECT COUNT(*) FROM firearm_name WHERE firearm_name = ?");
    $check->execute([$name]);
    
    if($check->fetchColumn() > 0) {
        $_SESSION['status'] = "CONFLICT: ASSET_ALREADY_REGISTERED";
        $_SESSION['status_code'] = "error";
    } else {
        $stmt = $pdo->prepare("INSERT INTO firearm_name (firearm_name) VALUES (?)");
        if ($stmt->execute([$name])) {
            logDailyActivity($pdo, "Added Firearm Name [ " . $name . " ]", '', 'Firearm Management');
            $_SESSION['status'] = "SUCCESS: UPLINK_COMMITTED";
            $_SESSION['status_code'] = "success";
        }
    }

    header("Location: add-firearm-name");
    exit();
}

// UPDATE
if (isset($_POST['update_firearm'])) {
    $id = $_POST['firearm_nameID'];
    $name = strtoupper(trim($_POST['new_firearm_name']));
    
    $stmt = $pdo->prepare("UPDATE firearm_name SET firearm_name = ? WHERE firearm_nameID = ?");
    if ($stmt->execute([$name, $id])) {
        logDailyActivity($pdo, "Updated Firearm Name [ " . $name . " ]", '', 'Firearm Management');
        $_SESSION['status'] = "SUCCESS: REGISTRY_MODIFIED";
        $_SESSION['status_code'] = "info";
    }
    header("Location: add-firearm-name");
    exit();
}

// DELETE
if (isset($_POST['delete_firearm'])) {
    $id = $_POST['firearm_nameID'];
    
    $stmt = $pdo->prepare("DELETE FROM firearm_name WHERE firearm_nameID = ?");
    if ($stmt->execute([$id])) {
        logDailyActivity($pdo, "Deleted Firearm Name [ " . $name . " ]", '', 'Firearm Management');
        $_SESSION['status'] = "SUCCESS: DATA_PURGED";
        $_SESSION['status_code'] = "warning";
    }
    header("Location: add-firearm-name");
    exit();
}