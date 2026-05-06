<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

// 1. OVERDUE LOGIC: Check for deployments > 24hrs
$overdue_check = $pdo->query("SELECT COUNT(*) FROM bookings WHERE TRIM(returns) = 'Not-Return' AND is_deleted = 0 AND STR_TO_DATE(booking_time, '%M %e, %Y') < DATE_SUB(NOW(), INTERVAL 24 HOUR)");
$overdue_count = $overdue_check->fetchColumn();

// 2. SEARCH LOGIC
$startDate = $_GET['start_date'] ?? null;
$endDate = $_GET['end_date'] ?? null;

$query = "SELECT * FROM bookings WHERE is_deleted = 0";
$params = [];

if (!empty($startDate) && !empty($endDate)) {
    $query .= " AND STR_TO_DATE(booking_time, '%M %e, %Y') BETWEEN ? AND ?";
    $params = [$startDate, $endDate];
}
$query .= " ORDER BY bookingID DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$bookings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>COMMAND_LOG | FIREARM_DEPLOYMENT</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    
    <style>
        :root { 
            --neon: #00f2ff; 
            --bg: #020408; 
            --card: #0a0d12; 
            --danger: #ff3333; 
            --success: #00ff88;
        }
        body { background: var(--bg); font-family: 'JetBrains Mono', monospace; color: #e0e0e0; }
        .tactical-card { background: var(--card) !important; border: 1px solid rgba(0, 242, 255, 0.2); border-radius: 0; }
        .table { color: #fff !important; }
        .table thead th { background: rgba(0, 242, 255, 0.1); color: var(--neon); border-bottom: 2px solid var(--neon); font-size: 11px; text-transform: uppercase; }
        .btn-tactical { border: 1px solid var(--neon); color: var(--neon); border-radius: 0; background: transparent; transition: 0.3s; }
        .btn-tactical:hover { background: var(--neon); color: #000; box-shadow: 0 0 15px var(--neon); }
        .officer-link { color: var(--neon); text-decoration: none; font-weight: bold; }
        #toast-container { position: fixed; top: 20px; right: 20px; z-index: 99999; }
        .t-toast { background: #000; border: 1px solid var(--neon); color: #fff; padding: 15px; margin-bottom: 10px; border-left: 5px solid var(--neon); display:none; }
        
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: #0a0d12 !important;
            border: 1px solid var(--neon) !important;
            color: var(--neon) !important;
            margin: 0 2px !important;
            border-radius: 0 !important;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current, 
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--neon) !important;
            color: #000 !important;
            border: 1px solid var(--neon) !important;
        }
        .dataTables_wrapper .dataTables_length select, 
        .dataTables_wrapper .dataTables_filter input {
            background-color: #000 !important;
            color: var(--neon) !important;
            border: 1px solid var(--neon) !important;
            border-radius: 0 !important;
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
                    
                    <?php if($overdue_count > 0): ?>
                    <div class="alert alert-danger border-danger bg-dark text-white mb-4 d-flex justify-content-between align-items-center" style="border-left: 5px solid #ff3333 !important;">
                        <div>
                            <i class="mdi mdi-alert-decagram text-danger mr-2"></i>
                            <strong>[TACTICAL_ALERT]:</strong> <?php echo $overdue_count; ?> deployments have exceeded the 24-hour return timeframe.
                        </div>
                        <a href="overdue-bookings.php" class="btn btn-sm btn-outline-danger">VIEW_OFFICERS</a>
                    </div>
                    <?php endif; ?>

                    <div class="tactical-card card mb-4">
                        <div class="card-body">
                            <form method="GET" class="row align-items-end">
                                <div class="col-md-3">
                                    <label class="small text-info">START_DATE</label>
                                    <input type="date" name="start_date" class="form-control bg-dark text-white border-info" value="<?= htmlspecialchars($startDate) ?>">
                                </div>
                                <div class="col-md-3">
                                    <label class="small text-info">END_DATE</label>
                                    <input type="date" name="end_date" class="form-control bg-dark text-white border-info" value="<?= htmlspecialchars($endDate) ?>">
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-tactical">RUN_QUERY</button>
                                    <a href="booked-firearms.php" class="btn btn-outline-secondary ml-2">RESET</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tactical-card card">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h4 class="card-title text-info mb-0">[ DEPLOYMENT_REGISTRY_LOG ]</h4>
                        <div>
                            <a href="not-returns-firearms" class="btn btn-tactical mr-2">
                                <i class="mdi mdi-pistol"></i> 
                            </a>
                            <a href="not-returns-ammo" class="btn btn-tactical">
                                <i class="mdi mdi-ammunition"></i> 
                            </a>
                        </div>
                    </div>
                            <div class="table-responsive">
                                <table id="mainTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>OFFICER_NAME</th>
                                            <th>WEAPON_SYSTEM</th>
                                            <th>SERIAL_NO/RDS</th>
                                             <th>STATUS</th>
                                            <th>DEPLOY_TIME</th>
                                            <th>DURATION</th> 
                                            <th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach($bookings as $row): ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><a href="officer-profile.php?id=<?= $row['officerID'] ?>" class="officer-link"><?= htmlspecialchars($row['to_officer']) ?></a></td>
                                            <td><?= htmlspecialchars($row['firearm_name']) ?></td>
                                            <td><?= htmlspecialchars($row['firearm_serial_no']) ?><code> [<?= htmlspecialchars($row['number_of_rounds']) ?>]</code></td>
                                             <td onclick="openReturnModal(<?= $row['bookingID'] ?>, '<?= htmlspecialchars(trim($row['returns']), ENT_QUOTES, 'UTF-8') ?>', '<?= isset($row['number_of_rounds']) ? (int)$row['number_of_rounds'] : 0 ?>')" style="cursor:pointer;">
                                                <?php if(trim($row['returns']) === 'Returned'): ?>
                                                    <span class="badge badge-success bg-success text-white">
                                                        RETURNED <i class="mdi mdi-check-all ml-1"></i>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger bg-danger text-white">
                                                        NOT-RETURNED <i class="mdi mdi-alert-circle-outline ml-1"></i>
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td><?= htmlspecialchars($row['booking_time']) ?></td>
                                            <td><?= htmlspecialchars($row['duty_duration']) ?></td>
                                            <td>
                                                <button onclick="viewDetails(<?= $row['bookingID'] ?>)" class="btn btn-xs btn-outline-info">VIEW</button>
                                                <button onclick="confirmArchive(<?= $row['bookingID'] ?>)" class="btn btn-xs btn-outline-danger">DELETE</button>
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
        </div>
    </div>

    <div class="modal fade" id="detailsModal" tabindex="-1">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark border-info">
                <div class="modal-header border-info">
                    <h5 class="modal-title text-info">[ MISSION_RECAP ]</h5>
                    <button type="button" class="close text-dark" data-bs-dismiss="modal">&times;</button>
                </div>
                <div id="modalBody" class="modal-body text-white p-4"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="returnModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="process-return.php" method="POST" class="modal-content bg-dark border-info">
                <div class="modal-body p-4">
                    <h5 class="text-info mb-4">[ RETURN_BOOKING_STATUS ]</h5>
                    <input type="hidden" name="bookingID" id="ret_bookingID">
                    
                    <div class="form-group mb-3">
                        <label class="text-info small">STATUS_CODE</label>
                        <select name="return_status" id="ret_status_select" class="form-control text-white bg-black">
                            <option value="Not-Return">STILL DEPLOYED (NOT-RETURNED)</option>
                            <option value="Returned">RETURNED & RESTOCKED</option>
                        </select>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="text-info small">AMMO_ROUNDS_RETURNED_OR_LEFT</label>
                        <input type="number" name="ammo_returned" id="ammo_returned" class="form-control bg-black text-white" value="0" required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label class="text-info small">FIREARM_STATE</label>
                        <select name="firearm_state" class="form-control text-white bg-black">
                            <option value="Not-Faulty">NOT-FAULTY / FUNCTIONAL</option>
                            <option value="Faulty">FAULTY / DAMAGED</option>
                        </select>
                    </div>

                    <div class="form-group mb-3">
                        <label class="text-info small">REMARKS</label>
                        <textarea name="remarks" class="form-control bg-black text-white" rows="3" placeholder="Mission and asset observations..."></textarea>
                    </div>
                    
                    <div class="mt-4 d-flex justify-content-between">
                        <button type="button" class="btn btn-danger text-white" data-bs-dismiss="modal">ABORT</button>
                        <button type="submit" name="update_status" class="btn btn-tactical">CONFIRM_UPDATE</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1">
        <div class="modal-dialog">
            <form action="process-booking-crud.php" method="POST" class="modal-content bg-dark border-danger">
                <div class="modal-body p-4 text-center">
                    <i class="mdi mdi-alert-circle text-danger display-4"></i>
                    <h4 class="text-danger mt-3">[ Delete_RECORD ]</h4>
                    <p class="text-white">Are you sure you want to delete this booking?</p>
                    <input type="hidden" name="delete_id" id="delete_id">
                    <div class="mt-4 d-flex justify-content-between">
                        <button type="button" class="btn btn-primary text-white" data-bs-dismiss="modal">ABORT</button>
                        <button type="submit" name="soft_delete" class="btn btn-danger">DELETE_RECORD</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#mainTable').DataTable({
                dom: '<"row"<"col-sm-12 col-md-4"l><"col-sm-12 col-md-4"f><"col-sm-12 col-md-4"B>>' +
                     '<"row"<"col-sm-12"tr>>' +
                     '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
                buttons: [
                    { extend: 'excel', text: '<i class="mdi mdi-file-excel"></i> EXCEL', className: 'btn btn-tactical btn-sm mx-1' },
                    { extend: 'pdf', text: '<i class="mdi mdi-file-pdf"></i> PDF', className: 'btn btn-tactical btn-sm mx-1' },
                    { extend: 'print', text: '<i class="mdi mdi-printer"></i> PRINT', className: 'btn btn-tactical btn-sm mx-1' }
                ],
                pagingType: "full_numbers",
                language: {
                    search: "[SCAN]:",
                    paginate: {
                        first: '<i class="mdi mdi-chevron-double-left"></i>',
                        last: '<i class="mdi mdi-chevron-double-right"></i>',
                        next: '<i class="mdi mdi-chevron-right"></i>',
                        previous: '<i class="mdi mdi-chevron-left"></i>'
                    }
                }
            });

            // Toast Notification
            const params = new URLSearchParams(window.location.search);
            if(params.has('status')) {
                let status = params.get('status');
                $(`<div class="t-toast">[SIGNAL]: ${status === 'success' ? 'TRANSACTION_COMMITTED' : 'TRANSACTION_FAILED'}</div>`)
                    .appendTo('#toast-container')
                    .css('display', 'block')
                    .css('border-left', status === 'success' ? '5px solid var(--neon)' : '5px solid var(--danger)')
                    .delay(3500)
                    .fadeOut(function(){ $(this).remove(); });
            }
        });

        function viewDetails(id) {
            $('#modalBody').html('<div class="text-center p-5"><i class="mdi mdi-loading mdi-spin" style="font-size:30px; color:var(--neon);"></i></div>');
            $('#modalBody').load('fetch-booking-details.php?id=' + id);
            $('#detailsModal').modal('show');
        }

        function openReturnModal(id, status, rounds) {
            $('#ret_bookingID').val(id);
            $('#ret_status_select').val(status);
            $('#ammo_returned').val(rounds);
            $('#returnModal').modal('show');
        }

        function confirmArchive(id) {
            $('#delete_id').val(id);
            $('#deleteModal').modal('show');
        }
    </script>
</body>
</html>