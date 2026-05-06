<?php
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM bookings WHERE returns = 'Not-Return' AND is_deleted = 0 AND STR_TO_DATE(booking_time, '%M %e, %Y') < DATE_SUB(NOW(), INTERVAL 24 HOUR)");
$stmt->execute();
$bookings = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>OVERDUE_DEPLOYMENTS | ARMOURY_SYSTEM</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <style>
        :root { 
            --neon: #00f2ff; 
            --bg: #020408; 
            --card: #0a0d12; 
            --danger: #ff3333; 
        }
        body { background: var(--bg); font-family: 'JetBrains Mono', monospace; color: #e0e0e0; }
        .tactical-card { background: var(--card) !important; border: 1px solid rgba(0, 242, 255, 0.2); }
        .table { color: #fff !important; }
        .table thead th { background: rgba(0, 242, 255, 0.1); color: var(--neon); border-bottom: 2px solid var(--neon); font-size: 11px; text-transform: uppercase; }
        .btn-tactical { border: 1px solid var(--neon); color: var(--neon); border-radius: 0; background: transparent; transition: 0.3s; }
        .btn-tactical:hover { background: var(--neon); color: #000; box-shadow: 0 0 15px var(--neon); }
    </style>
</head>
<body>
    <div class="container-scroller">
        <?php include_once('includes/sidebar.php');?>
        <div class="container-fluid page-body-wrapper">
            <?php include_once('includes/navbar.php');?>
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4><span class="text-danger">[ OVERDUE_OFFICERS_LOG ]</span></h4>
                        <a href="booked-firearms.php" class="btn btn-tactical"><i class="mdi mdi-arrow-left"></i> BACK_TO_REGISTRY</a>
                    </div>

                    <div class="card tactical-card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="overdueTable" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>OFFICER_NAME</th>
                                            <th>WEAPON_SYSTEM</th>
                                            <th>SERIAL_NO</th>
                                            <th>DEPLOY_TIME</th>
                                            <th>DURATION</th>
                                            <th>STATUS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; foreach($bookings as $row): ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= htmlspecialchars($row['to_officer']) ?></td>
                                            <td><?= $row['firearm_name'] ?></td>
                                            <td><?= $row['firearm_serial_no'] ?></td>
                                            <td><?= $row['booking_time'] ?></td>
                                            <td><?= $row['duty_duration'] ?></td>
                                            <td><span class="badge badge-danger">EXCEEDED_24_HR</span></td>
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
    
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#overdueTable').DataTable();
        });
    </script>
</body>
</html>