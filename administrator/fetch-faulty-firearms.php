<?php
require_once('connections/connect-db.php');

$term = $_GET['term'] ?? '';
$stmt = $pdo->prepare("SELECT * FROM firearms WHERE (firearm_name LIKE ? OR firearm_serial_no LIKE ? OR firearm_type LIKE ? OR firearm_class LIKE ? ) 
                       AND booking_status = 'Available' LIMIT 10");
$stmt->execute(["%$term%", "%$term%", "%$term%", "%$term%"]);

$results = [];
while($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    $results[] = [
        'label' => $row['firearm_name'] . " [" . $row['firearm_serial_no'] . "]",
        'value' => $row['firearmID'],
        'serial' => $row['firearm_serial_no'],
        'f_name' => $row['firearm_name'],
        'f_type' => $row['firearm_type'],
        'f_class' => $row['firearm_class']
    ];
}
echo json_encode($results);
?>