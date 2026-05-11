<?php
require_once('connections/connect-db.php');
if(isset($_POST['field']) && isset($_POST['value'])) {
    $field = preg_replace('/[^a-zA-Z0-9_]/', '', $_POST['field']); 
    $stmt = $pdo->prepare("SELECT COUNT(*) FROM admin_lists WHERE $field = ?");
    $stmt->execute([$_POST['value']]);
    echo json_encode(['exists' => $stmt->fetchColumn() > 0]);
}