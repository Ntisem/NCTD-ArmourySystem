<?php
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

/** * TACTICAL REGISTRY ENGINE - PDO REFACTOR
 * Refactored from MySQLi to PDO for enhanced security and performance.
 */

if (!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'administrator') {
    header("location: login?status=unauthorized");
    exit();
}

$timestamp = date("Y-m-d H:i:s");

// --- 1. FIREARM CATEGORIES (MODELS) ---
if (isset($_POST['add_new_firearm_category'])) {
    $cat = strtoupper(trim($_POST['new_firearm_category']));
    $cal = strtoupper(trim($_POST['firearm_caliber']));
    $man = strtoupper(trim($_POST['firearm_manufacturer']));
    $adminID = intval($_POST['adminID']);
    $u_name = $_POST['armourer_admin_name']; // PDO handles escaping automatically

    try {
        $sql = "INSERT INTO firearm_category (firearm_manufacturer, firearm_caliber, firearm_category, adminID, armourer_admin_name, datetime) 
                VALUES (:man, :cal, :cat, :adminID, :u_name, :dt)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            'man'     => $man,
            'cal'     => $cal,
            'cat'     => $cat,
            'adminID' => $adminID,
            'u_name'  => $u_name,
            'dt'      => $timestamp
        ]);
        header("location: add-firearm-categories?status=success");
    } catch (PDOException $e) {
        header("location: add-firearm-categories?status=error");
    }
    exit();
}

// --- 2. FIREARM NAMES (NOMENCLATURE) ---
if (isset($_POST['add_new_firearm_name'])) {
    $firearm_name = strtoupper(trim($_POST['new_firearm_name']));
    $adminID = intval($_POST['adminID']);
    $recorded_by = $_POST['armourer_admin_name'];

    try {
        // Integrity Check: Avoid duplicate nomenclature
        $check = $pdo->prepare("SELECT firearm_name FROM firearm_name WHERE firearm_name = ?");
        $check->execute([$firearm_name]);
        
        if ($check->rowCount() > 0) {
            header("location: add-firearm-name?status=conflict");
            exit();
        }

        $stmt = $pdo->prepare("INSERT INTO firearm_name (firearm_name, adminID, recorded_by, datetime) VALUES (?, ?, ?, ?)");
        $stmt->execute([$firearm_name, $adminID, $recorded_by, $timestamp]);
        
        header("location: add-firearm-name?status=success");
    } catch (PDOException $e) {
        header("location: add-firearm-name?status=error");
    }
    exit();
}

// --- 3. UPDATE NOMENCLATURE ---
if (isset($_POST['execute_update'])) {
    $id = intval($_POST['update_id']);
    $new_val = strtoupper(trim($_POST['revised_name']));

    try {
        $stmt = $pdo->prepare("UPDATE firearm_name SET firearm_name = ? WHERE firearm_nameID = ?");
        $stmt->execute([$new_val, $id]);
        header("location: add-firearm-name?status=updated");
    } catch (PDOException $e) {
        header("location: add-firearm-name?status=error");
    }
    exit();
}

// --- 4. DELETE NOMENCLATURE ---
if (isset($_POST['execute_delete'])) {
    $id = intval($_POST['delete_id']);

    try {
        $stmt = $pdo->prepare("DELETE FROM firearm_name WHERE firearm_nameID = ?");
        $stmt->execute([$id]);
        header("location: add-firearm-name?status=deleted");
    } catch (PDOException $e) {
        header("location: add-firearm-name?status=error");
    }
    exit();
}