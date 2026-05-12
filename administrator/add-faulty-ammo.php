<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

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
    <title>GPS ARMOURY SYSTEM - ADD FAULTY AMMUNITION</title>
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
      label {
        color: var(--text-tactical);
        font-weight: 600;
      }
      .btn-tactical {
        background: transparent;
        border: 1px solid var(--neon);
        color: var(--neon);
        padding: 10px 25px;
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
        padding: 10px 25px;
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
              <h3 class="page-title text-light">ADD FAULTY AMMUNITION</h3>
              <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="faulty-ammo.php" style="color:var(--neon);">Faulty Ammunitions</a></li>
                  <li class="breadcrumb-item active text-light" aria-current="page">Add Faulty Ammunition</li>
                </ol>
              </nav>
            </div>
            
            <div class="row justify-content-center">
              <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" action="process-faulty-ammo.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label for="faulty_ammo_serial_no">Ammunition Name / Serial No.</label>
                        <input type="text" class="form-control" id="faulty_ammo_serial_no" name="faulty_ammo_serial_no" placeholder="Search and select Ammunition" required>
                      </div>
                      
                      <div class="form-group">
                        <label for="faulty_ammo_manufacturer">Manufacturer</label>
                        <input type="text" class="form-control" id="faulty_ammo_manufacturer" name="faulty_ammo_manufacturer" placeholder="Manufacturer" readonly required>
                      </div>
<!-- 
                      <div class="form-group">
                        <label for="faulty_ammo_type">Ammunition Type/Caliber</label>
                        <input type="text" class="form-control" id="faulty_ammo_type" name="faulty_ammo_type" placeholder="Type or Caliber">
                      </div> -->

                      <div class="form-group">
                        <label for="faulty_ammo_quantity">Quantity</label>
                        <input type="number" class="form-control" id="faulty_ammo_quantity" name="faulty_ammo_quantity" placeholder="Quantity" required min="1">
                      </div>

                      <div class="form-group">
                        <label for="faulty_type">Type of Fault</label>
                        <select class="form-control" id="faulty_type" name="faulty_type" required>
                          <option value="">Select Fault Type</option>
                          <option value="Breakage">Breakage</option>
                          <option value="Misfire">Misfire</option>
                          <option value="Corrosion">Corrosion</option>
                          <option value="Dent">Dent</option>
                          <option value="Other">Other</option>
                        </select>
                      </div>

                      <div class="form-group">
                        <label for="returned_by_officer">Returned By Officer</label>
                        <input type="text" class="form-control" id="returned_by_officer" name="returned_by_officer" placeholder="Search and select officer" required>
                      </div>

                      <div class="form-group">
                        <label for="faulty_ammo_comment">Remarks / Comments</label>
                        <textarea class="form-control" id="faulty_ammo_comment" name="faulty_ammo_comment" rows="4" placeholder="Enter comments here..."></textarea>
                      </div>

                      <div class="form-group">
                        <label>Upload Image</label>
                        <input type="file" name="faulty_ammo_images[]" class="form-control" id="faulty_ammo_images" onchange="previewImages()">
                        <div id="image-preview" class="d-flex flex-wrap mt-2"></div>
                      </div>

                      <button type="submit" name="add_faulty_ammo" class="btn btn-tactical mr-2">SUBMIT</button>
                      <a href="faulty-ammo.php" class="btn btn-danger-tactical">CANCEL</a>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php require_once('includes/footer.php'); ?>
        </div>
      </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <script>
      function previewImages() {
          var preview = document.getElementById('image-preview');
          preview.innerHTML = "";
          var files = document.getElementById('faulty_ammo_images').files;
          if (files) {
              Array.prototype.forEach.call(files, function(file) {
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

      $(document).ready(function() {
          // Autocomplete for Ammunition
          $('#faulty_ammo_serial_no').autocomplete({
              source: function(request, response) {
                  $.ajax({
                      url: 'fetch-faulty-ammo.php',
                      type: 'POST',
                      dataType: 'json',
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
                  $('#faulty_ammo_serial_no').val(ui.item.label);
                  $('#faulty_ammo_manufacturer').val(ui.item.manufacturer);
                  return false;
              }
          });

          // Autocomplete for Officer
          $('#returned_by_officer').autocomplete({
              source: function(request, response) {
                  $.ajax({
                      url: 'fetchData_officer.php',
                      type: 'POST',
                      dataType: 'json',
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
                  $('#returned_by_officer').val(ui.item.label);
                  return false;
              }
          });
      });

      // Toast Notification Handling
      document.addEventListener("DOMContentLoaded", function() {
          const params = new URLSearchParams(window.location.search);
          if(params.has('status')) {
              let status = params.get('status');
              let toast = document.createElement('div');
              toast.className = 't-toast';
              toast.innerHTML = `[SIGNAL]: ${status === 'success' ? 'TRANSACTION_COMMITTED' : 'TRANSACTION_FAILED'}`;
              document.getElementById('toast-container').appendChild(toast);
              
              toast.style.display = 'block';
              toast.style.borderLeft = status === 'success' ? '5px solid #00f2ff' : '5px solid #ff4d4d';
              
              setTimeout(function() {
                  toast.style.display = 'none';
                  toast.remove();
              }, 3500);
          }
      });
    </script>
  </body>
</html>