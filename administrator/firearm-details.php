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
    <title>GPS ARMOURY SYSTEM - ASSET/WEAPON DETAILS</title>
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
    <style>
* {
	margin: 0;
	padding: 0;
	font-family: 'Poppins', sans-serif;
}

.calendar-container {
	background: #fff;
	width: 450px;
	border-radius: 10px;
	box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12);
}

.calendar-container header {
	display: flex;
	align-items: center;
	padding: 25px 30px 10px;
	justify-content: space-between;
}

header .calendar-navigation {
	display: flex;
}

header .calendar-navigation span {
	height: 38px;
	width: 38px;
	margin: 0 1px;
	cursor: pointer;
	text-align: center;
	line-height: 38px;
	border-radius: 50%;
	user-select: none;
	color: #aeabab;
	font-size: 1.9rem;
}

.calendar-navigation span:last-child {
	margin-right: -10px;
}

header .calendar-navigation span:hover {
	background: #f2f2f2;
}

header .calendar-current-date {
	font-weight: 500;
	font-size: 1.45rem;
}

.calendar-body {
	padding: 20px;
}

.calendar-body ul {
	list-style: none;
	flex-wrap: wrap;
	display: flex;
	text-align: center;
}

.calendar-body .calendar-dates {
	margin-bottom: 20px;
}

.calendar-body li {
	width: calc(100% / 7);
	font-size: 1.07rem;
	color: #414141;
}

.calendar-body .calendar-weekdays li {
	cursor: default;
	font-weight: 500;
}

.calendar-body .calendar-dates li {
	margin-top: 30px;
	position: relative;
	z-index: 1;
	cursor: pointer;
}

.calendar-dates li.inactive {
	color: #aaa;
}

.calendar-dates li.active {
	color: #fff;
}

.calendar-dates li::before {
	position: absolute;
	content: "";
	z-index: -1;
	top: 50%;
	left: 50%;
	width: 40px;
	height: 40px;
	border-radius: 50%;
	transform: translate(-50%, -50%);
}

.calendar-dates li.active::before {
	background: #6332c5;
}

.calendar-dates li:not(.active):hover::before {
	background: #e4e1e1;
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
            <div class="row">
              <div class="col-xl-12 col-sm-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="row">
                      <?php
                        if(isset($_GET['firearmID']) && $_GET['firearmID']>0 && isset($_GET['firearm_serial_no'])
                        && $_GET['firearm_serial_no']!=''){
    
                            $firearmID=mysqli_real_escape_string($connect_db,$_GET['firearmID']);
                            $firearm_serial_no=mysqli_real_escape_string($connect_db,$_GET['firearm_serial_no']);

                            $sql="SELECT * FROM `firearms`  WHERE `firearmID` ='$firearmID' AND
                            `firearm_serial_no`='$firearm_serial_no'";
                            $firearm_result=mysqli_query($connect_db,$sql);
                            if(mysqli_num_rows( $firearm_result)>0){
                            $row=mysqli_fetch_assoc( $firearm_result);
                            $output = "";
                            echo $output .='
                            <div class="row">
                            <div class="col-lg-12 grid-margin stretch-card">
                              <div class="card">
                                <div class="card-body">
                                 <a href="firearm-bookings-under?firearmID='.$row['firearmID'].'" type="button" class="btn btn-primary btn-lg btn-block" style="margin-bottom:30px;">
                                 <i class="mdi mdi-book"></i> Bookings</a>
                                  <p class="card-description"><strong>Firearm:</strong><code>'.$row['firearm_serial_no'].'</code>
                                  </p>
                                  <div class="table-responsive">
                                    <table class="table">
                                      <tbody>
                                        <tr>
                                          <td>firearm Image</td>
                                          <td><img src="assets/images/firearm_images/'.$row['firearm_image'].'" alt="" style="height: 250px;width:250px"></td>
                                        </tr>
                                        <tr>
                                        <td> Serial No.</td>
                                        <td>'.$row['firearm_serial_no'].'</td>
                                      </tr>
                               
                                      <tr>
                                      <td> Name</td>
                                      <td>'.$row['firearm_name'].'</td>
                                      </tr>
                                      <tr>
                                      <td> Type</td>
                                      <td>'.$row['firearm_type'].'</td>
                                      </tr>
                                      <tr>
                                      <td> Caliber</td>
                                      <td>'.$row['firearm_caliber'].'</td>
                                      </tr>         
                                      <tr>
                                      <td> Capacity</td>
                                      <td>'.$row['firearm_capacity'].'</td>
                                      </tr>
                                     
                                      <tr>
                                      <td> Weight</td>
                                      <td>'.$row['firearm_weight'].'</td>
                                      </tr>
                                      <tr>
                                      <td> Length</td>
                                      <td>'.$row['firearm_length'].'</td>
                                      </tr>
                                      <tr>
                                      <td> Width</td>
                                      <td>'.$row['firearm_width'].'</td>
                                      </tr>
                                      <tr>
                                      <td> Barrel</td>
                                      <td>'.$row['firearm_barrel'].'</td>
                                      </tr>
                                      <tr>
                                      <td>Trigger Type</td>
                                      <td>'.$row['firearm_trigger_type'].'</td>
                                      </tr>
                                      <tr>
                                      <td>Trigger Action</td>
                                      <td>'.$row['firearm_trigger_action'].'</td>
                                      </tr>
                                      <tr>
                                      <td>Quantity</td>
                                      <td>'.$row['quantity'].'</td>
                                      </tr>
                                      <tr>
                                      <td>Brought In Date</td>
                                      <td>'.$row['datetime'].'</td>
                                      </tr>
                                      <tr>
                                      <td></td>
                                      <td><a href="assets-weapon"><button type="button" class="btn btn-outline-danger btn-fw"> <i class="mdi mdi-reply"></i>BACK</button></a></td>
                                      </tr>
                                      </tbody>
                                    </table>
                                  </div>
                                </div>
                              </div>
                            </div>
                            </div>
                            ';}
                            else{

                            }
                       
                    }
                    ?>
                    </div>
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
    <script src="assets/js/settings.js"></script>
    <script src="assets/js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page -->
    <script src="assets/js/dashboard.js"></script>
    <script src="assets/js/calendar.js"></script>
    <!-- <script src="assets/js/calendar2.js"></script> -->
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