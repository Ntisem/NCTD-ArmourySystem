<?php 
require_once('connections/connect-db.php');
require_once('includes/redirect.php');
require_once('functions.php');
require_once('includes/user_auth.php');

// Performance: Fetching specific officer details using Prepared Statements
$officerID = filter_input(INPUT_GET, 'officerID', FILTER_VALIDATE_INT);

if (!$officerID) {
    header("Location: officers-list");
    exit();
}

$officer_stmt = $connect_db->prepare("SELECT rank, full_name FROM officers WHERE officerID = ?");
$officer_stmt->bind_param("i", $officerID);
$officer_stmt->execute();
$officer_data = $officer_stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>P.A.L.A.D.I.N. // OPERATIONAL LOG</title>
    
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/style.css">

    <style>
        :root {
            --neon-cyan: #00f2ff;
            --neon-green: #39ff14;
            --neon-red: #ff3131;
            --dark-surface: #0a0c10;
            --grid-line: rgba(0, 242, 255, 0.1);
        }

        body { background-color: #05070a !important; }

        /* TACTICAL CARD & TABLE */
        .card {
            background: var(--dark-surface) !important;
            border: 1px solid var(--grid-line);
            border-radius: 0;
            box-shadow: 0 0 30px rgba(0,0,0,0.7);
        }

        .table-tactical { border-collapse: collapse !important; width: 100% !important; }
        
        .table-tactical thead th {
            background: rgba(0, 242, 255, 0.08) !important;
            color: var(--neon-cyan) !important;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.7rem;
            letter-spacing: 1.5px;
            border: 1px solid var(--grid-line) !important;
        }

        .table-tactical td {
            border: 1px solid var(--grid-line) !important;
            vertical-align: middle !important;
            color: #ccc;
            font-family: 'Roboto Mono', monospace;
        }

        .table-tactical tr:hover { background: rgba(0, 242, 255, 0.03) !important; }

        /* DATATABLES UI CUSTOMIZATION */
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            background: transparent !important;
            border: 1px solid var(--grid-line) !important;
            color: var(--neon-cyan) !important;
            border-radius: 0;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: var(--neon-cyan) !important;
            color: #000 !important;
        }

        .dt-buttons .btn {
            background: transparent;
            border: 1px solid var(--neon-cyan);
            color: var(--neon-cyan);
            font-size: 10px;
            margin-right: 5px;
            border-radius: 0;
        }

        .dt-buttons .btn:hover { background: var(--neon-cyan); color: #000; }

        /* STATUS BADGES */
        .badge-tactical {
            padding: 4px 8px;
            font-size: 9px;
            font-weight: bold;
            border-radius: 0;
            display: inline-block;
        }
        .badge-pending { border: 1px solid var(--neon-red); color: var(--neon-red); }
        .badge-returned { border: 1px solid var(--neon-green); color: var(--neon-green); }

        .btn-tactical {
            background: transparent;
            border: 1px solid var(--neon-cyan);
            color: var(--neon-cyan);
            padding: 10px 20px;
            font-family: 'Orbitron', sans-serif;
            font-size: 11px;
            transition: all 0.3s;
        }

        .btn-tactical:hover { box-shadow: 0 0 15px var(--neon-cyan); color: #fff; }
        .btn-tactical-back {
    display: inline-block;
    padding: 8px 16px;
    background: rgba(0, 242, 255, 0.05);
    border: 1px solid rgba(0, 242, 255, 0.3);
    color: var(--neon-cyan);
    font-family: 'Orbitron', sans-serif;
    font-size: 0.75rem;
    letter-spacing: 1.5px;
    text-decoration: none;
    transition: all 0.3s ease;
    text-transform: uppercase;
}

.btn-tactical-back:hover {
    background: rgba(0, 242, 255, 0.15);
    border-color: var(--neon-cyan);
    color: #fff;
    box-shadow: 0 0 15px rgba(0, 242, 255, 0.2);
    text-decoration: none;
}

.btn-tactical-back i {
    vertical-align: middle;
    margin-right: 5px;
}
    </style>
</head>

<body>
    <div class="container-scroller">
        <?php require_once('includes/sidebar.php');?>
        <div class="container-fluid page-body-wrapper">
            <?php require_once('includes/navbar.php');?>
            
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row mb-3">
                        <div class="col-12">
                            <a href="officers-list?Rank=<?php echo $officer_data['rank']; ?>" class="btn-tactical-back">
                                <i class="mdi mdi-chevron-double-left"></i> BACK
                            </a>
                        </div>
                    </div>
                    <div class="page-header">
                        <h5 class="page-title">
                            <span class="text-muted">LOG_RECORDS //</span> 
                            <span style="color:var(--neon-cyan)"><?php echo strtoupper($officer_data['rank'] . ' ' . $officer_data['full_name']); ?></span>
                        </h5>
                    </div>

                    <div class="card">
                        <div class="card-body">
                            <div class="mb-4">
                                <a href="booking" class="btn btn-tactical">
                                    <i class="mdi mdi-shield-plus-outline"></i> + NEW_DEPLOYMENT
                                </a>
                            </div>

                            <table id="history-table" class="table table-tactical dt-responsive nowrap">
                                <thead>
                                    <tr>
                                        <th>TIMESTAMP</th>
                                        <th>ASSET_ID</th>
                                        <th>QTY</th>
                                        <th>STATUS</th>
                                        <th>OP_TYPE</th>
                                        <th>LOCATION</th>
                                        <th>ISSUER</th>
                                        <th>ACTIONS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $sql = "(SELECT booking_time, firearm_name as item, number_of_rounds as qty, returns as status, duty_type, duty_location, armourer_issuer, bookingID as id, 'firearm' as type FROM bookings WHERE officerID = $officerID)
                                            UNION ALL
                                            (SELECT booking_time, ammo_name as item, ammo_rounds as qty, ammo_returns as status, duty_type, duty_location, armourer_issuer, book_ammoID as id, 'ammo' as type FROM ammo_bookings WHERE officerID = $officerID)
                                            UNION ALL
                                            (SELECT booking_time, asset_name as item, asset_quantity as qty, asset_returns as status, duty_type, duty_location, armourer_issuer, bookAssetID as id, 'asset' as type FROM asset_bookings WHERE officerID = $officerID)
                                            ORDER BY booking_time DESC";

                                    $history_query = mysqli_query($connect_db, $sql);

                                    while ($row = mysqli_fetch_assoc($history_query)) {
                                        $isPending = ($row['status'] == 'Not-Return');
                                        $statusClass = $isPending ? 'badge-pending' : 'badge-returned';
                                        $statusText = $isPending ? 'OUTSTANDING' : 'SECURED';
                                        ?>
                                        <tr>
                                            <td><small><?php echo $row['booking_time']; ?></small></td>
                                            <td class="text-cyan"><?php echo $row['item']; ?></td>
                                            <td><?php echo $row['qty']; ?></td>
                                            <td><span class="badge-tactical <?php echo $statusClass; ?>"><?php echo $statusText; ?></span></td>
                                            <td><small><?php echo $row['duty_type']; ?></small></td>
                                            <td><small><?php echo $row['duty_location']; ?></small></td>
                                            <td><small><?php echo $row['armourer_issuer']; ?></small></td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="view-details?type=<?php echo $row['type']; ?>&id=<?php echo $row['id']; ?>" class="text-cyan mr-3"><i class="mdi mdi-monitor-eye"></i></a>
                                                    <a href="#" class="text-danger"><i class="mdi mdi-delete-variant"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php require_once('includes/footer.php');?>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>

    <script>
        $(function () {
            $("#history-table").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "pageLength": 10,
                "order": [[0, "desc"]],
                "dom": 'Bfrtip', // Position of buttons
                "buttons": [
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="mdi mdi-file-pdf"></i> PDF',
                        className: 'btn-tactical',
                        title: 'NCTD_OPERATIONAL_LOG_<?php echo strtoupper($officer_data['full_name']); ?>'
                    },
                    {
                        extend: 'excelHtml5',
                        text: '<i class="mdi mdi-file-excel"></i> EXCEL',
                        className: 'btn-tactical'
                    },
                    {
                        extend: 'print',
                        text: '<i class="mdi mdi-printer"></i> PRINT',
                        className: 'btn-tactical'
                    }
                ],
                "language": {
                    "search": "",
                    "searchPlaceholder": "[ SCAN_SYSTEM_LOGS... ]",
                    "paginate": {
                        "previous": "<<",
                        "next": ">>"
                    }
                }
            });

            // Style the search box to be more tactical
            $('.dataTables_filter input').addClass('tactical-search').css({
                'background': '#000',
                'border': '1px solid var(--neon-cyan)',
                'color': 'var(--neon-cyan)',
                'font-family': 'Roboto Mono'
            });
        });
    </script>
</body>
</html>