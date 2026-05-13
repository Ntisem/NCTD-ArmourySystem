<?php  
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

$id = $_GET['id'] ?? null;
if (!$id) {
    header("location: faulty-ammo");
    exit();
}

$stmt = $pdo->prepare("SELECT * FROM faulty_ammo WHERE faulty_ammoID = ?");
$stmt->execute([$id]);
$row = $stmt->fetch();
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
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
      :root {
        --bg-tactical: #0d0f12;
        --panel-bg: #15181f;
        --neon: #00f2ff;
        --danger: #ff4d4d;
        --text-tactical: #e0e0e0;
      }
      body {
        background-color: var(--bg-tactical);
        color: var(--text-tactical);
      }
      .card {
        background-color: var(--panel-bg);
        border: 1px solid #202633;
      }
      .btn-tactical {
        background: transparent;
        color: var(--neon);
        border: 1px solid var(--neon);
      }
      .btn-tactical:hover {
        background: var(--neon);
        color: #000;
      }
      .table { color: var(--text-tactical); }
      .table th, .table td { border-color: #202633; }
    </style>
  </head>
  <body>
    <div class="container-scroller">
      <div class="container-fluid page-body-wrapper">
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row justify-content-center">
              <div class="col-md-8 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title text-uppercase" style="color:var(--neon);"><i class="mdi mdi-information-outline"></i> Faulty Item Details</h4>
                    <?php if ($row): ?>
                      <div class="table-responsive">
                        <table class="table table-bordered">
                          <tr>
                            <th>Faulty ID</th>
                            <td><?= htmlspecialchars($row['faulty_ammoID']) ?></td>
                          </tr>
                          <tr>
                            <th>Manufacturer</th>
                            <td><?= htmlspecialchars($row['faulty_ammo_manufacturer']) ?></td>
                          </tr>
                          <tr>
                            <th>Serial Number</th>
                            <td><?= htmlspecialchars($row['faulty_ammo_serial_no']) ?></td>
                          </tr>
                          <tr>
                            <th>Type/Model</th>
                            <td><?= htmlspecialchars($row['faulty_ammo_type']) ?></td>
                          </tr>
                          <tr>
                            <th>Quantity</th>
                            <td><?= htmlspecialchars($row['faulty_ammo_quantity']) ?></td>
                          </tr>
                          <tr>
                            <th>Fault Type</th>
                            <td><?= htmlspecialchars($row['faulty_type']) ?></td>
                          </tr>
                          <tr>
                            <th>Comment/Remarks</th>
                            <td><?= htmlspecialchars($row['faulty_ammo_comment']) ?></td>
                          </tr>
                          <tr>
                            <th>Returned By</th>
                            <td><?= htmlspecialchars($row['returned_by_officer'] ?? '') ?></td>
                          </tr>
                          <tr>
                            <th>Logged on Date</th>
                            <td><?= htmlspecialchars($row['datetime']) ?></td>
                          </tr>
                        </table>
                      </div>
                      <a href="faulty-ammo.php" class="btn btn-tactical mt-3"><i class="mdi mdi-arrow-left"></i> BACK</a>
                    <?php else: ?>
                      <p class="text-danger">Record not found.</p>
                      <a href="faulty-ammo.php" class="btn btn-tactical mt-3">BACK</a>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <?php require_once('includes/footer.php'); ?>
        </div>
      </div>
    </div>
  </body>
</html>