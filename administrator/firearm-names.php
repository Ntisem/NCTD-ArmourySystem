<?php 
require_once('connections/connect-db.php'); // Now provides $pdo
require_once('functions.php');
require_once('includes/user_auth.php');

// 1. Authorization Check
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}

// 2. Fetch User Data (Now using PDO)
$username = $_SESSION['username']; 
$stmt = $pdo->prepare("SELECT adminID, fullname, service_no, rank FROM admin_lists WHERE username = ?");
$stmt->execute([$username]);
$admin_data = $stmt->fetch();

if ($admin_data) {
    $_SESSION['adminID'] = $admin_data['adminID'];
    $_SESSION['fullname'] = $admin_data['service_no'] . ' ' . $admin_data['rank'] . ' ' . $admin_data['fullname'];
    $_SESSION['user_role'] = 'Administrator'; 
    $armourer_admin_name = $_SESSION['fullname'];
}

// 3. Handle Weapon Selection
$current_firearm = $_SESSION['firearm_name'] ?? 'UNDEFINED_ASSET';

if (isset($_GET['firearm-name']) && !empty($_GET['firearm-name'])) {
    $get_firearm_name = $_GET['firearm-name'];
    $stmt = $pdo->prepare("SELECT firearm_name FROM firearm_name WHERE firearm_name = ?");
    $stmt->execute([$get_firearm_name]);
    $firearm_row = $stmt->fetch();
    
    if ($firearm_row) { 
        $_SESSION['firearm_name'] = $firearm_row['firearm_name']; 
        $current_firearm = $firearm_row['firearm_name']; 
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>HQ COMMAND | INVENTORY</title>
    
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />

    <style>
        :root { --neon-cyan: #00f2ff; --neon-amber: #f9a602; --panel-dark: #05070a; --neon-red: #ff4b2b; --neon-green: #00ffa3; }
        body { background-color: var(--panel-dark); font-family: 'JetBrains Mono', monospace; color: #e0e0e0; }
        
        #toast-container { position: fixed; top: 20px; right: 20px; z-index: 1055; }
        .t-toast { padding: 15px 25px; margin-bottom: 10px; min-width: 300px; border-left: 5px solid; background: #1a1f2b; box-shadow: 0 0 20px rgba(0,0,0,0.5); font-size: 0.8rem; letter-spacing: 1px; display: none; }
        .t-success { border-color: var(--neon-green); color: #fff; } 
        .t-error { border-color: var(--neon-red); color: #fff; }
        .t-warning { border-color: var(--neon-amber); color: #fff; }

        .table-tactical { background: rgba(13, 17, 23, 0.8); border: 1px solid rgba(0, 242, 255, 0.1); }
        .btn-tactical { 
            background: transparent; color: var(--neon-cyan); border: 1px solid rgba(0, 242, 255, 0.3); 
            text-transform: uppercase; transition: 0.3s; padding: 5px 15px; font-size: 0.7rem;
            clip-path: polygon(10% 0, 100% 0, 100% 70%, 90% 100%, 0 100%, 0 30%);
        }
        .btn-tactical:hover { background: rgba(0, 242, 255, 0.1); box-shadow: 0 0 10px var(--neon-cyan); color: #fff; }
        .btn-danger-tactical { color: var(--neon-red); border-color: rgba(255, 75, 43, 0.3); }
        .btn-danger-tactical:hover { box-shadow: 0 0 10px var(--neon-red); color: #fff; background: rgba(255, 75, 43, 0.1); }

        .clickable-asset { color: var(--neon-cyan); text-decoration: none; transition: 0.2s; border-bottom: 1px dashed transparent; }
        .clickable-asset:hover { color: #fff; text-shadow: 0 0 5px var(--neon-cyan); border-bottom-color: var(--neon-cyan); }
        
        .form-control, .form-select { background-color: #0d1117 !important; color: #fff !important; border: 1px solid rgba(0, 242, 255, 0.2) !important; border-radius: 0; }
        .form-control:focus, .form-select:focus { border-color: var(--neon-cyan) !important; box-shadow: 0 0 8px rgba(0, 242, 255, 0.4); }
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
                        <h3 class="page-title text-cyan"><i class="mdi mdi-pistol"></i> INVENTORY // <span class="text-amber"><?= htmlspecialchars($current_firearm) ?></span></h3>
                        <div class="d-flex align-items-center">
                            <div class="dropdown me-2">
                                <button class="btn btn-tactical dropdown-toggle" id="weaponDropdown" data-bs-toggle="dropdown" aria-expanded="false">SELECT::WEAPON_TYPE</button>
                                <div class="dropdown-menu dropdown-menu-right p-3 bg-dark border-info" style="width: 400px;">
                                    <div class="d-flex flex-wrap">
                                        <?php
                                        $nav_stmt = $pdo->query("SELECT firearm_name FROM firearm_name ORDER BY firearm_name ASC");
                                        while($nav_row = $nav_stmt->fetch()) {
                                            echo '<a href="?firearm-name='.urlencode($nav_row['firearm_name']).'" class="btn btn-outline-info btn-xs m-1 text-uppercase">> '.$nav_row['firearm_name'].'</a>';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <a href="add-new-weapon" class="btn btn-tactical border-success text-success"> + NEW_ENTRY</a>
                        </div>
                    </div>

                    <div class="card table-tactical">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="assets_weapon" class="table table-dark table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>SERIAL_NO</th>
                                            <th>ASSET_NAME</th>
                                            <th>TYPE</th>
                                            <th>CALIBER/CAP</th>
                                            <th>REGISTRY_DATE</th>
                                            <th class="text-center">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM firearms WHERE firearm_name = ? AND firearm_state IN ('Not Faulty', 'Not-Faulty') AND is_deleted = 0 ORDER BY firearmID ASC";
                                        $stmt = $pdo->prepare($sql);
                                        $stmt->execute([$current_firearm]);
                                        $i = 1;
                                        while($row = $stmt->fetch()):
                                        ?>
                                        <tr id="asset-row-<?= $row['firearmID'] ?>">
                                            <td><?= $i++ ?></td>
                                            <td><a href="firearm-details?id=<?= $row['firearmID'] ?>" class="clickable-asset font-weight-bold"><?= htmlspecialchars($row['firearm_serial_no']) ?></a></td>
                                            <td><a href="firearm-details?id=<?= $row['firearmID'] ?>" class="clickable-asset"><?= htmlspecialchars($row['firearm_name']) ?></a></td>
                                            <td><?= htmlspecialchars($row['firearm_type']) ?></td>
                                            <td><span class="badge border border-info text-info">[<?= htmlspecialchars($row['firearm_caliber']) ?>] / [<?= htmlspecialchars($row['firearm_capacity']) ?>]</span></td>
                                            <td class="small"><?= htmlspecialchars($row['datetime']) ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-xs btn-outline-info" onclick='openEditModal(<?= json_encode($row, JSON_HEX_APOS | JSON_HEX_QUOT) ?>)'><i class="mdi mdi-pencil"></i></button>
                                                <button class="btn btn-xs btn-outline-danger ms-1" onclick="openDeleteModal(<?= $row['firearmID'] ?>, '<?= htmlspecialchars($row['firearm_serial_no'], ENT_QUOTES) ?>')"><i class="mdi mdi-delete"></i></button>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once('includes/footer.php');?>
            </div>
        </div>
    </div>
    
<div class="modal fade" id="editModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-dark border border-info text-white" style="border-radius: 0;">
            <form id="editWeaponForm">
                <div class="modal-header border-info">
                    <h5 class="modal-title">[COMMAND]: UPDATE_FIREARM_DATA</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="f_id" id="edit_id">
                    <input type="hidden" name="update_weapon" value="1">
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label class="small text-info mb-1">SERIAL_NO</label>
                            <input type="text" name="f_serial" id="edit_serial" class="form-control" required>
                            <input type="hidden" name="armourer_admin_name" id="edit_armourer_admin_name" value="<?= htmlspecialchars($armourer_admin_name, ENT_QUOTES) ?>"  >
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small text-info mb-1">FIREARM_TYPE</label>
                            <input type="text" name="f_type" id="edit_type" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small text-info mb-1">MANUFACTURER</label>
                            <input type="text" name="f_manufacturer" id="edit_manufacturer" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small text-info mb-1">FIREARM_NAME</label>
                            <input type="text" name="f_name" id="edit_name" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small text-info mb-1">CALIBRE</label>
                            <input type="text" name="f_caliber" id="edit_caliber" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small text-info mb-1">CAPACITY</label>
                            <input type="text" name="f_capacity" id="edit_capacity" class="form-control">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small text-info mb-1">CLASS</label>
                            <select name="f_class" id="edit_class" class="form-select">
                                <option value="Duty-Weapon">Duty-Weapon</option>
                                <option value="Spare-Weapon">Spare-Weapon</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small text-info mb-1">STATE</label>
                            <select name="f_state" id="edit_state" class="form-select">
                                <option value="Not-Faulty">Not-Faulty</option>
                                <option value="Faulty">Faulty</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label class="small text-info mb-1">AVAILABILITY</label>
                            <select name="f_booking_status" id="edit_booking" class="form-select">
                                <option value="Available">Available</option>
                                <option value="Booked">Booked</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label class="small text-info mb-1">REMARKS</label>
                            <textarea name="f_remarks" id="edit_remarks" class="form-control" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" style="border-radius:0;" data-bs-dismiss="modal">ABORT</button>
                    <button type="submit" id="btnEditSubmit" class="btn btn-info" style="border-radius:0;">COMMIT_CHANGES</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content bg-dark border border-danger text-center" style="border-radius: 0;">
            <form id="deleteWeaponForm">
                <div class="modal-header border-danger justify-content-center">
                    <h5 class="modal-title text-danger">CONFIRM PURGE</h5>
                </div>
                <div class="modal-body">
                    <p class="small">REMOVE SERIAL:</p>
                    <h4 id="del_label" class="text-warning"></h4>
                    <input type="hidden" name="delete_id" id="del_id">
                    <input type="hidden" name="confirm_delete" value="1">
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-xs btn-light" style="border-radius:0;" data-bs-dismiss="modal">ABORT</button>
                    <button type="submit" id="btnDeleteSubmit" class="btn btn-xs btn-danger" style="border-radius:0;">PURGE</button>
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
                "dom": 'Bfrtip',
                "buttons": [
                    { extend: 'excel', text: '<i class="mdi mdi-file-excel"></i> EXCEL', className: 'btn-tactical mx-1' },
                    { extend: 'pdf', text: '<i class="mdi mdi-file-pdf"></i> PDF', className: 'btn-tactical mx-1' },
                    { extend: 'print', text: '<i class="mdi mdi-printer"></i> PRINT', className: 'btn-tactical mx-1' }
                ],
                "language": { "search": "[SCAN_DATABASE]:" }
            });

            // AJAX Handler for Form Submissions (Update Weapon)
            $('#editWeaponForm').on('submit', function(e) {
                e.preventDefault();
                var btn = $('#btnEditSubmit');
                btn.prop('disabled', true).text('PROCESSING...');

                $.ajax({
                    url: 'process-weapon-update.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(res) {
                        if(res.status === 'success') {
                            showToast(res.message, 't-success');
                            $('#editModal').modal('hide');
                            setTimeout(function() { location.reload(); }, 1500);
                        } else {
                            showToast('[ERROR]: ' + res.message, 't-error');
                        }
                    },
                    error: function() {
                        showToast('[FAULT]: LINK TO LOGIC SERVER SEVERED', 't-error');
                    },
                    complete: function() {
                        btn.prop('disabled', false).text('COMMIT_CHANGES');
                    }
                });
            });

            // AJAX Handler for Deletions
            $('#deleteWeaponForm').on('submit', function(e) {
                e.preventDefault();
                var btn = $('#btnDeleteSubmit');
                var targetId = $('#del_id').val();
                btn.prop('disabled', true).text('PURGING...');

                $.ajax({
                    url: 'process-weapon-delete.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(res) {
                        if(res.status === 'success') {
                            showToast(res.message, 't-warning');
                            $('#deleteModal').modal('hide');
                            $(`#asset-row-${targetId}`).fadeOut(500);
                        } else {
                            showToast('[ERROR]: ' + res.message, 't-error');
                        }
                    },
                    error: function() {
                        showToast('[FAULT]: CRITICAL ERROR DURING DATA PURGE', 't-error');
                    },
                    complete: function() {
                        btn.prop('disabled', false).text('PURGE');
                    }
                });
            });

            // Dropdown Intercept Logic
            $('#weaponDropdown').on('click', function(e) {
                e.preventDefault(); e.stopPropagation();
                $('.dropdown-menu').not($(this).next('.dropdown-menu')).removeClass('show');
                $(this).next('.dropdown-menu').toggleClass('show');
            });

            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu').removeClass('show');
                }
            });
        });

        function showToast(msg, css) {
            const t = $(`<div class="t-toast ${css}">${msg}</div>`);
            $('#toast-container').append(t);
            t.fadeIn(300).delay(3500).fadeOut(400, function() { $(this).remove(); });
        }

        function openEditModal(data) {
            $('#edit_id').val(data.firearmID);
            $('#edit_serial').val(data.firearm_serial_no);
            $('#edit_type').val(data.firearm_type);
            $('#edit_manufacturer').val(data.firearm_manufacturer || data.manufacturer);
            $('#edit_name').val(data.firearm_name);
            $('#edit_caliber').val(data.firearm_caliber);
            $('#edit_capacity').val(data.firearm_capacity);
            $('#edit_class').val(data.firearm_class);
            $('#edit_state').val(data.firearm_state);
            $('#edit_booking').val(data.booking_status);
            $('#edit_remarks').val(data.remarks || '');
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