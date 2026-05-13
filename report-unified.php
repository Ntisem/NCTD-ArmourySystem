<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}
// Fetch Active Firearms
$stmtF = $pdo->query("SELECT firearm_serial_no, firearm_name, firearm_type, booking_status FROM firearms WHERE is_deleted = 0");
$firearms = $stmtF->fetchAll();

// Fetch Active Ammunition
$stmtA = $pdo->query("SELECT ammo_name, ammo_rounds, ammo_application, booking_status FROM ammunitions WHERE is_deleted = 0");
$ammunition = $stmtA->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HQ COMMAND | UNIFIED_STATUS_REPORT</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <style>
        body {
            background-color: #212529;
            color: #fff;
        }
        .text-cyan {
            color: #00f2ff;
        }
    </style>
</head>
<body class="p-4">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h3 class="text-cyan"><i class="mdi mdi-file-document"></i> ARMOURY_STATUS_REPORT</h3>
            <a href="firearm-names.php" class="btn btn-outline-light btn-xs">BACK_TO_DASHBOARD</a>
        </div>

        <div class="card bg-dark border-secondary">
            <div class="card-body">
                <table id="unifiedReport" class="table table-dark table-bordered w-100">
                    <thead>
                        <tr>
                            <th>SECTION</th>
                            <th>IDENTIFIER/NAME</th>
                            <th>CATEGORY</th>
                            <th>STOCK/SERIAL</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($firearms as $f): ?>
                        <tr>
                            <td>FIREARMS_INVENTORY</td>
                            <td><?= htmlspecialchars($f['firearm_name']) ?></td>
                            <td><?= htmlspecialchars($f['firearm_type']) ?></td>
                            <td><?= htmlspecialchars($f['firearm_serial_no']) ?></td>
                            <td><?= htmlspecialchars($f['booking_status']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                        
                        <?php foreach($ammunition as $a): ?>
                        <tr>
                            <td>AMMUNITION_STOCK</td>
                            <td><?= htmlspecialchars($a['ammo_name']) ?></td>
                            <td><?= htmlspecialchars($a['ammo_application']) ?></td>
                            <td><?= number_format($a['ammo_rounds']) ?> RDS</td>
                            <td><?= htmlspecialchars($a['booking_status']) ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#unifiedReport').DataTable({
                "dom": 'Bfrtip',
                "paging": false,
                "buttons": [
                    {
                        extend: 'pdfHtml5',
                        text: 'GENERATE_OFFICIAL_PDF',
                        className: 'btn btn-danger',
                        title: 'HQ_ARMOURY_FULL_STATUS_REPORT',
                        orientation: 'portrait',
                        pageSize: 'A4',
                        customize: function (doc) {
                            doc.content[1].table.widths = ['*', '*', '*', '*', '*'];
                            doc.styles.tableHeader.fillColor = '#1a1a1a';
                            doc.defaultStyle.fontSize = 10;
                        }
                    },
                    { 
                        extend: 'excelHtml5', 
                        text: 'EXPORT_EXCEL', 
                        className: 'btn btn-success' 
                    },
                    { 
                        extend: 'csvHtml5', 
                        text: 'EXPORT_CSV', 
                        className: 'btn btn-warning text-white' 
                    },
                    { 
                        extend: 'print', 
                        text: 'PRINT_REPORT', 
                        className: 'btn btn-info text-white' 
                    }
                ]
            });
        });
    </script>
</body>
</html>