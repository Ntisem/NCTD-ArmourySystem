<?php
require_once('connections/connect-db.php');
if(isset($_POST['search'])){
    $search = "%" . $_POST['search'] . "%";
    $stmt = $pdo->prepare("SELECT * FROM officers WHERE full_name LIKE ? OR officer_service_no LIKE ? LIMIT 10");
    $stmt->execute([$search, $search]);
    
    $response = [];
    while($row = $stmt->fetch()){
        $response[] = [
            "value" => $row['officerID'],
            "label" => $row['officer_service_no'] . " " . $row['rank'] . " " . $row['full_name']
        ];
    }
    echo json_encode($response);
}