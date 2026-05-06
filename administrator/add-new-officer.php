
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
    <title>GPS ARMOURY SYSTEM - ADD NEW OFFICER</title>
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
              <h3 class="page-title"> Add New Officer </h3>
              <nav aria-label="breadcrumb">
              
              </nav>
            </div>
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <!-- <h4 class="card-title">Horizontal Two column</h4> -->
              
                      <!-- <p class="card-description"> Personal info </p> -->
                          <p class="card-description"><code> Personal Info</code> </p>
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
                              <input type="hidden" name="action_taken" class="form-control" id="exampleInputName1" value="added new new Officer">
                              <input type="hidden" name="user_role" class="form-control" id="exampleInputName1" value="<?php echo $user_role; ?>">
                          <div class="row">
                            <div class="col-md-4">                     
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Service No.</code></label>
                              <input type="text" name="officer_service_no" class="form-control" id="exampleInputName1"
                               placeholder="Service Number" required>
                            </div>                        
                          </div>
                          <div class="col-md-4">                     
                              <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Rank</code></label>
                                <div class="col-sm-9">
                                  <select class="form-control" name="rank" required>
                                    <option value="CONST">Constable</option>
                                    <option value="L/CPL">Lance Corporal</option>
                                    <option value="CPL">Corporal</option>
                                    <option value="SGT">Sergeant</option>
                                    <option value="INSPR">Inspector</option>
                                    <option value="C/INSPR">Chief Inspector</option>
                                    <option value="ASP">Assistant Superintendent</option>
                                    <option value="DSP">Deputy Superintendent</option>
                                    <option value="SUP">Superintendent</option>
                                    <option value="C/SUP">Chief Superintendent</option>
                                    <option value="ACP">Assistant Commissioner</option>
                                    <option value="DCOP">Deputy Commissioner</option>
                                  </select>
                                </div>                       
                              </div>                        
                          </div>
                          <div class="col-md-4">
                          <div class="form-group">
                        <label for="exampleSelectGender"><code style="color:#fff">Gender</code></label>
                        <select name="gender" class="form-control" id="exampleSelectGender" required>
                          <option value="Male">Male</option>
                          <option value="Female">Female</option>
                        </select>
                      </div>
                        </div>
                         </div>
                            <div class="form-group">
                              <input type="hidden" name="officer_status" class="form-control" id="exampleInputName1" value="Active In Service">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Surname</code></label>
                              <input type="text" name="last_name" class="form-control" id="exampleInputName1" placeholder="Last Name" required>
                            </div>
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Othernames</code></label>
                              <input type="text" name="first_name" class="form-control" id="exampleInputName1" placeholder="First Name" required>
                            </div>
                       
                            <div class="form-group">
                              <label for="exampleInputEmail3"><code style="color:#fff">Email address</code></label>
                              <input type="email" class="form-control" name="officer_email" id="officer_email" placeholder="Email">
                            </div>
                            <div class="form-group">
                              <label for="exampleInputEmail3"><code style="color:#fff">Phone Number</code></label>
                              <input type="text" class="form-control" name="phone_no" id="phone_no" pattern="^(\d{3}[-]?){1,2}(\d{4})$"  placeholder="eg: 020-800-7000" required>
                            </div>                          
                            <div class="row">                          
                            <div class="col-md-6">
                          <div class="form-group ">
                            <label for="exampledropdown"><code style="color:#fff">Unit/Dept</code></label>
                            <div class="col-sm-9">
                              <select class="form-control" name="dept_unit">
                                <option value="NVU">National Visibility Unit (NVU)</option>
                                <option value="CTD">Counter Terrorism Dept (CTD)</option>
                                <option value="SWAT">Special Weapon and Tactics (SWAT)</option>
                                <option value="FPU">Formed Police Unit (FPU)</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleFormControlFile1" style="color:#fff;"><code style="color:#fff">Upload Profile Image</code></label>
                          <input type="file" class="form-control" name="officer_image" id="exampleFormControlFile1">
                            </div>
                            </div>
                        </div>
                            <button type="submit" name="add_officer" class="btn btn-inverse-success me-2">Submit</button>
                            <button class="btn btn-inverse-danger" >Cancel</button>
                         </form>
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