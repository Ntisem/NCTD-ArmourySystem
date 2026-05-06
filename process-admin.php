<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_POST['add_admin'])) {
    $service_no = $_POST['service_no'];
    $rank = $_POST['rank'];
    $gender = $_POST['gender'];
    $user_role = $_POST['user_role'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $fullname = $last_name . ' ' . $first_name;
    $admin_email = $_POST['admin_email'];
    $phone_number = $_POST['phone_number'];
    $username = $_POST['username'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];
    $unit_dept = $_POST['unit_dept'];
    $source_page = $_POST['source_page'];

    if ($password_1 !== $password_2) {
        $_SESSION['toast_message'] = "Passwords do not match.";
        $_SESSION['toast_type'] = "error";
        header("Location: " . $source_page);
        exit();
    }

    $stmt_chk = $pdo->prepare("SELECT * FROM admin_lists WHERE service_no = ? OR admin_email = ? OR phone_number = ? OR username = ?");
    $stmt_chk->execute([$service_no, $admin_email, $phone_number, $username]);
    $existing = $stmt_chk->fetch();

    if ($existing) {
        $err = "";
        if ($existing['service_no'] == $service_no) $err = "Service Number already exists.";
        elseif ($existing['username'] == $username) $err = "Username already exists.";
        elseif ($existing['admin_email'] == $admin_email) $err = "Email already exists.";
        elseif ($existing['phone_number'] == $phone_number) $err = "Phone number already exists.";

        $_SESSION['toast_message'] = $err;
        $_SESSION['toast_type'] = "error";
        header("Location: " . $source_page);
        exit();
    }

    $profile_image = 'default.jpg';
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png'];
        $filename = $_FILES['profile_image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            $new_filename = uniqid('admin_', true) . '.' . $ext;
            // Ensure directory exists or point to proper folder
            if (!is_dir('assets/images/faces')) {
                mkdir('assets/images/faces', 0755, true);
            }
            move_uploaded_file($_FILES['profile_image']['tmp_name'], 'assets/images/faces/' . $new_filename);
            $profile_image = $new_filename;
        }
    }

    $password_hash = md5($password_1);

    $stmt_insert = $pdo->prepare("INSERT INTO admin_lists (profile_image, user_role, service_no, rank, gender, fullname, admin_email, phone_number, username, password, unit_dept, status, datetime) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Verified', NOW())");
    $stmt_insert->execute([$profile_image, $user_role, $service_no, $rank, $gender, $fullname, $admin_email, $phone_number, $username, $password_hash, $unit_dept]);

    $_SESSION['toast_message'] = "Administrator/Armourer successfully created.";
    $_SESSION['toast_type'] = "success";
    header("Location: " . $source_page);
    exit();

} elseif (isset($_POST['edit_admin'])) {
    $adminID = $_POST['adminID'];
    $service_no = $_POST['service_no'];
    $rank = $_POST['rank'];
    $gender = $_POST['gender'];
    $user_role = $_POST['user_role'];
    $fullname = $_POST['fullname'];
    $admin_email = $_POST['admin_email'];
    $phone_number = $_POST['phone_number'];
    $username = $_POST['username'];
    $unit_dept = $_POST['unit_dept'];
    $source_page = $_POST['source_page'];

    $stmt_chk = $pdo->prepare("SELECT * FROM admin_lists WHERE (service_no = ? OR admin_email = ? OR phone_number = ? OR username = ?) AND adminID != ?");
    $stmt_chk->execute([$service_no, $admin_email, $phone_number, $username, $adminID]);
    $existing = $stmt_chk->fetch();

    if ($existing) {
        $err = "";
        if ($existing['service_no'] == $service_no) $err = "Service Number already exists.";
        elseif ($existing['username'] == $username) $err = "Username already exists.";
        elseif ($existing['admin_email'] == $admin_email) $err = "Email already exists.";
        elseif ($existing['phone_number'] == $phone_number) $err = "Phone number already exists.";

        $_SESSION['toast_message'] = $err;
        $_SESSION['toast_type'] = "error";
        header("Location: " . $source_page);
        exit();
    }

    $profile_image_update = '';
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png'];
        $filename = $_FILES['profile_image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        if (in_array($ext, $allowed)) {
            $new_filename = uniqid('admin_', true) . '.' . $ext;
            move_uploaded_file($_FILES['profile_image']['tmp_name'], 'assets/images/faces/' . $new_filename);
            $profile_image_update = $new_filename;
        }
    }

    if (!empty($profile_image_update)) {
        $stmt = $pdo->prepare("UPDATE admin_lists SET profile_image = ?, user_role = ?, service_no = ?, rank = ?, gender = ?, fullname = ?, admin_email = ?, phone_number = ?, username = ?, unit_dept = ? WHERE adminID = ?");
        $stmt->execute([$profile_image_update, $user_role, $service_no, $rank, $gender, $fullname, $admin_email, $phone_number, $username, $unit_dept, $adminID]);
    } else {
        $stmt = $pdo->prepare("UPDATE admin_lists SET user_role = ?, service_no = ?, rank = ?, gender = ?, fullname = ?, admin_email = ?, phone_number = ?, username = ?, unit_dept = ? WHERE adminID = ?");
        $stmt->execute([$user_role, $service_no, $rank, $gender, $fullname, $admin_email, $phone_number, $username, $unit_dept, $adminID]);
    }

    if (!empty($_POST['password'])) {
        $pass_hash = md5($_POST['password']);
        $stmt_pass = $pdo->prepare("UPDATE admin_lists SET password = ? WHERE adminID = ?");
        $stmt_pass->execute([$pass_hash, $adminID]);
    }

    $_SESSION['toast_message'] = "Administrator updated successfully.";
    $_SESSION['toast_type'] = "success";
    header("Location: " . $source_page);
    exit();

} elseif (isset($_POST['delete_admin'])) {
    $adminID = $_POST['adminID'];
    $source_page = $_POST['source_page'];

    $stmt_del = $pdo->prepare("DELETE FROM admin_lists WHERE adminID = ?");
    $stmt_del->execute([$adminID]);

    $_SESSION['toast_message'] = "Record deleted successfully.";
    $_SESSION['toast_type'] = "success";
    header("Location: " . $source_page);
    exit();

} else {
    header("Location: index.php");
    exit();
}
?>