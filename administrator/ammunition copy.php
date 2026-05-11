<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'administrator') {
    header("location: login");
    exit();
}

$username = $_SESSION['username']; 
$user_stmt = $pdo->prepare("SELECT adminID, fullname, service_no, rank FROM admin_lists WHERE username = ?");
$user_stmt->execute([$username]);
$admin_data = $user_stmt->fetch();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>HQ COMMAND | AMMO_INVENTORY</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root { --neon-cyan: #00f2ff; --panel-dark: #05070a; --neon-red: #ff4b2b; }
        body { background-color: var(--panel-dark); font-family: 'JetBrains Mono', monospace; color: #e0e0e0; }
        .table-tactical { background: rgba(13, 17, 23, 0.8); border: 1px solid rgba(0, 242, 255, 0.1); }
        .btn-tactical { border: 1px solid rgba(0, 242, 255, 0.3); text-transform: uppercase; font-size: 0.7rem; color: var(--neon-cyan); }
        .t-toast { position: fixed; top: 20px; right: 20px; padding: 15px 25px; z-index: 9999; display: none; border-left: 4px solid; background: #05070a; clip-path: polygon(0 0, 100% 0, 100% 70%, 90% 100%, 0 100%); }
        .t-success { color: var(--neon-cyan); border-color: var(--neon-cyan); }
        .t-error { color: var(--neon-red); border-color: var(--neon-red); }
        /* Tactical Export Buttons Style */
        .dt-buttons .btn-tactical-export {
            background: rgba(0, 242, 255, 0.05) !important;
            border: 1px solid rgba(0, 242, 255, 0.4) !important;
            color: #00f2ff !important;
            font-family: 'JetBrains Mono', monospace;
            font-size: 0.75rem !important;
            letter-spacing: 1px;
            padding: 5px 15px !important;
            transition: all 0.3s ease;
            margin-right: 5px;
            clip-path: polygon(10% 0, 100% 0, 100% 70%, 90% 100%, 0 100%, 0 30%);
        }

        .dt-buttons .btn-tactical-export:hover {
            background: rgba(0, 242, 255, 0.2) !important;
            border-color: #00f2ff !important;
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.4);
            transform: translateY(-1px);
        }
    </style>
</head>
<body>
    <div id="toast-container"></div>

    <div class="container-scroller">
        <?php include_once('includes/sidebar.php');?>
        <div class="container-fluid page-body-wrapper">
            <?php include_once('includes/navbar.php');?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header d-flex justify-content-between">
                        <h3 class="page-title text-info"><i class="mdi mdi-bullet"></i> AMMUNITION_REGISTRY</h3>
                        <a href="add-new-ammo.php" class="btn btn-tactical"><i class="mdi mdi-plus"></i> NEW_ENTRY</a>
                    </div>

                    <div class="card table-tactical">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="ammo_table" class="table table-dark table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>AMMO_NAME</th>
                                            <th>MANUFACTURER</th>
                                            <th>ROUNDS</th>
                                            <th>APPLICATION</th>
                                            <th>STATUS</th>
                                            <th>OPERATIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // CRITICAL FIX: Added 'WHERE is_deleted = 0'
                                        $sql = "SELECT * FROM ammunitions WHERE is_deleted = 0 ORDER BY ammoID DESC";
                                        $stmt = $pdo->query($sql);
                                        $i = 1;
                                        while($row = $stmt->fetch()):
                                            $jsData = htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8');
                                        ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= htmlspecialchars($row['ammo_name']) ?></td>
                                            <td><?= htmlspecialchars($row['manufacturer']) ?></td>
                                            <td class="text-warning"><?= number_format($row['ammo_rounds']) ?></td>
                                            <td><?= htmlspecialchars($row['ammo_application']) ?></td>
                                            <td><span class="badge btn-outline-info"><?= $row['booking_status'] ?></span></td>
                                            <td>
                                                <button class="btn btn-xs btn-outline-success" onclick='viewDetails(<?= $jsData ?>)' title="View"><i class="mdi mdi-eye"></i></button>
                                                <button class="btn btn-xs btn-outline-info" onclick='openEditModal(<?= $jsData ?>)' title="Edit"><i class="mdi mdi-pencil"></i></button>
                                                
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="viewModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content bg-dark border-success text-white">
                <div class="modal-header border-success">
                    <h5 class="modal-title">ASSET_DETAILS_DECRYPTED</h5>
                </div>
                <div id="view_content" class="modal-body">
                    </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editAmmoModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark border-info text-white">
                <form action="process-ammo-update.php" method="POST">
                    <div class="modal-header border-info">
                        <h5 class="modal-title">MOD_AMMO_DATA</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="ammo_id" id="edit_ammo_id">
                        <div class="row">
                            <div class="col-md-6 mb-3"><label>AMMO_NAME</label><input type="text" name="ammo_name" id="edit_ammo_name" class="form-control bg-dark text-white"></div>
                            <div class="col-md-6 mb-3"><label>MANUFACTURER</label><input type="text" name="manufacturer" id="edit_manufacturer" class="form-control bg-dark text-white"></div>
                            <div class="col-md-4 mb-3"><label>ROUNDS</label><input type="number" name="ammo_rounds" id="edit_rounds" class="form-control bg-dark text-white"></div>
                            <div class="col-md-4 mb-3"><label>APPLICATION</label><input type="text" name="ammo_application" id="edit_application" class="form-control bg-dark text-white"></div>
                            <div class="col-md-4 mb-3">
                                <label>STATUS</label>
                                <select name="booking_status" id="edit_booking" class="form-control bg-dark text-white">
                                    <option value="Available">Available</option>
                                    <option value="Reserved">Reserved</option>
                                </select>
                            </div>
                            <div class="col-md-12"><label>REMARKS</label><textarea name="remarks" id="edit_remarks" class="form-control bg-dark text-white" rows="3"></textarea></div>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" name="update_ammo" class="btn btn-info w-100">COMMIT_CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content bg-dark border-danger text-white">
                <form action="process-ammo-delete.php" method="POST">
                    <div class="modal-header border-danger">
                        <h5 class="modal-title">CONFIRM_DELETION</h5>
                    </div>
                    <div class="modal-body text-center">
                        <i class="mdi mdi-alert-octagon text-danger" style="font-size: 3rem;"></i>
                        <p>ARE YOU SURE YOU WANT TO ARCHIVE <br><b id="del_name" class="text-danger h4"></b>?</p>
                        <input type="hidden" name="delete_id" id="del_id">
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" name="confirm_delete" class="btn btn-danger w-100">EXECUTE_ARCHIVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
 </div>
 </div>
<?php require_once('includes/footer.php'); ?>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
       $(document).ready(function() {
    $('#ammo_table').DataTable({
        dom: 'Bfrtip',
        buttons: [
            { 
                extend: 'excel', 
                text: '<i class="mdi mdi-file-excel"></i> EXCEL_EXPORT', 
                className: 'btn-tactical-export' 
            },
            { 
                extend: 'pdf', 
                text: '<i class="mdi mdi-file-pdf"></i> PDF_GENERATE', 
                className: 'btn-tactical-export' 
            },
            { 
                extend: 'print', 
                text: '<i class="mdi mdi-printer"></i> PRINT_HARDCOPY', 
                className: 'btn-tactical-export' 
            }
        ],
        "language": { 
            "search": "[SCANNING_DATABASE]:",
            "searchPlaceholder": "ENTER_CRITERIA..."
        },
        "responsive": true
    });

    // Toast logic remains the same...
    const urlParams = new URLSearchParams(window.location.search);
    if(urlParams.has('status')) {
        const isSuccess = urlParams.get('status') === 'success';
        const msg = isSuccess ? 'OPERATION_COMPLETE' : 'CRITICAL_ERROR: ' + (urlParams.get('msg') || '');
        showToast(msg, isSuccess ? 't-success' : 't-error');
    }
});
        function showToast(msg, css) {
            const t = $(`<div class="t-toast ${css}">[SIGNAL]: ${msg}</div>`);
            $('#toast-container').append(t);
            t.fadeIn().delay(4000).fadeOut();
        }

        function viewDetails(data) {
            let html = `
                <table class="table table-sm text-white">
                    <tr><td>ID:</td><td class="text-info">${data.ammoID}</td></tr>
                    <tr><td>NAME:</td><td class="text-info">${data.ammo_name}</td></tr>
                    <tr><td>ROUNDS:</td><td class="text-warning">${data.ammo_rounds}</td></tr>
                    <tr><td>APPLICATION:</td><td>${data.ammo_application}</td></tr>
                    <tr><td>REGISTRAR:</td><td>${data.administrator_admin_name}</td></tr>
                    <tr><td>REMARKS:</td><td>${data.remarks || 'N/A'}</td></tr>
                </table>`;
            $('#view_content').html(html);
            $('#viewModal').modal('show');
        }

        function openEditModal(data) {
            $('#edit_ammo_id').val(data.ammoID);
            $('#edit_ammo_name').val(data.ammo_name);
            $('#edit_manufacturer').val(data.manufacturer);
            $('#edit_rounds').val(data.ammo_rounds);
            $('#edit_application').val(data.ammo_application);
            $('#edit_booking').val(data.booking_status);
            $('#edit_remarks').val(data.remarks || '');
            $('#editAmmoModal').modal('show');
        }

        function openDeleteModal(id, name) {
            $('#del_id').val(id);
            $('#del_name').text(name);
            $('#deleteModal').modal('show');
        }
    </script>
</body>
</html>