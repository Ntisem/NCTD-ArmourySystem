<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
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
    $officer_email              = trim($_POST['officer_email']);
    $image_name         = '';

    // 1. Check if Service Number already exists
    $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM officers WHERE officer_service_no = ?");
    $checkStmt->execute([$officer_service_no]);
    if ($checkStmt->fetchColumn() > 0) {
        $error = "Error: Service Number " . htmlspecialchars($officer_service_no) . " is already registered.";
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
            $stmt = $pdo->prepare("INSERT INTO officers (
                officer_status, officer_image, officer_service_no, rank, full_name, gender, dept_unit, phone_no, officer_email, datetime
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, NOW())");
            
            $stmt->execute([
                $officer_status, $image_name, $officer_service_no, $rank, $full_name, $gender, $dept_unit, $phone_no, $officer_email
            ]);

            // Audit Trail
            $action = "ADD_OFFICER: Added " . $full_name . " (" . $officer_service_no . ")";
            $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
            $log->execute([$_SESSION['adminID'], $_SESSION['fullname'], $action, $_SESSION['user_role']]);

            header("Location: officers-list?status=success");
            exit();
        } catch (Exception $e) {
            $error = 'Failed to add officer: ' . $e->getMessage();
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
     <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root { --neon: #00f2ff; --bg-deep: #020408; --card-bg: #0a0d12; --danger: #ff3333; }
        body { background: var(--bg-deep); font-family: 'JetBrains Mono', monospace; color: #e0e0e0; }
        .tactical-card { background: var(--card-bg); border: 1px solid var(--neon); color: #fff; }
        .form-control { background: #11151c; color: #fff; border: 1px solid #444; }
        .form-control:focus { background: #11151c; color: #fff; border-color: var(--neon); box-shadow: 0 0 8px rgba(0, 242, 255, 0.4); }
        .btn-tactical { border: 1px solid var(--neon); color: var(--neon); background: transparent; }
        .btn-tactical:hover { background: var(--neon); color: #000; }
        .preview-container { margin-top: 15px; text-align: center; }
        #image_preview { max-width: 160px; max-height: 160px; display: none; border: 2px dashed var(--neon); padding: 4px; border-radius: 4px; }
        .status-msg { font-size: 0.85rem; margin-top: 5px; }
    </style>
</head>
<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card tactical-card">
                    <div class="card-header border-bottom border-info d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 text-white"><i class="mdi mdi-account-plus text-neon"></i> ADD_NEW_OFFICER</h4>
                        <a href="officers-list.php" class="btn btn-outline-light btn-sm"><i class="mdi mdi-arrow-left"></i> BACK</a>
                    </div>
                    <div class="card-body">
                        <?php if($error): ?>
                            <div class="alert alert-danger" role="alert"><?= $error ?></div>
                        <?php endif; ?>
                        
                        <form action="" method="POST" enctype="multipart/form-data" id="officerForm">
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Service Number</label>
                                    <input type="text" name="officer_service_no" id="service_no" class="form-control" placeholder="e.g., 58551" required>
                                    <div id="availability-status" class="status-msg"></div>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Rank</label>
                                    <select name="rank" class="form-control" required>
                                        <option value="">Select Rank</option>
                                    
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

                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" name="full_name" class="form-control" placeholder="First and Last name" required>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Gender</label>
                                    <select name="gender" class="form-control" required>
                                        <option value="">Choose Gender</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Department/Unit</label>
                                    <input type="text" name="dept_unit" class="form-control" value="CTD" required>
                                </div>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label>Phone Number</label>
                                    <input type="text" name="phone_no" class="form-control" placeholder="eg: 0200123456" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Email Address</label>
                                    <input type="email" name="officer_email" class="form-control" placeholder="eg: john.doe@example.com" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label>Officer Passport Image</label>
                                <input type="file" name="officer_image" id="officer_image" class="form-control" onchange="previewFile(event)" required>
                                <div class="preview-container">
                                    <img id="image_preview" src="#" alt="Officer Image Preview" />
                                </div>
                            </div>

                            <button type="submit" name="add_officer" id="submitBtn" class="btn btn-tactical btn-block mt-4">COMMIT_OFFICER_DATA</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Image Preview Logic
        function previewFile(event) {
            const preview = document.getElementById('image_preview');
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        }

        // Real-time Service Number Availability Check
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
                                $("#availability-status").html('<span class="text-danger">✖ Service Number already exists</span>');
                                $("#submitBtn").prop("disabled", true);
                            } else {
                                $("#availability-status").html('<span class="text-success">✔ Service Number available</span>');
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