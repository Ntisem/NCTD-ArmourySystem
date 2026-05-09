<?php
require_once('connections/connect-db.php');
session_start();

if (!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login?status=unauthorized");
    exit();
}

// --- CREATE ---
if (isset($_POST['add_new_firearm_category'])) {
    $category     = strtoupper(trim($_POST['new_firearm_category']));
    $caliber      = strtoupper(trim($_POST['new_caliber']));
    $manufacturer = strtoupper(trim($_POST['new_manufacturer']));
    $adminID      = (int)$_POST['adminID'];
    $by           = $_POST['armourer_admin_name'];

    try {
        // Check for duplicates
        $check = $pdo->prepare("SELECT COUNT(*) FROM firearm_categories WHERE firearm_category = ? AND firearm_manufacturer = ?");
        $check->execute([$category, $manufacturer]);
        
        if ($check->fetchColumn() > 0) {
            header("location: add-firearm-categories.php?status=conflict");
            exit();
        }

        $stmt = $pdo->prepare("INSERT INTO firearm_categories (firearm_category, firearm_caliber, firearm_manufacturer, adminID, armourer_admin_name, datetime) VALUES (?, ?, ?, ?, ?, NOW())");
        $stmt->execute([$category, $caliber, $manufacturer, $adminID, $by]);
        header("location: add-firearm-categories.php?status=success");
    } catch (PDOException $e) {
        header("location: add-firearm-categories.php?status=error");
    }
}

// --- UPDATE ---
if (isset($_POST['execute_update'])) {
    $id = (int)$_POST['update_id'];
    $cat = strtoupper(trim($_POST['revised_category']));
    $cal = strtoupper(trim($_POST['revised_caliber']));
    $man = strtoupper(trim($_POST['revised_manufacturer']));
    
    try {
        $stmt = $pdo->prepare("UPDATE firearm_categories SET firearm_category = ?, firearm_caliber = ?, firearm_manufacturer = ? WHERE firearm_categoryID = ?");
        $stmt->execute([$cat, $cal, $man, $id]);
        header("location: add-firearm-categories.php?status=updated");
    } catch (PDOException $e) {
        header("location: add-firearm-categories.php?status=error");
    }
}

// --- DELETE ---
if (isset($_POST['execute_delete'])) {
    $id = (int)$_POST['delete_id'];
    try {
        $stmt = $pdo->prepare("DELETE FROM firearm_categories WHERE firearm_categoryID = ?");
        $stmt->execute([$id]);
        header("location: add-firearm-categories.php?status=deleted");
    } catch (PDOException $e) {
        header("location: add-firearm-categories.php?status=error");
    }
}