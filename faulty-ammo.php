<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

$query = "SELECT * FROM faulty_ammo WHERE is_deleted = 0 ORDER BY faulty_ammoID DESC";
$stmt_faulty = $pdo->query($query);
$faulty_ammo = $stmt_faulty->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>[GPS COMMAND] - FAULTY MATERIAL CONTROL TERMINAL</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
      :root {
        --bg-tactical: #0d0f12; --panel-bg: #15181f;
        --neon: #00f2ff; --danger: #ff4d4d; --text-tactical: #e0e0e0;
      }
      body { background-color: var(--bg-tactical); color: var(--text-tactical); }
      .card { background-color: var(--panel-bg); border: 1px solid rgba(255, 255, 255, 0.1); }
      .table-dark { color: var(--text-tactical); background-color: var(--panel-bg); }
      .btn-tactical { background: transparent; border: 1px solid var(--neon); color: var(--neon); font-family: monospace; }
      .btn-tactical:hover { background: var(--neon); color: #000; }
      .btn-danger-tactical { background: transparent; border: 1px solid var(--danger); color: var(--danger); font-family: monospace; }
      .btn-danger-tactical:hover { background: var(--danger); color: #000; }
      #toast-container { position: fixed; top: 25px; right: 25px; z-index: 99999; }
      .t-toast { background: #1a1f2c; color: #fff; padding: 16px 24px; border-radius: 4px; font-family: monospace; box-shadow: 0 6px 20px rgba(0,0,0,0.7); margin-bottom: 12px; font-size: 13px; font-weight: bold; display: none; }
      .modal-content { background-color: var(--panel-bg); border: 1px solid var(--neon); color: var(--text-tactical); font-family: monospace; }
      .form-control { background-color: #1a1f2c; color: #fff; border: 1px solid rgba(255,255,255,0.1); }
      .dt-buttons .dt-button { background: #1a1f2c !important; color: var(--neon) !important; border: 1px solid rgba(0,242,255,0.3) !important; font-family: monospace !important; font-weight: bold !important; }
      .dt-buttons .dt-button:hover { background: var(--neon) !important; color: #000 !important; }
      .dataTables_wrapper .dataTables_filter input { background: #1a1f2c; color: #fff; border: 1px solid rgba(255,255,255,0.2); padding: 6px; }
    </style>
  </head>
  <body>
    <div id="toast-container"></div>
    <div class="container-scroller">
      <?php require_once('includes/sidebar.php'); ?>
      <div class="container-fluid page-body-wrapper">
        <?php require_once('includes/navbar.php'); ?>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header d-flex justify-content-between align-items-center">
            <h3 class="page-title text-light">[SECURITY MODULE] // BLANK_AMMO</h3>
            <a href="add-faulty-ammo" class="btn btn-tactical"><i class="mdi mdi-plus-box"></i> INTIALIZE BLANK AMMO</a>
            <a href="booking-blank-ammo" class="btn btn-outline-primary"><i class="mdi mdi-file"></i> DEPLOY BLANK/FAULTY AMMO</a>            </div>
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="table-responsive">
                      <table id="faulty-ammo-table" class="table table-dark table-striped table-hover">
                        <thead>
                          <tr>
                            <th>SYS_NO</th>
                            <th>Manufacturer Profile</th>
                            <th>Designation Model</th>
                            <th>Quantity (Rnds)</th>
                            <th>Fault Mode</th>
                            <th>Reporting Officer</th>
                            <th>Timestamp</th>
                            <th class="text-right">Actions</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php $cnt = 1; foreach ($faulty_ammo as $row): ?>
                          <tr>
                            <td><?= $cnt++; ?></td>
                            <td><strong><?= htmlspecialchars($row['faulty_ammo_manufacturer']) ?></strong></td>
                            <td class="text-info"><?= htmlspecialchars($row['faulty_ammo_name']) ?></td>
                            <td><span class="badge badge-outline-warning"><?= htmlspecialchars($row['faulty_ammo_quantity']) ?></span></td>
                            <td class="text-danger"><?= htmlspecialchars($row['faulty_type']) ?></td>
                            <td class="text-secondary"><?= htmlspecialchars($row['returned_by_officer'] ?? 'N/A') ?></td>
                            <td><small><?= htmlspecialchars($row['datetime']) ?></small></td>
                            <td class="text-right">
                              <div class="btn-group">
                                <button class="btn btn-outline-info btn-sm" onclick='viewDetails(<?= json_encode($row, JSON_HEX_APOS | JSON_HEX_QUOT); ?>)'><i class="mdi mdi-eye"></i></button>
                                <button class="btn btn-outline-warning btn-sm" onclick='openUpdateModal(<?= json_encode($row, JSON_HEX_APOS | JSON_HEX_QUOT); ?>)'><i class="mdi mdi-pencil-box-outline"></i></button>
                                <button class="btn btn-outline-success btn-sm" onclick="openFixModal(<?= $row['faulty_ammoID'] ?>)"><i class="mdi mdi-check-circle-outline"></i></button>
                                <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete(<?= $row['faulty_ammoID'] ?>)"><i class="mdi mdi-close-circle-outline"></i></button>
                              </div>
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
          <?php require_once('includes/footer.php'); ?>
        </div>
      </div>
    </div>

    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-info">[STREAM]: ANALYSIS_METRICS_EXPANSION</h5>
            <button type="button" class="btn-close text-white border-0 bg-transparent" data-bs-dismiss="modal" style="font-size:20px;">&times;</button>
          </div>
          <div class="modal-body" id="viewModalBody"></div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <form action="process-faulty-ammo.php" method="POST">
            <div class="modal-header">
              <h5 class="modal-title">[ALIGNED CONFIGURATION REWRITES]</h5>
              <button type="button" class="btn-close text-white border-0 bg-transparent" data-bs-dismiss="modal" style="font-size:20px;">&times;</button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="faulty_ammoID" id="edit_faulty_ammoID">
              <div class="form-group">
                <label>Ammunition Stock Name</label>
                <input type="text" class="form-control" name="faulty_ammo_name" id="edit_ammo_name" required readonly>
              </div>
              <div class="form-group">
                <label>Manufacturer Stamp</label>
                <input type="text" class="form-control" name="faulty_ammo_manufacturer" id="edit_manufacturer" readonly required>
              </div>
              <div class="form-group">
                <label>Quantity Affected</label>
                <input type="number" class="form-control" name="faulty_ammo_quantity" id="edit_qty" required min="1">
              </div>
              <div class="form-group">
                <label>Failure Classification Mode</label>
                <select class="form-control" name="faulty_type" id="edit_fault_type" required>
                  <option value="Breakage">Breakage</option>
                  <option value="Misfire">Misfire</option>
                  <option value="Corrosion">Corrosion</option>
                  <option value="Dent">Dent</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div class="form-group">
                <label>Diagnostic Assessment Comments</label>
                <textarea class="form-control" name="faulty_ammo_comment" id="edit_comment" rows="3"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger-tactical" data-bs-dismiss="modal">ABORT</button>
              <button type="submit" name="update_faulty_ammo" class="btn btn-tactical">COMMIT CHANGES</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-color: var(--danger);">
          <form action="process-faulty-ammo.php" method="POST">
            <div class="modal-header">
              <h5 class="modal-title text-danger">[ALERT]: SYSTEM_LEDGER_DELETE</h5>
            </div>
            <div class="modal-body">
              <input type="hidden" name="faulty_ammoID" id="delete_id">
              <p>Warning: This will clear this entry from active analytics logs. Proceed?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-tactical" data-bs-dismiss="modal">CANCEL</button>
              <button type="submit" name="delete_faulty_ammo" class="btn btn-danger-tactical">EXECUTE DELETE</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="fixModal" tabindex="-1" role="dialog">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="border-color: #00ff66;">
          <form action="process-faulty-ammo.php" method="POST">
            <div class="modal-header">
              <h5 class="modal-title text-success">[RECOVERY]: MARK_COMPONENT_CERTIFIED</h5>
            </div>
            <div class="modal-body">
              <input type="hidden" name="faulty_ammoID" id="fix_id">
              <p>Execute dynamic recovery validation? This actions closeout tracing procedures and safely returns balance metrics into structural operational reserves.</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger-tactical" data-bs-dismiss="modal">ABORT</button>
              <button type="submit" name="mark_fixed" class="btn btn-tactical" style="border-color:#00ff66; color:#00ff66;">RESTORE STOCK LEVELS</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <script>
      $(document).ready(function() {
          $('#faulty-ammo-table').DataTable({
              responsive: true,
              order: [[0, "asc"]],
              dom: 'Bfrtip',
              buttons: [
                  { extend: 'copy', text: '[COPY]', className: 'dt-button' },
                  { extend: 'csv', text: '[CSV]', className: 'dt-button' },
                  { extend: 'excel', text: '[EXCEL]', className: 'dt-button' },
                  { extend: 'pdf', text: '[PDF]', className: 'dt-button' },
                  { extend: 'print', text: '[PRINT]', className: 'dt-button' }
              ]
          });

          // Precise Toast messaging verifying dynamic actions
          const params = new URLSearchParams(window.location.search);
          if(params.has('status')) {
              let status = params.get('status');
              let toast = document.createElement('div');
              toast.className = 't-toast';
              if (status === 'success') {
                  toast.innerHTML = `[SIGNAL]: TRANSACTION_COMMITTED_SUCCESSFULLY`;
                  toast.style.borderLeft = '5px solid var(--neon)';
              } else {
                  toast.innerHTML = `[CRITICAL_ERR]: TRANSACTION_FAILED_ROLLBACK_SAFEGUARDS_ENGAGED`;
                  toast.style.borderLeft = '5px solid var(--danger)';
              }
              document.getElementById('toast-container').appendChild(toast);
              $(toast).fadeIn(300).delay(4000).fadeOut(300, function() { $(this).remove(); });
          }
      });

      function viewDetails(item) {
          let mediaElement = item.faulty_ammo_image ? `<img src="${item.faulty_ammo_image}" style="max-width:100%; height:auto; border:1px solid var(--neon); border-radius:4px;">` : `<span class='text-muted'>[NO EVIDENCE ARCHIVED]</span>`;
          let displayHtml = `
            <table class="table table-bordered table-dark text-white">
              <tr><th>MANUFACTURER</th><td class="text-warning">${item.faulty_ammo_manufacturer}</td></tr>
              <tr><th>DESIGNATION</th><td>${item.faulty_ammo_name}</td></tr>
              <tr><th>ROUNDS IMPACTED</th><td>${item.faulty_ammo_quantity} Units</td></tr>
              <tr><th>FAILURE TYPE</th><td class="text-danger">${item.faulty_type}</td></tr>
              <tr><th>REMARKS</th><td>${item.faulty_ammo_comment}</td></tr>
              <tr><th>REPORTING OFFICER</th><td class="text-info">${item.returned_by_officer}</td></tr>
              <tr><th>TIMESTAMP</th><td>${item.datetime}</td></tr>
              <tr><th>VISUAL EVIDENCE</th><td>${mediaElement}</td></tr>
            </table>`;
          $('#viewModalBody').html(displayHtml);
          $('#viewModal').modal('show');
      }

      function openUpdateModal(item) {
          $('#edit_faulty_ammoID').val(item.faulty_ammoID);
          $('#edit_ammo_name').val(item.faulty_ammo_name);
          $('#edit_manufacturer').val(item.faulty_ammo_manufacturer); 
          $('#edit_qty').val(item.faulty_ammo_quantity);
          $('#edit_fault_type').val(item.faulty_type);
          $('#edit_comment').val(item.faulty_ammo_comment);
          $('#updateModal').modal('show');
      }

      function confirmDelete(id) { $('#delete_id').val(id); $('#deleteModal').modal('show'); }
      function openFixModal(id) { $('#fix_id').val(id); $('#fixModal').modal('show'); }
    </script>
  </body>
</html>