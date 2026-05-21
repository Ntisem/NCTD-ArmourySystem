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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AMMO_LOG | NCTD ARMOURY SYSTEM</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@300;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <link rel="icon" href="assets/images/favicon.png" type="image/png">
    <style>
        :root { 
            --neon: #00f2ff; 
            --bg-deep: #05070a; 
            --card-bg: #0d1117; 
            --danger: #ff3333; 
            --success: #00ff88;
            --warning: #ffaa00;
        }
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background: var(--bg-deep); 
            font-family: 'Roboto Mono', monospace; 
            color: #e0e0e0;
        }
        
        .container-scroller {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            width: 100% !important;
            max-width: 100% !important;
        }
        .page-body-wrapper { 
            padding-top: 0 !important; 
            display: flex;
            flex-direction: row;
            flex: 1;
            width: 100% !important;
            max-width: 100% !important;
            min-height: 100%;
        }
        .main-panel { 
            display: flex; 
            flex-direction: column;
            width: 100% !important; 
            max-width: 100% !important; 
            min-height: 100vh;
            background: var(--bg-deep);
        }
        .content-wrapper { 
            width: 100% !important; 
            max-width: 100% !important;
            flex: 1 0 auto; 
            padding: 2rem 2.5rem !important;
            background: transparent !important;
        }
        footer.footer {
            flex-shrink: 0;
            width: 100% !important;
            background: #000000 !important;
            border-top: 2px solid var(--warning);
            padding: 1.5rem 2.5rem !important;
        }

        .card { 
            background: var(--card-bg); 
            border: 1px solid #1f2937; 
            width: 100%;
            margin-bottom: 1.5rem;
        }
        .table-responsive {
            width: 100% !important;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        #ammoLogTable {
            width: 100% !important;
            margin: 0 !important;
        }
        
        .terminal-title { font-family: 'Orbitron', sans-serif; letter-spacing: 2px; color: var(--neon); }
        .form-control, .form-select {
            background-color: #020408 !important;
            border: 1px solid #2d3748 !important;
            color: #ffffff !important;
            font-family: 'Roboto Mono', monospace;
        }
        .form-control:focus { border-color: var(--neon) !important; box-shadow: 0 0 5px rgba(0, 242, 255, 0.5); }
        .modal-content { background: var(--card-bg); border: 2px solid var(--neon); color: #fff; }
        .modal-header { border-bottom: 1px solid #1f2937; }
        .modal-footer { border-top: 1px solid #1f2937; }
        .badge-tactical { font-weight: bold; font-family: 'Orbitron', sans-serif; padding: 5px 10px; }
        .badge-outline-danger { border: 1px solid var(--danger); color: var(--danger); background: transparent; }
        .badge-outline-success { border: 1px solid var(--success); color: var(--success); background: transparent; }
        
        .btn-xs {
            padding: 0.3rem 0.6rem;
            font-size: 0.75rem;
            line-height: 1.5;
            border-radius: 0.2rem;
            margin: 2px;
            white-space: nowrap;
        }

        /* Toastr Custom Interactive Override CSS Container */
        #toast-container > .toast-error { background-color: #1a0505 !important; border: 1px solid var(--danger) !important; color: #ff9999 !important; opacity: 1 !important; }
        #toast-container > .toast { background-image: none !important; box-shadow: 0 0 12px rgba(0,242,255,0.2) !important; }
        .toastr-confirm-btn-group { margin-top: 10px; display: flex; gap: 8px; justify-content: flex-end; }

        @media (max-width: 768px) {
            .content-wrapper { padding: 1rem !important; }
            .terminal-title { font-size: 1.1rem; }
            .btn-fw { width: 100%; margin-top: 10px; }
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel">
                <div class="content-wrapper">
                    <a href="javascript:history.back()" class="btn btn-outline-light mb-3"><i class="mdi mdi-arrow-left"></i> Back</a>
                    <div class="row align-items-center mb-4">
                        <div class="col-12 col-lg-8">
                            <h4 class="terminal-title m-0"><i class="mdi mdi-shield-half-full text-neon"></i> AMMUNITION_DEPLOYMENT_ACTIVE_LOGS</h4>
                        </div>
                        <div class="col-12 col-lg-4 text-lg-right mt-3 mt-lg-0">
                            <?php if($overdueCount > 0): ?>
                                <button onclick="filterOverdue()" class="btn btn-outline-danger btn-fw animate-pulse m-0">
                                    <i class="mdi mdi-alert-circle"></i> DETECTED [<?= $overdueCount ?>] PENDING_RETURNS
                                </button>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="ammoLogTable" class="table table-dark table-hover border-secondary">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>OFFICER_NAME</th>
                                                    <th>AMMUNITION_TYPE</th>
                                                    <th>ISSUED_RNDS</th>
                                                    <th>RETURNED_RNDS</th>
                                                    <th>STATUS</th>
                                                    <th>DEPLOYMENT_TIME</th>
                                                    <th>RETURN_TIME</th>
                                                    <th class="text-center">ACTIONS_MATRIX</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $stmt = $pdo->query("SELECT * FROM ammo_bookings ORDER BY book_ammoID DESC");
                                                $counter = 1;
                                                while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                                    $isOverdue = ($row['ammo_returns'] === 'Not-Return') ? '1' : '0';
                                                    echo "<tr data-overdue='{$isOverdue}'>";
                                                    echo "<td class='text-muted font-weight-bold'>".$counter++."</td>";
                                                    echo "<td>".htmlspecialchars($row['to_officer'])."</td>";
                                                    echo "<td class='text-neon'>".htmlspecialchars($row['ammo_name'])."</td>";
                                                    echo "<td>".htmlspecialchars($row['ammo_rounds'])."</td>";
                                                    echo "<td class='text-warning'>".htmlspecialchars($row['ammo_returned'])."</td>";
                                                    echo "<td>";
                                                    if($row['ammo_returns'] === 'Returned') {
                                                        echo "<span class='badge badge-tactical badge-outline-success'>RETURNED</span>";
                                                    } else {
                                                        echo "<span class='badge badge-tactical badge-outline-danger'>NOT_RETURNED</span>";
                                                    }
                                                    echo "</td>";
                                                    echo "<td>".htmlspecialchars($row['booking_time'])."</td>";
                                                    echo "<td>".htmlspecialchars($row['returned_time'])."</td>";
                                                    echo "<td class='text-center' style='white-space: nowrap; width: 1%;'>";
                                                    
                                                    $jsonData = json_encode($row, JSON_HEX_APOS | JSON_HEX_QUOT);
                                                    echo "<button class='btn btn-outline-info btn-xs' onclick='editBooking({$jsonData})'><i class='mdi mdi-cached'></i> RETURN_FORM</button> ";
                                                    echo "<button class='btn btn-outline-danger btn-xs' onclick='requestPurgeConfirmation(".htmlspecialchars($row['book_ammoID']).")'><i class='mdi mdi-delete-forever'></i> DELETE</button>";
                                                    echo "</td>";
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title terminal-title" id="updateModalLabel"><i class="mdi mdi-refresh text-neon"></i> LOG_REGISTRY_UPDATE_INTERFACE</h5>
                    <button type="button" class="close text-white" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateForm">
                    <input type="hidden" name="action" value="update">
                    <input type="hidden" id="edit_id" name="book_ammoID">
                    
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="edit_rounds" class="text-muted">TOTAL QUANTITY DEPLOYED (ISSUED)</label>
                            <input type="number" class="form-control" id="edit_rounds" name="ammo_rounds" readonly>
                        </div>
                        
                        <div class="form-group mb-3">
                            <label for="edit_returned_rounds" class="text-neon">QUANTITY OF ROUNDS RETURNED TO ARMOURY</label>
                            <input type="number" class="form-control text-white" id="edit_returned_rounds" name="ammo_returned" required min="0">
                            <small class="form-text text-muted">Cannot exceed total rounds deployed.</small>
                        </div>

                        <div class="form-group mb-3">
                            <label for="edit_status" class="text-muted">REGISTRY RETURN STATUS</label>
                            <select class="form-control" id="edit_status" name="ammo_returns" required>
                                <option value="Not-Return">NOT_RETURNED (Pending/Incomplete)</option>
                                <option value="Returned">RETURNED (Restocks Master Inventory)</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-light" data-bs-dismiss="modal">ABORT_COMMS</button>
                        <button type="submit" class="btn btn-info"><i class="mdi mdi-telegram"></i> COMMIT_TRANSACTION</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

    <script>
    $(document).ready(function() {
        var table = $('#ammoLogTable').DataTable({
            "responsive": false, 
            "order": [[0, "asc"]], // Sorted chronologically by auto-increment column layout #
            "pageLength": 15,
            "autoWidth": false
        });

        toastr.options = {
            "closeButton": true,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "timeOut": "4000"
        };

        window.filterOverdue = function() {
            $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
                return $(table.row(dataIndex).node()).attr('data-overdue') === '1';
            });
            table.draw();
            $.fn.dataTable.ext.search.pop();
            toastr.warning("TERMINAL_FILTER: DISPLAYING OVERDUE_ONLY");
        };

        $('#edit_returned_rounds').on('input', function() {
            let issued = parseInt($('#edit_rounds').val()) || 0;
            let returned = parseInt($(this).val()) || 0;
            if(returned > issued) {
                toastr.error("CONSTRAINT_FAULT: Returned count exceeds total issued rounds.");
                $(this).val(issued);
                returned = issued;
            }
            if(returned === issued && issued > 0) {
                $('#edit_status').val('Returned');
            } else if (returned < issued) {
                $('#edit_status').val('Not-Return');
            }
        });
    });

    function editBooking(data) {
        $('#edit_id').val(data.book_ammoID);
        $('#edit_rounds').val(data.ammo_rounds);
        $('#edit_returned_rounds').val(data.ammo_returned).attr('max', data.ammo_rounds);
        $('#edit_status').val(data.ammo_returns);
        $('#updateModal').modal('show');
    }

    // Dynamic Context-Aware Non-Blocking Custom Interactive Toast Box Handler
    function requestPurgeConfirmation(id) {
        toastr.remove(); // Evacuate old toast instances from screen
        
        let confirmMsg = `
            <div><strong>[ CRITICAL WARNING ]</strong><br>PURGE DEPLOYMENT LOG ENTRY PERMANENTLY FROM ARCHIVE?</div>
            <div class="toastr-confirm-btn-group">
                <button type="button" id="confirm-purge-abort" class="btn btn-xs btn-outline-light">ABORT</button>
                <button type="button" id="confirm-purge-exec" class="btn btn-xs btn-danger">EXECUTE PURGE</button>
            </div>
        `;

        let $toast = toastr.error(confirmMsg, "SECURITY REGISTRY INTERACTION", {
            timeOut: 0,
            extendedTimeOut: 0,
            closeButton: false,
            tapToDismiss: false
        });

        if ($toast.length) {
            $toast.delegate('#confirm-purge-abort', 'click', function () {
                $toast.remove();
                toastr.info("OPERATION_ABORTED: Registry state uncompromised.");
            });
            
            $toast.delegate('#confirm-purge-exec', 'click', function () {
                $toast.remove();
                executePurgeTransaction(id);
            });
        }
    }

    function executePurgeTransaction(id) {
        $.post('process-booked-ammo.php', {action: 'delete', book_ammoID: id}, function(res) {
            if(res.status === 'success') {
                toastr.warning("ENTRY_PURGED_FROM_ACTIVE_LOGS");
                setTimeout(() => location.reload(), 1200);
            } else {
                toastr.error("PURGE_ABORTED: " + res.message);
            }
        }, 'json').fail(function() {
            toastr.error("CRITICAL: DATA SYSTEM PERSISTENCE FAILURE");
        });
    }

    $('#updateForm').submit(function(e) {
        e.preventDefault();
        $.post('process-booked-ammo.php', $(this).serialize(), function(res) {
            if(res.status === 'success') {
                toastr.success("LOG_REGISTRY_UPDATED_&_STOCK_RESTOCKED");
                setTimeout(() => location.reload(), 1200);
            } else {
                toastr.error("CORE_ABORT_FAULT: " + res.message);
            }
        }, 'json').fail(function() {
            toastr.error("COMMS_FAULT: LINK TO BACKEND ENGINE INTERRUPTED");
        });
    });
    </script>
</body>
</html>