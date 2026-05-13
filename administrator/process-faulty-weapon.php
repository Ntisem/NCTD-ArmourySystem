<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded


// Ensure only authorised Administrator is interacting with the script
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}

// 1. ADD FAULTY WEAPON
if (isset($_POST['add_faulty_weapon'])) {
    $faulty_firearm_serial_no = $_POST['faulty_firearm_serial_no'];
    $faulty_firearm_type = $_POST['faulty_firearm_type'];
    $faulty_firearm_name = $_POST['faulty_firearm_name'];
    $faulty_firearm_class = $_POST['faulty_firearm_class'];
    $faulty_type = $_POST['faulty_type'];
    $faulty_nature = $_POST['faulty_nature'];
    $faulty_firearm_comment = $_POST['faulty_firearm_comment'];
    $returned_by_officer = $_POST['returned_by_officer'];

    $uploaded_images = [];
    $faulty_firearm_image = '';
    
    if (!empty($_FILES['faulty_weapon_images']['name'][0])) {
        $target_dir = "assets/images/faulty_weapon_images/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        foreach ($_FILES['faulty_weapon_images']['name'] as $key => $val) {
            $fileName = basename($_FILES['faulty_weapon_images']['name'][$key]);
            $targetFilePath = $target_dir . uniqid() . '_' . $fileName;
            
            if (move_uploaded_file($_FILES['faulty_weapon_images']['tmp_name'][$key], $targetFilePath)) {
                $uploaded_images[] = $targetFilePath;
            }
        }
    }
    
    if (!empty($uploaded_images)) {
        $faulty_firearm_image = implode(',', $uploaded_images);
    }

    try {
        $pdo->beginTransaction();

        // Check if already in the faulty weapons list
        $check_stmt = $pdo->prepare("SELECT COUNT(*) FROM faulty_weapons WHERE faulty_firearm_serial_no = ?");
        $check_stmt->execute([$faulty_firearm_serial_no]);
        if ($check_stmt->fetchColumn() > 0) {
            $_SESSION['status'] = "Firearm already marked as faulty.";
            $_SESSION['status_code'] = "error";
            header('location: add-faulty-weapon?status=error');
            exit();
        }

        $insert_stmt = $pdo->prepare("INSERT INTO faulty_weapons (faulty_firearm_serial_no, faulty_firearm_type, faulty_firearm_name, faulty_firearm_class, faulty_type, faulty_nature, faulty_firearm_comment, returned_by_officer, faulty_firearm_image, datetime) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
        $insert_stmt->execute([
            $faulty_firearm_serial_no,
            $faulty_firearm_type,
            $faulty_firearm_name,
            $faulty_firearm_class,
            $faulty_type,
            $faulty_nature,
            $faulty_firearm_comment,
            $returned_by_officer,
            $faulty_firearm_image
        ]);
        
                 // ... inside the try{} block ...
        $action_details = "Added Faulty Weapon [ " . $_POST['firearm_name'] . " (" . $qty . " ) ]";
        logDailyActivity($pdo, $action_details, '', 'Faulty Weapon Management');

        $pdo->commit();
        $_SESSION['status'] = "Added Successfully";
        $_SESSION['status_code'] = "success";
        header('location: add-faulty-weapon?status=success');
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        $_SESSION['status'] = "Transaction Failed: " . $e->getMessage();
        $_SESSION['status_code'] = "error";
        header('location: add-faulty-weapon?status=error');
        exit();
    }
}

// 2. UPDATE FAULTY WEAPON
if (isset($_POST['update_faulty_weapon'])) {
    $faulty_weaponID = $_POST['faulty_weaponID'];
    $faulty_firearm_serial_no = $_POST['faulty_firearm_serial_no'];
    $faulty_firearm_name = $_POST['faulty_firearm_name'];
    $faulty_firearm_type = $_POST['faulty_firearm_type'];
    $faulty_firearm_class = $_POST['faulty_firearm_class'];
    $faulty_type = $_POST['faulty_type'];
    $faulty_nature = $_POST['faulty_nature'];
    $faulty_firearm_comment = $_POST['faulty_firearm_comment'];

    try {
        $pdo->beginTransaction();
        
        $stmt = $pdo->prepare("UPDATE faulty_weapons SET faulty_firearm_serial_no = ?, faulty_firearm_name = ?, faulty_firearm_type = ?, faulty_firearm_class = ?, faulty_type = ?, faulty_nature = ?, faulty_firearm_comment = ? WHERE faulty_weaponID = ?");
        $stmt->execute([$faulty_firearm_serial_no, $faulty_firearm_name, $faulty_firearm_type, $faulty_firearm_class, $faulty_type, $faulty_nature, $faulty_firearm_comment, $faulty_weaponID]);
        
        $pdo->commit();
        $_SESSION['status'] = "Updated Successfully";
        header('location: faulty-weapon?status=success');
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        header('location: faulty-weapon?status=error');
        exit();
    }
}

// 3. DELETE FAULTY WEAPON
if (isset($_POST['delete_faulty_weapon'])) {
    $faulty_weaponID = $_POST['faulty_weaponID'];

    try {
        $pdo->beginTransaction();
        
        $stmt = $pdo->prepare("DELETE FROM faulty_weapons WHERE faulty_weaponID = ?");
        $stmt->execute([$faulty_weaponID]);
        
        $pdo->commit();
        $_SESSION['status'] = "Deleted Successfully";
        header('location: faulty-weapon?status=success');
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        header('location: faulty-weapon?status=error');
        exit();
    }
}

// 4. MARK WEAPON AS FIXED & RESTORE
if (isset($_POST['mark_weapon_fixed'])) {
    $faulty_weaponID = $_POST['faulty_weaponID'];

    try {
        $pdo->beginTransaction();
        
        // Remove from the faulty_weapons registry (can be extended to archive or move to service log)
        $stmt = $pdo->prepare("DELETE FROM faulty_weapons WHERE faulty_weaponID = ?");
        $stmt->execute([$faulty_weaponID]);
        
        $pdo->commit();
        $_SESSION['status'] = "Fixed and restored successfully";
        header('location: faulty-weapon?status=success');
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        header('location: faulty-weapon?status=error');
        exit();
    }
}
?>