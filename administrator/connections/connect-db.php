
<?php
// connections/connect-db.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$host = 'localhost';
$db   = 'gps_armoury_database';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

$connect_db = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
     $pdo = new PDO($connect_db, $user, $pass, $options);
} catch (\PDOException $e) {
     die("Database Connection Error: " . $e->getMessage());
}
?>
