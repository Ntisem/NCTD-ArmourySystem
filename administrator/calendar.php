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
    <title>GPS ARMOURY SYSTEM - Calendar</title>
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
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;400;500;600;700;800&display=swap");

* {
  margin: 0;
  padding: 0;
  font-family: "Poppins", sans-serif;
}

.container {
  width: 770px;
  background-color: #fff;
}

.header {
  padding: 10px;
  display: flex;
  justify-content: space-between;
}

.header #month {
  color: #ff5252;
  font-size: 30px;
  font-weight: 600;
}

button {
  width: 75px;
  cursor: pointer;
  border: none;
  outline: none;
  padding: 5px;
  border-radius: 3px;
  color: white;
}

.header button {
  background-color: #ff5252;
}
.weekdays {
  width: 100%;
  display: flex;
  background-color: #2f3640;
  font-size: 17px;
  color: #fff;
  font-weight: 500;
}

.weekdays div {
  width: 100px;
  padding: 10px;
  text-align: center;
  text-transform: uppercase;
}

#calendar {
  width: 100%;
  margin: auto;
  display: flex;
  flex-wrap: wrap;
}

.day {
  width: 100px;
  height: 100px;
  padding: 10px;
  cursor: pointer;
  margin: 5px;
  box-sizing: border-box;
  box-shadow: 0px 0px 3px #cbd4c2;
  color: #7f8fa6;
  font-weight: 500;
  display: flex;
  flex-direction: column;
  justify-content: space-between;
}
.day:hover {
  background-color: rgba(112, 111, 211, 0.1);
  color: #706fd3;
}

#currentDay {
  background-color: #706fd3;
  color: #fff;
}

.event {
  font-size: 10px;
  padding: 3px;
  background-color: #3d3d3d;
  color: #fff;
  border-radius: 5px;
  max-height: 55px;
  overflow: hidden;
}

.event.holiday {
  background-color: palegreen;
  color: #3d3d3d;
}

.plain {
  cursor: default;
  box-shadow: none;
}

#modal {
  display: none;
  position: absolute;
  top: 0px;
  left: 0px;
  width: 100vw;
  height: 100vh;
  z-index: 10;
  background-color: rgba(0, 0, 0, 0.8);
}

#addEvent,
#viewEvent {
  display: none;
  width: 350px;
  background-color: #fff;
  padding: 25px;
  position: absolute;
  z-index: 20;
}

#addEvent h2,
#viewEvent h2 {
  font-weight: 500;
  margin-bottom: 10px;
}

#txtTitle {
  padding: 10px;
  width: 100%;
  box-sizing: border-box;
  margin-bottom: 25px;
  border-radius: 3px;
  outline: none;
  border: 1px solid #cbd4c2;
  font-size: 16px;
}

#btnSave {
  background-color: #2ed573;
}

.btnClose {
  background-color: #2f3542;
}

#viewEvent p {
  margin-bottom: 20px;
}

#btnDelete {
  background-color: #ea2027;
}

.error {
  border-color: #ea2027 !important;
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
              <div class="card" style="background-image: url(assets/images/bg/Guns2.jpg);">
            <div class="card-body">
       <!-- Calendar -->
          <div class="container">
            <div class="header">
              <div id="month"></div>
              <div>
                <button id="btnBack"><i class="mdi mdi-arrow-left-thick"></i></button>
                <button id="btnNext"><i class="mdi mdi-arrow-right-thick"></i></button>
              </div>
            </div>
            <div class="weekdays">
              <div>Sun</div>
              <div>Mon</div>
              <div>Tue</div>
              <div>Wed</div>
              <div>Thu</div>
              <div>Fri</div>
              <div>Sat</div>
            </div>
            <div id="calendar"></div>
          </div>
          <div id="modal"></div>
          <div id="addEvent" style="margin-top:50px; margin-left:400px">
            <h2>Add Event</h2>
            <input type="text" id="txtTitle" placeholder="Event Title" />
            <button id="btnSave">Save</button>
            <button class="btnClose">Close</button>
          </div>

          <div id="viewEvent">
            <h2>Event</h2>
            <p id="eventText"></p>
            <button id="btnDelete">Delete</button>
            <button class="btnClose">Close</button>
          </div>
          
          <!-- End Calendar -->
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
    <script src="script.js"></script>
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