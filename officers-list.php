<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

$stmt = $pdo->prepare("SELECT adminID, fullname, service_no, rank FROM admin_lists WHERE username = ?");
$stmt->execute([$_SESSION['username']]);
$admin = $stmt->fetch();

// --- DATABASE LOGIC ---
$officer_rank = $_GET['Rank'] ?? null;
$startDate = $_GET['start_date'] ?? null;
$endDate = $_GET['end_date'] ?? null;

// Base query: All logic now defaults to 'Active In Service'
$query = "SELECT * FROM officers WHERE officer_status = 'Active In Service'";
$params = [];

// Apply Rank Filter (if not 'all' or empty)
if (!empty($officer_rank) && $officer_rank !== 'all') {
    $query .= " AND `rank` = ?";
    $params[] = $officer_rank;
}

// Apply Date Range Filter with logical validation
if (!empty($startDate) && !empty($endDate)) {
    if (strtotime($startDate) <= strtotime($endDate)) {
        $query .= " AND DATE(created_at) BETWEEN ? AND ?";
        $params[] = $startDate;
        $params[] = $endDate;
    }
}

$query .= " ORDER BY officer_service_no ASC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$officers = $stmt->fetchAll();

// 1. Handle Officer Update
if (isset($_POST['update_officer'])) {
    $officerID          = (int)$_POST['edit_officerID'];
    $officer_status     = trim($_POST['edit_officer_status']);
    $officer_service_no = trim($_POST['edit_officer_service_no']);
    $rank               = trim($_POST['edit_rank']);
    $full_name          = trim($_POST['edit_full_name']);
    $gender             = trim($_POST['edit_gender']);
    $dept_unit          = trim($_POST['edit_dept_unit']);
    $phone_no              = trim($_POST['edit_phone_no']);
    $officer_email              = trim($_POST['edit_officer_email']);
    $current_image      = $_POST['edit_current_image'];
    $officer_image = $current_image;

    if (isset($_FILES['officer_image']) && $_FILES['officer_image']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath   = $_FILES['officer_image']['tmp_name'];
        $fileName      = $_FILES['officer_image']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
            $uploadFileDir = 'assets/images/officer_images/';
            if(!is_dir($uploadFileDir)) mkdir($uploadFileDir, 0755, true);
            
            if(move_uploaded_file($fileTmpPath, $uploadFileDir . $newFileName)) {
                $officer_image = $newFileName;
            }
        }
    }

    try {
        $pdo->beginTransaction();
        $sql = "UPDATE officers SET officer_status = ?, officer_service_no = ?, rank = ?, full_name = ?, gender = ?, dept_unit = ?, phone_no = ?, officer_email = ?, officer_image = ? WHERE officerID = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$officer_status, $officer_service_no, $rank, $full_name, $gender, $dept_unit, $phone_no, $officer_email, $officer_image, $officerID]);

        $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
        $log_action = "UPDATED_OFFICER: " . $full_name . " (SN: " . $officer_service_no . ")";
        $log->execute([$admin['adminID'], $admin['fullname'], $log_action, $_SESSION['user_role']]);

        $pdo->commit();
        header("Location: officers-list?status=success");
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        header("Location: officers-list?status=error");
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
        $log->execute([$admin['adminID'], $admin['fullname'], "DELETED_OFFICER_ID_" . $id, $_SESSION['user_role']]);

        $pdo->commit();
        header("Location: officers-list?status=success");
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        header("Location: officers-list?status=error");
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
        echo '<div class="row text-light"><div class="col-md-4 text-center">';
        echo '<img src="assets/images/officer_images/'. htmlspecialchars($off['officer_image']) . '" style="width: 150px; height: 150px; border-radius: 5px; border: 2px solid var(--neon); object-fit: cover;" class="mb-3">';
        echo '</div><div class="col-md-8">';
        echo '<p><strong>Service No:</strong> ' . htmlspecialchars($off['officer_service_no']) . '</p>';
        echo '<p><strong>Rank:</strong> ' . htmlspecialchars($off['rank']) . '</p>';
        echo '<p><strong>Full Name:</strong> ' . htmlspecialchars($off['full_name']) . '</p>';
        echo '<p><strong>Status:</strong> ' . htmlspecialchars($off['officer_status']) . '</p>';
        echo '<p><strong>Dept/Unit:</strong> ' . htmlspecialchars($off['dept_unit']) . '</p>';
        echo '<p><strong>Phone:</strong> ' . htmlspecialchars($off['phone_no']) . '</p>';
        echo '</div></div>';
    }
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>NCTD ARMOURY SYSTEM | OFFICERS_DIRECTORY</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root { --neon: #00f2ff; --bg-deep: #020408; --card-bg: #0a0d12; --danger: #ff3333; --text-main: #e0e0e0; }
        body { background: var(--bg-deep); font-family: 'JetBrains Mono', monospace; color: var(--text-main); }
        
        .card { background: var(--card-bg); border: 1px solid rgba(0, 242, 255, 0.2); border-radius: 4px; }
        .btn-tactical { background: transparent; border: 1px solid var(--neon); color: var(--neon); font-size: 12px; transition: 0.3s; }
        .btn-tactical:hover { background: var(--neon); color: var(--bg-deep); box-shadow: 0 0 10px var(--neon); }
        .btn-danger-tactical { background: transparent; border: 1px solid var(--danger); color: var(--danger); font-size: 12px; transition: 0.3s; }
        .btn-danger-tactical:hover { background: var(--danger); color: #fff; box-shadow: 0 0 10px var(--danger); }
        
        /* Landscape Dropdown Styling */
        .landscape-dropdown-menu {
            width: 90vw !important; max-width: 1100px;
            background: #06090e !important; border: 1px solid var(--neon) !important;
            padding: 20px !important; left: 50% !important; transform: translateX(-50%) !important;
            box-shadow: 0 0 30px rgba(0, 242, 255, 0.2);

            /* Centering Logic */
            position: fixed !important; /* Forces it to center relative to the viewport */
            top: 150px;                 /* Adjust this based on your header height */
            left: 50% !important;
            transform: translateX(-50%) !important;
            
            /* Sizing */
            width: 90vw !important;
            max-width: 1100px !important;
            z-index: 1050 !important;
            box-shadow: 0 0 30px rgba(0, 242, 255, 0.2);
        }
        .tactical-grid {
            display: grid; grid-template-columns: repeat(auto-fit, minmax(120px, 1fr)); gap: 10px;
        }
        .tactical-grid .dropdown-item {
            border: 1px solid rgba(0, 242, 255, 0.2); color: var(--text-main) !important;
            text-align: center; padding: 12px 5px; font-weight: bold; font-size: 11px;
        }
        .tactical-grid .dropdown-item:hover { background: var(--neon) !important; color: #000 !important; }

        .table { color: var(--text-main); }
        .table thead th { border-bottom: 2px solid var(--neon); color: var(--neon); text-transform: uppercase; font-size: 11px; }
        .form-control { background: #111 !important; border: 1px solid rgba(0, 242, 255, 0.3) !important; color: #fff !important; }
        
        #toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; }
        .t-toast { background: var(--card-bg); border-left: 5px solid var(--neon); padding: 15px; margin-bottom: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.5); }
    </style>
</head>
<body>
    <div id="toast-container"></div>
    <div class="container-fluid p-4">
        
        <div class="card mb-4">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h4 class="m-0"><i class="mdi mdi-shield-account text-info"></i> OFFICERS_DIRECTORY 
                    <?php if($officer_rank): ?> <span class="badge badge-outline-info ml-2">[<?php echo $officer_rank; ?>]</span><?php endif; ?>
                </h4>
                <div class="d-flex">
                    <a href="add-officer" class="btn btn-tactical mr-2"><i class="mdi mdi-plus"></i> ADD_NEW_OFFICER</a>
                    
                    <div class="dropdown">
                        <button class="btn btn-tactical dropdown-toggle" type="button" data-toggle="dropdown">
                            <<< SELECT_RANK_FILTER >>>
                        </button>
                        <div class="dropdown-menu dropdown-menu-right landscape-dropdown-menu">
                            <h6 class="dropdown-header text-info mb-3">[ PERSONNEL_RANK_LEVELS ]</h6>
                            <div class="tactical-grid">
                                <a href="officers-list?all" class="dropdown-item">ALL_OFFICERS</a>
                                <a href="officers-list?Rank=CONST" class="dropdown-item">CONSTABLE</a>
                                <a href="officers-list?Rank=L/CPL" class="dropdown-item">L/CORPORAL</a>
                                <a href="officers-list?Rank=CPL" class="dropdown-item">CORPORAL</a>
                                <a href="officers-list?Rank=SGT" class="dropdown-item">SERGEANT</a>
                                <a href="officers-list?Rank=INSPR" class="dropdown-item">INSPECTOR</a>
                                <a href="officers-list?Rank=CHIEF INSPR" class="dropdown-item">CHIEF INSPR</a>
                                <a href="officers-list?Rank=ASP" class="dropdown-item">ASP</a>
                                <a href="officers-list?Rank=DSP" class="dropdown-item">DSP</a>
                                <a href="officers-list?Rank=SUPT" class="dropdown-item">SUPT</a>
                                <a href="officers-list?Rank=C/SUPT" class="dropdown-item">C/SUPT</a>
                                <a href="officers-list?Rank=ACP" class="dropdown-item">ACP</a>
                                <a href="officers-list?Rank=DCOP" class="dropdown-item">DCOP</a>
                                <a href="officers-list?Rank=COP" class="dropdown-item">COP</a>
                              
                            </div>
                        </div>
                    </div>
                    <a href="officers-list.php" class="btn btn-danger-tactical ml-2"><i class="mdi mdi-refresh"></i> RESET</a>
                      <a href="armourer" class="btn btn-tactical ml-2">
                        <i class="mdi mdi-arrow-left mr-1"></i>BACK
                    </a>
                </div>
            </div>
            
            <form method="GET" class="form-inline p-3 border-top border-secondary">
                <input type="hidden" name="Rank" value="<?php echo htmlspecialchars($officer_rank ?? ''); ?>">
                <label class="mx-2 text-info">DATE_START:</label>
                <input type="date" name="start_date" class="form-control form-control-sm" value="<?php echo $startDate; ?>">
                <label class="mx-2 text-info">DATE_END:</label>
                <input type="date" name="end_date" class="form-control form-control-sm" value="<?php echo $endDate; ?>">
                <button type="submit" class="btn btn-tactical btn-sm ml-3">EXECUTE_SEARCH</button>
            </form>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="officerTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>IMG</th>
                                <th>SERVICE_NO</th>
                                <th>RANK</th>
                                <th>FULL_NAME</th>
                                <th>DEPT/UNIT</th>
                                <th>STATUS</th>
                                <th>ACTION_PROTOCOLS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $n=1; foreach($officers as $row): ?>
                            <tr>
                                <td><?php echo $n++; ?></td>
                                <td><img src="assets/images/officer_images/<?php echo $row['officer_image']; ?>" style="width:35px; height:35px; border-radius:3px; border:1px solid var(--neon);"></td>
                                <td class="text-info font-weight-bold"><?php echo $row['officer_service_no']; ?></td>
                                <td><?php echo $row['rank']; ?></td>
                                <td><?php echo $row['full_name']; ?></td>
                                <td><?php echo $row['dept_unit']; ?></td>
                               <td>
                                    <?php 
                                    switch ($row['officer_status']) {
                                        case 'Active In Service':
                                            echo '<span class="badge badge-primary">Active In Service</span>';
                                            break;
                                        case 'Transferred':
                                            echo '<span class="badge badge-danger">Transferred</span>';
                                            break;
                                        default:
                                            echo '<span class="badge badge-secondary">Retired</span>';
                                            break;
                                    }
                                    ?>
                                </td>
                                <td>
                                    <button class="btn btn-tactical btn-sm" onclick="viewDetails(<?php echo $row['officerID']; ?>)"><i class="mdi mdi-eye"></i></button>
                                    <button class="btn btn-tactical btn-sm" onclick='openEditModal(<?php echo json_encode($row); ?>)'><i class="mdi mdi-pencil"></i></button>
                                    <a href="officer-details?officerID=<?php echo $row['officerID']; ?>" class="btn btn-tactical btn-sm"><i class="mdi mdi-radar"></i></a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewModal" tabindex="-1"><div class="modal-dialog modal-lg"><div class="modal-content bg-dark border-info"><div class="modal-body" id="viewModalBody"></div></div></div></div>

    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="" method="POST" enctype="multipart/form-data" class="modal-content bg-dark border-info">
                <div class="modal-header border-info"><h5 class="modal-title text-info">EDIT_OFFICER_RECORD</h5></div>
                <div class="modal-body">
                    <input type="hidden" name="edit_officerID" id="edit_officerID">
                    <input type="hidden" name="edit_current_image" id="edit_current_image">
                    <div class="form-group"><label>STATUS</label>
                        <select name="edit_officer_status" id="edit_officer_status" class="form-control">
                            <option value="Transferred">Transferred</option>
                            <option value="Active In Service">Active In Service</option>
                            <option value="Retired">Retired</option>
                        </select>
                    </div>
                    <div class="form-group"><label>SERVICE NO</label><input type="text" name="edit_officer_service_no" id="edit_officer_service_no" class="form-control"></div>
                    <div class="form-group"><label>RANK</label><input type="text" name="edit_rank" id="edit_rank" class="form-control" required></div>
                    <div class="form-group"><label>FULL NAME</label><input type="text" name="edit_full_name" id="edit_full_name" class="form-control" required></div>
                    <div class="form-group"><label>DEPT/UNIT</label><input type="text" name="edit_dept_unit" id="edit_dept_unit" class="form-control" required></div>
                    <div class="form-group"><label>GENDER</label>
                        <select name="edit_gender" id="edit_gender" class="form-control">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="form-group"><label>PHONE</label><input type="text" name="edit_phone_no" id="edit_phone_no" class="form-control"></div>
                    <div class="form-group"><label>officer_email</label><input type="officer_email" name="edit_officer_email" id="edit_officer_email" class="form-control"></div>
                    <div class="form-group"><label>UPDATE IMAGE</label><input type="file" name="officer_image" class="form-control"></div>
                </div>
                <div class="modal-footer border-info">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">ABORT</button>
                    <button type="submit" name="update_officer" class="btn btn-tactical">COMMIT_CHANGES</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="" method="POST" class="modal-content bg-dark border-danger">
                <div class="modal-body text-center p-4">
                    <i class="mdi mdi-alert-decagram text-danger" style="font-size: 50px;"></i>
                    <h4 class="text-light mt-3">CONFIRM_DELETION?</h4>
                    <p>This action will purge the officer record from the mainframe.</p>
                    <input type="hidden" name="delete_id" id="delete_id">
                    <button type="button" class="btn btn-tactical" data-dismiss="modal">CANCEL</button>
                    <button type="submit" name="delete_officer" class="btn btn-danger-tactical">PROCEED_DELETE</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
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
            $('#officerTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'excel', text: 'CSV', className: 'btn btn-tactical mx-1' },
                    { extend: 'pdf', text: 'PDF', className: 'btn btn-tactical mx-1' },
                    { extend: 'print', text: 'COPY', className: 'btn btn-tactical mx-1' }
                ],
                "order": [[ 2, "asc" ]] // Order by Service No
            });

            const params = new URLSearchParams(window.location.search);
            if (params.has('status')) {
                let msg = params.get('status') === 'success' ? '[SIGNAL]: OP_SUCCESSFUL' : '[SIGNAL]: OP_FAILED';
                $('<div class="t-toast">'+msg+'</div>').appendTo('#toast-container').fadeIn().delay(3000).fadeOut();
            }
        });

        function viewDetails(id) {
            $.get('officers-list.php?view_id=' + id, function(data) {
                $('#viewModalBody').html(data);
                $('#viewModal').modal('show');
            });
        }

        function openEditModal(off) {
            $('#edit_officerID').val(off.officerID);
            $('#edit_officer_service_no').val(off.officer_service_no);
            $('#edit_rank').val(off.rank);
            $('#edit_full_name').val(off.full_name);
            $('#edit_officer_status').val(off.officer_status);
            $('#edit_dept_unit').val(off.dept_unit);
            $('#edit_phone_no').val(off.phone_no);
            $('#edit_officer_email').val(off.officer_email);
            $('#edit_current_image').val(off.officer_image);
            $('#editModal').modal('show');
        }

        function confirmDelete(id) {
            $('#delete_id').val(id);
            $('#deleteModal').modal('show');
        }
    </script>
</body>
</html>