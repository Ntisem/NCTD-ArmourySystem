
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
    <title>GPS ARMOURY SYSTEM - ADMINISTRATORS</title>
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <!-- <link rel="stylesheet" href="dist/css/adminlte.min.css"> -->
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
              <h3 class="page-title"> Administrators List </h3>
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
                 <p class="card-description"><a href="add-new-admin"><code><i class="mdi mdi-account-plus f-22 text-green" 
                    data-toggle="tooltip" data-placement="right" title="Click to Add New Administrator"></i></code></a>
                    </p>
                <table id="administrators-list" class="table table-bordered ">
                  <thead>
                  <tr>
                    <th> # </th>
                    <th> User </th>
                    <th> Serv. No. </th>
                    <th> Rank </th>
                    <th> Name </th>
                    <th> Phone Number </th>
                    <th> Email </th>
                    <th>Unit/Dept</th>
                    <th>Date/Time</th>
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
                               
                                 $user_status= $row['user_role'];
                                 $_SESSION['user_status'] =  $user_status; 
                                 $service_no = $row['service_no'];
                                 $_SESSION['service_no']=$service_no;
                                 $admin_rank =$row['rank'];
                                 $_SESSION['rank']=$admin_rank;
                                 $adminID_armourerID =$row['adminID'];
                                 $_SESSION['adminID']=$adminID_armourerID;    
                                 $_SESSION['adminID_armourerID']=$adminID_armourerID; 
                                 $admin_armourer_user_role = $row['user_role'];
                                 $_SESSION['user_role'] =  $admin_armourer_user_role;   
                                 $_SESSION['admin_armourer_user_role'] =  $admin_armourer_user_role;                
                                 $armourer_admin_name  =  $service_no.' '.$admin_rank.' '.$fullname;
                                 $_SESSION['armourer_admin_name'] = $armourer_admin_name;

                               
                               }
                          $query = mysqli_query($connect_db,"SELECT * FROM `admin_lists` WHERE user_role = 'Administrator' ORDER BY `adminID` ASC")
                          or die( mysqli_error($connect_db));
                          while ($row = mysqli_fetch_array($query)) {
                              $output = "";
                            
                              $profile_image = $row['profile_image'];
                              $_SESSION['profile_image'] = $profile_image;
                              if(empty($profile_image))
                              {
                              echo
                              $output .= '
                          <tr>
                            <td> '.$row['adminID'].' </td>
                            <td class="py-1">
                              <img src="assets/images/profile_images/avatar_placeholder.png" alt="image" />
                            </td>
                            <td> '.$row['service_no'].' </td>
                            <td> '.$row['rank'].'</td>
                            <td> '.$row['fullname'].' </td>
                            <td> '.$row['phone_number'].' </td>
                            <td> '.$row['admin_email'].' </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'.$row['unit_dept'].'</div>
                              </div>
                            </td>
                            <td> '.$row['datetime'].' </td>
                            <td> 
                            <a href="#edit-admin-'.$row['adminID'].'" data-toggle="modal"><i class="mdi mdi-playlist-edit f-16 mr-15 text-green"></i></a>
                            &nbsp; &nbsp;<a href="#delete-admin-'.$row['adminID'].'" data-toggle="modal"><i class="mdi mdi-delete f-16 mr-15 text-red"></i></a>
                            </td>
                          </tr>
                          ';
                        }else{
                          echo
                          $output .= '
                          <tr>
                            <td> '.$row['adminID'].' </td>
                            <td class="py-1">
                              <img src="assets/images/profile_images/'.$row['profile_image'].'" alt="image" />
                            </td>
                            <td> '.$row['service_no'].' </td>
                            <td> '.$row['rank'].'</td>
                            <td> '.$row['fullname'].' </td>
                            <td> '.$row['phone_number'].' </td>
                            <td> '.$row['admin_email'].' </td>
                            <td>
                              <div class="progress">
                                <div class="progress-bar bg-success" role="progressbar" style="width: 100%"
                                 aria-valuenow="25" aria-valuemin="0" aria-valuemax="100">'.$row['unit_dept'].'</div>
                              </div>
                            </td>
                            <td> '.$row['datetime'].' </td>
                            <td> 
                            <a href="#edit-admin-'.$row['adminID'].'" data-toggle="modal"><i class="mdi mdi-playlist-edit f-16 mr-15 text-green"></i></a>
                            &nbsp; &nbsp;<a href="#delete-admin-'.$row['adminID'].'" data-toggle="modal"><i class="mdi mdi-delete f-16 mr-15 text-red"></i></a>
                            </td>
                            </tr>
                             
                          ';
                        }
                        include('actions_modals.php');
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
    <!-- End custom js for this page -->
  </body>
</html>