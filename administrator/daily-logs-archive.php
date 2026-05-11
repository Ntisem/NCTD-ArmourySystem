<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

// 1. Authorization Check (Command/Admin Level Only)
if(!isset($_SESSION["username"]) || !in_array($_SESSION["user_role"], ['administrator', 'Admin'])) {
    header("location: login");
    exit();
}

// 2. Fetch Archived Activity Stream
$stmt = $pdo->query("SELECT * FROM daily_activities_archive ORDER BY logID DESC");
$archived_logs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>HQ COMMAND | ARCHIVED_LOGS</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    
    <style>
        .archive-card { background: #0d1117; border: 1px solid #ff4b2b44; } /* Subtle red tint for archive */
        .text-timestamp { color: #8b949e; font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; }
        .badge-archive { background: #1c1111; border: 1px solid #ff4b2b; color: #ff4b2b; font-weight: bold; }
    </style>
</head>
<body class="bg-dark text-white">
    <div class="container-scroller">
        <?php include_once('includes/sidebar.php');?>
        <div class="container-fluid page-body-wrapper">
            <?php include_once('includes/navbar.php');?>
            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <div class="page-header">
                        <h3 class="page-title text-danger">
                            <i class="mdi mdi-history"></i> COLD_STORAGE_LOGS // <span class="text-white">HISTORICAL_AUDIT</span>
                        </h3>
                        <a href="daily-logs.php" class="btn btn-outline-info btn-xs">RETURN_TO_ACTIVE_LOGS</a>
                    </div>

                    <div class="card archive-card">
                        <div class="card-body">
                            <div class="alert bg-dark border-secondary text-muted mb-4 small">
                                <i class="mdi mdi-information-outline"></i> These records have been moved from the primary database to optimize performance. They represent activities older than 90 days.
                            </div>
                            <div class="card archive-card mb-4">
                            <div class="card-body">
                                <h5 class="text-amber mb-3"><i class="mdi mdi-filter-variant"></i> TEMPORAL_FILTER</h5>
                                <div class="row align-items-end">
                                    <div class="col-md-3">
                                        <label class="label-hud">START_DATE</label>
                                        <input type="date" id="min_date" class="form-control input-hud">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="label-hud">END_DATE</label>
                                        <input type="date" id="max_date" class="form-control input-hud">
                                    </div>
                                    <div class="col-md-2">
                                        <button id="clear_range" class="btn btn-outline-light btn-xs">RESET_RANGE</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                            <table id="archiveTable" class="table table-dark table-hover responsive nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>TIMESTAMP</th>
                                        <th>OPERATOR</th>
                                        <th>ACTION_TAKEN</th>
                                        <th>ROLE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($archived_logs as $log): ?>
                                    <tr>
                                        <td><span class="text-timestamp">#<?= $log['logID'] ?></span></td>
                                        <td class="text-timestamp"><?= $log['log_time'] ?></td>
                                        <td><?= htmlspecialchars($log['administrator_admin_name']) ?></td>
                                        <td>
                                            <code class="text-warning bg-transparent"><?= htmlspecialchars($log['action_taken']) ?></code>
                                        </td>
                                        <td>
                                            <span class="badge badge-archive">ARCHIVED</span>
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

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>

    <script>
        // $(document).ready(function() {
        //     $('#archiveTable').DataTable({
        //         "dom": 'Bfrtip',
        //         "buttons": [
        //             { extend: 'excel', text: 'EXPORT_EXCEL', className: 'btn btn-outline-success btn-xs mx-1' },
        //             { extend: 'pdf', text: 'GENERATE_PDF', className: 'btn btn-outline-danger btn-xs mx-1' }
        //         ],
        //         "order": [[ 0, "desc" ]],
        //         "language": { "search": "[SCAN_ARCHIVE]:" },
        //         "responsive": true
        //     });
        // });
        $(document).ready(function() {
    // 1. Initialize DataTable
    var table = $('#archiveTable').DataTable({
        "dom": 'Bfrtip',
        "buttons": ['excel', 'pdf'],
        "order": [[ 0, "desc" ]],
        "responsive": true
    });

    // 2. Custom Filtering Function
    // This function runs on every row whenever table.draw() is called
    $.fn.dataTable.ext.search.push(
        function(settings, data, dataIndex) {
            var min = $('#min_date').val();
            var max = $('#max_date').val();
            
            // data[1] is the TIMESTAMP column in our table
            // We only need the date part (YYYY-MM-DD), so we slice it
            var rowDate = data[1].split(' ')[0]; 

            if (min === "" && max === "") return true;
            if (min === "" && rowDate <= max) return true;
            if (max === "" && rowDate >= min) return true;
            if (rowDate >= min && rowDate <= max) return true;
            
            return false;
        }
    );

    // 3. Trigger Redraw on Input Change
    $('#min_date, #max_date').on('change', function() {
        table.draw();
    });

    // 4. Reset Button
    $('#clear_range').on('click', function() {
        $('#min_date, #max_date').val('');
        table.draw();
    });
});
    </script>
</body>
</html>