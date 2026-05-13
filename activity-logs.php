<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

// Access Control: Only Armourers/Admins should view logs
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}

// Fetch all logs ordered by newest first
$query = "SELECT * FROM daily_activities ORDER BY datetime DESC";
$stmt = $pdo->query($query);
$logs = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>COMMAND_TERMINAL NCTD ARMOURY | ACTIVITY_LOGS</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <style>
        body { background-color: #05070a; color: #adc4b2; font-family: 'Courier New', Courier, monospace; }
        .card { background-color: #0f131a; border: 1px solid #00f2ff; }
        .table { color: #ffffff; }
        .badge-tactical { background: rgba(0, 242, 255, 0.1); border: 1px solid #00f2ff; color: #00f2ff; }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row pt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-cyan">[ SYSTEM_AUDIT_TRAIL ]</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="logs-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>TIMESTAMP</th>
                                        <th>OPERATOR</th>
                                        <th>ROLE</th>
                                        <th>CATEGORY</th>
                                        <th>ACTION_DETAILS</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($logs as $log): ?>
                                    <tr>
                                        <td><?= $log['datetime'] ?></td>
                                        <td><?= $log['armourer_admin_name'] ?></td>
                                        <td><span class="badge badge-tactical"><?= $log['user_role'] ?></span></td>
                                        <td><?= $log['category'] ?></td>
                                        <td><?= $log['action_taken'] ?></td>
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

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#logs-table').DataTable({
                "order": [[0, "desc"]],
                "pageLength": 25
            });
        });
    </script>
</body>
</html>