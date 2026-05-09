<?php  
require_once('connections/connect-db.php');

if (isset($_POST['type']) && isset($_POST['value'])) {
    $column = $_POST['type'];
    $val = strtoupper(trim($_POST['value']));
    
    // Security: Whitelist columns
    $allowed = ['firearm_category', 'firearm_manufacturer', 'firearm_caliber'];
    if (!in_array($column, $allowed)) {
        header('Content-Type: application/json');
        echo json_encode(['error' => 'INVALID_COLUMN']);
        exit;
    }

    try {
        $stmt = $pdo->prepare("SELECT COUNT(*) FROM firearm_categories WHERE $column = ?");
        $stmt->execute([$val]);
        $exists = $stmt->fetchColumn() > 0;

        if ($exists) {
            echo "<small style='color:#ff4b2b; font-family: monospace;'>[!] DUPLICATE_DETECTED</small>";
        } else {
            echo "<small style='color:#00ffa3; font-family: monospace;'>[✓] UNIQUE_ENTRY</small>";
        }
    } catch (PDOException $e) {
        echo "<small style='color:orange;'>LINK_ERR</small>";
    }
    exit();
}