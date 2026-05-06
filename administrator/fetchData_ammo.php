
<?php  require_once('connections/connect-db.php');

require_once('functions.php');
require_once('includes/user_auth.php');

if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($connect_db,$_POST['search']);

    $query = "SELECT * FROM `ammunitions` WHERE ammo_name like '%$search%' or
    manufacturer like '%$search%' or ammo_type like '%$search%' or ammo_name like '%$search%' or 
    ammo_application like '%$search%' or ammo_type like '%$search%'";

    $result = mysqli_query($connect_db,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['ammoID'],"value2"=>$row['ammo_rounds'],"label" =>$row['ammo_serial_no'].' '.$row['ammo_name'].' ['.$row['ammo_type'].']');
    }
 
    echo json_encode($response);
}
 
exit;

?>