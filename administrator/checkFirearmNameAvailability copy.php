<?php  
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!empty($_POST["new_firearm_name"])){
    $name = strtoupper(trim($_POST["new_firearm_name"]));
    
    try {
        $stmt = $pdo->prepare("SELECT new_firearm_name FROM firearm_name WHERE new_firearm_name = ? LIMIT 1");
        $stmt->execute([$name]);
        
        if($stmt->fetch()){
            echo "<code style='color:#ff4b2b'> [!] CONFLICT: NAME_TAKEN </code>";
            echo "<script>jQuery('#submit-name').prop('disabled',true).css('opacity','0.5');</script>";
        } else {
            echo "<code style='color:#00ffa3'> [✓] READY: DESIGNATION_CLEAR </code>";
            echo "<script>jQuery('#submit-name').prop('disabled',false).css('opacity','1');</script>";
        }
    } catch (PDOException $e) {
        echo "<code>[ERR]: LINK_FAILURE</code>";
    }
}
?>