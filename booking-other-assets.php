
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
    <title>GPS ARMOURY SYSTEM - ASSETS BOOKING</title>
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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>    
    <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

    <link rel="stylesheet" href="assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="assets/images/favicon.png" />
  </head>
  <body onload=display_ct();>
    <div class="container-scroller">
    <!-- partial:includes/_sidebar.html -->
    <?php  require_once('includes/sidebar_book.php');?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:includes/_navbar.html -->
        <?php  require_once('includes/navbar_book.php');?>
        <!-- partial -->
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="page-header">
            <h3 class="page-title"> Assets Booking </h3>
            <nav aria-label="breadcrumb">     
              <a href="index"><button type="button" class="btn btn-outline-primary btn-fw"> <i class="mdi mdi-reply"></i>Back</button></a>          
              </nav>
            </div>
            <div class="card" style="margin-bottom:30px;">
             <div class="card-body">
             <a href="booking" type="button" class="btn btn-outline-info btn-fw">[ Firearm ]</a>
            <a href="booking-ammo" type="button" class="btn btn-outline-info btn-fw">[ Ammunition ]</a>
            <a href="booking-other-assets" type="button" class="btn btn-outline-danger btn-fw">[ Assets ]</a>
          </div>
          </div>
          <!-- Forms starting  -->
          <div class="col-12 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <form class="form-sample" method="POST" action="functions.php" enctype="multipart/form-data">
                      <p class="card-description">  </p>
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
                              <input type="hidden" name="user_role" class="form-control" id="exampleInputName1" value="<?php echo $user_role; ?>">
                              
                              <label style="margin-bottom:10px;" for="exampleInputName1"><code style="color:#fff">Issuing Officer:</code></label>   
                              <label class="badge badge-dark" style="margin-bottom:10px;" for="exampleInputName1"> Administrator: 
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
                            <input type="text" name="to_officer" id="to_officer" class="form-control" placeholder="Enter  Officer Name " />
                          </div>
                          </div>
                        </div>
                        </div>
                        <input  type="hidden"  name="asset_returns" class="form-control" value="Not-Return" />
                        <input  type="hidden"  name="officerID" class="form-control" value="<?php echo $officerID; ?>" />
                        <input  type="hidden"  name="officer_image" class="form-control" value="<?php echo $officer_image; ?>" />
                        <input  type="hidden"  name="officer_email" class="form-control" value="<?php echo $officer_email; ?>" />
                        <input  type="hidden"  name="gps_armoury_email" class="form-control" value="williamntisem123@gmail.com" />
                      <hr>
                      <br>
                      <!-- Weapon Details -->
                      <p class="card-description" style="color:#fff"> Asset Details</p>
                      <div class="row">
                      <div class="col-md-12">
                          <div class="form-group">
                            <label class="col-sm-6 col-form-label"><code style="color:#fff">Select Asset</code></label>
                            <div class="col-sm-9">
                            <input type="text" name="asset_name" id="asset_name" class="form-control" placeholder="Enter Asset name " />
                            <input type="hidden" name="assetID" id="assetID" class="form-control" placeholder="AmmoID" /> 
                            <input type="hidden" name="asset_image" id="asset_image" class="form-control" placeholder="Image" /> 
                          </div>
                          </div>
                        </div>
                      </div>                  
                      <div class="row">
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleTextarea1"><code style="color:#fff">Quantity</code></label>
                        <input type="number" name="asset_quantity" class="form-control" placeholder="Quantity"/>
                         </div>
                       </div>
                       <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleTextarea1"><code style="color:#fff">Asset State</code></label>
                           <select name="asset_state" class="form-control">
                                <option value="None">None</option>
                                <option value="Not-Faulty">Not Faulty</option>                              
                                <option value="Faulty">Faulty</option>  
                             </select>
                         </div>
                       </div>
                      </div>
                      <!-- </div> -->
                       <hr>
                      <br>
                       <div class="row">
                       <p class="card-description"> Duty Details</p>
                       <div class="row">
                        <div class="col-md-6">
                          <div class="form-group ">
                            <label class="col-sm-3 col-form-label"><code style="color:#fff">Duty Type</code></label>
                            <div class="col-sm-9">
                              <input type="text" name="duty_type" class="form-control" />
                            </div>
                          </div>
                        </div>
                        <p class="card-description"></p>  
                        <div class="col-md-6">
                        <div class="form-group">
                        <label for="exampleTextarea1"><code style="color:#fff">Duty Location</code></label>
                        <input type="text" name="duty_location" class="form-control" />
                         </div>
                       </div>
                        
                       <div class="col-md-6">
                          <div class="form-group row">
                            <label class="col-sm-6 col-form-label"><code style="color:#fff">Duty Duration <i style="color:red">(Hours)</i></code></label>
                            <div class="col-sm-9">
                              <input name="duty_duration" type="number" class="form-control" placeholder="Eg: 8, 12, 24..." />
                            </div>
                          </div>
                        </div>
                      </div> 
                      <div class="col-xl-10">
                        <div class="form-group">
                          <label for="exampleTextarea1"><code style="color:#fff">Comment</code></label>
                          <textarea style="height:150px" name="asset_comment" id="comment" class="form-control" id="exampleTextarea1" rows="40"></textarea>
                        </div>
                      </div>
                      </div>
                    
                      <hr>
                      <button type="submit" name="booking_asset" class="btn btn-inverse-success btn-fw f-20 me-2">Submit</button>
                      <a href="assets-weapon" class="btn btn-inverse-danger f-20 btn-fw">Cancel</a>
                    </form>
                  </div>
                </div>
              </div>
              </div>
          <!-- content-wrapper ends -->
            <!-- partial:partials/footer.php-->
      <!-- partial:partials/footer.php-->
      <?php  require_once('includes/footer_booking.php');?>
          
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- Plugin js for this page -->
    <!-- <script src="assets/vendors/js/vendor.bundle.base.js"></script>  -->
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
    <!-- <script src="plugins/jquery/jquery.min.js"></script> -->
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
<!-- Page specific script -->
        <!-- Script -->
        <script type='text/javascript' >
        $( function() {
         //  Officer's name autocomplete
            $( "#to_officer" ).autocomplete({
                source: function( request, response ) {
                    
                    $.ajax({
                        url: "fetchData_officer.php",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function( data ) {
                            response( data );
                        }
                    });
                },
                select: function (event, ui) {
                    $('#to_officer').val(ui.item.label); // display the Officer's name selected text
                    $('#officerID').val(ui.item.value); // save selected officerID to input
                    $('#officer_image').val(ui.item.value2); // save selected officer Image to input
                    return false;
                },
                focus: function(event, ui){
                    $("#to_officer" ).val( ui.item.label);
                    $("#officerID" ).val( ui.item.value);
                    $("#officer_image" ).val( ui.item.value2);

                    return false;
                },
            });

      //  Asset autocomplete
            $( "#asset_name" ).autocomplete({
                source: function( request, response ) {
                    
                    $.ajax({
                        url: "fetchData_asset.php",
                        type: 'post',
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function( data ) {
                            response( data );
                        }
                    });
                },
                select: function (event, ui) {
                    $('#asset_name').val(ui.item.label); // display the Ammunition name selected text
                    $('#assetID').val(ui.item.value); // save selected assetID to input
                    $('#asset_image').val(ui.item.value2); // save image to input
                    return false;
                },
                focus: function(event, ui){
                    $("#asset_name" ).val( ui.item.label);
                    $("#assetID" ).val( ui.item.value);
                    $('#asset_image').val(ui.item.value2); 
                    return false;
                },
            });
    });

 
    </script>
  
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