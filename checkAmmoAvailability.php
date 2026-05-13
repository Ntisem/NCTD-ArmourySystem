<?php  
require_once('connections/connect-db.php');
require_once("functions.php");
require_once('includes/user_auth.php');



if(!empty($_POST["ammo_name"])){
    $name = trim($_POST["ammo_name"]);
    
    try {
        $stmt = $pdo->prepare("SELECT ammo_name FROM ammunitions WHERE ammo_name = ? LIMIT 1");
        $stmt->execute([$name]);
        
        if($stmt->fetch()){
            echo "<code style='color:#ff4b2b'> [!] ALERT: NAME RECORDED IN SYSTEM</code>";
            echo "<script>jQuery('#submit-ammo').prop('disabled',true).css('opacity','0.5');</script>";
        } else {
            echo "<code style='color:#00ffa3'> [✓] READY: UNIQUE DESIGNATION</code>";
            echo "<script>jQuery('#submit-ammo').prop('disabled',false).css('opacity','1');</script>";
        }
    } catch (PDOException $e) {
        echo "<code style='color:orange'> [!] DB_LINK_ERROR </code>";
    }
}
?>