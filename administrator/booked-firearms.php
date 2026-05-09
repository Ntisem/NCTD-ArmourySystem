<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

// Access Control
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

/** 1. OVERDUE LOGIC: Check for deployments > 24hrs */
$overdue_check = $pdo->query("SELECT COUNT(*) FROM bookings WHERE TRIM(returns) = 'Not-Return' AND is_deleted = 0 AND STR_TO_DATE(booking_time, '%M %e, %Y') < DATE_SUB(NOW(), INTERVAL 24 HOUR)");
$overdue_count = $overdue_check->fetchColumn();

/** 2. DYNAMIC FILTERING & SEARCH */
$firearm_name_filter = $_GET['firearm-name'] ?? null; 
$startDate = $_GET['start_date'] ?? null;
$endDate = $_GET['end_date'] ?? null;

$query = "SELECT * FROM bookings WHERE is_deleted = 0";
$params = [];

if (!empty($firearm_name_filter)) {
    $query .= " AND firearm_name = ?";
    $params[] = $firearm_name_filter;
}

if (!empty($startDate) && !empty($endDate)) {
    $query .= " AND STR_TO_DATE(booking_time, '%M %e, %Y') BETWEEN ? AND ?";
    $params[] = $startDate;
    $params[] = $endDate;
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
    <title>COMMAND_LOG | FIREARM_DEPLOYMENT</title>
    
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@300;500&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    
    <style>
        :root { 
            --neon: #00f2ff; --amber: #f9a602; --bg: #05070a; 
            --card: #0d1117; --danger: #ff3e3e; --tactical-blue: rgba(0, 242, 255, 0.1);
        }

        body { background: var(--bg); font-family: 'Roboto Mono', monospace; color: #c0c5ce; }

        /* --- FIXED LANDSCAPE GRID DROPDOWN --- */
        .weapon-select-wrapper { position: relative; }
        
        .btn-dropdown-tactical {
            background: #000; border: 1px solid var(--neon); color: var(--neon);
            letter-spacing: 2px; text-transform: uppercase; padding: 12px 30px;
            font-family: 'Orbitron', sans-serif; font-weight: bold; cursor: pointer;
        }

        .dropdown-menu-tactical {
            display: none; /* Hidden by default */
            position: absolute; background: rgba(10, 13, 18, 0.98);
            border: 2px solid var(--neon); min-width: 850px; padding: 20px;
            z-index: 9999; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.9);
            /* GRID FIX: Forces alignment */
            grid-template-columns: repeat(4, 1fr); gap: 10px;
        }

        .dropdown-menu-tactical.active { display: grid !important; }

        .dropdown-header-full { grid-column: 1 / -1; border-bottom: 1px solid #333; padding-bottom: 8px; margin-bottom: 5px; }

        .dropdown-item-tactical {
            background: rgba(255,255,255,0.03); border-left: 3px solid var(--amber);
            color: #fff !important; padding: 10px; font-size: 11px; text-decoration: none;
            display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
        }

        .dropdown-item-tactical:hover, .dropdown-item-active {
            background: var(--neon) !important; color: #000 !important; border-left-color: #fff;
        }

        /* Tactical UI elements */
        .tactical-card { background: var(--card) !important; border: 1px solid rgba(0, 242, 255, 0.2); border-radius: 0; }
        .table { color: #e0e0e0; }
        #toast-container { position: fixed; top: 80px; right: 20px; z-index: 10000; }
        .t-toast { background: #000; border: 1px solid var(--neon); color: #fff; padding: 15px; border-left: 5px solid var(--neon); display: none; }
        .badge-tactical { border-radius: 0; font-family: 'Orbitron'; font-size: 10px; letter-spacing: 1px; }
        .btn-tactical { border-radius: 0; font-family: 'Orbitron'; background: transparent; border: 1px solid var(--neon); color: var(--neon); }
        .btn-tactical:hover { background: var(--neon); color: #000; }
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
                    <div class="alert alert-danger bg-dark text-white mb-4 d-flex justify-content-between align-items-center" style="border-left: 5px solid var(--danger) !important; border-radius:0;">
                        <div><i class="mdi mdi-alert-octagon text-danger mr-2"></i> SIGNAL_ALERT: <?php echo $overdue_count; ?> ASSETS OVERDUE.</div>
                        <a href="overdue-bookings.php" class="btn btn-sm btn-danger" style="border-radius:0;">INTERCEPT</a>
                    </div>
                    <?php endif; ?>

                    <div class="tactical-card card mb-4">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                                <div class="weapon-select-wrapper">
                                    <button class="btn btn-dropdown-tactical" id="weaponBtn">[ SELECT_WEAPON_SYSTEM ]</button>
                                    <div class="dropdown-menu-tactical" id="weaponMenu">
                                        <div class="dropdown-header-full"><small class="text-muted" style="letter-spacing:3px;">ARMORY_STOCKS</small></div>
                                        <a href="booked-firearms.php" class="dropdown-item-tactical <?= is_null($firearm_name_filter) ? 'dropdown-item-active' : '' ?>">ALL_SYSTEMS_LOG</a>
                                        <?php
                                        $stmt_names = $pdo->query("SELECT firearm_name FROM `firearm_name` ORDER BY `firearm_name` ASC");
                                        while ($n_row = $stmt_names->fetch(PDO::FETCH_ASSOC)) {
                                            $isActive = ($firearm_name_filter == $n_row['firearm_name']) ? 'dropdown-item-active' : '';
                                            echo '<a href="booked-firearms.php?firearm-name=' . urlencode($n_row['firearm_name']) . '" class="dropdown-item-tactical ' . $isActive . '">' . htmlspecialchars($n_row['firearm_name']) . '</a>';
                                        }
                                        ?>
                                    </div>
                                </div>
                                <form method="GET" class="d-flex gap-2 bg-black p-2 border border-secondary">
                                    <input type="hidden" name="firearm-name" value="<?= htmlspecialchars($firearm_name_filter ?? '') ?>">
                                    <input type="date" name="start_date" class="form-control bg-dark text-white border-secondary" value="<?= $startDate ?>">
                                    <input type="date" name="end_date" class="form-control bg-dark text-white border-secondary" value="<?= $endDate ?>">
                                    <button type="submit" class="btn btn-tactical px-3">SCAN</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="tactical-card card">
                        <div class="card-body d-flex justify-content-between align-items-center border-bottom border-secondary mb-3">
                            <h4 class="text-neon mb-0" style="font-family:'Orbitron';">Deployment_Registry_Log</h4>
                            <div>
                                <a href="not-returns-firearms" class="btn btn-tactical py-1" title="Unreturned Firearms"><i class="mdi mdi-pistol"></i></a>
                                <a href="not-returns-ammo" class="btn btn-tactical py-1 ml-1" title="Unreturned Ammo"><i class="mdi mdi-ammunition"></i></a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mainTable" class="table table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th><th>OFFICER_NAME</th><th>WEAPON</th><th>SERIAL/RDS</th><th>STATUS</th><th>DEPLOY_TIME</th><th>ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach($bookings as $row): ?>
                                        <tr>
                                            <td><?= $i++ ?></td> 
                                            <td>
                                                <a href="officer-profile.php?id=<?= $row['officerID'] ?>" class="text-info font-weight-bold" style="text-decoration:none;">
                                                    <?= htmlspecialchars($row['to_officer']) ?>
                                                </a>
                                            </td>
                                            <td class="text-amber"><?= htmlspecialchars($row['firearm_name']) ?></td>
                                            <td><?= htmlspecialchars($row['firearm_serial_no']) ?> <span class="text-neon ml-1">[<?= $row['number_of_rounds'] ?>]</span></td>
                                            <td onclick="openReturnModal(<?= $row['bookingID'] ?>, '<?= htmlspecialchars(trim($row['returns']), ENT_QUOTES, 'UTF-8') ?>', '<?= (int)$row['number_of_rounds'] ?>')" style="cursor:pointer;">
                                                <span class="badge badge-tactical <?= trim($row['returns'])==='Returned' ? 'bg-success' : 'bg-danger' ?>">
                                                    <?= strtoupper($row['returns']) ?>
                                                </span>
                                            </td>
                                            <td style="font-size:11px;"><?= $row['booking_time'] ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button onclick="viewDetails(<?= $row['bookingID'] ?>)" class="btn btn-tactical py-1">VIEW</button>
                                                    <button onclick="confirmArchive(<?= $row['bookingID'] ?>)" class="btn btn-outline-danger py-1" style="border-radius:0; border-left:none;"><i class="mdi mdi-delete"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include_once('includes/footer.php');?>
            </div>
        </div>
    </div>

   <div class="modal fade" id="detailsModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content bg-dark border-info" style="border-radius:0;">
                <div class="modal-header border-info">
                    <h5 class="modal-title text-info" style="font-family:'Orbitron';">[ MISSION_DEBRIEF ]</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div id="modalBody" class="modal-body text-white p-4"></div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="returnModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="process-return.php" method="POST" class="modal-content bg-dark border-info" style="border-radius:0;">
                <div class="modal-body p-4">
                    <h5 class="text-info mb-4" style="font-family:'Orbitron';">[ ASSET_RECOVERY_FORM ]</h5>
                    <input type="hidden" name="bookingID" id="ret_bookingID">
                    <div class="form-group mb-3">
                        <label class="text-muted small">STATUS_CODE</label>
                        <select name="return_status" id="ret_status_select" class="form-control text-white bg-black border-secondary">
                            <option value="Not-Return">STILL DEPLOYED (NOT-RETURNED)</option>
                            <option value="Returned">RETURNED & RESTOCKED</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="text-muted small">MUNITION_COUNT_RECOVERED</label>
                        <input type="number" name="ammo_returned" id="ammo_returned" class="form-control bg-black text-white border-secondary" required>
                    </div>
                    <div class="form-group mb-3">
                        <label class="text-muted small">HARDWARE_INTEGRITY</label>
                        <select name="firearm_state" class="form-control text-white bg-black border-secondary">
                            <option value="Not-Faulty">NOT-FAULTY / COMBAT READY</option>
                            <option value="Faulty">FAULTY / REQUIRES MAINTENANCE</option>
                        </select>
                    </div>
                    <div class="form-group mb-3">
                        <label class="text-muted small">ARMOURER_NOTES</label>
                        <textarea name="remarks" class="form-control bg-black text-white border-secondary" rows="3"></textarea>
                    </div>
                    <div class="mt-4 d-flex justify-content-between">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-radius:0;">ABORT</button>
                        <button type="submit" name="update_status" class="btn btn-tactical">COMMIT_CHANGES</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <form action="process-booking-crud.php" method="POST" class="modal-content bg-dark border-danger" style="border-radius:0;">
                <div class="modal-body p-4 text-center">
                    <i class="mdi mdi-alert-circle-outline text-danger" style="font-size:50px;"></i>
                    <h4 class="text-danger mt-3" style="font-family:'Orbitron';">[ PURGE_RECORD ]</h4>
                    <p class="text-muted small">CRITICAL: This will remove the deployment record from the active database log.</p>
                    <input type="hidden" name="delete_id" id="delete_id">
                    <div class="mt-4 d-flex justify-content-between">
                        <button type="button" class="btn btn-tactical" data-bs-dismiss="modal">CANCEL</button>
                        <button type="submit" name="soft_delete" class="btn btn-danger" style="border-radius:0;">CONFIRM_PURGE</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

    <script>
        $(document).ready(function() {
            // DataTables with full exports
            $('#mainTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    { extend: 'excel', className: 'btn btn-tactical btn-sm' },
                    { extend: 'pdf', className: 'btn btn-tactical btn-sm' },
                    { extend: 'csv', className: 'btn btn-tactical btn-sm' },
                    { extend: 'print', className: 'btn btn-tactical btn-sm' }
                ],
                language: { search: "SYSTEM_SCAN:" }
            });

            // DROPDOWN LOGIC: Toggle and Close on click outside or selection
            $('#weaponBtn').on('click', function(e) {
                e.stopPropagation();
                $('#weaponMenu').toggleClass('active');
            });

            $(document).on('click', function() {
                $('#weaponMenu').removeClass('active');
            });

            $('.dropdown-item-tactical').on('click', function() {
                $('#weaponMenu').removeClass('active');
            });

            // Toast Alerts
            const urlParams = new URLSearchParams(window.location.search);
            if(urlParams.has('status')) {
                let msg = urlParams.get('status') === 'success' ? 'TRANSACTION_COMMITTED' : 'ERROR: ABORTED';
                let toast = $(`<div class="t-toast">[SIGNAL]: ${msg}</div>`);
                $('#toast-container').append(toast);
                toast.fadeIn().delay(3500).fadeOut(function(){ $(this).remove(); });
            }
        });

        function viewDetails(id) { 
            $('#modalBody').html('<div class="text-center p-5"><i class="mdi mdi-loading mdi-spin" style="font-size:30px; color:var(--neon);"></i><p>DECRYPTING...</p></div>');
            $('#modalBody').load('fetch-booking-details.php?id=' + id); 
            $('#detailsModal').modal('show'); 
        }
        function openReturnModal(id, status, rounds) { $('#ret_bookingID').val(id); $('#ret_status_select').val(status); $('#ammo_returned').val(rounds); $('#returnModal').modal('show'); }
        function confirmArchive(id) { $('#delete_id').val(id); $('#deleteModal').modal('show'); }
    </script>
</body>
</html>