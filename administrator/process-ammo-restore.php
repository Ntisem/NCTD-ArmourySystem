<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['restore_id'];
    try {
        $stmt = $pdo->prepare("UPDATE ammunitions SET is_deleted = 0 WHERE ammoID = ?");
        $stmt->execute([$id]);
        
        header("Location: ammo-archive?status=success");
    } catch (Exception $e) {
        header("Location: ammo-archive?status=error");
    }
}