
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
    <title>GPS ARMOURY SYSTEM - UPDATE FIREARM</title>
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
        <?php
          $firearmID=$_GET['firearmID'];
          $firearm_serial_no=$_GET['firearm_Serial_no'];
      
          $query = mysqli_query($connect_db,"SELECT * FROM `firearms` WHERE  firearm_serial_no='$firearm_serial_no'
            AND firearmID=' $firearmID'")
          or die( mysqli_error($connect_db));
          while($row = mysqli_fetch_array($query)){
          $firearm_serial_no =$row['firearm_serial_no'];
          $_SESSION['firearm_serial_no'] = $firearm_serial_no;
          $firearm_name =$row['firearm_name'];
          $_SESSION['firearm_name'] = $firearm_name;
          $firearm_class =$row['firearm_class'];
          $_SESSION['firearm_class'] = $firearm_class;
          $firearm_type =$row['firearm_type'];
          $_SESSION['firearm_type'] = $firearm_type;
          $firearm_caliber =$row['firearm_caliber'];
          $_SESSION['firearm_caliber'] = $firearm_caliber;
          $firearm_width =$row['firearm_width'];
          $_SESSION['firearm_width'] = $firearm_width;
          $firearm_length =$row['firearm_length'];
          $_SESSION['firearm_length'] = $firearm_length;
          $firearm_height =$row['firearm_height'];
          $_SESSION['firearm_height'] = $firearm_height;
          $firearm_barrel =$row['firearm_barrel'];
          $_SESSION['firearm_barrel'] = $firearm_barrel;
          $firearm_weight =$row['firearm_weight'];
          $_SESSION['firearm_weight'] = $firearm_weight;
          $firearm_trigger_type =$row['firearm_trigger_type'];
          $_SESSION['firearm_trigger_type'] = $firearm_trigger_type;
          $firearm_trigger_action =$row['firearm_trigger_action'];
          $_SESSION['firearm_trigger_action'] = $firearm_trigger_action;
          $firearm_capacity =$row['firearm_capacity'];
          $_SESSION['firearm_capacity'] = $firearm_capacity;
          $quantity =$row['quantity'];
          $_SESSION['quantity'] = $quantity;
          $firearm_state =$row['firearm_state'];
          $_SESSION['firearm_state'] = $firearm_state;
          $firearm_image =$row['firearm_image'];
          $_SESSION['firearm_image'] = $firearm_image;
          }?>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
              <h3 class="page-title"> Updating Firearm-<code class="success3">[FA<?php echo $firearmID ?><?php echo $firearm_serial_no ?>]</code></h3>
              <nav aria-label="breadcrumb">
               
              </nav>
            </div>
            <!-- <div class="card" style="margin-bottom:30px;">
             <div class="card-body">
            <a href="add-new-weapon" type="button" class="btn btn-inverse-dark btn-fw" style="color:red">Firearm</a>
            <a href="add-new-ammo" type="button" class="btn btn-inverse-dark btn-fw" style="color:#fff">Ammunition</a>
            <a href="add-new-other-assets" type="button" class="btn btn-inverse-dark btn-fw" style="color:#fff">Other Assets</a>
          </div>
          </div> -->
          <!-- FETCHING DATA FROM THE DATABASE -->
          
          <!-- End of fetching of data -->
            <div class="row">
              <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <form method="POST" action="functions.php" class="forms-sample" enctype="multipart/form-data">
                    <?php  
                     $username=$_SESSION['username']; 
                     $query = mysqli_query($connect_db,"SELECT * FROM `admin_lists` WHERE `username`='$username'")
                     or die( mysqli_error($connect_db));
                     while ($row = mysqli_fetch_array($query)) {
                             $profile_image = $row['profile_image'];
                             $fullname = $row['fullname'];
                             $_SESSION['fullname'] =  $fullname;
                             $user_role = $row['user_role'];
                             $_SESSION['user_role'] =  $user_role; 
                             $service_no = $row['service_no'];
                             $_SESSION['service_no']=$service_no;
                             $admin_rank =$row['rank'];
                             $_SESSION['rank']=$admin_rank;
                             $adminID =$row['adminID'];
                             $_SESSION['adminID']=$adminID;                           
                             $armourer_admin_name  =  $service_no.' '.$admin_rank.' '.$fullname;
                             $_SESSION['armourer_admin_name'] = $armourer_admin_name;
                           }
                            ?>      
                              <input type="hidden" name="armourer_admin_name" class="form-control" id="exampleInputName1" value="<?php echo $service_no.' '.$admin_rank.' '.$fullname ?>">
                              <input type="hidden" name="adminID" class="form-control" id="exampleInputName1" value="<?php echo $adminID; ?>">
                              <input type="hidden" name="user_role" class="form-control" id="exampleInputName1" value="<?php echo $user_role; ?>">
                          <div class="row">
                            <div class="col-md-4">                     
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Firearm Serial No.</code></label>
                              <input type="text" name="firearm_serial_no" class="form-control" id="exampleInputName1"
                               value="<?php echo $firearm_serial_no ?>">
                               <input type="hidden" name="firearmID" class="form-control" id="exampleInputName1"
                               value="<?php echo $firearmID ?>">
                            </div>                        
                          </div>                           
                          <div class="form-group">
                            <label class="col-sm-3 col-form-label"><code style="color:#fff">Firearms Type</code></label>
                            <div class="col-sm-9">
                              <select name="firearm_type" class="form-control">
                                <option value="<?php echo $firearm_type ?>"><?php echo $firearm_type ?></option>
                                <option value="Pump-Action">Pump Action</option>
                                <option value="Revolver">Revolver</option>
                                <option value="Rifle">Rifle</option>
                                <option value="ShortGun">Short Gun</option>
                                <option value="Carbine">Carbine</option>
                              </select>
                            </div>
                          </div>
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Firearm Name</code></label>
                              <input type="text" name="firearm_name" class="form-control" id="exampleInputName1" 
                              value="<?php echo $firearm_name ?>">
                            </div>

                             <div class="row">
                             <div class="col-md-6"> 
                            <div class="form-group">
                            <label class="col-sm-3 col-form-label"><code style="color:#fff">Caliber</code></label>
                            <div class="col-sm-9">
                              <select name="firearm_caliber" class="form-control">
                                <option value="<?php echo $firearm_caliber ?>"></option>
                                <option value="9x19mm">9x19mm</option>
                                <option value="7.62x39mm">7.62x39mm</option>
                                <option value="45-ACP">45 ACP</option>
                                <option value="357-Magnum">357 Magnum</option>
                                <option value="44-Magnum">44 Magnum</option>
                                <option value="22-LR">22 LR</option>
                                <option value="45-Colt">45 Colt</option>
                                <option value="12-Gauge">12 Gauge</option>
                              </select>
                            </div>
                          </div>
                           </div>
                           <div class="col-md-6"> 
                             <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Firearm Capacity <code>(Rounds) </code></code></label>
                              <input type="number" name="firearm_capacity" class="form-control" 
                              id="exampleInputName1" value="<?php echo $firearm_capacity ?>">
                            </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-4"> 
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Firearm Weight <code>(inches")</code></code></label>
                              <input type="text" name="firearm_weight" class="form-control" id="exampleInputName1" 
                              value="<?php echo $firearm_weight ?>">
                            </div>
                            </div>
                            <div class="col-md-4"> 
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Firearm Length <code>(inches")</code></code></label>
                              <input type="text" name="firearm_length" class="form-control" id="exampleInputName1"
                               value="<?php echo $firearm_length ?>">
                            </div>
                            </div>
                            <div class="col-md-4"> 
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Firearm Height <code>(inches")</code></code></label>
                              <input type="text" name="firearm_height" class="form-control" id="exampleInputName1"
                               value="<?php echo $firearm_height ?>">
                            </div>
                            </div>
                            </div>
                            <div class="row">
                            <div class="col-md-6"> 
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Firearm Width <code>(inches")</code></code></label>
                              <input type="text" name="firearm_width" class="form-control" id="exampleInputName1"
                               value="<?php echo $firearm_width ?>">
                            </div>
                            </div>
                            <div class="col-md-6"> 
                            <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Barrel Size <code>(inches")</code></code></label>
                              <input type="text" name="firearm_barrel" class="form-control" id="exampleInputName1" 
                              value="<?php echo $firearm_barrel ?>">
                            </div>
                            </div>
                            </div>
                            <div class="row">                         
                            <div class="col-md-6"> 
                            <div class="form-group">
                            <label class="col-sm-3 col-form-label"><code style="color:#fff">Trigger Type </code></label>
                            <div class="col-sm-9">
                              <select name="firearm_trigger_type" class="form-control">
                                <option value="<?php echo $firearm_trigger_type ?>"><?php echo $firearm_trigger_type ?></option>
                                <option value="Standard">Standard</option>
                                <option value="Single-Action">Single-Action (SA)</option>
                                <option value="Double-Action">Double-Action (DA)</option>
                                <option value="Double-Action-Only">Double-Action Only (DAO)</option>
                                <option value="Double-Action-or-Single-Action">Double-Action/Single-Action (DA/SA) Trigger</option>        
                                <option value="Striker-Fired">Striker-Fired Trigger</option>
                              </select>
                            </div>
                          </div>
                            </div>
                            <div class="col-md-6"> 
                            <div class="form-group">
                            <label class="col-sm-3 col-form-label"><code style="color:#fff">Trigger Actions </code></label>
                            <div class="col-sm-9">
                              <select name="firearm_trigger_action" class="form-control">
                                <option value="<?php echo $firearm_trigger_action ?>"><?php echo $firearm_trigger_action ?></option>
                                <option value="Pump-Action">Pump-Action</option>
                                <option value="Bolt-Action">Bolt-Action</option>
                                <option value="Lever-Action">Lever-Action</option>
                                <option value="Break-action">Break-action</option>        
                                <option value="Semi-Automatic-or-Automatic">Semi-Automatic or Automatic</option>
                              </select>
                            </div>
                            </div>
                            </div>
                            </div>
                            <!-- <div class="form-group">
                              <label for="exampleInputName1"><code style="color:#fff">Firearm Description</code></label>
                              <textarea class="form-control"  name="firearm_description" id="exampleTextarea1" rows="10" col="150"></textarea>
                            </div> -->
                            <div class="form-group">
                            <label class="col-sm-3 col-form-label"><code style="color:#fff">Firearm Class</code></label>
                            <div class="col-sm-9">
                              <select name="firearm_class" class="form-control">
                                <option value="<?php echo $firearm_class ?>"></option>
                                <option value="Duty-Weapon">Duty Weapon</option>
                                <option value="Spare-Weapon">Spare Weapon</option>
                                <option value="Training-Weapon">Training Weapon</option>
                              </select>
                            </div>
                          </div>
                        
                          <div class="form-group">
                            <label class="col-sm-3 col-form-label"><code style="color:#fff">Firearm State</code></label>
                            <div class="col-sm-9">
                              <select name="firearm_state" class="form-control">
                                <option value="<?php echo $firearm_state ?>"><?php echo $firearm_state ?></option>
                                <option value="Not-Faulty">Not Faulty Asset or Weapon</option>
                                <option value="Faulty">Faulty Weapon or Asset</option>
                                </select>
                            </div>
                          </div>
                            <div class="col-md-6">
                            <div class="form-group">
                              <label for="exampleInputEmail3"><code style="color:#fff">Quantity</code></label>
                              <input type="number" class="form-control" name="quantity" id="quantity"
                              value="<?php echo $quantity ?>">
                            </div>     
                            </div>                            
                        <div class="col-md-6">
                        <div class="form-group">
                          <label for="exampleFormControlFile1" style="color:#fff;"><code style="color:#fff">Upload firearm Image</code></label>
                          <input type="file" class="form-control" name="firearm_image" 
                          id="exampleFormControlFile1" value="<?php echo $firearm_image ?>">
                            </div>
                            </div>
                        </div>
                            <button type="submit" name="update-firearm" class="btn btn-inverse-success me-2">Submit</button>
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