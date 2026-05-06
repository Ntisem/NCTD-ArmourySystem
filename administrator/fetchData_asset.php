
<?php  require_once('connections/connect-db.php');

require_once('functions.php');
require_once('includes/user_auth.php');

if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($connect_db,$_POST['search']);

    $query = "SELECT * FROM `other_assets` WHERE asset_name like '%$search%' or 
   asset_serial_no  LIKE '%$search%' or manufacturer LIKE '%$search%'";

    $result = mysqli_query($connect_db,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['assetID'],"value2"=>$row['asset_image'],"label" =>$row['asset_serial_no'].' '.$row['asset_name']);
    }
 
    echo json_encode($response);
}
 
exit;

?>