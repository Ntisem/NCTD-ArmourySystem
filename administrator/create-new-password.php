
<?php
require_once('connections/connect-db.php');
 require_once('includes/redirect.php');
// session_start();
if (isset($_POST['username'])){
    
$username = stripslashes($_REQUEST['username']);
$username = mysqli_real_escape_string($connect_db,$username);
$password = stripslashes($_REQUEST['password']);
$password = mysqli_real_escape_string($connect_db,$password);

$query = "SELECT * FROM `admin_lists` WHERE username='$username'
and `password`='".md5($password)."'";
$result = mysqli_query($connect_db,$query) or die(mysqli_error($connect_db));
$rows = mysqli_num_rows($result);
// echo $username;
if($rows>0){
//    echo $redirect_link_var = $_SESSION['page_url'];
    $redirect_link=$_REQUEST['page_url'];
    $_SESSION['page_url'] = $redirect_link;
    if($redirect_link=="")
    {
        // $redirect_link_var = $_SESSION['page_url'];
        $_SESSION['username'] = $username;
        $_SESSION['IS_LOGIN']='yes';	
        $message = "You are welcome back !!...";
        $_SESSION['status'] = $message;
        $email= $_SESSION['email'];
        $adminID=$_SESSION['adminID'];
        header("Location: index?login_success");
      
        die();
    }
    else
    {
        $redirect_link_var = $_SESSION['page_url'];
        $_SESSION['username'] = $username;
        $_SESSION['IS_LOGIN']='yes';
        $email= $_SESSION['email'];
        $userid=$_SESSION['userid'];	
        $message = "You are welcome back !!...";
        $_SESSION['status'] = $message;
        header("location: ".$redirect_link."");
        die();   
    }  
     }
     else {
      $redirect_link_var = $_SESSION['page_url'];
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
                        <p>Create New Password</p>
                        <h3 style="font-weight: 10000" ><strong>GPS ARMORY SYSTEM</strong></h3>   
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
                        <?php
                            $selector = $_GET["selector"];
                            $validator = $_GET["validator"];
                            if (empty($selector) || empty($validator)) {
                                echo "<p class='error'>The password reset link is invalid, possibly because it has already been used.</p>";
                            }else{
                                if(ctype_xdigit($selector)!==false && ctype_xdigit($selector)!==false){
                                ?>
                             <form method="POST" action="functions.php">
                             <input type="hidden" name="selector" class="form-control" value="<?php echo $selector?>">
                             <input type="hidden" name="validator" class="form-control" value="<?php echo $validator?>">   
                             <div class="form-group">
                                    <input type="password" name="new_password" class="form-control" placeholder="Enter New Password" required>
                                    <i class="ik ik-user"></i>
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm_password" class="form-control" placeholder="Confirm Password"
                                        value="" required/>
                                    <i class="ik ik-lock"></i>
                                </div>
                                <div class="sign-btn text-center">
                                    <button class="btn" name="reset_password_submit" style="background-color: #ffa600; color:#fff;" type="submit">Create Password</button>
                                </div>
                              </form>
                            <?php
                                }
                            }

                            ?>             
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script src="jquery.bootstrap-growl.js"></script>
    <!-- <script src="jquery.bootstrap-growl.coffee"></script> -->
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