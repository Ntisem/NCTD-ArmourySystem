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
 //Service No Exists already
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
 //faulty Weapon no Exists already
 function faulty_weapon_number_exist($faulty_weapon_number){
  $sql = "SELECT * FROM `faulty_weapons` where `faulty_weapon_number`='$faulty_weapon_number'";
  $result = Query($sql);
  
  if(fetch_data($result))
  {
      return true;
  }
  else{
      return false;
  }
}

 //faulty Serial No Exists already
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
 //Service No Exists already
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

 //Email Exists already
    function email_exists($admin_email){
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
    
 //Email Exists already
 function officer_email_exists($officer_email){
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

       //Phone number Exists already
   function phone_number_exists($phone_number){
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
   //Phone number Exists already
   function phone_no_exists($phone_no){
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

   //Firearm Exists already in firearm bookings table
   function firearmID_exists($firearmID){
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
   function asset_firearmID_exists($firearmID){
    $sql = "SELECT * FROM asset_bookings where firearmID='$firearmID'";
    $result = Query($sql);
    
    if(fetch_data($result))
    {
        return true;
    }
    else{
        return false;
    }
 }

 
   //faulty firearmID  for asset Exists already
   function faulty_asset_firearmID_exists($firearmID){
    $sql = "SELECT * FROM faulty_asset where firearmID='$firearmID'";
    $result = Query($sql);
    
    if(fetch_data($result))
    {
        return true;
    }
    else{
        return false;
    }
 }
   //faulty firearmID  for firearm  Exists already
   function faulty_firearm_firearmID_exists($firearmID){
    $sql = "SELECT * FROM faulty_weapon where firearmID='$firearmID'";
    $result = Query($sql);
    
    if(fetch_data($result))
    {
        return true;
    }
    else{
        return false;
    }
 }

     //Username Exists already
     function username_exists($username){
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

 //faulty asset no Exists already
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




 //Firearm firearm serial no Exists already
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

 //Firearm firearm serial no Exists already
 function new_firearm_name_exist($new_firearm_name){
  $sql = "SELECT * FROM `firearm_name` where `firearm_name`='$new_firearm_name'";
  $result = Query($sql);
  
  if(fetch_data($result))
  {
      return true;
  }
  else{
      return false;
  }
}

 //Firearm weapon number in firearms Exists already
 function weapon_number_exist($weapon_number){
  $sql = "SELECT * FROM `firearms` where `weapon_number`='$weapon_number'";
  $result = Query($sql);
  
  if(fetch_data($result))
  {
      return true;
  }
  else{
      return false;
  }
}

 //Asset serial no Exists already
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




//Add new Assets/Weapons...........................................................................
// if (isset($_POST['add_new_weapon'])) {
  // receive all input values from the form
  // $firearm_serial_no =mysqli_real_escape_string($connect_db, $_POST['firearm_serial_no']);
  // $firearm_type =mysqli_real_escape_string($connect_db, $_POST['firearm_type']);
  // $firearm_name =mysqli_real_escape_string($connect_db, $_POST['firearm_name']);
  // $manufacturer =mysqli_real_escape_string($connect_db, $_POST['manufacturer']);
  // $firearm_class =mysqli_real_escape_string($connect_db, $_POST['firearm_class']);
  // $firearm_state =mysqli_real_escape_string($connect_db, $_POST['firearm_state']);
  // $firearm_capacity =mysqli_real_escape_string($connect_db, $_POST['firearm_capacity']);
  // $firearm_caliber =mysqli_real_escape_string($connect_db, $_POST['firearm_caliber']);
  // $adminID =mysqli_real_escape_string($connect_db, $_POST['adminID']);
  // $armourer_admin_name =mysqli_real_escape_string($connect_db, $_POST['armourer_admin_name']);
  // $user_role =mysqli_real_escape_string($connect_db, $_POST['user_role']);
  // $booking_status =mysqli_real_escape_string($connect_db, $_POST['booking_status']);
   

  // $action_taken  ='Added New Firearm [ '.$firearm_serial_no.' '.$firearm_type.' '.$firearm_name.' ]';
  // $armourer_admin_name = mysqli_real_escape_string($connect_db, $_POST['armourer_admin_name']);
  // $adminID = mysqli_real_escape_string($connect_db, $_POST['adminID']);
  // $user_role = mysqli_real_escape_string($connect_db, $_POST['user_role']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  // $firearm_image = $_FILES['firearm_image'];
  // $firearm_image_name =$_FILES['firearm_image']['name'];
  // $firearm_image_tmp =$_FILES['firearm_image']['tmp_name'];
  // $firearm_image_size =$_FILES['firearm_image']['size'];
  // $firearm_image_error =$_FILES['firearm_image']['error'];
  // $firearm_image_type =$_FILES['firearm_image']['type'];
  // $firearm_image_ext = explode('.', $firearm_image_name);
  // $firearm_imageActual_ext = strtolower(end($firearm_image_ext));
  // $firearm_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");

  //  if(firearm_serial_no_exist($firearm_serial_no)){
  //         $_SESSION['status']="Sorry...! Serial Number already exist";         
  //         $_SESSION['status_code'] = "error";
  //         header('location: add-new-weapon');
  //       } 
  //        else{
          // $firearm_image_name_new = uniqid('', true).".".$firearm_imageActual_ext;
          // $fileDestination = "assets/images/firearm_images/".$firearm_image_name_new;
          // move_uploaded_file($firearm_image_tmp, $fileDestination);
          // $firearm_image = $firearm_image_name_new;

      //     $sql_action="INSERT INTO `daily_activities`(`adminID`, `armourer_admin_name`, `action_taken`,`user_role`) 
      //     VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

      //     $sql_weapons="INSERT INTO `firearms`(`firearm_serial_no`,`manufacturer`, `firearm_type`, `firearm_name`, 
      //     `firearm_caliber`, `firearm_capacity`, `firearm_class`, `firearm_state`,`booking_status`)
      //       VALUES('$firearm_serial_no','$manufacturer','$firearm_type', '$firearm_name','$firearm_caliber',
      //       '$firearm_capacity','$firearm_class','$firearm_state','$booking_status')";


      //       $sql_weapons2="INSERT INTO `firearms2`(`firearm_serial_no`,`manufacturer`, `firearm_type`,
      //       `firearm_name`, `firearm_caliber`, `firearm_capacity`,`firearm_class`, `firearm_state`,`booking_status`) 
      //         VALUES('$firearm_serial_no','$manufacturer','$firearm_type', '$firearm_name','$firearm_caliber',
      //         '$firearm_capacity','$firearm_class','$firearm_state','$booking_status')";

        

      //         $result_weapons = Query($sql_weapons);
      //         confirm($result_weapons);
          
      //         $result_weapons2 = Query($sql_weapons2);
      //         confirm($result_weapons2);

      //         $result_action = Query($sql_action);
      //         confirm($result_action);
           
      //     $_SESSION['status']="Added Successfully";         
      //     $_SESSION['status_code'] = "success";
      //     header('location: firearm-names?firearm-name='.$firearm_name.'');
      //   }
        
      // }
  

// Add new Assets/Weapons
if (isset($_POST['add_new_weapon'])) {
    $firearm_serial_no = mysqli_real_escape_string($connect_db, $_POST['firearm_serial_no']);
    $firearm_type = mysqli_real_escape_string($connect_db, $_POST['firearm_type']);
    $firearm_name = mysqli_real_escape_string($connect_db, $_POST['firearm_name']);
    $manufacturer = mysqli_real_escape_string($connect_db, $_POST['manufacturer']);
    $firearm_class = mysqli_real_escape_string($connect_db, $_POST['firearm_class']);
    $firearm_state = mysqli_real_escape_string($connect_db, $_POST['firearm_state']);
    $firearm_capacity = mysqli_real_escape_string($connect_db, $_POST['firearm_capacity']);
    $firearm_caliber = mysqli_real_escape_string($connect_db, $_POST['firearm_caliber']);
    $adminID = mysqli_real_escape_string($connect_db, $_POST['adminID']);
    $booking_status = mysqli_real_escape_string($connect_db, $_POST['booking_status']);
    $recorded_by = mysqli_real_escape_string($connect_db, $_POST['recorded_by']);
    $remarks = mysqli_real_escape_string($connect_db, $_POST['remarks']);

    if(firearm_serial_no_exist($firearm_serial_no)){
        $_SESSION['status'] = "Access Denied: Serial Number $firearm_serial_no already registered in system.";         
        $_SESSION['status_code'] = "error";
        header('location: add-new-weapon');
        exit();
    } else {
        $action_taken = "Inducted New Asset: $firearm_name ($firearm_serial_no)";
        
        // Log Activity
        $sql_action = "INSERT INTO `daily_activities`(`adminID`, `armourer_admin_name`, `action_taken`, `user_role`) 
                       VALUES ('$adminID', '$recorded_by', '$action_taken', 'Armourer')";

        // Insert into Primary and Backup Registry
        $sql_weapons = "INSERT INTO `firearms`(`firearm_serial_no`,`manufacturer`, `firearm_type`, `firearm_name`, `firearm_caliber`, `firearm_capacity`, `firearm_class`, `firearm_state`,`booking_status`,`adminID`,`armourer_admin_name`,`remarks`)
                        VALUES('$firearm_serial_no','$manufacturer','$firearm_type', '$firearm_name','$firearm_caliber','$firearm_capacity','$firearm_class','$firearm_state','$booking_status','$adminID','$recorded_by','$remarks')";

        if(Query($sql_weapons) && Query($sql_action)) {
            $_SESSION['status'] = "ASSET REGISTERED: Serial $firearm_serial_no successfully committed to registry.";         
            $_SESSION['status_code'] = "success";
            header('location: firearm-names?firearm-name='.$firearm_name.''); // Redirect back to show toast
        } else {
            $_SESSION['status'] = "CRITICAL FAILURE: Database sync interrupted.";         
            $_SESSION['status_code'] = "error";
            header('location: add-new-weapon');
        }
        exit();
    }
}

// 
//Add new Ammunition...........................................................................
if (isset($_POST['add_new_ammo'])) {
  // receive all input values from the form

 
  $ammo_name = mysqli_real_escape_string($connect_db, $_POST['ammo_name']);
  $ammo_rounds = $_POST['ammo_rounds'];
  $ammo_application =mysqli_real_escape_string($connect_db, $_POST['ammo_application']);
  $manufacturer =mysqli_real_escape_string($connect_db, $_POST['manufacturer']);
  $booking_status =mysqli_real_escape_string($connect_db, $_POST['booking_status']);
  // form validation: ensure that the form is correctly filled ...
  $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
  $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
  $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);
  $action_taken ='Added New Ammo [ '. $ammo_name.' ]';

  $total_ammunitions =  $ammo_rounds;

  //
        if(empty($ammo_name) || empty($ammo_rounds)){
          $_SESSION['status']="Sorry...! Please fill all the fields";         
          $_SESSION['status_code'] = "error";
          header('location: add-new-ammo');

        }  else{
                         
          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`, `action_taken`, `user_role`)
          VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

          $sql_ammo="INSERT INTO `ammunitions`(`manufacturer`, `ammo_name`,
           `ammo_application`, `ammo_rounds`,`booking_status`) VALUES ('$manufacturer','$ammo_name',
           '$ammo_application','$total_ammunitions','$booking_status')";

          $sql_ammo2="INSERT INTO `ammunitions2`(`manufacturer`,
            `ammo_name`, `ammo_application`, `ammo_rounds`,`booking_status`) 
            VALUES ('$manufacturer', '$ammo_name','$ammo_application',
            '$total_ammunitions','$booking_status')";

 
            $result_admin_activities = Query($sql_admin_activities);
            confirm($result_admin_activities);
                      
          $result_ammo = Query($sql_ammo);
          confirm($result_ammo);

          $result_ammo2 = Query($sql_ammo2);
          confirm($result_ammo2);
          $_SESSION['status']="Added Successfully";         
          $_SESSION['status_code'] = "success";
          header('location: ammunition');
        }
        
      }
// End of Adding Ammunition
// add other assets

//Add new Ammunition...........................................................................
if (isset($_POST['add_new_asset'])) {
  // receive all input values from the form
  $asset_serial_no =mysqli_real_escape_string($connect_db, $_POST['asset_serial_no']);
  $asset_name =mysqli_real_escape_string($connect_db, $_POST['asset_name']);
  $asset_quantity =mysqli_real_escape_string($connect_db, $_POST['asset_quantity']);
  $asset_state =mysqli_real_escape_string($connect_db, $_POST['asset_state']);
  $booking_status =mysqli_real_escape_string($connect_db, $_POST['booking_status']);
  $manufacturer =mysqli_real_escape_string($connect_db, $_POST['manufacturer']);
  $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
  $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
  $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);
  $action_taken = 'Added New Asset [ '.$asset_name.' (Quantity: '. $asset_quantity .' ) ]';
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  $asset_image = $_FILES['asset_image'];
  $asset_image_name =$_FILES['asset_image']['name'];
  $asset_image_tmp =$_FILES['asset_image']['tmp_name'];
  $asset_image_size =$_FILES['asset_image']['size'];
  $asset_image_error =$_FILES['asset_image']['error'];
  $asset_image_type =$_FILES['asset_image']['type'];
  $asset_image_ext = explode('.', $asset_image_name);
  $asset_imageActual_ext = strtolower(end($asset_image_ext));
  $asset_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");

  if (in_array($asset_imageActual_ext, $asset_image_allowed)) {
    if ($asset_image_error === 0) {
      if ($asset_image_size < 50000000) {
        if(empty($asset_serial_no) || empty($asset_name) || empty($asset_quantity)){
          $_SESSION['status']="Sorry...! Please fill all the fields";         
          $_SESSION['status_code'] = "error";
          header('location: add-new-other-assets');

        }else if(asset_serial_no_exist($asset_serial_no)){
          $_SESSION['status']="Sorry...! Serial Number already exist";         
          $_SESSION['status_code'] = "error";
          header('location: add-new-other-assets');

        }
         else{
          $asset_image_name_new = uniqid('', true).".".$asset_imageActual_ext;
          $fileDestination = "assets/images/asset_images/".$asset_image_name_new;
          move_uploaded_file($asset_image_tmp, $fileDestination);
          $asset_image = $asset_image_name_new;

          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,  `action_taken`, `user_role`)
          VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

          $sql_asset="INSERT INTO `other_assets`(`asset_image`, `asset_serial_no`,`manufacturer`, `asset_name`, 
          `asset_quantity`,`asset_state`,`booking_status`) VALUES ('$asset_image','$asset_serial_no',
          '$manufacturer','$asset_name','$asset_quantity','$asset_state','$booking_status')";
          
          $sql_asset2="INSERT INTO `other_assets2`(`asset_image`, `asset_serial_no`,manufacturer`, `asset_name`, 
          `asset_quantity`,`asset_state`,`booking_status`)
           VALUES ('$asset_image','$asset_serial_no','$manufacturer','$asset_name','$asset_quantity','$asset_state','$booking_status')";

            $result_admin_activities = Query($sql_admin_activities);
            confirm($result_admin_activities);

          $result_asset = Query($sql_asset);
          confirm($result_asset);

          $result_asset2 = Query($sql_asset2);
          confirm($result_asset2);
          $_SESSION['status']="Added Successfully";         
          $_SESSION['status_code'] = "success";
          header('location: assets-other');
        }
        
      }else{
        $_SESSION['status']="Sorry... File size should not be more than 5MB";         
        $_SESSION['status_code'] = "error";
        header('location: add-new-other-assets');
      }

    }else {
      $_SESSION['status']="Sorry... File does not supported";         
      $_SESSION['status_code'] = "error";
      header('location: add-new-other-assets');
    }

  }else{
    $_SESSION['status']="Sorry... File extension does not supported";         
      $_SESSION['status_code'] = "error";
      header('location: add-new-other-assets');
    
  }
}
//End of adding assets


//Add new Assets/Weapons...........................................................................
if (isset($_POST['add_new_firearm_name'])) {

  $new_firearm_name =mysqli_real_escape_string($connect_db, $_POST['new_firearm_name']);
 
   if(new_firearm_name_exist($new_firearm_name)){
          $_SESSION['status']="Sorry...! Firearm Name already exist";         
          $_SESSION['status_code'] = "error";
          header('location: add-firearm-name');
        } 
         else{
       
          $sql_firearm_name="INSERT INTO `firearm_name` (`firearm_name`)
            VALUES('$new_firearm_name')";

              $result_firearm_name = Query($sql_firearm_name);
              confirm($result_firearm_name);
           
          $_SESSION['status']="Added Successfully";         
          $_SESSION['status_code'] = "success";
          header('location: add-firearm-name');
        }
        
      }