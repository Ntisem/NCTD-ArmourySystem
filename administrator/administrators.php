<?php
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');


// Access Control
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GPS ARMOURY SYSTEM - ADMINISTRATORS/ARMOURERS</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="dist/css/theme.min.css">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
      body, .main-panel, .card, .table {
        background-color: #05070a !important;
        color: #adc4b2 !important;
      }
      .card {
        border: 1px solid #00f2ff;
        background: #0f131a !important;
      }
      .table th, .table td {
        border-color: #1a2333;
        color: #fff;
      }
      .btn-tactical {
        background: #00f2ff;
        color: #000;
        font-weight: bold;
        border: none;
      }
      .btn-tactical:hover {
        background: #00ffcc;
      }
      .modal-content {
        background: #0f131a;
        border: 1px solid #00f2ff;
        color: #fff;
      }
      .modal-header, .modal-footer {
        border-color: #1a2333;
      }
      .form-control {
        background: #05070a;
        border: 1px solid #00f2ff;
        color: #fff;
      }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <?php require_once('includes/sidebar.php');?>
      <div class="container-fluid page-body-wrapper">
        <?php require_once('includes/navbar.php');?>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title" style="color:#00f2ff">Administrator / Armourers Directory</h3>
            </div>
            
            <?php if(isset($_SESSION['success'])): ?>
              <div class="alert alert-success" style="background:#0a1a0f; border:1px solid #00ffaa; color:#5effa4">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
              </div>
            <?php endif; ?>
            <?php if(isset($_SESSION['error'])): ?>
              <div class="alert alert-danger" style="background:#1a0a0a; border:1px solid #ff0055; color:#ff6b8b">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
              </div>
            <?php endif; ?>

            <section class="content">
              <div class="container-fluid">
                <div class="row">
                  <div class="col-12">
                    <div class="card">
                      <div class="card-body">
                        <p class="card-description">
                          <a href="add-new-administrator">
                            <i class="mdi mdi-account-plus f-22 text-green" style="color:#00f2ff;" title="Click to Add New Armourer"></i>
                          </a>
                        </p>
                        <table id="armourers-list" class="table table-bordered table-hover">
                          <thead>
                            <tr>
                              <th>#</th>
                              <th>Service Number</th>
                              <th>Full Name</th>
                              <th>Username</th>
                              <th>Role</th>
                              <th>Action Controls</th>
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            $stmt = $pdo->query("SELECT * FROM admin_lists ORDER BY adminID DESC");
                            $i = 1;
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            ?>
                              <tr>
                                <td><?php echo $i++; ?></td>
                                <td><?php echo htmlspecialchars($row['service_no']); ?></td>
                                <td><?php echo htmlspecialchars($row['rank']); ?> <?php echo htmlspecialchars($row['fullname']); ?></td>
                                <td><?php echo htmlspecialchars($row['username']); ?></td>
                                <td><?php echo htmlspecialchars($row['user_role']); ?></td>
                                <td>
                                  <button type="button" class="btn btn-sm btn-tactical" data-toggle="modal" data-target="#viewModalAdministrator<?php echo $row['adminID']; ?>">View</button>
                                  <button type="button" class="btn btn-sm btn-info" data-toggle="modal" data-target="#editModalAdministrator<?php echo $row['adminID']; ?>">Edit</button>
                                  <button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModalAdministrator<?php echo $row['adminID']; ?>">Delete</button>
                                </td>
                              </tr>

                              <div class="modal fade" id="viewModalAdministrator<?php echo $row['adminID']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" style="color:#00f2ff"><i class="mdi mdi-account-card-details"></i> Profile details: <?php echo htmlspecialchars($row['fullname']); ?></h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <div class="modal-body">
                                      <div class="row">
                                        <div class="col-md-4 text-center">
                                          <img src="assets/images/users/<?php echo $row['profile_image']; ?>" alt="Profile" style="width:140px; height:140px; border-radius:50%; border:2px solid #00f2ff;">
                                        </div>
                                        <div class="col-md-8">
                                          <p><strong>Service No:</strong> <?php echo htmlspecialchars($row['service_no']); ?></p>
                                          <p><strong>Rank:</strong> <?php echo htmlspecialchars($row['rank']); ?></p>
                                          <p><strong>Full Name:</strong> <?php echo htmlspecialchars($row['fullname']); ?></p>
                                          <p><strong>Email Address:</strong> <?php echo htmlspecialchars($row['admin_email']); ?></p>
                                          <p><strong>Phone:</strong> <?php echo htmlspecialchars($row['phone_number']); ?></p>
                                          <p><strong>Username:</strong> <?php echo htmlspecialchars($row['username']); ?></p>
                                          <p><strong>Gender:</strong> <?php echo htmlspecialchars($row['gender']); ?></p>
                                          <p><strong>Unit/Department:</strong> <?php echo htmlspecialchars($row['unit_dept']); ?></p>
                                        </div>
                                      </div>
                                    </div>
                                    <div class="modal-footer">
                                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                  </div>
                                </div>
                              </div>

                              <div class="modal fade" id="editModalAdministrator<?php echo $row['adminID']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" style="color:#00f2ff">Edit Armourer Record</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form action="process-administrator.php" method="POST" enctype="multipart/form-data">
                                      <div class="modal-body">
                                        <input type="hidden" name="action" value="update">
                                        <input type="hidden" name="adminID" value="<?php echo $row['adminID']; ?>">
                                        <input type="hidden" name="current_image" value="<?php echo $row['profile_image']; ?>">
                                        <div class="form-group">
                                          <label>Service Number</label>
                                          <input type="text" name="service_no" class="form-control" value="<?php echo htmlspecialchars($row['service_no']); ?>" required>
                                        </div>
                                          <div class="form-group">
                                          <label>Rank</label>
                                          <select name="rank" class="form-control" required>
                                            <option value="<?php echo htmlspecialchars($row['rank']); ?>"><?php echo htmlspecialchars($row['rank']); ?></option>
                                            <option value="CONST" <?php if($row['rank'] == 'CONST') echo 'selected';?>>CONST</option>
                                            <option value="L/CPL" <?php if($row['rank'] == 'L/CPL') echo 'selected';?>>L/CPL</option>
                                            <option value="CPL" <?php if($row['rank'] == 'CPL') echo 'selected';?>>CPL</option>
                                            <option value="SGT" <?php if($row['rank'] == 'SGT') echo 'selected';?>>SGT</option>
                                            <option value="INSPR" <?php if($row['rank'] == 'INSPR') echo 'selected';?>>INSPR</option>
                                            <option value="C/INSPR" <?php if($row['rank'] == 'C/INSPR ') echo 'selected';?>>C/INSPR  </option>
                                            <option value="ASP" <?php if($row['rank'] == 'ASP') echo 'selected';?>>ASP</option>
                                            <option value="DSP" <?php if($row['rank'] == 'DSP') echo 'selected';?>>DSP</option>
                                            <option value="SUPT" <?php if($row['rank'] == 'SUPT') echo 'selected';?>>SUPT</option>
                                            <option value="C/SUPT" <?php if($row['rank'] == 'C/SUPT') echo 'selected';?>>C/SUPT</option>
                                            <option value="ACP" <?php if($row['rank'] == 'ACP') echo 'selected';?>>ACP</option>
                                            <option value="DCOP" <?php if($row['rank'] == 'DCOP ') echo 'selected';?>>DCOP</option>
                                           <option value="COP" <?php if($row['rank'] == 'COP ') echo 'selected';?>>COP</option>

                                          </select>
                                        </div>
                                        <div class="form-group">
                                          <label>Gender</label>
                                          <select name="gender" class="form-control" required>
                                            <option value="Male" <?php if($row['gender'] == 'Male') echo 'selected';?>>Male</option>
                                            <option value="Female" <?php if($row['gender'] == 'Female') echo 'selected';?>>Female</option>
                                          </select>
                                        </div>
                                        <div class="form-group">
                                          <label>Full Name</label>
                                          <input type="text" name="fullname" class="form-control" value="<?php echo htmlspecialchars($row['fullname']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                          <label>Email Address</label>
                                          <input type="email" name="admin_email" class="form-control" value="<?php echo htmlspecialchars($row['admin_email']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                          <label>Phone Number</label>
                                          <input type="text" name="phone_number" class="form-control" value="<?php echo htmlspecialchars($row['phone_number']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                          <label>Username</label>
                                          <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($row['username']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                          <label>Unit/Dept</label>
                                          <input type="text" name="unit_dept" class="form-control" value="<?php echo htmlspecialchars($row['unit_dept']); ?>" required>
                                        </div>
                                        <div class="form-group">
                                          <label>Update Profile Image</label>
                                          <input type="file" name="profile_image" class="form-control">
                                        </div>
                                        <div class="form-group">
                                          <label>User Role</label>
                                          <select name="user_role" class="form-control" required>
                                            <option value="Administrator" <?php if($row['user_role'] == 'Administrator') echo 'selected';?>>Administrator</option>
                                            <option value="Armourer" <?php if($row['user_role'] == 'Armourer') echo 'selected';?>>Armourer</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-primary">Commit Changes</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>

                              <div class="modal fade" id="deleteModalAdministrator<?php echo $row['adminID']; ?>" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                  <div class="modal-content">
                                    <div class="modal-header">
                                      <h5 class="modal-title" style="color:#ff0055">Delete Confirmation</h5>
                                      <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff">
                                        <span aria-hidden="true">&times;</span>
                                      </button>
                                    </div>
                                    <form action="process-administrator.php" method="POST">
                                      <div class="modal-body">
                                        <input type="hidden" name="action" value="delete">
                                        <input type="hidden" name="adminID" value="<?php echo $row['adminID']; ?>">
                                        <p>Warning: This action is irreversible. Are you sure you want to delete this profile?</p>
                                      </div>
                                      <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                                        <button type="submit" class="btn btn-danger">Confirm Delete</button>
                                      </div>
                                    </form>
                                  </div>
                                </div>
                              </div>
                            <?php } ?>
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
    </div>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="dist/js/theme.min.js"></script>
    <script src="assets/js/custom.js"></script>
    <script src="plugins/toastr/toastr.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#armourers-list").DataTable({
            "responsive": true, 
            "lengthChange": true, 
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#armourers-list_wrapper .col-md-6:eq(0)');
    });
    </script>
     <script>
      // Confirmation dialog for delete actions
      $(document).on('submit', 'form[action="process-administrator.php"]', function(e) {
        var action = $(this).find('input[name="action"]').val();
        if (action === 'delete') {
          e.preventDefault();
          if (confirm("Are you sure you want to delete this profile? This action cannot be undone.")) {
            this.submit();
          }
        }
      });
      // Confirmation dialog for edit actions (optional, can be removed if not needed)
      $(document).on('submit', 'form[action="process-administrator.php"]', function(e) {
        var action = $(this).find('input[name="action"]').val();
        if (action === 'update') {
          e.preventDefault();
          if (confirm("Are you sure you want to save changes to this profile?")) {
            this.submit();
          }
        }
      });
</script>
     //Check for toast messages and display them using SweetAlert2
      <?php if(isset($_SESSION['toast_message'])): ?>
      <script>
        Swal.fire({
            toast: true, 
            position: 'top-end', 
            icon: '<?php echo $_SESSION['toast_type']; ?>',
            title: '<?php echo $_SESSION['toast_message']; ?>', 
            showConfirmButton: false, 
            timer: 3000,
            background: '#050a0f', 
            color: '#00f2ff'
        });
    </script>
    <?php unset($_SESSION['toast_message']); unset($_SESSION['toast_type']); ?>
<?php endif; ?>
  
</script>

  </body>
</html>