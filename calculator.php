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
    <product_type>GPS ARMOURY SYSTEM </product_type>
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

#calculator{
    font-family: Arial, sans-serif;
    background-color: hsl(0, 0%, 15%);
    border-radius: 15px;
    max-width: 500px;
    overflow: hidden;
}
#display{
    width: 100%;
    padding: 20px;
    font-size: 5rem;
    text-align: left;
    border: none;
    background-color: hsl(0, 0%, 20%);
    color: white;
}
#keys{
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 10px;
    padding: 25px;
}
.button{
    width: 70px;
    height: 70px;
    border-radius: 50px;
    border: none;
    background-color: hsl(0, 0%, 30%);
    color: white;
    font-size: 2rem;
    font-weight: bold;
    cursor: pointer;
}
button:hover{
    background-color: hsl(0, 0%, 40%);
}
button:active{
    background-color: hsl(0, 0%, 50%);
}
.operator-btn{
    background-color: hsl(35, 100%, 55%);
}
.operator-btn:hover{
    background-color: hsl(35, 100%, 65%);
}
.operator-btn:active{
    background-color: hsl(35, 100%, 75%);
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
              <div class="col-xl-12 col-sm-12 grid-margin stretch-card">
                <div class="card" style="background-image: url(assets/images/bg/Guns2.jpg);">
                  <div class="card-body">
                <div id="calculator">
                <input id="display" readonly>
                 <div id="keys">
                     <button  onclick="appendToDisplay('+')" class="operator-btn">+</button>
                    <button  onclick="appendToDisplay('7')">7</button>
                    <button  onclick="appendToDisplay('8')">8</button>
                    <button  onclick="appendToDisplay('9')">9</button>
                    <button  onclick="appendToDisplay('-')" class="operator-btn">-</button>
                    <button  onclick="appendToDisplay('4')">4</button>
                    <button  onclick="appendToDisplay('5')">5</button>
                    <button  onclick="appendToDisplay('6')">6</button>
                    <button  onclick="appendToDisplay('*')" class="operator-btn">*</button>
                    <button  onclick="appendToDisplay('1')">1</button>
                    <button  onclick="appendToDisplay('2')">2</button>
                    <button  onclick="appendToDisplay('3')">3</button>
                    <button  onclick="appendToDisplay('/')" class="operator-btn">/</button>
                    <button  onclick="appendToDisplay('0')">0</button>
                    <button  onclick="appendToDisplay('.')">.</button>
                    <button  onclick="calculate()">=</button>
                    <button  onclick="clearDisplay()" class="operator-btn">C</button>
                </div>
            </div>
                  </div>
                </div>
               <br>
            </div>
            
          </div>
          <!-- content-wrapper ends -->
          <!-- partial:includes/_footer.html -->
        
          <!-- partial -->
        </div>
        <?php  require_once('includes/footer.php');?>
        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    
    <!-- container-scroller -->
    <!-- plugins:js -->
    <script src="cal.js"></script>
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