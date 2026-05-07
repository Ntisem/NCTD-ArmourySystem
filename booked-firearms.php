<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

// Access Control
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

/** * 1. OVERDUE LOGIC: Check for deployments > 24hrs 
 */
$overdue_check = $pdo->query("SELECT COUNT(*) FROM bookings WHERE TRIM(returns) = 'Not-Return' AND is_deleted = 0 AND STR_TO_DATE(booking_time, '%M %e, %Y') < DATE_SUB(NOW(), INTERVAL 24 HOUR)");
$overdue_count = $overdue_check->fetchColumn();

/** * 2. DYNAMIC FILTERING LOGIC
 * Retrieves 'firearm-name' from URL for dynamic query filtering
 */
$firearm_name_filter = $_GET['firearm-name'] ?? null; 
$startDate = $_GET['start_date'] ?? null;
$endDate = $_GET['end_date'] ?? null;

// Base Query
$query = "SELECT * FROM bookings WHERE is_deleted = 0";
$params = [];

// Apply URL Parameter Filter
if (!empty($firearm_name_filter)) {
    $query .= " AND firearm_name = ?";
    $params[] = $firearm_name_filter;
}

// Apply Date Range Filter
if (!empty($startDate) && !empty($endDate)) {
    $query .= " AND STR_TO_DATE(booking_time, '%M %e, %Y') BETWEEN ? AND ?";
    $params[] = $startDate;
    $params[] = $endDate;
}

// Sorting: Descending order by bookingID
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
    
    <style>
        :root { 
            --neon: #00f2ff; 
            --amber: #f9a602;
            --bg: #05070a; 
            --card: #0d1117; 
            --danger: #ff3e3e; 
            --success: #28a745;
            --tactical-blue: rgba(0, 242, 255, 0.1);
        }

        body { 
            background: var(--bg); 
            font-family: 'Roboto Mono', monospace; 
            color: #c0c5ce; 
        }
            /* Ensure dropdown is hidden by default and only shows with the .show class */
            .dropdown-menu-tactical {
                display: none !important;
                position: absolute;
                /* ... existing styles ... */
            }

            .dropdown-menu-tactical.show {
                display: flex !important; /* Use flex to maintain your landscape layout */
            }
        /* Tactical HUD Card */
        .tactical-card { 
            background: var(--card) !important; 
            border: 1px solid rgba(0, 242, 255, 0.2); 
            border-radius: 0; 
            box-shadow: 0 0 20px rgba(0,0,0,0.8);
            margin-bottom: 25px;
        }

        .card-title-tactical {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon);
            letter-spacing: 2px;
            font-size: 1rem;
            text-transform: uppercase;
        }

        /* --- REDESIGNED LANDSCAPE DROPDOWN --- */
        .weapon-select-wrapper { position: relative; }
        
        .btn-dropdown-tactical {
            background: #000;
            border: 1px solid var(--neon);
            color: var(--neon);
            letter-spacing: 2px;
            text-transform: uppercase;
            padding: 12px 30px;
            font-weight: bold;
            font-family: 'Orbitron', sans-serif;
            transition: 0.4s;
            position: relative;
            z-index: 1001; /* Ensure button is above table */
        }

        .btn-dropdown-tactical:hover, .btn-dropdown-tactical:focus {
            background: var(--neon);
            color: #000;
            box-shadow: 0 0 20px rgba(0, 242, 255, 0.4);
        }

        .dropdown-menu-tactical {
            background: rgba(10, 13, 18, 0.98) !important;
            border: 2px solid var(--neon) !important;
            min-width: 650px; 
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.9);
            backdrop-filter: blur(15px);
            z-index: 9999 !important; /* Force to top of all elements */
        }

        .dropdown-item-tactical {
            flex: 1 1 190px;
            background: rgba(255,255,255,0.03);
            border-left: 3px solid var(--amber);
            color: #fff !important;
            padding: 12px;
            font-size: 11px;
            text-transform: uppercase;
            transition: 0.3s;
            border-radius: 0;
            margin-bottom: 5px;
        }

        .dropdown-item-tactical:hover, .dropdown-item-active {
            background: var(--neon) !important;
            color: #000 !important;
            transform: translateX(5px);
            border-left-color: #fff;
        }

        /* Table Styling */
        .table { color: #e0e0e0; border-collapse: separate; border-spacing: 0 5px; }
        .table thead th { 
            background: var(--tactical-blue); 
            color: var(--neon); 
            border: none;
            font-family: 'Orbitron', sans-serif;
            font-size: 10px;
            padding: 15px;
        }
        .table tbody tr { background: rgba(255,255,255,0.02); transition: 0.3s; }
        .table tbody tr:hover { background: rgba(0, 242, 255, 0.05); }
        .table td { border: none; vertical-align: middle; padding: 12px; border-top: 1px solid rgba(255,255,255,0.05); }

        .btn-tactical { 
            border: 1px solid var(--neon); 
            color: var(--neon); 
            border-radius: 0; 
            background: transparent; 
            font-size: 10px;
            text-transform: uppercase;
            transition: 0.3s; 
        }
        .btn-tactical:hover { background: var(--neon); color: #000; }

        /* Status Badges */
        .badge-tactical { 
            border-radius: 0; 
            font-size: 9px; 
            padding: 6px 10px; 
            letter-spacing: 1px; 
            font-family: 'Roboto Mono', monospace; 
        }

        /* Toast UI */
        #toast-container { position: fixed; top: 80px; right: 20px; z-index: 10000; }
        .t-toast { 
            background: #000; 
            border: 1px solid var(--neon); 
            color: #fff; 
            padding: 15px 25px; 
            margin-bottom: 10px; 
            border-left: 5px solid var(--neon); 
            box-shadow: 0 0 20px rgba(0, 242, 255, 0.3);
            font-size: 12px;
            display: none;
        }

        /* DataTables Export Buttons Overrides */
        .dt-buttons .btn {
            margin: 2px;
            border-radius: 0 !important;
            font-size: 10px !important;
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
                    <div class="alert alert-danger border-danger bg-dark text-white mb-4 d-flex justify-content-between align-items-center" style="border-left: 5px solid var(--danger) !important; border-radius:0;">
                        <div>
                            <i class="mdi mdi-alert-octagon text-danger mr-2"></i>
                            <span style="font-family:'Orbitron';">SIGNAL_ALERT:</span> <?php echo $overdue_count; ?> ASSETS EXCEEDED 24HR DEPLOYMENT WINDOW.
                        </div>
                        <a href="overdue-bookings.php" class="btn btn-sm btn-danger" style="border-radius:0; font-size:10px;">INTERCEPT</a>
                    </div>
                    <?php endif; ?>

                    <div class="tactical-card card">
                        <div class="card-body">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                             <div class="dropdown weapon-select-wrapper">
                                <button class="btn btn-dropdown-tactical dropdown-toggle" type="button" id="weaponDropdown">
                                    [ SELECT_WEAPON_SYSTEM ]
                                </button>
                                <div class="dropdown-menu dropdown-menu-tactical" aria-labelledby="weaponDropdown">

                                        <div class="w-100 mb-2 border-bottom border-secondary pb-2">
                                            <small class="text-muted ml-2" style="letter-spacing:3px;">ARMORY_STOCKS</small>
                                        </div>
                                        <a href="booked-firearms.php" class="dropdown-item-tactical <?= is_null($firearm_name_filter) ? 'dropdown-item-active' : '' ?>">
                                            <i class="mdi mdi-database mr-1"></i> ALL_SYSTEMS_LOG
                                        </a>
                                        <?php
                                        try {
                                            $stmt_names = $pdo->query("SELECT firearm_name FROM `firearm_name` ORDER BY `firearm_name` ASC");
                                            while ($n_row = $stmt_names->fetch(PDO::FETCH_ASSOC)) {
                                                $f_name = htmlspecialchars($n_row['firearm_name']);
                                                $encoded = urlencode($n_row['firearm_name']);
                                                $isActive = ($firearm_name_filter == $n_row['firearm_name']) ? 'dropdown-item-active' : '';
                                                echo '<a href="booked-firearms.php?firearm-name=' . $encoded . '" class="dropdown-item-tactical ' . $isActive . '">' . $f_name . '</a>';
                                            }
                                        } catch (PDOException $e) { echo '<small class="text-danger">LINK_FAILURE</small>'; }
                                        ?>
                                    </div>
                                </div>

                                <?php if($firearm_name_filter): ?>
                                    <div class="text-info font-weight-bold p-2 px-3" style="background: rgba(0, 242, 255, 0.05); border: 1px solid var(--neon); font-size: 11px;">
                                        ACTIVE_SCAN: <?= htmlspecialchars($firearm_name_filter) ?>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <form method="GET" class="row g-2 align-items-end bg-black p-3 border border-secondary">
                                <input type="hidden" name="firearm-name" value="<?= htmlspecialchars($firearm_name_filter ?? '') ?>">
                                <div class="col-md-3">
                                    <label class="small text-muted" style="font-size:9px;">PERIOD_START</label>
                                    <input type="date" name="start_date" class="form-control bg-dark text-white border-secondary" value="<?= htmlspecialchars($startDate ?? '') ?>" style="border-radius:0;">
                                </div>
                                <div class="col-md-3">
                                    <label class="small text-muted" style="font-size:9px;">PERIOD_END</label>
                                    <input type="date" name="end_date" class="form-control bg-dark text-white border-secondary" value="<?= htmlspecialchars($endDate ?? '') ?>" style="border-radius:0;">
                                </div>
                                <div class="col-md-6 text-md-end">
                                    <button type="submit" class="btn btn-tactical px-4">RUN_ANALYSIS</button>
                                    <a href="booked-firearms.php" class="btn btn-outline-secondary btn-sm ml-2" style="border-radius:0;">RESET_LOG</a>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="tactical-card card">
                        <div class="card-body d-flex justify-content-between align-items-center border-bottom border-secondary mb-3">
                            <h4 class="card-title-tactical mb-0">Deployment_Registry_Log</h4>
                            <div>
                                <a href="not-returns-firearms" class="btn btn-tactical py-1" title="Unreturned Firearms">
                                    <i class="mdi mdi-pistol"></i> 
                                </a>
                                <a href="not-returns-ammo" class="btn btn-tactical py-1 ml-1" title="Unreturned Ammo">
                                    <i class="mdi mdi-ammunition"></i> 
                                </a>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="mainTable" class="table table-hover w-100">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>OFFICER_NAME</th>
                                            <th>WEAPON_SYSTEM</th>
                                            <th>SERIAL / RDS</th>
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
                                            <td>
                                                <a href="officer-profile.php?id=<?= $row['officerID'] ?>" class="text-info font-weight-bold" style="text-decoration:none;">
                                                    <?= htmlspecialchars($row['to_officer']) ?>
                                                </a>
                                            </td>
                                            <td class="text-amber"><?= htmlspecialchars($row['firearm_name']) ?></td>
                                            <td>
                                                <span class="text-white"><?= htmlspecialchars($row['firearm_serial_no']) ?></span>
                                                <code class="text-neon ml-1">[<?= htmlspecialchars($row['number_of_rounds']) ?>]</code>
                                            </td>
                                             <td onclick="openReturnModal(<?= $row['bookingID'] ?>, '<?= htmlspecialchars(trim($row['returns']), ENT_QUOTES, 'UTF-8') ?>', '<?= isset($row['number_of_rounds']) ? (int)$row['number_of_rounds'] : 0 ?>')" style="cursor:pointer;">
                                                <?php if(trim($row['returns']) === 'Returned'): ?>
                                                    <span class="badge badge-success badge-tactical">
                                                        RETURNED <i class="mdi mdi-check-circle ml-1"></i>
                                                    </span>
                                                <?php else: ?>
                                                    <span class="badge badge-danger badge-tactical">
                                                        DEPLOYED <i class="mdi mdi-satellite-variant ml-1"></i>
                                                    </span>
                                                <?php endif; ?>
                                            </td>
                                            <td style="font-size:11px;"><?= htmlspecialchars($row['booking_time']) ?></td>
                                            <td style="font-size:11px;"><?= htmlspecialchars($row['duty_duration']) ?></td>
                                            <td>
                                                <div class="btn-group">
                                                    <button onclick="viewDetails(<?= $row['bookingID'] ?>)" class="btn btn-tactical py-1">VIEW</button>
                                                    <button onclick="confirmArchive(<?= $row['bookingID'] ?>)" class="btn btn-outline-danger py-1 px-2" style="border-radius:0; border-left:none;">
                                                        <i class="mdi mdi-delete-forever"></i>
                                                    </button>
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
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            // DataTables Initialization
            var table = $('#mainTable').DataTable({
                dom: '<"row mb-3"<"col-md-4"l><"col-md-4"f><"col-md-4 text-end"B>>t<"row mt-3"<"col-md-6"i><"col-md-6"p>>',
                buttons: [
                    { extend: 'excel', text: '<i class="mdi mdi-microsoft-excel"></i> EXCEL', className: 'btn btn-tactical btn-sm' },
                    { extend: 'pdf', text: '<i class="mdi mdi-file-pdf"></i> PDF', className: 'btn btn-tactical btn-sm' },
                    { extend: 'csv', text: '<i class="mdi mdi-file-delimited"></i> CSV', className: 'btn btn-tactical btn-sm' },
                    { extend: 'print', text: '<i class="mdi mdi-printer"></i> PRINT', className: 'btn btn-tactical btn-sm' }
                ],
                responsive: true,
                order: [[0, 'asc']], // Visual numbering order
                language: {
                    search: "SYSTEM_SCAN:",
                    lengthMenu: "SHOW _MENU_ ENTRIES",
                    paginate: {
                        next: '<i class="mdi mdi-chevron-right"></i>',
                        previous: '<i class="mdi mdi-chevron-left"></i>'
                    }
                }
            });

            // Toast Trigger
            const urlParams = new URLSearchParams(window.location.search);
            if(urlParams.has('status')) {
                let status = urlParams.get('status');
                let msg = status === 'success' ? 'TRANSACTION_COMMITTED' : 'ERROR: TRANSACTION_ABORTED';
                let toast = $(`<div class="t-toast">[SIGNAL]: ${msg}</div>`);
                $('#toast-container').append(toast);
                toast.fadeIn(400).delay(4000).fadeOut(400, function(){ $(this).remove(); });
            }
        });

        // Modal Functions
        function viewDetails(id) {
            $('#modalBody').html('<div class="text-center p-5"><i class="mdi mdi-loading mdi-spin" style="font-size:40px; color:var(--neon);"></i><p class="mt-2 text-info">DECRYPTING_DATA...</p></div>');
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
    <script>
$(document).ready(function() {
    const $weaponBtn = $('#weaponDropdown');
    const $weaponMenu = $('.dropdown-menu-tactical');

    // 1. Toggle Menu on Button Click
    $weaponBtn.on('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        $weaponMenu.toggleClass('show');
    });

    // 2. Close Menu when clicking a Weapon Link
    $('.dropdown-item-tactical').on('click', function() {
        $weaponMenu.removeClass('show');
    });

    // 3. Close Menu when clicking anywhere else on the page
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.weapon-select-wrapper').length) {
            $weaponMenu.removeClass('show');
        }
    });

});
</script>
</body>
</html>