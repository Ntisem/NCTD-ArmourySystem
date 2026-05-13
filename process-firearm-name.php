<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded
// session_start();

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
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
            $_SESSION['status'] = "SUCCESS: UPLINK_COMMITTED";
            $_SESSION['status_code'] = "success";
            $action_details = "Added Firearm Name [ " . $name . " ]";
            logDailyActivity($pdo, $action_details, '', 'Firearm Name Management');
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
        $_SESSION['status'] = "SUCCESS: REGISTRY_MODIFIED";
        $_SESSION['status_code'] = "info";
        $action_details = "Updated Firearm Name [ ID: " . $id . " ]";
        logDailyActivity($pdo, $action_details, '', 'Firearm Name Management');
    }
    header("Location: add-firearm-name");
    exit();
}

// DELETE
if (isset($_POST['delete_firearm'])) {
    $id = $_POST['firearm_nameID'];
    
    $stmt = $pdo->prepare("DELETE FROM firearm_name WHERE firearm_nameID = ?");
    if ($stmt->execute([$id])) {
        $_SESSION['status'] = "SUCCESS: DATA_PURGED";
        $_SESSION['status_code'] = "warning";
        $action_details = "Deleted Firearm Name [ ID: " . $id . " ]";
        logDailyActivity($pdo, $action_details, '', 'Firearm Name Management');
    }
    header("Location: add-firearm-name");
    exit();
}