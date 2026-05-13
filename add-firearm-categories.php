<?php  
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') { // Adjusted to match your usual role
    header("location: login");
    exit();
}

$u_name = $_SESSION['fullname'] ?? 'SYSTEM_USER';
$a_id   = $_SESSION['adminID'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>NCTD ARMOURY SYSTEM | WEAPON ATTRIBUTES</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=JetBrains+Mono:wght@300;500&display=swap" rel="stylesheet">
     <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root { --neon-cyan: #00f2ff; --neon-green: #00ffa3; --neon-red: #ff4b2b; --tactical-bg: #0b0e14; }
        body { background: #05070a; font-family: 'JetBrains Mono', monospace; color: #c0c5ce; }
        .tactical-card { background: var(--tactical-bg); border: 1px solid #1a1f2b; box-shadow: 0 0 20px rgba(0,0,0,0.8); }
        .text-cyan { color: var(--neon-cyan); font-family: 'Orbitron'; letter-spacing: 1px; }
        .form-control { background: #000 !important; border: 1px solid #1a1f2b !important; color: var(--neon-cyan) !important; border-radius: 0; }
        .form-control:focus { border-color: var(--neon-cyan) !important; box-shadow: 0 0 5px rgba(0, 242, 255, 0.2); }
        .btn-neon { background: transparent; border: 1px solid var(--neon-cyan); color: var(--neon-cyan); text-transform: uppercase; border-radius: 0; transition: 0.3s; }
        .btn-neon:hover:not(:disabled) { background: var(--neon-cyan); color: #000; box-shadow: 0 0 10px var(--neon-cyan); }
        
        /* Tactical Tabs */
        .nav-tabs .nav-link { color: #666; border: 1px solid #1a1f2b; border-bottom: none; background: #000; font-family: 'Orbitron'; border-radius: 0; }
        .nav-tabs .nav-link.active { color: var(--neon-cyan); background: var(--tactical-bg); border-color: var(--neon-cyan); border-bottom-color: var(--tactical-bg); }
        
        /* Tables */
        .table { color: #adc4b2 !important; border-color: #1a1f2b; }
        .table thead th { border-bottom: 2px solid var(--neon-cyan) !important; color: var(--neon-cyan); font-family: 'Orbitron'; font-size: 11px; }
        
        /* Toast Alert */
        #toast-container { position: fixed; top: 20px; right: 20px; z-index: 10000; }
        .t-toast { padding: 15px 25px; border-left: 4px solid; background: #000; color: #fff; font-size: 12px; display: none; box-shadow: 0 0 15px rgba(0,0,0,0.5); }
        .t-success { border-color: var(--neon-green); }
        .t-error { border-color: var(--neon-red); }
    </style>
</head>
<body>
    <div id="toast-container"></div>
    <div class="container-scroller">
       <?php include_once('includes/sidebar.php');?>
       <div class="page-body-wrapper">
            <?php include_once('includes/navbar.php');?>
            <div class="main-panel">
                <div class="content-wrapper">  
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card tactical-card mb-3">
                                <div class="card-body">
                                    <h5 class="text-cyan mb-4">[ REGISTER_ATTRIBUTES ]</h5>
                                    
                                    <form action="process-firearm-attributes.php" method="POST" class="mb-4 pb-3 border-bottom border-dark">
                                        <input type="hidden" name="action" value="add_manufacturer">
                                        <label class="small text-muted">NEW_MANUFACTURER</label>
                                        <input type="text" name="value" id="ac_manufacturer" class="form-control mb-1" required placeholder="e.g. GLOCK" onkeyup="checkField('manufacturer')">
                                        <div id="status-manufacturer" style="min-height: 20px;"></div>
                                        <button type="submit" id="btn_manufacturer" class="btn btn-neon btn-sm w-100 mt-2">COMMIT_MANUFACTURER</button>
                                    </form>

                                    <form action="process-firearm-attributes.php" method="POST" class="mb-4 pb-3 border-bottom border-dark">
                                        <input type="hidden" name="action" value="add_caliber">
                                        <label class="small text-muted">NEW_CALIBER</label>
                                        <input type="text" name="value" id="ac_caliber" class="form-control mb-1" required placeholder="e.g. 9X19MM" onkeyup="checkField('caliber')">
                                        <div id="status-caliber" style="min-height: 20px;"></div>
                                        <button type="submit" id="btn_caliber" class="btn btn-neon btn-sm w-100 mt-2">COMMIT_CALIBER</button>
                                    </form>

                                    <form action="process-firearm-attributes.php" method="POST">
                                        <input type="hidden" name="action" value="add_category">
                                        <label class="small text-muted">NEW_CATEGORY</label>
                                        <input type="text" name="value" id="ac_category" class="form-control mb-1" required placeholder="e.g. PISTOL" onkeyup="checkField('category')">
                                        <div id="status-category" style="min-height: 20px;"></div>
                                        <button type="submit" id="btn_category" class="btn btn-neon btn-sm w-100 mt-2">COMMIT_CATEGORY</button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card tactical-card">
                                <div class="card-body">
                                    <h5 class="text-cyan mb-3">[ DATABASE_REGISTRIES ]</h5>
                                    
                                    <ul class="nav nav-tabs" id="attributeTabs" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" data-bs-toggle="tab" href="#manTab">MANUFACTURERS</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#calTab">CALIBERS</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" data-bs-toggle="tab" href="#catTab">CATEGORIES</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content pt-4" id="tabContent">
                                        
                                        <div class="tab-pane fade show active" id="manTab">
                                            <div class="table-responsive">
                                                <table class="table table-dark table-hover tact-table" id="manTable" width="100%">
                                                    <thead><tr><th>#</th><th>MANUFACTURER</th><th class="text-center">ACTIONS</th></tr></thead>
                                                    <tbody>
                                                        <?php
                                                        $stmt = $pdo->query("SELECT * FROM firearm_manufacturers ORDER BY firearm_manufacturerID DESC");
                                                        $i = 1;
                                                        while($row = $stmt->fetch()) {
                                                            echo "<tr>
                                                                <td>".str_pad($i++, 2, '0', STR_PAD_LEFT)."</td>
                                                                <td class='font-weight-bold text-uppercase'>{$row['firearm_manufacturer']}</td>
                                                                <td class='text-center'>
                                                                    <button class='btn btn-outline-info btn-xs' onclick=\"openEditModal('manufacturer', '{$row['firearm_manufacturerID']}', '{$row['firearm_manufacturer']}')\"><i class='mdi mdi-pencil'></i></button>
                                                                    <button class='btn btn-outline-danger btn-xs' onclick=\"openDeleteModal('manufacturer', '{$row['firearm_manufacturerID']}', '{$row['firearm_manufacturer']}')\"><i class='mdi mdi-delete'></i></button>
                                                                </td>
                                                            </tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="calTab">
                                            <div class="table-responsive">
                                                <table class="table table-dark table-hover tact-table" id="calTable" width="100%">
                                                    <thead><tr><th>#</th><th>CALIBER</th><th class="text-center">ACTIONS</th></tr></thead>
                                                    <tbody>
                                                        <?php
                                                        $stmt = $pdo->query("SELECT * FROM firearm_calibers ORDER BY firearm_caliberID DESC");
                                                        $i = 1;
                                                        while($row = $stmt->fetch()) {
                                                            echo "<tr>
                                                                <td>".str_pad($i++, 2, '0', STR_PAD_LEFT)."</td>
                                                                <td class='font-weight-bold text-uppercase'>{$row['firearm_caliber']}</td>
                                                                <td class='text-center'>
                                                                    <button class='btn btn-outline-info btn-xs' onclick=\"openEditModal('caliber', '{$row['firearm_caliberID']}', '{$row['firearm_caliber']}')\"><i class='mdi mdi-pencil'></i></button>
                                                                    <button class='btn btn-outline-danger btn-xs' onclick=\"openDeleteModal('caliber', '{$row['firearm_caliberID']}', '{$row['firearm_caliber']}')\"><i class='mdi mdi-delete'></i></button>
                                                                </td>
                                                            </tr>";
                                                        }
                                                        ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="catTab">
                                            <div class="table-responsive">
                                                <table class="table table-dark table-hover tact-table" id="catTable" width="100%">
                                                    <thead><tr><th>#</th><th>CATEGORY</th><th class="text-center">ACTIONS</th></tr></thead>
                                                    <tbody>
                                                        <?php
                                                        $stmt = $pdo->query("SELECT * FROM firearm_categories ORDER BY firearm_categoryID DESC");
                                                        $i = 1;
                                                        while($row = $stmt->fetch()) {
                                                            echo "<tr>
                                                                <td>".str_pad($i++, 2, '0', STR_PAD_LEFT)."</td>
                                                                <td class='font-weight-bold text-uppercase'>{$row['firearm_category']}</td>
                                                                <td class='text-center'>
                                                                    <button class='btn btn-outline-info btn-xs' onclick=\"openEditModal('category', '{$row['firearm_categoryID']}', '{$row['firearm_category']}')\"><i class='mdi mdi-pencil'></i></button>
                                                                    <button class='btn btn-outline-danger btn-xs' onclick=\"openDeleteModal('category', '{$row['firearm_categoryID']}', '{$row['firearm_category']}')\"><i class='mdi mdi-delete'></i></button>
                                                                </td>
                                                            </tr>";
                                                        }
                                                        ?>
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
                <?php include_once('includes/footer.php'); ?>
            </div>
       </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="background: #0d1117; border: 1px solid var(--neon-cyan);">
                <form action="process-firearm-attributes.php" method="POST">
                    <div class="modal-body text-center">
                        <h6 class="text-cyan mb-3">[ MODIFY_DATA ]</h6>
                        <input type="hidden" name="action" value="update_attribute">
                        <input type="hidden" name="type" id="upd_type">
                        <input type="hidden" name="id" id="upd_id">
                        <input type="text" name="value" id="upd_val" class="form-control mb-3 text-center" required>
                        <button type="submit" class="btn btn-neon btn-sm w-100">COMMIT_CHANGES</button>
                        <button type="button" class="btn btn-link text-muted mt-2 btn-sm" data-bs-dismiss="modal">ABORT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog modal-sm">
            <div class="modal-content" style="background: #0d1117; border: 1px solid var(--neon-red);">
                <form action="process-firearm-attributes.php" method="POST">
                    <div class="modal-body text-center">
                        <h6 class="text-danger mb-3">[ PURGE_DATA ]</h6>
                        <input type="hidden" name="action" value="delete_attribute">
                        <input type="hidden" name="type" id="del_type">
                        <input type="hidden" name="id" id="del_id">
                        <p class="small text-muted">Confirm deletion of:<br><b id="del_label" class="text-white"></b></p>
                        <button type="submit" class="btn btn-danger btn-sm w-100">EXECUTE_PURGE</button>
                        <button type="button" class="btn btn-link text-muted mt-2 btn-sm" data-bs-dismiss="modal">ABORT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
    $(document).ready(function() {
        // Initialize all 3 DataTables
        $('.tact-table').DataTable({
            pageLength: 5,
            dom: '<"d-flex justify-content-between align-items-center mb-3"Bf>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
            buttons: [
                { extend: 'print', className: 'btn btn-outline-secondary btn-sm', text: '[PRINT]' },
                { extend: 'pdf', className: 'btn btn-outline-secondary btn-sm', text: '[PDF]' }
            ],
            language: { search: "SCAN_DB:" }
        });

        // Toast Notification System
        <?php if(isset($_SESSION['status'])): ?>
            let msg = "<?= $_SESSION['status'] ?>";
            let code = "<?= $_SESSION['status_code'] ?>";
            let typeClass = (code === 'success') ? 't-success' : 't-error';
            
            const t = $(`<div class="t-toast ${typeClass}">[SIGNAL]: ${msg}</div>`);
            $('#toast-container').append(t);
            t.fadeIn().delay(4000).fadeOut();
            
            <?php unset($_SESSION['status']); unset($_SESSION['status_code']); ?>
        <?php endif; ?>
    });

    // Unified Check Field AJAX Logic
    function checkField(type) {
        let val = $(`#ac_${type}`).val();
        let span = `#status-${type}`;
        let btn = `#btn_${type}`;
        let url = '';
        let dbColumn = '';

        if (type === 'manufacturer') { url = 'checkFirearmManufacturerAvailability.php'; dbColumn = 'firearm_manufacturer'; }
        else if (type === 'caliber') { url = 'checkFirearmCaliberAvailability.php'; dbColumn = 'firearm_caliber'; }
        else if (type === 'category') { url = 'checkFirearmCategoryAvailability.php'; dbColumn = 'firearm_category'; }

        if (val.trim().length > 1) {
            $.post(url, { type: dbColumn, value: val }, function(data) {
                $(span).html(data);
                let hasError = data.includes('#ff4b2b'); // Check if error color is in response
                $(btn).prop('disabled', hasError);
            });
        } else {
            $(span).empty();
            $(btn).prop('disabled', false);
        }
    }

    // Modal Population Scripts
    function openEditModal(type, id, val) {
        $("#upd_type").val(type);
        $("#upd_id").val(id);
        $("#upd_val").val(val);
        $("#updateModal").modal('show');
    }

    function openDeleteModal(type, id, val) {
        $("#del_type").val(type);
        $("#del_id").val(id);
        $("#del_label").text(val);
        $("#deleteModal").modal('show');
    }
    </script>
</body>
</html>