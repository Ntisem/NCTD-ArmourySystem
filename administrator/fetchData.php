
<?php  require_once('connections/connect-db.php');

require_once('functions.php');
require_once('includes/user_auth.php');

if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($connect_db,$_POST['search']);

    $query = "SELECT * FROM `firearms` WHERE product_name like '%$search%' AND booking_status = 'Available'
    or product_type like '%$search%' AND booking_status = 'Available'  or product_name like '%$search%' AND
     booking_status = 'Available' or product_class like '%$search%' AND booking_status = 'Available' 
    or firearm_trigger_action like '%$search%' AND booking_status = 'Available' or firearm_trigger_type like '%$search%' AND booking_status = 'Available' 
    or booking_status  like '%$search%' AND booking_status = 'Available' or firearm_caliber like '%$search%' AND booking_status = 'Available' or 
    firearm_capacity like '%$search%' AND booking_status = 'Available' or  productID  like '%$search%' AND booking_status = 'Available' or  
    product_state like '%$search%' AND booking_status = 'Available'";

    $result = mysqli_query($connect_db,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['productID'],"value2" => $row['quantity'],"value3" => 
        $row['product_class'],"label"=>$row['firearm_serial_no'].' '.$row['product_name']);
    }

    echo json_encode($response);
}

exit;




?>