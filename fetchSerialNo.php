
<?php  require_once('connections/connect-db.php');

require_once('functions.php');
require_once('includes/user_auth.php');

if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($connect_db,$_POST['search']);

    $query = "SELECT * FROM `firearms` WHERE firearm_name like '%$search%' AND booking_status = 'Available'
    or firearm_type like '%$search%' AND booking_status = 'Available' AND booking_status = 'Available'
    or firearm_name like '%$search%' AND booking_status = 'Available' or firearm_class like '%$search%' AND booking_status = 'Available' 
    or  firearm_caliber like '%$search%' AND booking_status = 'Available' or firearm_capacity like '%$search%' AND booking_status = 'Available' or
    firearmID  like '%$search%' AND booking_status = 'Available' or  firearm_state like '%$search%' AND booking_status = 'Available'";

    $result = mysqli_query($connect_db,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['firearmID'],"value2"=>$row['firearm_serial_no'],"label"=>$row['firearm_serial_no'].'-'.$row['firearm_name']);
    }

    echo json_encode($response);
}

exit;




?>