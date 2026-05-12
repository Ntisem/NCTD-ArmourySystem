<?php  
require_once('connections/connect-db.php');

if (isset($_POST['type']) && isset($_POST['value'])) {
    $column = $_POST['type'];
    $val = strtoupper(trim($_POST['value']));
    
    if ($column !== 'firearm_manufacturer') exit;

    $stmt = $pdo->prepare("SELECT COUNT(*) FROM firearm_manufacturers WHERE $column = ?");
    $stmt->execute([$val]);
    
    if ($stmt->fetchColumn() > 0) {
        echo "<small style='color:#ff4b2b; font-family: monospace;'>[!] DUPLICATE_DETECTED</small>";
    } else {
        echo "<small style='color:#00ffa3; font-family: monospace;'>[✓] UNIQUE_ENTRY</small>";
    }
}
?>