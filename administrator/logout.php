<?php
    // session_start();
    // // Destroy session
    // if(session_destroy()) {
    //     // Redirecting To Home Page
    //     header("Location: login.php");
    // }   //Query function 
    require_once('connections/connect-db.php');
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
   
    $username = $_SESSION['username'];
    $query = mysqli_query($connect_db,"SELECT * FROM `login_activity` WHERE `admin_username` ='$username'")
    or die( mysqli_error($connect_db));
    while ($row = mysqli_fetch_array($query)) {
      $loginID = $row['loginID'];
      $_SESSION['loginID'] = $loginID;
      $admin_username = $row['admin_username'];
      $_SESSION['admin_username'] = $admin_username;
      $last_login_time = $row['last_login_time'];
      $_SESSION['last_login_time'] = $last_login_time;
      $user_role = $row['user_role'];
      $_SESSION['user_role'] = $user_role;
      $last_logout_time = gmdate("l jS \of F Y h:i:s A");

      $sql_admin_activities = "INSERT INTO `logout_activity`(`loginID`, `admin_username`,`user_role`,
       `last_logout_time`) VALUES ('$loginID','$admin_username','$user_role', '$last_logout_time')";

      $result_admin_activities = Query($sql_admin_activities);
      confirm($result_admin_activities);

      $redirect_link_var = $_SESSION['page_url'];
      unset($_SESSION['LAST_ACTIVE_TIME']);
      unset($_SESSION['IS_LOGIN']);
      header('location:login?page_url='.$redirect_link_var.'');
      die();
    }
 
    // if (!isset($_POST['username'])){
    //     $admin_username = $username;
    //     $last_login_time = ;
    //     $last_logout_time=
         
      
    // }

    // header('location:login');
 
?>