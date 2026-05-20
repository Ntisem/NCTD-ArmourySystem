<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if (file_exists('central-logging-engine.php')) {
    require_once('central-logging-engine.php');
}

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

// 1. ADD OPERATIONS
if (isset($_POST['add_faulty_ammo'])) {
    $faulty_ammo_name = trim($_POST['faulty_ammo_name']);
    $faulty_ammo_manufacturer = trim($_POST['faulty_ammo_manufacturer']);
    $faulty_ammo_quantity = (int)($_POST['faulty_ammo_quantity'] ?? 1); 
    $faulty_type = trim($_POST['faulty_type']);
    $faulty_ammo_comment = trim($_POST['faulty_ammo_comment']);
    $returned_by_officer = trim($_POST['returned_by_officer'] ?? '');

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

        $stmt = $pdo->prepare("INSERT INTO faulty_ammo (faulty_ammo_name,faulty_ammo_manufacturer, faulty_ammo_quantity, faulty_type, faulty_ammo_image, faulty_ammo_comment, returned_by_officer, is_deleted) VALUES (?, ?, ?, ?, ?, ?, ?, 0)");
        $stmt->execute([
            $faulty_ammo_name,
            $faulty_ammo_manufacturer,
            $faulty_ammo_quantity,
            $faulty_type,
            $faulty_ammo_image,
            $faulty_ammo_comment,
            $returned_by_officer
        ]);

        $stmt_update = $pdo->prepare("UPDATE ammunitions SET ammo_rounds = ammo_rounds - ? WHERE ammo_name = ?");
        $stmt_update->execute([$faulty_ammo_quantity, $faulty_ammo_name]);

        if (function_exists('logDailyActivity')) {
            logDailyActivity($pdo, "Logged Faulty Ammunition Entry [ Name: $faulty_ammo_name | Qty: $faulty_ammo_quantity ]", '', 'Ammunition Management');
        }

        $pdo->commit();
        header('location: faulty-ammo?status=success');
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        header('location: faulty-ammo?status=error');
        exit();
    }
}

// 2. UPDATE OPERATIONS
if (isset($_POST['update_faulty_ammo'])) {
    $faulty_ammoID = (int)$_POST['faulty_ammoID'];
    $faulty_ammo_name = trim($_POST['faulty_ammo_name']);
    $faulty_ammo_manufacturer = trim($_POST['faulty_ammo_manufacturer']);
    $faulty_ammo_quantity = (int)$_POST['faulty_ammo_quantity'];
    $faulty_type = trim($_POST['faulty_type']);
    $faulty_ammo_comment = trim($_POST['faulty_ammo_comment']);

    try {
        $pdo->beginTransaction();
        
        $stmt_orig = $pdo->prepare("SELECT faulty_ammo_quantity, faulty_ammo_name FROM faulty_ammo WHERE faulty_ammoID = ? AND is_deleted = 0");
        $stmt_orig->execute([$faulty_ammoID]);
        $original = $stmt_orig->fetch(PDO::FETCH_ASSOC);

        if ($original) {
            $diff = $faulty_ammo_quantity - (int)$original['faulty_ammo_quantity'];
            $stmt_update = $pdo->prepare("UPDATE ammunitions SET ammo_rounds = ammo_rounds - ? WHERE ammo_name = ?");
            $stmt_update->execute([$diff, $original['faulty_ammo_name']]);
        }
        
        $stmt = $pdo->prepare("UPDATE faulty_ammo SET faulty_ammo_name = ?, faulty_ammo_manufacturer = ?, faulty_ammo_quantity = ?, faulty_type = ?, faulty_ammo_comment = ? WHERE faulty_ammoID = ?");
        $stmt->execute([$faulty_ammo_name, $faulty_ammo_manufacturer, $faulty_ammo_quantity, $faulty_type, $faulty_ammo_comment, $faulty_ammoID]);
        
        if (function_exists('logDailyActivity')) {
            logDailyActivity($pdo, "Altered Faulty Ammunition Record Parameters [ ID: $faulty_ammoID ]", '', 'Ammunition Management');
        }

        $pdo->commit();
        header('location: faulty-ammo?status=success');
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        header('location: faulty-ammo?status=error');
        exit();
    }
}

// 3. DELETE (SOFT-DELETE) OPERATIONS
if (isset($_POST['delete_faulty_ammo'])) {
    $faulty_ammoID = (int)$_POST['faulty_ammoID'];

    try {
        $pdo->beginTransaction();

        $stmt_orig = $pdo->prepare("SELECT faulty_ammo_quantity, faulty_ammo_name FROM faulty_ammo WHERE faulty_ammoID = ?");
        $stmt_orig->execute([$faulty_ammoID]);
        $original = $stmt_orig->fetch(PDO::FETCH_ASSOC);

        if ($original) {
            $stmt_update = $pdo->prepare("UPDATE ammunitions SET ammo_rounds = ammo_rounds + ? WHERE ammo_name = ?");
            $stmt_update->execute([(int)$original['faulty_ammo_quantity'], $original['faulty_ammo_name']]);
        }
    
        $stmt = $pdo->prepare("UPDATE faulty_ammo SET is_deleted = 1 WHERE faulty_ammoID = ?");
        $stmt->execute([$faulty_ammoID]);
        
        if (function_exists('logDailyActivity')) {
            logDailyActivity($pdo, "Purged Faulty Ammunition Entry Records [ ID: $faulty_ammoID ]", '', 'Ammunition Management');
        }

        $pdo->commit();
        header('location: faulty-ammo?status=success');
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        header('location: faulty-ammo?status=error');
        exit();
    }
}

// 4. MARK REPAIRED / INVENTORY RESTORATION OPERATIONS
if (isset($_POST['mark_fixed'])) {
    $faulty_ammoID = (int)$_POST['faulty_ammoID'];

    try {
        $pdo->beginTransaction();

        $stmt_orig = $pdo->prepare("SELECT faulty_ammo_quantity, faulty_ammo_name FROM faulty_ammo WHERE faulty_ammoID = ?");
        $stmt_orig->execute([$faulty_ammoID]);
        $original = $stmt_orig->fetch(PDO::FETCH_ASSOC);

        if ($original) {
            $stmt_update = $pdo->prepare("UPDATE ammunitions SET ammo_rounds = ammo_rounds + ? WHERE ammo_name = ?");
            $stmt_update->execute([(int)$original['faulty_ammo_quantity'], $original['faulty_ammo_name']]);
        }
    
        $stmt = $pdo->prepare("UPDATE faulty_ammo SET is_deleted = 1 WHERE faulty_ammoID = ?");
        $stmt->execute([$faulty_ammoID]);

        if (function_exists('logDailyActivity')) {
            logDailyActivity($pdo, "Certified Component Restored to Store Inventory [ ID: $faulty_ammoID ]", '', 'Ammunition Management');
        }

        $pdo->commit();
        header('location: faulty-ammo?status=success');
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        header('location: faulty-ammo?status=error');
        exit();
    }
}
?>