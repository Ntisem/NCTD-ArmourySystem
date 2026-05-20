<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

// Fetch current admin details to ensure session integrity
$username = $_SESSION['username']; 
$stmt = $pdo->prepare("SELECT adminID, fullname FROM admin_lists WHERE username = ?");
$stmt->execute([$username]);
$admin_data = $stmt->fetch();

// Re-sync session just in case
if($admin_data) {
    $_SESSION['adminID'] = $admin_data['adminID'];
    $_SESSION['fullname'] = $admin_data['fullname'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>TERMINAL | AMMO INDUCTION</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root { --neon-cyan: #00f2ff; --panel-dark: #05070a; }
        body { background-color: var(--panel-dark); font-family: 'JetBrains Mono', monospace; }
        .tactical-card { background: rgba(13, 17, 23, 0.9); border: 1px solid rgba(0, 242, 255, 0.2); border-radius: 0; }
        .form-control { background: #0d1117 !important; border: 1px solid #30363d !important; color: var(--neon-cyan) !important; }
        .btn-tactical { border: 1px solid var(--neon-cyan); color: var(--neon-cyan); text-transform: uppercase; letter-spacing: 1px; transition: 0.3s; }
        .btn-tactical:hover { background: var(--neon-cyan); color: #000; }
        .btn-back { border: 1px solid #6c757d; color: #6c757d; }
    </style>
</head>
<body>
    <div class="container-scroller">
        <?php include_once('includes/sidebar.php');?>
        <div class="container-fluid page-body-wrapper">
            <?php include_once('includes/navbar.php');?>
            <div class="main-panel">
                <div class="content-wrapper">
                      <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title text-info mb-0">[ASSET_INDUCTION_PROTOCOL]: AMMUNITION</h4>
                        <a href="ammunition.php" class="btn btn-sm btn-back">
                            <i class="mdi mdi-arrow-left"></i> BACK_TO_REGISTRY
                        </a>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card tactical-card">
                                <div class="card-body"> 
                                    <form class="forms-sample" action="process-ammo-add.php" method="POST">
                                        <div class="row">
                                            <div class="col-md-6 mb-3">
                                                <label>AMMO_NAME</label>
                                                <input type="text" name="ammo_name" class="form-control" placeholder="e.g. 9MM, 7.62x39" required>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <label>MANUFACTURER</label>
                                                <input type="text" name="manufacturer" class="form-control" placeholder="e.g. Smith & Wesson, AK" required>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label>INITIAL_ROUNDS</label>
                                                <input type="number" name="ammo_rounds" class="form-control" placeholder="0" required>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label>APPLICATION</label>
                                                <select name="ammo_application" class="form-control">
                                                    <option value="Duty">Duty</option>
                                                    <option value="Training">Training</option>
                                                    <option value="Special Ops">Special Ops</option>
                                                </select>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label>BOOKING_STATUS</label>
                                                <select name="booking_status" class="form-control">
                                                    <option value="Available">Available</option>
                                                    <option value="Reserved">Reserved</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group mb-4">
                                            <label>REMARKS / NOTES</label>
                                            <textarea name="remarks" class="form-control" rows="3"></textarea>
                                        </div>

                                        <div class="d-flex justify-content-end gap-2">
                                            <button type="reset" class="btn btn-outline-secondary">CLEAR_FORM</button>
                                            <button type="submit" name="submit_ammo" class="btn btn-tactical">
                                                <i class="mdi mdi-shield-check"></i> COMMIT_TO_DATABASE
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="card-footer text-center">
                    <small class="text-muted">TERMINAL v1.0 | &copy; NCTD ARMORY MANAGEMENT SYSTEM</small>
                </div>
                <?php include_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>
</body>
</html>