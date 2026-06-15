<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}

// Unified helper to set toast and redirect
function setFlash($type, $message) {
    $_SESSION['toast_type'] = $type; // 'success' or 'error'
    $_SESSION['toast_message'] = $message;
}

if (isset($_POST['action']) && $_POST['action'] == 'add') {
    $service_no = trim($_POST['service_no']);
    $rank = $_POST['rank'];
    $fullname = trim($_POST['fullname']);
    $admin_email = trim($_POST['admin_email']);
    $phone_number = trim($_POST['phone_number']);
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    $unit_dept = $_POST['unit_dept'];
    $user_role = $_POST['user_role'];
    $status = $_POST['status'];
    $code = $_POST['code'];
    $profile_img = 'avatar_placeholder.png';
    $created_by = $_POST['created_by'];

    $check = $pdo->prepare("SELECT COUNT(*) FROM admin_lists WHERE service_no=? OR username=? OR admin_email=? OR phone_number=?");
    $check->execute([$service_no, $username, $admin_email, $phone_number]);
    
    if ($check->fetchColumn() > 0) {
        setFlash("error", "Conflict detected: User already exists.");
        header("Location: add-new-administrator");
        exit();
    }

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png'];
        $ext = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            $new_name = "ARM_" . time() . "_" . uniqid() . "." . $ext;
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], '../assets/images/armourer_images/' . $new_name)) {
                $profile_img = $new_name;
            }
        }
    }

    try {
        $sql = "INSERT INTO admin_lists (profile_image, user_role, service_no, rank, fullname, admin_email, phone_number, username, password, unit_dept, code, status, datetime, created_by)
         VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW(), ?)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$profile_img, $user_role, $service_no, $rank, $fullname, $admin_email, $phone_number, $username, md5($password), $unit_dept, $code, $status, $created_by]);
        logDailyActivity($pdo, "Added Administrator / Armourer: " . $fullname, '', 'Armourer / Administrator Management');
        setFlash("success", "Added successfully!");
    } catch (PDOException $e) {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Database error: ' . $e->getMessage();
    }
    $_SESSION['toast_type'] = 'success';
    $_SESSION['toast_message'] = 'Added successfully!';
    header("Location: administrators");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'delete') {  
    $adminID = $_POST['adminID'];
    try {
        $stmt = $pdo->prepare("SELECT fullname FROM admin_lists WHERE adminID = ?");
        $stmt->execute([$adminID]);
        $fullname = $stmt->fetchColumn();
        $delete_stmt = $pdo->prepare("DELETE FROM admin_lists WHERE adminID = ?");
        $delete_stmt->execute([$adminID]);
        logDailyActivity($pdo, "Deleted Armourer/Administrator " . $fullname, '', 'Administrator / Armourer Management');
        setFlash("success", "Deleted successfully!");
    } catch (PDOException $e) {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Error deleting record.';
    }
    $_SESSION['toast_type'] = 'success';
    $_SESSION['toast_message'] = 'Deleted successfully!';
    header("Location: administrators");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'update') {  
    $adminID = $_POST['adminID'];
    $service_no = trim($_POST['service_no']);
    $rank = $_POST['rank'];
    $fullname = trim($_POST['fullname']);
    $admin_email = trim($_POST['admin_email']);
    $phone_number = trim($_POST['phone_number']);
    $username = trim($_POST['username']);
    $unit_dept = trim($_POST['unit_dept']);
    $current_image = $_POST['current_image'];
    $user_role = $_POST['user_role'];

    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png'];
        $ext = strtolower(pathinfo($_FILES['profile_image']['name'], PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            $new_name = "ARM_" . time() . "_" . uniqid() . "." . $ext;
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], '../assets/images/armourer_images/' . $new_name)) {
                if ($current_image != 'avatar_placeholder.png' && file_exists('../assets/images/armourer_images/' . $current_image)) {
                    unlink('../assets/images/armourer_images/' . $current_image);
                }
                $current_image = $new_name;
            }
        }
    }

    try {
        $sql = "UPDATE admin_lists SET profile_image=?, user_role=?, service_no=?, rank=?, fullname=?, admin_email=?, phone_number=?, username=?, unit_dept=?, update_time=NOW() WHERE adminID=?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$current_image, $user_role, $service_no, $rank, $fullname, $admin_email, $phone_number, $username, $unit_dept, $adminID]);
        logDailyActivity($pdo, "Updated Armourer: " . $fullname, '', 'Armourer Management');
        setFlash("success", "Updated successfully!");
    } catch (PDOException $e) {
        $_SESSION['toast_type'] = 'error';
        $_SESSION['toast_message'] = 'Error updating record.';
    }
    $_SESSION['toast_type'] = 'success';
    $_SESSION['toast_message'] = 'Updated successfully!';  
    header("Location: administrators");
    exit();
}
?>