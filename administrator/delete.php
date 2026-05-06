<?php
     require_once('connections/connect-db.php');
 
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
       

// deleting a sent message
if(isset($_GET['admin_mailboxID'])){

  $deleting_admin_mailboxID=$_GET['admin_mailboxID'];

 $sql = "DELETE FROM admin_mailbox WHERE `admin_mailboxID` = '$deleting_admin_mailboxID'";
 if(mysqli_query($connect_db, $sql))
 {
   header('location:sent-messages?delete_success');
  }
  else{
      header('location:sent-messages?delete_error');
  }

} 

// deleting a received message
if(isset($_GET['messageID'])){

  $deleting_messageID=$_GET['messageID'];

 $sql = "DELETE FROM mailbox WHERE `messageID` = '$deleting_messageID'";
 if(mysqli_query($connect_db, $sql))
 {
   header('location:received-messages?delete_success');
  }
  else{
      header('location:received-messages?delete_error');
  }

}


// deleting admin
if(isset($_GET['adminID']) && isset($_GET['armourer-admin-name']) && isset($_GET['user-role']) 
&& isset($_GET['adminID-armourerID']) && isset($_GET['admin-name'])){

      $deleting_adminID=$_GET['adminID'];
      $adminID_armourerID=$_GET['adminID-armourerID'];
      $armourer_admin_name = $_GET['armourer-admin-name'];
      $user_role = $_GET['user-role'];
      $action_taken = 'Deleted an [ '.$_GET['admin-name'].' ]';

     $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, `armourer_admin_name`,`action_taken`, `user_role`)
    VALUES ('$adminID_armourerID','$armourer_admin_name','$action_taken','$user_role')";

    $result_admin_activities = Query($sql_admin_activities);
    confirm($result_admin_activities);

 $sql = "DELETE FROM `admin_lists` WHERE `adminID` = '$deleting_adminID'";
 if(mysqli_query($connect_db, $sql))
 {
  // unlink("ass".$service_no);
   header('location:administrators?delete_success');
  }
  else{
       header('location:administrators?delete_error');
      // echo 'error occurred 2';
  }

}

// deleting admin
if(isset($_GET['armourerID']) && isset($_GET['armourer-admin-name']) && isset($_GET['user-role']) 
&& isset($_GET['adminID-armourerID']) && isset($_GET['armourer-name'])){

      $deleting_armourerID=$_GET['armourerID'];
      $adminID_armourerID=$_GET['adminID-armourerID'];
      $armourer_admin_name = $_GET['armourer-admin-name'];
      $user_role = $_GET['user-role'];
      $action_taken = 'Deleted an [ '.$_GET['armourer-name'].' ]';

     $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, `armourer_admin_name`,`action_taken`, `user_role`)
    VALUES ('$adminID_armourerID','$armourer_admin_name','$action_taken','$user_role')";

    $result_admin_activities = Query($sql_admin_activities);
    confirm($result_admin_activities);

 $sql = "DELETE FROM `admin_lists` WHERE `adminID` = '$deleting_armourerID'";
 if(mysqli_query($connect_db, $sql))
 {
  // unlink("ass".$service_no);
   header('location:armourers?delete_success');
  }
  else{
       header('location:armourers?delete_error');
      // echo 'error occurred 2';
  }

}
// deleting Officer

if(isset($_GET['officerID']) && isset($_GET['armourer-admin-name']) && isset($_GET['user-role']) 
&& isset($_GET['adminID']) && isset($_GET['officer-name'])){

      $deleting_officerID=$_GET['officerID'];
      $adminID=$_GET['adminID'];
      $armourer_admin_name = $_GET['armourer-admin-name'];
      $user_role = $_GET['user-role'];
      $action_taken = 'Deleted an Officer [ '.$_GET['officer-name'].' ]';

  $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
  `armourer_admin_name`,  `action_taken`, `user_role`)
    VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

    $result_admin_activities = Query($sql_admin_activities);
    confirm($result_admin_activities);


 $sql = "DELETE FROM `officers` WHERE `officerID` = '$deleting_officerID'";
 if(mysqli_query($connect_db, $sql))
 {
  // unlink("ass".$officer_service_no);
   header('location:officers-list?delete_success');
  }
  else{
      header('location:officers-list?delete_error');
  }

}

// deleting Weapon

if(isset($_GET['firearmID']) && isset($_GET['armourer-admin-name']) && isset($_GET['user-role']) 
&& isset($_GET['adminID']) && isset($_GET['firearm'])){

      $deleting_firearmID=$_GET['firearmID'];
      $adminID=$_GET['adminID'];
      $armourer_admin_name = $_GET['armourer-admin-name'];
      $user_role = $_GET['user-role'];
      $action_taken = 'Deleted Firearm [ '.$_GET['firearm'].' ]';

  $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
  `armourer_admin_name`,  `action_taken`, `user_role`)
    VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

    $result_admin_activities = Query($sql_admin_activities);
    confirm($result_admin_activities);

 $sql = "DELETE FROM `firearms` WHERE `firearmID` = '$deleting_firearmID'";
 if(mysqli_query($connect_db, $sql))
 {
  // unlink("ass".$firearm_serial_no);
   header('location:assets-weapon?delete_success');
  }
  else{
      header('location:assets-weapon?delete_error');
  }

}


// deleting booking ticket

if(isset($_GET['bookingID']) && isset($_GET['armourer-admin-name']) && isset($_GET['user-role']) 
&& isset($_GET['adminID']) && isset($_GET['booking-ticket'])){

      $deleting_bookingID=$_GET['bookingID'];
      $adminID=$_GET['adminID'];
      $armourer_admin_name = $_GET['armourer-admin-name'];
      $user_role = $_GET['user-role'];
      $action_taken = 'Deleted Booking Ticket [ '.$_GET['booking-ticket'].' ]';

  $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
  `armourer_admin_name`,  `action_taken`, `user_role`)
    VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

    $result_admin_activities = Query($sql_admin_activities);
    confirm($result_admin_activities);

 $sql = "DELETE FROM `bookings` WHERE `bookingID` = '$deleting_bookingID'";
 if(mysqli_query($connect_db, $sql))
 {
  // unlink("ass".$firearm_serial_no);
   header('location:booking-history?delete_success');
  }
  else{
      header('location:booking-history?delete_error');
  }

}

// deleting Ammunition

if(isset($_GET['ammoID']) && isset($_GET['armourer-admin-name']) && isset($_GET['user-role']) 
&& isset($_GET['adminID']) && isset($_GET['name-ammo'])){

      $deleting_ammoID=$_GET['ammoID'];
      $adminID=$_GET['adminID'];
      $armourer_admin_name = $_GET['armourer-admin-name'];
      $user_role = $_GET['user-role'];
      $action_taken = 'Deleted Ammunition(s) [ '.$_GET['name-ammo'].' ]';

  $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
  `armourer_admin_name`,  `action_taken`, `user_role`)
    VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

    $result_admin_activities = Query($sql_admin_activities);
    confirm($result_admin_activities);


 $sql = "DELETE FROM `ammunitions` WHERE `ammoID` = '$deleting_ammoID'";
 if(mysqli_query($connect_db, $sql))
 {
  // unlink("ass".$ammo_serial_no);
   header('location:ammunition?delete_success');
  }
  else{
      header('location:ammunition?delete_error');
  }

}
// deleting Ammunition Ends
// deleting Other Asset

if(isset($_GET['assetID']) && isset($_GET['armourer-admin-name']) && isset($_GET['user-role']) 
&& isset($_GET['adminID']) && isset($_GET['name-asset'])){

      $deleting_assetID=$_GET['assetID'];
      $adminID=$_GET['adminID'];
      $armourer_admin_name = $_GET['armourer-admin-name'];
      $user_role = $_GET['user-role'];
      $action_taken = 'Deleted an Asset(s) [ '.$_GET['name-asset'].' ]';

  $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
  `armourer_admin_name`,  `action_taken`, `user_role`)
    VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

    $result_admin_activities = Query($sql_admin_activities);
    confirm($result_admin_activities);

 $sql = "DELETE FROM `other_assets` WHERE `assetID` = '$deleting_assetID'";
 if(mysqli_query($connect_db, $sql))
 {
  // unlink("ass".$firearm_serial_no);
   header('location:assets-other?delete_success');
  }
  else{
      header('location:assets-other?delete_error');
  }

}
// deleting booking Asset Other

if(isset($_GET['booked-assetID']) && isset($_GET['armourer-admin-name']) && isset($_GET['user-role']) 
&& isset($_GET['adminID']) && isset($_GET['booked-asset-ticket'])){

      $deleting_booking_assetID=$_GET['booked-assetID'];
      $adminID=$_GET['adminID'];
      $armourer_admin_name = $_GET['armourer-admin-name'];
      $user_role = $_GET['user-role'];
      $action_taken = 'Deleted Booked Asset Ticket-GPS-BookA-[ '.$_GET['booked-asset-ticket'].' ]';

  $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
  `armourer_admin_name`,  `action_taken`, `user_role`)
    VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

    $result_admin_activities = Query($sql_admin_activities);
    confirm($result_admin_activities);

 $sql = "DELETE FROM `asset_bookings` WHERE `bookAssetID` = '$deleting_booking_assetID'";
 if(mysqli_query($connect_db, $sql))
 {
  // unlink("ass".$firearm_serial_no);
   header('location:booked-other-assets?delete_success');
  }
  else{
      header('location:booked-other-assets?delete_error');
  }

}
// deleting booking Ammo 

if(isset($_GET['booked-ammoID']) && isset($_GET['armourer-admin-name']) && isset($_GET['user-role']) 
&& isset($_GET['adminID']) && isset($_GET['booked-ammo-ticket'])){

      $deleting_book_ammoID=$_GET['booked-ammoID'];
      $adminID=$_GET['adminID'];
      $armourer_admin_name = $_GET['armourer-admin-name'];
      $user_role = $_GET['user-role'];
      $action_taken = 'Deleted Booked Ammo Ticket [ '.$_GET['booked-ammo-ticket'].' ]';

  $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
  `armourer_admin_name`,  `action_taken`, `user_role`)
    VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

    $result_admin_activities = Query($sql_admin_activities);
    confirm($result_admin_activities);

 $sql = "DELETE FROM `ammo_bookings` WHERE `book_ammoID` = '$deleting_book_ammoID'";
 if(mysqli_query($connect_db, $sql))
 {
  // unlink("ass".$firearm_serial_no);
   header('location:booked-ammo?delete_success');
  }
  else{
      header('location:booked-ammo?delete_error');
  }

}

// deleting faulty Firearm

if(isset($_GET['faulty-weaponID']) && isset($_GET['armourer-admin-name']) && isset($_GET['user-role']) 
&& isset($_GET['adminID']) && isset($_GET['faulty-firearm'])){

      $deleting_faulty_weaponID=$_GET['faulty-weaponID'];
      $adminID=$_GET['adminID'];
      $armourer_admin_name = $_GET['armourer-admin-name'];
      $user_role = $_GET['user-role'];
      $action_taken = 'Deleted Faulty Firearm [ '.$_GET['faulty-firearm'].' ]';

  $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
  `armourer_admin_name`,  `action_taken`, `user_role`)
    VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

    $result_admin_activities = Query($sql_admin_activities);
    confirm($result_admin_activities);

    $sql = "DELETE FROM `faulty_weapons` WHERE `faulty_weaponID` = '$deleting_faulty_weaponID'";
    if(mysqli_query($connect_db, $sql))
    {
      // unlink("ass".$firearm_serial_no);
       header('location:faulty-weapon?delete_success');

      }
      else{

          header('location:faulty-weapon?delete_error');
      }

}

// deleting faulty Firearm


// deleting faulty Ammunition

if(isset($_GET['faulty-ammoID']) && isset($_GET['armourer-admin-name']) && isset($_GET['user-role']) 
&& isset($_GET['adminID']) && isset($_GET['faulty-ammo'])){

      $deleting_faulty_ammoID=$_GET['faulty-ammoID'];
      $adminID=$_GET['adminID'];
      $armourer_admin_name = $_GET['armourer-admin-name'];
      $user_role = $_GET['user-role'];
      $action_taken = 'Deleted Faulty Ammunition(s) [ '.$_GET['faulty-ammo'].' ]';

  $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
  `armourer_admin_name`,  `action_taken`, `user_role`)
    VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

    $result_admin_activities = Query($sql_admin_activities);
    confirm($result_admin_activities);

 
  // $deleting_asset_serial_no=$_GET['asset_serial_no'];


 $sql = "DELETE FROM `faulty_ammo` WHERE `faulty_ammoID` = '$deleting_faulty_ammoID'";
 if(mysqli_query($connect_db, $sql))
 {
  // unlink("ass".$firearm_serial_no);
   header('location:faulty-ammo?delete_success');
  }
  else{
      header('location:faulty-ammo?delete_error');
  }

}

// End deleting faulty Ammunition

// deleting faulty Asset

if(isset($_GET['faulty-assetID']) && isset($_GET['armourer-admin-name']) && isset($_GET['user-role']) 
&& isset($_GET['adminID']) && isset($_GET['faulty-asset'])){

      $deleting_faulty_assetID=$_GET['faulty-assetID'];
      $adminID=$_GET['adminID'];
      $armourer_admin_name = $_GET['armourer-admin-name'];
      $user_role = $_GET['user-role'];
      $action_taken = 'Deleted Faulty Asset(s) [ '.$_GET['faulty-asset'].' ]';

  $sql_admin_activities = "INSERT INTO `daily_activities`(`adminID`, 
  `armourer_admin_name`,  `action_taken`, `user_role`)
    VALUES ('$adminID','$armourer_admin_name','$action_taken','$user_role')";

    $result_admin_activities = Query($sql_admin_activities);
    confirm($result_admin_activities);

 $sql = "DELETE FROM `faulty_asset` WHERE `faulty_assetID` = '$deleting_faulty_assetID'";
 if(mysqli_query($connect_db, $sql))
 {
  // unlink("ass".$firearm_serial_no);
   header('location:faulty-assets?delete_success');
  }
  else{
      header('location:faulty-assets?delete_error');
  }

}

//End  deleting faulty Asset