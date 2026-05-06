
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
    <title>GPS ARMOURY SYSTEM - FAULTY Ammunition</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- <link rel="stylesheet" href="dist/css/theme.css"> -->
    <link rel="stylesheet" href="dist/css/theme.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">
    <!-- endinject -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- Plugin css for this page -->
    <!-- End plugin css for this page -->
      <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
              <h3 class="page-title"> Faulty Ammunition </h3>
              <a href="faulty-weapon" type="button" class="btn btn-outline-info btn-fw">[ Faulty Firearm ]</a>
              <a href="faulty-ammo" type="button" class="btn btn-outline-danger btn-fw">[ Faulty Ammunition ]</a>
              <a href="faulty-assets" type="button" class="btn btn-outline-info btn-fw">[ Faulty Assets ]</a>

              <nav aria-label="breadcrumb">
               
              </nav>
            </div>
          <section class="content">
          <div class="container-fluid">
           <div class="row">
          <div class="col-12">          
            <div class="card">
              <!-- /.card-header -->
              <div class="card-body">
              <p class="card-description"><a href="add-faulty-ammo"><code><i class="mdi mdi-plus f-22 text-red"></i><i class="mdi mdi-bomb f-22 text-red" 
                    data-toggle="tooltip" data-placement="right" title="Click to Add Faulty Asset/Weapon"></i><i class="mdi mdi-alert-decagram f-22 text-red"></i></code></a>
                    </p>
                <table id="faulty-weapon" class="table table-bordered ">
                  <thead>
                  <tr>
                  <tr>
                    <th> #</th>
                    <th> Firearm</th>
                    <th> Serial No./Type </th>
                    <th> Name </th>
                    <th> Quantity </th>
                    <th>Fault Type  </th>
                    <th> Comment </th>
                    <th> Date/Time </th>
                    <th>Actions</th>
                  </tr>
                  </thead>
                  <tbody>
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
                          $query = mysqli_query($connect_db,"SELECT * FROM `faulty_ammo` ORDER BY `faulty_ammoID` DESC")
                          or die( mysqli_error($connect_db));
                          while ($row = mysqli_fetch_array($query)) {
                              $output = "";
                              $faulty_ammo_image = $row['faulty_ammo_image'];
                              $_SESSION['faulty_ammo_image'] = $faulty_ammo_image;
                              if(empty($faulty_ammo_image))
                              {
                              echo
                              $output .= '
                          <tr>
                          <td> '.$row['faulty_ammoID'].' </td>
                            <td class="py-1">
                              <img src="assets/images/faulty_ammo_images/icon-pic.jpg" alt="image" />
                            </td>
                            <td><a style="text-decoration:none;color:#fff;" href="faulty-ammo-details.php?faulty_ammo_serial_no='.$row['faulty_ammo_serial_no'].'&faulty_ammoID='.$row['faulty_ammoID'].'">'.$row['faulty_ammo_serial_no'].' / '.$row['faulty_ammo_type'].'</a></td>
                            <td><a style="text-decoration:none;color:#fff;" href="faulty-ammo-details.php?faulty_ammo_serial_no='.$row['faulty_ammo_serial_no'].'&faulty_ammoID='.$row['faulty_ammoID'].'">'.$row['faulty_ammo_name'].'</a></td>                
                            <td>'.$row['faulty_ammo_quantity'].' </td>
                            <td>'.$row['faulty_type'].' </td>
                            <td>'.$row['faulty_ammo_comment'].' </td>
                            <td>'.$row['datetime'].' </td>
                            <td> 
                            <a href="#edit-faulty-ammo-'.$row['faulty_ammoID'].'" data-toggle="modal"><i class="mdi mdi-playlist-edit f-16 mr-15 text-green"></i></a>
                           &nbsp; &nbsp;<a href="#delete-faulty-ammo-'.$row['faulty_ammoID'].'" data-toggle="modal"><i class="mdi mdi-delete f-16 mr-15 text-red"></i></a>
                            </td>
                          </tr>
                          ';
                        }else{
                          echo
                          $output .= '
                          <tr>
                            <td> '.$row['faulty_ammoID'].' </td>
                            <td class="py-1">
                              <img src="assets/images/faulty_ammo_images/'.$row['faulty_ammo_image'].'" alt="image" />
                            </td>
                            <td><a style="text-decoration:none;color:#fff;" href="faulty-ammo-details.php?faulty_ammo_serial_no='.$row['faulty_ammo_serial_no'].'&faulty_ammoID='.$row['faulty_ammoID'].'">'.$row['faulty_ammo_serial_no'].' / '.$row['faulty_ammo_type'].'</a></td>
                            <td><a style="text-decoration:none;color:#fff;" href="faulty-ammo-details.php?faulty_ammo_serial_no='.$row['faulty_ammo_serial_no'].'&faulty_ammoID='.$row['faulty_ammoID'].'">'.$row['faulty_ammo_name'].'</a></td>                
                            <td>'.$row['faulty_ammo_quantity'].' </td>
                            <td>'.$row['faulty_type'].'</td>
                            <td>'.$row['faulty_ammo_comment'].' </td>
                            <td>'.$row['datetime'].' </td>
                            <td> 
                            <a href="#edit-faulty-ammo-'.$row['faulty_ammoID'].'" data-toggle="modal"><i class="mdi mdi-playlist-edit f-16 mr-15 text-green"></i></a>
                             &nbsp; &nbsp;<a href="#delete-faulty-ammo-'.$row['faulty_ammoID'].'" data-toggle="modal"><i class="mdi mdi-delete f-16 mr-15 text-red"></i></a>
                            </td>
                            </tr>
                          
                          ';
                        }
                        include('actions.php');
                          }?>
                        </tbody>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div></div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
          <!-- content-wrapper ends -->

          <!-- partial:partials/_footer.html -->
          <?php  require_once('includes/footer.php');?>
          <!-- partial -->
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
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <!-- End custom js for this page -->
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

<!-- Page specific script -->
<script>
  $(function () {
    $("#faulty-weapon").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#faulty-weapon_wrapper .col-md-6:eq(0)');
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