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
    <title>GPS ARMOURY SYSTEM </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="assets/vendors/owl-carousel-2/owl.theme.default.min.css">
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
            <div class="row">
              <div class="col-12 grid-margin stretch-card">
                <div class="card gps-gradient-card">
                  <div class="card-body py-0 px-0 px-sm-3">
                    <div class="row align-items-center">
                      <div class="col-4 col-sm-3 col-xl-2">
                      <img src="assets/images/dashboard/weapon.png" class="gradient-gps-img img-fluid" alt="">
                      </div>
                      <div class="col-5 col-sm-7 col-xl-8 p-0">
                      <h4 class="mb-1 mb-sm-0">GHANA POLICE SERVICE ARMOURY SYSTEM</h4>
                      <p class="mb-0 font-weight-normal d-none d-sm-block">Service with Integrity</p>
                      </div>
                      <div class="col-3 col-sm-2 col-xl-2 pl-0 text-center">
                        <span>
                          <a href="https://police.gov.gh/en/" target="_blank" class="btn btn-outline-light btn-rounded get-started-btn">GPS WEBSITE</a>
                        </span>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5><code>Total Firearms</code></h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">
                          <?php                            
                             $sql="SELECT * FROM `firearms` WHERE 1";
   
                             if ($result=mysqli_query($connect_db,$sql))
                             {
                             // Return the number of rows in result set
                             $rowcount=mysqli_num_rows($result);
                             printf(" %d \n",$rowcount);
                             // Free result set
                             mysqli_free_result($result);
                             }
                             ?>
                          </h2>
                        </div>                   
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-pistol text-success ms-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5> <code>Total Ammunition</code></h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0"> 
                             <?php  
                             
                             $sql="SELECT SUM(ammo_rounds) FROM `ammunitions` ";
   
                              $result=mysqli_query($connect_db,$sql);
                       
                              while($row = mysqli_fetch_array($result)){
                                if( $row['SUM(ammo_rounds)'] > 0){
                                  echo  $row['SUM(ammo_rounds)'];
                            }else{
                              echo "0";
                            }
                              
                            } 
                         
                             ?>
                             ||<code style="color:orange">
                            Boxes </code>
                          </h2>
                        </div>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-ammunition text-success ms-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-sm-4 grid-margin">
                <div class="card">
                  <div class="card-body">
                    <h5> <code>Total Assets</code></h5>
                    <div class="row">
                      <div class="col-8 col-sm-12 col-xl-8 my-auto">
                        <div class="d-flex d-sm-block d-md-flex align-items-center">
                          <h2 class="mb-0">
                          <?php  
                             
                             $sql="SELECT * FROM `other_assets` WHERE 1";
   
                             if ($result=mysqli_query($connect_db,$sql))
                             {
                             // Return the number of rows in result set
                             $rowcount=mysqli_num_rows($result);
                             printf(" %d \n",$rowcount);
                             // Free result set
                             mysqli_free_result($result);
                             }
                             ?>
   
                          </h2>
                        </div>
                      </div>
                      <div class="col-4 col-sm-12 col-xl-4 text-center text-xl-right">
                        <i class="icon-lg mdi mdi-keg text-success ms-auto"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">
                          <?php  
                             
                             $sql="SELECT * FROM `bookings` WHERE 1";
   
                             if ($result=mysqli_query($connect_db,$sql))
                             {
                             // Return the number of rows in result set
                             $rowcount=mysqli_num_rows($result);
                             printf(" %d \n",$rowcount);
                             // Free result set
                             mysqli_free_result($result);
                             }
                                                          
                             ?>
                          </h3>&nbsp; || &nbsp;
                          <h3 class="mb-0 success">
                          <?php  
                              $sql="SELECT SUM(number_of_rounds) FROM `bookings` ";
   
                              $result=mysqli_query($connect_db,$sql);
                       
                              while($row = mysqli_fetch_array($result)){
                                if( $row['SUM(number_of_rounds)'] > 0){
                                  echo  $row['SUM(number_of_rounds)'].'<h6 class="mb-0 warning"><span class="mdi mdi-ammunition icon-item"></span></h6>';
                            }else{
                              echo "0";
                            }
                              
                            } 
                            ?>
                          </h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-warning">
                          <span class="mdi mdi-pistol icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal"><code>Booked Firearms</code></h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">
                          <?php  
                              $sql="SELECT SUM(ammo_rounds) FROM `ammo_bookings` ";
   
                              $result=mysqli_query($connect_db,$sql);
                       
                              while($row = mysqli_fetch_array($result)){
                                if( $row['SUM(ammo_rounds)'] > 0){
                                  echo  $row['SUM(ammo_rounds)'];
                            }else{
                              echo "0";
                            }
                              
                            } 
                            ?>
                           &nbsp;  || &nbsp; 
                            <h3 class="mb-0 success">
                            <?php
                             $sql="SELECT * FROM `ammo_bookings` WHERE 1";
   
                             if ($result=mysqli_query($connect_db,$sql))
                             {
                             // Return the number of rows in result set
                             $rowcount=mysqli_num_rows($result);
                             printf(" %d \n",$rowcount); echo '<h6 class="mb-0 warning"><span class="mdi mdi-account icon-item"></span></h6>';
                             // Free result set
                             mysqli_free_result($result);
                             }
                             ?>

                          </h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-warning">
                          <span class="mdi mdi-ammunition icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal"><code>Booked Ammunition</code></h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">
                          <?php  
                             
                             $sql="SELECT * FROM `asset_bookings` WHERE 1";
   
                             if ($result=mysqli_query($connect_db,$sql))
                             {
                             // Return the number of rows in result set
                             $rowcount=mysqli_num_rows($result);
                             printf(" %d \n",$rowcount);
                             // Free result set
                             mysqli_free_result($result);
                             }
                             ?>

                          </h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-warning ">
                          <span class="mdi mdi-keg icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal"><code>Booked Assets</code></h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0 danger">
                          <?php 
                             
                             $sql="SELECT `returns` FROM `bookings` WHERE `returns` = 'Not-Return'
                              UNION ALL SELECT `ammo_returns` FROM `ammo_bookings` WHERE `ammo_returns` = 'Not-Return'
                              UNION ALL SELECT `asset_returns` FROM `asset_bookings` WHERE `asset_returns` = 'Not-Return'
                             ";
   
                             if ($result=mysqli_query($connect_db,$sql))
                             {
                             // Return the number of rows in result set
                             $rowcount=mysqli_num_rows($result);
                             printf(" %d \n",$rowcount);
                             // Free result set
                             mysqli_free_result($result);
                             }
                             ?>
                               </h3>&nbsp; ||&nbsp; 
                            <h3 class="mb-0 success">
                             <?php  
                             
                             $sql="SELECT `returns` FROM `bookings` WHERE `returns` = 'Returned'
                              UNION ALL SELECT `ammo_returns` FROM `ammo_bookings` WHERE `ammo_returns` = 'Returned'
                              UNION ALL SELECT `asset_returns` FROM `asset_bookings` WHERE `asset_returns` = 'Returned'
                             ";
   
                             if ($result=mysqli_query($connect_db,$sql))
                             {
                             // Return the number of rows in result set
                             $rowcount=mysqli_num_rows($result);
                             printf(" %d \n",$rowcount);
                             // Free result set
                             mysqli_free_result($result);
                             }
                             ?>
                          </h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-warning">
                          <span class="mdi mdi-history icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal"><code>Returns</code></h6>
                  </div>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">
                          <?php  
                             
                             $sql="SELECT * FROM `faulty_weapons` WHERE 1";
   
                             if ($result=mysqli_query($connect_db,$sql))
                             {
                             // Return the number of rows in result set
                             $rowcount=mysqli_num_rows($result);
                             printf(" %d \n",$rowcount);
                             // Free result set
                             mysqli_free_result($result);
                             }
                             ?>
                          </h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-danger">
                          <span class="mdi mdi-pistol icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal"><code>Faulty Firearms</code></h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">
                          <?php  
                                 $sql="SELECT SUM(faulty_ammo_quantity) FROM `faulty_ammo` ";
   
                                 $result=mysqli_query($connect_db,$sql);
                          
                                 while($row = mysqli_fetch_array($result)){
                                   if( $row['SUM(faulty_ammo_quantity)'] > 0){
                                     echo  $row['SUM(faulty_ammo_quantity)'];
                               }else{
                                 echo "0";
                               }
                                 
                               } 
                             ?>

                          </h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-danger">
                          <span class="mdi mdi-ammunition icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal"><code>Faulty/Dummy Ammunition</code></h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">
                          <?php  
                             
                             $sql="SELECT * FROM `faulty_asset` WHERE 1";
   
                             if ($result=mysqli_query($connect_db,$sql))
                             {
                             // Return the number of rows in result set
                             $rowcount=mysqli_num_rows($result);
                             printf(" %d \n",$rowcount);
                             // Free result set
                             mysqli_free_result($result);
                             }
                             ?>

                          </h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-danger ">
                          <span class="mdi mdi-keg icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal"><code>Faulty Assets</code></h6>
                  </div>
                </div>
              </div>
              <div class="col-xl-3 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <div class="col-9">
                        <div class="d-flex align-items-center align-self-start">
                          <h3 class="mb-0">
                          <?php  
                             
                             $sql="SELECT * FROM `officers` WHERE 1";
   
                             if ($result=mysqli_query($connect_db,$sql))
                             {
                             // Return the number of rows in result set
                             $rowcount=mysqli_num_rows($result);
                             printf(" %d \n",$rowcount);
                             // Free result set
                             mysqli_free_result($result);
                             }
                             ?>
                          </h3>
                        </div>
                      </div>
                      <div class="col-3">
                        <div class="icon icon-box-success">
                          <span class="mdi mdi-account-switch icon-item"></span>
                        </div>
                      </div>
                    </div>
                    <h6 class="text-muted font-weight-normal"><code>Total Officers</code></h6>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:includes/_footer.html -->
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
    <script src="assets/vendors/chart.js/Chart.min.js"></script>
    <script src="assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="assets/js/off-canvas.js"></script>
    <script src="assets/js/hoverable-collapse.js"></script>
    <script src="assets/js/misc.js"></script>
    <script src="assets/js/clock.js"></script>
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <!-- End custom js for this page -->
    <script>
    setInterval(function() {
        check_user();
    }, 2000);

    function check_user() {
        jQuery.ajax({
            url: 'includes/user_auth.php',
            type: 'post',
            data: 'type=ajax',
            success: function(result) {
                if (result == 'logout') {
                    window.location.href ='logout';
                }
            }

        });
    }
</script>
<?php  require_once('includes/google-analytics.php');?>
  </body>
</html>