<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login.php");
    exit();
}

$overdueStmt = $pdo->query("SELECT COUNT(*) FROM blank_ammo_bookings WHERE faulty_returns_state = 'Not-Return'");
$overdueCount = $overdueStmt->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>BLANK_AMMO_LOG | NCTD ARMOURY SYSTEM</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@300;500&display=swap" rel="stylesheet">
    
    <style>
        :root { --neon: #00f2ff; --bg-deep: #05070a; --card-bg: #0d1117; --danger: #ff3e3e; --success: #00ff88; --warning: #ffaa00; }
        body { background: var(--bg-deep); font-family: 'Roboto Mono', monospace; color: #c0c5ce; }
        .tactical-card { background: var(--card-bg) !important; border: 1px solid rgba(0, 242, 255, 0.2); border-radius: 0; }
        .header-title { font-family: 'Orbitron'; color: var(--neon); letter-spacing: 2px; }
        
        .status-overdue { color: var(--danger); font-weight: bold; animation: blink 2s infinite; }
        @keyframes blink { 0% { opacity: 1; } 50% { opacity: 0.4; } 100% { opacity: 1; } }
        
        .btn-neon { border: 1px solid var(--neon); color: var(--neon); background: transparent; font-family: 'Orbitron'; font-size: 11px; border-radius: 0; transition: all 0.2s ease; }
        .btn-neon:hover { background: var(--neon); color: #000; box-shadow: 0 0 15px var(--neon); }
        .btn-outline-danger { border-radius: 0 !important; font-family: 'Orbitron'; font-size: 11px; }
        
        .officer-link { color: var(--neon); text-decoration: none; cursor: pointer; font-weight: bold; }
        .officer-link:hover { text-decoration: underline; color: #fff; }
        
        .table { background: #080a0d; width: 100% !important; }
        .table thead th { border-bottom: 2px solid var(--neon) !important; color: var(--neon); font-family: 'Orbitron'; font-size: 11px; text-transform: uppercase; }
        
        .dt-buttons .btn { background: #1a1f26 !important; border: 1px solid rgba(0, 242, 255, 0.3) !important; color: var(--neon) !important; font-size: 10px; border-radius: 0; font-family: 'Orbitron'; margin-right: 5px; }
        .dt-buttons .btn:hover { background: var(--neon) !important; color: #000 !important; box-shadow: 0 0 10px var(--neon); }

        #tactical-toast-container { position: fixed; top: 20px; right: 20px; z-index: 99999; }
        .t-toast { 
            background: #05070a; border: 1px solid var(--neon); color: #fff; padding: 15px 25px; margin-bottom: 10px; min-width: 320px; 
            border-left: 5px solid var(--neon); font-size: 12px; letter-spacing: 1px; box-shadow: 0 0 20px rgba(0, 242, 255, 0.2); display: none;
            font-family: 'Roboto Mono', monospace;
        }
        .t-success { border-left-color: var(--success); border-color: rgba(0, 255, 136, 0.5); }
        .t-error { border-left-color: var(--danger); border-color: rgba(255, 51, 51, 0.5); }
        .t-warning { border-left-color: var(--warning); border-color: rgba(255, 170, 0, 0.5); }
        .t-toast .toast-header-text { font-family: 'Orbitron'; font-weight: bold; font-size: 10px; margin-bottom: 4px; }
        .t-toast .toast-actions { margin-top: 10px; text-align: right; display: flex; justify-content: flex-end; gap: 8px; }

        .modal-content { border-radius: 0; box-shadow: 0 0 30px rgba(0,242,255,0.2); background: var(--bg-deep); color: #fff; }
        .detail-row { border-bottom: 1px solid rgba(0, 242, 255, 0.1); padding: 10px 0; }
        .detail-label { color: #8b949e; font-size: 11px; text-transform: uppercase; }
        .detail-value { color: #fff; font-size: 13px; font-weight: bold; }
        
        .form-control { background-color: #161b22 !important; border: 1px solid rgba(0, 242, 255, 0.3); color: #fff !important; border-radius: 0; font-family: 'Roboto Mono'; }
        .form-control:focus { border-color: var(--neon); box-shadow: 0 0 8px var(--neon); }
        .form-control[readonly] { background-color: #0d1117 !important; opacity: 0.7; border-color: rgba(0, 242, 255, 0.1); }
    </style>
</head>
<body>
    <div id="tactical-toast-container"></div>
    
    <div class="container-fluid p-4" style="margin-bottom: 80px;">
        <div class="row mb-4">
            <div class="col-md-6">
                <h5 class="header-title">[ BLANK_AMMO_DEPLOYMENT_REGISTRY ]</h5>
            </div>
            <div class="col-md-6 text-right">
                <?php if($overdueCount > 0): ?>
                    <button class="btn btn-outline-danger mr-2" onclick="filterOverdue()">
                        <i class="mdi mdi-alert"></i> VIEW_OVERDUE (<?= $overdueCount ?>)
                    </button>
                <?php endif; ?>
                <button class="btn btn-neon" onclick="location.reload()">REFRESH_UPLINK</button>
                <a href="booking-blank-ammo" class="btn btn-neon">+ INITIALIZE_ORDER</a>
                <a href="javascript:history.back()" class="btn btn-outline-light" style="border-radius:0;"><i class="mdi mdi-arrow-left"></i> Back</a>
            </div>
        </div>

        <div class="card tactical-card">
            <div class="card-body">
                <table id="ammoLogTable" class="table table-dark table-hover table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>OFFICER_NAME</th>
                            <th>AMMO_TYPE</th>
                            <th>QTY ISSUED</th>
                            <th>QTY RETURNED</th>
                            <th>STATUS</th>
                            <th class="no-export">ACTIONS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $stmt = $pdo->query("SELECT * FROM blank_ammo_bookings ORDER BY blank_ammoID DESC");
                        while($row = $stmt->fetch()) {
                            $is_overdue = ($row['faulty_returns_state'] == 'Not-Return');
                        ?>
                        <tr id="log-row-<?= $row['blank_ammoID'] ?>" data-overdue="<?= $is_overdue ? '1' : '0' ?>">
                            <td class="index-cell"></td>
                            <td>
                                <a href="track-officer-matrix?officerID=<?= $row['officerID'] ?>" class="officer-link">
                                    <?= strtoupper(htmlspecialchars($row['to_officer'])) ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($row['faulty_ammo_name']) ?></td>
                            <td><code style="color: #fff;"><?= htmlspecialchars($row['faulty_ammo_rounds']) ?> RDS</code></td>
                            <td><code style="color: var(--success);"><?= htmlspecialchars($row['faulty_ammo_returned']) ?> RDS</code></td>
                            <td class="<?= $is_overdue ? 'status-overdue' : 'text-success' ?>">
                                <?= $is_overdue ? '[ OUT_STANDING ]' : '[ RETURNED ]' ?>
                            </td>
                            <td class="no-export">
                                <button class="btn btn-xs btn-neon" title="VIEW DETAILS" onclick="viewDetails(<?= htmlspecialchars(json_encode($row)) ?>)">
                                    <i class="mdi mdi-eye"></i>
                                </button>
                                <button class="btn btn-xs btn-neon ml-1" title="RETURN / RE-MANAGE" onclick="editBooking(<?= htmlspecialchars(json_encode($row)) ?>)">
                                    <i class="mdi mdi-undo-variant"></i>
                                </button>
                                <button class="btn btn-xs btn-outline-danger ml-1" title="PURGE LOG" onclick="triggerTacticalPurge(<?= $row['blank_ammoID'] ?>)">
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
    
    <?php require_once('includes/footer.php'); ?>

    <div class="modal fade" id="viewModal" tabindex="-1">
        <div class="modal-dialog modal-md">
            <div class="modal-content tactical-card">
                <div class="modal-body">
                    <h5 class="header-title mb-4">[ INSPECT_DEPLOYMENT_MANIFEST ]</h5>
                    <div class="text-center mb-3">
                        <img id="v_image" src="assets/images/faces/profile_placeholder.jpg" onerror="this.src='assets/images/faces/profile_placeholder.jpg'" style="width:110px; height:110px; border: 2px solid var(--neon); object-fit: cover;">
                    </div>
                    <div class="container-fluid">
                        <div class="row detail-row"><div class="col-5 detail-label">Personnel:</div><div class="col-7 detail-value" id="v_officer"></div></div>
                        <div class="row detail-row"><div class="col-5 detail-label">Caliber Line:</div><div class="col-7 detail-value" id="v_name"></div></div>
                        <div class="row detail-row"><div class="col-5 detail-label">Rounds Issued:</div><div class="col-7 detail-value" id="v_issued"></div></div>
                        <div class="row detail-row"><div class="col-5 detail-label">Rounds Returned:</div><div class="col-7 detail-value" id="v_returned"></div></div>
                        <div class="row detail-row"><div class="col-5 detail-label">Issuer Sign:</div><div class="col-7 detail-value" id="v_issuer"></div></div>
                        <div class="row detail-row"><div class="col-5 detail-label">Returned Time:</div><div class="col-7 detail-value" id="v_rtime"></div></div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button class="btn btn-neon btn-block" data-dismiss="modal">CLOSE_INTERCEPT_VIEW</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content tactical-card">
                <form id="updateForm">
                    <div class="modal-body">
                        <h5 class="header-title mb-4">[ SECURE_RETURN_DECLARATION ]</h5>
                        <input type="hidden" name="blank_ammoID" id="edit_id">
                        <input type="hidden" name="action" value="update">
                        <input type="hidden" name="faulty_ammoID" id="edit_faulty_ammoID">
                        
                        <div class="form-group">
                            <label class="small text-info font-weight-bold">AMMO_CLASSIFICATION</label>
                            <input type="text" id="edit_ammo_name" class="form-control mb-3" readonly>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <label class="small text-info font-weight-bold">ROUNDS_ISSUED (INITIAL)</label>
                                <input type="number" name="faulty_ammo_rounds" id="edit_rounds" class="form-control mb-3" readonly>
                            </div>
                            <div class="col-md-6">
                                <label class="small text-info font-weight-bold">RETURN_STATUS_MATRIX</label>
                                <select name="faulty_returns_state" id="edit_status" class="form-control">
                                    <option value="Not-Return">Not-Return (Outstanding)</option>
                                    <option value="Returned">Returned (Asset Accounted For)</option>
                                </select>
                            </div>
                        </div>

                        <label class="small text-info font-weight-bold">ROUNDS_RETURNED (RE-COUNT RESTOCK QUANTITY)</label>
                        <input type="number" name="faulty_ammo_returned" id="edit_returned_rounds" class="form-control" min="0" required>
                        <small class="form-text text-muted mb-3">This quantity will dynamically update the main stockpile inventory.</small>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-outline-light" style="border-radius:0;" data-dismiss="modal">ABORT</button>
                        <button type="submit" id="submitBtn" class="btn btn-neon px-4">COMMIT_CHANGES_TO_STOCK</button>
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

    <script>
    function showToast(msg, type) {
        let signalHeader = "[SYSTEM_NOTIFICATION]";
        if(type === 't-success') signalHeader = "[SYS_SIGNAL: TRANSACTION_COMMITTED]";
        if(type === 't-error') signalHeader = "[SYS_SIGNAL: CORE_ABORT_EXCEPTION]";
        if(type === 't-warning') signalHeader = "[SYS_SIGNAL: SYSTEM_ALERT_LOG]";

        const toast = $(`
            <div class="t-toast ${type}">
                <div class="toast-header-text">${signalHeader}</div>
                <div>${msg}</div>
            </div>
        `);
        $("#tactical-toast-container").append(toast);
        toast.fadeIn(250).delay(4000).fadeOut(300, function() { $(this).remove(); });
    }

    function showTacticalConfirm(msg, onConfirm) {
        const confirmId = 'confirm-' + Math.floor(Math.random() * 10000);
        const toastConfirm = $(`
            <div class="t-toast t-warning" id="${confirmId}" style="display:block;">
                <div class="toast-header-text">[SYS_ALERT: CRITICAL_ACTION_CONFIRMATION]</div>
                <div>${msg}</div>
                <div class="toast-actions">
                    <button class="btn btn-xs btn-outline-light btn-cancel-toast" style="border-radius:0; font-size:10px;">DENY</button>
                    <button class="btn btn-xs btn-danger btn-confirm-toast" style="border-radius:0; font-size:10px; background:#ff3e3e; color:#fff;">CONFIRM_EXECUTE</button>
                </div>
            </div>
        `);
        
        $("#tactical-toast-container").append(toastConfirm);
        
        toastConfirm.find('.btn-cancel-toast').on('click', function() {
            toastConfirm.fadeOut(200, function() { $(this).remove(); });
        });

        toastConfirm.find('.btn-confirm-toast').on('click', function() {
            toastConfirm.remove();
            onConfirm();
        });
    }

    $(document).ready(function() {
        var table = $('#ammoLogTable').DataTable({
            "responsive": true, 
            "autoWidth": false,
            "dom": 'Bfrtip',
            "buttons": [
                { extend: "excelHtml5", text: "[ EXCEL ]", exportOptions: { columns: ':not(.no-export)' } },
                { 
                    extend: "pdfHtml5", 
                    text: "[ PDF ]", 
                    exportOptions: { columns: ':not(.no-export)' },
                    customize: function (doc) {
                        doc.styles.tableHeader.fillColor = '#05070a';
                        doc.styles.tableHeader.color = '#00f2ff';
                        doc.defaultStyle.font = 'Courier';
                    }
                },
                { extend: "print", text: "[ PRINT ]", exportOptions: { columns: ':not(.no-export)' } }
            ],
            "pageLength": 15,
            "columnDefs": [{ "searchable": false, "orderable": false, "targets": [0, 6] }],
            "order": [] 
        });

        table.on('order.dt search.dt', function () {
            table.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                cell.innerHTML = `<strong>${i + 1}</strong>`;
            });
        }).draw();

        window.filterOverdue = function() {
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                return $(table.row(dataIndex).node()).attr('data-overdue') === '1';
            });
            table.draw();
            $.fn.dataTable.ext.search.pop();
            showToast("TERMINAL_FILTER: MOUNTED_OVERDUE_ONLY", "t-warning");
        };

        $('#updateForm').submit(function(e) {
            e.preventDefault();
            const submitBtn = $('#submitBtn');
            
            const issued = parseInt($('#edit_rounds').val(), 10);
            const returned = parseInt($('#edit_returned_rounds').val(), 10);
            if (returned > issued) {
                showToast("INPUT_REJECTED: Count returned exceeds quantity issued.", "t-error");
                return false;
            }

            submitBtn.prop('disabled', true).text('PROCESSING_UPLINK...');

            $.post('process-booked-blank-ammo.php', $(this).serialize(), function(res) {
                if(res.status == 'success') {
                    showToast("LOG_REGISTRY_UPDATED_SUCCESSFULLY", "t-success");
                    $('#updateModal').modal('hide');
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showToast("CORE_ABORT: " + res.message, "t-error");
                }
            }, 'json').fail(function() {
                showToast("COMMS_FAULT: LINK TO BACKEND DISRUPTED", "t-error");
            }).always(function() {
                submitBtn.prop('disabled', false).text('COMMIT_CHANGES_TO_STOCK');
            });
        });
    });

    function viewDetails(data) {
        $('#v_image').attr('src', data.officer_image ? data.officer_image : 'assets/images/faces/profile_placeholder.jpg');
        $('#v_officer').text(data.to_officer.toUpperCase());
        $('#v_name').text(data.faulty_ammo_name);
        $('#v_issued').text(data.faulty_ammo_rounds + ' RDS');
        $('#v_returned').text(data.faulty_ammo_returned + ' RDS');
        $('#v_issuer').text(data.armourer_issuer);
        $('#v_rtime').text(data.returned_time.trim() ? data.returned_time : 'CRADLED IN FIELD');
        $('#viewModal').modal('show');
    }

    function editBooking(data) {
        $('#edit_id').val(data.blank_ammoID);
        $('#edit_faulty_ammoID').val(data.faulty_ammoID); // Safely sets target reference
        $('#edit_ammo_name').val(data.faulty_ammo_name);
        $('#edit_rounds').val(data.faulty_ammo_rounds);
        $('#edit_returned_rounds').val(data.faulty_ammo_returned).attr('max', data.faulty_ammo_rounds);
        $('#edit_status').val(data.faulty_returns_state);
        
        if(parseInt(data.faulty_ammo_returned, 10) === 0) {
            $('#edit_status').val('Returned');
            $('#edit_returned_rounds').val(data.faulty_ammo_rounds);
        }
        $('#updateModal').modal('show');
    }

    function triggerTacticalPurge(id) {
        showTacticalConfirm("[ CRITICAL WARNING ] PURGE LOG ENTRY PERMANENTLY FROM ARCHIVE? This action cannot be reversed.", function() {
            $.post('process-booked-blank-ammo.php', {action: 'delete', blank_ammoID: id}, function(res) {
                if(res.status == 'success') {
                    showToast("ENTRY_PURGED_FROM_ACTIVE_LOGS", "t-warning");
                    $(`#log-row-${id}`).fadeOut(400, function() { $(this).remove(); });
                    setTimeout(() => location.reload(), 1000);
                } else {
                    showToast("PURGE_ABORTED: " + res.message, "t-error");
                }
            }, 'json').fail(function() {
                showToast("COMMS_FAULT: INSUFFICIENT SYSTEM PRIVILEGES", "t-error");
            });
        });
    }
    </script>
</body>
</html>