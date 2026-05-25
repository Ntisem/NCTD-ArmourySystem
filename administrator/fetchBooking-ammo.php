<?php
require_once('connections/connect-db.php');

if (isset($_POST['search'])) {
    $search = "%" . $_POST['search'] . "%";
    
    // Select the necessary fields including manufacturer
    $stmt = $pdo->prepare("SELECT ammoID, ammo_name, manufacturer, ammo_rounds FROM ammunitions WHERE ammo_name LIKE ? AND is_deleted = 0 LIMIT 10");
    $stmt->execute([$search]);
    
    $response = [];
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $response[] = [
            "id"           => $row['ammoID'],
            "label"        => $row['ammo_name'],
            "value"        => $row['ammo_name'], // Set value to text so input field populates nicely
            "manufacturer" => $row['manufacturer'],
            "stock"        => $row['ammo_rounds']
        ];
    }
    echo json_encode($response);
    exit();
}