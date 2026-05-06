<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GPS ARMOURY SYSTEM - ADD FAULTY ASSET/ WEAPON</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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
        font-family: 'Courier New', Courier, monospace;
      }
      .card, .navbar, footer {
        background-color: var(--panel-bg) !important;
        border: 1px solid rgba(0, 242, 255, 0.2);
      }
      .form-control, .select2-container--bootstrap .select2-selection {
        background-color: #0a0d12 !important;
        color: var(--neon) !important;
        border: 1px solid rgba(0, 242, 255, 0.3);
      }
      .form-control:focus {
        border-color: var(--neon);
        box-shadow: 0 0 5px rgba(0, 242, 255, 0.5);
      }
      .btn-tactical {
        background: transparent;
        color: var(--neon);
        border: 1px solid var(--neon);
        transition: 0.3s;
      }
      .btn-tactical:hover {
        background: var(--neon);
        color: #000;
        box-shadow: 0 0 8px var(--neon);
      }
      .btn-abort {
        background: transparent;
        color: var(--danger);
        border: 1px solid var(--danger);
      }
      .btn-abort:hover {
        background: var(--danger);
        color: #fff;
      }
      #toast-container {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 9999;
      }
      .t-toast {
        display: none;
        padding: 12px 20px;
        background: #15181f;
        color: var(--text-tactical);
        margin-bottom: 10px;
        border-left: 5px solid var(--neon);
        font-size: 14px;
        border-radius: 4px;
        box-shadow: 0 4px 10px rgba(0,0,0,0.3);
        font-family: monospace;
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
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                      <h4 class="card-title text-uppercase">[SCAN] ADD FAULTY FIREARM</h4>
                      <div>
                        <a href="add-faulty-ammo.php" class="btn btn-tactical">
                          <i class="mdi mdi-ammunition"></i> ADD FAULTY AMMO
                        </a>
                      </div>
                    </div>
                    <form class="forms-sample" method="POST" action="process-faulty-weapon.php" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="faulty_firearm_serial_no">[SELECT] Firearm Serial Number</label>
                        <input type="text" class="form-control" id="faulty_firearm_serial_no" name="faulty_firearm_serial_no" placeholder="Enter or Search Serial Number" required>
                      </div>
                      <div class="form-group">
                        <label for="faulty_firearm_type">Firearm Type</label>
                        <input type="text" class="form-control" id="faulty_firearm_type" name="faulty_firearm_type" readonly>
                      </div>
                      <div class="form-group">
                        <label for="faulty_firearm_name">Firearm Name</label>
                        <input type="text" class="form-control" id="faulty_firearm_name" name="faulty_firearm_name" readonly>
                      </div>
                      <div class="form-group">
                        <label for="faulty_firearm_class">Firearm Class</label>
                        <input type="text" class="form-control" id="faulty_firearm_class" name="faulty_firearm_class" readonly>
                      </div>
                      <div class="form-group">
                        <label for="faulty_type">[SELECT] Fault Type</label>
                        <select class="form-control" id="faulty_type" name="faulty_type" required>
                            <option value="Breakage">Breakage</option>
                            <option value="Malfunction">Malfunction</option>
                            <option value="Lost">Lost</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="faulty_nature">[SELECT] Fault Nature</label>
                        <select class="form-control" id="faulty_nature" name="faulty_nature" required>
                            <option value="Serviceable">Serviceable</option>
                            <option value="Unserviceable">Unserviceable</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="returned_by_officer">[SELECT] Returned by Officer</label>
                        <input type="text" class="form-control" id="returned_by_officer" name="returned_by_officer" placeholder="Search and select officer" required>
                        <input type="hidden" id="returned_officer_id" name="returned_officer_id">
                      </div>
                      <div class="form-group">
                        <label for="faulty_firearm_comment">Comment</label>
                        <textarea class="form-control" id="faulty_firearm_comment" name="faulty_firearm_comment" rows="4" placeholder="Enter comments here..."></textarea>
                      </div>
                      <div class="form-group">
                        <label>Images</label>
                        <input type="file" name="faulty_weapon_images[]" id="images" class="form-control file-upload-info" multiple onchange="previewImages()">
                        <div id="image_preview" style="display:flex; flex-wrap:wrap; margin-top:10px;"></div>
                      </div>
                      <button type="submit" name="add_faulty_weapon" class="btn btn-tactical me-2">SUBMIT_TRANSACTION</button>
                      <button type="reset" class="btn btn-abort">ABORT_ENTRY</button>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php require_once('includes/footer.php');?>
        </div>
      </div>
    </div>
    
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script>
      $(function() {
        // Autocomplete for serial numbers
        $("#faulty_firearm_serial_no").autocomplete({
          source: function(request, response) {
            $.ajax({
              url: "fetch-faulty-firearms.php",
              dataType: "json",
              data: {
                term: request.term
              },
              success: function(data) {
                response(data);
              }
            });
          },
          minLength: 1,
          select: function(event, ui) {
            $("#faulty_firearm_serial_no").val(ui.item.serial);
            $("#faulty_firearm_type").val(ui.item.f_type);
            $("#faulty_firearm_name").val(ui.item.f_name);
            $("#faulty_firearm_class").val(ui.item.f_class);
            return false;
          }
        });

        // Autocomplete for returned by officer
        $("#returned_by_officer").autocomplete({
          source: function(request, response) {
            $.ajax({
              url: "fetchData_officer.php",
              dataType: "json",
              type: "POST",
              data: {
                search: request.term
              },
              success: function(data) {
                response(data);
              }
            });
          },
          minLength: 1,
          select: function(event, ui) {
            $("#returned_by_officer").val(ui.item.label);
            $("#returned_officer_id").val(ui.item.value);
            return false;
          }
        });
      });

      function previewImages() {
          var preview = document.querySelector('#image_preview');
          preview.innerHTML = "";
          var files = document.querySelector('#images').files;
          if (files) {
              [].forEach.call(files, function(file) {
                  var reader = new FileReader();
                  reader.onload = function(event) {
                      var img = document.createElement("img");
                      img.src = event.target.result;
                      img.style.width = "100px";
                      img.style.height = "100px";
                      img.style.objectFit = "cover";
                      img.style.margin = "5px";
                      preview.appendChild(img);
                  }
                  reader.readAsDataURL(file);
              });
          }
      }

      document.addEventListener("DOMContentLoaded", function() {
          const params = new URLSearchParams(window.location.search);
          if(params.has('status')) {
              let status = params.get('status');
              let toast = document.createElement('div');
              toast.className = 't-toast';
              
              if(status === 'success') {
                  toast.innerHTML = '[SIGNAL]: TRANSACTION_COMMITTED';
                  toast.style.borderLeft = '5px solid #00f2ff';
              } else if(status === 'error') {
                  toast.innerHTML = '[SIGNAL]: TRANSACTION_FAILED';
                  toast.style.borderLeft = '5px solid #ff4d4d';
              } else {
                  toast.innerHTML = `[SIGNAL]: ${decodeURIComponent(status).toUpperCase()}`;
                  toast.style.borderLeft = '5px solid #ff4d4d';
              }
              
              document.getElementById('toast-container').appendChild(toast);
              toast.style.display = 'block';
              
              setTimeout(function() {
                  toast.style.display = 'none';
                  toast.remove();
              }, 3500);
          }
      });
    </script>
  </body>
</html>