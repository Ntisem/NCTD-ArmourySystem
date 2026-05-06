
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
    <title>GPS ARMOURY SYSTEM - ADD FAULTY AMMUNITION</title>
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
              <h3 class="page-title"> Add Faulty Ammunition </h3>
              <a href="add-faulty-weapon" type="button" class="btn btn-outline-info btn-fw">[ Firearm ]</a>
              <a href="add-faulty-ammo" type="button" class="btn btn-outline-danger btn-fw">[ Ammunition ]</a>
              <a href="add-faulty-assets" type="button" class="btn btn-outline-info btn-fw">[ Other Assets ]</a>
              <nav aria-label="breadcrumb">                
              </nav>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
          
                    <form method="POST" action="functions.php" class="forms-sample" enctype="multipart/form-data">
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
                    <input type="hidden" name="action_taken" class="form-control" id="exampleInputName1" value="added new faulty Ammunition">
                    <input type="hidden" name="user_role" class="form-control" id="exampleInputName1" value="<?php echo $user_role; ?>">
                         
                          <div class="row">
                            <div class="col-md-4">                     
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Faulty Ammo Serial No.</code></label>
                              <input type="text" name="faulty_ammo_serial_no" class="form-control" id="exampleInputName1"
                               placeholder="Ammo Serial Number" required>
                            </div>                        
                          </div>
                            <div class="form-group">
                            <label class="col-sm-3 col-form-label"><code style="color:#fff">Faulty Ammo Type</code></label>
                            <div class="col-sm-9">
                              <select name="faulty_ammo_type" class="form-control">
                                <option value="None">None</option>
                                <option value="Elite-Hunter">Elite Hunter</option>
                                <option value="Full-Metal-Jacket">Full-Metal-Jacket(FMJ)</option>
                                <option value="Jacketed-Hollow-Point">Jacketed Hollow Point(JHP)</option>
                                <option value="Open-Tip-Match">Open Tip Match(OTM)</option>
                              </select>
                            </div>
                          </div>
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Faulty Ammo Name</code></label>
                              <input type="text" name="faulty_ammo_name" id="faulty_ammo_name" class="form-control" id="exampleInputName1"
                               placeholder="Faulty Ammo Name" required>
                               <input type="hidden" name="ammoID" id="ammoID" class="form-control" id="exampleInputName1">
                               <input type="hidden" name="total_ammo_rounds" id="total_ammo_rounds" class="form-control">
                            </div>               
                            <div class="col-md-6">
                            <div class="form-group">
                              <label for="exampleInputEmail3"><code style="color:#fff">Faulty Quantity/Rounds</code></label>
                              <input type="number" class="form-control" name="faulty_ammo_quantity" id="faulty_quantity" placeholder="Faulty Quantity" required>
                            </div>     
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                              <label for="exampleInputEmail3"><code style="color:#fff"> Fault Type </code></label>
                              <input type="text" class="form-control" name="faulty_type" id="faulty_type" placeholder="Faulty Type" required>
                            </div>     
                            </div>                             
                              <div class="col-md-6">
                              <div class="form-group">
                                <label for="exampleFormControlFile1" style="color:#fff;"><code style="color:#fff"><code style="color:#fff">Upload Faulty Ammo Image</code></label>
                                <input type="file" class="form-control" name="faulty_ammo_image" id="exampleFormControlFile1">
                                  </div>
                              </div>
                              <div class="col-xl-10">
                                <div class="form-group">
                                  <label for="faulty_ammo_comment"><code style="color:#fff">Comment</code></label>
                                  <textarea style="height:150px; background:#e1e4e8" name="faulty_ammo_comment" id="faulty_ammo_comment" class="form-control" id="exampleTextarea1" rows="40"></textarea>
                                </div>
                              </div>
                              </div>
                            <button type="submit" name="add_faulty_ammo" class="btn btn-inverse-success me-2">Submit</button>
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