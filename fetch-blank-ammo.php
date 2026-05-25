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
        $stmt = $pdo->prepare("SELECT ammoID, ammo_name, ammo_rounds, manufacturer FROM ammunitions WHERE ammo_name LIKE ? AND ammo_type = 'Blank-Ammo' AND is_deleted = 0 LIMIT 10");
        $stmt->execute([$search]);
        
        $response = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $response[] = [
                "value" => $row['ammoID'],
                "label" => $row['ammo_name'] . " (" . $row['manufacturer'] . ")",
                "stock" => $row['ammo_rounds']
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