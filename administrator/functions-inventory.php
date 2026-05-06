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


 //faulty ammo no Exists already
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
 //Ammo serial no Exists already
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

//Add new Assets/Weapons...........................................................................
if (isset($_POST['add_new_weapon'])) {
  // receive all input values from the form
  $firearm_serial_no =mysqli_real_escape_string($connect_db, $_POST['firearm_serial_no']);
  $firearm_type =mysqli_real_escape_string($connect_db, $_POST['firearm_type']);
  $firearm_name =mysqli_real_escape_string($connect_db, $_POST['firearm_name']);
  $quantity =mysqli_real_escape_string($connect_db, $_POST['quantity']);
  $manufacturer =mysqli_real_escape_string($connect_db, $_POST['manufacturer']);
  $firearm_class =mysqli_real_escape_string($connect_db, $_POST['firearm_class']);
  $firearm_state =mysqli_real_escape_string($connect_db, $_POST['firearm_state']);
  $firearm_capacity =mysqli_real_escape_string($connect_db, $_POST['firearm_capacity']);
  $firearm_caliber =mysqli_real_escape_string($connect_db, $_POST['firearm_caliber']);
  $firearm_weight =mysqli_real_escape_string($connect_db, $_POST['firearm_weight']);
  $firearm_length =mysqli_real_escape_string($connect_db, $_POST['firearm_length']);
  $firearm_height =mysqli_real_escape_string($connect_db, $_POST['firearm_height']);
  $firearm_width =mysqli_real_escape_string($connect_db, $_POST['firearm_width']);
  $firearm_barrel =mysqli_real_escape_string($connect_db, $_POST['firearm_barrel']);
  $firearm_trigger_type =mysqli_real_escape_string($connect_db, $_POST['firearm_trigger_type']);
  $firearm_trigger_action =mysqli_real_escape_string($connect_db, $_POST['firearm_trigger_action']);
  $adminID =mysqli_real_escape_string($connect_db, $_POST['adminID']);
  $armourer_admin_name =mysqli_real_escape_string($connect_db, $_POST['armourer_admin_name']);
  $user_role =mysqli_real_escape_string($connect_db, $_POST['user_role']);
  $booking_status =mysqli_real_escape_string($connect_db, $_POST['booking_status']);
  $booking_check ="No"; 
  $seen_status = "Not";
  $bookings = "Inventory";
  $action_taken  ='Added New Firearm [ '.$firearm_serial_no.' '.$firearm_type.' '.$firearm_name.' ]';
  $armourer_admin_name = mysqli_real_escape_string($connect_db, $_POST['armourer_admin_name']);
  $adminID = mysqli_real_escape_string($connect_db, $_POST['adminID']);
  $user_role = mysqli_real_escape_string($connect_db, $_POST['user_role']);
  // form validation: ensure that the form is correctly filled ...
  // by adding (array_push()) corresponding error unto $errors array
  $firearm_image = $_FILES['firearm_image'];
  $firearm_image_name =$_FILES['firearm_image']['name'];
  $firearm_image_tmp =$_FILES['firearm_image']['tmp_name'];
  $firearm_image_size =$_FILES['firearm_image']['size'];
  $firearm_image_error =$_FILES['firearm_image']['error'];
  $firearm_image_type =$_FILES['firearm_image']['type'];
  $firearm_image_ext = explode('.', $firearm_image_name);
  $firearm_imageActual_ext = strtolower(end($firearm_image_ext));
  $firearm_image_allowed = array('png', 'jpg', 'jpeg', 'pdf', 'csv','xls', 'webp', "gif", "bmp");

  if (in_array($firearm_imageActual_ext, $firearm_image_allowed)) {
    if ($firearm_image_error === 0) {
      if ($firearm_image_size < 50000000) {
        if(empty($firearm_serial_no) || empty($firearm_name) || empty($firearm_type) ||
         empty($firearm_class)|| empty($quantity) || empty($firearm_image)){

          header('location: add-new-weapon?blank_error');

        }

        else if(firearm_serial_no_exist($firearm_serial_no)){
           
          header('location: add-new-weapon?serial_no_error');
        } 
         else{
          $firearm_image_name_new = uniqid('', true).".".$firearm_imageActual_ext;
          $fileDestination = "assets/images/firearm_images/".$firearm_image_name_new;
          move_uploaded_file($firearm_image_tmp, $fileDestination);
          $firearm_image = $firearm_image_name_new;

          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,`action_taken`,`user_role`,`booking_check`,`seen_status`,`bookings`)
          VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

          $sql_weapons="INSERT INTO `firearms`(`firearm_serial_no`, `manufacturer`, `firearm_type`, `firearm_name`, 
          `firearm_caliber`, `firearm_capacity`, `firearm_weight`, `firearm_length`, `firearm_height`, `firearm_width`,
           `firearm_barrel`, `firearm_trigger_type`, `firearm_trigger_action`, `quantity`, `firearm_class`, 
           `firearm_state`, `firearm_image`, `booking_status`)
            VALUES('$firearm_serial_no','$manufacturer','$firearm_type', '$firearm_name','$firearm_caliber',
            '$firearm_capacity','$firearm_weight','$firearm_length','$firearm_height','$firearm_width','$firearm_barrel',
            '$firearm_trigger_type','$firearm_trigger_action', '$quantity', '$firearm_class','$firearm_state','$firearm_image','$booking_status')";


            $sql_weapons2="INSERT INTO `firearms2`(`firearm_serial_no`, `manufacturer`, `firearm_type`, `firearm_name`, 
            `firearm_caliber`, `firearm_capacity`, `firearm_weight`, `firearm_length`, `firearm_height`, `firearm_width`,
             `firearm_barrel`, `firearm_trigger_type`, `firearm_trigger_action`, `quantity`, `firearm_class`, 
             `firearm_state`, `firearm_image`, `booking_status`) 
              VALUES('$firearm_serial_no','$manufacturer','$firearm_type', '$firearm_name','$firearm_caliber',
              '$firearm_capacity','$firearm_weight','$firearm_length','$firearm_height','$firearm_width','$firearm_barrel',
              '$firearm_trigger_type','$firearm_trigger_action', '$quantity', 
              '$firearm_class','$firearm_state','$firearm_image','$booking_status')";

        

              $result_weapons = Query($sql_weapons);
              confirm($result_weapons);
          
              $result_weapons2 = Query($sql_weapons2);
              confirm($result_weapons2);

              $result_action = Query($sql_admin_activities);
              confirm($result_action);

          header('location: assets-weapon?register_success');
        }
        
      }else{
        header('location: add-new-weapon?size_error');
      }

    }else {
      header('location: add-new-weapon?file_error');
    }

  }else{
    header('location: add-new-weapon?allow_error');
  }
}

// 
//Add new Ammunition...........................................................................
if (isset($_POST['add_new_ammo'])) {
  // receive all input values from the form
  $ammo_serial_no =mysqli_real_escape_string($connect_db, $_POST['ammo_serial_no']);
  $ammo_type = mysqli_real_escape_string($connect_db, $_POST['ammo_type']);
  $ammo_name = mysqli_real_escape_string($connect_db, $_POST['ammo_name']);
  $ammo_rounds = mysqli_real_escape_string($connect_db, $_POST['ammo_rounds']);
  $ammo_boxes = mysqli_real_escape_string($connect_db, $_POST['ammo_boxes']);
  $ammo_application =mysqli_real_escape_string($connect_db, $_POST['ammo_application']);
  $manufacturer =mysqli_real_escape_string($connect_db, $_POST['manufacturer']);
  $booking_status =mysqli_real_escape_string($connect_db, $_POST['booking_status']);
  // form validation: ensure that the form is correctly filled ...
  $armourer_admin_name = mysqli_real_escape_string($connect_db,$_POST['armourer_admin_name']);
  $user_role = mysqli_real_escape_string($connect_db,$_POST['user_role']);
  $adminID=mysqli_real_escape_string($connect_db,$_POST['adminID']);
  $action_taken ='Added New Ammo [ '.$ammo_serial_no.' '. $ammo_name.' ('. $ammo_type .' ) ]';
  // by adding (array_push()) corresponding error unto $errors array
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

  if (in_array($ammo_imageActual_ext, $ammo_image_allowed)) {
    if ($ammo_image_error === 0) {
      if ($ammo_image_size < 50000000) {
        if(empty($ammo_serial_no) || empty($ammo_name) || empty($ammo_type) || empty($ammo_rounds)){

          header('location: add-new-ammo?blank_error');

        } else if (ammo_serial_no_exist($ammo_serial_no)){
  
          header('location: add-new-ammo?serial_no_error');

        } else{
          $ammo_image_name_new = uniqid('', true).".".$ammo_imageActual_ext;
          $fileDestination = "assets/images/ammo_images/".$ammo_image_name_new;
          move_uploaded_file($ammo_image_tmp, $fileDestination);
          $ammo_image = $ammo_image_name_new;
                         
          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,`action_taken`,`user_role`,`booking_check`,`seen_status`,`bookings`)
          VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

          $sql_ammo="INSERT INTO `ammunitions`(`ammo_image`, `ammo_serial_no`,`manufacturer`, `ammo_type`, `ammo_name`,
           `ammo_application`,`ammo_boxes`, `ammo_rounds`,`booking_status`) VALUES ('$ammo_image','$ammo_serial_no','$manufacturer','$ammo_type','$ammo_name',
           '$ammo_application','$ammo_boxes','$ammo_rounds','$booking_status')";

          $sql_ammo2="INSERT INTO `ammunitions2`(`ammo_image`, `ammo_serial_no`,`manufacturer`, `ammo_type`,
            `ammo_name`, `ammo_application`,`ammo_boxes`, `ammo_rounds`,`booking_status`) 
            VALUES ('$ammo_image','$ammo_serial_no','$manufacturer','$ammo_type', '$ammo_name','$ammo_application',
           '$ammo_boxes', '$ammo_rounds','$booking_status')";

 
            $result_admin_activities = Query($sql_admin_activities);
            confirm($result_admin_activities);
                      
          $result_ammo = Query($sql_ammo);
          confirm($result_ammo);

          $result_ammo2 = Query($sql_ammo2);
          confirm($result_ammo2);

          header('location: ammunition?register_success');
        }
        
      }else{
        header('location: add-new-ammo?size_error');
      }

    }else {
      header('location: add-new-ammo?file_error');
    }

  }else{
    header('location: add-new-ammo?allow_error');
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
  $booking_check ="No"; 
  $seen_status = "Not";
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

  if (in_array($asset_imageActual_ext, $asset_image_allowed)) {
    if ($asset_image_error === 0) {
      if ($asset_image_size < 50000000) {
        if(empty($asset_serial_no) || empty($asset_name) || empty($asset_quantity)){

          header('location: add-new-other-assets?blank_error');

        }else if(asset_serial_no_exist($asset_serial_no)){

          header('location: add-new-other-assets?serial_no_error');

        }
         else{
          $asset_image_name_new = uniqid('', true).".".$asset_imageActual_ext;
          $fileDestination = "assets/images/asset_images/".$asset_image_name_new;
          move_uploaded_file($asset_image_tmp, $fileDestination);
          $asset_image = $asset_image_name_new;

          $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
          `armourer_admin_name`,`action_taken`,`user_role`,`booking_check`,`seen_status`,`bookings`)
          VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$seen_status','$bookings')";

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

          header('location: assets-other?register_success');
        }
        
      }else{
        header('location: add-new-other-assets?size_error');
      }

    }else {
      header('location: add-new-other-assets?file_error');
    }

  }else{
      header('location: add-new-other-assets?allow_error');
    
  }
}
//End of adding assets

