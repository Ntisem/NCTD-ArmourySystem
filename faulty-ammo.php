<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

$username = $_SESSION['username'];
$stmt = $pdo->prepare("SELECT adminID, fullname, service_no, rank, profile_image, user_role FROM admin_lists WHERE username = ?");
$stmt->execute([$username]);
$admin_data = $stmt->fetch();
if ($admin_data) {
    $_SESSION['fullname'] = $admin_data['fullname'];
    $_SESSION['user_role'] = $admin_data['user_role'];
    $_SESSION['service_no'] = $admin_data['service_no'];
    $_SESSION['rank'] = $admin_data['rank'];
    $_SESSION['adminID'] = $admin_data['adminID'];
    $_SESSION['armourer_admin_name'] = $admin_data['service_no'] . ' ' . $admin_data['rank'] . ' ' . $admin_data['fullname'];
}

$query = "SELECT * FROM faulty_ammo ORDER BY faulty_ammoID DESC";
$stmt_faulty = $pdo->query($query);
$faulty_ammo = $stmt_faulty->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GPS ARMOURY SYSTEM - BLANK/FAULTY AMMUNITION</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
      :root {
        --bg-tactical: #0d0f12;
        --panel-bg: #15181f;
        --neon: #00f2ff;
        --danger: #ff4d4d;
        --text-tactical: #e0e0e0;
      }
      body {
        background-color: var(--bg-tactical);
        color: var(--text-tactical);
      }
      .card {
        background-color: var(--panel-bg);
        border: 1px solid rgba(255, 255, 255, 0.1);
      }
      .form-control {
        background-color: #1a1f2c;
        border: 1px solid rgba(255, 255, 255, 0.1);
        color: var(--text-tactical);
      }
      .form-control:focus {
        background-color: #1a1f2c;
        border-color: var(--neon);
        color: var(--text-tactical);
      }
      .btn-tactical {
        background: transparent;
        border: 1px solid var(--neon);
        color: var(--neon);
        padding: 6px 14px;
        font-weight: bold;
      }
      .btn-tactical:hover {
        background: var(--neon);
        color: var(--bg-tactical);
      }
      .btn-danger-tactical {
        background: transparent;
        border: 1px solid var(--danger);
        color: var(--danger);
        padding: 6px 14px;
        font-weight: bold;
      }
      .btn-danger-tactical:hover {
        background: var(--danger);
        color: var(--bg-tactical);
      }
      #toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
      }
      .t-toast {
        display: none;
        background: var(--panel-bg);
        color: #fff;
        padding: 15px 20px;
        border-left: 5px solid var(--neon);
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        font-family: monospace;
        font-size: 14px;
        margin-bottom: 10px;
      }
      .table-dark {
        color: var(--text-tactical);
        background-color: var(--panel-bg);
      }
      .table-dark th, .table-dark td {
        border-color: rgba(255, 255, 255, 0.1);
      }
      div.dataTables_wrapper div.dataTables_length select,
      div.dataTables_wrapper div.dataTables_filter input {
        color: #fff;
        background-color: #1a1f2c;
        border: 1px solid rgba(255, 255, 255, 0.1);
      }
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
            <div class="page-header">
              <h3 class="page-title text-light">BLANK/FAULTY AMMUNITION</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="add-faulty-ammo.php" style="color:var(--neon);">Add Blank Ammo</a></li>
                  <li class="breadcrumb-item active text-light" aria-current="page">Faulty Ammunitions</li>
                </ol>
              </nav>
            </div>
            
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <!-- <h4 class="card-title text-light">Faulty Ammunition List</h4> -->
                   <div class="table-responsive">
                    <table class="table table-dark table-striped table-hover align-middle" style="width: 100%; border-color: #2b3036;">
                        <thead>
                            <tr class="border-bottom border-secondary">
                                <th scope="col" style="width: 5%;">#</th>
                                <th scope="col">Manufacturer</th>
                                <th scope="col">Serial No.</th>
                                <th scope="col" style="width: 10%;">Quantity</th>
                                <th scope="col">Fault</th>
                                <th scope="col">Remarks</th>
                                <th scope="col">Returned By</th>
                                <th scope="col" style="width: 12%;">Date</th>
                                <th scope="col" style="width: 15%; text-align: right;">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $cnt = 1; foreach ($faulty_ammo as $row): ?>
                            <tr>
                                <th scope="row" class="text-muted"><?= $cnt++; ?></th>
                                <td><strong><?= htmlspecialchars($row['faulty_ammo_manufacturer']) ?></strong></td>
                                <td><span class="font-monospace text-warning"><?= htmlspecialchars($row['faulty_ammo_serial_no']) ?></span></td>
                                <td>
                                    <span class="badge bg-secondary text-light px-2 py-1">
                                        <?= htmlspecialchars($row['faulty_ammo_quantity']) ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="text-danger fw-bold"><?= htmlspecialchars($row['faulty_type']) ?></span>
                                </td>
                                <td class="text-light opacity-75"><?= htmlspecialchars($row['faulty_ammo_comment']) ?></td>
                                <td><span class="text-info"><?= htmlspecialchars($row['returned_by_officer'] ?? '') ?></span></td>
                                <td><small class="text-muted"><?= htmlspecialchars($row['datetime']) ?></small></td>
                                <td class="text-end">
                                    <div class="btn-group" role="group" aria-label="Action Controls">
                                        <button class="btn btn-outline-info btn-sm" onclick="viewDetails(<?= htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') ?>)" title="View Details">
                                            <i class="mdi mdi-eye"></i>
                                        </button>
                                        <button class="btn btn-outline-warning btn-sm" onclick="openUpdateModal(<?= htmlspecialchars(json_encode($row), ENT_QUOTES, 'UTF-8') ?>)" title="Update Record">
                                            <i class="mdi mdi-pencil"></i>
                                        </button>
                                        <button class="btn btn-outline-danger btn-sm" onclick="confirmDelete(<?= htmlspecialchars($row['faulty_ammoID']) ?>)" title="Delete Record">
                                            <i class="mdi mdi-delete"></i>
                                        </button>
                                        <button class="btn btn-outline-success btn-sm" onclick="openFixModal(<?= htmlspecialchars($row['faulty_ammoID']) ?>)" title="Mark Fixed">
                                            <i class="mdi mdi-checkbox-marked-circle"></i>
                                        </button>
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
          
          <div class="modal fade" id="viewModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content" style="background-color: var(--panel-bg); color: var(--text-tactical);">
                <div class="modal-header border-0">
                  <h5 class="modal-title text-light">[SIGNAL]: FAULTY_AMMO_DETAILS</h5>
                  <button type="button" class="close text-dark" data-bs-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body" id="viewModalBody"></div>
                <div class="modal-footer border-0">
                  <button type="button" class="btn btn-danger-tactical" data-bs-dismiss="modal">CLOSE</button>
                </div>
              </div>
            </div>
          </div>

          <div class="modal fade" id="updateModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
              <div class="modal-content" style="background-color: var(--panel-bg); color: var(--text-tactical);">
                <form action="process-faulty-ammo.php" method="POST">
                  <div class="modal-header">
                    <h5 class="modal-title text-light">[SIGNAL]: UPDATE_FAULTY_AMMO</h5>
                    <button type="button" class="close text-dark" data-bs-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="faulty_ammoID" id="edit_faulty_ammoID">
                    <div class="form-group">
                      <label>Serial No. / Ammo Name</label>
                      <input type="text" class="form-control" name="faulty_ammo_serial_no" id="edit_serial" required>
                    </div>
                    <div class="form-group">
                      <label>Manufacturer</label>
                      <input type="text" class="form-control" name="faulty_ammo_manufacturer" id="edit_manufacturer" readonly required>
                    </div>
                    <div class="form-group">
                      <label>Ammunition Type/Caliber</label>
                      <input type="text" class="form-control" name="faulty_ammo_type" id="edit_type">
                    </div>
                    <div class="form-group">
                      <label>Quantity</label>
                      <input type="number" class="form-control" name="faulty_ammo_quantity" id="edit_qty" required min="1">
                    </div>
                    <div class="form-group">
                      <label>Type of Fault</label>
                      <select class="form-control" name="faulty_type" id="edit_fault_type" required>
                        <option value="Breakage">Breakage</option>
                        <option value="Misfire">Misfire</option>
                        <option value="Corrosion">Corrosion</option>
                        <option value="Dent">Dent</option>
                        <option value="Other">Other</option>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Remarks / Comments</label>
                      <textarea class="form-control" name="faulty_ammo_comment" id="edit_comment" rows="3"></textarea>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger-tactical" data-bs-dismiss="modal">CANCEL</button>
                    <button type="submit" name="update_faulty_ammo" class="btn btn-tactical">COMMIT_CHANGE</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content" style="background-color: var(--panel-bg); color: var(--text-tactical);">
                <form action="process-faulty-ammo.php" method="POST">
                  <div class="modal-header border-0">
                    <h5 class="modal-title text-light">[WARN]: DELETE_FAULTY_AMMO</h5>
                    <button type="button" class="close text-dark" data-bs-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="faulty_ammoID" id="delete_id">
                    <p>Are you sure you want to delete this record from the system?</p>
                  </div>
                  <div class="modal-footer border-0">
                    <button type="button" class="btn btn-tactical" data-bs-dismiss="modal">CANCEL</button>
                    <button type="submit" name="delete_faulty_ammo" class="btn btn-danger-tactical">PROCEED_DELETE</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <div class="modal fade" id="fixModal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content" style="background-color: var(--panel-bg); color: var(--text-tactical);">
                <form action="process-faulty-ammo.php" method="POST">
                  <div class="modal-header border-0">
                    <h5 class="modal-title text-light">[SIGNAL]: MARK_FIXED</h5>
                    <button type="button" class="close text-dark" data-bs-dismiss="modal">&times;</button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="faulty_ammoID" id="fix_id">
                    <p>Mark this issue as resolved? This will remove the item from the faulty list and return the stock.</p>
                  </div>
                  <div class="modal-footer border-0">
                    <button type="button" class="btn btn-danger-tactical" data-bs-dismiss="modal">CANCEL</button>
                    <button type="submit" name="mark_fixed" class="btn btn-tactical">CONFIRM_RESOLVE</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <?php require_once('includes/footer.php'); ?>
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
    
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/dashboard.js"></script>

    <script>
      $(document).ready(function() {
          $('#faulty-ammo-list').DataTable({
              responsive: true,
              scrollX: true,
              order: [[0, "desc"]],
              dom: 'Bfrtip',
              buttons: [
                  { extend: 'copy', className: 'btn btn-tactical btn-sm' },
                  { extend: 'csv', className: 'btn btn-tactical btn-sm' },
                  { extend: 'excel', className: 'btn btn-tactical btn-sm' },
                  { extend: 'pdf', className: 'btn btn-tactical btn-sm' },
                  { extend: 'print', className: 'btn btn-tactical btn-sm' }
              ]
          });

          // Toast Notification
          const params = new URLSearchParams(window.location.search);
          if(params.has('status')) {
              let status = params.get('status');
              let toast = document.createElement('div');
              toast.className = 't-toast';
              if (status === 'success') {
                  toast.innerHTML = `[SIGNAL]: TRANSACTION_COMMITTED`;
                  toast.style.borderLeft = '5px solid #00f2ff';
                  toast.style.color = '#00f2ff';
              } else {
                  toast.innerHTML = `[SIGNAL]: TRANSACTION_FAILED`;
                  toast.style.borderLeft = '5px solid #ff4d4d';
                  toast.style.color = '#ff4d4d';
              }
              document.getElementById('toast-container').appendChild(toast);
              
              toast.style.display = 'block';
              setTimeout(function() {
                  toast.style.display = 'none';
                  toast.remove();
              }, 3500);
          }
      });

      function viewDetails(item) {
          let content = `<ul class="list-group list-group-flush bg-transparent">
            <li class="list-group-item bg-transparent text-light"><strong>Manufacturer:</strong> ${item.faulty_ammo_manufacturer}</li>
            <li class="list-group-item bg-transparent text-light"><strong>Serial No:</strong> ${item.faulty_ammo_serial_no}</li>
            <li class="list-group-item bg-transparent text-light"><strong>Type:</strong> ${item.faulty_ammo_type}</li>
            <li class="list-group-item bg-transparent text-light"><strong>Quantity:</strong> ${item.faulty_ammo_quantity}</li>
            <li class="list-group-item bg-transparent text-light"><strong>Fault:</strong> ${item.faulty_type}</li>
            <li class="list-group-item bg-transparent text-light"><strong>Remarks:</strong> ${item.faulty_ammo_comment}</li>
            <li class="list-group-item bg-transparent text-light"><strong>Returned By Officer:</strong> ${item.returned_by_officer}</li>
            <li class="list-group-item bg-transparent"><strong>Faulty Image:</strong><img src="assets/images/faulty_ammo_images/${item.faulty_firearm_image}" alt="" style="height:250px;width:250px;"></li>
            <li class="list-group-item bg-transparent text-light"><strong>Date Added:</strong> ${item.datetime}</li>
          </ul>`;
          $('#viewModalBody').html(content);
          $('#viewModal').modal('show');
      }

      function openUpdateModal(item) {
          $('#edit_faulty_ammoID').val(item.faulty_ammoID);
          $('#edit_serial').val(item.faulty_ammo_serial_no);
          $('#edit_manufacturer').val(item.faulty_ammo_manufacturer);
          $('#edit_type').val(item.faulty_ammo_type);
          $('#edit_qty').val(item.faulty_ammo_quantity);
          $('#edit_fault_type').val(item.faulty_type);
          $('#edit_comment').val(item.faulty_ammo_comment);
          $('#updateModal').modal('show');
      }

      function confirmDelete(id) {
          $('#delete_id').val(id);
          $('#deleteModal').modal('show');
      }

      function openFixModal(id) {
          $('#fix_id').val(id);
          $('#fixModal').modal('show');
      }
    </script>
  </body>
</html>