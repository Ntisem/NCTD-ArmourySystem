<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

// 1. Authorization Check
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Admin') {
    die("UNAUTHORIZED_ACCESS: Senior Command clearance required.");
}

try {
    $pdo->beginTransaction();

    // 2. Define the retention period (90 days)
    $retention_days = 90;

    // 3. Move records to Archive
    // We insert into archive SELECTing from main where log_time is older than 90 days
    $archive_sql = "INSERT INTO daily_activities_archive 
                    SELECT * FROM daily_activities 
                    WHERE log_time < DATE_SUB(NOW(), INTERVAL ? DAY)";
    $archive_stmt = $pdo->prepare($archive_sql);
    $archive_stmt->execute([$retention_days]);
    
    $moved_count = $archive_stmt->rowCount();

    if ($moved_count > 0) {
        // 4. Delete the moved records from the main table
        $delete_sql = "DELETE FROM daily_activities 
                       WHERE log_time < DATE_SUB(NOW(), INTERVAL ? DAY)";
        $delete_stmt = $pdo->prepare($delete_sql);
        $delete_stmt->execute([$retention_days]);

        // 5. Create a final log entry in the main table about the purge
        $log_action = "SYSTEM_MAINTENANCE: Moved $moved_count logs to Archive (>90 days old).";
        $log = $pdo->prepare("INSERT INTO daily_activities (adminID, armourer_admin_name, action_taken, user_role) VALUES (?, ?, ?, ?)");
        $log->execute([$_SESSION['adminID'], $_SESSION['fullname'], $log_action, $_SESSION['user_role']]);
    }

    $pdo->commit();
    header("Location: daily-logs?status=success&moved=" . $moved_count);
    exit();

} catch (Exception $e) {
    $pdo->rollBack();
    header("Location: daily-logs?status=error&msg=" . urlencode($e->getMessage()));
    exit();
}