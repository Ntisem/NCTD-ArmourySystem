<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login.php");
    exit();
}

$officerID = $_GET['officerID'] ?? null;
if(!$officerID) {
    header("location: officer-details");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM officers WHERE officerID = ?");
$stmt->execute([$officerID]);
$officer = $stmt->fetch();

if(!$officer) {
    header("location: officer-details");
    exit();
}

$stmt_bookings = $pdo->prepare("SELECT * FROM bookings WHERE officerID = ? ORDER BY bookingID DESC");
$stmt_bookings->execute([$officerID]);
$bookings = $stmt_bookings->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>COMMAND_TERMINAL | OFFICER_TRACKING</title>
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
            --input-border: #00f2ff; 
            --danger: #ff3333; 
            --success: #00ff66;
            --text-main: #e0e0e0;
        }

        body { 
            background: var(--bg-deep); 
            font-family: 'JetBrains Mono', monospace; 
            color: var(--text-main); 
        }

        .tactical-card {
            background: var(--card-bg);
            border: 1px solid var(--neon);
            border-radius: 4px;
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.1);
            color: var(--text-main);
        }

        .tactical-table {
            color: var(--text-main) !important;
        }

        .tactical-table th, .tactical-table td {
            border-color: rgba(0, 242, 255, 0.2) !important;
        }

        .tactical-table tbody tr:hover {
            background: rgba(0, 242, 255, 0.05);
        }

        .btn-tactical {
            background: transparent;
            border: 1px solid var(--neon);
            color: var(--neon);
            font-family: 'JetBrains Mono', monospace;
        }

        .btn-tactical:hover {
            background: var(--neon);
            color: #000;
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card tactical-card">
                                <div class="card-body d-flex justify-content-between align-items-center">
                                    <h3><i class="mdi mdi-account-card-details text-info"></i> OFFICER_BOOKING_TRACKING</h3>
                                    <a href="officers-list" class="btn btn-tactical"><i class="mdi mdi-arrow-left"></i> BACK_TO_DIRECTORY</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4">
                            <div class="card tactical-card h-100">
                                <div class="card-body text-center">
                                    <?php if (!empty($officer['officer_image']) && file_exists('../assets/images/officer_images/' . $officer['officer_image'])): ?>
                                        <img src="../assets/images/officer_images/<?= $officer['officer_image'] ?>" width="120" height="120" class="rounded-circle mb-3 border border-info">
                                    <?php else: ?>
                                        <i class="mdi mdi-account-circle text-info mb-3" style="font-size: 100px;"></i>
                                    <?php endif; ?>
                                    <h4 class="text-info"><?= htmlspecialchars($officer['full_name']) ?></h4>
                                    <p class="text-muted"><?= htmlspecialchars($officer['rank']) . " | " . htmlspecialchars($officer['officer_service_no']) ?></p>
                                    <hr style="border-color: var(--neon)">
                                    <p><strong>Dept:</strong> <?= htmlspecialchars($officer['dept_unit']) ?></p>
                                    <p><strong>Phone:</strong> <?= htmlspecialchars($officer['phone_no']) ?></p>
                                    <p><strong>Email:</strong> <?= htmlspecialchars($officer['officer_email']) ?></p>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="card tactical-card">
                                <div class="card-body">
                                    <h4 class="card-title text-info">DEPLOYMENT_LOG</h4>
                                    <div class="table-responsive">
                                        <table class="table table-bordered tactical-table" id="bookingsTable">
                                            <thead>
                                                <tr>
                                                    <th>Code</th>
                                                    <th>Firearm</th>
                                                    <th>Ammo</th>
                                                    <th>Rounds</th>
                                                    <th>Booking Time</th>
                                                    <th>Return Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($bookings as $b): ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($b['bookingCode']) ?></td>
                                                        <td><?= htmlspecialchars($b['firearm_name'] ?? 'N/A') ?> (<?= htmlspecialchars($b['firearm_serial_no'] ?? 'N/A') ?>)</td>
                                                        <td><?= htmlspecialchars($b['ammunition_name'] ?? 'N/A') ?></td>
                                                        <td><?= htmlspecialchars($b['number_of_rounds'] ?? 0) ?></td>
                                                        <td><?= htmlspecialchars($b['booking_time']) ?></td>
                                                        <td>
                                                            <?php if ($b['returns'] == 'Returned'): ?>
                                                                <span class="badge badge-success">Returned</span>
                                                            <?php else: ?>
                                                                <span class="badge badge-danger">Not Returned</span>
                                                            <?php endif; ?>
                                                        </td>
                                                        <td>
                                                            <?php if ($b['returns'] !== 'Returned'): ?>
                                                                <button class="btn btn-sm btn-tactical" onclick="openReturnModal(<?= $b['bookingID'] ?>, '<?= $b['returns'] ?>', <?= $b['number_of_rounds'] ?>)">
                                                                    <i class="mdi mdi-checkbox-marked-circle-outline"></i> Return
                                                                </button>
                                                            <?php endif; ?>
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
                <div class="text-center mt-4">
                    <small style="color: #555; font-size: 10px;">COMMAND NCTD // OFFICER_TRACKING_MODULE</small>
                 
                    </div>
                       <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="returnModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content bg-dark text-light border-info">
                <div class="modal-header border-info">
                    <h5 class="modal-title text-info"><i class="mdi mdi-keyboard-return"></i> ASSET_RETURN_UPDATE</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="process-return.php" method="POST">
                    <div class="modal-body">
                        <input type="hidden" name="bookingID" id="ret_bookingID">
                        <input type="hidden" name="officerID" value="<?= $officerID ?>">
                        <div class="form-group">
                            <label>Update Status</label>
                            <select name="return_status" id="ret_status_select" class="form-control bg-dark text-light border-info">
                                <option value="Returned">Returned</option>
                                <option value="Not-Return">Not-Return</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Ammo Returned</label>
                            <input type="number" name="ammo_returned" id="ammo_returned" class="form-control bg-dark text-light border-info" min="0" required>
                        </div>
                        <div class="form-group">
                            <label>Firearm State</label>
                            <select name="firearm_state" class="form-control bg-dark text-light border-info">
                                <option value="Not-Faulty">Not-Faulty</option>
                                <option value="Faulty">Faulty</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Remarks/Comments</label>
                            <textarea name="remarks" class="form-control bg-dark text-light border-info" rows="3"></textarea>
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

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#bookingsTable').DataTable();
        });

        function openReturnModal(id, status, rounds) {
            $('#ret_bookingID').val(id);
            $('#ret_status_select').val(status);
            $('#ammo_returned').val(rounds);
            $('#returnModal').modal('show');
        }
    </script>
</body>
</html>