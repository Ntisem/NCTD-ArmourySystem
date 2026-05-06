
<?php  require_once('connections/connect-db.php');

require_once('functions.php');
require_once('includes/user_auth.php');

if(isset($_POST['search'])){
    $search = mysqli_real_escape_string($connect_db,$_POST['search']);

    $query = "SELECT * FROM `officers` WHERE officer_service_no like '%$search%' or 
                full_name like '%$search%' or rank like'%$search%'  or gender like '%$search%'
                or officer_email like '%$search%' or phone_no like '%$search%' or
                 officer_image  like '%$search%'";

    $result = mysqli_query($connect_db,$query);
    
    while($row = mysqli_fetch_array($result) ){
        $response[] = array("value"=>$row['officerID'],"value2" => $row['officer_image'],"label" =>$row['officer_service_no'].' '.$row['rank'].' '.$row['full_name']);
    }

    echo json_encode($response);
}

exit;

?>