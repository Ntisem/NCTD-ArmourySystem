<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['confirm_delete'])) {
    $id = $_POST['delete_id'] ?? null;

    if ($id) {
        try {
            $pdo->beginTransaction();

            // 1. Soft Delete
            $stmt = $pdo->prepare("UPDATE ammunitions SET is_deleted = 1 WHERE ammoID = ?");
            $stmt->execute([$id]);

            // 2. Audit Log - Using fallback values to prevent errors
            $adminID = $_SESSION['adminID'] ?? 0;
            $adminName = $_SESSION['fullname'] ?? 'Unknown Armourer';
            $role = $_SESSION['user_role'] ?? 'Armourer';

            $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
            $log->execute([$adminID, $adminName, "DELETED_AMMO_ID_" . $id, $role]);

            $pdo->commit();
            header("Location: ammunition.php?status=success");
            exit();
        } catch (Exception $e) {
            $pdo->rollBack();
            header("Location: ammunition.php?status=error&msg=" . urlencode($e->getMessage()));
            exit();
        }
    }
}
header("Location: ammunition.php?status=error");
exit();