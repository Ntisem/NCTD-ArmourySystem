
<?php  require_once('connections/connect-db.php');?>
<?php  
require_once('functions.php');
require_once('includes/user_auth.php');
?>

<?php
    // session_start();
    if(!isset($_SESSION["username"]) && ($_SESSION["user_role"])=='Armourer') {
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
    <title>GPS ARMOURY SYSTEM - FIREARMS SUMMARY</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
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
            <div class="page-header">
              <h3 class="page-title"> Firearms Summary </h3>
              <nav aria-label="breadcrumb">
              </nav>
            </div>
          <!-- content-wrapper ends -->
            <div class="content-wrapper">
            <div class="row">
           <div class="col-md-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex flex-row justify-content-between">
                      <h4 class="card-title mb-1">Name of Firearms</h4>
                      <p class=" mb-1">Total</p>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <div class="preview-list">
                          <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-light" style="color:#000000;">
                                <i class="mdi mdi-pistol"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">
                                 <?php
                                  $query = mysqli_query($connect_db,"SELECT * FROM `firearms` WHERE `firearm_name` = 'AK47'  ORDER BY `firearmID` ASC")
                                  or die( mysqli_error($connect_db));
                                    if (mysqli_num_rows($query) > 0) {
                                    $row = mysqli_fetch_assoc($query);
                                    // $firearm_name = $row['firearm_name'];
                                    // echo "Results found for Firearm: $firearm_name";  
                                      $rowcount=mysqli_num_rows($query);
                                        // printf(" %d \n",$rowcount);
                                        // Free result set
                                        $number_firearm_name =$rowcount;
                                        $_SESSION['number_firearm_name'] = $number_firearm_name;
                                        $number_firearm_name = $_SESSION['number_firearm_name'];
                                        $firearm_name = $row['firearm_name'];
                                      echo  $_SESSION['firearm_name'] = $firearm_name;


                                        mysqli_free_result($query);
                                    } 
                                    ?>
                                </h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                <h3 class=" bg-warning" style ="color:#000000;padding:10px;"><?php echo $_SESSION['number_firearm_name']; ?></h3>
                              </div>
                            </div>
                          </div>
                           <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-light" style="color:#000000;">
                                <i class="mdi mdi-pistol"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">
                                 <?php
                                  $query = mysqli_query($connect_db,"SELECT * FROM `firearms` WHERE `firearm_name` = 'BERETTA-M9'  ORDER BY `firearmID` ASC")
                                  or die( mysqli_error($connect_db));
                                    if (mysqli_num_rows($query) > 0) {
                                    $row = mysqli_fetch_assoc($query);
                                    // $firearm_name = $row['firearm_name'];
                                    // echo "Results found for Firearm: $firearm_name";  
                                      $rowcount=mysqli_num_rows($query);
                                        // printf(" %d \n",$rowcount);
                                        // Free result set
                                        $number_firearm_name =$rowcount;
                                        $_SESSION['number_firearm_name'] = $number_firearm_name;
                                        $number_firearm_name = $_SESSION['number_firearm_name'];
                                        $firearm_name = $row['firearm_name'];
                                      echo  $_SESSION['firearm_name'] = $firearm_name;


                                        mysqli_free_result($query);
                                    } 
                                    ?>
                                </h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                <h3 class=" bg-warning" style ="color:#000000;padding:10px;"><?php echo $_SESSION['number_firearm_name']; ?></h3>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-light" style="color:#000000;">
                                <i class="mdi mdi-pistol"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">
                                 <?php
                                  $query = mysqli_query($connect_db,"SELECT * FROM `firearms` WHERE `firearm_name` = 'BERETTA-92'  ORDER BY `firearmID` ASC")
                                  or die( mysqli_error($connect_db));
                                    if (mysqli_num_rows($query) > 0) {
                                    $row = mysqli_fetch_assoc($query);
                                    // $firearm_name = $row['firearm_name'];
                                    // echo "Results found for Firearm: $firearm_name";  
                                      $rowcount=mysqli_num_rows($query);
                                        // printf(" %d \n",$rowcount);
                                        // Free result set
                                        $number_firearm_name =$rowcount;
                                        $_SESSION['number_firearm_name'] = $number_firearm_name;
                                        $number_firearm_name = $_SESSION['number_firearm_name'];
                                        $firearm_name = $row['firearm_name'];
                                      echo  $_SESSION['firearm_name'] = $firearm_name;


                                        mysqli_free_result($query);
                                    } 
                                    ?>
                                </h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                <h3 class=" bg-warning" style ="color:#000000;padding:10px;"><?php echo $_SESSION['number_firearm_name']; ?></h3>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-light" style="color:#000000;">
                                <i class="mdi mdi-pistol"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">
                                 <?php
                                  $query = mysqli_query($connect_db,"SELECT * FROM `firearms` WHERE `firearm_name` = 'CZ-SCORPION'  ORDER BY `firearmID` ASC")
                                  or die( mysqli_error($connect_db));
                                    if (mysqli_num_rows($query) > 0) {
                                    $row = mysqli_fetch_assoc($query);
                                    // $firearm_name = $row['firearm_name'];
                                    // echo "Results found for Firearm: $firearm_name";  
                                      $rowcount=mysqli_num_rows($query);
                                        // printf(" %d \n",$rowcount);
                                        // Free result set
                                        $number_firearm_name =$rowcount;
                                        $_SESSION['number_firearm_name'] = $number_firearm_name;
                                        $number_firearm_name = $_SESSION['number_firearm_name'];
                                        $firearm_name = $row['firearm_name'];
                                      echo  $_SESSION['firearm_name'] = $firearm_name;


                                        mysqli_free_result($query);
                                    } 
                                    ?>
                                </h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                <h3 class=" bg-warning" style ="color:#000000;padding:10px;"><?php echo $_SESSION['number_firearm_name']; ?></h3>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-light" style="color:#000000;">
                                <i class="mdi mdi-pistol"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">
                                 <?php
                                  $query = mysqli_query($connect_db,"SELECT * FROM `firearms` WHERE `firearm_name` = 'CZ805'  ORDER BY `firearmID` ASC")
                                  or die( mysqli_error($connect_db));
                                    if (mysqli_num_rows($query) > 0) {
                                    $row = mysqli_fetch_assoc($query);
                                    // $firearm_name = $row['firearm_name'];
                                    // echo "Results found for Firearm: $firearm_name";  
                                      $rowcount=mysqli_num_rows($query);
                                        // printf(" %d \n",$rowcount);
                                        // Free result set
                                        $number_firearm_name =$rowcount;
                                        $_SESSION['number_firearm_name'] = $number_firearm_name;
                                        $number_firearm_name = $_SESSION['number_firearm_name'];
                                        $firearm_name = $row['firearm_name'];
                                      echo  $_SESSION['firearm_name'] = $firearm_name;


                                        mysqli_free_result($query);
                                    } 
                                    ?>
                                </h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                <h3 class=" bg-warning" style ="color:#000000;padding:10px;"><?php echo $_SESSION['number_firearm_name']; ?></h3>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-light" style="color:#000000;">
                                <i class="mdi mdi-pistol"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">
                                 <?php
                                  $query = mysqli_query($connect_db,"SELECT * FROM `firearms` WHERE `firearm_name` = 'CZ807'  ORDER BY `firearmID` ASC")
                                  or die( mysqli_error($connect_db));
                                    if (mysqli_num_rows($query) > 0) {
                                    $row = mysqli_fetch_assoc($query);
                                    // $firearm_name = $row['firearm_name'];
                                    // echo "Results found for Firearm: $firearm_name";  
                                      $rowcount=mysqli_num_rows($query);
                                        // printf(" %d \n",$rowcount);
                                        // Free result set
                                        $number_firearm_name =$rowcount;
                                        $_SESSION['number_firearm_name'] = $number_firearm_name;
                                        $number_firearm_name = $_SESSION['number_firearm_name'];
                                        $firearm_name = $row['firearm_name'];
                                      echo  $_SESSION['firearm_name'] = $firearm_name;


                                        mysqli_free_result($query);
                                    } 
                                    ?>
                                </h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                <h3 class=" bg-warning" style ="color:#000000;padding:10px;"><?php echo $_SESSION['number_firearm_name']; ?></h3>
                              </div>
                            </div>
                          </div>
                           <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-light" style="color:#000000;">
                                <i class="mdi mdi-pistol"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">
                                 <?php
                                  $query = mysqli_query($connect_db,"SELECT * FROM `firearms` WHERE `firearm_name` = 'NP-18'  ORDER BY `firearmID` ASC")
                                  or die( mysqli_error($connect_db));
                                    if (mysqli_num_rows($query) > 0) {
                                    $row = mysqli_fetch_assoc($query);
                                    // $firearm_name = $row['firearm_name'];
                                    // echo "Results found for Firearm: $firearm_name";  
                                      $rowcount=mysqli_num_rows($query);
                                        // printf(" %d \n",$rowcount);
                                        // Free result set
                                        $number_firearm_name =$rowcount;
                                        $_SESSION['number_firearm_name'] = $number_firearm_name;
                                        $number_firearm_name = $_SESSION['number_firearm_name'];
                                        $firearm_name = $row['firearm_name'];
                                      echo  $_SESSION['firearm_name'] = $firearm_name;


                                        mysqli_free_result($query);
                                    } 
                                    ?>
                                </h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                <h3 class=" bg-warning" style ="color:#000000;padding:10px;"><?php echo $_SESSION['number_firearm_name']; ?></h3>
                              </div>
                            </div>
                          </div>
                           <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-light" style="color:#000000;">
                                <i class="mdi mdi-pistol"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">
                                 <?php
                                  $query = mysqli_query($connect_db,"SELECT * FROM `firearms` WHERE `firearm_name` = 'NP-22'  ORDER BY `firearmID` ASC")
                                  or die( mysqli_error($connect_db));
                                    if (mysqli_num_rows($query) > 0) {
                                    $row = mysqli_fetch_assoc($query);
                                    // $firearm_name = $row['firearm_name'];
                                    // echo "Results found for Firearm: $firearm_name";  
                                      $rowcount=mysqli_num_rows($query);
                                        // printf(" %d \n",$rowcount);
                                        // Free result set
                                        $number_firearm_name =$rowcount;
                                        $_SESSION['number_firearm_name'] = $number_firearm_name;
                                        $number_firearm_name = $_SESSION['number_firearm_name'];
                                        $firearm_name = $row['firearm_name'];
                                      echo  $_SESSION['firearm_name'] = $firearm_name;


                                        mysqli_free_result($query);
                                    } 
                                    ?>
                                </h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                <h3 class=" bg-warning" style ="color:#000000;padding:10px;"><?php echo $_SESSION['number_firearm_name']; ?></h3>
                              </div>
                            </div>
                          </div>
                          <div class="preview-item border-bottom">
                            <div class="preview-thumbnail">
                              <div class="preview-icon bg-light" style="color:#000000;">
                                <i class="mdi mdi-pistol"></i>
                              </div>
                            </div>
                            <div class="preview-item-content d-sm-flex flex-grow">
                              <div class="flex-grow">
                                <h6 class="preview-subject">
                                 <?php
                                  $query = mysqli_query($connect_db,"SELECT * FROM `firearms` WHERE `firearm_name` = 'SIGPRO'  ORDER BY `firearmID` ASC")
                                  or die( mysqli_error($connect_db));
                                    if (mysqli_num_rows($query) > 0) {
                                    $row = mysqli_fetch_assoc($query);
                                    // $firearm_name = $row['firearm_name'];
                                    // echo "Results found for Firearm: $firearm_name";  
                                      $rowcount=mysqli_num_rows($query);
                                        // printf(" %d \n",$rowcount);
                                        // Free result set
                                        $number_firearm_name =$rowcount;
                                        $_SESSION['number_firearm_name'] = $number_firearm_name;
                                        $number_firearm_name = $_SESSION['number_firearm_name'];
                                        $firearm_name = $row['firearm_name'];
                                      echo  $_SESSION['firearm_name'] = $firearm_name;


                                        mysqli_free_result($query);
                                    } 
                                    ?>
                                </h6>
                              </div>
                              <div class="mr-auto text-sm-right pt-2 pt-sm-0">
                                <h3 class=" bg-warning" style ="color:#000000;padding:10px;"><?php echo $_SESSION['number_firearm_name']; ?></h3>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
            <!-- partial:partials/footer.php-->
            <?php  require_once('includes/footer.php');?>
          
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/select2/select2.min.js"></script>
    <script src="assets/vendors/typeahead.js/typeahead.bundle.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/file-upload.js"></script>
    <script src="assets/js/typeahead.js"></script>
    <script src="assets/js/select2.js"></script>
    <script>
      function checkSerialNo(){
        jQuery.ajax({
          url: "checkAvailability.php",
          data: 'new_firearm_name='+$("#new_firearm_name").val(),
          type:"POST",
          success: function(data){
            $("#check-new-firearm-name").html(data);
          },
            error:function(){}
        });
      }

  </script>
    <!-- End custom js for this page -->
  </body>
</html>