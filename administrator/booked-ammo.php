<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login.php");
    exit();
}

// Fetch Overdue Count for Alert
$overdueStmt = $pdo->query("SELECT COUNT(*) FROM ammo_bookings WHERE ammo_returns = 'Not-Return'");
$overdueCount = $overdueStmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>AMMO_LOG | NCTD ARMOURY SYSTEM</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <style>
        :root { --neon: #00f2ff; --bg-deep: #05070a; --card-bg: #0d1117; --danger: #ff3e3e; --success: #00ff88; }
        body { background: var(--bg-deep); font-family: 'Roboto Mono', monospace; color: #c0c5ce; }
        .tactical-card { background: var(--card-bg) !important; border: 1px solid rgba(0, 242, 255, 0.2); border-radius: 0; }
        .header-title { font-family: 'Orbitron'; color: var(--neon); letter-spacing: 2px; }
        
        .status-overdue { color: var(--danger); font-weight: bold; animation: blink 2s infinite; }
        @keyframes blink { 0% { opacity: 1; } 50% { opacity: 0.4; } 100% { opacity: 1; } }
        
        .btn-neon { border: 1px solid var(--neon); color: var(--neon); background: transparent; font-family: 'Orbitron'; font-size: 10px; }
        .btn-neon:hover { background: var(--neon); color: #000; box-shadow: 0 0 15px var(--neon); }
        
        .officer-link { color: var(--neon); text-decoration: none; cursor: pointer; font-weight: bold; }
        .officer-link:hover { text-decoration: underline; color: #fff; }
        
        .table { background: #080a0d; }
        .table thead th { border-bottom: 2px solid var(--neon) !important; color: var(--neon); font-family: 'Orbitron'; font-size: 11px; }
        .dt-buttons .btn { background: #1a1f26 !important; border: 1px solid #333 !important; color: var(--neon) !important; font-size: 10px; }
    </style>
</head>
<body>
    <div class="container-fluid p-4">
        <div class="row mb-4">
            <div class="col-md-6">
                <h3 class="header-title">[ AMMUNITION_DEPLOYMENT_REGISTRY ]</h3>
            </div>
            <div class="col-md-6 text-right">
                <?php if($overdueCount > 0): ?>
                    <button class="btn btn-outline-danger mr-2" onclick="filterOverdue()">
                        <i class="mdi mdi-alert"></i> VIEW_OVERDUE (<?= $overdueCount ?>)
                    </button>
                <?php endif; ?>
                <button class="btn btn-neon" onclick="location.reload()">REFRESH_UPLINK</button>
                <a href="javascript:history.back()" class="btn btn-neon">Back</a>
            </div>
        </div>

        <div class="card tactical-card">
            <div class="card-body">
                <table id="ammoLogTable" class="table table-dark table-hover">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>CODE</th>
                            <th>PERSONNEL_ID</th>
                            <th>NAME</th>
                            <th>AMMO_TYPE</th>
                            <th>QTY</th>
                            <th>STATUS</th>
                            <th>TIMESTAMP</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT * FROM ammo_bookings ORDER BY book_ammoID DESC");
                        $count = 1;
                        while($row = $stmt->fetch()) {
                            $is_overdue = ($row['ammo_returns'] == 'Not-Return');
                        ?>
                        <tr data-overdue="<?= $is_overdue ? '1' : '0' ?>">
                            <td><?= $count++ ?></td>
                            <td class="text-info"><?= $row['bookingCode'] ?: 'SEC_ERR' ?></td>
                            <td><?= $row['officerID'] ?></td>
                            <td>
                                <a href="officer-details.php?id=<?= $row['officerID'] ?>" class="officer-link">
                                    <?= strtoupper($row['to_officer']) ?>
                                </a>
                            </td>
                            <td><?= $row['ammo_name'] ?></td>
                            <td><?= $row['ammo_rounds'] ?></td>
                            <td class="<?= $is_overdue ? 'status-overdue' : 'text-success' ?>">
                                <?= $is_overdue ? '[ OUT_STANDING ]' : '[ RETURNED ]' ?>
                            </td>
                            <td class="small"><?= $row['booking_time'] ?></td>
                            <td>
                                <button class="btn btn-xs btn-neon" onclick="editBooking(<?= htmlspecialchars(json_encode($row)) ?>)">
                                    <i class="mdi mdi-pencil"></i>
                                </button>
                                <button class="btn btn-xs btn-outline-danger" onclick="deleteBooking(<?= $row['book_ammoID'] ?>)">
                                    <i class="mdi mdi-delete"></i>
                                </button>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content tactical-card" style="border: 1px solid var(--neon);">
                <form id="updateForm">
                    <div class="modal-body">
                        <h5 class="header-title mb-4">[ UPDATE_DEPLOYMENT_LOG ]</h5>
                        <input type="hidden" name="book_ammoID" id="edit_id">
                        <input type="hidden" name="action" value="update">
                        
                        <label class="small text-info">ROUNDS_ISSUED</label>
                        <input type="number" name="ammo_rounds" id="edit_rounds" class="form-control mb-3 text-white bg-dark">
                        
                        <label class="small text-info">RETURN_STATUS</label>
                        <select name="ammo_returns" id="edit_status" class="form-control text-white bg-dark">
                            <option value="Not-Return">Not-Return</option>
                            <option value="Returned">Returned</option>
                        </select>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="submit" class="btn btn-neon btn-block">COMMIT_CHANGES</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="plugins/jszip/jszip.min.js"></script>
    <script src="plugins/pdfmake/pdfmake.min.js"></script>
    <script src="plugins/pdfmake/vfs_fonts.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
    $(document).ready(function() {
        var table = $('#ammoLogTable').DataTable({
            "responsive": true, "dom": 'Bfrtip',
            "buttons": ["copy", "csv", "excel", "pdf", "print"],
            "pageLength": 15
        });

        window.filterOverdue = function() {
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                return $(table.row(dataIndex).node()).attr('data-overdue') === '1';
            });
            table.draw();
            $.fn.dataTable.ext.search.pop();
            toastr.warning("TERMINAL_FILTER: OVERDUE_ONLY");
        };
    });

    function editBooking(data) {
        $('#edit_id').val(data.book_ammoID);
        $('#edit_rounds').val(data.ammo_rounds);
        $('#edit_status').val(data.ammo_returns);
        $('#updateModal').modal('show');
    }

    $('#updateForm').submit(function(e) {
        e.preventDefault();
        $.post('process-booked-ammo.php', $(this).serialize(), function(res) {
            let data = JSON.parse(res);
            if(data.status == 'success') {
                toastr.success("LOG_UPDATED_SUCCESSFULLY");
                setTimeout(() => location.reload(), 1000);
            }
        });
    });

    function deleteBooking(id) {
        if(confirm("[ DANGER ] PURGE DATA FROM LOG?")) {
            $.post('process-booked-ammo.php', {action: 'delete', book_ammoID: id}, function() {
                toastr.error("DATA_DELETED_SUCCESSFULLY");
                setTimeout(() => location.reload(), 1000);
            });
        }
    }
    </script>
</body>
</html>