<?php
require_once('connections/connect-db.php');

$term = $_GET['term'] ?? '';
$stmt = $pdo->prepare("SELECT firearmID, firearm_name, firearm_serial_no FROM firearms 
                       WHERE (firearm_name LIKE ? OR firearm_serial_no LIKE ?) 
                       AND booking_status = 'Available' LIMIT 10");
$stmt->execute(["%$term%", "%$term%"]);

$results = [];
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $results[] = [
        'label' => $row['firearm_name'] . " [" . $row['firearm_serial_no'] . "]",
        'value' => $row['firearmID'],
        'serial' => $row['firearm_serial_no']
    ];
}
echo json_encode($results);