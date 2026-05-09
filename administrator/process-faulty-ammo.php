<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

if (isset($_POST['add_faulty_ammo'])) {
    $faulty_ammo_serial_no = $_POST['faulty_ammo_serial_no'];
    $faulty_ammo_manufacturer = $_POST['faulty_ammo_manufacturer'];
    $faulty_ammo_type = $_POST['faulty_ammo_type'] ?? '';
    $faulty_ammo_quantity = (int)$_POST['faulty_ammo_quantity']; 
    $faulty_type = $_POST['faulty_type'];
    $faulty_ammo_comment = $_POST['faulty_ammo_comment'];
    $returned_by_officer = $_POST['returned_by_officer'] ?? '';

    $faulty_ammo_image = '';
    if (!empty($_FILES['faulty_ammo_images']['name'][0])) {
        $target_dir = "assets/images/faulty_ammo_images/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }
        $fileName = basename($_FILES['faulty_ammo_images']['name'][0]);
        $targetFilePath = $target_dir . uniqid() . '_' . $fileName;
        if (move_uploaded_file($_FILES['faulty_ammo_images']['tmp_name'][0], $targetFilePath)) {
            $faulty_ammo_image = $targetFilePath;
        }
    }

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO faulty_ammo (faulty_ammo_manufacturer, faulty_ammo_serial_no, faulty_ammo_type, faulty_ammo_quantity, faulty_type, faulty_ammo_image, faulty_ammo_comment, returned_by_officer) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([
            $faulty_ammo_manufacturer,
            $faulty_ammo_serial_no,
            $faulty_ammo_type,
            $faulty_ammo_quantity,
            $faulty_type,
            $faulty_ammo_image,
            $faulty_ammo_comment,
            $returned_by_officer
        ]);

        // Automatically deduct the faulty ammunition from the ammunitions table
        $stmt_update = $pdo->prepare("UPDATE ammunitions SET ammo_rounds = ammo_rounds - ? WHERE ammo_name = ?");
        $stmt_update->execute([$faulty_ammo_quantity, $faulty_ammo_serial_no]);

        $pdo->commit();
        $_SESSION['status'] = "Added Successfully";
        header('location: faulty-ammo.php?status=success');
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        header('location: faulty-ammo.php?status=error');
        exit();
    }
}

if (isset($_POST['update_faulty_ammo'])) {
    $faulty_ammoID = $_POST['faulty_ammoID'];
    $faulty_ammo_serial_no = $_POST['faulty_ammo_serial_no'];
    $faulty_ammo_quantity = (int)$_POST['faulty_ammo_quantity'];
    $faulty_type = $_POST['faulty_type'];
    $faulty_ammo_comment = $_POST['faulty_ammo_comment'];
    $faulty_ammo_type = $_POST['faulty_ammo_type'] ?? '';

    try {
        $pdo->beginTransaction();
        
        // Fetch the original amount to determine the difference
        $stmt_orig = $pdo->prepare("SELECT faulty_ammo_quantity, faulty_ammo_serial_no FROM faulty_ammo WHERE faulty_ammoID = ?");
        $stmt_orig->execute([$faulty_ammoID]);
        $original = $stmt_orig->fetch();

        if ($original) {
            $diff = $faulty_ammo_quantity - $original['faulty_ammo_quantity'];
            
            // Adjust ammunitions stock
            $stmt_update = $pdo->prepare("UPDATE ammunitions SET ammo_rounds = ammo_rounds - ? WHERE ammo_name = ?");
            $stmt_update->execute([$diff, $original['faulty_ammo_serial_no']]);
        }
        
        $stmt = $pdo->prepare("UPDATE faulty_ammo SET faulty_ammo_serial_no = ?, faulty_ammo_quantity = ?, faulty_type = ?, faulty_ammo_comment = ?, faulty_ammo_type = ? WHERE faulty_ammoID = ?");
        $stmt->execute([$faulty_ammo_serial_no, $faulty_ammo_quantity, $faulty_type, $faulty_ammo_comment, $faulty_ammo_type, $faulty_ammoID]);
        
        $pdo->commit();
        $_SESSION['status'] = "Updated Successfully";
        header('location: faulty-ammo.php?status=success');
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        header('location: faulty-ammo.php?status=error');
        exit();
    }
}

if (isset($_POST['delete_faulty_ammo'])) {
    $faulty_ammoID = $_POST['faulty_ammoID'];

    try {
        $pdo->beginTransaction();

        $stmt_orig = $pdo->prepare("SELECT faulty_ammo_quantity, faulty_ammo_serial_no FROM faulty_ammo WHERE faulty_ammoID = ?");
        $stmt_orig->execute([$faulty_ammoID]);
        $original = $stmt_orig->fetch();

        if ($original) {
            // Return to stock
            $stmt_update = $pdo->prepare("UPDATE ammunitions SET ammo_rounds = ammo_rounds + ? WHERE ammo_name = ?");
            $stmt_update->execute([$original['faulty_ammo_quantity'], $original['faulty_ammo_serial_no']]);
        }

        $stmt = $pdo->prepare("DELETE FROM faulty_ammo WHERE faulty_ammoID = ?");
        $stmt->execute([$faulty_ammoID]);
        
        $pdo->commit();
        header('location: faulty-ammo.php?status=success');
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        header('location: faulty-ammo.php?status=error');
        exit();
    }
}

if (isset($_POST['mark_fixed'])) {
    $faulty_ammoID = $_POST['faulty_ammoID'];

    try {
        $pdo->beginTransaction();

        $stmt_orig = $pdo->prepare("SELECT faulty_ammo_quantity, faulty_ammo_serial_no FROM faulty_ammo WHERE faulty_ammoID = ?");
        $stmt_orig->execute([$faulty_ammoID]);
        $original = $stmt_orig->fetch();

        if ($original) {
            // Return to stock when fixed
            $stmt_update = $pdo->prepare("UPDATE ammunitions SET ammo_rounds = ammo_rounds + ? WHERE ammo_name = ?");
            $stmt_update->execute([$original['faulty_ammo_quantity'], $original['faulty_ammo_serial_no']]);
        }

        $stmt = $pdo->prepare("DELETE FROM faulty_ammo WHERE faulty_ammoID = ?");
        $stmt->execute([$faulty_ammoID]);

        $pdo->commit();
        header('location: faulty-ammo.php?status=success');
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        header('location: faulty-ammo.php?status=error');
        exit();
    }
}
?>