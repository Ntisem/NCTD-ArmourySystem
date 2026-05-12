<?php
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

/** * TACTICAL REGISTRY ENGINE - PDO REFACTOR
 * Refactored from MySQLi to PDO for enhanced security and performance.
 */

if (!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login?status=unauthorized");
    exit();
}

$timestamp = date("Y-m-d H:i:s");

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