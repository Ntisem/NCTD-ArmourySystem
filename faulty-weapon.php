<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
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

$query = "SELECT * FROM faulty_weapons ORDER BY faulty_weaponID DESC";
$stmt_faulty = $pdo->query($query);
$faulty_weapons = $stmt_faulty->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GPS ARMOURY SYSTEM - FAULTY FIREARMS REGISTRY</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
      :root {
        --bg-tactical: #0d0f12;
        --panel-bg: #15181f;
        --neon: #00f2ff;
        --danger: #ff4d4d;
        --warning: #ffb703;
        --success: #10b981;
        --text-tactical: #e0e0e0;
      }
      body {
        background-color: var(--bg-tactical);
        color: var(--text-tactical);
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      }
      .card {
        background-color: var(--panel-bg);
        border: 1px solid #202633;
        box-shadow: 0 4px 12px rgba(0,0,0,0.5);
      }
      .card-title {
        color: var(--neon);
        font-weight: 600;
        letter-spacing: 1.5px;
      }
      .table { 
        color: var(--text-tactical); 
      }
      .table th {
        background-color: #1a1e27;
        color: var(--neon);
        border-color: #202633;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 0.5px;
        white-space: nowrap;
      }
      .table td { 
        border-color: #202633;
        vertical-align: middle;
        white-space: nowrap;
      }
      .table-responsive {
        overflow-x: auto;
        width: 100%;
        -webkit-overflow-scrolling: touch;
      }
      .table-hover tbody tr:hover {
        background-color: rgba(0, 242, 255, 0.05);
      }
      .badge-tactical {
        background: transparent;
        border: 1px solid var(--neon);
        color: var(--neon);
        padding: 4px 8px;
        font-size: 0.75rem;
      }
      .btn-tactical {
        background: transparent;
        color: var(--neon);
        border: 1px solid var(--neon);
        transition: all 0.3s ease;
      }
      .btn-tactical:hover {
        background: var(--neon);
        color: #000;
      }
      .btn-danger-tactical {
        background: transparent;
        color: var(--danger);
        border: 1px solid var(--danger);
        transition: all 0.3s ease;
      }
      .btn-danger-tactical:hover {
        background: var(--danger);
        color: #fff;
      }
      .btn-warning-tactical {
        background: transparent;
        color: var(--warning);
        border: 1px solid var(--warning);
        transition: all 0.3s ease;
      }
      .btn-warning-tactical:hover {
        background: var(--warning);
        color: #000;
      }
      .btn-success-tactical {
        background: transparent;
        color: var(--success);
        border: 1px solid var(--success);
        transition: all 0.3s ease;
      }
      .btn-success-tactical:hover {
        background: var(--success);
        color: #000;
      }
      .modal-content {
        background-color: var(--panel-bg); 
        color: var(--text-tactical); 
        border: 1px solid var(--neon);
      }
      .modal-header, .modal-footer {
        border-color: #202633;
      }
      .close {
        color: #fff;
      }
      .t-toast {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 9999;
        background: var(--panel-bg);
        border: 1px solid var(--neon);
        padding: 15px;
        border-left: 5px solid var(--neon);
        color: var(--text-tactical);
        display: none;
        border-radius: 4px;
        font-family: monospace;
      }
      .list-group-item {
        position: relative;
        display: block;
        padding: 0.5rem 1rem;
        color: #fff;
        text-decoration: none;
        background-color: #fff;
        border: 1px solid rgba(0, 0, 0, 0.125);
    }
    </style>
  </head>
  <body>
    <div id="toast-container"></div>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
           
                <div class="card">
                <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap">
                  
                  <div class="d-flex align-items-center mb-2 mb-md-0">
                    <a href="javascript:history.back();" class="btn btn-tactical btn-sm mr-3">
                      <i class="mdi mdi-arrow-left"></i> Back
                    </a>
                      <a href="faulty-ammo" class="btn btn-outline-danger btn-sm mr-3">
                      <i class="mdi mdi-ammunition"></i> BLANK/FAULTY AMMO
                    </a>
                    <h4 class="card-title text-uppercase mb-0">
                      <i class="mdi mdi-alert-circle text-danger mr-2"></i>Faulty Firearms Registry
                    </h4>
                  </div>
                      
                      <div>
                        <a href="add-faulty-weapon.php" class="btn btn-tactical btn-sm mt-2 mt-md-0">
                          <i class="mdi mdi-plus"></i> Add Faulty Firearm
                        </a>
                      </div>
                      
                    </div>


                  </div>
                    <div class="table-responsive">
                      <table id="mainTable" class="table table-bordered table-hover table-responsive w-100">
                        <thead>
                          <tr>
                            <th>No.</th>
                            <th>Serial Number</th>
                            <th>Firearm Type / Name</th>
                            <th>Class</th>
                            <th>Fault Type</th>
                            <th>Fault Nature</th>
                            <th>Remarks</th>
                            <th>Date & Time</th>
                            <th style="min-width: 180px;">Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php 
                          $counter = 1;
                          foreach($faulty_weapons as $index => $weapon): 
                          ?>
                          <tr>
                            <td><?= $counter++ ?></td>
                            <td><?= htmlspecialchars($weapon['faulty_firearm_serial_no']) ?></td>
                            <td><?= htmlspecialchars($weapon['faulty_firearm_type']) ?> / <?= htmlspecialchars($weapon['faulty_firearm_name']) ?></td>
                            <td><span class="badge badge-tactical"><?= htmlspecialchars($weapon['faulty_firearm_class']) ?></span></td>
                            <td><?= htmlspecialchars($weapon['faulty_type']) ?></td>
                            <td><?= htmlspecialchars($weapon['faulty_nature']) ?></td>
                            <td><?= htmlspecialchars($weapon['faulty_firearm_comment']) ?></td>
                            <td><?= !empty($weapon['datetime']) ? htmlspecialchars($weapon['datetime']) : 'Now' ?></td>
                            <td>
                              <button class="btn btn-tactical btn-sm" onclick="viewDetails(<?= htmlspecialchars(json_encode($weapon)) ?>)" title="View">
                                <i class="mdi mdi-eye"></i>
                              </button>
                              <button class="btn btn-warning-tactical btn-sm" onclick="openUpdateModal(<?= htmlspecialchars(json_encode($weapon)) ?>)" title="Edit">
                                <i class="mdi mdi-pencil"></i>
                              </button>
                              <button class="btn btn-success-tactical btn-sm" onclick="openFixModal(<?= htmlspecialchars(json_encode($weapon)) ?>)" title="Fix">
                                <i class="mdi mdi-check"></i>
                              </button>
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
          
        </div>
      </div>
    </div>
<?php require_once('includes/footer.php'); ?>
    <div class="modal fade" id="viewModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="color: var(--neon);"><i class="mdi mdi-eye mr-2"></i>[SIGNAL]: FAULTY FIREARM DETAILS</h5>
            <button type="button" class="close text-light" data-bs-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body" id="viewModalBody" style="color: #fff;">
            </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger-tactical" data-bs-dismiss="modal">CLOSE</button>
          </div>
        </div>
      </div>
    </div>

    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="process-faulty-weapon.php" method="POST">
            <div class="modal-header">
              <h5 class="modal-title" style="color: var(--neon);"><i class="mdi mdi-pencil mr-2"></i>[SIGNAL]: UPDATE FAULTY FIREARM</h5>
              <button type="button" class="close text-light" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <input type="hidden" name="faulty_weaponID" id="edit_faulty_weaponID">
              <div class="form-group">
                <label>Serial Number / ID</label>
                <input type="text" class="form-control bg-dark text-light border-info" name="faulty_firearm_serial_no" id="edit_serial" required>
              </div>
              <div class="form-group">
                <label>Firearm Name</label>
                <input type="text" class="form-control bg-dark text-light border-info" name="faulty_firearm_name" id="edit_name">
              </div>
              <div class="form-group">
                <label>Firearm Type</label>
                <input type="text" class="form-control bg-dark text-light border-info" name="faulty_firearm_type" id="edit_type">
              </div>
              <div class="form-group">
                <label>Firearm Class</label>
                <input type="text" class="form-control bg-dark text-light border-info" name="faulty_firearm_class" id="edit_class" required>
              </div>
              <div class="form-group">
                <label>Fault Type</label>
                <select name="faulty_type" class="form-control bg-dark text-light border-info" id="edit_fault_type">
                  <option value="Mechanical">Mechanical</option>
                  <option value="Structural Damage">Structural Damage</option>
                  <option value="Corrosion">Corrosion</option>
                  <option value="Other">Other</option>
                </select>
              </div>
              <div class="form-group">
                <label>Nature of Fault</label>
                <textarea class="form-control bg-dark text-light border-info" name="faulty_nature" id="edit_nature" rows="2"></textarea>
              </div>
              <div class="form-group">
                <label>Remarks</label>
                <textarea class="form-control bg-dark text-light border-info" name="faulty_firearm_comment" id="edit_comment" rows="3"></textarea>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger-tactical" data-bs-dismiss="modal">CANCEL</button>
              <button type="submit" name="update_faulty_weapon" class="btn btn-tactical">COMMIT_CHANGE</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content" style="border: 1px solid var(--danger);">
          <form action="process-faulty-weapon.php" method="POST">
            <div class="modal-header">
              <h5 class="modal-title" style="color: var(--danger);"><i class="mdi mdi-alert-outline mr-2"></i>[SIGNAL]: CONFIRM ARCHIVE/DELETE</h5>
              <button type="button" class="close text-light" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure you want to delete this record? This action cannot be undone.</p>
              <input type="hidden" name="faulty_weaponID" id="delete_id">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-tactical" data-bs-dismiss="modal">CANCEL</button>
              <button type="submit" name="delete_faulty_weapon" class="btn btn-danger-tactical">DELETE</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="fixModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="process-faulty-weapon.php" method="POST">
            <div class="modal-header">
              <h5 class="modal-title" style="color: var(--neon);"><i class="mdi mdi-check-circle mr-2"></i>[SIGNAL]: MARK FIXED & RESTORE</h5>
              <button type="button" class="close text-light" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Do you confirm that this firearm is fixed and can be returned to stock?</p>
              <input type="hidden" name="faulty_weaponID" id="fix_id">
              <input type="hidden" name="faulty_firearm_type" id="fix_type">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger-tactical" data-bs-dismiss="modal">CANCEL</button>
              <button type="submit" name="mark_weapon_fixed" class="btn btn-tactical">COMMIT_CHANGE</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>

    <script>
      $(document).ready(function() {
        $('#mainTable').DataTable({
          "responsive": false, 
          "autoWidth": false,
          "order": [[0, "desc"]],
          dom: 'Bfrtip',
          buttons: [
              { extend: 'copy', className: 'btn btn-tactical btn-sm' },
              { extend: 'csv', className: 'btn btn-tactical btn-sm' },
              { extend: 'excel', className: 'btn btn-tactical btn-sm' },
              { extend: 'pdf', className: 'btn btn-tactical btn-sm' },
              { extend: 'print', className: 'btn btn-tactical btn-sm' }
          ]
        });

        const params = new URLSearchParams(window.location.search);
        if(params.has('status')) {
          let status = params.get('status');
          let toast = document.createElement('div');
          toast.className = 't-toast';
          if (status === 'success') {
            toast.innerHTML = `[SIGNAL]: TRANSACTION_COMMITTED`;
            toast.style.borderColor = '#00f2ff';
            toast.style.color = '#00f2ff';
          } else {
            toast.innerHTML = `[SIGNAL]: TRANSACTION_FAILED`;
            toast.style.borderColor = '#ff4d4d';
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
        let content = `<ul class="list-group list-group-flush" style="background:transparent; color:var(--text-tactical)">
          <li class="list-group-item bg-transparent"><strong>Record ID:</strong> ${item.faulty_weaponID}</li>
          <li class="list-group-item bg-transparent"><strong>Serial Number:</strong> ${item.faulty_firearm_serial_no}</li>
          <li class="list-group-item bg-transparent"><strong>Firearm Name:</strong> ${item.faulty_firearm_name}</li>
          <li class="list-group-item bg-transparent"><strong>Firearm Type:</strong> ${item.faulty_firearm_type}</li>
          <li class="list-group-item bg-transparent"><strong>Class:</strong> ${item.faulty_firearm_class}</li>
          <li class="list-group-item bg-transparent"><strong>Fault Type:</strong> ${item.faulty_type}</li>
          <li class="list-group-item bg-transparent"><strong>Nature of Fault:</strong> ${item.faulty_nature}</li>
          <li class="list-group-item bg-transparent"><strong>Remarks:</strong> ${item.faulty_firearm_comment}</li>
           <li class="list-group-item bg-transparent"><strong>Faulty Image:</strong><img src="assets/images/faulty_weapon_images/${item.faulty_firearm_image}" alt="" style="height:250px;width:250px;"></li>
          <li class="list-group-item bg-transparent"><strong>Date Added:</strong> ${item.datetime}</li>
        </ul>`;
        $('#viewModalBody').html(content);
        $('#viewModal').modal('show');
      }

      function openUpdateModal(item) {
        $('#edit_faulty_weaponID').val(item.faulty_weaponID);
        $('#edit_serial').val(item.faulty_firearm_serial_no);
        $('#edit_name').val(item.faulty_firearm_name);
        $('#edit_type').val(item.faulty_firearm_type);
        $('#edit_class').val(item.faulty_firearm_class);
        $('#edit_fault_type').val(item.faulty_type);
        $('#edit_nature').val(item.faulty_nature);
        $('#edit_comment').val(item.faulty_firearm_comment);
        $('#updateModal').modal('show');
      }

      function confirmDelete(id) {
        $('#delete_id').val(id);
        $('#deleteModal').modal('show');
      }

      function openFixModal(item) {
        $('#fix_id').val(item.faulty_weaponID);
        $('#fix_type').val(item.faulty_firearm_type);
        $('#fixModal').modal('show');
      }
    </script>
  </body>
</html>