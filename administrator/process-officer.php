<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded


if (!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}

// 1. ADD OFFICER
if (isset($_POST['add_officer'])) {
    $officer_service_no = trim($_POST['officer_service_no']);
    $rank               = trim($_POST['rank']);
    $full_name          = trim($_POST['full_name']);
    $gender             = trim($_POST['gender']);
    $dept_unit          = trim($_POST['dept_unit']);
    $phone              = trim($_POST['phone']);
    $email              = trim($_POST['email']);
    $officer_status     = 'Active';
    
    $officer_image = '';
    if (isset($_FILES['officer_image']) && $_FILES['officer_image']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath   = $_FILES['officer_image']['tmp_name'];
        $fileName      = $_FILES['officer_image']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        $newFileName   = md5(time() . $fileName) . '.' . $fileExtension;
        $uploadFileDir = './assets/images/officer_images/';
        
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }
        
        $dest_path = $uploadFileDir . $newFileName;
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $officer_image = $newFileName;
        }
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO officers (officer_status, officer_image, officer_service_no, rank, full_name, gender, dept_unit, phone, email) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$officer_status, $officer_image, $officer_service_no, $rank, $full_name, $gender, $dept_unit, $phone, $email]);
        
        logDailyActivity($pdo, "Added Officer: " . $full_name, '', 'Officer Management');

        header("Location: officers-list?status=success_add");
        exit();
    } catch (Exception $e) {
        header("Location: officers-list?status=error");
        exit();
    }
}

// 2. UPDATE OFFICER
if (isset($_POST['update_officer'])) {
    $officerID          = (int)$_POST['officerID'];
    $officer_service_no = trim($_POST['officer_service_no']);
    $rank               = trim($_POST['rank']);
    $full_name          = trim($_POST['full_name']);
    $gender             = trim($_POST['gender']);
    $dept_unit          = trim($_POST['dept_unit']);
    $phone              = trim($_POST['phone']);
    $email              = trim($_POST['email']);
    
    $officer_image = $_POST['current_image'];
    if (isset($_FILES['officer_image']) && $_FILES['officer_image']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath   = $_FILES['officer_image']['tmp_name'];
        $fileName      = $_FILES['officer_image']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        $newFileName   = md5(time() . $fileName) . '.' . $fileExtension;
        $uploadFileDir = './assets/images/officer_images/';
        
        if (!is_dir($uploadFileDir)) {
            mkdir($uploadFileDir, 0755, true);
        }
        
        $dest_path = $uploadFileDir . $newFileName;
        if (move_uploaded_file($fileTmpPath, $dest_path)) {
            $officer_image = $newFileName;
        }
    }

    try {
        $stmt = $pdo->prepare("UPDATE officers SET officer_image = ?, officer_service_no = ?, rank = ?, full_name = ?, gender = ?, dept_unit = ?, phone = ?, email = ? WHERE officerID = ?");
        $stmt->execute([$officer_image, $officer_service_no, $rank, $full_name, $gender, $dept_unit, $phone, $email, $officerID]);
        
        logDailyActivity($pdo, "Updated Officer: " . $full_name, '', 'Officer Management');

        header("Location: officers-list?status=success_update");
        exit();
    } catch (Exception $e) {
        header("Location: officers-list?status=error");
        exit();
    }
}

// 3. DELETE OFFICER
if (isset($_POST['delete_officer'])) {
    $officerID = (int)$_POST['delete_id'];
    
    try {
        $stmt = $pdo->prepare("DELETE FROM officers WHERE officerID = ?");
        $stmt->execute([$officerID]);
        
        logDailyActivity($pdo, "Deleted Officer ID: " . $officerID, '', 'Officer Management');

        header("Location: officers-list?status=success_delete");
        exit();
    } catch (Exception $e) {
        header("Location: officers-list?status=error");
        exit();
    }
}
?>