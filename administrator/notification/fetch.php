<?php
require_once('db.php');
require_once('functions.php');
$db = new Connect; // connection to the database
$data = []; // storing everything/data
global $tbl_Notifications;


//using a key to fetch data
if(isset($_POST['key']) && $_POST['key'] == '123'){

//fetch the elements form the database
$notifications = $db->prepare("SELECT * FROM $tbl_Notifications order by id desc limit 10");
$notifications ->execute();
// count how many notification in the database
$n_notifications = $notifications -> rowCount();

//checking if there is notification in the db/number
if($n_notifications > 0){ 
    // if the notification is active it will count the number
    $n_number = $db->prepare("SELECT * FROM $tbl_Notifications WHERE
     `noti_status` = 'active' order by id desc");
     $n_number -> execute();
     $n_numbers = $n_number -> rowCount();
    
    // pushing data the into data  array of data
     array_push($data,(object)[
        'total' => $n_numbers, // it how count many notification in db

     ]);
     // have to loop through out db
     while ($notification = $notifications -> fetch(PDO::FETCH_ASSOC)){
        //storing every data into data array ($data)
        $data[] = $notification;
     }
}  
  // converting everything json format
  echo json_encode($data);
 };

// fetch elements which are not active from the database
  if(isset($_POST['key']) && $_POST['key'] == '1234'){
     // making a variable
     $countActiveNoti = $db->prepare("UPDATE $tbl_Notifications SET noti_status = 'inactive' 
     WHERE noti_status = 'active'");
     $countActiveNoti -> execute();

  }
  //NOT CALLED KEY 
  if(!isset($_POST["key"]) && empty($_POST["key"])){
    echo "API ERROR";

  }

?>