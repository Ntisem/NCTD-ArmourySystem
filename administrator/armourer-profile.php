<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"])) {
    header("location: login");
    exit();
}

$username = $_SESSION['username'];
$stmt = $pdo->prepare("SELECT * FROM admin_lists WHERE username = ?");
$stmt->execute([$username]);
$row = $stmt->fetch();

if(!$row) {
    // If not found, destroy session and redirect
    session_unset();
    session_destroy();
    header("location: login");
    exit();
}

// Safely assign variables to prevent array offset warnings on booleans
$adminID      = $row['adminID'] ?? '';
$profile_image= $row['profile_image'] ?? '';
$fullname     = $row['fullname'] ?? '';
$user_role    = $row['user_role'] ?? '';
$service_no   = $row['service_no'] ?? '';
$rank         = $row['rank'] ?? '';
$admin_email  = $row['admin_email'] ?? '';
$phone_number = $row['phone_number'] ?? '';
$db_username  = $row['username'] ?? '';
$gender       = $row['gender'] ?? '';
$unit_dept    = $row['unit_dept'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GPS ARMOURY SYSTEM - ARMOURER PROFILE</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="dist/css/theme.min.css">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
      body, .main-panel, .card, .table, .modal-content {
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
        border: 1px solid #00f2ff;
      }
      .modal-header, .modal-footer {
        border-color: #1a2333;
      }
      .form-control {
        background: #05070a;
        border: 1px solid #00f2ff;
        color: #fff;
      }
      .img-profile {
        width: 140px; 
        height: 140px; 
        border-radius: 50%; 
        border: 2px solid #00f2ff;
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
              <h3 class="page-title" style="color:#00f2ff">Armourer Profile Settings</h3>
            </div>
                <div class="d-flex align-items-center mb-2 mb-md-0">
                    <a href="javascript:history.back();" class="btn btn-tactical btn-sm mr-3">
                      <i class="mdi mdi-arrow-left"></i> Back
                    </a>
                  </div>
            <section class="content">
              <div class="container-fluid">
                <div class="row justify-content-center">
                  <div class="col-md-10">
                    <div class="card">
                      <div class="card-body">
                        <div class="row">
                          <div class="col-md-4 text-center">
                            <img src="assets/images/armourer_images/<?php echo htmlspecialchars($profile_image ?: 'default.png'); ?>" alt="Profile" class="img-profile mb-3">
                            <h4 style="color:#00f2ff;"><?php echo htmlspecialchars($fullname); ?></h4>
                            <p class="text-muted"><?php echo htmlspecialchars($user_role); ?></p>
                          </div>
                          <div class="col-md-8">
                            <table class="table table-border table-hover">
                              <tr>
                                <td><strong>Service Number:</strong></td>
                                <td><?php echo htmlspecialchars($service_no); ?></td>
                              </tr>
                              <tr>
                                <td><strong>Rank:</strong></td>
                                <td><?php echo htmlspecialchars($rank); ?></td>
                              </tr>
                              <tr>
                                <td><strong>Email Address:</strong></td>
                                <td><?php echo htmlspecialchars($admin_email); ?></td>
                              </tr>
                              <tr>
                                <td><strong>Phone Number:</strong></td>
                                <td><?php echo htmlspecialchars($phone_number); ?></td>
                              </tr>
                              <tr>
                                <td><strong>Username:</strong></td>
                                <td><?php echo htmlspecialchars($db_username); ?></td>
                              </tr>
                              <tr>
                                <td><strong>Gender:</strong></td>
                                <td><?php echo htmlspecialchars($gender); ?></td>
                              </tr>
                              <tr>
                                <td><strong>Unit/Department:</strong></td>
                                <td><?php echo htmlspecialchars($unit_dept); ?></td>
                              </tr>
                            </table>
                            <div class="mt-4">
                              <button type="button" class="btn btn-tactical" data-toggle="modal" data-target="#editProfileModal">Edit Profile</button>
                              <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteProfileModal">Decommission Profile</button>
                            </div>
                          </div>
                        </div>
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

    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="color:#00f2ff">Edit Profile Details</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="process-profile.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <input type="hidden" name="action" value="edit">
              <input type="hidden" name="adminID" value="<?php echo htmlspecialchars($adminID); ?>">
              <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($profile_image); ?>">
              
              <div class="form-group">
                <label>Service Number</label>
                <input type="text" name="service_no" class="form-control" value="<?php echo htmlspecialchars($service_no); ?>" required>
              </div>
              <div class="form-group">
                <label>Rank</label>
                <input type="text" name="rank" class="form-control" value="<?php echo htmlspecialchars($rank); ?>" required>
              </div>
              <div class="form-group">
                <label>Full Name</label>
                <input type="text" name="fullname" class="form-control" value="<?php echo htmlspecialchars($fullname); ?>" required>
              </div>
              <div class="form-group">
                <label>Email Address</label>
                <input type="email" name="admin_email" class="form-control" value="<?php echo htmlspecialchars($admin_email); ?>" required>
              </div>
              <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phone_number" class="form-control" value="<?php echo htmlspecialchars($phone_number); ?>" required>
              </div>
              <div class="form-group">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo htmlspecialchars($db_username); ?>" required>
              </div>
              <div class="form-group">
                <label>Gender</label>
                <select name="gender" class="form-control" required>
                  <option value="Male" <?php if($gender == 'Male') echo 'selected';?>>Male</option>
                  <option value="Female" <?php if($gender == 'Female') echo 'selected';?>>Female</option>
                </select>
              </div>
              <div class="form-group">
                <label>Unit/Dept</label>
                <input type="text" name="unit_dept" class="form-control" value="<?php echo htmlspecialchars($unit_dept); ?>" required>
              </div>
              <div class="form-group">
                <label>Change Profile Image</label>
                <input type="file" name="profile_image" class="form-control">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-tactical">Save Changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="modal fade" id="deleteProfileModal" tabindex="-1" role="dialog" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" style="color:#ff0055">Decommission Profile</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="color:#fff">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="process-profile.php" method="POST">
            <div class="modal-body">
              <input type="hidden" name="action" value="delete">
              <input type="hidden" name="adminID" value="<?php echo htmlspecialchars($adminID); ?>">
              <p>Warning: This action is irreversible and will permanently delete your profile from the armoury. Are you sure?</p>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-danger">Confirm Decommission</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="toast" id="profileToast" style="position: fixed; bottom: 20px; right: 20px; min-width: 300px; background: #00f2ff; color: #000; z-index: 9999;" data-delay="3000">
      <div class="toast-header" style="background: #00b3cc; color: #fff;">
        <strong class="mr-auto"><i class="mdi mdi-bell-ring"></i> Notification</strong>
        <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close" style="color:#fff;">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="toast-body" id="toastBody">
        Action completed successfully.
      </div>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
      $(document).ready(function() {
        <?php if(isset($_SESSION['success'])): ?>
          $('#toastBody').html("<?php echo addslashes($_SESSION['success']); unset($_SESSION['success']); ?>");
          $('#profileToast').toast('show');
        <?php endif; ?>
        <?php if(isset($_SESSION['error'])): ?>
          $('#toastBody').html("<?php echo addslashes($_SESSION['error']); unset($_SESSION['error']); ?>");
          $('#profileToast').toast('show');
        <?php endif; ?>
      });
    </script>
  </body>
</html>