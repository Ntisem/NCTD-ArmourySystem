<?php  
require_once('connections/connect-db.php');
require_once("functions.php");
require_once('includes/user_auth.php');

if(!empty($_POST["new_firearm_name"])){
    $name = strtoupper(trim($_POST["new_firearm_name"]));
    
    try {
        $stmt = $pdo->prepare("SELECT firearm_name FROM firearm_name WHERE firearm_name = ? LIMIT 1");
        $stmt->execute([$name]);
        
        if($stmt->fetch()){
            echo "<code style='color:#ff4b2b'> [!] FIREARM NAME CONFLICT </code>";
            echo "<script>jQuery('#submit-name').prop('disabled',true).css('opacity','0.5');</script>";
        } else {
            echo "<code style='color:#00ffa3'> [✓] DESIGNATION UNIQUE </code>";
            echo "<script>jQuery('#submit-name').prop('disabled',false).css('opacity','1');</script>";
        }
    } catch (PDOException $e) {
        echo "<code>LINK_ERR</code>";
    }
}
?>