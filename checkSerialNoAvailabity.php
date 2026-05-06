<?php  
require_once('connections/connect-db.php');
require_once ("functions.php");
require_once('includes/user_auth.php');

// 1. Check Firearms Table
if(!empty($_POST["firearm_serial_no"])){
    $serial = trim($_POST["firearm_serial_no"]);
    try {
        $stmt = $pdo->prepare("SELECT firearm_serial_no FROM firearms WHERE firearm_serial_no = ?");
        $stmt->execute([$serial]);
        
        if($stmt->fetch()){
            echo "<code style='color:red'> Sorry... Serial Number already exists</code>";
            echo "<script>$('#add-admin-store-keeper').prop('disabled',true);</script>";
        } else {
            echo "<code style='color:green'> Serial Number available</code>";
            echo "<script>$('#add-admin-store-keeper').prop('disabled',false);</script>";
        }
    } catch (PDOException $e) { echo "ERR_CORE_DB"; }
}

// 2. Check Bookings Table
if(!empty($_POST["firearm_name"])){
    $name = trim($_POST["firearm_name"]);
    try {
        $stmt = $pdo->prepare("SELECT firearm_name FROM bookings WHERE firearm_name = ?");
        $stmt->execute([$name]);
        
        if($stmt->fetch()){
            echo "<code style='color:red'> Sorry... Asset Name already in use</code>";
            echo "<script>$('#add-admin-store-keeper').prop('disabled',true);</script>";
        } else {
            echo "<code style='color:green'> Asset Name available</code>";
            echo "<script>$('#add-admin-store-keeper').prop('disabled',false);</script>";
        }
    } catch (PDOException $e) { echo "ERR_BKG_DB"; }
}
?>