<?php 
require_once('connections/connect-db.php'); // Now provides $pdo
require_once('functions.php');
require_once('includes/user_auth.php');

// 1. Authorization Check
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

// 2. Fetch User Data (Now using PDO)
$username = $_SESSION['username']; 
$stmt = $pdo->prepare("SELECT adminID, fullname, service_no, rank FROM admin_lists WHERE username = ?");
$stmt->execute([$username]);
$admin_data = $stmt->fetch();

// ... after fetching $admin_data
if ($admin_data) {
    $_SESSION['adminID'] = $admin_data['adminID'];
    $_SESSION['fullname'] = $admin_data['service_no'] . ' ' . $admin_data['rank'] . ' ' . $admin_data['fullname'];
    $_SESSION['user_role'] = 'Armourer'; // Ensure this matches your login logic
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
        :root { --neon-cyan: #00f2ff; --neon-amber: #f9a602; --panel-dark: #05070a; --neon-red: #ff4b2b; }
        body { background-color: var(--panel-dark); font-family: 'JetBrains Mono', monospace; color: #e0e0e0; }
        
        .t-toast { position: fixed; top: 20px; right: 20px; padding: 15px 25px; z-index: 10000; border-left: 5px solid; background: #1a1f2b; display: none; box-shadow: 0 0 20px rgba(0,0,0,0.5); font-size: 0.8rem; }
        .t-success { border-color: #00ffa3; } .t-error { border-color: var(--neon-red); }

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
                        <h3 class="page-title text-cyan"><i class="mdi mdi-pistol"></i> INVENTORY // <span class="text-amber"><?= $current_firearm ?></span></h3>
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
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><a href="firearm-details?id=<?= $row['firearmID'] ?>" class="clickable-asset font-weight-bold"><?= $row['firearm_serial_no'] ?></a></td>
                                            <td><a href="firearm-details?id=<?= $row['firearmID'] ?>" class="clickable-asset"><?= $row['firearm_name'] ?></a></td>
                                            <td><?= $row['firearm_type'] ?></td>
                                            <td><span class="badge border border-info text-info">[<?= $row['firearm_caliber'] ?>] / [<?= $row['firearm_capacity'] ?>]</span></td>
                                            <td class="small"><?= $row['datetime'] ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-xs btn-outline-info" onclick='openEditModal(<?= json_encode($row) ?>)'><i class="mdi mdi-pencil"></i></button>
                                                
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
    
<div class="modal fade" id="editModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content bg-dark border border-info text-white">
            <form action="process-weapon-update.php" method="POST">
                <div class="modal-header border-info">
                    <h5 class="modal-title">[COMMAND]: UPDATE_ASSET_DATA</h5>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="f_id" id="edit_id">
                    
                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label>SERIAL_NO</label>
                            <input type="text" name="f_serial" id="edit_serial" class="form-control bg-dark text-white border-secondary" required>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>FIREARM_TYPE</label>
                            <input type="text" name="f_type" id="edit_type" class="form-control bg-dark text-white border-secondary">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>MANUFACTURER</label>
                            <input type="text" name="f_manufacturer" id="edit_manufacturer" class="form-control bg-dark text-white border-secondary">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>FIREARM_NAME</label>
                            <input type="text" name="f_name" id="edit_name" class="form-control bg-dark text-white border-secondary">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>CALIBRE</label>
                            <input type="text" name="f_caliber" id="edit_caliber" class="form-control bg-dark text-white">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>CAPACITY</label>
                            <input type="text" name="f_capacity" id="edit_capacity" class="form-control bg-dark text-white">
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>CLASS</label>
                            <select name="f_class" id="edit_class" class="form-control bg-dark text-white">
                                <option value="Duty-Weapon">Duty-Weapon</option>
                                <option value="Spare-Weapon">Spare-Weapon</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>STATE</label>
                            <select name="f_state" id="edit_state" class="form-control bg-dark text-white">
                                <option value="Not-Faulty">Not-Faulty</option>
                                <option value="Faulty">Faulty</option>
                            </select>
                        </div>
                        <div class="col-md-4 mb-3">
                            <label>AVAILABILITY</label>
                            <select name="f_booking_status" id="edit_booking" class="form-control bg-dark text-white">
                                <option value="Available">Available</option>
                                <option value="Booked">Booked</option>
                            </select>
                        </div>
                        <div class="col-md-12 mb-3">
                            <label>REMARKS</label>
                            <textarea name="f_remarks" id="edit_remarks" class="form-control bg-dark text-white" rows="3"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ABORT</button>
                    <button type="submit" name="update_weapon" class="btn btn-info">COMMIT_CHANGES</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-sm">
        <div class="modal-content bg-dark border border-danger text-center">
            <form action="process-weapon-delete.php" method="POST">
                <div class="modal-header border-danger">
                    <h5 class="modal-title text-danger">CONFIRM PURGE</h5>
                </div>
                <div class="modal-body">
                    <p class="small">REMOVE SERIAL:</p>
                    <h4 id="del_label" class="text-warning"></h4>
                    <input type="hidden" name="delete_id" id="del_id">
                </div>
                <div class="modal-footer border-0 justify-content-center">
                    <button type="button" class="btn btn-xs btn-light" data-bs-dismiss="modal">ABORT</button>
                    <button type="submit" name="confirm_delete" class="btn btn-xs btn-danger">PURGE</button>
                </div>
            </form>
        </div>
    </div>
    </div>
    
 <?php require_once('includes/footer.php'); ?>
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
            $('#assets_weapon').DataTable({
                "dom": 'Bfrtip',
                "buttons": [
                    { extend: 'excel', text: '<i class="mdi mdi-file-excel"></i> EXCEL', className: 'btn-tactical mx-1' },
                    { extend: 'pdf', text: '<i class="mdi mdi-file-pdf"></i> PDF', className: 'btn-tactical mx-1' },
                    { extend: 'print', text: '<i class="mdi mdi-printer"></i> PRINT', className: 'btn-tactical mx-1' }
                ],
                "language": { "search": "[SCAN_DATABASE]:" }
            });

            // Handle custom dropdown mechanism
            $('#weaponDropdown').on('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
                
                // Close all other dropdown menus
                $('.dropdown-menu').not($(this).next('.dropdown-menu')).removeClass('show');
                
                // Toggle current dropdown menu
                $(this).next('.dropdown-menu').toggleClass('show');
            });

            // Close when clicking outside of the dropdown area
            $(document).on('click', function(e) {
                if (!$(e.target).closest('.dropdown').length) {
                    $('.dropdown-menu').removeClass('show');
                }
            });

            const urlParams = new URLSearchParams(window.location.search);
            if(urlParams.has('status')) {
                showToast(urlParams.get('status') === 'success' ? '[SIGNAL]: OPERATION_COMPLETE' : '[SIGNAL]: ERROR', urlParams.get('status') === 'success' ? 't-success' : 't-error');
            }
        });

        function showToast(msg, css) {
            const t = $(`<div class="t-toast ${css}">${msg}</div>`);
            $('#toast-container').append(t);
            t.fadeIn().delay(3000).fadeOut();
        }

        function openEditModal(data) {
            $('#edit_id').val(data.firearmID);
            $('#edit_serial').val(data.firearm_serial_no);
            $('#edit_type').val(data.firearm_type);
            $('#edit_manufacturer').val(data.manufacturer);
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