<?php
require_once('connections/connect-db.php');
if(isset($_POST['search'])){
    $search = "%" . $_POST['search'] . "%";
    $stmt = $pdo->prepare("SELECT * FROM firearms WHERE (firearm_serial_no LIKE ? OR firearm_name LIKE ?) AND booking_status = 'Available' LIMIT 10");
    $stmt->execute([$search, $search]);
    
    $response = [];
    while($row = $stmt->fetch()){
        $response[] = [
            "value" => $row['firearmID'],
            "serial" => $row['firearm_serial_no'],
            "name" => $row['firearm_name'],
            "label" => $row['firearm_serial_no'] . " - " . $row['firearm_name']
        ];
    }
    echo json_encode($response);
}