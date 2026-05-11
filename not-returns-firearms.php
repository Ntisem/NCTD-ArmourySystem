<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

// 1. SEARCH LOGIC
$startDate = $_GET['start_date'] ?? null;
$endDate = $_GET['end_date'] ?? null;

$query = "SELECT * FROM bookings WHERE TRIM(returns) = 'Not-Return' AND is_deleted = 0";
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>COMMAND_TERMINAL | OUTSTANDING_FIREARMS</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root { 
            --neon: #00f2ff; 
            --bg-deep: #020408; 
            --card-bg: #0a0d12; 
            --danger: #ff3333; 
        }
        body { background: var(--bg-deep); font-family: 'JetBrains Mono', monospace; color: #e0e0e0; }
        .card { background: var(--card-bg); border: 1px solid #00f2ff50; }
        .table { color: #fff; }
        th { color: var(--neon); }
        .table td { vertical-align: middle; }
        .btn-tactical {
            background: transparent;
            border: 1px solid var(--neon);
            color: var(--neon);
            border-radius: 4px;
            font-family: inherit;
        }
        .btn-tactical:hover {
            background: var(--neon);
            color: var(--bg-deep);
        }
        .btn-danger-tactical {
            background: transparent;
            border: 1px solid var(--danger);
            color: var(--danger);
            border-radius: 4px;
            font-family: inherit;
        }
        .btn-danger-tactical:hover {
            background: var(--danger);
            color: #fff;
        }
        .t-toast {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 9999;
            background: var(--bg-deep);
            border: 1px solid var(--neon);
            border-left: 5px solid var(--neon);
            color: #fff;
            padding: 15px;
            border-radius: 4px;
            display: none;
            font-family: 'JetBrains Mono', monospace;
            box-shadow: 0 0 10px rgba(0, 242, 255, 0.2);
        }
        .modal-content {
            background: var(--bg-deep);
            border: 1px solid var(--neon);
        }
        .form-control {
            background-color: var(--card-bg);
            border: 1px solid #00f2ff50;
            color: #fff;
            font-family: inherit;
        }
        .form-control:focus {
            background-color: var(--card-bg);
            color: #fff;
            border-color: var(--neon);
            box-shadow: 0 0 5px var(--neon);
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel p-4 w-100">
                
                <div id="toast-container"></div>

                <div class="card mb-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h4 class="text-info mb-0">
                            <i class="mdi mdi-alert-circle text-warning"></i> OUTSTANDING_FIREARMS_LOG
                        </h4>
                        <div>
                            <a href="javascript:history.back();" class="btn btn-tactical">
                                <i class="mdi mdi-arrow-left"></i> BACK
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <form method="GET" class="form-inline mb-4">
                            <label class="mr-2 text-info">FROM:</label>
                            <input type="date" name="start_date" class="form-control mr-3" value="<?= htmlspecialchars($startDate ?? '') ?>">
                            <label class="mr-2 text-info">TO:</label>
                            <input type="date" name="end_date" class="form-control mr-3" value="<?= htmlspecialchars($endDate ?? '') ?>">
                            <button type="submit" class="btn btn-tactical"><i class="mdi mdi-filter"></i> FILTER_LOGS</button>
                            <?php if(!empty($startDate) || !empty($endDate)): ?>
                                <a href="not-returns-firearms.php" class="btn btn-danger-tactical ml-2">CLEAR</a>
                            <?php endif; ?>
                        </form>

                        <div class="table-responsive">
                            <table id="mainTable" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Time</th>
                                        <th>Officer</th>
                                        <th>Firearm</th>
                                        <th>Armourer</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($bookings)): ?>
                                        <?php foreach ($bookings as $i => $b): ?>
                                            <tr>
                                                <td><?= $i + 1 ?></td>
                                                <td><?= htmlspecialchars($b['booking_time']) ?></td>
                                                <td><?= htmlspecialchars($b['to_officer']) ?></td>
                                                <td><?= htmlspecialchars($b['firearm_name'] . ' - ' . $b['firearm_serial_no']) ?></td>
                                                <td><?= htmlspecialchars($b['armourer_issuer']) ?></td>
                                                <td><span class="badge badge-warning"><?= htmlspecialchars($b['returns']) ?></span></td>
                                                <td>
                                                    <button class="btn btn-tactical btn-sm" onclick="viewDetails(<?= $b['bookingID'] ?>)" title="View Details">
                                                        <i class="mdi mdi-eye"></i>
                                                    </button>
                                                    <a href="officer-details.php?officerID=<?= htmlspecialchars($b['officerID']) ?>" class="btn btn-tactical btn-sm" title="Officer Tracking">
                                                        <i class="mdi mdi-account-search"></i>
                                                    </a>
                                                    <button class="btn btn-tactical btn-sm" onclick="openReturnModal(<?= $b['bookingID'] ?>, 'Returned', <?= htmlspecialchars($b['number_of_rounds'] ?? 0) ?>)" title="Return Asset">
                                                        <i class="mdi mdi-undo-variant"></i>
                                                    </button>

                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php require_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detailsModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content border-info">
                <div class="modal-header border-info">
                    <h5 class="modal-title text-info"><i class="mdi mdi-file-document"></i> BOOKING_DETAILS</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="modalBody"></div>
                <div class="modal-footer border-info">
                    <button type="button" class="btn btn-danger-tactical" data-dismiss="modal">CLOSE</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-info">
                <div class="modal-header border-info">
                    <h5 class="modal-title text-warning"><i class="mdi mdi-undo-variant"></i> PROCESS_ASSET_RECOVERY</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="process-return.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="bookingID" id="ret_bookingID">
                        <div class="form-group">
                            <label class="text-info">Update Status</label>
                            <select name="return_status" id="ret_status_select" class="form-control bg-dark text-light">
                                <option value="Returned">Returned</option>
                                <option value="Not-Return">Not-Return</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-info">Ammo Returned / Leftover Rounds</label>
                            <input type="number" name="ammo_returned" id="ammo_returned" class="form-control" min="0" required>
                        </div>
                        <div class="form-group">
                            <label class="text-info">Firearm State</label>
                            <select name="firearm_state" class="form-control bg-dark text-light">
                                <option value="Not-Faulty">Not-Faulty</option>
                                <option value="Faulty">Faulty</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label class="text-info">Remarks/Comments</label>
                            <textarea name="remarks" class="form-control bg-dark text-light" rows="3" placeholder="State observations..."></textarea>
                        </div>
                    </div>
                    <div class="modal-footer border-info">
                        <button type="button" class="btn btn-danger-tactical" data-dismiss="modal">CANCEL</button>
                        <button type="submit" name="update_status" class="btn btn-tactical">COMMIT_CHANGE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content border-danger">
                <div class="modal-header border-danger">
                    <h5 class="modal-title text-danger"><i class="mdi mdi-alert-outline"></i> CONFIRM_ARCHIVE</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="process-booking-crud.php" method="POST">
                    <div class="modal-body text-light">
                        <p>Are you sure you want to archive this deployment record?</p>
                        <input type="hidden" name="delete_id" id="delete_id">
                    </div>
                    <div class="modal-footer border-danger">
                        <button type="button" class="btn btn-tactical" data-dismiss="modal">CANCEL</button>
                        <button type="submit" name="soft_delete" class="btn btn-danger-tactical">ARCHIVE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#mainTable').DataTable({
                "responsive": true,
                "autoWidth": false,
                "pageLength": 10
            });

            const params = new URLSearchParams(window.location.search);
            if (params.has('status')) {
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