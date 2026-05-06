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
    <title>GPS ARMOURY SYSTEM - TASK BOARD</title>
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
    <link rel="stylesheet" href="todo.css" />
    <style>
      
  #todo-form input {
    padding: 12px;
    margin-right: 12px;
    width: 225px;
  
    border-radius: 4px;
    border: none;
  
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.25);
    /* background: rgb(0, 32, 216); */
  
    font-size: 14px;
    outline: none;
  }
  
  #todo-form button {
    padding: 12px 32px;
  
    border-radius: 4px;
    border: none;
  
    box-shadow: 0px 5px 15px rgba(0, 0, 0, 0.25);
    background: rgb(194, 0, 0);
    color: rgb(255, 255, 255);
  
    font-weight: bold;
    font-size: 14px;
    cursor: pointer;
  }
  
 .todo li {
    list-style: none;
    font-size:17px;
    padding: 12px 8px 12px 50px;
    user-select: none;
    cursor:pointer;
    position: relative;
}
.todo li::before{
    content: '';
    position: absolute;
    height: 28px;
    width: 28px;
    border-radius:50px;
    background-image: url(assets/images/todo-images/unchecked.png);
    background-size: cover;
     background-position:center;
     top:12px;
     left:8px;
}

.todo li.checked{
    color:green;
    text-decoration: line-through green 4px;
    width: 100%;

}
.todo li.checked::before{
  background-image: url(assets/images/todo-images/checked.png);
}
.todo li span{
    position: absolute;
    right: 0;
    top: 5px;
    width: 40px;
    height: 40px;
    font-size: 22px;
    line-height: 40px;
    background-color: red;
    color:#fff;
    color:#555;
    text-align: center;
    border-radius: 50px;
}
.todo li span:hover{
    background: #edeef0;;
    color: #555;
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
              <div class="col-xl-12 col-sm-12 col-md-12 grid-margin stretch-card">
                <div class="card" style="background-image: url(assets/images/bg/Guns2.jpg);">
                  <div class="card-body">
                    <div class="row">
                    <div class="board">
                    <div id="todo-form">
                      <input type="text" placeholder="New TODO..." id="input-box" />
                      <button onclick="addTask()">Add +</button>
                      <!-- <button  onclick="del()">Delete -</button> -->

                      <div class="row" style="margin-top:50px">
                       <div class="col-xl-12 col-sm-6 grid-margin stretch-card">
                        <div class="card">
                          <div class="card-body">
                            <div class="row">
                            <h3 class="heading" style="color:orange;margin-bottom:60px;z-index:999999">To-do List</h3>
                              <ul class="todo" id="list-container">                     
                              <!-- <li class="task" draggable="true">Task 1</li> 
                              <li draggable="true">Task 2</li>  
                              <li draggable="true">Task 3</li>  -->
                              </ul>
                               </div>
                              </div>
                            </div>
                          </div>
                        </div>
                       </div>
              
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>
            </div>
            <!-- </div> -->
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
    <!-- <script src="drag.js" defer></script>-->
    <script src="todo.js" defer></script> 
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