
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
    <title>GPS ARMOURY SYSTEM - ADD NEW FIREARM</title>
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
              <h3 class="page-title"> Add New Firearm </h3>
              <nav aria-label="breadcrumb">
              </nav>
            </div>
            <div class="card" style="margin-bottom:30px;">
             <div class="card-body">
            <a href="add-new-weapon" type="button" class="btn btn-outline-danger btn-fw">[ Firearm ]</a>
            <a href="add-new-ammo" type="button" class="btn btn-outline-info btn-fw">[ Ammunition ]</a>
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
                              <input type="hidden" name="user_role" class="form-control" id="exampleInputName1" value="<?php echo $user_role; ?>">
                              <input type="hidden" name="booking_status" class="form-control" id="exampleInputName1" value="Available">
                              <div class="row">
                            <div class="col-md-6">                     
                              <div class="form-group">
                                <label for="exampleInputName1"><code style="color:#fff">Firearm Serial No.</code></label>
                                <input type="text" name="firearm_serial_no" class="form-control" id="exampleInputName1"
                                placeholder="firearm/Serial Number" required>
                              </div>                        
                            </div>        
                          <!-- <div class="col-md-6">                     
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Weapon No.</code></label>
                              <input type="text" name="weapon_number" class="form-control" id="exampleInputName1"
                               placeholder="Weapon Number" required>
                            </div>                        
                          </div>    -->
                          <div class="col-md-6">                    
                          <div class="form-group">
                            <label class="col-sm-3 col-form-label"><code style="color:#fff">Firearms Type</code></label>
                            <div class="col-sm-12">
                              <select name="firearm_type" class="form-control" style="color:#000">
                              <option style="color:#000" value="">~ Firearm Type ~</option>
                                <option value="Pump-Action" style="color:#000">Pump Action</option>
                                <option value="Revolver" style="color:#000">Revolver</option>
                                <option value="Rifle" style="color:#000">Rifle</option>
                                <option value="ShortGun" style="color:#000">Short Gun</option>
                                <option value="Carbine" style="color:#000">Carbine</option>
                              </select>
                            </div>
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
                              <label for="exampleInputName1"><code style="color:#fff">Firearm Name</code></label>
                              <input type="text" name="firearm_name" class="form-control" id="exampleInputName1" placeholder="Firearm Name" required >
                            </div>

                             <div class="row">
                             <div class="col-md-6"> 
                            <div class="form-group">
                            <label class="col-sm-3 col-form-label"><code style="color:#fff">Caliber</code></label>
                            <div class="col-sm-9">
                              <select name="firearm_caliber" class="form-control">
                               <option style="color:#000" value="">~ Select Caliber ~</option>
                                <option style="color:#000" value="9x19mm">9x19mm</option>
                                <option style="color:#000" value="7.62x39mm">7.62x39mm</option>
                                <option style="color:#000" value="5.56x45mm">5.56x45mm</option>
                                <option style="color:#000" value="357-Magnum">357 Magnum</option>
                                <option style="color:#000" value="44-Magnum">44 Magnum</option>
                                <option style="color:#000" value="22-LR">22 LR</option>
                                <option style="color:#000" value="45-Colt">45 Colt</option>
                                <option style="color:#000" value="12-Gauge">12 Gauge</option>
                              </select>
                            </div>
                          </div>
                           </div>
                           <div class="col-md-6"> 
                             <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">firearm Capacity <code>(Rounds) </code></code></label>
                              <input type="number" name="firearm_capacity" class="form-control" id="exampleInputName1" placeholder="Number of Rounds">
                            </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-4"> 
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">firearm Weight <code>(inches")</code></code></label>
                              <input type="text" name="firearm_weight" class="form-control" id="exampleInputName1" placeholder="Weight">
                            </div>
                            </div>
                            <div class="col-md-4"> 
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">firearm Length <code>(inches")</code></code></label>
                              <input type="text" name="firearm_length" class="form-control" id="exampleInputName1" placeholder="Length">
                            </div>
                            </div>
                            <div class="col-md-4"> 
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">firearm Height <code>(inches")</code></code></label>
                              <input type="text" name="firearm_height" class="form-control" id="exampleInputName1" placeholder="Height">
                            </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6"> 
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">firearm Width <code>(inches")</code></code></label>
                              <input type="text" name="firearm_width" class="form-control" id="exampleInputName1" placeholder="Width">
                            </div>
                            </div>
                            <div class="col-md-6"> 
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Barrel Size <code>(inches")</code></code></label>
                              <input type="text" name="firearm_barrel" class="form-control" id="exampleInputName1" placeholder="Barrel">
                            </div>
                            </div>
                            </div>
                            <div class="row">
                            
                            <div class="col-md-6"> 
                            <div class="form-group">
                            <label class="col-sm-3 col-form-label"><code style="color:#fff">Trigger Type </code></label>
                            <div class="col-sm-9">
                              <select name="firearm_trigger_type" class="form-control">
                                <option style="color:#000" value="None">None</option>
                                <option style="color:#000" value="Standard">Standard</option>
                                <option style="color:#000" value="Single-Action">Single-Action (SA)</option>
                                <option style="color:#000" value="Double-Action">Double-Action (DA)</option>
                                <option style="color:#000" value="Double-Action-Only">Double-Action Only (DAO)</option>
                                <option style="color:#000" value="Double-Action-or-Single-Action">Double-Action/Single-Action (DA/SA) Trigger</option>        
                                <option style="color:#000" value="Striker-Fired">Striker-Fired Trigger</option>
                              </select>
                            </div>
                          </div>
                            </div>
                            <div class="col-md-6"> 
                            <div class="form-group">
                            <label class="col-sm-5 col-form-label"><code style="color:#fff">Trigger Actions </code></label>
                            <div class="col-sm-9">
                              <select name="firearm_trigger_action" class="form-control">
                                <option style="color:#000" value="None">None</option>
                                <option style="color:#000" value="Pump-Action">Pump-Action</option>
                                <option style="color:#000" value="Bolt-Action">Bolt-Action</option>
                                <option style="color:#000" value="Lever-Action">Lever-Action</option>
                                <option style="color:#000" value="Break-action">Break-action</option>        
                                <option style="color:#000" value="Semi-Automatic-or-Automatic">Semi-Automatic or Automatic</option>
                              </select>
                            </div>
                            </div>
                            </div>

                            <!-- <div class="form-group">
                              <label for="exampleInputName1">firearm Description</code></label>
                              <textarea class="form-control"  name="firearm_description" id="exampleTextarea1" rows="10" col="150"></textarea>
                            </div> -->
                            <div class="form-group">
                            <label class="col-sm-3 col-form-label"><code style="color:#fff">firearm Class</code></label>
                            <div class="col-sm-9">
                              <select name="firearm_class" class="form-control">
                                <option style="color:#000" value="Duty-Weapon">Duty Weapon</option>
                                <option style="color:#000" value="Spare-Weapon">Spare Weapon</option>
                                <option style="color:#000" value="Training-Weapon">Training Weapon</option>
                              </select>
                            </div>
                          </div>
                        
                          <div class="form-group">
                            <label class="col-sm-3 col-form-label"><code style="color:#fff">firearm State</code></label>
                            <div class="col-sm-9">
                              <select name="firearm_state" class="form-control">
                                <option value="None">None</option>
                                <option value="Not Faulty">Not Faulty Weapon</option>
                                <option value="Faulty">Faulty Weapon </option>
                                </select>
                            </div>
                          </div>
                            <div class="col-md-6">
                            <div class="form-group">
                              <label for="exampleInputEmail3"><code style="color:#fff">Quantity</code></label>
                              <input type="number" class="form-control" name="quantity" id="quantity" placeholder="Quantity">
                            </div>     
                            </div>                            
                        <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleFormControlFile1" style="color:#fff;"><code style="color:#fff">Upload firearm Image</code></label>
                          <input type="file" class="form-control" name="firearm_image" id="exampleFormControlFile1">
                            </div>
                            </div>
                            </div>
                        </div>
                            <button type="submit" name="add_new_weapon" class="btn btn-inverse-success me-2">Submit</button>
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