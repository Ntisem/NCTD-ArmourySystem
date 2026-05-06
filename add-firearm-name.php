<?php  
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

// FETCH ADMIN DATA via PDO
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
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:wght@400;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <style>
        :root { --bg-deep: #05070a; --neon-cyan: #00f2ff; --neon-amber: #f9a602; --tactical-red: #ff3e3e; --success-green: #00ffa3; }
        body { background-color: var(--bg-deep) !important; font-family: 'JetBrains Mono', monospace; color: #e0e0e0; }
        .card { background: rgba(13, 17, 23, 0.95) !important; border: 1px solid rgba(0, 242, 255, 0.2) !important; border-radius: 0; }
        .dt-buttons { margin-bottom: 15px; gap: 5px; display: flex; }
        .btn-tactical { background: transparent !important; border: 1px solid var(--neon-cyan) !important; color: var(--neon-cyan) !important; font-size: 10px; text-transform: uppercase; }
        .btn-tactical:hover { background: rgba(0, 242, 255, 0.1) !important; box-shadow: 0 0 10px var(--neon-cyan); }
        table.tactical-rows { counter-reset: rowNumber; }
        table.tactical-rows tbody tr { counter-increment: rowNumber; }
        table.tactical-rows tbody tr td:first-child::before { content: counter(rowNumber); color: var(--neon-cyan); font-weight: bold; }
        #toast-container { position: fixed; top: 20px; right: 20px; z-index: 11000; }
        .tactical-toast { background: rgba(5, 7, 10, 0.95); border-left: 4px solid var(--neon-cyan); padding: 12px 20px; margin-bottom: 10px; }
        .toast-success { border-left-color: var(--success-green); }
        .toast-error { border-left-color: var(--tactical-red); }
        #scanning-overlay { display: none; position: fixed; inset: 0; background: rgba(5, 7, 10, 0.9); z-index: 10000; flex-direction: column; align-items: center; justify-content: center; color: var(--neon-cyan); }
        .scan-line { width: 100%; height: 2px; background: var(--neon-cyan); position: absolute; animation: scanMove 2s linear infinite; }
        @keyframes scanMove { 0% { top: 0%; } 100% { top: 100%; } }
        .modal-content { background: #0d1117; border: 1px solid var(--neon-cyan); border-radius: 0; }
    </style>
</head>

<body>
    <div id="toast-container"></div>
    <div id="scanning-overlay"><div class="scan-line"></div><div class="scan-text">SYNCHRONIZING REGISTRY...</div></div>

    <div class="container-scroller">
        <?php include('includes/sidebar.php'); ?>
        <div class="container-fluid page-body-wrapper">
            <?php include('includes/navbar.php'); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-xl-12 p-1">
                            <div class="card">
                              <div class="card-body">
                                <h6 class="card-title" style="color:var(--neon-amber)">[ ADD_NOMENCLATURE ]</h6>
                                <form id="inductionForm" method="POST" action="functions-add-new-names.php">
                                    <input type="hidden" name="armourer_admin_name" value="<?= $admin_data['service_no'].' '.$admin_data['rank'].' '.$admin_data['fullname'] ?>">
                                    <input type="hidden" name="adminID" value="<?= $admin_data['adminID']; ?>">

                                    <div class="row align-items-end">
                                        <div class="col-lg-9 col-md-8 col-sm-8">
                                            <div class="form-group mb-0"> <label>Name</label>
                                                <span id="check-new-firearm-name" class="d-block mb-1 small"></span>
                                                <input type="text" name="new_firearm_name" class="form-control" id="new_firearm_name" onInput="checkNewFirearmName()" autocomplete="off" required>
                                            </div>
                                        </div>
                                        
                                        <div class="col-lg-3 col-md-4 col-sm-4">
                                            <button type="submit" name="add_new_firearm_name" id="submit-name" class="btn btn-primary btn-block">Initialize</button> 
                                        </div>
                                    </div>
                                </form>
                            </div>
                            </div>
                        </div>

                        <div class="col-lg-12 col-md-12 col-xl-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title" style="color:var(--neon-cyan)">[ REGISTRY_SUMMATION ]</h4>
                                    <div class="table-responsive">
                                        <table id="tactical_table" class="table tactical-rows">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>NOMENCLATURE</th>
                                                    <th>STOCK LEVEL</th>
                                                    <th>COMMAND</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sql = "SELECT fn.firearm_nameID, fn.firearm_name, COUNT(f.firearmID) as unit_total 
                                                        FROM firearm_name fn
                                                        LEFT JOIN firearms f ON fn.firearm_name = f.firearm_name
                                                        GROUP BY fn.firearm_nameID";
                                                $query = $pdo->query($sql);
                                                while($row = $query->fetch()) {
                                                    $f_id = $row['firearm_nameID'];
                                                    $f_name = htmlspecialchars($row['firearm_name'], ENT_QUOTES);
                                                ?>
                                                    <tr>
                                                        <td></td>
                                                        <td style='color:var(--neon-cyan)'><?= $f_name; ?></td>
                                                        <td><span class='badge' style='border:1px solid var(--success-green); color:var(--success-green)'><?= $row['unit_total']; ?> UNITS</span></td>
                                                        <td>
                                                            <button class='btn btn-xs btn-outline-info' onclick='openUpdateModal(<?= $f_id; ?>, "<?= $f_name; ?>")'><i class='mdi mdi-pencil'></i></button>
                                                            <button class='btn btn-xs btn-outline-danger' onclick='openDeleteModal(<?= $f_id; ?>, "<?= $f_name; ?>")'><i class='mdi mdi-delete'></i></button>
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
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <form action="functions-add-new-names.php" method="POST">
                    <div class="modal-body text-center">
                        <h6 class="text-cyan mb-3">[ MOD_NOMENCLATURE ]</h6>
                        <input type="hidden" name="update_id" id="modal_update_id">
                        <input type="text" name="revised_name" id="modal_update_name" class="form-control mb-3" required>
                        <button type="submit" name="execute_update" class="btn btn-sm btn-info btn-block">COMMIT_CHANGE</button>
                        <button type="button" class="btn btn-sm btn-link text-muted mt-2 abort-trigger" data-bs-dismiss="modal">ABORT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-sm">
            <div class="modal-content border-danger">
                <form action="functions-add-new-names.php" method="POST">
                    <div class="modal-body text-center">
                        <h5 class="text-danger">[ PURGE_SEQUENCE ]</h5>
                        <input type="hidden" name="delete_id" id="modal_delete_id">
                        <p class="small">Authorized removal of <br><b id="modal_delete_name" class="text-white"></b>?</p>
                        <button type="submit" name="execute_delete" class="btn btn-sm btn-danger btn-block">EXECUTE</button>
                        <button type="button" class="btn btn-sm btn-link text-muted mt-2 abort-trigger" data-bs-dismiss="modal">CANCEL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>
    
    <script>
    function triggerToast(type, msg) {
        const t = $(`<div class="tactical-toast toast-${type}"><span>${msg}</span></div>`);
        $('#toast-container').append(t);
        setTimeout(() => t.fadeOut(300, () => t.remove()), 4000);
    }

    $(document).ready(function() {
        $('#tactical_table').DataTable({
            "dom": 'Bfrtip',
            "buttons": [
                { extend: 'excelHtml5', text: '[ EXCEL ]', className: 'btn-tactical', exportOptions: { columns: [0, 1, 2] } },
                { extend: 'pdfHtml5', text: '[ PDF ]', className: 'btn-tactical', exportOptions: { columns: [0, 1, 2] } },
                { extend: 'print', text: '[ PRINT ]', className: 'btn-tactical', exportOptions: { columns: [0, 1, 2] } }
            ],
            "language": { "search": "SCAN_SYSTEM:" },
            "columnDefs": [{ "orderable": false, "targets": 0 }]
        });

        const status = new URLSearchParams(window.location.search).get('status');
        if(status === 'success') triggerToast('success', '[SIGNAL]: ENTRY_COMMITTED');
        if(status === 'deleted') triggerToast('error', '[SIGNAL]: DATA_PURGED');
        if(status === 'updated') triggerToast('success', '[SIGNAL]: REGISTRY_UPDATED');
        if(status === 'conflict') triggerToast('error', '[SIGNAL]: CONFLICT_DETECTED');

        window.history.replaceState({}, '', window.location.pathname);
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

    $('#inductionForm').submit(function() { 
        $('#scanning-overlay').css('display', 'flex'); 
        return true; 
    });
    </script>
</body>
</html>