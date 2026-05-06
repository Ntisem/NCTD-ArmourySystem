<?php  
 require_once('connections/connect-db.php');
    //  session_start();
    //function clean string values 
    function escape($db_string)
    {
      global $connect_db;
      return mysqli_real_escape_string($connect_db, $db_string);
 
    }
    //Query function 
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
 
   //fetch Data from the database
   function fetch_data($result){
     return mysqli_fetch_assoc($result);
   }
 
 //row values from database
   function row_count($count){
     return mysqli_num_rows($count); 
   }
 //clean String values 
 function clean($string){
  return htmlentities($string);
}


// Display Message function 
function display_message(){
    
  if(isset($_SESSION['Message'])){
    echo $_SESSION['Message'];
    unset($_SESSION['Message']);
  }
}

//redirect users
function redirect($location){
   return header("location: {$location}");

}
//Set Session message
function set_message($message){
    if(!empty($message)){
        $_SESSION['Message'] = $message;
    }
    else {
        $message = "";
    }
}

//Send Email 
function send_email($email, $subject, $message, $header){

  return mail($email, $subject, $message, $header);
}
//========User validation  funtions=================
/// Erroes function 
function Error_validation($Error){
  return $Error;
}
 //Service No exist already
 function service_no_exist($service_no){
  $sql = "SELECT * FROM `admin_lists` where `service_no`='$service_no'";
  $result = Query($sql);
  
  if(fetch_data($result))
  {
      return true;
  }
  else{
      return false;
  }
}


 //faulty Serial No exist already
 function faulty_firearm_serial_no_exist($faulty_firearm_serial_no){
  $sql = "SELECT * FROM `faulty_weapons` where `faulty_firearm_serial_no`='$faulty_firearm_serial_no'";
  $result = Query($sql);
  
  if(fetch_data($result))
  {
      return true;
  }
  else{
      return false;
  }
}
 //Service No exist already
 function officer_service_no_exist($officer_service_no){
  $sql = "SELECT * FROM `officers` where `officer_service_no`='$officer_service_no'";
  $result = Query($sql);
  
  if(fetch_data($result))
  {
      return true;
  }
  else{
      return false;
  }
}

 //Email exist already
    function email_exist($admin_email){
       $sql = "SELECT * FROM `admin_lists` where `admin_email`='$admin_email'";
       $result = Query($sql);
       
       if(fetch_data($result))
       {
           return true;
       }
       else{
           return false;
       }
    }
    
 //Email exist already
 function officer_email_exist($officer_email){
   $sql = "SELECT * FROM `officers` where `officer_email`='$officer_email'";
  $result = Query($sql);
  
  if(fetch_data($result))
  {
      return true;
  }
  else{
      return false;
  }
}

       //Phone number exist already
   function phone_number_exist($phone_number){
    $sql = "SELECT * FROM admin_lists where phone_number='$phone_number'";
    $result = Query($sql);
    
    if(fetch_data($result))
    {
        return true;
    }
    else{
        return false;
    }
 } 
   //Phone number exist already
   function phone_no_exist($phone_no){
    $sql = "SELECT * FROM officers where phone_no='$phone_no'";
    $result = Query($sql);
    
    if(fetch_data($result))
    {
        return true;
    }
    else{
        return false;
    }
 }

   //Firearm exist already in firearm bookings table
   function firearmID_exist($firearmID){
    $sql = "SELECT * FROM bookings where firearmID='$firearmID'";
    $result = Query($sql);
    
    if(fetch_data($result))
    {
        return true;
    }
    else{
        return false;
    }
 }


   //Asset Exist in the asset_booking table  already
   function assetID_exist($assetID){
    $sql = "SELECT * FROM asset_bookings where assetID='$assetID'";
    $result = Query($sql);
    
    if(fetch_data($result))
    {
        return true;
    }
    else{
        return false;
    }
 }

 
   //faulty firearmID  for asset exist already
   function faulty_assetID_exist($faulty_assetID){
    $sql = "SELECT * FROM faulty_asset where faulty_assetID='$faulty_assetID'";
    $result = Query($sql);
    
    if(fetch_data($result))
    {
        return true;
    }
    else{
        return false;
    }
 }
   //faulty firearmID  for firearm  exist already
   function faulty_weaponID_exist($faulty_weaponID){
    $sql = "SELECT * FROM faulty_weapon where faulty_weaponID ='$faulty_weaponID'";
    $result = Query($sql);
    
    if(fetch_data($result))
    {
        return true;
    }
    else{
        return false;
    }
 }

     //Username exist already
     function username_exist($username){
      $sql = $sql = "SELECT * FROM `admin_lists` where `username`='$username'";
      $result = Query($sql);
      
      if(fetch_data($result))
      {
          return true;
      }
       else{
          return false;
      }
   }

 //faulty asset no exist already
 function faulty_asset_serial_no_exist($faulty_asset_serial_no){
  $sql = "SELECT * FROM `faulty_asset` where `faulty_asset_serial_no`='$faulty_asset_serial_no'";
  $result = Query($sql);
  
  if(fetch_data($result))
  {
      return true;
  }
  else{
      return false;
  }
}


 //faulty ammo no exist already
 function faulty_ammo_serial_no_exist($faulty_ammo_serial_no){
  $sql = "SELECT * FROM `faulty_ammo` where `faulty_ammo_serial_no`='$faulty_ammo_serial_no'";
  $result = Query($sql);
  
  if(fetch_data($result))
  {
      return true;
  }
  else{
      return false;
  }
}

 //Firearm firearm serial no exist already
 function firearm_serial_no_exist($firearm_serial_no){
  $sql = "SELECT * FROM `firearms` where `firearm_serial_no`='$firearm_serial_no'";
  $result = Query($sql);
  
  if(fetch_data($result))
  {
      return true;
  }
  else{
      return false;
  }
}



 //Asset serial no exist already
 function asset_serial_no_exist($asset_serial_no){
  $sql = "SELECT * FROM `other_assets` where `asset_serial_no`='$asset_serial_no'";
  $result = Query($sql);
  
  if(fetch_data($result))
  {
      return true;
  }
  else{
      return false;
  }
}


 //Ammo serial no exist already
 function ammo_serial_no_exist($ammo_serial_no){
  $sql = "SELECT * FROM `ammunitions` where `ammo_serial_no`='$ammo_serial_no'";
  $result = Query($sql);
  
  if(fetch_data($result))
  {
      return true;
  }
  else{
      return false;
  }
}

  if(isset($_POST['admin_send_mail']))
  {
      $admin_email = $_POST['admin_email'];
      $receiver_email = $_POST['receiver_email'];
      $all_investors = $_POST['all_investors'];
      $admin_subject = $_POST['admin_subject'];
      $admin_message= $_POST['admin_message'];
      $admin_name="GPS ARMOURY";
    if(empty($admin_subject) || empty($admin_message))
    {
      header('location:received-messages?blank_error');
     }
     else{
      $sql="INSERT INTO `admin_mailbox`(`admin_email`,`receiver_email`,`all_investors`,`admin_subject`,`admin_message`) 
      VALUES ('$admin_email','$receiver_email','$all_investors','$admin_subject','$admin_message')";
      $result_mail = Query($sql);
      confirm($result_mail);

      $mailTo = $receiver_email . $all_investors;
      $headers = "From: ".$admin_email;
      $txt = "You have received an E-mail from ".$admin_name."\n\n".$admin_message;
       mail($mailTo, $admin_subject, $txt, $headers);
       header('location:received-messages?submit_success');
} 
  }

//UPDATE  admins
if(isset($_POST['update-admin']))
  { 
    $user_role=$_POST['user_role'];
    $adminID=$_POST['adminID'];
    $adminID_armourerID=$_POST['adminID_armourerID'];
    $service_no = $_POST['service_no'];
    $rank = $_POST['rank'];
    $gender = $_POST['gender'];
    $unit_dept = $_POST['unit_dept'];
    // $profile_image = $_POST['profile_image'];  
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $phone_number=$_POST['phone_number'];
    $admin_email=$_POST['admin_email'];
    $armourer_admin_name = $_POST['armourer_admin_name'];
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    $action_taken = 'Updated '.$_POST['user_role'].' [ '.$_POST['rank'].' '.$fullname.' ]';
    $admin_armourer_user_role = $_POST['admin_armourer_user_role'];
    $profile_image = $_FILES['profile_image'];
    $profile_image_name =$_FILES['profile_image']['name'];
    $profile_image_tmp =$_FILES['profile_image']['tmp_name'];
    $profile_image_size =$_FILES['profile_image']['size'];
    $profile_image_error =$_FILES['profile_image']['error'];
    $profile_image_type =$_FILES['profile_image']['type'];
    $profile_image_ext = explode('.', $profile_image_name);
    $profile_imageActual_ext = strtolower(end($profile_image_ext));
    $profile_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");

    if(in_array($profile_imageActual_ext, $profile_image_allowed)){
      if($profile_image_error === 0){
        if($profile_image_size < 5000000){
          if(empty($fullname)|| empty($gender) || empty($username) || empty($phone_number) || empty($admin_email) || empty($rank)||
          empty($unit_dept) || empty($service_no)){
            
            header('location: administrators?blank_error');
          }else{
            $profile_image_name_new = uniqid('', true).".".$profile_imageActual_ext;
            $fileDestination = "assets/images/profile_images/".$profile_image_name_new;
            move_uploaded_file($profile_image_tmp, $fileDestination);
            $profile_image = $profile_image_name_new;

            $sql_admin="UPDATE `admin_lists` SET `adminID`='$adminID',`profile_image`='$profile_image',`user_role`='$user_role',
              `service_no`='$service_no',`rank`='$rank',`fullname`='$fullname',`gender`='$gender',
              `username`='$username',`unit_dept`='$unit_dept',`phone_number`='$phone_number',`admin_email`='$admin_email'
                WHERE `adminID` = '$adminID'";
               
              $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, `armourer_admin_name`,
              `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
               VALUES ('$adminID_armourerID','$armourer_admin_name','$action_taken','$admin_armourer' ,'$user_role','$booking_check','$seen_status','$bookings')";


              $result_admin_activities = Query($sql_admin_activities);
              confirm($result_admin_activities);

              $result_admin = Query($sql_admin);
              confirm($result_admin);
              header('location:administrators?update_success');

          }
         
        }else{
          header('location: administrators?size_error');
        }
      }else{
        header('location: administrators?file_error');
      }

    }else{
       header('location: administrators?allow_error');
      // echo "Error Occurred";
    }

  }


//UPDATE  Armourer
if(isset($_POST['update-armourer']))
  { 
    $user_role=$_POST['user_role'];
    $adminID=$_POST['adminID'];
    $adminID_armourerID=$_POST['adminID_armourerID'];
    $service_no = $_POST['service_no'];
    $rank = $_POST['rank'];
    $gender = $_POST['gender'];
    $unit_dept = $_POST['unit_dept'];
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    // $profile_image = $_POST['profile_image'];  
    $fullname=$_POST['fullname'];
    $username=$_POST['username'];
    $phone_number=$_POST['phone_number'];
    $admin_email=$_POST['admin_email'];
    $armourer_admin_name = $_POST['armourer_admin_name'];
    $admin_armourer_user_role = $_POST['admin_armourer_user_role'];
    $action_taken = 'Updated an '.$_POST['user_role'].' [ '.$_POST['rank'].' '.$fullname.' ]';
  

    $profile_image = $_FILES['profile_image'];
    $profile_image_name =$_FILES['profile_image']['name'];
    $profile_image_tmp =$_FILES['profile_image']['tmp_name'];
    $profile_image_size =$_FILES['profile_image']['size'];
    $profile_image_error =$_FILES['profile_image']['error'];
    $profile_image_type =$_FILES['profile_image']['type'];
    $profile_image_ext = explode('.', $profile_image_name);
    $profile_imageActual_ext = strtolower(end($profile_image_ext));
    $profile_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");

    if(in_array($profile_imageActual_ext, $profile_image_allowed)){
      if($profile_image_error === 0){
        if($profile_image_size < 5000000){
          if(empty($fullname)|| empty($gender) || empty($username) || empty($phone_number) || empty($admin_email) || empty($rank)||
          empty($unit_dept) || empty($service_no)){
            
            header('location: armourers?blank_error');
          }else{
            $profile_image_name_new = uniqid('', true).".".$profile_imageActual_ext;
            $fileDestination = "assets/images/profile_images/".$profile_image_name_new;
            move_uploaded_file($profile_image_tmp, $fileDestination);
            $profile_image = $profile_image_name_new;

            $sql_admin="UPDATE `admin_lists` SET `adminID`='$adminID',`profile_image`='$profile_image',`user_role`='$user_role',
              `service_no`='$service_no',`rank`='$rank',`fullname`='$fullname',`gender`='$gender',
              `username`='$username',`unit_dept`='$unit_dept',`phone_number`='$phone_number',`admin_email`='$admin_email'
                WHERE `adminID` = '$adminID'";
               
              $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, `armourer_admin_name`,
              `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
               VALUES ('$adminID_armourerID','$armourer_admin_name','$action_taken','$admin_armourer' ,
                '$user_role','$booking_check','$seen_status','$bookings')";


              $result_admin_activities = Query($sql_admin_activities);
              confirm($result_admin_activities);

              $result_admin = Query($sql_admin);
              confirm($result_admin);
              header('location:armourers?update_success');

          }
         
        }else{
          header('location: armourers?size_error');
        }
      }else{
        header('location: armourers?file_error');
      }

    }else{
       header('location: armourers?allow_error');
      // echo "Error Occurred";
    }

  }

    
//REGISTER Admin...........................................................................
if (isset($_POST['add_armourer'])) {
  // receive all input values from the form
  $gender =mysqli_real_escape_string($connect_db, $_POST['gender']);
  $user_role =mysqli_real_escape_string($connect_db, $_POST['user_role']);
  $service_no =mysqli_real_escape_string($connect_db, $_POST['service_no']);
  $rank =mysqli_real_escape_string($connect_db, $_POST['rank']);
  $username =mysqli_real_escape_string($connect_db, $_POST['username']);
  $first_name =mysqli_real_escape_string($connect_db, $_POST['first_name']);
  $last_name =mysqli_real_escape_string($connect_db, $_POST['last_name']);
  $unit_dept =mysqli_real_escape_string($connect_db, $_POST['unit_dept']);
  $phone_number = mysqli_real_escape_string($connect_db, $_POST['phone_number']);
  $admin_email = mysqli_real_escape_string($connect_db, $_POST['admin_email']);
  $password_1 = mysqli_real_escape_string($connect_db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($connect_db, $_POST['password_2']);
  $adminID_armourerID=mysqli_real_escape_string($connect_db,$_POST['adminID_armourerID']);
  // Daily activities 
  $booking_check ="No";
    $een_status = "Not";
    $bookings = "Inventory"; 
  $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
  $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
  $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);
  $fullname = $first_name.' '.$last_name;
  $action_taken = 'Added New Armourer [ '.$rank.' '.$fullname.' ]';
  // echo $fullname;
  // form validation: ensure that the form is correctly filled ...
  // profile image 
  $profile_image = $_FILES['profile_image'];
  $profile_image_name =$_FILES['profile_image']['name'];
  $profile_image_tmp =$_FILES['profile_image']['tmp_name'];
  $profile_image_size =$_FILES['profile_image']['size'];
  $profile_image_error =$_FILES['profile_image']['error'];
  $profile_image_type =$_FILES['profile_image']['type'];
  $profile_image_ext = explode('.', $profile_image_name);
  $profile_imageActual_ext = strtolower(end($profile_image_ext));
  $profile_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");

  if(in_array($profile_imageActual_ext, $profile_image_allowed)){
    
    if($profile_image_error === 0){

             if($profile_image_size < 5000000){

                if(empty($user_role) || empty($service_no)|| empty($rank) || empty($fullname) ||
                 empty($gender) || empty($username) || empty($unit_dept) || 
                empty($phone_number)|| empty($admin_email) || empty($password_1)){

                  header('location: add-new-armourer?blank_error');
                
                }else if($password_1 != $password_2){

                  header('location: add-new-armourer?passwords_error');
                }else if(service_no_exist($service_no)){

                header('location: add-new-armourer?service_error');
               
                  
                }else if(username_exist($username)){
                   
                  header('location: add-new-armourer?username_error');

                }else if(phone_number_exist($phone_number)){
                      header('location: add-new-armourer?phone_number_error');
                }
                else if(email_exist($admin_email)){
                  header('location: add-new-armourer?email_error');
                 }
                 else{
                  $password = md5($password_1);
                  $code = rand(999999, 111111);
                  $status = "Not-Verified";


                  $profile_image_name_new = uniqid('', true).".".$profile_imageActual_ext;
                  $fileDestination = "assets/images/profile_images/".$profile_image_name_new;
                  move_uploaded_file($profile_image_tmp, $fileDestination);
                  $profile_image = $profile_image_name_new;

                  $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
                  `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
                   VALUES ('$adminID_armourerID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";
                   

                  $sql_register = "INSERT INTO `admin_lists`( `profile_image`, `user_role`, `service_no`,
                   `rank`, `gender`, `fullname`, `admin_email`, `phone_number`,
                    `username`, `password`, `unit_dept`, `code`, `status`) 
                  VALUES ('$profile_image','$user_role','$service_no','$rank','$gender','$fullname','$admin_email',
                  '$phone_number','$username','$password','$unit_dept','$code','$status')";

                  $sql_register2 = "INSERT INTO `admin_lists2`( `profile_image`, `user_role`, `service_no`,
                   `rank`, `gender`, `fullname`, `admin_email`, `phone_number`,
                    `username`, `password`, `unit_dept`, `code`, `status`) 
                  VALUES ('$profile_image','$user_role','$service_no','$rank','$gender','$fullname','$admin_email',
                  '$phone_number','$username','$password','$unit_dept','$code','$status')";
                  
                
                  $result_admin_activities = Query($sql_admin_activities);
                  confirm($result_admin_activities);

                   $result_register = Query($sql_register);
                   confirm($result_register);

                   $result_register2 = Query($sql_register2);
                   confirm($result_register2);

                      // echo 'Registered Successfully';
                    header('location: armourers?register_success');
                        }
             }else{
               header('location: add-new-armourer?size_error');
             }

    }else{
      header('location: add-new-armourer?file_error');
    }

  }else{
     header('location: add-new-armourer?allow_error');
    // echo "Error Occurred";
  }
}
  
    
//REGISTER Admin...........................................................................
if (isset($_POST['add_admin'])) {
  // receive all input values from the form
  $gender =mysqli_real_escape_string($connect_db, $_POST['gender']);
  $user_role =mysqli_real_escape_string($connect_db, $_POST['user_role']);
  $service_no =mysqli_real_escape_string($connect_db, $_POST['service_no']);
  $rank =mysqli_real_escape_string($connect_db, $_POST['rank']);
  $username =mysqli_real_escape_string($connect_db, $_POST['username']);
  $first_name =mysqli_real_escape_string($connect_db, $_POST['first_name']);
  $last_name =mysqli_real_escape_string($connect_db, $_POST['last_name']);
  $unit_dept =mysqli_real_escape_string($connect_db, $_POST['unit_dept']);
  $phone_number = mysqli_real_escape_string($connect_db, $_POST['phone_number']);
  $admin_email = mysqli_real_escape_string($connect_db, $_POST['admin_email']);
  $password_1 = mysqli_real_escape_string($connect_db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($connect_db, $_POST['password_2']);
  $fullname = $first_name.' '.$last_name;
  $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
  $action_taken ='Added New Administrator [ '.$rank.' '.$fullname.' ]';
  $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
  $adminID_armourerID=mysqli_real_escape_string($connect_db,$_POST['adminID_armourerID']);
  
  $booking_check ="No";
    $een_status = "Not";
    $bookings = "Inventory"; 
  // echo $fullname;
  // form validation: ensure that the form is correctly filled ...
  // profile image 
  $profile_image = $_FILES['profile_image'];
  $profile_image_name =$_FILES['profile_image']['name'];
  $profile_image_tmp =$_FILES['profile_image']['tmp_name'];
  $profile_image_size =$_FILES['profile_image']['size'];
  $profile_image_error =$_FILES['profile_image']['error'];
  $profile_image_type =$_FILES['profile_image']['type'];
  $profile_image_ext = explode('.', $profile_image_name);
  $profile_imageActual_ext = strtolower(end($profile_image_ext));
  $profile_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");

  if(in_array($profile_imageActual_ext, $profile_image_allowed)){
    
    if($profile_image_error === 0){
             if($profile_image_size < 5000000){
                if(empty($user_role) || empty($service_no)|| empty($rank) || empty($fullname) ||
                 empty($gender) || empty($username) || empty($unit_dept) || 
                empty($phone_number)|| empty($admin_email) || empty($password_1)){

                  header('location: add-new-admin?blank_error');
                
                }else if($password_1 != $password_2){

                  header('location: add-new-admin?passwords_error');
                }
                else if(service_no_exist($service_no)){

                  header('location: add-new-admin?service_error');
                 
                    
                  }else if(username_exist($username)){
                     
                    header('location: add-new-admin?username_error');
  
                  }else if(phone_number_exist($phone_number)){
                        header('location: add-new-admin?phone_number_error');
                  }
                  else if(email_exist($admin_email)){
                    header('location: add-new-admin?email_error');
                   }
                
                else{
                  $password = md5($password_1);
                  $code = rand(999999, 111111);
                  $status = "Not-Verified";

                  $profile_image_name_new = uniqid('', true).".".$profile_imageActual_ext;
                  $fileDestination = "assets/images/profile_images/".$profile_image_name_new;
                  move_uploaded_file($profile_image_tmp, $fileDestination);
                  $profile_image = $profile_image_name_new;

                  $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
                  `armourer_admin_name`,  `action_taken`,`user_role`, `booking_check`,`seen_status`,`bookings`)
                   VALUES ('$adminID_armourerID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

                  $sql_register = "INSERT INTO `admin_lists`( `profile_image`, `user_role`, `service_no`,
                  `rank`, `gender`, `fullname`, `admin_email`, `phone_number`,
                  `username`, `password`, `unit_dept`, `code`, `status`) 
                  VALUES ('$profile_image','$user_role','$service_no','$rank','$gender','$fullname','$admin_email',
                  '$phone_number','$username','$password','$unit_dept','$code','$status')";

                  $sql_register2 = "INSERT INTO `admin_lists2`( `profile_image`, `user_role`, `service_no`,
                  `rank`, `gender`, `fullname`, `admin_email`, `phone_number`,
                  `username`, `password`, `unit_dept`, `code`, `status`) 
                   VALUES ('$profile_image','$user_role','$service_no','$rank','$gender','$fullname','$admin_email',
                  '$phone_number','$username','$password','$unit_dept','$code','$status')";
                        
         
                  $result_admin_activities = Query($sql_admin_activities);
                  confirm($result_admin_activities);

                   $result_register = Query($sql_register);
                   confirm($result_register);

                   $result_register2 = Query($sql_register2);
                   confirm($result_register2);
                      // echo 'Registered Successfully';
                    header('location: administrators?register_success');
                        }
             }else{
               header('location: add-new-admin?size_error');
             }

    }else{
      header('location: add-new-admin?file_error');
    }

  }else{
     header('location: add-new-admin?allow_error');
    // echo "Error Occurred";
  }
}
  

//Add faulty Assets/Weapons...........................................................................
if (isset($_POST['add_faulty_weapon'])) {
  // receive all input values from the form
  $faulty_firearm_serial_no =mysqli_real_escape_string($connect_db, $_POST['faulty_firearm_serial_no']);
  $faulty_firearm_type =mysqli_real_escape_string($connect_db, $_POST['faulty_firearm_type']);
  $faulty_firearm_name =mysqli_real_escape_string($connect_db, $_POST['faulty_firearm_name']);
  $faulty_firearm_class =mysqli_real_escape_string($connect_db, $_POST['faulty_firearm_class']);
  $faulty_type =mysqli_real_escape_string($connect_db, $_POST['faulty_type']);
  $faulty_nature =mysqli_real_escape_string($connect_db, $_POST['faulty_nature']);
  $faulty_firearm_comment =mysqli_real_escape_string($connect_db, $_POST['faulty_firearm_comment']);
  
  // form validation: ensure that the form is correctly filled ...
  $booking_check ="No";
    $een_status = "Not";
    $bookings = "Inventory"; 
  $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
  $action_taken ='Added Faulty Firearm [ '.$faulty_firearm_name.' ('. $faulty_firearm_type .' ) ]';
  $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
  $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);

  // by adding (array_push()) corresponding error unto $errors array
  $faulty_firearm_image = $_FILES['faulty_firearm_image'];
  $faulty_firearm_image_name =$_FILES['faulty_firearm_image']['name'];
  $faulty_firearm_image_tmp =$_FILES['faulty_firearm_image']['tmp_name'];
  $faulty_firearm_image_size =$_FILES['faulty_firearm_image']['size'];
  $faulty_firearm_image_error =$_FILES['faulty_firearm_image']['error'];
  $faulty_firearm_image_type =$_FILES['faulty_firearm_image']['type'];
  $faulty_firearm_image_ext = explode('.', $faulty_firearm_image_name);
  $faulty_firearm_imageActual_ext = strtolower(end($faulty_firearm_image_ext));
  $faulty_firearm_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");
  
  if (in_array($faulty_firearm_imageActual_ext, $faulty_firearm_image_allowed)) {
    if ($faulty_firearm_image_error === 0) {
      if ($faulty_firearm_image_size < 50000000) {

        if(empty($faulty_firearm_serial_no) || empty($faulty_firearm_name) || empty($faulty_firearm_type) || 
        empty($faulty_firearm_class)|| empty($faulty_type)){

          header('location: add-faulty-weapon?blank_error');

        }else if(faulty_firearm_serial_no_exist($faulty_firearm_serial_no )){
                     
          header('location: add-faulty-weapon?serial_no_error');

        } else{
          $faulty_firearm_image_name_new = uniqid('', true).".".$faulty_firearm_imageActual_ext;
          $fileDestination = "assets/images/faulty_firearm_images/".$faulty_firearm_image_name_new;
          move_uploaded_file($faulty_firearm_image_tmp, $fileDestination);
          $faulty_firearm_image = $faulty_firearm_image_name_new;

          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
          VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";
          $result_admin_activities = Query($sql_admin_activities);

          $sql_weapons="INSERT INTO `faulty_weapons`(`faulty_firearm_serial_no`,
          `faulty_firearm_type`, `faulty_firearm_name`,`faulty_firearm_class`, `faulty_type`, `faulty_nature`, 
          `faulty_firearm_image`, `faulty_firearm_comment`) 
          VALUES ('$faulty_firearm_serial_no','$faulty_firearm_type', '$faulty_firearm_name',
          '$faulty_firearm_class','$faulty_type', '$faulty_nature','$faulty_firearm_image','$faulty_firearm_comment')";

          $sql_weapons2="INSERT INTO `faulty_weapons2`(`faulty_firearm_serial_no`,
          `faulty_firearm_type`, `faulty_firearm_name`, `faulty_firearm_class`, `faulty_type`,  `faulty_nature`, 
          `faulty_firearm_image`, `faulty_firearm_comment`) 
          VALUES ('$faulty_firearm_serial_no','$faulty_firearm_type','$faulty_firearm_name',
          '$faulty_firearm_class', '$faulty_type', '$faulty_nature','$faulty_firearm_image',
          '$faulty_firearm_comment')";
     
            confirm($result_admin_activities);

            $result_weapons = Query($sql_weapons);
            confirm($result_weapons);

          $result_weapons2 = Query($sql_weapons2);
          confirm($result_weapons2);

          header('location: faulty-weapon?register_success');
        }
        
      }else{
        header('location: add-faulty-weapon?size_error');
      }

    }else {
      header('location: add-faulty-weapon?file_error');
    }

  }else{
    header('location: add-faulty-weapon?allow_error');
  }
  

}




     
//REGISTER Officer...........................................................................
if (isset($_POST['add_officer'])) {
  // receive all input values from the form
  $gender =mysqli_real_escape_string($connect_db, $_POST['gender']);
  $officer_status =mysqli_real_escape_string($connect_db, $_POST['officer_status']);
  $officer_service_no =mysqli_real_escape_string($connect_db, $_POST['officer_service_no']);
  $rank =mysqli_real_escape_string($connect_db, $_POST['rank']);
  $first_name =mysqli_real_escape_string($connect_db, $_POST['first_name']);
  $last_name =mysqli_real_escape_string($connect_db, $_POST['last_name']);
  $dept_unit =mysqli_real_escape_string($connect_db, $_POST['dept_unit']);
  $phone_no = mysqli_real_escape_string($connect_db, $_POST['phone_no']);
  $officer_email = mysqli_real_escape_string($connect_db, $_POST['officer_email']);
  // $officer_image = mysqli_real_escape_string($connect_db, $_POST['officer_image']);
  $full_name = $first_name.' '.$last_name;
  $booking_check ="No";
    $een_status = "Not";
    $bookings = "Inventory"; 
  $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
  $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
  $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);
  $action_taken = 'Added New Officer [ '.$rank.' '. $full_name.' ]';
  // form validation: ensure that the form is correctly filled ...
  $officer_image = $_FILES['officer_image'];
  $officer_image_name =$_FILES['officer_image']['name'];
  $officer_image_tmp =$_FILES['officer_image']['tmp_name'];
  $officer_image_size =$_FILES['officer_image']['size'];
  $officer_image_error =$_FILES['officer_image']['error'];
  $officer_image_type =$_FILES['officer_image']['type'];
  $officer_image_ext = explode('.', $officer_image_name);
  $officer_imageActual_ext = strtolower(end($officer_image_ext));
  $officer_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");

  if (in_array($officer_imageActual_ext, $officer_image_allowed)) {
    if ($officer_image_error === 0) {

      if ($officer_image_size < 50000000) {
        
        if(empty($gender) || empty($officer_status) || empty($officer_service_no) || empty($rank) ||
        empty($first_name) || empty($last_name) || empty($dept_unit) || empty($phone_no) || 
        empty($officer_email) || empty($officer_image)){
          
          header('location: add-new-officer?blank_error');
        }
        else if(officer_service_no_exist($officer_service_no)){

          header('location: add-new-officer?service_error');

        }
        else if(phone_no_exist($phone_no)){

          header('location: add-new-officer?phone_number_error');

        } else if(officer_email_exist($officer_email)){

          header('location: add-new-officer?email_error');

        } else{
          $officer_image_name_new = uniqid('', true).".".$officer_imageActual_ext;
          $fileDestination = "assets/images/officer_images/".$officer_image_name_new;
          move_uploaded_file($officer_image_tmp, $fileDestination);
          $officer_image = $officer_image_name_new;

          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
          VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

          $sql_officer="INSERT INTO `officers`(`officer_status`,`officer_image`,`officer_service_no`, 
          `rank`, `full_name`, `gender`, `dept_unit`, `phone_no`, `officer_email`) 
          VALUES ('$officer_status','$officer_image','$officer_service_no','$rank','$full_name','$gender',
          '$dept_unit','$phone_no','$officer_email')";
          
          $sql_officer2="INSERT INTO `officers2`(`officer_status`,`officer_image`,`officer_service_no`, 
          `rank`, `full_name`, `gender`, `dept_unit`, `phone_no`, `officer_email`) 
          VALUES ('$officer_status','$officer_image','$officer_service_no','$rank','$full_name','$gender',
          '$dept_unit','$phone_no','$officer_email')";

                
          
          $result_admin_activities = Query($sql_admin_activities);
          confirm($result_admin_activities);

          $result_officer = Query($sql_officer);
          confirm($result_officer);

          $result_officer2 = Query($sql_officer2);
          confirm($result_officer2);

          header('location: officers-list?register_success');
        }

      }else{
        header('location: add-new-officer?size_error');
      }

    }else{
      header('location: add-new-officer?file_error');
    }

  }else{
    header('location: add-new-officer?allow_error');
  }
 
}

//Booking Assets/Weapons...........................................................................

 if (isset($_POST['booking_firearm'])) {
        // receive all input values from the form
        // $firearm_serial_no =mysqli_real_escape_string($connect_db, $_POST['firearm_serial_no']);
        
    $firearm_name =mysqli_real_escape_string($connect_db, $_POST['firearm_name']);
    $quantity_issued =mysqli_real_escape_string($connect_db, $_POST['quantity_issued']);
    $returns =mysqli_real_escape_string($connect_db, $_POST['returns']);
    $firearm_class =mysqli_real_escape_string($connect_db, $_POST['firearm_class']);
    $firearm_state =mysqli_real_escape_string($connect_db, $_POST['firearm_state']);

    $armourer_issuer =mysqli_real_escape_string($connect_db, $_POST['armourer_issuer']);
    $to_officer =mysqli_real_escape_string($connect_db, $_POST['to_officer']);
    $duty_location =mysqli_real_escape_string($connect_db, $_POST['duty_location']);
    $duty_type =mysqli_real_escape_string($connect_db, $_POST['duty_type']);
    $duty_duration =mysqli_real_escape_string($connect_db, $_POST['duty_duration']);
    $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
    $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
    $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);
    $firearmID=mysqli_real_escape_string($connect_db,$_POST['firearmID']);
    $officerID=mysqli_real_escape_string($connect_db,$_POST['officerID']);
    $ammoID=mysqli_real_escape_string($connect_db,$_POST['ammoID']);
    $duty_duration =  mysqli_real_escape_string($connect_db,$_POST['duty_duration']);
    $booking_status ="Not-Available"; 
    $booking_check ="Yes";
    $seen_status = "Not";
    $bookings = "Booking ".$firearm_name; 
    $officer_image = mysqli_real_escape_string($connect_db, $_POST['officer_image']);
    $gps_armoury_email = mysqli_real_escape_string($connect_db, $_POST['gps_armoury_email']);
    $officer_email = mysqli_real_escape_string($connect_db, $_POST['officer_email']);
    $ammunition_name = mysqli_real_escape_string($connect_db, $_POST['ammunition_name']);
    $number_of_rounds = mysqli_real_escape_string($connect_db, $_POST['number_of_rounds']);
    $comment = mysqli_real_escape_string($connect_db, $_POST['comment']);
    $action_taken= 'Issued a Firearm [ '.$firearm_name.'(with number of Rounds: '.$number_of_rounds.' ] to '.$to_officer;
    $ammo_total_rounds = mysqli_real_escape_string($connect_db, $_POST['ammo_total_rounds']);
    $total_ammo_left = $ammo_total_rounds - $number_of_rounds;
    $booking_time =gmdate("l jS \of F Y h:i:s A");
    $returned_time = " ";
    $ammo_returned = " ";
    $ammo_state =" ";
    $no_faulty_ammo =" ";
    $bookingCode = "BFARMS".$officerID.''.$adminID.''.$bookingID.''.$firearmID;
    if( empty($duty_type) || empty($duty_location) || empty($number_of_rounds) || empty($firearm_name) ||
    empty($booking_time)) {

      header('location: booking?blank_error'); 
    
    } else if(firearmID_exist($firearmID)){ 

      header('location: booking?firearmID_error');

    }else if($number_of_rounds > $ammo_total_rounds){ 

      header('location: booking?ammo_number_error');

    } else{

      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";


      $sql_booking_firearm = "INSERT INTO `bookings`(`bookingCode`,`firearmID`, `ammoID`, `officerID`,
       `booking_time`, `armourer_issuer`, `officer_image`, `to_officer`,`firearm_name`,
        `firearm_class`, `quantity_issued`, `firearm_state`, `ammunition_name`, `number_of_rounds`,
        `ammo_returned`, `ammo_state`, `no_faulty_ammo`, `duty_type`, `duty_location`, `duty_duration`, 
        `returns`, `comment`, `returned_time`) VALUES ('$bookingCode','$firearmID',
       '$ammoID','$officerID','$booking_time','$armourer_issuer', '$officer_image','$to_officer',
       '$booking_time','$duty_duration','$firearm_name','$firearm_class','$quantity_issued',
        '$firearm_state','$ammunition_name','$number_of_rounds','$ammo_returned','$ammo_state',
        '$no_faulty_ammo','$duty_type','$duty_location','$returns','$comment','$returned_time')";

      $sql_booking_firearm2 = "INSERT INTO `bookings`(`bookingCode`,`firearmID`, `ammoID`, `officerID`,
       `booking_time`, `armourer_issuer`, `officer_image`, `to_officer`,`firearm_name`,
        `firearm_class`, `quantity_issued`, `firearm_state`, `ammunition_name`, `number_of_rounds`,
        `ammo_returned`, `ammo_state`, `no_faulty_ammo`, `duty_type`, `duty_location`, `duty_duration`, 
        `returns`, `comment`, `returned_time`) VALUES ('$bookingCode','$firearmID',
       '$ammoID','$officerID','$booking_time','$armourer_issuer', '$officer_image','$to_officer',
       '$booking_time','$duty_duration','$firearm_name','$firearm_class','$quantity_issued',
        '$firearm_state','$ammunition_name','$number_of_rounds','$ammo_returned','$ammo_state',
        '$no_faulty_ammo','$duty_type','$duty_location','$returns','$comment','$returned_time')";

      $update_firearm_sql = "UPDATE `firearms` SET `booking_status` = '$booking_status' WHERE `firearmID`='$firearmID'";

      $result_booking_status = Query( $update_firearm_sql);
      confirm( $result_booking_status);
      
      $update_ammo_rounds_sql = "UPDATE `ammunitions` SET `ammo_rounds` = '$total_ammo_left' WHERE `ammoID`='$ammoID'";

      $result_ammo_status = Query( $update_ammo_rounds_sql);
      confirm( $result_ammo_status);


      $result_admin_activities = Query($sql_admin_activities);
      confirm($result_admin_activities);

      $result_booking_firearm = Query( $sql_booking_firearm);
      confirm($result_booking_firearm);

      $result_booking_firearm2 = Query( $sql_booking_firearm2);
      confirm($result_booking_firearm2);

        // echo 'Registered Successfully';
      header('location: booked-firearms?register_success');
          }

        }
         
// Booking Ammunition

if (isset($_POST['booking_ammo'])) {
    $ammo_returns =mysqli_real_escape_string($connect_db, $_POST['ammo_returns']);

    $armourer_issuer =mysqli_real_escape_string($connect_db, $_POST['armourer_issuer']);
    $to_officer =mysqli_real_escape_string($connect_db, $_POST['to_officer']);
    $duty_location =mysqli_real_escape_string($connect_db, $_POST['duty_location']);
    $duty_type =mysqli_real_escape_string($connect_db, $_POST['duty_type']);
    $ammoID =mysqli_real_escape_string($connect_db, $_POST['ammoID']);
    $duty_duration =mysqli_real_escape_string($connect_db, $_POST['duty_duration']);
    $officer_image =mysqli_real_escape_string($connect_db, $_POST['officer_image']);
    $gps_armoury_email =mysqli_real_escape_string($connect_db, $_POST['gps_armoury_email']);
    $officer_email =mysqli_real_escape_string($connect_db, $_POST['officer_email']);
    $ammo_name =mysqli_real_escape_string($connect_db, $_POST['ammo_name']);
    $ammo_rounds =mysqli_real_escape_string($connect_db, $_POST['ammo_rounds']);
    $ammo_comment =mysqli_real_escape_string($connect_db, $_POST['ammo_comment']);
    $booking_status ="Not-Available";
    $booking_check ="Yes";
    $seen_status = "Not";
   
    $bookings = "Booking [".$ammo_rounds.':Rds] '.$ammo_name; 
    $duty_duration =  mysqli_real_escape_string($connect_db,$_POST['duty_duration']);
    $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
    $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
    $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);
    $action_taken ='Issued an Ammo [ '.$ammo_name.'(Number of Rounds: '.$ammo_rounds.' ] to '.$to_officer;
    $officerID=mysqli_real_escape_string($connect_db,$_POST['officerID']);
    $ammoID=mysqli_real_escape_string($connect_db,$_POST['ammoID']);
    $ammo_total_rounds = mysqli_real_escape_string($connect_db, $_POST['ammo_total_rounds']);
    $total_ammo_left = $ammo_total_rounds - $ammo_rounds;
    $booking_time =gmdate("l jS \of F Y h:i:s A");
    $returned_time = " ";
    $ammo_returned = " ";
    $ammo_state =" ";
    $no_faulty_ammo =" ";
    $bookingCode = "BAMMO".$officerID.''.$adminID.''.$booking_ammoID.''.$ammoID;
    if( empty($duty_type) || empty($duty_location) || empty($ammo_rounds) || empty($ammo_name) ||
    empty($booking_time)) {

    header('location: booking-ammo?blank_error'); 

    }else if($ammo_rounds > $ammo_total_rounds){ 

      header('location: booking-ammo?ammo_number_error');

    }  else{

    $sql_booking_ammo = "INSERT INTO `ammo_bookings`(`bookingCode`,`ammoID`, `officerID`, 
    `booking_time`, `armourer_issuer`, `officer_image`, `to_officer`, `booking_time`, `ammo_name`, 
    `ammo_rounds`, `ammo_returned`, `ammo_state`, `no_faulty_ammo`, `duty_type`, `duty_location`,
     `duty_duration`, `ammo_comment`, `ammo_returns`, `returned_time`) 
      VALUES ('$bookingCode','$ammoID','$officerID','$booking_time','$armourer_issuer','$officer_image','$to_officer',
      '$booking_time','$duty_duration','$ammo_name','$ammo_rounds','$ammo_returned','$ammo_state','$no_faulty_ammo',
      '$duty_type','$duty_location','$ammo_comment','$ammo_returns','$returned_time')";

      $sql_booking_ammo2 = "INSERT INTO `ammo_bookings`(`bookingCode`,`ammoID`, `officerID`, 
    `booking_time`, `armourer_issuer`, `officer_image`, `to_officer`, `booking_time`, `ammo_name`, 
    `ammo_rounds`, `ammo_returned`, `ammo_state`, `no_faulty_ammo`, `duty_type`, `duty_location`,
     `duty_duration`, `ammo_comment`, `ammo_returns`, `returned_time`) 
      VALUES ('$bookingCode','$ammoID','$officerID','$booking_time','$armourer_issuer','$officer_image','$to_officer',
      '$booking_time','$duty_duration','$ammo_name','$ammo_rounds','$ammo_returned','$ammo_state','$no_faulty_ammo',
      '$duty_type','$duty_location','$ammo_comment','$ammo_returns','$returned_time')";

          
      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

      $result_admin_activities = Query($sql_admin_activities);
      confirm($result_admin_activities);
        
      $update_ammo_rounds_sql = "UPDATE `ammunitions` SET `ammo_rounds` = '$total_ammo_left', 
      `booking_status` = '$booking_status' WHERE `ammoID`='$ammoID'";

      $result_ammo_status = Query( $update_ammo_rounds_sql);
      confirm( $result_ammo_status);

      $result_booking_ammo = Query($sql_booking_ammo);
      confirm($result_booking_ammo);

      $result_booking_ammo2 = Query($sql_booking_ammo2);
      confirm($result_booking_ammo2);

    // echo 'Registered Successfully';
     header('location: booked-ammo?register_success');
      }

    }
//End Booking Ammunition Ends 

//Booking Other Assets/Weapons...........................................................................
if (isset($_POST['booking_asset'])) {
  // receive all input values from the form
  $asset_returns =mysqli_real_escape_string($connect_db, $_POST['asset_returns']);
  $armourer_issuer =mysqli_real_escape_string($connect_db, $_POST['armourer_issuer']);
  $to_officer =mysqli_real_escape_string($connect_db, $_POST['to_officer']);
  $duty_location =mysqli_real_escape_string($connect_db, $_POST['duty_location']);
  $duty_type =mysqli_real_escape_string($connect_db, $_POST['duty_type']);
  $officer_image =mysqli_real_escape_string($connect_db, $_POST['officer_image']);
  $gps_armoury_email =mysqli_real_escape_string($connect_db, $_POST['gps_armoury_email']);
  $officer_email =mysqli_real_escape_string($connect_db, $_POST['officer_email']);
  $asset_name =mysqli_real_escape_string($connect_db, $_POST['asset_name']);
  $asset_quantity =mysqli_real_escape_string($connect_db, $_POST['asset_quantity']);
  $asset_comment =mysqli_real_escape_string($connect_db, $_POST['asset_comment']);
  $duty_duration =mysqli_real_escape_string($connect_db, $_POST['duty_duration']);
  $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
  $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
  $booking_status ="Not-Available";
  $booking_check ="Yes";
  $een_status = "Not";
  
  $bookings = "Booking ".$asset_name; 
  $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);
  $action_taken = 'Issued an Asset(s) [ '.$asset_name.'(Quantity: '.$asset_quantity.' ] to '.$to_officer;
  $officerID=mysqli_real_escape_string($connect_db,$_POST['officerID']);
  $assetID=mysqli_real_escape_string($connect_db,$_POST['assetID']);
  $asset_image=mysqli_real_escape_string($connect_db,$_POST['asset_image']);
  $asset_state =mysqli_real_escape_string($connect_db,$_POST['asset_state']);
  $no_faulty_asset =" ";
  $booking_time =gmdate("l jS \of F Y h:i:s A");
  $returned_time = " ";
  $bookingCode = "BASSET".$officerID.''.$adminID.''.$bookAssetID.''.$assetID;
  if (empty($armourer_issuer) || empty($to_officer) || empty($booking_time) || empty($asset_name)  
  || empty($duty_location)|| empty($asset_quantity)) 
  { 
     header('location: booking-other-assets?blank_error');

   }else if(assetID_exist($assetID)){

    header('location: booking-other-assets?assetID_error');

  }
   else{

    $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
    `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
     VALUES ('$adminID','$armourer_admin_name','$action_taken', '$user_role','$booking_check','$seen_status','$bookings')";

    $sql_other_asset="INSERT INTO `asset_bookings`(`bookingCode`,`assetID`, `officerID`, `booking_time`, 
    `armourer_issuer`, `officer_image`, `to_officer`, `asset_name`, `asset_quantity`, `asset_state`, 
    `no_faulty_asset`, `duty_type`, `duty_location`, `duty_duration`, `asset_returns`, `asset_comment`,
    `returned_time`) VALUES ('$bookingCode','$assetID','$officerID','$booking_time','$armourer_issuer',
    '$officer_image','$to_officer','$asset_image','$asset_name','$asset_quantity','$asset_state',
    '$no_faulty_asset','$duty_type','$duty_location','$duty_duration','$asset_returns',
    '$asset_comment','$returned_time')";

    $sql_other_asset2="INSERT INTO `asset_bookings`(`bookingCode`,`assetID`, `officerID`, `booking_time`, 
    `armourer_issuer`, `officer_image`, `to_officer`, `asset_name`, `asset_quantity`, `asset_state`, 
    `no_faulty_asset`, `duty_type`, `duty_location`, `duty_duration`, `asset_returns`, `asset_comment`,
    `returned_time`) VALUES ('$bookingCode','$assetID','$officerID','$booking_time','$armourer_issuer',
    '$officer_image','$to_officer','$asset_image','$asset_name','$asset_quantity','$asset_state',
    '$no_faulty_asset','$duty_type','$duty_location','$duty_duration','$asset_returns',
    '$asset_comment','$returned_time')";
    
    $update_asset_sql = "UPDATE `other_assets` SET `booking_status` = '$booking_status' WHERE `assetID`='$assetID'";

    $result_booking_status = Query( $update_asset_sql);
    confirm( $result_booking_status);       

    $result_admin_activities = Query($sql_admin_activities);
    confirm($result_admin_activities);

     $result_other_asset = Query($sql_other_asset);
    confirm($result_other_asset);

    $result_other_asset2 = Query($sql_other_asset2);
    confirm($result_other_asset2);
    header('location: booked-other-assets?register_success');
  }

}

//UPDATE  Booking Ticket Details
if(isset($_POST['update_booking_ticket']))
  { 
    $bookingID = $_POST['bookingID'];
    $firearm_name = $_POST['firearm_name'];
    $quantity_issued = $_POST['quantity_issued'];
    $returns = $_POST['returns'];
    $firearm_class = $_POST['firearm_class'];
    $firearm_state = $_POST['firearm_state'];
    $booking_time = $_POST['booking_time'];
    $armourer_issuer = $_POST['armourer_issuer'];
    $to_officer = $_POST['to_officer'];
    $duty_location = $_POST['duty_location'];
    $duty_duration = $_POST['duty_duration'];
    $duty_type = $_POST['duty_type'];
    // $firearm_image = $_POST['firearm_image'];
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    $officerID = $_POST['officerID'];
    $officer_image = $_POST['officer_image'];
    $gps_armoury_email = $_POST['gps_armoury_email'];
    $officer_email = $_POST['officer_email'];
    $ammunition_name = $_POST['ammunition_name'];
    $number_of_rounds = $_POST['number_of_rounds'];
    $comment = $_POST['comment'];
    $action_taken ='Updated Booking Ticket-GPSA-#'.$_POST['bookingID'].' [ '.$firearm_name.' ]';
    $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
    $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
    $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);
  
  


  if(empty($duty_location)|| empty($duty_type) || empty($firearm_name) || empty($number_of_rounds))
   {
    
     header('location: update-booking?update_error');
    // echo "Error updating booking history";
    } 
    else{

      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

    $sql_update_booking="UPDATE `bookings` SET `bookingID`='$bookingID',`officerID`='$officerID', 
    `booking_time`='$booking_time',
    `armourer_issuer`='$armourer_issuer',`officer_image`='$officer_image',`to_officer`='$to_officer',
   `firearm_name`='$firearm_name',`firearm_class`='$firearm_class',
    `quantity_issued`='$quantity_issued',`firearm_state`='$firearm_state',`ammunition_name`='$ammunition_name',
    `number_of_rounds`='$number_of_rounds',`duty_type`='$duty_type',`duty_location`='$duty_location',`duty_duration`='$duty_duration',
    `duty_duration`='$duty_duration',`returns`='$returns',`comment`='$comment'  WHERE `bookingID` = '$bookingID'";

                
    
        $result_admin_activities = Query($sql_admin_activities);
        confirm($result_admin_activities);

        $result_update_booking = Query($sql_update_booking);
        confirm($result_update_booking);
        header('location:booked-firearms?update_success');
        
  }
}


//UPDATE  Ammo Booking Ticket Details
if(isset($_POST['update-ammo-booking-ticket']))
  { 
    $book_ammoID = $_POST['book_ammoID'];
    $quantity_issued = $_POST['quantity_issued'];
    $ammo_returns = $_POST['ammo_returns'];
    $booking_time = $_POST['booking_time'];
    $armourer_issuer = $_POST['armourer_issuer'];
    $to_officer = $_POST['to_officer'];
    $duty_location = $_POST['duty_location'];
    $duty_type = $_POST['duty_type'];
    $duty_duration= $_POST['duty_duration'];
    // $firearm_image = $_POST['firearm_image'];
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    $officerID = $_POST['officerID'];
    $officer_image = $_POST['officer_image'];
    $gps_armoury_email = $_POST['gps_armoury_email'];
    $officer_email = $_POST['officer_email'];
    $ammo_name = $_POST['ammo_name'];
    $ammo_rounds = $_POST['ammo_rounds'];
    $ammo_comment = $_POST['ammo_comment'];
    $action_taken ='Updated Ammo Booking Ticket-GPSA-#'.$book_ammoID.' '.$to_officer.' '.$ammo_name.' [ '.$ammo_rounds.' ]';  
    $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
    $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
    $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);
  


  if(empty($duty_location)|| empty($duty_type) || empty($ammo_name) || empty($ammo_rounds))
   {
    
     header('location: update-ammo-booking?update_error');
    // echo "Error updating booking history";
    } 
    else{

      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

      $sql_update_ammo_booking="UPDATE `ammo_bookings` SET `book_ammoID`='$book_ammoID',`officerID`='$officerID',
      `armourer_issuer`='$armourer_issuer',`officer_image`='$officer_image',`to_officer`='$to_officer',
      `booking_time`='$booking_time',`ammo_name`='$ammo_name',`ammo_rounds`='$ammo_rounds',
      `duty_type`='$duty_type',`duty_location`='$duty_location',`duty_duration`='$duty_duration',`ammo_returns`='$ammo_returns',
      `ammo_comment`='$ammo_comment'  WHERE `book_ammoID` = '$book_ammoID'";

        $result_admin_activities = Query($sql_admin_activities);
        confirm($result_admin_activities);

        $result_update_ammo_booking = Query($sql_update_ammo_booking);
        confirm($result_update_ammo_booking);
        header('location:booked-ammo?update_success');
        
  }
}


//UPDATE  Asset Booking Ticket Details
if(isset($_POST['update-asset-booking-ticket']))
  { 
    $bookAssetID = $_POST['bookAssetID'];
    $asset_name = $_POST['asset_name'];
    $asset_quantity = $_POST['asset_quantity'];
    $asset_returns = $_POST['asset_returns'];
    $booking_time = $_POST['booking_time'];
    $armourer_issuer = $_POST['armourer_issuer'];
    $to_officer = $_POST['to_officer'];
    $duty_location = $_POST['duty_location'];
    $duty_type = $_POST['duty_type'];
    $duty_duration= $_POST['duty_duration'];
    // $firearm_image = $_POST['firearm_image'];
    $officerID = $_POST['officerID'];
    $officer_image = $_POST['officer_image'];
    $gps_armoury_email = $_POST['gps_armoury_email'];
    $officer_email = $_POST['officer_email'];
    $asset_comment = $_POST['asset_comment'];
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    $action_taken ='Updated Asset Booking Ticket-GPSA-#'.$bookAssetID.' '.$to_officer.' '.$asset_name.' [ '.$asset_quantity.' ]';  
    $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
    $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
    $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);
  


  if(empty($duty_location)|| empty($duty_type) || empty($asset_name) || empty($asset_quantity))
   {
    
    //  header('location: update-asset-booking?update_error');
      echo "Error updating booking history";
    } 
    else{

      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

      $sql_update_asset_booking="UPDATE `asset_bookings` SET `bookAssetID`='$bookAssetID',`officerID`='$officerID',
      `armourer_issuer`='$armourer_issuer',`officer_image`='$officer_image',`to_officer`='$to_officer',
      `booking_time`='$booking_time',`asset_name`='$asset_name',`asset_quantity`='$asset_quantity',
      `duty_type`='$duty_type',`duty_location`='$duty_location',`duty_location`='$duty_location',`duty_duration`='$duty_duration',`asset_returns`='$asset_returns',
      `asset_comment`='$asset_comment'  WHERE `bookAssetID` = '$bookAssetID'";

        $result_admin_activities = Query($sql_admin_activities);
        confirm($result_admin_activities);

        $result_update_asset_booking = Query($sql_update_asset_booking);
        confirm($result_update_asset_booking);
        header('location:booked-other-assets?update_success');
        
  }
}

        

//UPDATE  firearmsBook
if(isset($_POST['update-firearm']))
  { 
    $firearmID=$_POST['firearmID'];
    $firearm_class=$_POST['firearm_class'];
    // $firearm_image=$_POST['firearm_image'];
    $firearm_name=$_POST['firearm_name'];
    $firearm_serial_no=$_POST['firearm_serial_no'];
    $firearm_type=$_POST['firearm_type'];
    $firearm_state=$_POST['firearm_state'];
    $quantity=$_POST['quantity'];
    $firearm_capacity = $_POST['firearm_capacity'];
    $firearm_caliber = $_POST['firearm_caliber'];
    $firearm_weight = $_POST['firearm_weight'];
    $firearm_length = $_POST['firearm_length'];
    $firearm_height = $_POST['firearm_height'];
    $firearm_width = $_POST['firearm_width'];
    $firearm_barrel = $_POST['firearm_barrel'];
    $firearm_trigger_type = $_POST['firearm_trigger_type'];
    $firearm_trigger_action = $_POST['firearm_trigger_action'];
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    
    $armourer_admin_name = $_POST['armourer_admin_name'];
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];
    $action_taken ='Updated a Firearm [ '.$firearm_serial_no.' '.$firearm_name.' ]';


    $firearm_image = $_FILES['firearm_image'];
    $firearm_image_name =$_FILES['firearm_image']['name'];
    $firearm_image_tmp =$_FILES['firearm_image']['tmp_name'];
    $firearm_image_size =$_FILES['firearm_image']['size'];
    $firearm_image_error =$_FILES['firearm_image']['error'];
    $firearm_image_type =$_FILES['firearm_image']['type'];
    $firearm_image_ext = explode('.', $firearm_image_name);
    $firearm_imageActual_ext = strtolower(end($firearm_image_ext));
    $firearm_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");


  if(in_array($firearm_imageActual_ext, $firearm_image_allowed)){
    
    if($firearm_image_error === 0){ 

             if($firearm_image_size < 5000000){ 

                if( empty($firearm_type) || empty($firearm_state) || empty($firearm_class) || empty($firearm_name) ||
                empty($firearm_serial_no)) {

                  header('location: assets-weapon?blank_error'); 
                
                }else{
             

                  $firearm_image_name_new = uniqid('', true).".".$firearm_imageActual_ext;
                  $fileDestination = "assets/images/firearm_images/".$firearm_image_name_new;
                  move_uploaded_file($firearm_image_tmp, $fileDestination);
                  $firearm_image = $firearm_image_name_new;

                  $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
                  `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
                    VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

                  $sql_update_firearms = "UPDATE `firearms` SET `firearmID`='$firearmID',
                  `firearm_serial_no`='$firearm_serial_no',
                  `firearm_type`='$firearm_type',`firearm_name`='$firearm_name',`firearm_caliber`='$firearm_caliber',
                  `firearm_capacity`='$firearm_capacity',`firearm_weight`='$firearm_weight',`firearm_length`='$firearm_length',
                  `firearm_width`='$firearm_width',`firearm_barrel`='$firearm_barrel',`firearm_trigger_type`='$firearm_trigger_type',
                  `firearm_trigger_action`='$firearm_trigger_action',`quantity`='$quantity',`firearm_class`='$firearm_class',
                  `firearm_state`='$firearm_state',`firearm_image`='$firearm_image' 
                  WHERE `firearmID` = '$firearmID'";
                        
                
                    $result_admin_activities = Query($sql_admin_activities);
                    confirm($result_admin_activities);

                   $result_update_firearms = Query($sql_update_firearms);
                   confirm($result_update_firearms);

                      // echo 'Registered Successfully';
                    header('location: assets-weapon?update_success');
                        }
             }else{
               header('location: assets-weapon?size_error');
             }

    }else{
      header('location: assets-weapon?file_error');
    }

  }else{
    header('location: assets-weapon?allow_error');

  }
  }


//UPDATE  Ammunition
if(isset($_POST['update-ammo']))
  { 
    $ammoID=$_POST['ammoID'];
    $ammo_name=$_POST['ammo_name'];
    $ammo_serial_no=$_POST['ammo_serial_no'];
    $ammo_type=$_POST['ammo_type'];
    $ammo_application=$_POST['ammo_application'];
    $ammo_rounds=$_POST['ammo_rounds'];
    $grain_weight=$_POST['grain_weight'];

    $armourer_admin_name = $_POST['armourer_admin_name'];
    $action_taken = 'Updated an Ammo ['.$_POST['ammo_name'].' ( '.$_POST['ammo_rounds'].' ) ]';
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];

    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    $ammo_image = $_FILES['ammo_image'];
    $ammo_image_name =$_FILES['ammo_image']['name'];
    $ammo_image_tmp =$_FILES['ammo_image']['tmp_name'];
    $ammo_image_size =$_FILES['ammo_image']['size'];
    $ammo_image_error =$_FILES['ammo_image']['error'];
    $ammo_image_type =$_FILES['ammo_image']['type'];
    $ammo_image_ext = explode('.', $ammo_image_name);
    $ammo_imageActual_ext = strtolower(end($ammo_image_ext));
    $ammo_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");


  if(in_array($ammo_imageActual_ext, $ammo_image_allowed)){
    
    if($ammo_image_error === 0){ 

             if($ammo_image_size < 5000000){ 

                if( empty($ammo_type) ||  empty($ammo_name) || empty($ammo_serial_no) || empty($ammo_rounds)) {

                  header('location: ammunition?blank_error'); 
                
                }else{
             

                  $ammo_image_name_new = uniqid('', true).".".$ammo_imageActual_ext;
                  $fileDestination = "assets/images/ammo_images/".$ammo_image_name_new;
                  move_uploaded_file($ammo_image_tmp, $fileDestination);
                  $ammo_image = $ammo_image_name_new;

                  $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
                  `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
                    VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

                  $sql_update_ammo = "UPDATE `ammunitions` SET `ammoID`='$ammoID',`ammo_image`='$ammo_image',
                  `ammo_serial_no`='$ammo_serial_no',`ammo_type`='$ammo_type',`ammo_name`='$ammo_name',
                  `ammo_application`='$ammo_application',`ammo_rounds`='$ammo_rounds',`grain_weight`='$grain_weight' WHERE 
                  `ammoID` = '$ammoID'";

                 
                  $result_admin_activities = Query($sql_admin_activities);
                  confirm($result_admin_activities);
                  

                   $result_update_ammo = Query($sql_update_ammo);
                   confirm($result_update_ammo);

                      // echo 'Registered Successfully';
                    header('location:ammunition?update_success');
                        }
             }else{
               header('location:ammunition?size_error');
             }

    }else{
      header('location: ammunition?file_error');
    }

  }else{
       header('location: ammunition?allow_error');
      //  echo "Error Occurred";
  }
  }


  

//UPDATE  Other Assets
if(isset($_POST['update-asset']))
{ 
  $assetID=$_POST['assetID'];
  $asset_name=$_POST['asset_name'];
  $asset_serial_no=$_POST['asset_serial_no'];
  $asset_quantity=$_POST['asset_quantity'];

  $armourer_admin_name = $_POST['armourer_admin_name'];
  $action_taken ='Updated an Asset(s) [ '.$_POST['asset_name'] .' ( '.$_POST['asset_quantity'].' ) ]';
  $user_role = $_POST['user_role'];
  $adminID=$_POST['adminID'];

  $booking_check ="No";
    $een_status = "Not";
    $bookings = "Inventory"; 
  $asset_image = $_FILES['asset_image'];
  $asset_image_name =$_FILES['asset_image']['name'];
  $asset_image_tmp =$_FILES['asset_image']['tmp_name'];
  $asset_image_size =$_FILES['asset_image']['size'];
  $asset_image_error =$_FILES['asset_image']['error'];
  $asset_image_type =$_FILES['asset_image']['type'];
  $asset_image_ext = explode('.', $asset_image_name);
  $asset_imageActual_ext = strtolower(end($asset_image_ext));
  $asset_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");


if(in_array($asset_imageActual_ext, $asset_image_allowed)){
  
  if($asset_image_error === 0){ 

           if($asset_image_size < 5000000){ 

              if(empty($asset_name) || empty($asset_serial_no) || empty($asset_quantity)) {

                header('location: assets-other?blank_error'); 
              
              }else{
          
                $asset_image_name_new = uniqid('', true).".".$asset_imageActual_ext;
                $fileDestination = "assets/images/asset_images/".$asset_image_name_new;
                move_uploaded_file($asset_image_tmp, $fileDestination);
                $asset_image = $asset_image_name_new;

                $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
                `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
                  VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

                $sql_update_asset = "UPDATE `other_assets` SET `assetID`='$assetID',`asset_image`='$asset_image',
                `asset_serial_no`='$asset_serial_no',`asset_name`='$asset_name',`asset_quantity`='$asset_quantity'
                 WHERE `assetID` = '$assetID'";

                   $result_admin_activities = Query($sql_admin_activities);
                   confirm($result_admin_activities);

                 $result_update_asset = Query($sql_update_asset);
                 confirm($result_update_asset);

                    // echo 'Registered Successfully';
                   header('location:assets-other?update_success');
                      }
           }else{
             header('location:assets-other?size_error');
           }

  }else{
     header('location: assets-other?file_error');
      //  echo "Error Occurred";
  }

}else{
    header('location: assets-other?allow_error');
 
}
}




//UPDATE Faulty Weapons
if(isset($_POST['update-faulty-firearm']))
  { 
    $faulty_weaponID=$_POST['faulty_weaponID'];
    $faulty_firearm_class=$_POST['faulty_firearm_class'];
    // $faulty_firearm_image=$_POST['faulty_firearm_image'];
    $faulty_firearm_name=$_POST['faulty_firearm_name'];
    $faulty_firearm_serial_no=$_POST['faulty_firearm_serial_no'];
    $faulty_firearm_type=$_POST['faulty_firearm_type'];

    $armourer_admin_name = $_POST['armourer_admin_name'];
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];
    $action_taken = 'Updated a Faulty Firearm [ '.$faulty_firearm_serial_no.' '.$faulty_firearm_name.' ]';
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    $faulty_firearm_image = $_FILES['faulty_firearm_image'];
    $faulty_firearm_image_name =$_FILES['faulty_firearm_image']['name'];
    $faulty_firearm_image_tmp =$_FILES['faulty_firearm_image']['tmp_name'];
    $faulty_firearm_image_size =$_FILES['faulty_firearm_image']['size'];
    $faulty_firearm_image_error =$_FILES['faulty_firearm_image']['error'];
    $faulty_firearm_image_type =$_FILES['faulty_firearm_image']['type'];
    $faulty_firearm_image_ext = explode('.', $faulty_firearm_image_name);
    $faulty_firearm_imageActual_ext = strtolower(end($faulty_firearm_image_ext));
    $faulty_firearm_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");
  
    if(in_array($faulty_firearm_imageActual_ext, $faulty_firearm_image_allowed)){
  
      if($faulty_firearm_image_error === 0){ 
    
               if($faulty_firearm_image_size < 5000000){ 


  if( empty($faulty_firearm_type) || empty($faulty_firearm_class) || empty($faulty_firearm_name) 
  || empty($faulty_firearm_serial_no))
   {
      header('location: faulty-weapon?update_error');
    } 
    else{
          $faulty_firearm_image_name_new = uniqid('', true).".".$faulty_firearm_imageActual_ext;
          $fileDestination = "assets/images/faulty_firearm_images/".$faulty_firearm_image_name_new;
          move_uploaded_file($faulty_firearm_image_tmp, $fileDestination);
          $faulty_firearm_image = $faulty_firearm_image_name_new;

          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
            VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

            $result_admin_activities = Query($sql_admin_activities);
            confirm($result_admin_activities);

          $sql_update_faulty_weapon="UPDATE `faulty_weapons` SET `faulty_weaponID`='$faulty_weaponID',`faulty_firearm_image`='$faulty_firearm_image',
          `faulty_firearm_serial_no`='$faulty_firearm_serial_no',`faulty_firearm_type`='$faulty_firearm_type',`faulty_firearm_name`='$faulty_firearm_name',
          `faulty_firearm_class`='$faulty_firearm_class'  WHERE `faulty_weaponID` = '$faulty_weaponID'";
            
            $result_update_faulty_weapon = Query($sql_update_faulty_weapon);
            confirm($result_update_faulty_weapon);
        
         header('location:faulty-weapon?update_success');
  }
}else{
  header('location:faulty-weapon?size_error');
}

}else{
header('location: faulty-weapon?file_error');
//  echo "Error Occurred";
}

}else{
header('location: faulty-weapon?allow_error');

}
}


//UPDATE Faulty Ammo
if(isset($_POST['update-faulty-ammo']))
  { 
    $faulty_ammoID=$_POST['faulty_ammoID'];
    $faulty_ammo_name=$_POST['faulty_ammo_name'];
    $faulty_ammo_serial_no=$_POST['faulty_ammo_serial_no'];
    $faulty_ammo_type=$_POST['faulty_ammo_type'];
    $faulty_ammo_quantity=$_POST['faulty_ammo_quantity'];
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    $armourer_admin_name = $_POST['armourer_admin_name'];
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];
    $action_taken = 'Updated a Faulty Ammo [ '.$faulty_ammo_serial_no.' '.$faulty_ammo_name.' ]';

    $faulty_ammo_image = $_FILES['faulty_ammo_image'];
    $faulty_ammo_image_name =$_FILES['faulty_ammo_image']['name'];
    $faulty_ammo_image_tmp =$_FILES['faulty_ammo_image']['tmp_name'];
    $faulty_ammo_image_size =$_FILES['faulty_ammo_image']['size'];
    $faulty_ammo_image_error =$_FILES['faulty_ammo_image']['error'];
    $faulty_ammo_image_type =$_FILES['faulty_ammo_image']['type'];
    $faulty_ammo_image_ext = explode('.', $faulty_ammo_image_name);
    $faulty_ammo_imageActual_ext = strtolower(end($faulty_ammo_image_ext));
    $faulty_ammo_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");
  
    if(in_array($faulty_ammo_imageActual_ext, $faulty_ammo_image_allowed)){
  
      if($faulty_ammo_image_error === 0){ 
    
               if($faulty_ammo_image_size < 5000000){ 


  if( empty($faulty_ammo_type) ||  empty($faulty_ammo_name) || empty($faulty_ammo_serial_no))
   {
      header('location: faulty-ammo?update_error');
    } 
    else{
          $faulty_ammo_image_name_new = uniqid('', true).".".$faulty_ammo_imageActual_ext;
          $fileDestination = "assets/images/faulty_ammo_images/".$faulty_ammo_image_name_new;
          move_uploaded_file($faulty_ammo_image_tmp, $fileDestination);
          $faulty_ammo_image = $faulty_ammo_image_name_new;

          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
            VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

            $result_admin_activities = Query($sql_admin_activities);
            confirm($result_admin_activities);

          $sql_update_faulty_ammo="UPDATE `faulty_ammo` SET `faulty_ammoID`='$faulty_ammoID',`faulty_ammo_image`='$faulty_ammo_image',
          `faulty_ammo_serial_no`='$faulty_ammo_serial_no',`faulty_ammo_type`='$faulty_ammo_type',`faulty_ammo_name`='$faulty_ammo_name',
          `faulty_ammo_quantity`='$faulty_ammo_quantity'  WHERE `faulty_ammoID` = '$faulty_ammoID'";
            
            $result_update_faulty_ammo = Query($sql_update_faulty_ammo);
            confirm($result_update_faulty_ammo);
        
         header('location:faulty-ammo?update_success');
          }
        }else{
          header('location:faulty-ammo?size_error');
        }

        }else{
        header('location: faulty-ammo?file_error');
        //  echo "Error Occurred";
        }

        }else{
        header('location: faulty-ammo?allow_error');

        }
        }


//UPDATE Faulty Ammo
if(isset($_POST['update-faulty-asset']))
  { 
    $faulty_assetID=$_POST['faulty_assetID'];
    $faulty_asset_name=$_POST['faulty_asset_name'];
    $faulty_asset_quantity=$_POST['faulty_asset_quantity'];

    $armourer_admin_name = $_POST['armourer_admin_name'];
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];
    $action_taken = 'Updated a Faulty Asset [ '.$faulty_asset_name.' ( '.$faulty_asset_quantity.' ) ]';
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    $faulty_asset_image = $_FILES['faulty_asset_image'];
    $faulty_asset_image_name =$_FILES['faulty_asset_image']['name'];
    $faulty_asset_image_tmp =$_FILES['faulty_asset_image']['tmp_name'];
    $faulty_asset_image_size =$_FILES['faulty_asset_image']['size'];
    $faulty_asset_image_error =$_FILES['faulty_asset_image']['error'];
    $faulty_asset_image_type =$_FILES['faulty_asset_image']['type'];
    $faulty_asset_image_ext = explode('.', $faulty_asset_image_name);
    $faulty_asset_imageActual_ext = strtolower(end($faulty_asset_image_ext));
    $faulty_asset_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");
  
    if(in_array($faulty_asset_imageActual_ext, $faulty_asset_image_allowed)){
  
      if($faulty_asset_image_error === 0){ 
    
               if($faulty_asset_image_size < 5000000){ 


  if(empty($faulty_asset_name) || empty($faulty_asset_quantity))
   {
      header('location: faulty-assets?update_error');
    } 
    else{
          $faulty_asset_image_name_new = uniqid('', true).".".$faulty_asset_imageActual_ext;
          $fileDestination = "assets/images/faulty_asset_images/".$faulty_asset_image_name_new;
          move_uploaded_file($faulty_asset_image_tmp, $fileDestination);
          $faulty_asset_image = $faulty_asset_image_name_new;

          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
            VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

            $result_admin_activities = Query($sql_admin_activities);
            confirm($result_admin_activities);

          $sql_update_faulty_asset="UPDATE `faulty_asset` SET `faulty_assetID`='$faulty_assetID',`faulty_asset_image`='$faulty_asset_image',
          `faulty_asset_name`='$faulty_asset_name', `faulty_asset_quantity` = '$faulty_asset_quantity'  WHERE `faulty_assetID` = '$faulty_assetID'";
            
            $result_update_faulty_asset = Query($sql_update_faulty_asset);
            confirm($result_update_faulty_asset);
        
         header('location:faulty-assets?update_success');
  }
}else{
  header('location:faulty-assets?size_error');
}

}else{
header('location: faulty-assets?file_error');
//  echo "Error Occurred";
}

}else{
header('location: faulty-assets?allow_error');

}
}





// Returning firearm 

if(isset($_POST['returning-firearm']))
  { 
    $firearm_name = $_POST['firearm_name'];
    $quantity_issued = $_POST['quantity_issued'];
    $returns = $_POST['returns'];
    $firearm_class = $_POST['firearm_class'];
    $firearm_state = $_POST['firearm_state'];
    $booking_time = $_POST['booking_time'];
    $armourer_issuer = $_POST['armourer_issuer'];
    $to_officer = $_POST['to_officer'];
    $officer_image = $_POST['officer_image'];
    $duty_location = $_POST['duty_location'];
    $duty_type = $_POST['duty_type'];
    $ammo_state = $_POST['ammo_state'];
    $no_faulty_ammo  = $_POST['no_faulty_ammo'];
    // $firearm_image = $_POST['firearm_image'];
    $officerID = $_POST['officerID'];
    $firearmID = $_POST['firearmID'];
    $bookingID = $_POST['bookingID'];
    $ammoID = $_POST['ammoID'];
    // $total_ammo_rounds = $_POST['total_ammo_rounds'];
    $ammunition_name = $_POST['ammunition_name'];
    $ammo_returned = $_POST['ammo_returned'];
    $no_faulty_ammo = $_POST['no_faulty_ammo'];
    $ammo_state = $_POST['ammo_state'];
    $comment = $_POST['comment'];
    $booking_status ="Available";
    $armourer_admin_name = $_POST['armourer_admin_name'];
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];
    $returned_time =gmdate("l jS \of F Y h:i:s A");
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    $action_taken = 'Returned a Firearm [ '.$firearm_name.' With ('. $ammo_returned. ') rounds of Ammunition ]';

    

  if(empty($duty_location)||empty($firearm_state) ||  empty($returns) || empty($duty_type) || empty($firearm_class) 
  || empty($firearm_name) || empty($quantity_issued))
   {

      header('location:booked-firearms?returning_error');
    } 
    else{
      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
        VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";


        $sql_return_booking="UPDATE `bookings` SET `firearm_state`='$firearm_state',
        `ammo_returned`='$ammo_returned', `ammo_state`='$ammo_state', `no_faulty_ammo`='$no_faulty_ammo',
        `returns`='$returns',`comment`='$comment',`returned_time` = '$returned_time'
          WHERE `bookingID` = '$bookingID'";

        $update_firearm_sql = "UPDATE `firearms` SET `booking_status` = '$booking_status'
         WHERE `firearmID`='$firearmID'";

        $result_booking_status = Query( $update_firearm_sql);
        confirm( $result_booking_status);    

        $query = mysqli_query($connect_db,"SELECT * FROM `ammunitions` WHERE `ammoID`='$ammoID'")
        or die( mysqli_error($connect_db));
        while ($row = mysqli_fetch_array($query)) {
                $ammo_rounds = $row['ammo_rounds'];
                $_SESSION['ammo_rounds'] =  $ammo_rounds;
              }  

        $total_ammo_left = $ammo_rounds + $ammo_returned;

        $update_ammo_rounds_sql = "UPDATE `ammunitions` SET `ammo_rounds` = '$total_ammo_left'
         WHERE `ammoID`='$ammoID'";

        $result_ammo_status = Query( $update_ammo_rounds_sql);
        confirm( $result_ammo_status);

        $result_admin_activities = Query($sql_admin_activities);
        confirm($result_admin_activities);

        $result_return_booking = Query($sql_return_booking);
        confirm($result_return_booking);
        header('location:booked-firearms?return_success');
  }
}

// Returning firearm Not Return page

if(isset($_POST['not-returning-firearm']))
  { 
    $firearm_name = $_POST['firearm_name'];
    $quantity_issued = $_POST['quantity_issued'];
    $returns = $_POST['returns'];
    $firearm_class = $_POST['firearm_class'];
    $firearm_state = $_POST['firearm_state'];
    $booking_time = $_POST['booking_time'];
    $armourer_issuer = $_POST['armourer_issuer'];
    $to_officer = $_POST['to_officer'];
    $officer_image = $_POST['officer_image'];
    $duty_location = $_POST['duty_location'];
    $duty_type = $_POST['duty_type'];
    $ammo_state = $_POST['ammo_state'];
    $no_faulty_ammo  = $_POST['no_faulty_ammo'];
    // $firearm_image = $_POST['firearm_image'];
    $officerID = $_POST['officerID'];
    $firearmID = $_POST['firearmID'];
    $bookingID = $_POST['bookingID'];
    $ammoID = $_POST['ammoID'];
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    // $total_ammo_rounds = $_POST['total_ammo_rounds'];
    $ammunition_name = $_POST['ammunition_name'];
    $ammo_returned = $_POST['ammo_returned'];
    $no_faulty_ammo = $_POST['no_faulty_ammo'];
    $ammo_state = $_POST['ammo_state'];
    $comment = $_POST['comment'];
    $booking_status ="Available";
    $armourer_admin_name = $_POST['armourer_admin_name'];
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];
    $returned_time =gmdate("l jS \of F Y h:i:s A");

    $action_taken = 'Returned a Firearm [ '.$firearm_name.' With ('. $ammo_returned. ') rounds of Ammunition ]';

    

  if(empty($duty_location)||empty($firearm_state) ||  empty($returns) || empty($duty_type) || empty($firearm_class) 
  || empty($firearm_name) || empty($quantity_issued))
   {

      header('location:booked-firearms?returning_error');
    } 
    else{
      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
        VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

        $sql_return_booking="UPDATE `bookings` SET `firearm_state`='$firearm_state',
        `ammo_returned`='$ammo_returned', `ammo_state`='$ammo_state', `no_faulty_ammo`='$no_faulty_ammo',
        `returns`='$returns',`comment`='$comment',`returned_time` = '$returned_time'
         WHERE `bookingID` = '$bookingID'";

        $update_firearm_sql = "UPDATE `firearms` SET `booking_status` = '$booking_status'
         WHERE `firearmID`='$firearmID'";

        $result_booking_status = Query( $update_firearm_sql);
        confirm( $result_booking_status);    

        $query = mysqli_query($connect_db,"SELECT * FROM `ammunitions` WHERE `ammoID`='$ammoID'")
        or die( mysqli_error($connect_db));
        while ($row = mysqli_fetch_array($query)) {
                $ammo_rounds = $row['ammo_rounds'];
                $_SESSION['ammo_rounds'] =  $ammo_rounds;
                $total_ammo_left = $ammo_rounds + $ammo_returned;
                $total_ammo_left =  $_SESSION['total_ammo_left'];
                $_SESSION['total_ammo_left'] = $total_ammo_left;
              }  

              $_SESSION['total_ammo_left'] = $total_ammo_left;

        $update_ammo_rounds_sql = "UPDATE `ammunitions` SET `ammo_rounds` = '$total_ammo_left'
         WHERE `ammoID`='$ammoID'";

        $result_ammo_status = Query( $update_ammo_rounds_sql);
        confirm( $result_ammo_status);

        $result_admin_activities = Query($sql_admin_activities);
        confirm($result_admin_activities);

        $result_return_booking = Query($sql_return_booking);
        confirm($result_return_booking);
        header('location:not-returns-firearms?return_success');
  }
}


// Returning Firearm and Ammo for 

if(isset($_POST['returning-ammo']))
  { 
    $ammo_name = $_POST['ammo_name'];
    $ammo_returned = $_POST['ammo_returned'];
    $ammo_returns = $_POST['ammo_returns'];
    $booking_time = $_POST['booking_time'];
    $armourer_issuer = $_POST['armourer_issuer'];
    $to_officer = $_POST['to_officer'];
    $ammoID = $_POST['ammoID'];
    $officerID = $_POST['officerID'];
    $officer_image = $_POST['officer_image'];
    $duty_location = $_POST['duty_location'];
    $duty_type = $_POST['duty_type'];
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    // $firearm_image = $_POST['firearm_image'];
    $book_ammoID = $_POST['book_ammoID'];
   // $officer_image = $_POST['officer_image'];
    $ammo_comment = $_POST['ammo_comment'];
    $booking_status ="Available";
    $armourer_admin_name = $_POST['armourer_admin_name'];
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];
    $ammo_state = $_POST['ammo_state'];
    $no_faulty_ammo  = $_POST['no_faulty_ammo'];
    $action_taken = 'Returned an Ammo [ '.$ammo_name.'  ('. $ammo_returned. ') rounds of Ammunition ]';
   
    $returned_time =gmdate("l jS \of F Y h:i:s A");

  if(empty($duty_location)||empty($ammo_returned) ||  empty($ammo_returns) || empty($duty_type) 
  || empty($ammo_name) )
   {

      header('location:returns-ammo?returning_error');
    } 
    else{
      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

      $sql_return_ammo="UPDATE `ammo_bookings` SET `ammo_returned`='$ammo_returned',
      `ammo_state`='$ammo_state',`no_faulty_ammo`='$no_faulty_ammo',`ammo_comment`='$ammo_comment',
      `ammo_returns`='$ammo_returns', `returned_time`='$returned_time' WHERE  `book_ammoID` = '$book_ammoID'";

        $query = mysqli_query($connect_db,"SELECT * FROM `ammunitions` WHERE `ammoID`='$ammoID'")
        or die( mysqli_error($connect_db));
        while ($row = mysqli_fetch_array($query)) {
                $ammo_rounds = $row['ammo_rounds'];
                $_SESSION['ammo_rounds'] =  $ammo_rounds;
              }  

              $total_ammo_left = $total_ammo_rounds + $ammo_returned;


      $update_ammo_sql = "UPDATE `ammunitions` SET `ammo_rounds` = '$total_ammo_left', `booking_status` = '$booking_status' WHERE `ammoID`='$ammoID'";

      $result_booking_status = Query( $update_ammo_sql);
      confirm( $result_booking_status);    

      $result_admin_activities = Query($sql_admin_activities);
      confirm($result_admin_activities);

      $result_return_ammo = Query($sql_return_ammo);
      confirm($result_return_ammo);
      header('location:returns-ammo?return_success');
  }
}


// Returning Firearm and Ammo for 

if(isset($_POST['not-returning-ammo']))
  { 
    $ammo_name = $_POST['ammo_name'];
    $ammo_returned = $_POST['ammo_returned'];
    $ammo_returns = $_POST['ammo_returns'];
    $booking_time = $_POST['booking_time'];
    $armourer_issuer = $_POST['armourer_issuer'];
    $to_officer = $_POST['to_officer'];
    $ammoID = $_POST['ammoID'];
    $officerID = $_POST['officerID'];
    $officer_image = $_POST['officer_image'];
    $duty_location = $_POST['duty_location'];
    $duty_type = $_POST['duty_type'];
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    // $firearm_image = $_POST['firearm_image'];
    $book_ammoID = $_POST['book_ammoID'];
   // $officer_image = $_POST['officer_image'];
    $ammo_comment = $_POST['ammo_comment'];
    $booking_status ="Available";
    $armourer_admin_name = $_POST['armourer_admin_name'];
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];
    $ammo_state = $_POST['ammo_state'];
    $no_faulty_ammo  = $_POST['no_faulty_ammo'];
    $action_taken = 'Returned an Ammo [ '.$ammo_name.'  ('. $ammo_returned. ') rounds of Ammunition ]';
   
    $returned_time =gmdate("l jS \of F Y h:i:s A");

  if(empty($duty_location)||empty($ammo_returned) ||  empty($ammo_returns) || empty($duty_type) 
  || empty($ammo_name) )
   {

      header('location:returns-ammo?returning_error');
    } 
    else{
      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

      $sql_return_ammo="UPDATE `ammo_bookings` SET `ammo_returned`='$ammo_returned',
      `ammo_state`='$ammo_state',`no_faulty_ammo`='$no_faulty_ammo',`ammo_comment`='$ammo_comment',
      `ammo_returns`='$ammo_returns', `returned_time`='$returned_time' WHERE  `book_ammoID` = '$book_ammoID'";

        $query = mysqli_query($connect_db,"SELECT * FROM `ammunitions` WHERE `ammoID`='$ammoID'")
        or die( mysqli_error($connect_db));
        while ($row = mysqli_fetch_array($query)) {
                $ammo_rounds = $row['ammo_rounds'];
                $_SESSION['ammo_rounds'] =  $ammo_rounds;
              }  

              $total_ammo_left = $total_ammo_rounds + $ammo_returned;


      $update_ammo_sql = "UPDATE `ammunitions` SET `ammo_rounds` = '$total_ammo_left', `booking_status` = '$booking_status' WHERE `ammoID`='$ammoID'";

      $result_booking_status = Query( $update_ammo_sql);
      confirm( $result_booking_status);    

      $result_admin_activities = Query($sql_admin_activities);
      confirm($result_admin_activities);

      $result_return_ammo = Query($sql_return_ammo);
      confirm($result_return_ammo);
      header('location:not-returns-ammo?return_success');
  }
}



// Returning Asset for 

if(isset($_POST['returning-asset']))
  { 
    $asset_name = $_POST['asset_name'];
    $asset_quantity = $_POST['asset_quantity'];
    $asset_returns = $_POST['asset_returns'];
    $booking_time = $_POST['booking_time'];
    $armourer_issuer = $_POST['armourer_issuer'];
    $to_officer = $_POST['to_officer'];
    $officer_image = $_POST['officer_image'];
    $duty_location = $_POST['duty_location'];
    $duty_type = $_POST['duty_type'];
    $firearmID = $_POST['firearmID'];
    $officerID = $_POST['officerID'];
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    // $firearm_image = $_POST['firearm_image'];
    $bookAssetID = $_POST['bookAssetID'];
    $asset_state = $_POST['asset_state'];
    $no_faulty_asset = $_POST['no_faulty_asset'];
    $asset_comment = $_POST['ammo_comment'];
    $booking_status ="Available";
    $armourer_admin_name = $_POST['armourer_admin_name'];
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];
    $action_taken = 'Returned an Asset [ '.$asset_name.' ( Qty: '.$asset_quantity. ') ]';
    $returned_time =gmdate("l jS \of F Y h:i:s A");

  if(empty($duty_location)||empty($asset_quantity) ||  empty($asset_returns) || empty($duty_type) 
  || empty($asset_name) )
   {

      header('location:returns-assets?returning_error');
    } 
    else{

      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
        VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

        $sql_return_asset="UPDATE `asset_bookings` SET `bookAssetID`='$bookAssetID',`officerID`='$officerID',
        `booking_time`='$booking_time',`armourer_issuer`='$armourer_issuer',`officer_image`='$officer_image',
        `to_officer`='$to_officer',`asset_name`='$asset_name',`asset_quantity`='$asset_quantity',
         `asset_state`='$asset_state',`no_faulty_asset`='$no_faulty_asset',
        `duty_type`='$duty_type',`duty_location`='$duty_location',`asset_returns`='$asset_returns',
        `asset_comment`='$asset_comment', `returned_time`='$returned_time' WHERE `bookAssetID` = '$bookAssetID'";

        $update_asset_sql = "UPDATE `other_assets` SET `booking_status` = '$booking_status' WHERE `assetID`='$assetID'";

        $result_booking_status = Query( $update_asset_sql);
        confirm( $result_booking_status);    
      
        $result_admin_activities = Query($sql_admin_activities);
        confirm($result_admin_activities);

        $result_return_asset = Query($sql_return_asset);
        confirm($result_return_asset);
        header('location:returns-assets?return_success');
  }
}


if(isset($_POST['not-returning-asset']))
  { 
    $asset_name = $_POST['asset_name'];
    $asset_quantity = $_POST['asset_quantity'];
    $asset_returns = $_POST['asset_returns'];
    $booking_time = $_POST['booking_time'];
    $armourer_issuer = $_POST['armourer_issuer'];
    $to_officer = $_POST['to_officer'];
    $officer_image = $_POST['officer_image'];
    $duty_location = $_POST['duty_location'];
    $duty_type = $_POST['duty_type'];
    $firearmID = $_POST['firearmID'];
    $officerID = $_POST['officerID'];
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    // $firearm_image = $_POST['firearm_image'];
    $bookAssetID = $_POST['bookAssetID'];
    $asset_state = $_POST['asset_state'];
    $no_faulty_asset = $_POST['no_faulty_asset'];
    $asset_comment = $_POST['ammo_comment'];
    $booking_status ="Available";
    $armourer_admin_name = $_POST['armourer_admin_name'];
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];
    $action_taken = 'Returned an Asset [ '.$asset_name.' ( Qty: '.$asset_quantity. ') ]';
    $returned_time =gmdate("l jS \of F Y h:i:s A");

  if(empty($duty_location)||empty($asset_quantity) ||  empty($asset_returns) || empty($duty_type) 
  || empty($asset_name) )
   {
      header('location:returns-assets?returning_error');
    } 
    else{

      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

      $sql_return_asset="UPDATE `asset_bookings` SET `bookAssetID`='$bookAssetID',`officerID`='$officerID',
      `booking_time`='$booking_time',`armourer_issuer`='$armourer_issuer',`officer_image`='$officer_image',
      `to_officer`='$to_officer',`asset_name`='$asset_name',`asset_quantity`='$asset_quantity',
      `asset_state`='$asset_state',`no_faulty_asset`='$no_faulty_asset',
      `duty_type`='$duty_type',`duty_location`='$duty_location',`asset_returns`='$asset_returns',
      `asset_comment`='$asset_comment', `returned_time`='$returned_time' WHERE `bookAssetID` = '$bookAssetID'";

        $update_asset_sql = "UPDATE `other_assets` SET `booking_status` = '$booking_status' WHERE `assetID`='$assetID'";

        $result_booking_status = Query( $update_asset_sql);
        confirm( $result_booking_status);    
      
        $result_admin_activities = Query($sql_admin_activities);
        confirm($result_admin_activities);

        $result_return_asset = Query($sql_return_asset);
        confirm($result_return_asset);
        header('location:not-returns-assets?return_success');
  }
}
// Officer Returning bookings 


// Returning firearm 

if(isset($_POST['returning-firearm-officer']))
  { 
    $firearm_name = $_POST['firearm_name'];
    $quantity_issued = $_POST['quantity_issued'];
    $returns = $_POST['returns'];
    $firearm_class = $_POST['firearm_class'];
    $firearm_state = $_POST['firearm_state'];
    $booking_time = $_POST['booking_time'];
    $armourer_issuer = $_POST['armourer_issuer'];
    $to_officer = $_POST['to_officer'];
    $officer_image = $_POST['officer_image'];
    $duty_location = $_POST['duty_location'];
    $duty_type = $_POST['duty_type'];
    // $firearm_image = $_POST['firearm_image'];
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    $officerID = $_POST['officerID'];
    $firearmID = $_POST['firearmID'];
    $bookingID = $_POST['bookingID'];
    $no_faulty_ammo = $_POST['no_faulty_ammo'];
    $ammo_state = $_POST['ammo_state'];
    //$officer_image = $_POST['officer_image'];
    $ammunition_name = $_POST['ammunition_name'];
    $ammo_returned = $_POST['ammo_returned'];
    $comment = $_POST['comment'];
    $returned_time =gmdate("l jS \of F Y h:i:s A");
    $armourer_admin_name = $_POST['armourer_admin_name'];
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];
    $returned_time =gmdate("l jS \of F Y h:i:s A");

    $action_taken = 'Returned a Firearm [ '.$firearm_name.' With ('. $ammo_returned. ') rounds of Ammunition ]';
    $total_ammo_left = $total_ammo_rounds + $ammo_returned;

  if(empty($ammo_returned)||empty($firearm_state) ||  empty($returns) || empty($duty_type))
   {

      header('location:officers-booking?officerID='.$officerID.'&returning_error');
    } 
    else{
      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
        VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";


        $sql_return_booking="UPDATE `bookings` SET `firearm_state`='$firearm_state',
        `ammo_returned`='$ammo_returned',`ammo_state`='$ammo_state',`no_faulty_ammo`='$no_faulty_ammo',
        `returns`='$returns',`comment`='$comment', 
        `returned_time` = '$returned_time'  WHERE `bookingID` = '$bookingID'";
      
        $update_firearm_sql = "UPDATE `firearms` SET `booking_status` = '$booking_status' WHERE `firearmID`='$firearmID'";

        $update_ammo_sql = "UPDATE `ammunitions` SET `ammo_rounds` = '$total_ammo_left', `booking_status` = '$booking_status' WHERE `ammoID`='$ammoID'";

        $result_booking_status = Query( $update_ammo_sql);
        confirm( $result_booking_status);    

        $result_booking_status = Query( $update_firearm_sql);
        confirm( $result_booking_status);   

        $result_admin_activities = Query($sql_admin_activities);
        confirm($result_admin_activities);

        $result_return_booking = Query($sql_return_booking);
        confirm($result_return_booking);
        header('location:officers-booking?officerID='.$officerID.'&return_success');
  }
}



// Returning Firearm and Ammo for 

if(isset($_POST['returning-ammo-officer']))
  { 
    $ammo_name = $_POST['ammo_name'];
    $ammo_returned = $_POST['ammo_returned'];
    $ammo_returns = $_POST['ammo_returns'];
    $booking_time = $_POST['booking_time'];
    $armourer_issuer = $_POST['armourer_issuer'];
    $to_officer = $_POST['to_officer'];
    $officer_image = $_POST['officer_image'];
    $duty_location = $_POST['duty_location'];
    $duty_type = $_POST['duty_type'];
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
    // $firearm_image = $_POST['firearm_image'];
    $officerID = $_POST['officerID'];
    $book_ammoID = $_POST['book_ammoID'];
    $no_faulty_ammo = $_POST['no_faulty_ammo'];
    $ammo_state = $_POST['ammo_state'];
   // $officer_image = $_POST['officer_image'];
    $ammo_comment = $_POST['ammo_comment'];
    $ammoID = $_POST['ammoID'];
    $armourer_admin_name = $_POST['armourer_admin_name'];
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];
    $action_taken = 'Returned an Ammo [ '.$ammo_name.'  ( '. $ammo_returned.' ) rounds of Ammunition ]';
    $total_ammo_left = $total_ammo_rounds + $ammo_returned;
    $returned_time =gmdate("l jS \of F Y h:i:s A");

  if(empty($ammo_returned) ||  empty($ammo_returns))
   {

      header('location:officers-booking?officerID='.$officerID.'&returning_error');
    } 
    else{
      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

     $sql_return_ammo="UPDATE `ammo_bookings` SET `ammo_returned`='$ammo_returned',
     `ammo_state`='$ammo_state',`no_faulty_ammo`='$no_faulty_ammo',`ammo_comment`='$ammo_comment',
    `ammo_returns`='$ammo_returns', `returned_time`='$returned_time' WHERE  `book_ammoID` = '$book_ammoID'";

      $update_ammo_sql = "UPDATE `ammunitions` SET `ammo_rounds` = '$total_ammo_left',
       `booking_status` = '$booking_status' WHERE `ammoID`='$ammoID'";

      $result_booking_status = Query( $update_ammo_sql);
      confirm( $result_booking_status);    
     
      $result_admin_activities = Query($sql_admin_activities);
      confirm($result_admin_activities);

      $result_return_ammo = Query($sql_return_ammo);
      confirm($result_return_ammo);
      header('location:officers-booking?officerID='.$officerID.'&return_success');
  }
}


// Returning Asset 

if(isset($_POST['returning-asset-officer']))
  { 
    $asset_name = $_POST['asset_name'];
    $asset_quantity = $_POST['asset_quantity'];
    $asset_returns = $_POST['asset_returns'];
    $booking_time = $_POST['booking_time'];
    $armourer_issuer = $_POST['armourer_issuer'];
    $to_officer = $_POST['to_officer'];
    $officer_image = $_POST['officer_image'];
    $duty_location = $_POST['duty_location'];
    $duty_type = $_POST['duty_type'];
    // $firearm_image = $_POST['firearm_image'];
    $officerID = $_POST['officerID'];
    $bookAssetID = $_POST['bookAssetID'];
   // $officer_image = $_POST['officer_image'];
    $asset_comment = $_POST['asset_comment'];
    $asset_state = $_POST['asset_state'];
    $no_faulty_asset = $_POST['no_faulty_asset'];
    $assetID = $_POST['assetID'];
    $armourer_admin_name = $_POST['armourer_admin_name'];
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];
    $action_taken = 'Returned an Asset [ '.$asset_name.' ( Qty: '.$asset_quantity. ') ]';
    $returned_time =gmdate("l jS \of F Y h:i:s A");
    $booking_check ="No";
    $seen_status = "Not";
    $bookings = "Inventory"; 
  if(empty($duty_location)||empty($asset_quantity) ||  empty($asset_returns) || empty($duty_type) 
  || empty($asset_name) )
   {

      header('location: officers-booking?officerID='.$officerID.'&returning_error');
    } 
    else{

      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
        VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

    $sql_return_asset="UPDATE `asset_bookings` SET `bookAssetID`='$bookAssetID',`officerID`='$officerID',
    `booking_time`='$booking_time',`armourer_issuer`='$armourer_issuer',`officer_image`='$officer_image',
    `to_officer`='$to_officer',`asset_name`='$asset_name',`asset_quantity`='$asset_quantity',
    `asset_state`='$asset_state',`no_faulty_asset`='$no_faulty_asset',
    `duty_type`='$duty_type',`duty_location`='$duty_location',`asset_returns`='$asset_returns',
    `asset_comment`='$asset_comment', `returned_time`='$returned_time' WHERE `bookAssetID` = '$bookAssetID'";

        $update_asset_sql = "UPDATE `other_assets` SET `booking_status` = '$booking_status' WHERE `assetID`='$assetID'";

        $result_booking_status = Query( $update_asset_sql);
        confirm( $result_booking_status);  
      
        $result_admin_activities = Query($sql_admin_activities);
        confirm($result_admin_activities);

        $result_return_asset = Query($sql_return_asset);
        confirm($result_return_asset);
        header('location:officers-booking?officerID='.$officerID.'&return_success');
  }
}


//Add Faulty Ammunition...........................................................................
if (isset($_POST['add_faulty_ammo'])) {
  // receive all input values from the form
  $faulty_ammo_serial_no =mysqli_real_escape_string($connect_db, $_POST['faulty_ammo_serial_no']);
  $faulty_ammo_type = mysqli_real_escape_string($connect_db, $_POST['faulty_ammo_type']);
  $faulty_ammo_name = mysqli_real_escape_string($connect_db, $_POST['faulty_ammo_name']);
  $faulty_ammo_quantity = mysqli_real_escape_string($connect_db, $_POST['faulty_ammo_quantity']);
  $faulty_ammo_comment = mysqli_real_escape_string($connect_db, $_POST['faulty_ammo_comment']);
  $faulty_type = mysqli_real_escape_string($connect_db, $_POST['faulty_type']);
  $ammoID = mysqli_real_escape_string($connect_db, $_POST['ammoID']);
  $total_ammo_rounds = mysqli_real_escape_string($connect_db, $_POST['total_ammo_rounds']);
  // $ammo_image =mysqli_real_escape_string($connect_db, $_POST['ammo_image']);
  // form validation: ensure that the form is correctly filled ...
  $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
  $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
  $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);
  $action_taken ='Added Faulty Ammo [ '.$faulty_ammo_serial_no.' '. $faulty_ammo_name.' ('. $faulty_ammo_type .' ) ]';
  // by adding (array_push()) corresponding error unto $errors array
  $booking_check ="No";
    $een_status = "Not";
    $bookings = "Inventory"; 
  $faulty_ammo_image = $_FILES['faulty_ammo_image'];
  $faulty_ammo_image_name =$_FILES['faulty_ammo_image']['name'];
  $faulty_ammo_image_tmp =$_FILES['faulty_ammo_image']['tmp_name'];
  $faulty_ammo_image_size =$_FILES['faulty_ammo_image']['size'];
  $faulty_ammo_image_error =$_FILES['faulty_ammo_image']['error'];
  $faulty_ammo_image_type =$_FILES['faulty_ammo_image']['type'];
  $faulty_ammo_image_ext = explode('.', $faulty_ammo_image_name);
  $faulty_ammo_imageActual_ext = strtolower(end($faulty_ammo_image_ext));
  $faulty_ammo_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");

  $total_ammo_left = $total_ammo_rounds - $faulty_ammo_quantity;

  if (in_array($faulty_ammo_imageActual_ext, $faulty_ammo_image_allowed)) {
    if ($faulty_ammo_image_error === 0) {
      if ($faulty_ammo_image_size < 50000000) {
        if(empty($faulty_ammo_serial_no) || empty($faulty_ammo_name) || empty($faulty_ammo_type) || empty($faulty_ammo_quantity)){

          header('location: add-faulty-ammo?blank_error');

        }else if(faulty_ammo_serial_no_exist($faulty_ammo_serial_no )){
                     
          header('location: add-faulty-ammo?serial_no_error');

        }else{ 
          $faulty_ammo_image_name_new = uniqid('', true).".".$faulty_ammo_imageActual_ext;
          $fileDestination = "assets/images/faulty_ammo_images/".$faulty_ammo_image_name_new;
          move_uploaded_file($faulty_ammo_image_tmp, $fileDestination);
          $faulty_ammo_image = $faulty_ammo_image_name_new;

                           
          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,`action_taken`, `user_role`, `booking_check`,`seen_status`,`bookings`)
          VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

          $sql_faulty_ammo="INSERT INTO `faulty_ammo`(`faulty_ammo_serial_no`, `faulty_ammo_type`,
           `faulty_ammo_name`, `faulty_ammo_quantity`,`faulty_type`, `faulty_ammo_image`,`faulty_ammo_comment`) VALUES 
            ('$faulty_ammo_serial_no','$faulty_ammo_type', '$faulty_ammo_name','$faulty_ammo_quantity','$faulty_type',
            '$faulty_ammo_image','$faulty_ammo_comment')";

          $sql_faulty_ammo2="INSERT INTO `faulty_ammo2`(`faulty_ammo_serial_no`, `faulty_ammo_type`,
          `faulty_ammo_name`, `faulty_ammo_quantity`,`faulty_type`, `faulty_ammo_image`,`faulty_ammo_comment`) VALUES 
            ('$faulty_ammo_serial_no','$faulty_ammo_type', '$faulty_ammo_name','$faulty_ammo_quantity','$faulty_type',
            '$faulty_ammo_image','$faulty_ammo_comment')";

            $update_ammo_sql = "UPDATE `ammunitions` SET `ammo_rounds` = '$total_ammo_left' WHERE `ammoID`='$ammoID'";

            $result_booking_status = Query( $update_ammo_sql);
            confirm( $result_booking_status); 

            $result_admin_activities = Query($sql_admin_activities);
            confirm($result_admin_activities);
                      
            $result_faulty_ammo = Query($sql_faulty_ammo);
            confirm($result_faulty_ammo);

            $result_faulty_ammo2 = Query($sql_faulty_ammo2);
            confirm($result_faulty_ammo2);

          header('location: faulty-ammo?register_success');
        }
        
      }else{
        header('location: add-faulty-ammo?size_error');
      }

    }else {
      header('location: add-faulty-ammo?file_error');
    }

  }else{
    header('location: add-faulty-ammo?allow_error');
  }
}

//Add Faulty Ammunition...........................................................................
if (isset($_POST['add_faulty_asset'])) {
  // receive all input values from the form
  $faulty_asset_name = mysqli_real_escape_string($connect_db, $_POST['faulty_asset_name']);
  $faulty_asset_quantity = mysqli_real_escape_string($connect_db, $_POST['faulty_asset_quantity']);
  $faulty_type = mysqli_real_escape_string($connect_db, $_POST['faulty_type']);
  $faulty_nature = mysqli_real_escape_string($connect_db, $_POST['faulty_nature']);
  $faulty_asset_comment = mysqli_real_escape_string($connect_db, $_POST['faulty_asset_comment']);
  $faulty_asset_serial_no = mysqli_real_escape_string($connect_db, $_POST['faulty_asset_serial_no']);
  // $asset_image =mysqli_real_escape_string($connect_db, $_POST['asset_image']);
  // form validation: ensure that the form is correctly filled ...
  $booking_check ="No";
    $een_status = "Not";
    $bookings = "Inventory"; 
  $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
  $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
  $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);
  $action_taken ='Added Faulty Asset [  '.$faulty_asset_serial_no.' '. $faulty_asset_name.' ('. $faulty_asset_quantity.' ) ]';
  // by adding (array_push()) corresponding error unto $errors array
  $faulty_asset_image = $_FILES['faulty_asset_image'];
  $faulty_asset_image_name =$_FILES['faulty_asset_image']['name'];
  $faulty_asset_image_tmp =$_FILES['faulty_asset_image']['tmp_name'];
  $faulty_asset_image_size =$_FILES['faulty_asset_image']['size'];
  $faulty_asset_image_error =$_FILES['faulty_asset_image']['error'];
  $faulty_asset_image_type =$_FILES['faulty_asset_image']['type'];
  $faulty_asset_image_ext = explode('.', $faulty_asset_image_name);
  $faulty_asset_imageActual_ext = strtolower(end($faulty_asset_image_ext));
  $faulty_asset_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");

  if (in_array($faulty_asset_imageActual_ext, $faulty_asset_image_allowed)) {
    if ($faulty_asset_image_error === 0) {
      if ($faulty_asset_image_size < 50000000) {
        if(empty($faulty_asset_name) || empty($faulty_asset_quantity)){

          header('location: add-faulty-assets?blank_error');

        }else if(faulty_asset_serial_no_exist($faulty_asset_serial_no )){
                     
          header('location: add-faulty-assets?serial_no_error');

        }else{
          $faulty_asset_image_name_new = uniqid('', true).".".$faulty_asset_imageActual_ext;
          $fileDestination = "assets/images/faulty_asset_images/".$faulty_asset_image_name_new;
          move_uploaded_file($faulty_asset_image_tmp, $fileDestination);
          $faulty_asset_image = $faulty_asset_image_name_new;

                           
          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,`action_taken`,`user_role`, `booking_check`,`seen_status`,`bookings`)
          VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

          $sql_faulty_asset="INSERT INTO `faulty_asset`(`faulty_asset_serial_no`,`faulty_asset_name`, `faulty_asset_quantity`,`faulty_type`, `faulty_nature`,
          `faulty_asset_image`,`faulty_asset_comment`) VALUES ('$faulty_asset_serial_no','$faulty_asset_name','$faulty_asset_quantity','$faulty_type','$faulty_nature',
          '$faulty_asset_image','$faulty_asset_comment')";

          $sql_faulty_asset2="INSERT INTO `faulty_asset2`(`faulty_asset_serial_no`,`faulty_asset_name`, `faulty_asset_quantity`, `faulty_type`, `faulty_nature`,
          `faulty_asset_image`,`faulty_asset_comment`) VALUES ('$faulty_asset_serial_no','$faulty_asset_name','$faulty_asset_quantity','$faulty_type','$faulty_nature',
          '$faulty_asset_image','$faulty_asset_comment')";

 
            $result_admin_activities = Query($sql_admin_activities);
            confirm($result_admin_activities);
                      
            $result_faulty_asset = Query($sql_faulty_asset);
            confirm($result_faulty_asset);

              $result_faulty_asset2 = Query($sql_faulty_asset2);
              confirm($result_faulty_asset2);

          header('location: faulty-assets?register_success');
        }
        
      }else{
        header('location: add-faulty-assets?size_error');
      }

    }else {
      header('location: add-faulty-assets?file_error');
    }

  }else{
    header('location: add-faulty-assets?allow_error');
  }
}

