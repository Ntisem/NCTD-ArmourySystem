<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login.php");
    exit();
}

$stmt = $pdo->prepare("SELECT adminID, fullname, service_no, rank FROM admin_lists WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$admin = $stmt->fetch();

// 1. Handle Officer Update
if (isset($_POST['update_officer'])) {
    $officerID            = (int)$_POST['edit_officerID'];
    $officer_service_no = trim($_POST['edit_officer_service_no']);
    $rank               = trim($_POST['edit_rank']);
    $full_name          = trim($_POST['edit_full_name']);
    $gender             = trim($_POST['edit_gender']);
    $dept_unit          = trim($_POST['edit_dept_unit']);
    $phone              = trim($_POST['edit_phone']);
    $email              = trim($_POST['edit_email']);
    $current_image      = $_POST['edit_current_image'];

    $officer_image = $current_image;

    if (isset($_FILES['officer_image']) && $_FILES['officer_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath   = $_FILES['officer_image']['tmp_name'];
        $fileName      = $_FILES['officer_image']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = 'uploads/';
            
            if(!is_dir($uploadFileDir)){
                mkdir($uploadFileDir, 0755, true);
            }
            
            $dest_path = $uploadFileDir . $newFileName;
            if(move_uploaded_file($fileTmpPath, $dest_path)) {
                $officer_image = $newFileName;
            }
        }
    }

    try {
        $pdo->beginTransaction();
        
        $sql = "UPDATE officers SET 
                    officer_service_no = ?, 
                    rank = ?, 
                    full_name = ?, 
                    gender = ?, 
                    dept_unit = ?, 
                    phone = ?, 
                    email = ?, 
                    officer_image = ? 
                WHERE officerID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$officer_service_no, $rank, $full_name, $gender, $dept_unit, $phone, $email, $officer_image, $officerID]);

        // Audit Trail
        $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
        $log_action = "UPDATED_OFFICER_RECORD: ID " . $officerID . " (" . $full_name . ")";
        $log->execute([$admin['adminID'], $_SESSION['fullname'], $log_action, $_SESSION['user_role']]);

        $pdo->commit();
        header("Location: officers-list.php?status=success");
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        header("Location: officers-list.php?status=error");
        exit();
    }
}

// 2. Handle Officer Deletion
if (isset($_POST['delete_officer'])) {
    $id = $_POST['delete_id'];
    
    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("DELETE FROM officers WHERE officerID = ?");
        $stmt->execute([$id]);

        $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
        $log_action = "DELETED_OFFICER_RECORD: ID " . $id;
        $log->execute([$admin['adminID'], $_SESSION['fullname'], $log_action, $_SESSION['user_role']]);

        $pdo->commit();
        header("Location: officers-list.php?status=success");
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        header("Location: officers-list.php?status=error");
        exit();
    }
}

// 3. Handle AJAX View Request
if (isset($_GET['view_id'])) {
    $id = (int)$_GET['view_id'];
    $stmt = $pdo->prepare("SELECT * FROM officers WHERE officerID = ?");
    $stmt->execute([$id]);
    $off = $stmt->fetch();
    
    if ($off) {
        echo '<div class="row text-light">';
        echo '<div class="col-md-4 text-center">';
        echo '<img src="uploads/' . htmlspecialchars($off['officer_image']) . '" alt="Officer Image" style="width: 150px; height: 150px; border-radius: 50%; object-fit: cover;" class="mb-3 img-thumbnail border-info">';
        echo '</div>';
        echo '<div class="col-md-8">';
        echo '<p><strong>Service No:</strong> ' . htmlspecialchars($off['officer_service_no']) . '</p>';
        echo '<p><strong>Rank:</strong> ' . htmlspecialchars($off['rank']) . '</p>';
        echo '<p><strong>Full Name:</strong> ' . htmlspecialchars($off['full_name']) . '</p>';
        echo '<p><strong>Gender:</strong> ' . htmlspecialchars($off['gender']) . '</p>';
        echo '<p><strong>Department/Unit:</strong> ' . htmlspecialchars($off['dept_unit']) . '</p>';
        echo '<p><strong>Phone:</strong> ' . htmlspecialchars($off['phone']) . '</p>';
        echo '<p><strong>Email:</strong> ' . htmlspecialchars($off['email']) . '</p>';
        echo '<p><strong>Registered On:</strong> ' . htmlspecialchars($off['created_at']) . '</p>';
        echo '</div>';
        echo '</div>';
    } else {
        echo '<p class="text-danger text-center">Officer not found.</p>';
    }
    exit();
}

// 4. Search and Fetch
$startDate = $_GET['start_date'] ?? null;
$endDate = $_GET['end_date'] ?? null;

$query = "SELECT * FROM officers";
$params = [];

if (!empty($startDate) && !empty($endDate)) {
    $query .= " WHERE DATE(created_at) BETWEEN ? AND ?";
    $params = [$startDate, $endDate];
}
$query .= " ORDER BY officerID DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$officers = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>COMMAND_TERMINAL | OFFICERS_DIRECTORY</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

    <style>
        :root { 
            --neon: #00f2ff; 
            --bg-deep: #020408; 
            --card-bg: #0a0d12; 
            --input-border: #00f2ff; 
            --danger: #ff3333; 
            --success: #00ff66;
            --text-main: #e0e0e0;
        }
        body { 
            background: var(--bg-deep); 
            font-family: 'JetBrains Mono', monospace; 
            color: var(--text-main); 
        }
        
        .tactical-table tbody tr:hover {
            background: rgba(0, 242, 255, 0.05);
        }
        
        .navbar, .sidebar {
            background: var(--card-bg) !important;
            border-bottom: 1px solid rgba(0, 242, 255, 0.2);
        }
        .main-panel {
            background: var(--bg-deep);
            color: #fff;
        }
        .card { 
            background: var(--card-bg); 
            border: 1px solid rgba(0, 242, 255, 0.2); 
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.05); 
            border-radius: 6px; 
            color: #e0e0e0;
        }
        .tactical-card {
            background: var(--card-bg);
            border: 1px solid var(--neon);
            border-radius: 4px;
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.1);
            color: var(--text-main);
        }
        .card-body {
            background: var(--card-bg);
        }
        .btn-tactical {
            background: transparent;
            border: 1px solid var(--neon);
            color: var(--neon);
            font-family: 'JetBrains Mono', monospace;
            transition: all 0.3s ease;
        }
        .btn-tactical:hover {
            background: var(--neon);
            color: var(--bg-deep);
            box-shadow: 0 0 15px var(--neon);
        }
        .btn-danger-tactical {
            background: transparent;
            border: 1px solid var(--danger);
            color: var(--danger);
            font-family: 'JetBrains Mono', monospace;
            transition: all 0.3s ease;
        }
        .btn-danger-tactical:hover {
            background: var(--danger);
            color: #fff;
            box-shadow: 0 0 15px var(--danger);
        }
        .table {
            color: #e0e0e0;
        }
        .table th {
            border-color: rgba(0, 242, 255, 0.1);
            color: var(--neon);
        }
        .table td {
            border-color: rgba(0, 242, 255, 0.05);
        }
        .form-control {
            background: var(--dark-gray) !important;
            border: 1px solid rgba(0, 242, 255, 0.2) !important;
            color: #e0e0e0 !important;
            font-family: 'JetBrains Mono', monospace;
        }
        .form-control:focus {
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.3);
            border-color: var(--neon) !important;
        }
        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 9999;
        }
        .tactical-table {
            color: var(--text-main) !important;
        }
        .tactical-table th, .tactical-table td {
            border-color: rgba(0, 242, 255, 0.2) !important;
        }
        .t-toast {
            background: var(--card-bg);
            border: 1px solid rgba(0, 242, 255, 0.2);
            border-left: 5px solid var(--neon);
            color: #e0e0e0;
            padding: 15px;
            margin-bottom: 10px;
            border-radius: 4px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.5);
            font-family: 'JetBrains Mono', monospace;
            font-size: 13px;
            display: none;
        }
        .dataTables_wrapper .dataTables_filter input {
            background: var(--dark-gray) !important;
            border: 1px solid var(--neon) !important;
            color: #e0e0e0 !important;
        }
        .dataTables_wrapper .dataTables_length select {
            background: var(--dark-gray) !important;
            border: 1px solid var(--neon) !important;
            color: #e0e0e0 !important;
        }
    </style>
</head>
<body>
    <div id="toast-container"></div>
    <div class="container-scroller">
        <div class="main-panel p-4" style="width: 100%;">

            <div class="card mb-4" style="margin-bottom:-100px">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 text-light">
                        <i class="mdi mdi-account-group text-info mr-2"></i>OFFICERS_DIRECTORY
                    </h4>
                    <div>
                        <a href="add-officer.php" class="btn btn-tactical">
                            <i class="mdi mdi-account-plus mr-1"></i>ADD_OFFICER
                        </a>
                        <a href="javascript:history.back()" class="btn btn-tactical ml-2">
                            <i class="mdi mdi-arrow-left mr-1"></i>BACK
                        </a>
                    </div>
                </div>
                    
                <form method="GET" action="" class="form-inline p-3">
                    <label class="mr-2" style="color: var(--neon);">Start Date:</label>
                    <input type="date" name="start_date" class="form-control mb-2 mr-sm-2" value="<?php echo htmlspecialchars($startDate ?? ''); ?>">
                    
                    <label class="mr-2" style="color: var(--neon);">End Date:</label>
                    <input type="date" name="end_date" class="form-control mb-2 mr-sm-2" value="<?php echo htmlspecialchars($endDate ?? ''); ?>">

                    <button type="submit" class="btn btn-tactical mb-2 mr-2">
                        <i class="mdi mdi-magnify"></i> FILTER
                    </button>
                    <a href="officers-list.php" class="btn btn-danger-tactical mb-2">
                        <i class="mdi mdi-refresh"></i> RESET
                    </a>
                </form>
            </div>

            <div class="card mt-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="mainTable" class="table table-hover table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Image</th>
                                    <th>Service No</th>
                                    <th>Rank</th>
                                    <th>Full Name</th>
                                    <th>Gender</th>
                                    <th>Dept/Unit</th>
                                    <th>Phone</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $cnt = 1; foreach ($officers as $off): ?>
                                    <tr>
                                        <td><?php echo $cnt++; ?></td>
                                        <td>
                                            <img src="uploads/<?php echo htmlspecialchars($off['officer_image']); ?>" alt="Officer" style="width: 40px; height: 40px; border-radius: 50%; object-fit: cover;">
                                        </td>
                                        <td><?php echo htmlspecialchars($off['officer_service_no']); ?></td>
                                        <td><?php echo htmlspecialchars($off['rank']); ?></td>
                                        <td><?php echo htmlspecialchars($off['full_name']); ?></td>
                                        <td><?php echo htmlspecialchars($off['gender']); ?></td>
                                        <td><?php echo htmlspecialchars($off['dept_unit']); ?></td>
                                        <td><?php echo htmlspecialchars($off['phone']); ?></td>
                                        <td><?php echo htmlspecialchars($off['email']); ?></td>
                                        <td>
                                            <button class="btn btn-sm btn-tactical my-1" onclick="viewDetails(<?php echo $off['officerID']; ?>)">
                                                <i class="mdi mdi-eye"></i> View
                                            </button>
                                            <button class="btn btn-sm btn-tactical my-1" onclick='openEditModal(<?php echo json_encode($off); ?>)'>
                                                <i class="mdi mdi-pencil"></i> Edit
                                            </button>
                                            <button class="btn btn-sm btn-danger-tactical my-1" onclick="confirmDelete(<?php echo $off['officerID']; ?>)">
                                                <i class="mdi mdi-delete"></i> Delete
                                            </button>
                                            <a href="officer-details.php?officerID=<?php echo $off['officerID']; ?>" class="btn btn-sm btn-tactical my-1">
                                                <i class="mdi mdi-format-list-bulleted"></i> Track
                                            </a>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content" style="background: var(--card-bg); border: 1px solid var(--neon);">
                <div class="modal-header border-bottom-0">
                    <h5 class="modal-title" style="color: var(--neon);"><i class="mdi mdi-account-card-details"></i> OFFICER DETAILS</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="viewModalBody" style="background: var(--card-bg);">
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: var(--card-bg); border: 1px solid var(--neon);">
                <form action="officers-list.php" method="POST" enctype="multipart/form-data">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title" style="color: var(--neon);"><i class="mdi mdi-account-edit"></i> EDIT OFFICER</h5>
                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="edit_officerID" id="edit_officerID">
                        <input type="hidden" name="edit_current_image" id="edit_current_image">

                        <div class="form-group text-center">
                            <img id="image_preview" src="" alt="Officer Image" style="width: 120px; height: 120px; border-radius: 50%; object-fit: cover;" class="mb-3 border-info">
                            <br>
                            <label style="color: var(--neon);">Update Profile Picture</label>
                            <input type="file" name="officer_image" class="form-control" onchange="previewImage(event)">
                        </div>

                        <div class="form-group">
                            <label>Service No</label>
                            <input type="text" name="edit_officer_service_no" id="edit_officer_service_no" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Rank</label>
                            <input type="text" name="edit_rank" id="edit_rank" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input type="text" name="edit_full_name" id="edit_full_name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Gender</label>
                            <select name="edit_gender" id="edit_gender" class="form-control" required>
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Dept/Unit</label>
                            <input type="text" name="edit_dept_unit" id="edit_dept_unit" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            <input type="text" name="edit_phone" id="edit_phone" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="edit_email" id="edit_email" class="form-control" required>
                        </div>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-danger-tactical" data-dismiss="modal">CANCEL</button>
                        <button type="submit" name="update_officer" class="btn btn-tactical">COMMIT_CHANGE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" style="background: var(--card-bg); border: 1px solid var(--danger);">
                <form action="officers-list.php" method="POST">
                    <div class="modal-header border-bottom-0">
                        <h5 class="modal-title text-danger"><i class="mdi mdi-alert-circle"></i> CONFIRM DELETE</h5>
                        <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-light">
                        <input type="hidden" name="delete_id" id="delete_id">
                        <p>Are you sure you want to delete this officer record?</p>
                    </div>
                    <div class="modal-footer border-top-0">
                        <button type="button" class="btn btn-tactical" data-dismiss="modal">CANCEL</button>
                        <button type="submit" name="delete_officer" class="btn btn-danger-tactical">DELETE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            // Initialize DataTable
            $('#mainTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'excel', text: 'EXPORT_EXCEL', className: 'btn btn-tactical mx-1' },
                    { extend: 'pdf', text: 'EXPORT_PDF', className: 'btn btn-tactical mx-1' },
                    { extend: 'print', text: 'PRINT', className: 'btn btn-tactical mx-1' }
                ],
                responsive: true
            });

            // Toast Alerts
            const params = new URLSearchParams(window.location.search);
            if (params.has('status')) {
                let status = params.get('status');
                let toastHtml = '';
                
                if (status === 'success') {
                    toastHtml = '<div class="t-toast" style="display:block; border-left: 5px solid var(--neon);">[SIGNAL]: TRANSACTION_SUCCESSFUL</div>';
                } else {
                    toastHtml = '<div class="t-toast" style="display:block; border-left: 5px solid var(--danger);">[SIGNAL]: TRANSACTION_FAILED</div>';
                }
                
                $(toastHtml).appendTo('#toast-container').fadeIn().delay(3500).fadeOut(function() {
                    $(this).remove();
                });
            }
        });

        function viewDetails(id) {
            $('#viewModalBody').html('<div class="text-center p-5"><i class="mdi mdi-loading mdi-spin" style="font-size:35px; color:var(--neon);"></i> Loading Details...</div>');
            $.get('officers-list.php?view_id=' + id, function(data) {
                $('#viewModalBody').html(data);
            }).fail(function() {
                $('#viewModalBody').html('<p class="text-danger text-center">Error loading data.</p>');
            });
            $('#viewModal').modal('show');
        }

        function openEditModal(off) {
            $('#edit_officerID').val(off.officerID);
            $('#edit_officer_service_no').val(off.officer_service_no);
            $('#edit_rank').val(off.rank);
            $('#edit_full_name').val(off.full_name);
            $('#edit_gender').val(off.gender);
            $('#edit_dept_unit').val(off.dept_unit);
            $('#edit_phone').val(off.phone);
            $('#edit_email').val(off.email);
            $('#edit_current_image').val(off.officer_image);

            $('#image_preview').attr('src', 'uploads/' + off.officer_image);
            $('#editModal').modal('show');
        }

        function confirmDelete(id) {
            $('#delete_id').val(id);
            $('#deleteModal').modal('show');
        }

        function previewImage(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('image_preview');
                output.src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>
</body>
</html>