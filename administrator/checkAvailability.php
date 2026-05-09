<?php  
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!empty($_POST["firearm_serial_no"])) {
    $serial = strtoupper(trim($_POST["firearm_serial_no"]));
    
    try {
        $stmt = $pdo->prepare("SELECT firearm_serial_no FROM firearms WHERE firearm_serial_no = ? LIMIT 1");
        $stmt->execute([$serial]);
        
        if($stmt->fetch()) {
            echo "<span style='color:#ff4b2b'>[!] CONFLICT: SERIAL_EXISTS</span>";
            echo "<script>$('#submit-btn').prop('disabled', true).css('opacity', '0.5');</script>";
        } else {
            echo "<span style='color:#00ffa3'>[✓] VERIFIED: UNIQUE</span>";
            echo "<script>$('#submit-btn').prop('disabled', false).css('opacity', '1');</script>";
        }
    } catch (PDOException $e) {
        echo "<span>ERR_DB_CON</span>";
    }
}
?>