<?php
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] != 'Administrator') {
    header("location: login");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GPS ARMOURY SYSTEM - ADD NEW ADMINISTRATORS</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
      body {
        background-color: #05070a;
        color: #adc4b2;
        font-family: 'Courier New', Courier, monospace;
      }
      .card {
        background-color: #0f131a;
        border: 1px solid #00f2ff;
        color: #ffffff;
      }
      .form-control, .form-control:focus {
        background-color: #05070a;
        border: 1px solid #00f2ff;
        color: #ffffff;
      }
      .form-control:focus {
        box-shadow: 0 0 10px rgba(0, 242, 255, 0.4);
        border-color: #00ffaa;
      }
      .btn-primary {
        background-color: #00f2ff;
        border-color: #00f2ff;
        color: #000;
        font-weight: bold;
      }
      .btn-primary:hover {
        background-color: #00ffcc;
        border-color: #00ffcc;
        color: #000;
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
              <h3 class="page-title" style="color: #00f2ff;"> Add New Administrator </h3>
            </div>
            
            <?php if(isset($_SESSION['error'])): ?>
              <div class="alert alert-danger" style="background:#1a0f0f; border:1px solid #ff0055; color:#ff6b8b;">
                <?php echo $_SESSION['error']; unset($_SESSION['error']); ?>
              </div>
            <?php endif; ?>
            <?php if(isset($_SESSION['success'])): ?>
              <div class="alert alert-success" style="background:#0f1a0f; border:1px solid #00ffaa; color:#5effa4;">
                <?php echo $_SESSION['success']; unset($_SESSION['success']); ?>
              </div>
            <?php endif; ?>

            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <p class="card-description" style="color:#00f2ff">Personal Information</p>
                    <form method="POST" action="process-administrator.php" enctype="multipart/form-data" class="forms-sample">
                      <input type="hidden" name="action" value="add">
                      
                      <div class="form-group">
                        <label>User Role</label>
                        <select name="user_role" class="form-control" required>
                          <option value="Administrator">Administrator</option>
                          <option value="Armourer">Armourer</option>
                        </select>
                      </div>
                      
                      <div class="form-group">
                        <label>Service Number</label>
                        <input type="text" name="service_no" class="form-control" placeholder="Service Number" required>
                      </div>

                      <div class="form-group">
                        <label>Rank</label>
                        <input type="text" name="rank" class="form-control" placeholder="Rank" required>
                      </div>

                      <div class="form-group">
                        <label>Gender</label>
                        <select name="gender" class="form-control" required>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Full Name</label>
                        <input type="text" name="fullname" class="form-control" placeholder="Full Name" required>
                      </div>

                      <div class="form-group">
                        <label>Email Address</label>
                        <input type="email" name="admin_email" class="form-control" placeholder="Email" required>
                      </div>

                      <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" name="phone_number" class="form-control" placeholder="Phone Number" required>
                      </div>

                      <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                      </div>

                      <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                      </div>

                      <div class="form-group">
                        <label>Unit/Department</label>
                        <input type="text" name="unit_dept" class="form-control" placeholder="Unit / Dept" required>
                      </div>

                      <div class="form-group">
                        <label>Code</label>
                        <input type="text" name="code" class="form-control" placeholder="Security Code">
                      </div>

                      <div class="form-group">
                        <label>Profile Image</label>
                        <input type="file" name="profile_image" id="profile_img_file" class="form-control" onchange="previewImg(event)">
                        <div class="mt-2">
                          <img id="img_preview" src="#" alt="Preview Image" style="display:none; width:120px; height:120px; border: 2px solid #00f2ff; border-radius: 5px;" />
                        </div>
                      </div>

                      <button type="submit" class="btn btn-primary mr-2">Submit Profile</button>
                      <button type="button" class="btn btn-secondary" onclick="window.history.back()">Cancel</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <script>
      function previewImg(event) {
        var reader = new FileReader();
        reader.onload = function() {
          var output = document.getElementById('img_preview');
          output.src = reader.result;
          output.style.display = 'block';
        }
        reader.readAsDataURL(event.target.files[0]);
      }
    </script>
  </body>
</html>