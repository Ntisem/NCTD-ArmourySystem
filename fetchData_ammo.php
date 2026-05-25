<?php
require_once('connections/connect-db.php');
if(isset($_POST['search'])){
    $search = "%" . $_POST['search'] . "%";
    $stmt = $pdo->prepare("SELECT * FROM ammunitions WHERE ammo_name LIKE ? AND ammo_type = 'Live-Ammo' AND is_deleted = 0 LIMIT 10");
    $stmt->execute([$search]);
    
    $response = [];
    while($row = $stmt->fetch()){
        $response[] = [
            "value" => $row['ammoID'],
            "label" => $row['ammo_name'],
            "stock" => $row['ammo_rounds']
        ];
    }
    echo json_encode($response);
}