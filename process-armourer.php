<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php'); // Ensures logDailyActivity() is loaded

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

if (isset($_POST['action']) && $_POST['action'] == 'add') {
    // 1. Capture Inputs
    $service_no   = trim($_POST['service_no']);
    $rank         = $_POST['rank'];
    $fullname     = trim($_POST['fullname']);
    $admin_email  = trim($_POST['admin_email']);
    $phone_number = trim($_POST['phone_number']);
    $username     = trim($_POST['username']);
    $password     = $_POST['password'];
    $unit_dept    = "NCTD";
    $status       = $_POST['status']; // Active
    $code         = $_POST['code'];   // Random 6-digit
    $created_by   = $_POST['created_by'];
    $profile_img  = 'avatar_placeholder.png';

    // 2. Final Server-Side Uniqueness Check
    $check = $pdo->prepare("SELECT COUNT(*) FROM admin_lists WHERE service_no=? OR username=? OR admin_email=? OR phone_number=?");
    $check->execute([$service_no, $username, $admin_email, $phone_number]);
    
    if ($check->fetchColumn() > 0) {
        $_SESSION['status'] = "CONFLICT_DETECTED: COLLISION_ON_UNIQUE_FIELDS";
        $_SESSION['status_code'] = "error";
        header("Location: add-new-armourer");
        exit();
    }

    // 3. Profile Image Handling
    if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
        $allowed = ['jpg', 'jpeg', 'png'];
        $filename = $_FILES['profile_image']['name'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $allowed)) {
            $new_name = "ARM_" . time() . "_" . uniqid() . "." . $ext;
            if (move_uploaded_file($_FILES['profile_image']['tmp_name'], 'assets/images/armourer_images/' . $new_name)) {
                $profile_img = $new_name;
            }
        }
    }

    // 4. Database Insertion
    try {
        $sql = "INSERT INTO admin_lists (
                    profile_image, user_role, service_no, rank, fullname, 
                    admin_email, phone_number, username, password, 
                    unit_dept, code, status, datetime
                ) VALUES (?, 'Armourer', ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $profile_img, $service_no, $rank, $fullname, 
            $admin_email, $phone_number, $username, md5($password), 
            $unit_dept, $code, $status
        ]);

        $action_details = "Added Armourer [ " . $fullname . " (" . $service_no . " ) ]";
        logDailyActivity($pdo, $action_details, '', 'Armourer Management');
    
        $_SESSION['status'] = "UPLINK_SUCCESSFUL: PERSONNEL_ENROLLED";
        $_SESSION['status_code'] = "success";
        header("Location: armourers"); // Or your specific list page
    } catch (PDOException $e) {
        $_SESSION['status'] = "DATABASE_CRITICAL: " . $e->getMessage();
        $_SESSION['status_code'] = "error";
        header("Location: add-new-armourer");
    }
    exit();
}