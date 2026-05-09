<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

// Verify that an Armourer is logged in
if (!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login.php");
    exit();
}

if (isset($_POST['add_officer'])) {
    // 1. Sanitize and store inputs
    $officer_service_no = trim($_POST['officer_service_no']);
    $rank               = trim($_POST['rank']);
    $full_name          = trim($_POST['full_name']);
    $gender             = trim($_POST['gender']);
    $dept_unit          = trim($_POST['dept_unit']);
    $phone              = trim($_POST['phone']);
    $email              = trim($_POST['email']);
    $officer_status     = 'Active'; // Default status on creation

    try {
        $pdo->beginTransaction();

        // 2. Handle File Upload
        $target_dir    = "assets/images/officer_images/"; // Ensure this directory exists with proper write permissions
        $officer_image = "";

        // Verify if assets/images/officer_images directory exists, if not, create it
        if (!file_exists($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        if (isset($_FILES["officer_image"]) && $_FILES["officer_image"]["error"] == 0) {
            $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "png" => "image/png");
            $filename = $_FILES["officer_image"]["name"];
            $filetype = $_FILES["officer_image"]["type"];
            $filesize = $_FILES["officer_image"]["size"];

            // Verify file extension
            $ext = pathinfo($filename, PATHINFO_EXTENSION);
            if (!array_key_exists($ext, $allowed)) {
                throw new Exception("Invalid file format selected.");
            }

            // Verify file size: Max 5MB
            $maxsize = 5 * 1024 * 1024;
            if ($filesize > $maxsize) {
                throw new Exception("File size is larger than the allowed limit.");
            }

            // Verify MIME type
            if (in_array($filetype, $allowed)) {
                // Generate unique name to prevent overwriting
                $officer_image = uniqid('off_', true) . "." . $ext;
                move_uploaded_file($_FILES["officer_image"]["tmp_name"], $target_dir . $officer_image);
            } else {
                throw new Exception("There was a problem uploading your file.");
            }
        }

        // 3. Insert into Database
        $sql = "INSERT INTO officers (
                    officer_status, 
                    officer_image, 
                    officer_service_no, 
                    rank, 
                    full_name, 
                    gender, 
                    dept_unit, 
                    phone, 
                    email, 
                    created_at
                ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $officer_status,
            $officer_image,
            $officer_service_no,
            $rank,
            $full_name,
            $gender,
            $dept_unit,
            $phone,
            $email
        ]);

        // 4. Audit Log
        $action = "REGISTERED_OFFICER: " . $full_name . " (" . $officer_service_no . ")";
        $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
        $log->execute([
            $_SESSION['adminID'], 
            $_SESSION['fullname'], 
            $action, 
            $_SESSION['user_role']
        ]);

        // 5. Commit and Redirect
        $pdo->commit();
        header("Location: officers-list.php?status=success");
        exit();

    } catch (Exception $e) {
        $pdo->rollBack();
        // Redirect back with an error message
        header("Location: officers-list.php?status=error&message=" . urlencode($e->getMessage()));
        exit();
    }
} else {
    // If accessed directly without form submission
    header("Location: officers-list.php");
    exit();
}
?>