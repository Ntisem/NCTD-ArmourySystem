<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}

$query = "SELECT * FROM daily_activities ORDER BY datetime DESC";
$stmt = $pdo->query($query);
$logs = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TERMINAL | SYSTEM_AUDIT_TRAIL</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" type="image/x-icon">
    <style>
        :root {
            --neon-cyan: #00f2ff;
            --neon-amber: #f9a602;
            --tactical-bg: #05070a;
            --panel-bg: #0d1117;
            --border-dim: #30363d;
        }

        body { background-color: var(--tactical-bg); color: #adc4b2; font-family: 'JetBrains Mono', monospace; }
        .card { background-color: var(--panel-bg); border: 1px solid var(--border-dim); border-radius: 0; }
        .text-cyan { color: var(--neon-cyan) !important; text-shadow: 0 0 5px rgba(0, 242, 255, 0.3); }
        
        /* Table Styling */
        .table { color: #ffffff; border-color: var(--border-dim); }
        .table-bordered td, .table-bordered th { border: 1px solid var(--border-dim) !important; }
        .badge-tactical { background: rgba(0, 242, 255, 0.1); border: 1px solid var(--neon-cyan); color: var(--neon-cyan); border-radius: 0; }
        
        /* DataTables Customization */
        .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_paginate { color: #adc4b2 !important; padding-top: 15px; }
        .dataTables_filter input { 
            background: #161b22 !important; border: 1px solid var(--border-dim) !important; 
            color: var(--neon-cyan) !important; border-radius: 0; padding: 5px 10px; margin-left: 10px;
        }
        
        /* Tactical Buttons */
        .dt-buttons { margin-bottom: 20px; gap: 5px; display: flex; }
        .btn-tactical {
            background: transparent !important; border-radius: 0 !important;
            font-family: 'JetBrains Mono', monospace; font-size: 10px !important;
            font-weight: 700; padding: 8px 15px !important; transition: 0.3s;
            border: 1px solid var(--border-dim) !important; color: #fff !important;
        }
        .btn-excel { border-color: #2ea44f !important; color: #2ea44f !important; }
        .btn-excel:hover { background: #2ea44f !important; color: #000 !important; box-shadow: 0 0 10px #2ea44f; }
        .btn-pdf { border-color: #ff3e3e !important; color: #ff3e3e !important; }
        .btn-pdf:hover { background: #ff3e3e !important; color: #000 !important; box-shadow: 0 0 10px #ff3e3e; }
        .btn-print { border-color: var(--neon-cyan) !important; color: var(--neon-cyan) !important; }
        .btn-print:hover { background: var(--neon-cyan) !important; color: #000 !important; box-shadow: 0 0 10px var(--neon-cyan); }

        /* Pagination Styling */
        .paginate_button { border-radius: 0 !important; border: 1px solid var(--border-dim) !important; background: #161b22 !important; color: #fff !important; }
        .paginate_button.current { background: var(--neon-cyan) !important; color: #000 !important; border-color: var(--neon-cyan) !important; }

        .btn-return {
            background: transparent; border: 1px solid var(--neon-amber); color: var(--neon-amber);
            padding: 8px 15px; font-family: 'JetBrains Mono', monospace; font-size: 11px;
            font-weight: 700; text-transform: uppercase; cursor: pointer; border-radius: 0;
        }
        .btn-return:hover { background: var(--neon-amber); color: #000; box-shadow: 0 0 15px var(--neon-amber); }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="row pt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h4 class="card-title text-cyan mb-0">[ SYSTEM_AUDIT_TRAIL ]</h4>
                        <button type="button" class="btn-return" onclick="window.history.back();">
                            <i class="mdi mdi-arrow-left-bold"></i> RETURN_TO_NODE
                        </button>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="logs-table" class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">ID_SEQ</th>
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
                                        <td></td> <td><?= $log['datetime'] ?></td>
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
                <?php require_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function() {
            var t = $('#logs-table').DataTable({
                "order": [[1, "desc"]], // Default sort by Timestamp
                "pageLength": 25,
                "dom": 'Bfrtip',
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="mdi mdi-file-excel"></i> EXCEL_EXPORT',
                        className: 'btn-tactical btn-excel',
                        title: 'NCTD_ARMOURY_AUDIT_LOGS_' + new Date().toISOString().slice(0,10)
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="mdi mdi-file-pdf"></i> PDF_REPORT',
                        className: 'btn-tactical btn-pdf',
                        title: 'NCTD_ARMOURY_SYSTEM_AUDIT_TRAIL',
                        orientation: 'landscape',
                        pageSize: 'A4'
                    },
                    {
                        extend: 'print',
                        text: '<i class="mdi mdi-printer"></i> PRINT_LOGS',
                        className: 'btn-tactical btn-print',
                        messageTop: 'NCTD Armoury Command - Confidential System Audit'
                    }
                ],
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": 0
                }]
            });

            // Automatic Index Numbering Logic
            t.on('order.dt search.dt', function () {
                t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
                    cell.innerHTML = i + 1;
                });
            }).draw();
        });
    </script>
</body>
</html>