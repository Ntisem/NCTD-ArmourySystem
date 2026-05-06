<?php  
require_once('connections/connect-db.php'); // Assuming this sets up $pdo
require_once('functions.php');
require_once('includes/user_auth.php');

// Security check
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

$u_name = $_SESSION['fullname'] ?? 'SYSTEM_USER';
$a_id   = $_SESSION['adminID'] ?? 0;

// Handle Firearm Name Selection via PDO
if (isset($_GET['firearm-name']) && $_GET['firearm-name'] != '') {
    $get_firearm_name = $_GET['firearm-name'];
    $stmt = $pdo->prepare("SELECT firearm_name FROM firearm_name WHERE firearm_name = ?");
    $stmt->execute([$get_firearm_name]);
    $firearm_row = $stmt->fetch();
    
    if ($firearm_row) {
        $_SESSION['firearm_name'] = $firearm_row['firearm_name'];
    }
}

$current_firearm = $_SESSION['firearm_name'] ?? 'UNDEFINED_ASSET';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HQ COMMAND | ASSET: <?= $current_firearm ?></title>
    
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">

    <style>
        :root {
            --neon-cyan: #00f2ff;
            --neon-amber: #f9a602;
            --neon-red: #ff4b2b;
            --panel-dark: #05070a;
        }

        body { background-color: var(--panel-dark); font-family: 'JetBrains Mono', monospace; color: #e0e0e0; }

        /* Tactical Toast */
        .t-toast { position: fixed; top: 20px; right: 20px; padding: 15px 25px; z-index: 10000; border-left: 5px solid; background: #1a1f2b; color: #fff; display: none; box-shadow: 0 0 20px rgba(0,0,0,0.5); }
        .t-success { border-color: #00ffa3; }
        .t-error { border-color: var(--neon-red); }

        /* Table & UI Enhancements */
        .table-tactical { background: rgba(13, 17, 23, 0.8); border: 1px solid rgba(0, 242, 255, 0.1); }
        .btn-tactical { 
            background: transparent; color: var(--neon-cyan); border: 1px solid rgba(0, 242, 255, 0.3); 
            text-transform: uppercase; letter-spacing: 1px; transition: 0.3s;
            clip-path: polygon(10% 0, 100% 0, 100% 70%, 90% 100%, 0 100%, 0 30%);
        }
        .btn-tactical:hover { background: rgba(0, 242, 255, 0.1); box-shadow: 0 0 10px var(--neon-cyan); color: #fff; }

        /* Landscape Dropdown */
        .landscape-panel { width: 700px !important; max-width: 90vw; background: var(--panel-dark) !important; border: 1px solid var(--neon-cyan) !important; }
        .tactical-grid-item { flex: 0 0 31%; margin: 1%; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(0, 242, 255, 0.1); padding: 10px; color: #8a8d93; text-decoration: none; font-size: 0.75rem; }
        .tactical-grid-item:hover { color: var(--neon-cyan); border-color: var(--neon-cyan); background: rgba(0, 242, 255, 0.05); }

        /* DataTables Custom Overrides */
        .dataTables_filter input { background: #12151e; border: 1px solid #1a1f2b; color: white; }
        .dt-buttons .btn { background: #12151e !important; border: 1px solid var(--neon-cyan) !important; color: var(--neon-cyan) !important; font-size: 0.7rem; }
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
                    <div class="page-header">
                        <h3 class="page-title text-cyan">
                            <i class="mdi mdi-pistol"></i> FIREARMS // <span class="text-amber"><?= $current_firearm ?></span>
                        </h3>
                        
                        <nav>
                            <div class="dropdown">
                                <button class="btn btn-tactical dropdown-toggle" id="weaponDropdown" data-bs-toggle="dropdown">
                                    SELECT::WEAPON_TYPE
                                </button>
                                <div class="dropdown-menu dropdown-menu-right landscape-panel p-3">
                                    <h6 class="text-cyan mb-3 px-2">[SYS_REGISTRY_QUERY]</h6>
                                    <div class="d-flex flex-wrap">
                                        <?php
                                        $nav_stmt = $pdo->query("SELECT firearm_name FROM firearm_name ORDER BY firearm_name ASC");
                                        while($nav_row = $nav_stmt->fetch()) {
                                            echo '<a href="?firearm-name='.urlencode($nav_row['firearm_name']).'" class="tactical-grid-item text-uppercase">> '.$nav_row['firearm_name'].'</a>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                        </nav>
                    </div>

                    <div class="card table-tactical mt-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h4 class="card-title text-cyan mb-0">[ASSET_INVENTORY_LOG]</h4>
                                <a href="add-new-weapon" class="btn btn-outline-success btn-sm">
                                    <i class="mdi mdi-plus"></i> NEW_ENTRY
                                </a>
                            </div>

                            <table id="assets_weapon" class="table table-dark table-hover">
                                <thead>
                                    <tr>
                                        <th>SERIAL_NO</th>
                                        <th>ASSET_NAME</th>
                                        <th>TYPE</th>
                                        <th>CALIBER/CAP</th>
                                        <th>REGISTRY_DATE</th>
                                        <th class="text-center">OPERATIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "SELECT * FROM firearms WHERE firearm_name = ? AND (firearm_state = 'Not Faulty' OR firearm_state = 'Not-Faulty') ORDER BY firearmID ASC";
                                    $data_stmt = $pdo->prepare($sql);
                                    $data_stmt->execute([$current_firearm]);
                                    
                                    while($row = $data_stmt->fetch()):
                                    ?>
                                    <tr>
                                        <td class="text-amber font-weight-bold"><?= $row['firearm_serial_no'] ?></td>
                                        <td><?= $row['firearm_name'] ?></td>
                                        <td><?= $row['firearm_type'] ?></td>
                                        <td>
                                            <span class="badge border border-info text-info">
                                                [<?= $row['firearm_caliber'] ?>] / [<?= $row['firearm_capacity'] ?>]
                                            </span>
                                        </td>
                                        <td class="small"><?= $row['datetime'] ?></td>
                                        <td class="text-center">
                                            <button class="btn btn-xs btn-outline-info mr-2" 
                                                onclick="openEditModal('<?= $row['firearmID'] ?>', '<?= $row['firearm_serial_no'] ?>', '<?= $row['firearm_type'] ?>')">
                                                <i class="mdi mdi-playlist-edit"></i>
                                            </button>
                                            <button class="btn btn-xs btn-outline-danger" 
                                                onclick="openDeleteModal('<?= $row['firearmID'] ?>', '<?= $row['firearm_serial_no'] ?>')">
                                                <i class="mdi mdi-delete-forever"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <?php endwhile; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php include_once('includes/footer.php');?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="editModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content bg-dark border border-info">
                <form action="process-weapon-update.php" method="POST">
                    <div class="modal-header border-info">
                        <h5 class="modal-title text-cyan">[COMMAND]: UPDATE_ASSET_DATA</h5>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="f_id" id="edit_id">
                        <div class="form-group mb-3">
                            <label class="text-muted small">SERIAL_IDENTIFIER</label>
                            <input type="text" name="f_serial" id="edit_serial" class="form-control bg-black text-white border-secondary" required>
                        </div>
                        <div class="form-group mb-3">
                            <label class="text-muted small">CLASSIFICATION_TYPE</label>
                            <input type="text" name="f_type" id="edit_type" class="form-control bg-black text-white border-secondary" required>
                        </div>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-light btn-sm" data-bs-dismiss="modal">ABORT</button>
                        <button type="submit" name="update_weapon" class="btn btn-info btn-sm">COMMIT_CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content bg-dark border border-danger">
                <form action="process-weapon-delete.php" method="POST">
                    <div class="modal-header border-danger">
                        <h5 class="modal-title text-danger">[WARNING]: DATA_PURGE</h5>
                    </div>
                    <div class="modal-body text-center">
                        <p>Are you sure you want to remove asset?</p>
                        <h4 id="del_label" class="text-amber"></h4>
                        <input type="hidden" name="del_id" id="del_id">
                    </div>
                    <div class="modal-footer border-0 justify-content-center">
                        <button type="button" class="btn btn-outline-light btn-xs" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" name="confirm_delete" class="btn btn-danger btn-xs">CONFIRM_PURGE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
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
            var table = $('#assets_weapon').DataTable({
                "responsive": true,
                "dom": 'Bfrtip',
                "buttons": [
                    { extend: 'excel', text: '<i class="mdi mdi-file-excel"></i> EXCEL', className: 'btn-sm' },
                    { extend: 'pdf', text: '<i class="mdi mdi-file-pdf"></i> PDF', className: 'btn-sm' },
                    { extend: 'print', text: '<i class="mdi mdi-printer"></i> PRINT', className: 'btn-sm' }
                ],
                "language": {
                    "search": "[SCAN_DATABASE]:",
                    "paginate": { "next": ">>", "previous": "<<" }
                }
            });

            // Toast Notifications
            const urlParams = new URLSearchParams(window.location.search);
            if(urlParams.has('status')) {
                let status = urlParams.get('status');
                let msg = status === 'success' ? '[SIGNAL]: OPERATION_COMPLETE' : '[SIGNAL]: ERROR_DETECTED';
                let css = status === 'success' ? 't-success' : 't-error';
                showToast(msg, css);
            }
        });

        function showToast(msg, cssClass) {
            const t = $(`<div class="t-toast ${cssClass}">${msg}</div>`);
            $('#toast-container').append(t);
            t.fadeIn().delay(3000).fadeOut();
        }

        function openEditModal(id, serial, type) {
            $('#edit_id').val(id);
            $('#edit_serial').val(serial);
            $('#edit_type').val(type);
            $('#editModal').modal('show');
        }

        function openDeleteModal(id, serial) {
            $('#del_id').val(id);
            $('#del_label').text(serial);
            $('#deleteModal').modal('show');
        }
    </script>
</body>
</html>