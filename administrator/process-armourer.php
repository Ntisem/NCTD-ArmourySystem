<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

// Verify clearance
if(!isset($_SESSION["user_role"]) || ($_SESSION["user_role"] != 'Armourer' && $_SESSION["user_role"] != 'SuperAdmin')) {
    header('Location: login.php');
    exit();
}

if (isset($_POST['action'])) {
    $action = $_POST['action'];

    if ($action == 'add') {
        $user_role = $_POST['user_role'];
        $service_no = $_POST['service_no'];
        $rank = $_POST['rank'];
        $gender = $_POST['gender'];
        $fullname = $_POST['fullname'];
        $admin_email = $_POST['admin_email'];
        $phone_number = $_POST['phone_number'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $unit_dept = $_POST['unit_dept'];
        $code = $_POST['code'] ?? '';

        // Checking the availability of the provided parameters
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM admin_lists WHERE admin_email = ? OR phone_number = ? OR username = ? OR service_no = ?");
        $checkStmt->execute([$admin_email, $phone_number, $username, $service_no]);
        if ($checkStmt->fetchColumn() > 0) {
            $_SESSION['error'] = "Error: The email, phone number, username or service number already exists.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        // Handle image upload
        $profile_image = 'default.jpg';
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['profile_image']['name'];
            $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if (in_array($fileExt, $allowed)) {
                $newFileName = uniqid('', true) . '.' . $fileExt;
                move_uploaded_file($_FILES['profile_image']['tmp_name'], 'assets/images/armourer_images/' . $newFileName);
                $profile_image = $newFileName;
            }
        }

        $hashedPassword = md5($password);
        $insertStmt = $pdo->prepare("INSERT INTO admin_lists (profile_image, user_role, service_no, rank, gender, fullname, admin_email, phone_number, username, password, unit_dept, code, status, datetime) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Verified', NOW())");
        $insertStmt->execute([$profile_image, $user_role, $service_no, $rank, $gender, $fullname, $admin_email, $phone_number, $username, $hashedPassword, $unit_dept, $code]);

        $_SESSION['success'] = "Administrator/Armourer added successfully.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    if ($action == 'edit') {
        $adminID = $_POST['adminID'];
        $user_role = $_POST['user_role'];
        $service_no = $_POST['service_no'];
        $rank = $_POST['rank'];
        $gender = $_POST['gender'];
        $fullname = $_POST['fullname'];
        $admin_email = $_POST['admin_email'];
        $phone_number = $_POST['phone_number'];
        $username = $_POST['username'];
        $unit_dept = $_POST['unit_dept'];
        $code = $_POST['code'] ?? '';

        // Check availability on other IDs
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM admin_lists WHERE (admin_email = ? OR phone_number = ? OR username = ? OR service_no = ?) AND adminID != ?");
        $checkStmt->execute([$admin_email, $phone_number, $username, $service_no, $adminID]);
        if ($checkStmt->fetchColumn() > 0) {
            $_SESSION['error'] = "Error: The email, phone number, username or service number is already assigned to someone else.";
            header("Location: " . $_SERVER['HTTP_REFERER']);
            exit();
        }

        $profile_image = $_POST['current_image'];
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['profile_image']['name'];
            $fileExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
            if (in_array($fileExt, $allowed)) {
                $newFileName = uniqid('', true) . '.' . $fileExt;
                move_uploaded_file($_FILES['profile_image']['tmp_name'], 'assets/images/armourer_images/' . $newFileName);
                $profile_image = $newFileName;
            }
        }

        $updateStmt = $pdo->prepare("UPDATE admin_lists SET profile_image = ?, user_role = ?, service_no = ?, rank = ?, gender = ?, fullname = ?, admin_email = ?, phone_number = ?, username = ?, unit_dept = ?, code = ? WHERE adminID = ?");
        $updateStmt->execute([$profile_image, $user_role, $service_no, $rank, $gender, $fullname, $admin_email, $phone_number, $username, $unit_dept, $code, $adminID]);

        $_SESSION['success'] = "Data updated successfully.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    if ($action == 'delete') {
        $adminID = $_POST['adminID'];
        $delStmt = $pdo->prepare("DELETE FROM admin_lists WHERE adminID = ?");
        $delStmt->execute([$adminID]);

        $_SESSION['success'] = "Data deleted successfully.";
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }
}
?>