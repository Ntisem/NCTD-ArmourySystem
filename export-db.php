<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

// Security Check: Only Armourers can backup
if($_SESSION["user_role"] != 'Armourer') { exit("UNAUTHORIZED_ACCESS"); }

$tables = array();
$stmt_tables = $pdo->query("SHOW TABLES");
while($row = $stmt_tables->fetch(PDO::FETCH_NUM)) { $tables[] = $row[0]; }

$return = " NATIONAL COUNTER TERRORISM DEPT SYSTEM BACKUP\n-- DATE: " . date('Y-m-d H:i:s') . "\n\n";

foreach($tables as $table) {
    // Fetch data using PDO
    $stmt_data = $pdo->query("SELECT * FROM $table");
    $num_fields = $stmt_data->columnCount();
    
    $return .= "DROP TABLE IF EXISTS $table;";
    $stmt_create = $pdo->query("SHOW CREATE TABLE $table");
    $row2 = $stmt_create->fetch(PDO::FETCH_NUM);
    $return .= "\n\n" . $row2[1] . ";\n\n";
    
    while($row = $stmt_data->fetch(PDO::FETCH_NUM)) {
        $return .= "INSERT INTO $table VALUES(";
        for($j=0; $j<$num_fields; $j++) {
            if (isset($row[$j])) { 
                $row[$j] = addslashes($row[$j]);
                $return .= '"'.$row[$j].'"' ; 
            } else { 
                $return .= '""'; 
            }
            if ($j<($num_fields-1)) { $return .= ','; }
        }
        $return .= ");\n";
    }
    $return .= "\n\n\n";
}

// Set Headers for Download
$filename = 'NCTD_ARMOURY_DB_BACKUP_'.date('Ymd_His').'.sql';
header('Content-type: application/sql');
header('Content-Disposition: attachment; filename="'.$filename.'"');
echo $return;
exit();
?>