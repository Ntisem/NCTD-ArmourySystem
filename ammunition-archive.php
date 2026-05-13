<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');
require_once('central-logging-engine.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

$stmt = $pdo->query("SELECT * FROM ammunitions WHERE is_deleted = 1 ORDER BY datetime DESC");
$archived_assets = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>TERMINAL | AMMUNITION_RECOVERY</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
      <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root { --neon-cyan: #00f2ff; --neon-amber: #f9a602; --neon-red: #ff3e3e; --bg-dark: #05070a; --panel-bg: #0d1117; }
        body { background-color: var(--bg-dark); color: #c9d1d9; font-family: 'JetBrains Mono', monospace; }
        .card { background: var(--panel-bg); border: 1px solid #30363d; border-radius: 0; }
        .text-cyan { color: var(--neon-cyan); }
        
        /* Tactical Toasts */
        #toast-container { position: fixed; top: 20px; right: 20px; z-index: 9999; }
        .t-toast { background: #161b22; border: 1px solid #30363d; border-left: 4px solid var(--neon-cyan); color: #fff; padding: 15px; margin-bottom: 10px; min-width: 250px; animation: slideIn 0.3s forwards; }
        .t-toast.success { border-left-color: #2ea44f; }
        .t-toast.error { border-left-color: var(--neon-red); }
        @keyframes slideIn { from { transform: translateX(100%); } to { transform: translateX(0); } }

        /* DataTables Tactical Buttons */
        .dt-buttons { margin-bottom: 15px; }
        .btn-tactical { background: transparent !important; border: 1px solid #30363d !important; color: #fff !important; font-size: 10px !important; margin-right: 5px; border-radius: 0 !important; }
        .btn-tactical:hover { background: var(--neon-cyan) !important; color: #000 !important; }
        
        .btn-return { background: transparent; border: 1px solid var(--neon-amber); color: var(--neon-amber); padding: 5px 15px; border-radius: 0; font-size: 11px; }
        .btn-return:hover { background: var(--neon-amber); color: #000; }
    </style>
</head>
<body>
    <div id="toast-container"></div>

    <div class="container-fluid p-4">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h4 class="text-cyan mb-0">[ AMMUNITION_RECYCLE_BIN ]</h4>
                <button class="btn-return" onclick="window.history.back()"><i class="mdi mdi-arrow-left"></i> RETURN_TO_COMMAND</button>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table id="recoveryTable" class="table table-dark table-bordered">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>MANUFACTURER</th>
                                <th>SERIAL_NO</th>
                                <th>MODEL/NAME</th>
                                <th>ARCHIVE_DATE</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($archived_assets as $asset): ?>
                            <tr>
                                <td></td>
                                 <td><?= $asset['manufacturer'] ?></td>
                                <td><?= $asset['ammo_name'] ?></td>
                                <td><?= $asset['ammo_rounds'] ?></td>
                                <td><?= $asset['datetime'] ?></td>
                                <td>
                                    <button class="btn btn-outline-success btn-xs" onclick="triggerRestore('<?= $asset['ammoID'] ?>', '<?= $asset['ammo_serial_no'] ?>')">REDEPLOY</button>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="restoreModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-dark border-info">
                <div class="modal-header border-secondary">
                    <h5 class="modal-title text-info">RESTORE_AUTHORIZATION</h5>
                </div>
                <form action="process-ammo-restore.php" method="POST">
                    <div class="modal-body text-white">
                        Are you sure you want to restore Serial: <span id="assetName" class="text-warning"></span> to active registry?
                        <input type="hidden" name="restore_id" id="restore_id">
                    </div>
                    <div class="modal-footer border-secondary">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ABORT</button>
                        <button type="submit" name="confirm_restore" class="btn btn-info">CONFIRM_REDEPLOYMENT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <style>
    /* Fixed Tactical Footer Styling */
    .footer {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        background: #0a0c10 !important;
        border-top: 2px solid #f9a602;
        padding: 15px 0;
        z-index: 1030; /* Ensures it stays above page content */
        box-shadow: 0 -5px 20px rgba(249, 166, 2, 0.15);
    }

    /* Prevent content from being hidden behind the footer */
    body {
        padding-bottom: 70px; /* Match this to the footer height */
    }

    .tactical-alert {
        background-color: #05070a !important;
        border: 1px solid var(--neon-cyan) !important;
    }
    
    .swal-title { color: var(--neon-cyan) !important; font-family: 'Orbitron'; }
    .swal-text { color: #8a8d93 !important; font-family: 'Roboto Mono'; }
    
    /* Back to top adjustment for fixed footer */
    .back-to-top {
        position: fixed; 
        bottom: 80px; /* Moved up to sit above the fixed footer */
        right: 20px;
        background: #f9a602;
        padding: 10px;
        border-radius: 2px;
        box-shadow: 0 0 10px rgba(249, 166, 2, 0.5);
        z-index: 1031;
    }
</style>

<footer class="footer">
    <div class="container-fluid">
        <div class="d-sm-flex justify-content-center justify-content-sm-between align-items-center">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block" style="color: #fff !important;">
                <span style="color: #f9a602;">[SECURE_SYSTEM: <span style="color: #28a745;">ACTIVE</span>]</span> GPS | NATIONAL COUNTER TERRORISM DEPT.
            </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center" style="color: #6c7293; font-size: 0.8rem; font-family: 'JetBrains Mono', monospace;">
                DEV: <span>C/INSPR W. NTISEM</span> | &copy; <?php echo date("Y"); ?>
            </span>
        </div>
    </div>
</footer>

<a href="#" class="back-to-top">
    <i class="mdi mdi-arrow-up-bold"></i>
</a>

<script src="assets/js/sweetalert.min.js"></script>
<script src="assets/js/clock.js"></script>

<script>
<?php if(isset($_SESSION['status']) && $_SESSION['status'] != ''): ?>
    swal({
        title: "<?php echo $_SESSION['status'];?>",
        icon: "<?php echo $_SESSION['status_code'];?>",
        button: "ACKNOWLEDGE",
        className: "tactical-alert"
    });
<?php unset($_SESSION['status']); endif; ?>
</script>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
        function triggerToast(msg, type) {
            const toast = `<div class="t-toast ${type}">${msg}</div>`;
            $('#toast-container').append(toast);
            setTimeout(() => { $('.t-toast').first().fadeOut().remove(); }, 4000);
        }

        $(document).ready(function() {
            var t = $('#recoveryTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'excel', text: 'EXCEL_SCAN', className: 'btn-tactical' },
                    { extend: 'pdf', text: 'PDF_DUMP', className: 'btn-tactical' },
                    { extend: 'csv', text: 'CSV_EXPORT', className: 'btn-tactical' },
                    { extend: 'print', text: 'PRINT_HARDCOPY', className: 'btn-tactical' }
                ],
                columnDefs: [{ searchable: false, orderable: false, targets: 0 }],
                order: [[1, 'asc']]
            });

            t.on('order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();

            <?php if(isset($_SESSION['status'])): ?>
                triggerToast("<?= $_SESSION['status'] ?>", "<?= $_SESSION['status_code'] ?>");
                <?php unset($_SESSION['status']); ?>
            <?php endif; ?>
        });

        function triggerRestore(id, name) {
            $('#restore_id').val(id);
            $('#assetName').text(name);
            $('#restoreModal').modal('show');
        }
    </script>
</body>
</html>