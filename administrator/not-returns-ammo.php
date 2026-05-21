<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}

// 1. SEARCH LOGIC
$startDate = $_GET['start_date'] ?? null;
$endDate = $_GET['end_date'] ?? null;

$query = "SELECT * FROM ammo_bookings WHERE TRIM(ammo_returns) = 'Not-Return'";
$params = [];

if (!empty($startDate) && !empty($endDate)) {
    $query .= " AND STR_TO_DATE(booking_time, '%M %e, %Y') BETWEEN ? AND ?";
    $params = [$startDate, $endDate];
}
$query .= " ORDER BY book_ammoID DESC";

$stmt = $pdo->prepare($query);
$stmt->execute($params);
$bookings = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>COMMAND_TERMINAL | OUTSTANDING_AMMO</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.22/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.bootstrap4.min.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root { 
            --neon: #00f2ff; 
            --bg-deep: #020408; 
            --card-bg: #0a0d12; 
            --danger: #ff3333; 
            --success: #00ff66;
        }
        body { background: var(--bg-deep); font-family: 'JetBrains Mono', monospace; color: #e0e0e0; }
        .card { background: var(--card-bg); border: 1px solid #00f2ff50; }
        .table { color: #fff; }
        th { color: var(--neon); text-transform: uppercase; }
        .table td { vertical-align: middle; }
        
        /* Tactical Elements Styling */
        .btn-tactical {
            background: transparent;
            border: 1px solid var(--neon);
            color: var(--neon);
            border-radius: 4px;
            font-family: inherit;
            transition: all 0.3s ease;
        }
        .btn-tactical:hover, .btn-tactical:focus {
            background: var(--neon);
            color: var(--bg-deep);
            box-shadow: 0 0 10px var(--neon);
        }
        .btn-danger-tactical {
            background: transparent;
            border: 1px solid var(--danger);
            color: var(--danger);
            border-radius: 4px;
            font-family: inherit;
            transition: all 0.3s ease;
        }
        .btn-danger-tactical:hover {
            background: var(--danger);
            color: #fff;
            box-shadow: 0 0 10px var(--danger);
        }

        /* DataTables Custom Export Buttons Integration */
        .dt-buttons .btn {
            background: transparent !important;
            border: 1px solid #00f2ffaa !important;
            color: var(--neon) !important;
            font-family: inherit !important;
            margin-right: 5px;
            margin-bottom: 15px;
            font-size: 0.85rem;
        }
        .dt-buttons .btn:hover {
            background: var(--neon) !important;
            color: var(--bg-deep) !important;
            box-shadow: 0 0 8px var(--neon);
        }

        /* Tactical Toast System notifications */
        #toast-container {
            position: fixed;
            top: 20px;
            right: 20px;
            z-index: 1099;
        }
        .t-toast {
            background: var(--card-bg);
            border: 1px solid var(--neon);
            border-left: 5px solid var(--neon);
            color: #fff;
            padding: 15px 25px;
            border-radius: 4px;
            font-family: 'JetBrains Mono', monospace;
            box-shadow: 0 0 15px rgba(0, 242, 255, 0.3);
            margin-bottom: 10px;
            display: none;
            min-width: 300px;
        }
        
        .modal-content {
            background: var(--bg-deep);
            border: 2px solid var(--neon);
            box-shadow: 0 0 25px rgba(0, 242, 255, 0.2);
        }
        .form-control, .form-control:disabled, .form-control[readonly] {
            background-color: var(--card-bg) !important;
            border: 1px solid #00f2ff50;
            color: #fff !important;
            font-family: inherit;
        }
        .form-control:focus {
            border-color: var(--neon);
            box-shadow: 0 0 8px var(--neon);
        }
        code.status-indicator {
            background: rgba(255, 51, 51, 0.15);
            color: var(--danger);
            padding: 4px 8px;
            border-radius: 4px;
            border: 1px solid rgba(255, 51, 51, 0.3);
        }
    </style>
</head>
<body>
    <div class="container-scroller">
        <div class="container-fluid page-body-wrapper">
            <div class="main-panel p-4 w-100">

                <div id="toast-container"></div>

                <div class="card mb-4">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <h4 class="text-info mb-0">
                            <i class="mdi mdi-alert-circle text-warning"></i> OUTSTANDING_AMMO_LOG
                        </h4>
                        <div>
                            <a href="booking-ammo.php" class="btn btn-tactical mr-2">
                                <i class="mdi mdi-plus"></i> ALLOCATE_AMMO
                            </a>
                            <a href="javascript:history.back();" class="btn btn-tactical">
                                <i class="mdi mdi-arrow-left"></i> BACK
                            </a>
                        </div>
                    </div>
                </div>

                <div class="card mb-4">
                    <div class="card-body">
                        <form method="GET" class="form-inline mb-4">
                            <label class="mr-2 text-info">FROM:</label>
                            <input type="date" name="start_date" class="form-control mr-3" value="<?= htmlspecialchars($startDate ?? '') ?>">
                            <label class="mr-2 text-info">TO:</label>
                            <input type="date" name="end_date" class="form-control mr-3" value="<?= htmlspecialchars($endDate ?? '') ?>">
                            <button type="submit" class="btn btn-tactical"><i class="mdi mdi-filter"></i> FILTER_LOGS</button>
                            <?php if(!empty($startDate) || !empty($endDate)): ?>
                                <a href="not-returns-ammo.php" class="btn btn-danger-tactical ml-2">CLEAR</a>
                            <?php endif; ?>
                        </form>

                        <div class="table-responsive">
                            <table id="mainTable" class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 5%">#</th>
                                        <th>Booking Time</th>
                                        <th>Officer</th>
                                        <th>Ammo Type</th>
                                        <th>Rounds Issued</th>
                                        <th>Status</th>
                                        <th>Armourer Issuer</th>
                                        <th class="no-export" style="width: 10%">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if(!empty($bookings)): ?>
                                        <?php foreach ($bookings as $b): ?>
                                            <tr id="row-<?= $b['book_ammoID'] ?>">
                                                <td class="row-counter"></td>
                                                <td><?= htmlspecialchars($b['booking_time']) ?></td>
                                                <td><?= htmlspecialchars($b['to_officer']) ?></td>
                                                <td class="ammo-name-cell"><?= htmlspecialchars($b['ammo_name']) ?></td>
                                                <td class="ammo-rounds-cell" data-rounds="<?= (int)$b['ammo_rounds'] ?>"><code><?= htmlspecialchars($b['ammo_rounds']) ?> RDS</code></td>
                                                <td><code class="status-indicator">[<?= htmlspecialchars($b['ammo_returns']) ?>]</code></td>
                                                <td><?= htmlspecialchars($b['armourer_issuer']) ?></td>
                                                <td class="no-export">
                                                    <a href="officer-details?officerID=<?= htmlspecialchars($b['officerID']) ?>" class="btn btn-tactical btn-sm" title="Officer Tracking">
                                                        <i class="mdi mdi-account-search"></i>
                                                    </a>
                                                    <button class="btn btn-tactical btn-sm" onclick="openAmmoReturnModal(<?= $b['book_ammoID'] ?>, '<?= htmlspecialchars(addslashes($b['to_officer'])) ?>', this)" title="Return Allocation">
                                                        <i class="mdi mdi-undo-variant"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php require_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>

    <div class="modal fade" id="ammoReturnModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header border-info">
                    <h5 class="modal-title text-warning"><i class="mdi mdi-undo-variant"></i> PROCESS_AMMO_RECOVERY</h5>
                    <button type="button" class="close text-light" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="ammoReturnForm">
                    <div class="modal-body">
                        <input type="hidden" name="book_ammoID" id="ret_book_ammoID">
                        <input type="hidden" name="action" value="update">
                        
                        <div class="form-group">
                            <label class="text-info font-weight-bold">DEPLOYED_OFFICER</label>
                            <input type="text" id="ret_to_officer" class="form-control" readonly>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-info font-weight-bold">ISSUED_QUANTITY</label>
                                    <input type="text" id="ret_ammo_rounds" name="ammo_rounds" class="form-control" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="text-info font-weight-bold">RETURN_STATUS</label>
                                    <select name="ammo_returns" id="ret_status_select" class="form-control">
                                        <option value="Returned">Returned</option>
                                        <option value="Not-Return" selected>Not-Return</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="text-info font-weight-bold">RETURNED_ROUND_COUNT</label>
                            <input type="number" name="ammo_returned" id="ammo_returned" class="form-control" min="0" value="0" required>
                            <small class="form-text text-muted">Ensure count matches physical verification units.</small>
                        </div>
                    </div>
                    <div class="modal-footer border-info">
                        <button type="button" class="btn btn-danger-tactical" data-dismiss="modal">CANCEL</button>
                        <button type="submit" id="submitBtn" class="btn btn-tactical">COMMIT_CHANGE</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>

    <script>
        let mainDataTable;

        // Custom Toast Notification trigger
        function spawnToast(signal, msg) {
            const borderCol = signal === 'success' ? 'var(--success)' : 'var(--danger)';
            const headerText = signal === 'success' ? '[SYS_SIGNAL: TRANSACTION_COMMITTED]' : '[SYS_SIGNAL: EXCEPTION_ERROR]';
            
            const toastElement = $(`
                <div class="t-toast" style="border-left: 5px solid ${borderCol}">
                    <div class="font-weight-bold text-info mb-1">${headerText}</div>
                    <div>${msg}</div>
                </div>
            `).appendTo('#toast-container');
            
            toastElement.fadeIn(300).delay(4000).fadeOut(400, function() {
                $(this).remove();
            });
        }

        $(document).ready(function() {
            // Instantiate DataTables with layout modifications and export controls
            mainDataTable = $('#mainTable').DataTable({
                "responsive": true,
                "autoWidth": false,
                "pageLength": 10,
                "order": [[1, "desc"]], // Sort via original booking timestamps
                "columnDefs": [{
                    "searchable": false,
                    "orderable": false,
                    "targets": [0, 7] // Ignore index column and action buttons
                }],
                "dom": "<'row'<'col-md-6'B><'col-md-6'f>>" +
                       "<'row'<'col-sm-12'tr>>" +
                       "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
                "buttons": [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="mdi mdi-file-excel"></i> EXPORT_EXCEL',
                        className: 'btn btn-tactical',
                        exportOptions: { columns: ':not(.no-export)' }
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="mdi mdi-file-pdf"></i> GENERATE_PDF',
                        className: 'btn btn-tactical',
                        exportOptions: { columns: ':not(.no-export)' },
                        customize: function (doc) {
                            doc.styles.tableHeader.fillColor = '#0a0d12';
                            doc.styles.tableHeader.color = '#00f2ff';
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="mdi mdi-printer"></i> PRINT_TERMINAL',
                        className: 'btn btn-tactical',
                        exportOptions: { columns: ':not(.no-export)' }
                    }
                ]
            });

            // Dynamic Sequential Auto-Numbering Calculation logic
            mainDataTable.on('order.dt search.dt', function () {
                mainDataTable.column(0, { search: 'applied', order: 'applied' }).nodes().each(function (cell, i) {
                    cell.innerHTML = `<strong>${i + 1}</strong>`;
                });
            }).draw();

            // Handle AJAX transactional processing for ammo return mapping
            $('#ammoReturnForm').on('submit', function(e) {
                e.preventDefault();
                
                const submitBtn = $('#submitBtn');
                const originalBtnText = submitBtn.text();
                
                // Form valid state rules checking
                const issuedRounds = parseInt($('#ret_ammo_rounds').val(), 10);
                const returnedRounds = parseInt($('#ammo_returned').val(), 10);
                const targetStatus = $('#ret_status_select').val();

                if (returnedRounds > issuedRounds) {
                    spawnToast('error', 'INVENTORY_CRITICAL: Returned count exceeds original assignment limits.');
                    return false;
                }

                if (targetStatus === 'Returned' && returnedRounds === 0 && issuedRounds > 0) {
                    if (!confirm("[WARNING]: Status flagged 'Returned' with 0 physical units. Proceed?")) {
                        return false;
                    }
                }

                submitBtn.prop('disabled', true).text('PROCESSING_TRANSACTION...');

                $.ajax({
                    url: 'process-return-ammo.php',
                    type: 'POST',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.status === 'success') {
                            const targetId = $('#ret_book_ammoID').val();
                            
                            spawnToast('success', 'Operation committed cleanly. Main armory tables restocked.');
                            $('#ammoReturnModal').modal('hide');
                            
                            // If status is flipped to 'Returned', drop it smoothly from the active outstanding log view
                            if (targetStatus === 'Returned') {
                                mainDataTable.row(`#row-${targetId}`).remove().draw(false);
                            }
                        } else {
                            spawnToast('error', `REJECTION: ${response.message}`);
                        }
                    },
                    error: function(xhr, status, error) {
                        spawnToast('error', `SERVER_FAULT: Fallback transaction aborted.`);
                        console.error(xhr.responseText);
                    },
                    complete: function() {
                        submitBtn.prop('disabled', false).text(originalBtnText);
                    }
                });
            });
        });

        function openAmmoReturnModal(id, officerName, element) {
            const activeRow = $(element).closest('tr');
            const roundsIssued = activeRow.find('.ammo-rounds-cell').data('rounds');

            // Map data elements accurately into inputs
            $('#ret_book_ammoID').val(id);
            $('#ret_to_officer').val(officerName);
            $('#ret_ammo_rounds').val(roundsIssued);
            $('#ammo_returned').val(roundsIssued).attr('max', roundsIssued); // Auto fill count + assign bounds boundaries
            $('#ret_status_select').val('Returned'); // Default toggle preference to close outstanding state
            
            $('#ammoReturnModal').modal('show');
        }
    </script>
</body>
</html>