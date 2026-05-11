<?php  require_once('connections/connect-db.php');?>
<?php  
require_once('functions.php');
require_once('includes/user_auth.php');
?>

<?php
    // session_start();
    if(!isset($_SESSION["username"]) && ($_SESSION["user_role"])=='Administrator') {
        header("location: login");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GPS ARMOURY SYSTEM </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
    <!-- End plugin css for this page -->
    <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>   -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
    .form-control:focus, .asColorPicker-input:focus, .dataTables_wrapper select:focus, .jsgrid .jsgrid-table .jsgrid-filter-row input:focus[type=text], .jsgrid .jsgrid-table .jsgrid-filter-row select:focus, .jsgrid .jsgrid-table .jsgrid-filter-row input:focus[type=number], .select2-container--default .select2-selection--single:focus, .select2-container--default .select2-selection--single .select2-search__field:focus, .typeahead:focus, .tt-query:focus, .tt-hint:focus {
      color:#fff;
    }
    </style>
  </head>
  <body onload=display_ct();>
    <div class="container-scroller">
      <!-- partial:includes/_sidebar.html -->
      <?php  require_once('includes/sidebar.php');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:includes/_navbar.html -->
        <?php  require_once('includes/navbar.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-xl-6 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                    <input type="text" name="officer-name" id="officer-name" class="form-control" placeholder="Enter officer's name/Service number...." />  
                    <div id="officers-names-list"></div>
                    </div>
                  </div>
                </div>
               <br>
            </div>
          </div>
          <!-- content-wrapper ends -->
           <!-- <div class="main-panel"> -->
  <div class="content-wrapper">
    <div class="row">
      <div class="col-xl-8 col-lg-10 col-sm-12 grid-margin stretch-card mx-auto">
        <div class="card" style="border: 1px solid var(--neon-cyan);">
          <div class="card-body">
            <h4 class="card-title text-cyan"><i class="mdi mdi-magnify"></i> GLOBAL INTEL SEARCH</h4>
            <p class="text-muted">Query firearms, ammo, personnel, or faulty assets via name, service no, or capacity.</p>
            <div class="form-group position-relative">
              <input type="text" id="global_search" class="form-control" autocomplete="off" 
                     placeholder="Search serials, names, calibers, or phone numbers..." 
                     style="height: 50px; font-family: 'Roboto Mono'; color: #00f2ff; background: rgba(0,0,0,0.3);">
              <div id="intel_results_list"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

          <!-- partial:includes/_footer.html -->
        
          <!-- partial -->
        </div>
        <?php  require_once('includes/footer.php');?>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->


<script>  
$(document).ready(function(){  
  $('#global_search').keyup(function(){  
       var query = $(this).val();  
       if(query.length > 1) {  
            $.ajax({  
                 url: "search-intel-backend.php",  
                 method: "POST",  
                 data: {query: query},  
                 success: function(data) {  
                      $('#intel_results_list').fadeIn();  
                      $('#intel_results_list').html(data);  
                 }  
            });  
       } else {
            $('#intel_results_list').fadeOut();
       }
  });

  // Close results if clicking outside
  $(document).click(function(e) {
      if (!$(e.target).closest('.form-group').length) {
          $('#intel_results_list').fadeOut();
      }
  });
});  
</script>
<?php  require_once('includes/google-analytics.php');?>
  </body>
</html>