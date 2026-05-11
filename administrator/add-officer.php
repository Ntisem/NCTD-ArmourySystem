<?php 
session_start();
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

// Access Control
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'administrator') {
    header("location: login.php");
    exit();
}

$error = '';
$success = '';

// Process the form submission
if (isset($_POST['add_officer'])) {
    $officer_status     = 'Active';
    $officer_service_no = trim($_POST['officer_service_no']);
    $rank               = trim($_POST['rank']);
    $full_name          = trim($_POST['full_name']);
    $gender             = $_POST['gender'];
    $dept_unit          = trim($_POST['dept_unit']);
    $phone_no           = trim($_POST['phone_no']);
    $officer_email      = trim($_POST['officer_email']);
    $image_name         = '';

    // 1. Check if Service Number already exists
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM officers WHERE officer_service_no = ?");
    $checkStmt->execute([$officer_service_no]);
    if ($checkStmt->fetchColumn() > 0) {
        $error = "SERVICE_NO_REDUNDANCY: " . htmlspecialchars($officer_service_no) . " ALREADY LOGGED.";
    } else {
        // Handle image upload
        if (isset($_FILES['officer_image']) && $_FILES['officer_image']['error'] == 0) {
            $allowed = ['jpg', 'jpeg', 'png', 'gif'];
            $filename = $_FILES['officer_image']['name'];
            $file_ext = pathinfo($filename, PATHINFO_EXTENSION);

            if (in_array(strtolower($file_ext), $allowed)) {
                $image_name = uniqid('officer_', true) . '.' . $file_ext;
                $upload_dir = 'uploads/';
                if (!is_dir($upload_dir)) { mkdir($upload_dir, 0755, true); }
                move_uploaded_file($_FILES['officer_image']['tmp_name'], $upload_dir . $image_name);
            }
        }

        try {
            $pdo->beginTransaction();

            $stmt = $pdo->prepare("INSERT INTO officers (
                officer_status, officer_image, officer_service_no, rank, full_name, gender, dept_unit, phone_no, officer_email, datetime
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            
            $stmt->execute([
                $officer_status, $image_name, $officer_service_no, $rank, $full_name, $gender, $dept_unit, $phone_no, $officer_email
            ]);

            // Audit Trail - FIXED: Added fallback for adminID and session keys
            $adminID = $_SESSION['adminID'] ?? 0; // Fallback to prevent NULL violation
            $adminName = $_SESSION['fullname'] ?? 'System';
            $userRole = $_SESSION['user_role'] ?? 'administrator';

            $action = "ADD_OFFICER: Added " . $full_name . " (" . $officer_service_no . ")";
            $log = $pdo->prepare("INSERT INTO daily_activities (adminID, administrator_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
            $log->execute([$adminID, $adminName, $action, $userRole]);

            $pdo->commit();
            header("Location: officers-list?status=success");
            exit();
        } catch (Exception $e) {
            $pdo->rollBack();
            $error = 'UPLINK_FAILURE: ' . $e->getMessage();
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>COMMAND_TERMINAL | ADD_OFFICER</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@300;500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root { 
            --neon: #00f2ff; 
            --bg-deep: #05070a; 
            --card-bg: #0d1117; 
            --danger: #ff3e3e; 
            --amber: #f9a602;
        }
        body { 
            background: var(--bg-deep); 
            font-family: 'Roboto Mono', monospace; 
            color: #c0c5ce; 
        }
        .tactical-card { 
            background: var(--card-bg) !important; 
            border: 1px solid rgba(0, 242, 255, 0.2); 
            border-radius: 0; 
            box-shadow: 0 0 20px rgba(0,0,0,0.8);
        }
        .card-header { background: transparent; border-bottom: 1px solid rgba(0, 242, 255, 0.2) !important; }
        .form-control { 
            background: #000 !important; 
            color: #fff !important; 
            border: 1px solid #333 !important; 
            border-radius: 0;
            font-size: 13px;
        }
        .form-control:focus { border-color: var(--neon) !important; box-shadow: 0 0 10px rgba(0, 242, 255, 0.2); }
        .btn-tactical { 
            border: 1px solid var(--neon); 
            color: var(--neon); 
            background: transparent; 
            text-transform: uppercase;
            font-family: 'Orbitron', sans-serif;
            letter-spacing: 1px;
            border-radius: 0;
            transition: 0.3s;
        }
        .btn-tactical:hover { background: var(--neon); color: #000; }
        #image_preview { 
            max-width: 160px; 
            max-height: 160px; 
            display: none; 
            border: 1px solid var(--neon); 
            padding: 5px; 
            background: #000;
        }
        
        /* Toast UI */
        #toast-container { position: fixed; top: 20px; right: 20px; z-index: 10000; }
        .t-toast { 
            background: #000; 
            border: 1px solid var(--neon); 
            color: #fff; 
            padding: 15px 25px; 
            margin-bottom: 10px; 
            border-left: 5px solid var(--neon); 
            box-shadow: 0 0 20px rgba(0, 242, 255, 0.3);
            font-size: 12px;
            font-family: 'Orbitron', sans-serif;
            display: none;
        }
        .t-toast.error { border-color: var(--danger); border-left-color: var(--danger); box-shadow: 0 0 20px rgba(255, 62, 62, 0.3); }
        label { font-size: 10px; text-transform: uppercase; color: var(--neon); letter-spacing: 1px; }
    </style>
</head>
<body>
    <div id="toast-container"></div>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card tactical-card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h5 class="mb-0 text-white" style="font-family:'Orbitron';">[ ADD_NEW_OFFICER ]</h5>
                        <a href="officers-list.php" class="btn btn-outline-secondary btn-sm" style="border-radius:0;">BACK_TO_LOG</a>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST" enctype="multipart/form-data" id="officerForm">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Service Number</label>
                                    <input type="text" name="officer_service_no" id="service_no" class="form-control" placeholder="Eg: 12345" required>
                                    <div id="availability-status" style="font-size:9px; margin-top:5px;"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Rank</label>
                                    <select name="rank" class="form-control" required>
                                        <option value="">SELECT_RANK</option>
                                        <option value="COP">COP</option>
                                        <option value="DCOP">DCOP</option>
                                        <option value="ACP">ACP</option>
                                        <option value="C/SUPT">C/SUPT</option>
                                        <option value="SUPT">SUPT</option>
                                        <option value="DSP">DSP</option>
                                        <option value="ASP">ASP</option>
                                        <option value="C/INSPR">Chief Inspector</option>
                                        <option value="INSPR">Inspector</option>
                                        <option value="SGT">Sergeant</option>
                                        <option value="CPL">Corporal</option>
                                        <option value="L/CPL">Lance Corporal</option>
                                        <option value="CONST">Constable</option>
                                    </select>
                                </div>
                            </div>
                           <!-- </div> -->
                           <div class="row">
                            <div class="form-group col-md-6">
                                <label>Full Name</label>
                                <input type="text" name="full_name" class="form-control" placeholder="Eg: John Doe" required>
                            </div>
                                <div class="form-group col-md-6">
                                    <label>Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="">SELECT_GENDER</option>
                                        <option value="Male">MALE</option>
                                        <option value="Female">FEMALE</option>
                                    </select>
                                </div>
                                </div>
                                  <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Department/Unit</label>
                                    <input type="text" name="dept_unit" class="form-control" value="CTD" required>
                                </div>
                     
                                <div class="form-group col-md-6">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone_no" class="form-control" placeholder="Eg: 0207123678" required>
                                </div>
                                </div>
                                 <div class="row">
                                <div class="form-group col-md-12">
                                    <label>Email Address</label>
                                    <input type="email" name="officer_email" class="form-control" placeholder="Eg: john.doe@police.gov" required>
                                </div>
                            </div>
                            <div class="row">
                            <div class="form-group">
                                <label>Officer Passport Image</label>
                                <input type="file" name="officer_image" id="officer_image" class="form-control" onchange="previewFile(event)" required>
                                <div class="text-center mt-3">
                                    <img id="image_preview" src="#" alt="Preview" />
                                </div>
                            </div>
                            <!-- </div> -->
                            <button type="submit" name="add_officer" id="submitBtn" class="btn btn-tactical btn-block mt-4">COMMIT_OFFICER_DATA</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        function showToast(message, type = 'success') {
            let toast = $(`<div class="t-toast ${type === 'error' ? 'error' : ''}">[SIGNAL]: ${message}</div>`);
            $('#toast-container').append(toast);
            toast.fadeIn(400).delay(5000).fadeOut(400, function(){ $(this).remove(); });
        }

        <?php if($error): ?>
            showToast("<?= $error ?>", "error");
        <?php endif; ?>

        function previewFile(event) {
            const preview = document.getElementById('image_preview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'inline-block';
                }
                reader.readAsDataURL(file);
            }
        }

        $(document).ready(function() {
            $("#service_no").on("keyup blur", function() {
                var serviceNo = $(this).val().trim();
                if (serviceNo.length > 2) {
                    $.ajax({
                        url: "check-service-no.php",
                        type: "POST",
                        data: { service_no: serviceNo },
                        success: function(response) {
                            if (response == "taken") {
                                $("#availability-status").html('<span class="text-danger">✖ UNAVAILABLE</span>');
                                $("#submitBtn").prop("disabled", true);
                            } else {
                                $("#availability-status").html('<span class="text-success">✔ AVAILABLE</span>');
                                $("#submitBtn").prop("disabled", false);
                            }
                        }
                    });
                } else {
                    $("#availability-status").html("");
                }
            });
        });
    </script>
</body>
</html>