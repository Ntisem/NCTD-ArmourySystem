
<?php
require_once('connections/connect-db.php');
require_once('includes/redirect.php');

 function Query($query)
 {
   global $connect_db;
   return mysqli_query($connect_db, $query);
   
 }
     // Confirmation function
function confirm($result)
{
  global $connect_db;
  
  if(!$result){
    die('Query Field'.mysqli_error($connect_db));
  }
}
// session_start();
if (isset($_POST['username'])){
    
$username = stripslashes($_REQUEST['username']);
$username = mysqli_real_escape_string($connect_db,$username);
$password = stripslashes($_REQUEST['password']);
$password = mysqli_real_escape_string($connect_db,$password);
$admin_username = $username;



$query = "SELECT * FROM `admin_lists` WHERE username='$username'
and `password`='".md5($password)."'";
$result = mysqli_query($connect_db,$query) or die(mysqli_error($connect_db));
$rows = mysqli_num_rows($result);
// $user_role = $row['user_role'];
// $_SESSION['user_role'] = $user_role;
 // echo $username;
if($rows>0){
            $redirect_link_var = $_SESSION['page_url'];
            $row = mysqli_fetch_array($result);
            $redirect_link=$_REQUEST['page_url'];
            $_SESSION['page_url'] = $redirect_link;
            $user_role = $row['user_role'];
            $_SESSION['user_role'] = $user_role;
        

        if($row['user_role'] =="Administrator")
          {
            $redirect_link_var = $_SESSION['page_url'];
            $_SESSION['username'] = $username;
            $_SESSION['IS_LOGIN']='yes';	
            $message = "You are welcome back !!...";
            $_SESSION['status'] = $message;
            $email= $_SESSION['email'];
            $adminID=$_SESSION['adminID'];
            $redirect_link=$_REQUEST['page_url'];
            $_SESSION['page_url'] = $redirect_link;
            $last_login_time = gmdate("l jS \of F Y h:i:s A");
            $sql_login="INSERT INTO `login_activity`(`admin_username`, `user_role`, `last_login_time`) 
            VALUES ('$admin_username','$user_role','$last_login_time')";

            $result_login = Query($sql_login);
            confirm($result_login);

            if($redirect_link==""){
                header("location: index?login_success");
                die();
               
            }else{
                header("location: ".$redirect_link."");
                die();
            }

        }
        else if($row['user_role'] == 'Armourer')
        {

            $redirect_link=$_REQUEST['page_url'];
            $_SESSION['page_url'] = $redirect_link;
            // $redirect_link_var = $_SESSION['page_url'];
            $_SESSION['username'] = $username;
            $_SESSION['IS_LOGIN']='yes';
            $email= $_SESSION['email'];
            $userid=$_SESSION['userid'];	
            $message = "You are welcome back !!...";
            $_SESSION['status'] = $message;
            $adminID=$_SESSION['adminID'];
            $redirect_link=$_REQUEST['page_url'];
            $_SESSION['page_url'] = $redirect_link;
            $sql_login="INSERT INTO `login_activity`(`admin_username`, `user_role`, `last_login_time`) 
            VALUES ('$admin_username','$user_role','$last_login_time')";

            $result_login = Query($sql_login);
            confirm($result_login);

            if($redirect_link==""){
                header("location: ../armourer?login_success");
                die();
            }else{
                header("location: ".$redirect_link."");
                die();
            }
          
        }  
         }
         else {
        //   $redirect_link_var = $_SESSION['page_url'];
          $message = "Invalid Login Credentials :)";
    }   

}

?>

<!doctype html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Login | GPS ARMORY SYSTEM</title>
    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="assets/images/favicon.png" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="plugins/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/ionicons/dist/css/ionicons.min.css">
    <link rel="stylesheet" href="plugins/icon-kit/dist/css/iconkit.min.css">
    <link rel="stylesheet" href="plugins/perfect-scrollbar/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="dist/css/theme.min.css">
    <script src="src/js/vendor/modernizr-2.8.3.min.js"></script>
    <style>
        .btn{
            width: 200px;
            height: 40px;
        }
        .form-group{
            width: 100%;
            display: flex;
            border-width:0px 0px 2px 0px;
            align-items: center;
            border-bottom-style: solid;
            background:transparent;
        }
        .form-group input{
            width: 100%;
            font-size:16px;
            border:none;
            outline:none;
            color:#555;
            /* background:transparent; */
        }
        .form-group img{
        width: 25px;
        cursor:pointer;
        }

    </style>
</head>

<body>
    <div class="auth-wrapper">
        <div class="container-fluid h-100">
            <div class="row flex-row h-100 bg-white">
                <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                    <div class="lavalite-bg" style="background-image: url('assets/images/auth/login_gps_officer.jpg')">
                        <div class="lavalite-overlay"></div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                    <div class="authentication-form mx-auto">
                        <div class="logo-centered">
                            <a href="#"><img src="assets/images/gps_logo_blue.png" alt=""></a> 
                        </div>
                        <p>Sign In To</p>
                        <h3 style="font-weight: 10000" ><strong>GPS ARMORY SYSTEM</strong></h3>                      
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" name="username" class="form-control" placeholder="Username" required>
                                <i class="ik ik-user"></i>
                            </div>
                            <div class="form-group">
                                <input type="password" name="password"  id="password" class="form-control" placeholder="Password"
                                    value="" required>
                                <i class="ik ik-lock"></i>
                                <img src="assets/images/password_images/eye-close.png" alt="" id="eye_icon">

                            </div>
                            <?php
                             if(isset($_GET["new-password"])){
                                if($_GET["new-password"] == "passwordUpdated"){
                                    echo '<div class="alert alert-success" role="alert">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    <strong>Success!</strong> Your password has been changed.
                                    </div>';
                                }
                             }
                            ?>
                            <div class="row">
                                <div class="col text-right">
                                    <a href="forgot-password">Forgot Password ?</a>
                                </div>
                            </div>
                            <div class="sign-btn text-center">
                                <button class="btn" style="background-color: #ffa600; color:#fff;" type="submit">Sign In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script>
    window.jQuery || document.write('<script src="src/js/vendor/jquery-3.3.1.min.js"><\/script>')
    </script>
    <script src="plugins/popper.js/dist/umd/popper.min.js"></script>
    <script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
    <script src="plugins/screenfull/dist/screenfull.js"></script>
    <script src="dist/js/theme.js"></script>
    <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="jquery.bootstrap-growl.js"></script>
    <!-- <script src="jquery.bootstrap-growl.coffee"></script> -->
    <script>
    let eye_icon = document.getElementById("eye_icon");
    let password = document.getElementById("password");
    
    eye_icon.onclick = function(){
        if(password.type == "password"){
        password.type = "text";
        eye_icon.src = "assets/images/password_images/eye-open.png";
        }else{
        password.type = "password";
        eye_icon.src = "assets/images/password_images/eye-close.png";
        }
        
    }
  </script>
    <?php
        $username = $_SESSION['username'];
    if(!empty($message)){
        echo " <script type='text/javascript'>
        $.bootstrapGrowl('Invalid Login Credentials... :)', {
        ele: 'body', // which element to append to
        type: 'danger', // (null, 'info', 'danger', 'success')
        offset: {from: 'top', amount: 50}, // 'top', or 'bottom'
        align: 'right', // ('left', 'right', or 'center')
        width: 250, // (integer, or 'auto')
        height: 100,
        delay: 10000, // Time while the message will be displayed. It's not equivalent to the *demo* timeOut!
        allow_dismiss: true, // If true then will display a cross to close the popup.
        stackup_spacing: 10 // spacing between consecutively stacked growls.
        });
    </script>";
    }?>
    <?php  require_once('includes/google-analytics.php');?>
</body>

</html>