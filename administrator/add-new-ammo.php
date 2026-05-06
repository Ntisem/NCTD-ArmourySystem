
<?php  require_once('connections/connect-db.php');?>
<?php  
require_once('functions.php');
require_once('includes/user_auth.php');
?>

<?php
    // session_start();
    if(!isset($_SESSION["username"])) {
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
    <title>GPS ARMOURY SYSTEM - ADD NEW AMMUNITION</title>
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
              <h3 class="page-title"> Add New Ammunition </h3>
              <nav aria-label="breadcrumb">            
              </nav>
            </div>
            <div class="card" style="margin-bottom:30px;">
             <div class="card-body">
             <a href="add-new-weapon" type="button" class="btn btn-outline-info btn-fw">[ Firearm ]</a>
            <a href="add-new-ammo" type="button" class="btn btn-outline-danger btn-fw">[ Ammunition ]</a>
            <a href="add-new-other-assets" type="button" class="btn btn-outline-info btn-fw">[ Assets ]</a>
          </div>
          </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <form method="POST" action="functions-inventory.php" class="forms-sample" enctype="multipart/form-data">
                    <?php  
                      $username=$_SESSION['username']; 
                      $query = mysqli_query($connect_db,"SELECT * FROM `admin_lists` WHERE `username` ='$username'")
                      or die( mysqli_error($connect_db));
                      while ($row = mysqli_fetch_array($query)) {
                          $profile_image = $row['profile_image'];
                          $fullname = $row['fullname'];
                          $_SESSION['fullname'] =  $fullname;
                          $user_role = $row['user_role'];
                          $service_no = $row['service_no'];
                          $_SESSION['service_no']=$service_no;
                          $admin_rank =$row['rank'];
                          $_SESSION['rank']=$admin_rank;
                          $adminID =$row['adminID'];
                          $_SESSION['adminID']=$adminID;
                          $_SESSION['user_role'] =  $user_role;    
                      }?>      
                        <input type="hidden" name="armourer_admin_name" class="form-control" id="exampleInputName1" value="<?php echo $service_no.' '.$admin_rank.' '.$fullname ?>">
                        <input type="hidden" name="adminID" class="form-control" id="exampleInputName1" value="<?php echo $adminID; ?>">
                        <input type="hidden" name="booking_status" class="form-control" id="exampleInputName1" value="Available">
                        <input type="hidden" name="user_role" class="form-control" id="exampleInputName1" value="<?php echo $user_role; ?>">
                   
                    <div class="row">
                      <div class="col-md-4">                     
                      <div class="form-group">
                        <label for="exampleInputName1"><code style="color:#fff">Ammunition Serial No.</code></label>
                        <input type="text" name="ammo_serial_no" class="form-control" id="exampleInputName1"
                          placeholder="Ammo Serial Number" required>
                            </div>                        
                          </div> 
                          <div class="col-md-6">                     
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Manufacturer</code></label>
                              <input type="text" name="manufacturer" class="form-control" id="exampleInputName1"
                               placeholder="Manufacturer" required>
                            </div>                        
                          </div>                                                
                          <div class="form-group">
                            <label class="col-sm-3 col-form-label"><code style="color:#fff">Ammunition Type</code></label>
                            <div class="col-sm-9">
                              <select name="ammo_type" class="form-control" required>
                                <option style="color:#000" value="None">None</option>
                                <option style="color:#000" value="Elite-Hunter">Elite Hunter</option>
                                <option style="color:#000" value="Full-Metal-Jacket">Full-Metal-Jacket(FMJ)</option>
                                <option style="color:#000" value="Jacketed-Hollow-Point">Jacketed Hollow Point(JHP)</option>
                                <option style="color:#000" value="Open-Tip-Match">Open Tip Match(OTM)</option>
                              </select>
                            </div>
                          </div>
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Ammunition Name</code></label>
                              <input type="text" name="ammo_name" class="form-control" id="exampleInputName1" placeholder="Ammo Name" required>
                            </div>

                             <div class="row">
                             <div class="col-md-5"> 
                            <div class="form-group">
                            <label class="col-sm-10 col-form-label"><code style="color:#fff">Ammunition Application</code><code>(Purpose)</code></label>
                            <div class="col-sm-9">
                              <select name="ammo_application" class="form-control">
                                <option style="color:#000" value="None">None</option>
                                <option style="color:#000" value="Defensive">Defensive</option>
                                <option style="color:#000" value="Hunting">Hunting</option>
                                <option style="color:#000" value="Match-Grade">Match-Grade</option>
                                <option style="color:#000" value="Practice">Practice</option>
                              </select>
                            </div>
                          </div>
                           </div>
                           <div class="col-md-4"> 
                             <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Ammunition Quantity <code>(Boxes) </code></code></label>
                              <input type="number" name="ammo_boxes" class="form-control" id="exampleInputName1" placeholder="Quantity in Boxes" required>
                                </div>
                              </div>
                           
                            <div class="col-md-3"> 
                             <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff"> <code>Number of Rounds </code></code></label>
                              <input type="number" name="ammo_rounds" class="form-control" id="exampleInputName1" placeholder="Number of Rounds" required>
                                </div>
                              </div>
                       
                         <div class="form-group">
                          <label for="exampleFormControlFile1" style="color:#fff;"><code style="color:#fff">Upload Ammunition Image</code></label>
                          <input type="file" class="form-control" name="ammo_image" id="exampleFormControlFile1">
                            </div>                          
                         </div>
                        </div>
                            <button type="submit" name="add_new_ammo" class="btn btn-inverse-success me-2">Submit</button>
                            <button class="btn btn-inverse-danger" >Cancel</button>
                         </form>
                  </div>
                </div>
              </div>
            </div>
            </div>
          <!-- content-wrapper ends -->
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
    <!-- End custom js for this page -->
  </body>
</html>