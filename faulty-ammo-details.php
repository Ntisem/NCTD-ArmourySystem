<?php  
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
if (!$id) {
    header("location: faulty-ammo.php");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM faulty_ammo WHERE faulty_ammoID = ? AND is_deleted = 0");
$stmt->execute([$id]);
$row = $stmt->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GPS ARMOURY SYSTEM - FAULTY AMMUNITION DETAILS</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <style>
      body { background-color: #0d0f12; color: #e0e0e0; font-family: monospace; }
      .card { background-color: #15181f; border: 1px solid #00f2ff; box-shadow: 0 4px 15px rgba(0,242,255,0.1); }
      .table th { color: #00f2ff; font-weight: bold; }
      .btn-tactical { background: transparent; border: 1px solid #00f2ff; color: #00f2ff; padding: 10px 20px; font-weight: bold; }
      .btn-tactical:hover { background: #00f2ff; color: #000; }
    </style>
  </head>
  <body>
    <div class="container mt-5">
      <div class="row justify-content-center">
        <div class="col-md-10">
          <div class="card">
            <div class="card-body">
              <h3 class="card-title text-light mb-4">// ANALYSIS_METRICS_TELEMETRY: RECORD_#<?= $id ?></h3>
              <?php if ($row): ?>
                <div class="table-responsive">
                  <table class="table table-bordered table-dark">
                    <tr><th width="30%">STOCK IDENTIFIER MODEL</th><td><?= htmlspecialchars($row['faulty_ammo_name']) ?></td></tr>
                    <tr><th>MANUFACTURER / CALIBER PROFILE</th><td><?= htmlspecialchars($row['faulty_ammo_manufacturer']) ?></td></tr>
                    <tr><th>ROUNDS COMPROMISED</th><td><?= htmlspecialchars($row['faulty_ammo_quantity']) ?> Units</td></tr>
                    <tr><th>FAILURE INTERVENTION TYPE</th><td class="text-danger"><?= htmlspecialchars($row['faulty_type']) ?></td></tr>
                    <tr><th>ARMOURER LOG COMMENTS</th><td><?= htmlspecialchars($row['faulty_ammo_comment']) ?></td></tr>
                    <tr><th>REPORTING OFFICER ID STAMP</th><td><?= htmlspecialchars($row['returned_by_officer'] ?? 'System Invariant') ?></td></tr>
                    <tr><th>TIMESTAMP METRICS</th><td><?= htmlspecialchars($row['datetime']) ?></td></tr>
                    <tr>
                      <th>VISUAL ARTIFACT MATCH</th>
                      <td>
                        <?php if(!empty($row['faulty_ammo_image']) && file_exists($row['faulty_ammo_image'])): ?>
                          <img src="<?= htmlspecialchars($row['faulty_ammo_image']) ?>" alt="Visual Profile Analysis" style="max-width:400px; width:100%; height:auto; border:1px solid #00f2ff; padding:4px;">
                        <?php else: ?>
                          <span class="text-muted"><i class="mdi mdi-camera-off"></i> Missing media artifact verification.</span>
                        <?php endif; ?>
                      </td>
                    </tr>
                  </table>
                </div>
                <div class="mt-4">
                   <a href="faulty-ammo.php" class="btn btn-tactical"><i class="mdi mdi-arrow-left"></i> RETRACT TO CONSOLE</a>
                </div>
              <?php else: ?>
                <div class="alert alert-danger" style="background:#2c1619; border-color:#ff4d4d; color:#ff4d4d;">[CRITICAL]: DATA REGISTRY POINTER CORRUPT OR TARGET ENTRY DELETED.</div>
                <a href="faulty-ammo.php" class="btn btn-tactical mt-3">RETURN</a>
              <?php endif; ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>