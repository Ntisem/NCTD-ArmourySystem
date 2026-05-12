<?php  require_once('connections/connect-db.php');
require_once ("functions.php");
require_once('includes/user_auth.php');
 ?>
   
   <?php
  if(!isset($_SESSION["username"]) && ($_SESSION['user_role'] == "Administrator")) {
  header("location: login");
  exit();

  // <!-- <script>
  //   window.location="login.php";
  // </script>
   
  }

  ?>

<style>
  select{
    border-color: #06003d;
  }
  div.dataTables_wrapper div.dataTables_info {
    padding-top: .85em;
    color: #333;
}
div.dataTables_wrapper div.dataTables_filter label {
    font-weight: normal;
    white-space: nowrap;
    text-align: left;
    color: #696969;
}
    .table-hover:hover{

     color:#f1f1f1;
    }
    .card-title {
  float: left;
  font-size: 1.1rem;
  font-weight: 400;
  margin: 0;
  color:orange;
}
thead{
  background-color: #06003d;
}
tr th{
  color:#f1f1f1;
}
.text-sm .card-title {
  font-size: 1rem;
}
.card-title {
  margin-bottom: 0.75rem;
}
.form-group .icon-img{
        margin-top:10px;
        width:20px;
        height: 20px;
        cursor:pointer;
        }
        .form-group {
        width: 100%;
        display: flex;
        border-width:0px 0px 2px 0px;
        align-items: center;
        background:transparent;
     
        }
        .message{
          position: absolute;
          bottom: -30px;
          color: #fff;
          font-size: 15px;
          display: none;
      }
     
        .form-group input{
          width: 100%;
            font-size:16px;
            /* margin-bottom: -10px; */
            /* border:none;
            outline:none; */
           
            /* color:#adc4b2; */
            /* background:transparent; */
        }
</style>
<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>PROFILE SETTINGS - ARMOURY SYSTEM</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- <link rel="stylesheet" href="dist/css/theme.css"> -->
    <link rel="stylesheet" href="dist/css/theme.min.css">
    <!-- <link rel="stylesheet" href="daily/theme.css">
    <link rel="stylesheet" href="daily/theme.min.css"> -->
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
       <!-- ADD NEW ROWS JQUERY -->
    <link href="https://fonts.googleapis.com/css?family=Ubuntu:300,500,700" rel="stylesheet">
    <link rel="stylesheet" href="./src/css/jquery-ui.min.css">
    <link rel="stylesheet" href="./src/css/style.css">
    <script src="./src/js/lib/jquery-3.3.1.min.js"></script>
    <script src="./src/js/lib/jquery-ui.min.js"></script>
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="wrap/style.css">
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
              <h3 class="page-title" >PROFILE</h3>
            </div>
            

            <div class="row">  
            <div class="col-lg-6 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
              <div class="table-responsive">
                <table class="table">
                  <tbody>
                  <?php
                   
                    $username = $_SESSION["username"];
                    $query = mysqli_query($connect_db,"SELECT * FROM `admin_lists` WHERE `username` = '$username'")
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
                      <td>Administrator:&nbsp;&nbsp;&nbsp;&nbsp;<strong style="color:orange">'.$row['service_no'].' '.$row['rank'].' '.$row['fullname'].'</strong></td>
                    </tr>
                    <tr>
                      <td><img src="./administrator/assets/images/profile_images/avatar_placeholder.png" alt="" style="height: 250px;width:250px"></td>
                    </tr>
                    <tr>
                    <td> User Role</td>
                    <td><strong>'.$row['user_role'].'</strong></td>
                    </tr>
                    <tr>
                    <td> Username</td>
                    <td><strong>'.$row['username'].'</strong></td>
                    </tr>
                     <tr>
                    <td> Service No.</td>
                    <td><strong>'.$row['service_no'].'</strong></td>
                    </tr>
                    <tr>
                  <td> Rank</td>
                  <td><strong>'.$row['rank'].'</strong></td>
                  </tr>
                  <tr>
                  <td> Name</td>
                  <td><strong>'.$row['fullname'].'</strong></td>
                  </tr>
                  <tr>
                  <td> Phone Number</td>
                  <td><strong>'.$row['phone_number'].'</strong></td>
                  </tr>
                  <tr>
                  <td> Email</td>
                  <td><strong>'.$row['admin_email'].'</strong></td>
                  </tr>
                   <tr>
                  <td> Unit/Department</td>
                  <td><strong>'.$row['unit_dept'].'</strong></td>
                  </tr>
                  <tr>
                  <td>Input Date</td>
                  <td><strong>'.$row['datetime'].'</strong></td>
                  </tr>
                  ';
                   
                    }else{
                      echo
                      $output .= '
                     <tr>
                      <td>Administrator:&nbsp;&nbsp;&nbsp;&nbsp;<strong style="color:orange">'.$row['service_no'].' '.$row['rank'].' '.$row['fullname'].'</strong> </td>
                    </tr>
                    <tr>
                      <td><img src="./administrator/assets/images/profile_images/'.$row['profile_image'].'" alt="" style="height: 250px;width:250px"></td>
                    </tr>
                  <tr>
                  <td> User Role</td>
                  <td><strong>'.$row['user_role'].'</strong></td>
                  </tr>
                  <tr>
                  <td> Username</td>
                  <td><strong>'.$row['username'].'</strong></td>
                </tr>
                <tr>
                    <td> Service No.</td>
                    <td><strong>'.$row['service_no'].'</strong></td>
                    </tr>
                  <tr>
                   <tr>
                <td> Rank</td>
                <td><strong>'.$row['rank'].'</strong></td>
                </tr>
                <tr>
                <td> Name</td>
                <td><strong>'.$row['fullname'].'</strong></td>
                </tr>
                <tr>
                <td> Phone Number</td>
                <td><strong>'.$row['phone_number'].'</strong></td>
                </tr>
                <tr>
                <td> Email</td>
                <td><strong>'.$row['admin_email'].'</strong></td>
                </tr>
                 <tr>
                <td> Unit/Department</td>
                <td><strong>'.$row['unit_dept'].'</strong></td>
                </tr>
                <tr>
                <td>Input Date</td>
                <td><strong>'.$row['datetime'].'</strong></td>
                </tr>
               ';
                    }
                    
                  }?>
                  </tbody>
                </table>
              </div>
            </div>
            </div>
            </div>
              <div class="col-lg-6 grid-margin stretch-card">
                <div class="card" style="background: #e9eaf7; height:fit-content" >
                  <div class="card-body">
                  <div align="right">
                    <button class="btn btn-outline-info" type="button" name="btnUpdate"  id="btnUpdate" style="font-weight:600;"><i class="mdi mdi-pencil-box-outline"></i>UPDATE</button>
                       </div>
                       <form method="POST" action="functions.php" class="forms-sample" enctype="multipart/form-data">
                       <div class="profile-settings">

                       </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
            </div>
            <!-- /.container-fluid -->
             
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
          <?php  require_once('includes/footer.php');?>
          <!-- partial -->
        </div>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
   <!-- plugins:js -->
   <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
   <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <script src="assets/js/clock.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
<!-- Bootstrap 4 -->
<!-- <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script> -->
    <!-- DataTables  & Plugins -->
<script src="node_modules/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
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
<script src="wrap/theme.min.js"></script>
<script src="wrap/theme.js"></script>
<?php                
   $username = $_SESSION["username"];
   $query = mysqli_query($connect_db,"SELECT * FROM `admin_lists` WHERE `username` = '$username'")
   or die( mysqli_error($connect_db));
   while ($row = mysqli_fetch_array($query)) {
       $adminID =$row['adminID']; 
       $_SESSION['adminID'] = $adminID; 
       $admin_email =$row['admin_email']; 
       $_SESSION['admin_email'] = $admin_email; 
       $phone_number =$row['phone_number']; 
       $_SESSION['phone_number'] = $phone_number; 
       $gender =$row['gender']; 
       $_SESSION['gender'] = $gender; 
       $profile_image =$row['profile_image']; 
       $_SESSION['profile_image'] = $profile_image;  
   }
?>

<script>
  $(document).on("click","#btnUpdate", function(e){
        e.preventDefault();
        $(".profile-settings").append(`<div class="row addNewRow " style="margin-top:35px">
      <div class="col-md-8">  
      <div class="form-group" style="margin-bottom: -3px;">
      <label for="username"><code style="color:#666">Username</code></label>
      </div>
     
      <div class="form-group">
        <input type="text" name="username" class="form-control" id="username" style="color:#000" value="<?php echo $_SESSION["username"]; ?>" readonly>
           <input type="hidden" class="form-control" name="adminID" id="adminID" value="<?php echo $_SESSION["adminID"]; ?>">
          </div>                        
      </div>
   <div class="col-md-12">
    <div class="form-group" style="margin-bottom: -3px;">
    <label for="rank"><code style="color:#666">Rank</code></label>
    </div>
      <div class="form-group">
      <select name="rank" class="form-control" id="rank">
      <option value="<?php echo $_SESSION["rank"]; ?>"><?php echo $_SESSION["rank"]; ?></option>
      <option value="CONST"> CONST</option>
      <option value="L/CPL"> L/CPL</option>
      <option value="CPL">CPL</option>
      <option value="SGT">SGT</option>
      <option value="INSPR">INSPR</option>
      <option value="C/INSPR">C/INSPR</option>
      <option value="ASP">ASP</option>
      <option value="DSP">DSP</option>
      <option value="SUPT">SUPT</option>
      <option value="C/SUPT">C/SUPT</option>
      <option value="ACP">ACP</option>
      <option value="DCOP">DCOP</DCOP>
      <option value="COP">COP</option>

  </select>
</div>
  </div>
    <div class="col-md-12">
    <div class="form-group" style="margin-bottom: -3px;">
    <label for="gender"><code style="color:#666">Gender</code></label>
    </div>
      <div class="form-group">
      <select name="gender" class="form-control" id="gender">
      <option value="<?php echo $_SESSION["gender"]; ?>"><?php echo $_SESSION["gender"]; ?></option>
      <option value="Male">Male</option>
    <option value="Female">Female</option>
  </select>
</div>
  </div>
    </div>
      <div class="row"> 
      <div class="col-12">
      <div class="form-group" style="margin-bottom: -3px;">
      <label for="phone_number"><code style="color:#666">Phone Number</code></label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="phone_number" id="phone_number" pattern="^(\d{3}[-]?){1,2}(\d{4})$"  value="<?php echo $_SESSION["phone_number"]; ?>">
      </div>    
      </div>
      <div class="col-12">  
      <div class="form-group" style="margin-bottom: -3px;">
      <label for="email"><code style="color:#666">Email</code></label>
      </div>
      <div class="form-group">
        <input type="text" class="form-control" name="admin_email" id="admin_email"  value="<?php echo $_SESSION["admin_email"]; ?>">
      </div> 
      </div>        
      </div> 
      <div class="row">                           
      <div class="col-12">
      <div class="form-group" style="margin-bottom: -3px;">
      <label for="profile_image" style="color:#fff;"><code style="color:#666">Upload Profile Image</code></label>
      </div>
      <div class="form-group">
      <input type="file" class="form-control" name="profile_image" id="profile_image" value="<?php echo $_SESSION["profile_image"]; ?>">
      </div>
      </div>                 
      </div>
      <button type="submit" name="btn-edit-settings" class="btn btn-success me-2">Submit</button>`
      );
        });
</script>
<script>
  $(document).on("click","#remove",function(e){
      e.preventDefault();
      $(this).parent().parent().remove();
  });
 </script>
    <!-- End custom js for this page -->
  </body>
</html>