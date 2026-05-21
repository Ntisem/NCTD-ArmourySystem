<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

header('Content-Type: application/json');

if (!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    echo json_encode([]);
    exit();
}

if (isset($_POST['search']) && trim($_POST['search']) !== '') {
    $search = "%" . trim($_POST['search']) . "%";
    try {
        $stmt = $pdo->prepare("SELECT faulty_ammoID, faulty_ammo_name, faulty_ammo_quantity, faulty_ammo_manufacturer FROM faulty_ammo WHERE faulty_ammo_name LIKE ? AND is_deleted = 0 LIMIT 10");
        $stmt->execute([$search]);
        
        $response = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $response[] = [
                "value" => $row['faulty_ammoID'],
                "label" => $row['faulty_ammo_name'] . " (" . $row['faulty_ammo_manufacturer'] . ")",
                "stock" => $row['faulty_ammo_quantity']
            ];
        }
        echo json_encode($response);
        exit();
    } catch (PDOException $e) {
        echo json_encode([]);
        exit();
    }
}
echo json_encode([]);
?>