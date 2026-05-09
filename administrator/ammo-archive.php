<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

$stmt = $pdo->query("SELECT * FROM ammunitions WHERE is_deleted = 1 ORDER BY datetime DESC");
$archived = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HQ COMMAND | AMMO_ARCHIVE</title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
</head>
<body class="bg-dark text-white">
    <div class="container-scroller p-4">
        <h3 class="text-danger"><i class="mdi mdi-delete-variant"></i> AMMO_RECYCLE_BIN</h3>
        <hr class="border-danger">
        
        <table class="table table-dark">
            <thead>
                <tr>
                    <th>NAME</th>
                    <th>ROUNDS</th>
                    <th>ARCHIVE_DATE</th>
                    <th>ACTIONS</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($archived as $row): ?>
                <tr>
                    <td><?= $row['ammo_name'] ?></td>
                    <td><?= $row['ammo_rounds'] ?></td>
                    <td><?= $row['datetime'] ?></td>
                    <td>
                        <form action="process-ammo-restore.php" method="POST">
                            <input type="hidden" name="restore_id" value="<?= $row['ammoID'] ?>">
                            <button type="submit" class="btn btn-xs btn-success">RESTORE_STOCK</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="ammunition.php" class="btn btn-outline-info">RETURN_TO_INVENTORY</a>
    </div>
</body>
</html>