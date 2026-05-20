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
    <title>GPS ARMOURY SYSTEM - ADD BLANK / FAULTY AMMUNITION</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
      :root {
        --bg-tactical: #0d0f12; --panel-bg: #15181f;
        --neon: #00f2ff; --danger: #ff4d4d; --text-tactical: #e0e0e0;
      }
      body { background-color: var(--bg-tactical); color: var(--text-tactical); }
      .card { background-color: var(--panel-bg); border: 1px solid rgba(255, 255, 255, 0.1); }
      .form-control { background-color: #1a1f2c; border: 1px solid rgba(255, 255, 255, 0.1); color: var(--text-tactical); }
      .form-control:focus { background-color: #1a1f2c; border-color: var(--neon); color: var(--text-tactical); box-shadow: 0 0 8px rgba(0,242,255,0.2); }
      label { color: var(--text-tactical); font-weight: 600; letter-spacing: 0.5px; }
      .btn-tactical { background: transparent; border: 1px solid var(--neon); color: var(--neon); padding: 10px 25px; font-weight: bold; font-family: monospace; }
      .btn-tactical:hover { background: var(--neon); color: var(--bg-tactical); }
      .btn-danger-tactical { background: transparent; border: 1px solid var(--danger); color: var(--danger); padding: 10px 25px; font-weight: bold; font-family: monospace; }
      .btn-danger-tactical:hover { background: var(--danger); color: var(--bg-tactical); }
      .ui-autocomplete { background: #1a1f2c !important; border: 1px solid var(--neon) !important; color: #fff !important; font-family: monospace; }
      .ui-menu-item-wrapper:hover { background: var(--neon) !important; color: #000 !important; }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <?php require_once('includes/sidebar.php'); ?>
      <div class="container-fluid page-body-wrapper">
        <?php require_once('includes/navbar.php'); ?>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title text-light">[TACTICAL LEDGER] // INJECT_FAULT_ENTRY</h3>
            </div>
            <div class="row justify-content-center">
              <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <form class="forms-sample" action="process-faulty-ammo.php" method="POST" enctype="multipart/form-data">
                      <div class="form-group">
                        <label>Ammunition Name / Caliber Profile</label>
                        <input type="text" class="form-control" id="faulty_ammo_name" name="faulty_ammo_name" placeholder="Begin typing ammunition configuration name..." required autocomplete="off">
                      </div>
                      <div class="form-group">
                        <label>Manufacturer</label>
                        <input type="text" class="form-control" id="faulty_ammo_manufacturer" name="faulty_ammo_manufacturer" readonly placeholder="Auto-populated by indexing engine..." required>
                      </div>
                      <div class="form-group">
                        <label>Quantity Compromised (Rounds)</label>
                        <input type="number" class="form-control" name="faulty_ammo_quantity" placeholder="Specify quantity count" required min="1">
                      </div>
                      <div class="form-group">
                        <label>Failure Classification Mode</label>
                        <select class="form-control" name="faulty_type" required>
                          <option value="">-- Choose Discovered Fault Classification --</option>
                          <option value="Breakage">Breakage</option>
                          <option value="Misfire">Misfire</option>
                          <option value="Corrosion">Corrosion</option>
                          <option value="Dent">Dent</option>
                          <option value="Other">Other</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Returned / Logged By Officer</label>
                        <input type="text" class="form-control" id="returned_by_officer" name="returned_by_officer" placeholder="Lookup station officer identifier..." required autocomplete="off">
                      </div>
                      <div class="form-group">
                        <label>Remarks</label>
                        <textarea class="form-control" name="faulty_ammo_comment" rows="4" placeholder="Enter structural failure remarks..."></textarea>
                      </div>
                      <div class="form-group">
                        <label>Visual Evidence Attachment Upload</label>
                        <input type="file" name="faulty_ammo_images[]" class="form-control" id="faulty_ammo_images" onchange="previewImages()">
                        <div id="image-preview" class="d-flex flex-wrap mt-2"></div>
                      </div>
                      <div class="mt-4">
                        <button type="submit" name="add_faulty_ammo" class="btn btn-tactical mr-2">EXECUTE DATA TRANSACTION</button>
                        <a href="faulty-ammo.php" class="btn btn-danger-tactical">TERMINATE ROUTINE</a>
                      </div>
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
                  reader.onload = function(e) {
                      var img = document.createElement("img");
                      img.src = e.target.result;
                      img.style.width = "110px"; img.style.height = "110px";
                      img.style.objectFit = "cover"; img.style.margin = "6px";
                      img.style.border = "1px solid var(--neon)";
                      preview.appendChild(img);
                  }
                  reader.readAsDataURL(file);
              });
          }
      }

      $(document).ready(function() {
          $('#faulty_ammo_name').autocomplete({
              source: function(request, response) {
                  $.ajax({
                      url: 'fetch-faulty-ammo.php',
                      type: 'POST',
                      dataType: 'json',
                      data: { search: request.term },
                      success: function(data) { response(data); }
                  });
              },
              minLength: 1,
              select: function(event, ui) {
                  $('#faulty_ammo_name').val(ui.item.label);
                  $('#faulty_ammo_manufacturer').val(ui.item.manufacturer);
                  return false;
              }
          });

          $('#returned_by_officer').autocomplete({
              source: function(request, response) {
                  $.ajax({
                      url: 'fetchData_officer.php',
                      type: 'POST',
                      dataType: 'json',
                      data: { search: request.term },
                      success: function(data) { response(data); }
                  });
              },
              minLength: 1,
              select: function(event, ui) {
                  $('#returned_by_officer').val(ui.item.label);
                  return false;
              }
          });
      });
    </script>
  </body>
</html>