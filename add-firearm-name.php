<?php  
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

// Fetch Admin Details
$stmtAdmin = $pdo->prepare("SELECT adminID, fullname, service_no, rank FROM admin_lists WHERE username = ?");
$stmtAdmin->execute([$_SESSION['username']]);
$admin_data = $stmtAdmin->fetch();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HQ COMMAND | ASSET NOMENCLATURE</title>
    
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@300;500&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root { --neon: #00f2ff; --bg-deep: #05070a; --card-bg: #0d1117; --danger: #ff3e3e; --success: #00ff88; }
        body { background: var(--bg-deep); font-family: 'Roboto Mono', monospace; color: #c0c5ce; }
        .tactical-card { background: var(--card-bg) !important; border: 1px solid rgba(0, 242, 255, 0.2); border-radius: 0; box-shadow: 0 0 15px rgba(0,0,0,0.5); }
        .header-title { font-family: 'Orbitron'; color: var(--neon); letter-spacing: 2px; text-transform: uppercase; }
        
        .form-control { background: #000 !important; border: 1px solid #333 !important; color: var(--neon) !important; border-radius: 0; }
        .form-control:focus { border-color: var(--neon) !important; box-shadow: 0 0 5px var(--neon); }
        
        .btn-neon { border: 1px solid var(--neon); color: var(--neon); background: transparent; font-family: 'Orbitron'; font-size: 11px; transition: 0.3s; }
        .btn-neon:hover { background: var(--neon); color: #000; box-shadow: 0 0 15px var(--neon); }
        
        .table { background: #080a0d; border-collapse: separate; border-spacing: 0 5px; }
        .table thead th { border-bottom: 2px solid var(--neon) !important; color: var(--neon); font-family: 'Orbitron'; font-size: 11px; text-transform: uppercase; }
        .table tbody tr { background: #0d1117; transition: 0.2s; }
        .table tbody tr:hover { background: #161b22; transform: scale(1.005); }
        
        /* DataTable Button Styling */
        .dt-buttons .btn { background: #1a1f26 !important; border: 1px solid #333 !important; color: var(--neon) !important; font-size: 10px; margin-right: 5px; padding: 5px 10px; }
        .dataTables_filter input { border: 1px solid var(--neon) !important; color: #fff !important; margin-left: 10px; }
        .pagination .page-link { background: #0d1117; border-color: #333; color: var(--neon); }
        .pagination .page-item.active .page-link { background: var(--neon); border-color: var(--neon); color: #000; }
    </style>
</head>
<body>
    <div class="container-scroller">
        <div class="main-panel">
            <div class="content-wrapper">
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="card tactical-card">
                            <div class="card-body">
                                <h5 class="header-title mb-4">[ REGISTER_NOMENCLATURE ]</h5>
                                <form action="process-firearm-name.php" method="POST">
                                    <div class="form-group">
                                        <label class="small text-info">ASSET_IDENTIFIER</label>
                                        <input type="text" name="new_firearm_name" id="new_firearm_name" 
                                               class="form-control" placeholder="e.g. AK47 ASSAULT RIFLE" 
                                               onkeyup="checkNewFirearmName()" required>
                                        <div id="check-new-firearm-name" class="mt-2 small"></div>
                                    </div>
                                    <button type="submit" name="add_firearm" id="submit-name" class="btn btn-neon btn-block">
                                        <i class="mdi mdi-plus-circle"></i> COMMIT_TO_REGISTRY
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-8">
                        <div class="card tactical-card">
                            
                            <div class="card-body">
                               <div class="d-flex justify-content-between align-items-center mb-4">
                                    <h5 class="header-title m-0">[ ASSET_NOMENCLATURE_INDEX ]</h5>
                                    <a href="javascript:history.back()" class="btn btn-neon">
                                        <i class="mdi mdi-arrow-left"></i> BACK
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table id="firearmTable" class="table table-dark">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>ID_CODE</th>
                                                <th>ASSET_NAME</th>
                                                <th class="text-center">ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $stmt = $pdo->query("SELECT * FROM firearm_name ORDER BY firearm_nameID DESC");
                                            $count = 1;
                                            while($row = $stmt->fetch()) {
                                            ?>
                                            <tr>
                                                <td class="text-info"><?= $count++ ?></td>
                                                <td class="small"><?= str_pad($row['firearm_nameID'], 5, '0', STR_PAD_LEFT) ?></td>
                                                <td class="font-weight-bold text-uppercase"><?= htmlspecialchars($row['firearm_name']) ?></td>
                                                <td class="text-center">
                                                    <button class="btn btn-xs btn-outline-info mr-1" 
                                                            onclick="openUpdateModal(<?= $row['firearm_nameID'] ?>, '<?= addslashes($row['firearm_name']) ?>')">
                                                        <i class="mdi mdi-pencil"></i>
                                                    </button>
                                                    <button class="btn btn-xs btn-outline-danger" 
                                                            onclick="openDeleteModal(<?= $row['firearm_nameID'] ?>, '<?= addslashes($row['firearm_name']) ?>')">
                                                        <i class="mdi mdi-delete"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="process-firearm-name.php" method="POST" class="modal-content tactical-card">
                <div class="modal-body">
                    <h5 class="header-title mb-4">[ MODIFY_ASSET_DATA ]</h5>
                    <input type="hidden" name="firearm_nameID" id="modal_update_id">
                    <div class="form-group">
                        <label class="small text-info">NEW_DESIGNATION</label>
                        <input type="text" name="new_firearm_name" id="modal_update_name" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="submit" name="update_firearm" class="btn btn-neon">UPDATE_REGISTRY</button>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="process-firearm-name.php" method="POST" class="modal-content tactical-card" style="border-color: var(--danger);">
                <div class="modal-body text-center">
                    <i class="mdi mdi-alert-octagon text-danger" style="font-size: 50px;"></i>
                    <h5 class="header-title mt-3 text-danger">[ DELETE_PROTOCOL ]</h5>
                    <p class="small text-muted mt-3">Confirming permanent deletion of: <br><span id="modal_delete_name" class="text-white font-weight-bold"></span></p>
                    <input type="hidden" name="firearm_nameID" id="modal_delete_id">
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="submit" name="delete_firearm" class="btn btn-danger btn-sm">EXECUTE_PDELETE</button>
                    <button type="button" class="btn btn-outline-secondary btn-sm" data-dismiss="modal">ABORT</button>
                </div>
            </form>
        </div>
    </div>
    <?php require_once('includes/footer.php'); ?>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#firearmTable').DataTable({
            "responsive": true,
            "dom": 'Bfrtip',
            "buttons": [
                { extend: 'print', text: '[PRINT]', className: 'btn-neon', exportOptions: { columns: [0, 1, 2] } },
                { extend: 'csv', text: '[CSV]', className: 'btn-neon', exportOptions: { columns: [0, 1, 2] } },
                { extend: 'excel', text: '[EXCEL]', className: 'btn-neon', exportOptions: { columns: [0, 1, 2] } },
                { extend: 'pdf', text: '[PDF]', className: 'btn-neon', exportOptions: { columns: [0, 1, 2] } }
            ],
            "language": { "search": "SCAN_SYSTEM:" },
            "pageLength": 10
        });

        // Toast Notification System
        <?php if(isset($_SESSION['status'])): ?>
            toastr.options = { "positionClass": "toast-bottom-right", "progressBar": true };
            toastr["<?= $_SESSION['status_code'] ?>"]("<?= $_SESSION['status'] ?>");
        <?php unset($_SESSION['status']); unset($_SESSION['status_code']); endif; ?>
    });

    function checkNewFirearmName() {
        let val = $("#new_firearm_name").val();
        if(val.length > 2) {
            $.post("checkFirearmNameAvailability.php", { new_firearm_name: val }, 
            function(data) { $("#check-new-firearm-name").html(data); });
        }
    }

    function openUpdateModal(id, name) {
        $('#modal_update_id').val(id);
        $('#modal_update_name').val(name);
        $('#updateModal').modal('show');
    }

    function openDeleteModal(id, name) {
        $('#modal_delete_id').val(id);
        $('#modal_delete_name').text(name);
        $('#deleteModal').modal('show');
    }
    </script>
</body>
</html>     