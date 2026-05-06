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
//    function firearmID_exist($firearmID){
//     $sql = "SELECT * FROM bookings where firearmID='$firearmID'";
//     $result = Query($sql);
    
//     if(fetch_data($result))
//     {
//         return true;
//     }
//     else{
//         return false;
//     }
//  }


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
            $_SESSION['status'] = "Please, fill all the fields";
            $_SESSION['status_code'] = "error";
     
            header('location:received-messages');
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
            
            $_SESSION['status'] = "Please, fill all the fields";
            $_SESSION['status_code'] = "error";
           
            header('location: administrators');
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
              `action_taken`, `user_role`)
               VALUES ('$adminID_armourerID','$armourer_admin_name','$action_taken','$admin_armourer_user_role')";


              $result_admin_activities = Query($sql_admin_activities);
              confirm($result_admin_activities);

              $result_admin = Query($sql_admin);
              confirm($result_admin);

              $_SESSION['status'] = "Updated Successfully";
              $_SESSION['status_code'] = "success";
             
              header('location:administrators');

          }
         
        }else{
           $_SESSION['status'] = "Sorry..! the size of the file should be more than 5MB";         
           $_SESSION['status_code'] = "error";
          header('location: administrators');
        }
      }else{
                $_SESSION['status']=" Error Occurred whiles Uploading the file";         
                $_SESSION['status_code'] = "error";
        header('location: administrators');
      }

    }else{
      $_SESSION['status']="Sorry..! file extension does not supported";         
      $_SESSION['status_code'] = "error";
      header('location: administrators');
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
            
            $_SESSION['status'] = "Please, fill all the fields";
            $_SESSION['status_code'] = "error";
           
            header('location: armourers');
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
              `action_taken`, `user_role`)
               VALUES ('$adminID_armourerID','$armourer_admin_name','$action_taken','$admin_armourer_user_role')";


              $result_admin_activities = Query($sql_admin_activities);
              confirm($result_admin_activities);

              $result_admin = Query($sql_admin);
              confirm($result_admin);

              $_SESSION['status'] = "Updated Successfully";
              $_SESSION['status_code'] = "success";
             
              header('location:armourers');

          }
         
        }else{
           $_SESSION['status'] = "Sorry..! the size of the file should be more than 5MB";         
           $_SESSION['status_code'] = "error";
          header('location: armourers');
        }
      }else{
        $_SESSION['status']=" Error Occurred whiles Uploading the file";         
        $_SESSION['status_code'] = "error";
        header('location: armourers');
      }

    }else{
      $_SESSION['status']="Sorry..! file extension does not supported";         
      $_SESSION['status_code'] = "error";
      header('location: armourers');
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

                  $_SESSION['status'] = "Please, fill all the fields";
                  $_SESSION['status_code'] = "error";
                 
                  header('location: add-new-armourer');
                
                }else if($password_1 != $password_2){

                  $_SESSION['status']="Sorry...! Passwords not Match...";         
                  $_SESSION['status_code'] = "error";
                  header('location: add-new-armourer');
                }else if(service_no_exist($service_no)){

                $_SESSION['status']="Sorry...! Service Number Already Existing...";         
                 $_SESSION['status_code'] = "error";
                  header('location: add-new-armourer');
               
                  
                }else if(username_exist($username)){
                   
                  $_SESSION['status']="Sorry...! Username Already Existing...";         
                  $_SESSION['status_code'] = "error";
                  header('location: add-new-armourer');

                }else if(phone_number_exist($phone_number)){
                     
                  $_SESSION['status']="Sorry...! Phone Number Already Existing...";         
                  $_SESSION['status_code'] = "error";
                  header('location: add-new-armourer');
                }
                else if(email_exist($admin_email)){
                  $_SESSION['status']="Sorry...! Email Already Existing...";         
                  $_SESSION['status_code'] = "error";
                  header('location: add-new-armourer');
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
                  `armourer_admin_name`,  `action_taken`, `user_role`)
                   VALUES ('$adminID_armourerID','$armourer_admin_name','$action_taken','$user_role')";
                   

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
                       

                      $_SESSION['status']="Added Successfully";         
                      $_SESSION['status_code'] = "success";
                      header('location: armourers');
                        }
             }else{
                $_SESSION['status']=" Sorry..! the size of the file should be more than 5MB";         
                $_SESSION['status_code'] = "error";
              header('location: add-new-armourer');
             }

    }else{
                $_SESSION['status']=" Error Occurred whiles Uploading the file";         
                $_SESSION['status_code'] = "error";
      header('location: add-new-armourer');
    }

  }else{
    $_SESSION['status']="Sorry..! file extension does not supported";         
      $_SESSION['status_code'] = "error";
    header('location: add-new-armourer');
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

                  $_SESSION['status'] = "Please, fill all the fields";
                  $_SESSION['status_code'] = "error";
                 
                  header('location: add-new-admin');
                
                }else if($password_1 != $password_2){

                  $_SESSION['status']="Sorry...! Passwords not Match...";         
                  $_SESSION['status_code'] = "error";
                  header('location: add-new-admin');
                }
                else if(service_no_exist($service_no)){

                  $_SESSION['status']="Sorry...! Service Number Already Exist...";         
                  $_SESSION['status_code'] = "error";
                  header('location: add-new-admin');
                 
                    
                  }else if(username_exist($username)){
                     
                    $_SESSION['status']="Sorry...! Username Already Existing...";         
                    $_SESSION['status_code'] = "error";
                    header('location: add-new-admin');
  
                  }else if(phone_number_exist($phone_number)){
                       
                    $_SESSION['status']="Sorry...! Phone Number Already Existing...";         
                    $_SESSION['status_code'] = "error";
                    header('location: add-new-admin');
                  }
                  else if(email_exist($admin_email)){
                    $_SESSION['status']="Sorry...! Email Already Existing...";         
                    $_SESSION['status_code'] = "error";
                    header('location: add-new-admin');
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
                  `armourer_admin_name`,  `action_taken`,`user_role`)
                   VALUES ('$adminID_armourerID','$armourer_admin_name','$action_taken','$user_role')";

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
                       

                      $_SESSION['status']="Added Successfully";         
                      $_SESSION['status_code'] = "success";
                      header('location: administrators');
                        }
             }else{
              $_SESSION['status']=" Sorry..! the size of the file should be more than 5MB";         
              $_SESSION['status_code'] = "error";
              header('location: add-new-admin');
             }

    }else{
      $_SESSION['status']=" Error Occurred whiles Uploading the file";         
      $_SESSION['status_code'] = "error";
      header('location: add-new-admin');
    }

  }else{
    $_SESSION['status']="Sorry..! file extension does not supported";         
      $_SESSION['status_code'] = "error";
    header('location: add-new-admin');
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

          $_SESSION['status'] = "Please, fill all the fields";
            $_SESSION['status_code'] = "error";
         
            header('location: add-faulty-weapon');

        }else if(faulty_firearm_serial_no_exist($faulty_firearm_serial_no )){
                     
          $_SESSION['status']="Sorry...! Faulty firearm already exist";         
          $_SESSION['status_code'] = "error";
          header('location: add-faulty-weapon');

        } else{
          $faulty_firearm_image_name_new = uniqid('', true).".".$faulty_firearm_imageActual_ext;
          $fileDestination = "assets/images/faulty_firearm_images/".$faulty_firearm_image_name_new;
          move_uploaded_file($faulty_firearm_image_tmp, $fileDestination);
          $faulty_firearm_image = $faulty_firearm_image_name_new;

          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,  `action_taken`, `user_role`)
          VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";
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

             

          $_SESSION['status']="Added Successfully";         
          $_SESSION['status_code'] = "success";
          header('location: faulty-weapon');
        }
        
      }else{
        $_SESSION['status']=" Sorry..! the size of the file should be more than 5MB";         
        $_SESSION['status_code'] = "error";
        header('location: add-faulty-weapon');
      }

    }else {
      $_SESSION['status']=" Error Occurred whiles Uploading the file";         
      $_SESSION['status_code'] = "error";
      header('location: add-faulty-weapon');
    }

  }else{
    $_SESSION['status']="Sorry..! file extension does not supported";         
      $_SESSION['status_code'] = "error";
    header('location: add-faulty-weapon');
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
        empty($officer_email)){
          
          $_SESSION['status'] = "Please, fill all the fields";
            $_SESSION['status_code'] = "error";
         
            header('location: add-new-officer');
        }
        else if(officer_service_no_exist($officer_service_no)){

          $_SESSION['status']="Sorry...! Service Number Already Exist";         
          $_SESSION['status_code'] = "error";
          header('location: add-new-officer');

        }
        else if(phone_no_exist($phone_no)){

          $_SESSION['status']="Sorry...! Phone Number Already Existing...";         
          $_SESSION['status_code'] = "error";
          header('location: add-new-officer');

        } else if(officer_email_exist($officer_email)){

          $_SESSION['status']="Sorry...! Email Already Existing...";         
          $_SESSION['status_code'] = "error";
          header('location: add-new-officer');

        } else{
          $officer_image_name_new = uniqid('', true).".".$officer_imageActual_ext;
          $fileDestination = "assets/images/officer_images/".$officer_image_name_new;
          move_uploaded_file($officer_image_tmp, $fileDestination);
          $officer_image = $officer_image_name_new;

          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,  `action_taken`, `user_role`)
          VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

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

             
          $_SESSION['status']="Added Successfully";         
          $_SESSION['status_code'] = "success";
          header('location: officers-list?Rank='.$rank.'');
        }

      }else{
                $_SESSION['status']=" Sorry..! the size of the file should be more than 5MB";         
                $_SESSION['status_code'] = "error";
        header('location: add-new-officer');
      }

    }else{
      $_SESSION['status']=" Error Occurred whiles Uploading the file";         
      $_SESSION['status_code'] = "error";
      header('location: add-new-officer');
    }

  }else{
    $_SESSION['status']="Sorry..! file extension does not supported";         
      $_SESSION['status_code'] = "error";
    header('location: add-new-officer');
  }
 
}

//Booking Assets/Weapons...........................................................................

 if (isset($_POST['booking_firearm'])) {
        // receive all input values from the form
        // $firearm_serial_no =mysqli_real_escape_string($connect_db, $_POST['firearm_serial_no']);
        
    $firearm_name =mysqli_real_escape_string($connect_db, $_POST['firearm_name']);
    $firearm_serial_no =mysqli_real_escape_string($connect_db, $_POST['firearm_serial_no']);
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
    $officer_image = mysqli_real_escape_string($connect_db, $_POST['officer_image']);
    $gps_armoury_email = mysqli_real_escape_string($connect_db, $_POST['gps_armoury_email']);
    $officer_email = mysqli_real_escape_string($connect_db, $_POST['officer_email']);
    $ammunition_name = mysqli_real_escape_string($connect_db, $_POST['ammunition_name']);
    $number_of_rounds =  $_POST['number_of_rounds'];
    $comment = mysqli_real_escape_string($connect_db, $_POST['comment']);
    $action_taken= 'Issued a Firearm [ '.$firearm_name.'(with number of Rounds: '.$number_of_rounds.' ]';
    $ammo_total_rounds = $_POST['ammo_total_rounds'];
    $total_ammo_left =  $ammo_total_rounds-$number_of_rounds;
    date_default_timezone_set('Africa/Accra');
    $booking_time = date("F j, Y, g:i a");
    $returned_time = " ";
    $ammo_returned = " ";
    $ammo_state =" ";
    $no_faulty_ammo =" ";
    if( empty($duty_type) || empty($duty_location) || empty($number_of_rounds) || empty($firearm_name) ||
    empty($booking_time)) {

      $_SESSION['status'] = "Please, fill all the fields";
            $_SESSION['status_code'] = "error";
            header('location: booking'); 
    
    }else if($number_of_rounds > $ammo_total_rounds){ 

      $_SESSION['status']="Sorry...! Quantity Not Available...";         
      $_SESSION['status_code'] = "error";
      header('location: booking');

    } else{

      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

        $result_admin_activities = Query($sql_admin_activities);
        confirm($result_admin_activities);


      $sql_booking_firearm = "INSERT INTO `bookings`(`firearmID`, `ammoID`, `officerID`,
       `booking_time`, `armourer_issuer`, `officer_image`, `to_officer`,`firearm_name`,`firearm_serial_no`,
        `firearm_class`, `firearm_state`, `ammunition_name`, `number_of_rounds`,
        `ammo_returned`, `ammo_state`, `no_faulty_ammo`, `duty_type`, `duty_location`, `duty_duration`, 
        `returns`, `comment`, `returned_time`) VALUES ('$firearmID',
       '$ammoID','$officerID','$booking_time','$armourer_issuer', '$officer_image','$to_officer',
       '$firearm_name','$firearm_serial_no','$firearm_class',
        '$firearm_state','$ammunition_name','$number_of_rounds','$ammo_returned','$ammo_state',
        '$no_faulty_ammo','$duty_type','$duty_location','$duty_duration','$returns','$comment','$returned_time')";
      $result_booking_firearm = Query( $sql_booking_firearm);
      confirm($result_booking_firearm);


      // $sql_booking_firearm2 = "INSERT INTO `bookings`(`firearmID`, `ammoID`, `officerID`,
      //  `booking_time`, `armourer_issuer`, `officer_image`, `to_officer`,`firearm_name`,`firearm_serial_no`,
      //   `firearm_class`, `firearm_state`, `ammunition_name`, `number_of_rounds`,
      //   `ammo_returned`, `ammo_state`, `no_faulty_ammo`, `duty_type`, `duty_location`, `duty_duration`, 
      //   `returns`, `comment`, `returned_time`) VALUES ('$firearmID',
      //  '$ammoID','$officerID','$booking_time','$armourer_issuer', '$officer_image','$to_officer',
      //  '$firearm_name','$firearm_serial_no','$firearm_class',
      //   '$firearm_state','$ammunition_name','$number_of_rounds','$ammo_returned','$ammo_state',
      //   '$no_faulty_ammo','$duty_type','$duty_location','$duty_duration','$returns','$comment','$returned_time')";
      //   $result_booking_firearm2 = Query( $sql_booking_firearm2);
      //   confirm($result_booking_firearm2);


      $update_firearm_sql = "UPDATE `firearms` SET `booking_status` = '$booking_status' WHERE `firearmID`='$firearmID'";
      $result_booking_status = Query( $update_firearm_sql);
      confirm( $result_booking_status);
      
      $update_ammo_rounds_sql = "UPDATE `ammunitions` SET `ammo_rounds` = '$total_ammo_left' WHERE `ammoID`='$ammoID'";
      $result_ammo_status = Query( $update_ammo_rounds_sql);
      confirm( $result_ammo_status);


        $_SESSION['status']="Booked Successfully";         
        $_SESSION['status_code'] = "success";
        header('location: booked-firearms?firearm-name='.$firearm_name.'');
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
    $duty_duration =  mysqli_real_escape_string($connect_db,$_POST['duty_duration']);
    $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
    $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
    $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);
    $action_taken ='Issued an Ammo [ '.$ammo_name.'(Number of Rounds: '.$ammo_rounds.' ]';
    $officerID=mysqli_real_escape_string($connect_db,$_POST['officerID']);
    $ammoID=mysqli_real_escape_string($connect_db,$_POST['ammoID']);
    $ammo_total_rounds = mysqli_real_escape_string($connect_db, $_POST['ammo_total_rounds']);
    $total_ammo_left = $ammo_total_rounds - $ammo_rounds;
    date_default_timezone_set('Africa/Accra');
    $booking_time = date("F j, Y, g:i a");
    $returned_time = " ";
    $ammo_returned = " ";
    $ammo_state =" ";
    $no_faulty_ammo =" ";
    if( empty($duty_type) || empty($duty_location) || empty($ammo_rounds) || empty($ammo_name) ||
    empty($booking_time)) {

      $_SESSION['status'] = "Please, fill all the fields";
            $_SESSION['status_code'] = "error";
   
            header('location: booking-ammo'); 

    }else if($ammo_rounds > $ammo_total_rounds){ 

      $_SESSION['status']="Sorry...! Quantity Not Available...";         
      $_SESSION['status_code'] = "error";
      header('location: booking-ammo');

    }  else{

    $sql_booking_ammo = "INSERT INTO `ammo_bookings`(`ammoID`, `officerID`, 
    `armourer_issuer`, `officer_image`, `to_officer`, `booking_time`, `ammo_name`, 
    `ammo_rounds`, `ammo_returned`, `ammo_state`, `no_faulty_ammo`, `duty_type`, `duty_location`,
     `duty_duration`, `ammo_comment`, `ammo_returns`, `returned_time`) 
      VALUES ('$ammoID','$officerID','$armourer_issuer','$officer_image','$to_officer','$booking_time',
      '$ammo_name','$ammo_rounds','$ammo_returned','$ammo_state','$no_faulty_ammo',
      '$duty_type','$duty_location','$duty_duration','$ammo_comment','$ammo_returns','$returned_time')";

      $sql_booking_ammo2 = "INSERT INTO `ammo_bookings`(`ammoID`, `officerID`, 
      `armourer_issuer`, `officer_image`, `to_officer`, `booking_time`, `ammo_name`, 
    `ammo_rounds`, `ammo_returned`, `ammo_state`, `no_faulty_ammo`, `duty_type`, `duty_location`,
     `duty_duration`, `ammo_comment`, `ammo_returns`, `returned_time`) 
      VALUES ('$ammoID','$officerID','$armourer_issuer','$officer_image','$to_officer','$booking_time',
      '$ammo_name','$ammo_rounds','$ammo_returned','$ammo_state','$no_faulty_ammo',
      '$duty_type','$duty_location','$duty_duration','$ammo_comment','$ammo_returns','$returned_time')";

          
      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

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
        

    $_SESSION['status']="Added Successfully";         
    $_SESSION['status_code'] = "success";
    header('location: booked-ammo');
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
  $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);
  $action_taken = 'Issued an Asset(s) [ '.$asset_name.'(Quantity: '.$asset_quantity.' ]';
  $officerID=mysqli_real_escape_string($connect_db,$_POST['officerID']);
  $assetID=mysqli_real_escape_string($connect_db,$_POST['assetID']);
  $asset_image=mysqli_real_escape_string($connect_db,$_POST['asset_image']);
  $asset_state =mysqli_real_escape_string($connect_db,$_POST['asset_state']);
  $no_faulty_asset =" ";
  date_default_timezone_set('Africa/Accra');
  $booking_time = date("F j, Y, g:i a");
  $returned_time = " ";
  if (empty($armourer_issuer) || empty($to_officer) || empty($booking_time) || empty($asset_name)  
  || empty($duty_location)|| empty($asset_quantity)) 
  { 
    $_SESSION['status'] = "Please, fill all the fields"      ;
      $_SESSION['status_code'] = "error";
    
      header('location: booking-other-assets');

   }else if(assetID_exist($assetID)){

    $_SESSION['status']="Sorry...! Asset Already Exist...";         
    $_SESSION['status_code'] = "error";
    header('location: booking-other-assets');

  }
   else{

    $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
    `armourer_admin_name`,  `action_taken`, `user_role`)
     VALUES ('$adminID','$armourer_admin_name','$action_taken', '$user_role')";

    $sql_other_asset="INSERT INTO `asset_bookings`(`assetID`, `officerID`, `booking_time`, 
    `armourer_issuer`, `officer_image`, `to_officer`, `asset_name`, `asset_quantity`, `asset_state`, 
    `no_faulty_asset`, `duty_type`, `duty_location`, `duty_duration`, `asset_returns`, `asset_comment`,
    `returned_time`) VALUES ('$assetID','$officerID','$booking_time','$armourer_issuer',
    '$officer_image','$to_officer','$asset_image','$asset_name','$asset_quantity','$asset_state',
    '$no_faulty_asset','$duty_type','$duty_location','$duty_duration','$asset_returns',
    '$asset_comment','$returned_time')";

    $sql_other_asset2="INSERT INTO `asset_bookings`(`assetID`, `officerID`, `booking_time`, 
    `armourer_issuer`, `officer_image`, `to_officer`, `asset_name`, `asset_quantity`, `asset_state`, 
    `no_faulty_asset`, `duty_type`, `duty_location`, `duty_duration`, `asset_returns`, `asset_comment`,
    `returned_time`) VALUES ('$assetID','$officerID','$booking_time','$armourer_issuer',
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
       

    $_SESSION['status']="Added Successfully";         
    $_SESSION['status_code'] = "success";
    header('location: booked-other-assets');
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
    
    $_SESSION['status']="Sorry...! Error Occurred...";         
      $_SESSION['status_code'] = "error";
      header('location: update-booking');
    // echo "Error updating booking history";
    } 
    else{

      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

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

        $_SESSION['status'] = "Updated Successfully";         
        $_SESSION['status_code'] = "success";
       
        header('location:booked-firearms?firearm-name='.$firearm_name.'');
        
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
    
    $_SESSION['status']="Sorry...! Error Occurred...";         
      $_SESSION['status_code'] = "error";
    header('location: update-ammo-booking');
    // echo "Error updating booking history";
    } 
    else{

      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

      $sql_update_ammo_booking="UPDATE `ammo_bookings` SET `book_ammoID`='$book_ammoID',`officerID`='$officerID',
      `armourer_issuer`='$armourer_issuer',`officer_image`='$officer_image',`to_officer`='$to_officer',
      `booking_time`='$booking_time',`ammo_name`='$ammo_name',`ammo_rounds`='$ammo_rounds',
      `duty_type`='$duty_type',`duty_location`='$duty_location',`duty_duration`='$duty_duration',`ammo_returns`='$ammo_returns',
      `ammo_comment`='$ammo_comment'  WHERE `book_ammoID` = '$book_ammoID'";

        $result_admin_activities = Query($sql_admin_activities);
        confirm($result_admin_activities);

        $result_update_ammo_booking = Query($sql_update_ammo_booking);
        confirm($result_update_ammo_booking);

        $_SESSION['status'] = "Updated Successfully";         
        $_SESSION['status_code'] = "success";
       
        header('location:booked-ammo');
        
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

    $action_taken ='Updated Asset Booking Ticket-GPSA-#'.$bookAssetID.' '.$to_officer.' '.$asset_name.' [ '.$asset_quantity.' ]';  
    $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
    $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
    $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);
  


  if(empty($duty_location)|| empty($duty_type) || empty($asset_name) || empty($asset_quantity))
   {
    
    $_SESSION['status']="Sorry...! Quantity Not Available...";         
      $_SESSION['status_code'] = "error";
     header('location: update-asset-booking');
      
    } 
    else{

      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

      $sql_update_asset_booking="UPDATE `asset_bookings` SET `bookAssetID`='$bookAssetID',`officerID`='$officerID',
      `armourer_issuer`='$armourer_issuer',`officer_image`='$officer_image',`to_officer`='$to_officer',
      `booking_time`='$booking_time',`asset_name`='$asset_name',`asset_quantity`='$asset_quantity',
      `duty_type`='$duty_type',`duty_location`='$duty_location',`duty_location`='$duty_location',`duty_duration`='$duty_duration',`asset_returns`='$asset_returns',
      `asset_comment`='$asset_comment'  WHERE `bookAssetID` = '$bookAssetID'";

        $result_admin_activities = Query($sql_admin_activities);
        confirm($result_admin_activities);

        $result_update_asset_booking = Query($sql_update_asset_booking);
        confirm($result_update_asset_booking);

        $_SESSION['status'] = "Updated Successfully";         
        $_SESSION['status_code'] = "success";
       
        header('location:booked-other-assets');
        
  }
}

        

//UPDATE  firearmsBook
if(isset($_POST['update-firearm']))
  { 
    $firearmID=$_POST['firearmID'];
    // $firearm_class=$_POST['firearm_class'];
    // $firearm_image=$_POST['firearm_image'];
    $firearm_name=$_POST['firearm_name'];
    $firearm_serial_no=$_POST['firearm_serial_no'];
    $firearm_type=$_POST['firearm_type'];
    $firearm_state=$_POST['firearm_state'];
    $quantity=$_POST['quantity'];
    $firearm_capacity = $_POST['firearm_capacity'];
    $firearm_caliber = $_POST['firearm_caliber'];
    $armourer_admin_name = $_POST['armourer_admin_name'];
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];
    $action_taken ='Updated a Firearm [ '.$firearm_serial_no.' '.$firearm_name.' ]';


    // $firearm_image = $_FILES['firearm_image'];
    // $firearm_image_name =$_FILES['firearm_image']['name'];
    // $firearm_image_tmp =$_FILES['firearm_image']['tmp_name'];
    // $firearm_image_size =$_FILES['firearm_image']['size'];
    // $firearm_image_error =$_FILES['firearm_image']['error'];
    // $firearm_image_type =$_FILES['firearm_image']['type'];
    // $firearm_image_ext = explode('.', $firearm_image_name);
    // $firearm_imageActual_ext = strtolower(end($firearm_image_ext));
    // $firearm_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");


  // if(in_array($firearm_imageActual_ext, $firearm_image_allowed)){
    
  //   if($firearm_image_error === 0){ 

  //            if($firearm_image_size < 5000000){ 

                if( empty($firearm_name) || empty($firearm_serial_no)) {

                  $_SESSION['status'] = "Please, fill all the fields";
                  $_SESSION['status_code'] = "error";
                 
                  header('location: firearm-names?firearm-name=AK47&firearm-nameID=1'); 
                
                }else{
             

                  // $firearm_image_name_new = uniqid('', true).".".$firearm_imageActual_ext;
                  // $fileDestination = "assets/images/firearm_images/".$firearm_image_name_new;
                  // move_uploaded_file($firearm_image_tmp, $fileDestination);
                  // $firearm_image = $firearm_image_name_new;

                  $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
                  `armourer_admin_name`,  `action_taken`, `user_role`)
                    VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

                  $sql_update_firearms = "UPDATE `firearms` SET `firearmID`='$firearmID',
                  `firearm_serial_no`='$firearm_serial_no',
                  `firearm_type`='$firearm_type',`firearm_name`='$firearm_name',`firearm_caliber`='$firearm_caliber',
                  `firearm_capacity`='$firearm_capacity',`quantity`='$quantity',`firearm_class`='$firearm_class',
                  `firearm_state`='$firearm_state' WHERE `firearmID` = '$firearmID'";
                        
                
                    $result_admin_activities = Query($sql_admin_activities);
                    confirm($result_admin_activities);

                   $result_update_firearms = Query($sql_update_firearms);
                   confirm($result_update_firearms);

                      // echo 'Registered Successfully';

                      $_SESSION['status'] = "Updated Successfully";         
                      $_SESSION['status_code'] = "success";
                   
                     header('location: firearm-names?firearm-name='.$firearm_name.'');
                        }
        }


//UPDATE  Ammunition
if(isset($_POST['update-ammo']))
  { 
    $ammoID=$_POST['ammoID'];
    $ammo_name=$_POST['ammo_name'];
    $ammo_application=$_POST['ammo_application'];
    $ammo_rounds=$_POST['ammo_rounds'];
    $manufacturer=$_POST['manufacturer'];

    $armourer_admin_name = $_POST['armourer_admin_name'];
    $action_taken = 'Updated an Ammo ['.$_POST['ammo_name'].' ( '.$_POST['ammo_rounds'].' ) ]';
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];

                if( empty($ammo_name) ||  empty($ammo_rounds)) {

                  $_SESSION['status'] = "Please, fill all the fields";
                  $_SESSION['status_code'] = "error";
                 
                  header('location: ammunition'); 
                
                }else{
             
                  $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
                  `armourer_admin_name`,  `action_taken`, `user_role`)
                    VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

                  $sql_update_ammo = "UPDATE `ammunitions` SET `ammoID`='$ammoID', `manufacturer`='$manufacturer',
                  `ammo_name`='$ammo_name', `ammo_application`='$ammo_application',`ammo_rounds`='$ammo_rounds' WHERE 
                  `ammoID` = '$ammoID'";

                 
                  $result_admin_activities = Query($sql_admin_activities);
                  confirm($result_admin_activities);
                  

                   $result_update_ammo = Query($sql_update_ammo);
                   confirm($result_update_ammo);

                      // echo 'Registered Successfully';

                      $_SESSION['status'] = "Updated Successfully";         
                      $_SESSION['status_code'] = "success";
                   
                      header('location:ammunition');
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

                $_SESSION['status'] = "Please, fill all the fields";
                $_SESSION['status_code'] = "error";
               
                header('location: assets-other'); 
              
              }else{
          
                $asset_image_name_new = uniqid('', true).".".$asset_imageActual_ext;
                $fileDestination = "assets/images/asset_images/".$asset_image_name_new;
                move_uploaded_file($asset_image_tmp, $fileDestination);
                $asset_image = $asset_image_name_new;

                $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
                `armourer_admin_name`,  `action_taken`, `user_role`)
                  VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

                $sql_update_asset = "UPDATE `other_assets` SET `assetID`='$assetID',`asset_image`='$asset_image',
                `asset_serial_no`='$asset_serial_no',`asset_name`='$asset_name',`asset_quantity`='$asset_quantity'
                 WHERE `assetID` = '$assetID'";

                   $result_admin_activities = Query($sql_admin_activities);
                   confirm($result_admin_activities);

                 $result_update_asset = Query($sql_update_asset);
                 confirm($result_update_asset);

                    // echo 'Registered Successfully';

                    $_SESSION['status'] = "Updated Successfully";         
                    $_SESSION['status_code'] = "success";
                  
                    header('location:assets-other');
                      }
           }else{
            $_SESSION['status']="Sorry..! the size of the file should be more than 5MB";         
            $_SESSION['status_code'] = "error";
            header('location:assets-other');
           }

  }else{
    $$_SESSION['status']=" Error Occurred whiles Uploading the file";         
    $_SESSION['status_code'] = "error";
    header('location: assets-other');
     
  }

}else{
  $_SESSION['status']="Sorry..! file extension does not supported";         
  $_SESSION['status_code'] = "error";
  header('location: assets-other');
 
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
     $_SESSION['status']="Sorry...!Error Occurred...";         
      $_SESSION['status_code'] = "error";
    header('location: faulty-weapon');
    } 
    else{
          $faulty_firearm_image_name_new = uniqid('', true).".".$faulty_firearm_imageActual_ext;
          $fileDestination = "assets/images/faulty_firearm_images/".$faulty_firearm_image_name_new;
          move_uploaded_file($faulty_firearm_image_tmp, $fileDestination);
          $faulty_firearm_image = $faulty_firearm_image_name_new;

          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,  `action_taken`, `user_role`)
            VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

            $result_admin_activities = Query($sql_admin_activities);
            confirm($result_admin_activities);

          $sql_update_faulty_weapon="UPDATE `faulty_weapons` SET `faulty_weaponID`='$faulty_weaponID',`faulty_firearm_image`='$faulty_firearm_image',
          `faulty_firearm_serial_no`='$faulty_firearm_serial_no',`faulty_firearm_type`='$faulty_firearm_type',`faulty_firearm_name`='$faulty_firearm_name',
          `faulty_firearm_class`='$faulty_firearm_class'  WHERE `faulty_weaponID` = '$faulty_weaponID'";
            
            $result_update_faulty_weapon = Query($sql_update_faulty_weapon);
            confirm($result_update_faulty_weapon);
        

            $_SESSION['status'] = "Updated Successfully";         
            $_SESSION['status_code'] = "success";
        
            header('location:faulty-weapon');
  }
}else{
        $_SESSION['status']=" Sorry..! the size of the file should be more than 5MB";         
        $_SESSION['status_code'] = "error";
  header('location:faulty-weapon');
}

}else{ 
   $_SESSION['status']=" Error Occurred whiles Uploading the file";         
  $_SESSION['status_code'] = "error";
header('location: faulty-weapon');
//  echo "Error Occurred";
}

}else{
  $_SESSION['status']="Sorry..! file extension does not supported";         
      $_SESSION['status_code'] = "error";
header('location: faulty-weapon');

}
}


//UPDATE Faulty Ammo
if(isset($_POST['update-faulty-ammo']))
  { 
    $faulty_ammoID=$_POST['faulty_ammoID'];
    $faulty_ammo_name=$_POST['faulty_ammo_name'];

    $faulty_ammo_quantity=$_POST['faulty_ammo_quantity'];

    $armourer_admin_name = $_POST['armourer_admin_name'];
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];
    $action_taken = 'Updated a Faulty Ammo [ '.$faulty_ammo_name.' ]';

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


  if(empty($faulty_ammo_name))
   {
     $_SESSION['status']="Sorry...! Error Occurred...";         
      $_SESSION['status_code'] = "error";
    header('location: faulty-ammo');
    } 
    else{
          $faulty_ammo_image_name_new = uniqid('', true).".".$faulty_ammo_imageActual_ext;
          $fileDestination = "assets/images/faulty_ammo_images/".$faulty_ammo_image_name_new;
          move_uploaded_file($faulty_ammo_image_tmp, $fileDestination);
          $faulty_ammo_image = $faulty_ammo_image_name_new;

          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,  `action_taken`, `user_role`)
            VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

            $result_admin_activities = Query($sql_admin_activities);
            confirm($result_admin_activities);

          $sql_update_faulty_ammo="UPDATE `faulty_ammo` SET `faulty_ammoID`='$faulty_ammoID',`faulty_ammo_image`='$faulty_ammo_image',
          `faulty_ammo_name`='$faulty_ammo_name', `faulty_ammo_quantity`='$faulty_ammo_quantity'  WHERE `faulty_ammoID` = '$faulty_ammoID'";
            
            $result_update_faulty_ammo = Query($sql_update_faulty_ammo);
            confirm($result_update_faulty_ammo);
        

            $_SESSION['status'] = "Updated Successfully";         
            $_SESSION['status_code'] = "success";
        
            header('location:faulty-ammo');
          }
        }else{
           $_SESSION['status'] = "Sorry..! the size of the file should be more than 5MB";         
           $_SESSION['status_code'] = "error";
          header('location:faulty-ammo');
        }

        }else{
          $_SESSION['status']=" Error Occurred whiles Uploading the file";         
          $_SESSION['status_code'] = "error";
          header('location: faulty-ammo');
       
        }

        }else{
          $_SESSION['status']="Sorry..! file extension does not supported";         
          $_SESSION['status_code'] = "error";
          header('location: faulty-ammo');

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
     $_SESSION['status']="Sorry...! Error Occurred...";         
      $_SESSION['status_code'] = "error";
    header('location: faulty-assets');
    } 
    else{
          $faulty_asset_image_name_new = uniqid('', true).".".$faulty_asset_imageActual_ext;
          $fileDestination = "assets/images/faulty_asset_images/".$faulty_asset_image_name_new;
          move_uploaded_file($faulty_asset_image_tmp, $fileDestination);
          $faulty_asset_image = $faulty_asset_image_name_new;

          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,  `action_taken`, `user_role`)
            VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

            $result_admin_activities = Query($sql_admin_activities);
            confirm($result_admin_activities);

          $sql_update_faulty_asset="UPDATE `faulty_asset` SET `faulty_assetID`='$faulty_assetID',`faulty_asset_image`='$faulty_asset_image',
          `faulty_asset_name`='$faulty_asset_name', `faulty_asset_quantity` = '$faulty_asset_quantity'  WHERE `faulty_assetID` = '$faulty_assetID'";
            
            $result_update_faulty_asset = Query($sql_update_faulty_asset);
            confirm($result_update_faulty_asset);
        

            $_SESSION['status'] = "Updated Successfully";         
            $_SESSION['status_code'] = "success";
            header('location:faulty-assets');
  }
}else{
          $_SESSION['status']=" Sorry..! the size of the file should be more than 5MB";         
          $_SESSION['status_code'] = "error";
  header('location:faulty-assets');
}

}else{  
  $_SESSION['status']=" Error Occurred whiles Uploading the file";         
  $_SESSION['status_code'] = "error";
header('location: faulty-assets');
//  echo "Error Occurred";
}

}else{
  $_SESSION['status']="Sorry..! file extension does not supported";         
      $_SESSION['status_code'] = "error";
header('location: faulty-assets');

}
}





// Returning firearm 

if(isset($_POST['returning-firearm']))
  { 
    $firearm_name = $_POST['firearm_name'];
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
    date_default_timezone_set('Africa/Accra');
    $returned_time = date("F j, Y, g:i a");
    $action_taken = 'Returned a Firearm [ '.$firearm_name.' With ('. $ammo_returned. ') rounds of Ammunition ]';

  if(empty($duty_location)||empty($firearm_state) ||  empty($returns) || empty($duty_type) || empty($firearm_class) 
  || empty($firearm_name))
   {

    $_SESSION['status']="Please, fill all the fields";         
    $_SESSION['status_code'] = "error";
    header('location:booked-firearms?firearm-name='.$firearm_name.'');
    } 
    else{
      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`)
        VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";


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
       
        $_SESSION['status']="Returned Successfully";         
        $_SESSION['status_code'] = "success";
        header('location:returns?firearm-name='.$firearm_name.'');
  }
}

// Returning firearm Not Return page

if(isset($_POST['not-returning-firearm']))
  { 
    $firearm_name = $_POST['firearm_name'];
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
    date_default_timezone_set('Africa/Accra');
    $returned_time = date("F j, Y, g:i a");

    $action_taken = 'Returned a Firearm [ '.$firearm_name.' With ('. $ammo_returned. ') rounds of Ammunition ]';

    

  if(empty($duty_location)||empty($firearm_state) || 
   empty($returns) || empty($duty_type) || empty($firearm_class) 
  || empty($firearm_name))
   {

    $_SESSION['status']="Please, fill all the fields";         
    $_SESSION['status_code'] = "error";
    header('location:booked-firearms?firearm-name='.$firearm_name.'');
    } 
    else{
      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`)
        VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

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
        $_SESSION['status']="Returned Successfully";         
        $_SESSION['status_code'] = "success";
        header('location:not-returns-firearms?firearm-name='.$firearm_name.'');
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
   
    date_default_timezone_set('Africa/Accra');
    $returned_time = date("F j, Y, g:i a");

  if(empty($duty_location)||empty($ammo_returned) ||  empty($ammo_returns) || empty($duty_type) 
  || empty($ammo_name) )
   {

    $_SESSION['status']="Sorry...! Error Occurred...";         
    $_SESSION['status_code'] = "error";
    header('location:returns-ammo');
    } 
    else{
      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

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
      $_SESSION['status']="Returned Successfully";         
      $_SESSION['status_code'] = "success";
      header('location:returns-ammo');
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
   
    date_default_timezone_set('Africa/Accra');
    $returned_time = date("F j, Y, g:i a");

  if(empty($duty_location)||empty($ammo_returned) ||  empty($ammo_returns) || empty($duty_type) 
  || empty($ammo_name) )
   {

    $_SESSION['status']="Please, fill all the fields";         
    $_SESSION['status_code'] = "error";
    header('location:returns-ammo');
    } 
    else{
      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

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
      $_SESSION['status']="Returned Successfully";         
      $_SESSION['status_code'] = "success";
      header('location:not-returns-ammo');
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
    date_default_timezone_set('Africa/Accra');
    $returned_time = date("F j, Y, g:i a");

  if(empty($duty_location)||empty($asset_quantity) ||  empty($asset_returns) || empty($duty_type) 
  || empty($asset_name) )
   {

    $_SESSION['status']="Please, fill all the fields";         
    $_SESSION['status_code'] = "error";
    header('location:returns-assets');
    } 
    else{

      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`)
        VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

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
        $_SESSION['status']="Returned Successfully";         
        $_SESSION['status_code'] = "success";
        header('location:returns-assets');
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
    date_default_timezone_set('Africa/Accra');
    $returned_time = date("F j, Y, g:i a");

  if(empty($duty_location)||empty($asset_quantity) ||  empty($asset_returns) || empty($duty_type) 
  || empty($asset_name) )
   {
    $_SESSION['status']="Sorry...! Error Occurred...";         
    $_SESSION['status_code'] = "error"; 
    header('location:returns-assets');
    } 
    else{

      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

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
        $_SESSION['status']="Returned Successfully";         
        $_SESSION['status_code'] = "success";
        header('location:not-returns-assets');
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
    $officerID = $_POST['officerID'];
    $firearmID = $_POST['firearmID'];
    $bookingID = $_POST['bookingID'];
    $no_faulty_ammo = $_POST['no_faulty_ammo'];
    $ammo_state = $_POST['ammo_state'];
    //$officer_image = $_POST['officer_image'];
    $ammunition_name = $_POST['ammunition_name'];
    $ammo_returned = $_POST['ammo_returned'];
    $comment = $_POST['comment'];
    
    $armourer_admin_name = $_POST['armourer_admin_name'];
    $user_role = $_POST['user_role'];
    $adminID=$_POST['adminID'];
    date_default_timezone_set('Africa/Accra');
    $returned_time = date("F j, Y, g:i a");

    $action_taken = 'Returned a Firearm [ '.$firearm_name.' With ('. $ammo_returned. ') rounds of Ammunition ]';
    $total_ammo_left = $total_ammo_rounds + $ammo_returned;

  if(empty($ammo_returned)||empty($firearm_state) ||  empty($returns) || empty($duty_type))
   {

    $_SESSION['status']="Sorry...! Error whiles returning...";         
    $_SESSION['status_code'] = "error";
    header("location:officers-booking?officerID='.$officerID.'");
    } 
    else{
      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`)
        VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";


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
        $_SESSION['status']="Returned Successfully";         
        $_SESSION['status_code'] = "success";
        header("location:officers-booking?officerID='.$officerID.'");
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
    date_default_timezone_set('Africa/Accra');
    $returned_time = date("F j, Y, g:i a");

  if(empty($ammo_returned) ||  empty($ammo_returns))
   {

    $_SESSION['status']="Sorry...! Error whiles returning...";         
    $_SESSION['status_code'] = "error";
    header("location:officers-booking?officerID='.$officerID.'");
    } 
    else{
      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`)
      VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

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
      $_SESSION['status']="Returned Successfully";         
      $_SESSION['status_code'] = "success";
      header("location:officers-booking?officerID='.$officerID.'");
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
    date_default_timezone_set('Africa/Accra');
    $returned_time = date("F j, Y, g:i a");

  if(empty($duty_location)||empty($asset_quantity) ||  empty($asset_returns) || empty($duty_type) 
  || empty($asset_name) )
   {

    $_SESSION['status']="Sorry...! Error whiles returning...";         
    $_SESSION['status_code'] = "error";
    header("location: officers-booking?officerID='.$officerID.'");
    } 
    else{

      $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
      `armourer_admin_name`,  `action_taken`, `user_role`)
        VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

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
         
        $_SESSION['status']="Returned Successfully";         
        $_SESSION['status_code'] = "success";
        header("location:officers-booking?officerID='.$officerID.'");
  }
}


//Add Faulty Ammunition...........................................................................
if (isset($_POST['add_faulty_ammo'])) {
  // receive all input values from the form
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
  $action_taken ='Added Faulty Ammo [ '. $faulty_ammo_name.' ]';
  // by adding (array_push()) corresponding error unto $errors array
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
        if(empty($faulty_ammo_name) || empty($faulty_ammo_quantity)){

          $_SESSION['status'] = "Please, fill all the fields";
            $_SESSION['status_code'] = "error";
         
            header('location: add-faulty-ammo');

        }else{ 
          $faulty_ammo_image_name_new = uniqid('', true).".".$faulty_ammo_imageActual_ext;
          $fileDestination = "assets/images/faulty_ammo_images/".$faulty_ammo_image_name_new;
          move_uploaded_file($faulty_ammo_image_tmp, $fileDestination);
          $faulty_ammo_image = $faulty_ammo_image_name_new;

                           
          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,`action_taken`, `user_role`)
          VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

          $sql_faulty_ammo="INSERT INTO `faulty_ammo`(`faulty_ammo_name`, `faulty_ammo_quantity`,`faulty_type`, `faulty_ammo_image`,`faulty_ammo_comment`) VALUES 
            ('$faulty_ammo_name','$faulty_ammo_quantity','$faulty_type',
            '$faulty_ammo_image','$faulty_ammo_comment')";

          $sql_faulty_ammo2="INSERT INTO `faulty_ammo2`(`faulty_ammo_name`, `faulty_ammo_quantity`,`faulty_type`, `faulty_ammo_image`,`faulty_ammo_comment`) VALUES 
            ('$faulty_ammo_name','$faulty_ammo_quantity','$faulty_type',
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

            $_SESSION['status']="Added Successfully";         
            $_SESSION['status_code'] = "success";
            header('location: faulty-ammo');
        }
        
      }else{
        $_SESSION['status']=" Sorry..! the size of the file should be more than 5MB";         
        $_SESSION['status_code'] = "error";
        header('location: add-faulty-ammo');
      }

    }else {
                $_SESSION['status']=" Error Occurred whiles Uploading the file";         
                $_SESSION['status_code'] = "error";
      header('location: add-faulty-ammo');
    }

  }else{
    $_SESSION['status']="Sorry..! file extension does not supported";         
    $_SESSION['status_code'] = "error";
    header('location: add-faulty-ammo');
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

          $_SESSION['status'] = "Please, fill all the fields";
            $_SESSION['status_code'] = "error";
         
            header('location: add-faulty-assets');

        }else if(faulty_asset_serial_no_exist($faulty_asset_serial_no )){
                     
          $_SESSION['status']="Sorry...! Serial Number Already Exist";         
          $_SESSION['status_code'] = "error";
          header('location: add-faulty-assets');

        }else{
          $faulty_asset_image_name_new = uniqid('', true).".".$faulty_asset_imageActual_ext;
          $fileDestination = "assets/images/faulty_asset_images/".$faulty_asset_image_name_new;
          move_uploaded_file($faulty_asset_image_tmp, $fileDestination);
          $faulty_asset_image = $faulty_asset_image_name_new;

                           
          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,`action_taken`,`user_role`)
          VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

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

             

              $_SESSION['status']="Added Successfully";         
              $_SESSION['status_code'] = "success";
              header('location: faulty-assets');
        }
        
      }else{
        $_SESSION['status']=" Sorry..! the size of the file should be more than 5MB";         
        $_SESSION['status_code'] = "error";
        header('location: add-faulty-assets');
      }

    }else {
      $_SESSION['status']=" Error Occurred whiles Uploading the file";         
      $_SESSION['status_code'] = "error";
      header('location: add-faulty-assets');
      
    }

  }else{
    $_SESSION['status']="Sorry..! file extension does not supported";         
    $_SESSION['status_code'] = "error";
    header('location: add-faulty-assets');
  }
}


//Edit store Keeper settings...........................................................................
if (isset($_POST['btn-edit-settings'])) {
     $gender = $_POST['gender'];
     $rank = $_POST['rank'];
     $username = $_POST['username'];
     $phone_number =  $_POST['phone_number'];
     $admin_email =  $_POST['admin_email'];
     $adminID =  $_POST['adminID'];
     date_default_timezone_set('Africa/Accra');
     $update_date =  date("F j, Y, g:i a");

  $profile_image = $_FILES['profile_image'];
  $profile_image_name =$_FILES['profile_image']['name'];
  $profile_image_tmp =$_FILES['profile_image']['tmp_name'];
  $profile_image_size =$_FILES['profile_image']['size'];
  $profile_image_error =$_FILES['profile_image']['error'];
  $profile_image_type =$_FILES['profile_image']['type'];
  $profile_image_ext = explode('.', $profile_image_name);
  $profile_imageActual_ext = strtolower(end($profile_image_ext));
  $profile_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");

        if(empty($gender) || empty($phone_number)){
        $_SESSION['status'] = "Please, fill all the fields";
        $_SESSION['status_code'] = "error";
        header('location: settings-hardware');
    
        }
       
        else{
    
            $profile_image_name_new = uniqid('', true).".".$profile_imageActual_ext;
            $fileDestination = "./administrator/assets/images/profile_images/".$profile_image_name_new;
            move_uploaded_file($profile_image_tmp, $fileDestination);
            $profile_image = $profile_image_name_new;

            $sql_administrator ="UPDATE `admin_lists` SET  `phone_number`='$phone_number',`admin_email`='$admin_email',`rank`='$rank',`gender`='$gender',
            `profile_image`='$profile_image',`update_date`='$update_date' WHERE `adminID`= '$adminID'";

            $result_administrator = Query($sql_administrator);
            confirm($result_administrator);
           $_SESSION['status'] = "Updated Successfully";
           $_SESSION['status_code'] = "success";
           header('location: settings');

        }

      }




      // if (isset($_POST['update-officer'])) {
   
      //   $officer_service_no = $_POST['officer_service_no'];
      //   $rank = $_POST['rank'];
      //   $full_name = $_POST['full_name'];
      //   $officerID = $_POST['officerID'];
      //   $officer_status = $_POST['officer_status'];
      //   $gender = $_POST['gender'];
      //   $dept_unit = $_POST['dept_unit'];
      //   $phone_no = $_POST['phone_no'];
      //   $old_officer_image = $_POST['old_officer_image'];
      //   $officer_email = $_POST['officer_email'];
       
      //   $officer_image = $_FILES['officer_image'];
      //   $officer_image_name =$_FILES['officer_image']['name'];
      //   $officer_image_tmp =$_FILES['officer_image']['tmp_name'];
      //   $officer_image_size =$_FILES['officer_image']['size'];
      //   $officer_image_error =$_FILES['officer_image']['error'];
      //   $officer_image_type =$_FILES['officer_image']['type'];
      //   $officer_image_ext = explode('.', $officer_image_name);
      //   $officer_imageActual_ext = strtolower(end($officer_image_ext));
      //   $officer_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");
  
        
      //   // if($error === 0){
      //   //    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
      //   //    $img_ex_to_lc = strtolower($img_ex);

      //   //    $allowed_exs = array('jpg', 'jpeg', 'png');

      //    if(empty($officer_image)){
          
      //     $sql_officer ="UPDATE `officers` SET `officerID`='$officerID',`officer_status`='$officer_status',`officer_image`='$old_officer_image',
      //     `officer_service_no`='$officer_service_no', `rank`='$rank',`full_name`='$full_name',`gender`='$gender',`dept_unit`='$dept_unit',
      //     `phone_no`='$phone_no',`officer_email`='$officer_email' WHERE `officerID`= '$officerID'";

      //       $result_officer = Query($sql_officer);
      //       confirm($result_officer);
      //       $_SESSION['status'] = "Updated Successfully";
      //       $_SESSION['status_code'] = "success";
      //       // header('location: officers-list');
      //       echo "Error occureed";
      
      //     }
      //      else if(in_array($officer_imageActual_ext,$officer_image_allowed)){
            
           

      //       $officer_image_name_new = uniqid('', true).".".$officer_imageActual_ext;
      //       $fileDestination = "assets/images/officer_images/".$officer_image_name_new;
      //       // move_uploaded_file($officer_image_tmp, $fileDestination);
      //       $officer_image = $officer_image_name_new;
      //       $old_officer_image_destination = "assets/images/officer_images/".$old_officer_image;

      //       $sql_officer ="UPDATE `officers` SET `officerID`='$officerID',`officer_status`='$officer_status',`officer_image`='$old_officer_image',
      //       `officer_service_no`='$officer_service_no', `rank`='$rank',`full_name`='$full_name',`gender`='$gender',`dept_unit`='$dept_unit',
      //       `phone_no`='$phone_no',`officer_email`='$officer_email' WHERE `officerID`= '$officerID'";
  
      //         $result_officer = Query($sql_officer);
      //         confirm($result_officer);
      //         $_SESSION['status'] = "Updated Successfully";
      //         $_SESSION['status_code'] = "success";
      //         header('location: officers-list');

      //       if(unlink($old_officer_image_destination)){
      //         move_uploaded_file($officer_image_tmp,$fileDestination);
      //       }
      //       else{
      //         move_uploaded_file($officer_image_tmp,$fileDestination);
      //       }


      //     }
      //     }
             


          

      if (isset($_POST['update-officer'])) {
   
        $officer_service_no = $_POST['officer_service_no'];
        $rank = $_POST['rank'];
        $full_name = $_POST['full_name'];
        $officerID = $_POST['officerID'];
        $officer_status = $_POST['officer_status'];
        $gender = $_POST['gender'];
        $dept_unit = $_POST['dept_unit'];
        $phone_no = $_POST['phone_no'];
        $old_officer_image = $_POST['old_officer_image'];
        $officer_email = $_POST['officer_email'];
       
        $officer_image = $_FILES['officer_image'];
        $officer_image_name =$_FILES['officer_image']['name'];
        $officer_image_tmp =$_FILES['officer_image']['tmp_name'];
        $officer_image_size =$_FILES['officer_image']['size'];
        $officer_image_error =$_FILES['officer_image']['error'];
        $officer_image_type =$_FILES['officer_image']['type'];
        $officer_image_ext = explode('.', $officer_image_name);
        $officer_imageActual_ext = strtolower(end($officer_image_ext));
        $officer_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");
  
        
        // if($error === 0){
        //    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        //    $img_ex_to_lc = strtolower($img_ex);

        //    $allowed_exs = array('jpg', 'jpeg', 'png');

         if(empty($officer_image)){
          
          $sql_officer ="UPDATE `officers` SET `officerID`='$officerID',`officer_status`='$officer_status',`officer_image`='$old_officer_image',
          `officer_service_no`='$officer_service_no', `rank`='$rank',`full_name`='$full_name',`gender`='$gender',`dept_unit`='$dept_unit',
          `phone_no`='$phone_no',`officer_email`='$officer_email' WHERE `officerID`= '$officerID'";

            $result_officer = Query($sql_officer);
            confirm($result_officer);
            $_SESSION['status'] = "Updated Successfully";
            $_SESSION['status_code'] = "success";
            header('location: officers-list?Rank='.$rank.'');
      
          }
           else{
            $officer_image_name_new = uniqid('', true).".".$officer_imageActual_ext;
            $fileDestination = "assets/images/officer_images/".$officer_image_name_new;
            move_uploaded_file($officer_image_tmp, $fileDestination);
            $officer_image = $officer_image_name_new;
            $old_officer_image_destination = "assets/images/officer_images/".$old_officer_image;

            $sql_officer ="UPDATE `officers` SET `officerID`='$officerID',`officer_status`='$officer_status',`officer_image`='$old_officer_image',
            `officer_service_no`='$officer_service_no', `rank`='$rank',`full_name`='$full_name',`gender`='$gender',`dept_unit`='$dept_unit',
            `phone_no`='$phone_no',`officer_email`='$officer_email' WHERE `officerID`= '$officerID'";
  
              $result_officer = Query($sql_officer);
              confirm($result_officer);
              $_SESSION['status'] = "Updated Successfully";
              $_SESSION['status_code'] = "success";
              header('location: officers-list?Rank='.$rank.'');

          }
          }
             