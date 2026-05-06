
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
 <?php
  $asset_booking_ticket=$_GET['asset-booking-ticket'];

  $query = mysqli_query($connect_db,"SELECT * FROM `asset_bookings` WHERE  bookAssetID='$asset_booking_ticket'")
  or die( mysqli_error($connect_db));
  while($row = mysqli_fetch_array($query)){
  $armourer_issuer =  $row['armourer_issuer'];
  $_SESSION['armourer_issuer'] = $armourer_issuer;
  $to_officer =$row['to_officer'];
  $_SESSION['to_officer'] = $to_officer;
  $booking_time =$row['booking_time'];
  $_SESSION['booking_time'] = $booking_time;
  $asset_booking_ticket = $row['bookAssetID'];
  $_SESSION['bookAssetID'] = $asset_booking_ticket;
  $asset_name =$row['asset_name'];
  $_SESSION['asset_name'] = $asset_name;
  $asset_quantity =$row['asset_quantity'];
  $_SESSION['asset_quantity'] = $asset_quantity;
  $duty_type =$row['duty_type'];
  $_SESSION['duty_type'] = $duty_type;
  $duty_location =$row['duty_location'];
  $_SESSION['duty_location'] = $duty_location;   
  $asset_comment =$row['asset_comment'];
  $_SESSION['asset_comment'] = $asset_comment;   
  $asset_returns =$row['asset_returns'];
  $_SESSION['asset_returns'] = $asset_returns;
  $bookingCode =$row['bookingCode'];
  $_SESSION['bookingCode'] = $bookingCode;
  }?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GPS ARMOURY SYSTEM - <?php echo 'Asset Booking Ticket-['.$bookingCode.']'?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/select2/select2.min.css">
    <link rel="stylesheet" href="assets/vendors/select2-bootstrap-theme/select2-bootstrap.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
      <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
            <h3 class="page-title">Updating Asset Booking Ticket#<code class="success3">[<?php echo $bookingCode; ?>]</code> </h3>
              <nav aria-label="breadcrumb">
              
              </nav>
            </div>
          <!-- Forms starting  -->
          <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <form class="form-sample" method="POST" action="functions.php" enctype="multipart/form-data">
                      <h2 class="btn btn-inverse-primary btn-fw"> <?php echo $asset_returns; ?>  </h2>
                      <br>
                      <br>
                      <hr>
                      <div class="row">
                        <div class="col-md-6">
                        <div class="form-group row">
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
                              
                            }?>      
                              <input type="hidden" name="armourer_admin_name" class="form-control" id="exampleInputName1" value="<?php echo $service_no.' '.$admin_rank.' '.$fullname ?>">
                              <input type="hidden" name="adminID" class="form-control" id="exampleInputName1" value="<?php echo $adminID; ?>">
                              <input type="hidden" name="bookAssetID" class="form-control" id="exampleInputName1" value="<?php echo $asset_booking_ticket; ?>">
                              <input type="hidden" name="user_role" class="form-control" id="exampleInputName1" value="<?php echo $user_role; ?>">
                             
                              <label style="margin-bottom:10px;" for="exampleInputName1"><code style="color:#fff">Issuing Officer:</code></label>   
                              <label class="badge badge-dark" style="margin-bottom:10px;" for="exampleInputName1"><code style="color:#fff"> Armourer: </code>
                              <?php echo $service_no.' '.$admin_rank.' '.$fullname ?></label>   
                              <input type="hidden" name="armourer_issuer" class="form-control" id="exampleInputName1" 
                              value="<?php echo $service_no.' '.$admin_rank.' '.$fullname ?>">
                        </div>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="badge badge-dark col-sm-3 col-form-label"><code style="color:#fff">To Officer</code></label>
                            <div class="col-sm-9">
                            <select class="form-control" name="to_officer">
                            <?php
                                $query = mysqli_query($connect_db,"SELECT `officerID`, `officer_image`, `officer_service_no`, 
                                `rank`, `full_name`, `gender`, `officer_email`, `dept_unit`, `phone_no`, `officer_status`, 
                                `datetime` FROM `officers`  ORDER BY `officerID` ASC")
                                or die( mysqli_error($connect_db));
                                while ($row = mysqli_fetch_array($query)) {
                                  
                                    $output = "";
                                    $officer_image = $row['officer_image'];
                                    $_SESSION['officer_image'] = $officer_image;
                                    $rank = $row['rank'];
                                    $_SESSION['rank'] = $rank;
                                    $officer_service_no = $row['officer_service_no'];
                                    $_SESSION['officer_service_no'] = $officer_service_no;
                                    $full_name = $row['full_name'];
                                    $_SESSION['full_name'] = $full_name;
                                    $officer_email = $row['officer_email'];
                                    $_SESSION['officer_email'] = $officer_email;
                                    $officerID = $row['officerID'];
                                    $_SESSION['officerID'] = $officerID;

                                    echo $output .='
                                    <option value="'.$row['officer_service_no'].' '.$row['rank'].' '.$row['full_name'].'">
                                     '.$row['officer_service_no'].' '.$row['rank'].' '.$row['full_name'].' </option>
                                 
                                    ';
                                 }?>
                            </select>
                            <input  type="hidden"  name="asset_returns" class="form-control" value="<?php echo $asset_returns; ?>" />
                            <input  type="hidden"  name="officerID" class="form-control" value="<?php echo $officerID; ?>" />
                            <input  type="hidden"  name="officer_image" class="form-control" value="<?php echo $officer_image; ?>" />
                            <input  type="hidden"  name="officer_email" class="form-control" value="<?php echo $officer_email; ?>" />
                            <input  type="hidden"  name="gps_armoury_email" class="form-control" value="williamntisem123@gmail.com" />
                          </div>
                          </div>
                        </div>
                        </div>
                      <div class="row">                      
                        <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label"><code style="color:#fff">Issued Date/Time</code></label>
                            <div class="col-sm-9">
                              <label  class="badge badge-dark"><strong style="color:#0090e7;"><?php echo $booking_time ?></strong></label>
                              <input name="booking_time" type="hidden" class="form-control" value="<?php echo $booking_time ?>" />
                            </div>
                          </div>
                        </div>
                      </div>     
                      <div class="row">
                       <hr>
                      <br>
                      <p class="card-description">Asset Details</p>
                       <div class="row">
                        <div class="col-md-9">
                          <div class="form-group ">
                            <label class="col-sm-5 col-form-label"><code style="color:#fff">Select Asset</code></label>
                             <select name="asset_name" class="form-control">
                             <option value="<?php echo $asset_name ?>"><?php echo $asset_name ?></option>
                             <?php
                                $query = mysqli_query($connect_db,"SELECT * FROM `other_assets` ORDER BY `assetID` ASC")         
                                   or die( mysqli_error($connect_db));
                                   while ($row = mysqli_fetch_array($query)) {
                                    $output = "";
                                                  
                                    echo   
                                    $output .='
                                      <option value="'.$row['asset_serial_no'].' '.$row['asset_name'].'">'.$row['asset_serial_no'].' '.$row['asset_name'].'</option>';
                                   }
                              ?>
                             </select>
                          </div>
                        <div class="col-md-12">
                        <div class="form-group">
                        <label class="col-sm-5 col-form-label" for="exampleTextarea1"><code style="color:#fff">Quantity</code></label>
                        <input type="text" name="asset_quantity" class="form-control" value="<?php echo $asset_quantity ?>"/>
                         </div>
                       </div>
                      </div>
                       <hr>
                      <br>
                       <p class="card-description"> Duty Details</p>
                       <div class="row">
                        <div class="col-md-12">
                          <div class="form-group ">
                            <label class="col-sm-6 col-form-label"><code style="color:#fff">Duty Type</code></label>
                            <div class="col-sm-9">
                              <input type="text" name="duty_type" class="form-control" value="<?php echo $duty_type ?>" />
                            </div>
                          </div>
                        </div>
                        <div class="col-md-12">
                          <div class="form-group ">
                            <label class="col-sm-6 col-form-label"><code style="color:#fff">Duty Location</code></label>
                            <div class="col-sm-9">
                              <input type="text" name="duty_location" class="form-control" value="<?php echo $duty_location ?>" />
                            </div>
                          </div>
                        </div>
                        <div class="col-xl-10">
                          <div class="form-group ">
                            <label class="col-sm-6 col-form-label"><code style="color:#fff">Comment</code></label>
                            <div class="col-sm-9">
                            <textarea style="height:150px" name="asset_comment" id="comment" value="<?php echo $asset_comment ?>"
                             class="form-control" id="comment" rows="60"></textarea>
                            </div>
                          </div>
                        </div>
                      </div> 
                      </div>
                      </div>
                      <hr>
                      <button type="submit" name="update-asset-booking-ticket" class="btn btn-inverse-success btn-fw f-20 me-2">Submit</button>
                      <a href="booked-other-assets" class="btn btn-inverse-danger f-20 btn-fw">Cancel</a>
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
       <!-- Custom js for this page -->
       <script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<!-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- Page specific script -->
<script>
  $(function () {
    $("#administrators-list").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#administrators-list_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
  </body>
</html>