<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if (!isset($_SESSION["username"])) {
    header("location: login");
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'] ?? '';

    if ($action === 'edit') {
        $adminID      = $_POST['adminID'] ?? '';
        $service_no   = trim($_POST['service_no'] ?? '');
        $rank         = trim($_POST['rank'] ?? '');
        $fullname     = trim($_POST['fullname'] ?? '');
        $admin_email  = trim($_POST['admin_email'] ?? '');
        $phone_number = trim($_POST['phone_number'] ?? '');
        $username     = trim($_POST['username'] ?? '');
        $gender       = trim($_POST['gender'] ?? '');
        $unit_dept    = trim($_POST['unit_dept'] ?? '');
        $current_image = $_POST['current_image'] ?? '';

        // Handle File Upload
        $profile_image = $current_image;
        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath   = $_FILES['profile_image']['tmp_name'];
            $FileName  = $_FILES['profile_image']['name'];
            $Extension = strtolower(pathinfo($FileName, PATHINFO_EXTENSION));
            $allowed   = ['jpg', 'jpeg', 'png', 'gif'];

            if (in_array($Extension, $allowed)) {
                $newFileName = md5(time() . $FileName) . '.' . $Extension;
                $uploadPath  = 'assets/images/armourer_images/';

                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                $dest_path = $uploadPath . $newFileName;

                if (move_uploaded_file($TmpPath, $dest_path)) {
                    $profile_image = $newFileName;

                    // Remove the old image if it's not the default image
                    if ($current_image && $current_image !== 'default.png' && file_exists($uploadPath . $current_image)) {
                        unlink($uploadPath . $current_image);
                    }
                }
            }
        }

        try {
            $stmt = $pdo->prepare("UPDATE admin_lists SET 
                service_no = ?, 
                rank = ?, 
                fullname = ?, 
                admin_email = ?, 
                phone_number = ?, 
                username = ?, 
                gender = ?, 
                unit_dept = ?, 
                profile_image = ? 
                WHERE adminID = ?");
            
            $stmt->execute([
                $service_no, 
                $rank, 
                $fullname, 
                $admin_email, 
                $phone_number, 
                $username, 
                $gender, 
                $unit_dept, 
                $profile_image, 
                $adminID
            ]);

            $_SESSION['success'] = "Profile details updated successfully.";
            
            // Update session if the username was changed
            if ($username !== $_SESSION['username']) {
                $_SESSION['username'] = $username;
            }

            header("location: armourer-profile");
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error updating profile: " . $e->getMessage();
            header("location: armourer-profile");
            exit();
        }

    } elseif ($action === 'delete') {
        $adminID = $_POST['adminID'] ?? '';

        try {
            // Delete old uploaded image if available
            $stmt = $pdo->prepare("SELECT profile_image FROM admin_lists WHERE adminID = ?");
            $stmt->execute([$adminID]);
            $row = $stmt->fetch();

            if ($row) {
                $current_image = $row['profile_image'];
                $uploadPath = 'assets/images/armourer_images/';
                if ($current_image && $current_image !== 'default.png' && file_exists($uploadPath . $current_image)) {
                    unlink($uploadPath . $current_image);
                }
            }

            // Remove record from Database
            $stmt = $pdo->prepare("DELETE FROM admin_lists WHERE adminID = ?");
            $stmt->execute([$adminID]);

            // Log out user
            session_unset();
            session_destroy();
            
            session_start();
            $_SESSION['success'] = "Profile has been successfully decommissioned.";
            header("location: login");
            exit();
        } catch (PDOException $e) {
            $_SESSION['error'] = "Error decommissioning profile: " . $e->getMessage();
            header("location: armourer-profile");
            exit();
        }
    } else {
        $_SESSION['error'] = "Invalid action.";
        header("location: armourer-profile");
        exit();
    }
} else {
    header("location: armourer-profile");
    exit();
}