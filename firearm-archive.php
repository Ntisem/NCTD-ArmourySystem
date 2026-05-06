<?php 
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

// Fetch ONLY soft-deleted assets
$stmt = $pdo->query("SELECT * FROM firearms WHERE is_deleted = 1 ORDER BY datetime DESC");
$archived_assets = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>HQ COMMAND | ARCHIVE</title>
    </head>
<body class="bg-dark text-white">
    <div class="container-scroller">
        <div class="main-panel">
            <div class="content-wrapper">
                <h3 class="text-danger mb-4"><i class="mdi mdi-delete-restore"></i> RECYCLE_BIN // ARCHIVED_ASSETS</h3>
                
                <div class="card table-tactical">
                    <div class="card-body">
                        <table class="table table-dark table-hover">
                            <thead>
                                <tr>
                                    <th>SERIAL_NO</th>
                                    <th>NAME</th>
                                    <th>TYPE</th>
                                    <th>ARCHIVE_REASON</th>
                                    <th>OPERATIONS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($archived_assets as $asset): ?>
                                <tr>
                                    <td><strong><?= htmlspecialchars($asset['firearm_serial_no']) ?></strong></td>
                                    <td><?= htmlspecialchars($asset['firearm_name']) ?></td>
                                    <td><?= htmlspecialchars($asset['firearm_type']) ?></td>
                                    <td><span class="text-muted small"><?= htmlspecialchars($asset['remarks']) ?></span></td>
                                    <td>
                                        <form action="process-weapon-restore.php" method="POST">
                                            <input type="hidden" name="restore_id" value="<?= $asset['firearmID'] ?>">
                                            <button type="submit" name="confirm_restore" class="btn btn-xs btn-outline-success">
                                                RESTORE_ASSET
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>