<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

// 1. Authorization Check (Command/Armourer Level Only)
if(!isset($_SESSION["username"]) || !in_array($_SESSION["user_role"], ['Armourer', 'Admin'])) {
    header("location: login");
    exit();
}

// 2. Fetch Activity Stream
// We fetch everything in descending order so the newest actions appear first.
$stmt = $pdo->query("SELECT * FROM daily_activities ORDER BY logID DESC");
$logs = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>HQ COMMAND | OPERATION_LOGS</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    
    <style>
        .log-card { background: #0d1117; border: 1px solid #30363d; }
        .text-neon-blue { color: #58a6ff; }
        .text-timestamp { color: #8b949e; font-family: 'JetBrains Mono', monospace; font-size: 0.85rem; }
        .badge-system { background: #21262d; border: 1px solid #30363d; color: #c9d1d9; }
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
                        <h3 class="page-title text-neon-blue">
                            <i class="mdi mdi-clipboard-text-clock"></i> SYSTEM_ACTIVITY_LOG // <span class="text-white">AUDIT_TRAIL</span>
                        </h3>
                    </div>
                    <?php if($_SESSION['user_role'] === 'Admin'): ?>
                        <a href="process-clear-logs.php" 
                        onclick="return confirm('MIGRATE_OLD_DATA: Move logs older than 90 days to cold storage?')" 
                        class="btn btn-outline-warning btn-xs">
                        <i class="mdi mdi-archive"></i> PURGE_OLD_LOGS
                        </a>
                    <?php endif; ?>
                    <div class="card log-card">
                        <div class="card-body">
                            <table id="activityTable" class="table table-dark table-hover responsive nowrap" style="width:100%">
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
                                    <?php foreach($logs as $log): ?>
                                    <tr>
                                        <td><span class="text-timestamp">#<?= $log['logID'] ?></span></td>
                                        <td class="text-timestamp"><?= $log['log_time'] ?></td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <i class="mdi mdi-account-circle-outline mr-2 text-info"></i>
                                                <?= htmlspecialchars($log['armourer_admin_name']) ?>
                                            </div>
                                        </td>
                                        <td>
                                            <code class="text-white bg-transparent"><?= htmlspecialchars($log['action_taken']) ?></code>
                                        </td>
                                        <td>
                                            <span class="badge badge-system"><?= $log['user_role'] ?></span>
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
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#activityTable').DataTable({
                "dom": 'Bfrtip',
                "buttons": [
                    { 
                        extend: 'excel', 
                        text: '<i class="mdi mdi-file-excel"></i> EXCEL', 
                        className: 'btn btn-outline-success btn-xs mx-1',
                        title: 'ARMOURY_AUDIT_LOG_' + new Date().toISOString().slice(0,10)
                    },
                    { 
                        extend: 'pdf', 
                        text: '<i class="mdi mdi-file-pdf"></i> PDF', 
                        className: 'btn btn-outline-danger btn-xs mx-1',
                        title: 'ARMOURY_AUDIT_LOG'
                    },
                    { 
                        extend: 'print', 
                        text: '<i class="mdi mdi-printer"></i> PRINT', 
                        className: 'btn btn-outline-info btn-xs mx-1'
                    }
                ],
                "order": [[ 0, "desc" ]], // Newest logs at the top
                "language": {
                    "search": "[SCAN_LOGS]:",
                    "lengthMenu": "DISPLAY _MENU_ ENTRIES",
                    "info": "RECORDS _START_ TO _END_ OF _TOTAL_"
                },
                "responsive": true
            });
        });
    </script>
</body>
</html>