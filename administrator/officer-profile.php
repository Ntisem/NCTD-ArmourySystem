<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');


// Access Control
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}

$id = $_GET['id'] ?? null;
if (!$id) die("OFFICER_ID_MISSING");

// 1. Fetch Officer Basic Data
$stmt = $pdo->prepare("SELECT * FROM officers WHERE officerID = ?");
$stmt->execute([$id]);
$officer = $stmt->fetch();

// 2. Fetch History (Excluding deleted records)
$history = $pdo->prepare("SELECT * FROM bookings WHERE officerID = ? AND is_deleted = 0 ORDER BY bookingID DESC");
$history->execute([$id]);
$records = $history->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>PROFILE | <?= $officer['full_name'] ?></title>
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        body { background: #020408; color: #fff; font-family: 'JetBrains Mono'; }
        .profile-header { border-bottom: 2px solid #00f2ff; padding: 20px; margin-bottom: 30px; }
        .stat-box { border: 1px solid #00f2ff; padding: 15px; background: rgba(0, 242, 255, 0.05); }
        .history-card { background: #0a0d12; border: 1px solid #333; margin-bottom: 10px; padding: 15px; }
    </style>
</head>
<body class="p-5">
    <a href="booked-firearms.php" class="text-info mb-4 d-inline-block"><i class="mdi mdi-arrow-left"></i> RETURN_TO_UNIT</a>
    
    <div class="row">
        <div class="col-md-4">
            <div class="profile-header text-center">
                <img src="../assets/images/officer_images/<?= $officer['officer_image'] ?>" style="width: 150px; border: 3px solid #00f2ff;">
                <h3 class="mt-3 text-info"><?= $officer['full_name'] ?></h3>
                <p>SERVICE_NO: <?= $officer['officer_service_no'] ?></p>
            </div>
            <div class="stat-box">
                <p>RANK: <?= $officer['rank'] ?></p>
                <p>STATUS: ACTIVE_DUTY</p>
                <p>TOTAL_MISSIONS: <?= count($records) ?></p>
            </div>
        </div>
        
        <div class="col-md-8">
            <h4 class="text-info">[ MISSION_HISTORY_LOG ]</h4>
            <hr style="border-color: #333;">
            <?php foreach($records as $r): ?>
                <div class="history-card">
                    <div class="row">
                        <div class="col-md-3 small text-muted"><?= $r['booking_time'] ?></div>
                        <div class="col-md-4 text-info"><?= $r['firearm_name'] ?> (<?= $r['firearm_serial_no'] ?>)</div>
                        <div class="col-md-3"><?= $r['duty_location'] ?></div>
                        <div class="col-md-2 text-right">
                             <span class="badge <?= $r['returns'] == 'Returned' ? 'badge-success' : 'badge-danger' ?>"><?= $r['returns'] ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
       <?php include_once('includes/footer.php'); ?>
</body>
</html>