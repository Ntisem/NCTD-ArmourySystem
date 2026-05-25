<?php 
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Administrator') {
    header("location: login");
    exit();
}

// Fetch current admin details to ensure session integrity
$username = $_SESSION['username']; 
$stmt = $pdo->prepare("SELECT * FROM admin_lists WHERE username = ?");
$stmt->execute([$username]);
$admin_data = $stmt->fetch();

// Re-sync session just in case
if($admin_data) {
    $_SESSION['adminID'] = $admin_data['adminID'];
    $_SESSION['fullname'] = $admin_data['fullname'];
    $_SESSION['user_role'] = $admin_data['user_role'];
    $_SESSION['rank'] = $admin_data['rank'];
    $adminID = $admin_data['adminID'];
    $armourer_admin_name = $admin_data['rank'] . ' ' . $admin_data['fullname'];
    $_SESSION['armourer_admin_name'] = $armourer_admin_name;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>NCTD ARMOURY SYSTEM | AMMO INDUCTION</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
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

        /* Tactical Autocomplete Pop-up Overlay Overrides */
        .ui-autocomplete {
            background: #0d1117 !important;
            border: 1px solid var(--neon-cyan) !important;
            color: #fff !important;
            border-radius: 0px !important;
            font-family: 'JetBrains Mono', monospace;
            max-height: 250px;
            overflow-y: auto;
            z-index: 1050 !important;
        }
        .ui-menu-item .ui-menu-item-wrapper {
            padding: 8px 12px !important;
        }
        .ui-menu-item .ui-menu-item-wrapper.ui-state-active {
            background: var(--neon-cyan) !important;
            color: #000 !important;
            border: none !important;
            margin: 0px !important;
        }
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
                        <h4 class="card-title text-info mb-0">[ASSET_INDUCTION_PROTOCOL]: BLANK AMMUNITION</h4>
                        <a href="ammunition.php" class="btn btn-sm btn-back btn-dark">
                            <i class="mdi mdi-arrow-left"></i> BACK
                        </a>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-md-8 grid-margin stretch-card">
                            <div class="card tactical-card">
                                <div class="card-body"> 
                                    <form class="forms-sample" action="process-blank-ammo-add.php" method="POST">
                                    <input type="hidden" name="adminID" value="<?= htmlspecialchars($_SESSION['adminID'] ?? '') ?>">   
                                    <input type="hidden" name="armourer_admin_name" value="<?= htmlspecialchars($_SESSION['armourer_admin_name'] ?? '') ?>">
                                    
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label>AMMO_NAME</label>
                                            <input type="text" id="ammo_name" name="ammo_name" class="form-control" placeholder="e.g. 9MM, 7.62x39" required autocomplete="off">
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label>MANUFACTURER</label>
                                            <input type="text" id="manufacturer" name="manufacturer" class="form-control" placeholder="e.g. Smith & Wesson, AK" required>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-md-4 mb-3">
                                            <label>Ammo Type</label>
                                            <select name="ammo_type" class="form-control">
                                                <option value="Blank-Ammo">Blank-Ammo</option>
                                                <option value="Live-Ammo">Live-Ammo</option>
                                               
                                            </select>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>INITIAL_ROUNDS</label>
                                            <input type="number" name="ammo_rounds" class="form-control" placeholder="0" required>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <label>APPLICATION</label>
                                            <select name="ammo_application" class="form-control">
                                                <option value="Training">Training</option>
                                                <option value="Duty">Duty</option>
                                                <option value="Special Ops">Special Ops</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
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

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>
    
    <script>
    $(document).ready(function() {
        // Initialize jQuery UI Autocomplete Matrix link on the element node
        $("#ammo_name").autocomplete({
            source: function(request, response) {
                $.ajax({
                    url: "fetchBooking-ammo.php",
                    type: "POST",
                    dataType: "json",
                    data: {
                        search: request.term
                    },
                    success: function(data) {
                        response(data);
                    }
                });
            },
            minLength: 1, // Start cross-scanning on first entered character vector
            select: function(event, ui) {
                // Intercept payload values to assign data parameters seamlessly
                $("#ammo_name").val(ui.item.value);
                $("#manufacturer").val(ui.item.manufacturer);
                return false;
            }
        });
    });
    </script>
</body>
</html>