<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}


$action = $_POST['action'] ?? '';
$adminID = $_SESSION['adminID'] ?? 0;
$adminName = $_SESSION['fullname'] ?? 'SYSTEM';
$datetime = date("Y-m-d H:i:s");

try {
    // 1. ADD OPERATIONS
    if (in_array($action, ['add_manufacturer', 'add_caliber', 'add_category'])) {
        $val = strtoupper(trim($_POST['value']));
        
        if ($action == 'add_manufacturer') {
            $sql = "INSERT INTO firearm_manufacturers (firearm_manufacturer, adminID, armourer_admin_name, datetime) VALUES (?, ?, ?, ?)";
        } elseif ($action == 'add_caliber') {
            $sql = "INSERT INTO firearm_calibers (firearm_caliber, adminID, armourer_admin_name, datetime) VALUES (?, ?, ?, ?)";
        } else {
            $sql = "INSERT INTO firearm_categories (firearm_category, adminID, armourer_admin_name, datetime) VALUES (?, ?, ?, ?)";
        }
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$val, $adminID, $adminName, $datetime]);

        $action_details = "Added " . ucfirst($action) . " [ " . $val . " ]";
        logDailyActivity($pdo, $action_details, '', 'Firearm Attribute Management');

        $_SESSION['status'] = "DATA_ADDED";
        $_SESSION['status_code'] = "success";
    }

    // 2. UPDATE OPERATIONS
    if ($action == 'update_attribute') {
        $type = $_POST['type']; // manufacturer, caliber, or category
        $id = $_POST['id'];
        $val = strtoupper(trim($_POST['value']));

        if ($type == 'manufacturer') {
            $sql = "UPDATE firearm_manufacturers SET firearm_manufacturer = ? WHERE firearm_manufacturerID = ?";
        } elseif ($type == 'caliber') {
            $sql = "UPDATE firearm_calibers SET firearm_caliber = ? WHERE firearm_caliberID = ?";
        } else {
            $sql = "UPDATE firearm_categories SET firearm_category = ? WHERE firearm_categoryID = ?";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$val, $id]);
        
        $action_details = "Updated " . ucfirst($type) . " [ ID: " . $id . " ]";
        logDailyActivity($pdo, $action_details, '', 'Firearm Attribute Management');

        $_SESSION['status'] = "DATA_MODIFIED";
        $_SESSION['status_code'] = "success";
    }

    // 3. DELETE OPERATIONS
    if ($action == 'delete_attribute') {
        $type = $_POST['type'];
        $id = $_POST['id'];

        if ($type == 'manufacturer') {
            $sql = "DELETE FROM firearm_manufacturers WHERE firearm_manufacturerID = ?";
        } elseif ($type == 'caliber') {
            $sql = "DELETE FROM firearm_calibers WHERE firearm_caliberID = ?";
        } else {
            $sql = "DELETE FROM firearm_categories WHERE firearm_categoryID = ?";
        }

        $stmt = $pdo->prepare($sql);
        $stmt->execute([$id]);
        
        $action_details = "Deleted " . ucfirst($type) . " [ ID: " . $id . " ]";
        logDailyActivity($pdo, $action_details, '', 'Firearm Attribute Management');
                    
        $_SESSION['status'] = "DATA_DELETED";
        $_SESSION['status_code'] = "error"; // Using error color for deletion theme
    }

} catch (PDOException $e) {
    $_SESSION['status'] = "SYSTEM_FAILURE";
    $_SESSION['status_code'] = "error";
}

header("Location: add-firearm-categories");
exit();
?>