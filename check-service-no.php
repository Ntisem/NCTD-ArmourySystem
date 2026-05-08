<?php
require_once('connections/connect-db.php');

if (isset($_POST['service_no'])) {
    $service_no = trim($_POST['service_no']);
    
    $stmt = $pdo->prepare("SELECT officer_service_no FROM officers WHERE officer_service_no = ?");
    $stmt->execute([$service_no]);
    
    if ($stmt->rowCount() > 0) {
        echo "taken";
    } else {
        echo "available";
    }
}
?>