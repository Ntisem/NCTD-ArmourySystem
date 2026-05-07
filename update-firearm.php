<?php  
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

$firearmID = $_GET['firearmID'] ?? null;
$stmt = $pdo->prepare("SELECT * FROM firearms WHERE firearmID = ?");
$stmt->execute([$firearmID]);
$row = $stmt->fetch();

if(!$row) { die("RECORDS_NOT_FOUND: ACCESS_DENIED"); }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>GPS ARMOURY - UPDATE_FIREARM</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root { --neon-cyan: #00f2ff; --neon-amber: #f9a602; --tactical-bg: #05070a; }
        body { background: var(--tactical-bg); color: #fff; font-family: 'Roboto Mono', monospace; }
        .tactical-card { background: rgba(13, 17, 23, 0.9); border: 1px solid var(--neon-cyan); box-shadow: 0 0 20px rgba(0, 242, 255, 0.15); }
        .form-control { background: rgba(255,255,255,0.05) !important; border: 1px solid rgba(0, 242, 255, 0.3) !important; color: #fff !important; }
        .form-control:focus { border-color: var(--neon-cyan) !important; box-shadow: 0 0 10px var(--neon-cyan); }
        .cmd-label { color: var(--neon-cyan); font-family: 'Orbitron', sans-serif; font-size: 0.75rem; letter-spacing: 1px; }
        .btn-tactical { background: var(--neon-cyan); color: #000; font-weight: bold; border-radius: 0; transition: 0.3s; }
        .btn-tactical:hover { background: #fff; box-shadow: 0 0 15px var(--neon-cyan); }
    </style>
</head>
<body>
    <div class="container-scroller">
        <?php require_once('includes/sidebar.php'); ?>
        <div class="main-panel">
            <div class="content-wrapper">
                <div class="col-md-8 grid-margin stretch-card mx-auto">
                    <div class="card tactical-card">
                        <div class="card-body">
                            <h4 class="card-title text-center" style="color: var(--neon-amber)">FIREARM_DATA_REVISION</h4>
                            <form class="forms-sample" action="code.php" method="POST">
                                <input type="hidden" name="firearmID" value="<?= $row['firearmID'] ?>">
                                
                                <div class="form-group mb-3">
                                    <label class="cmd-label">WEAPON_SERIAL</label>
                                    <input type="text" name="serial_no" class="form-control" value="<?= $row['serial_no'] ?>">
                                </div>

                                <div class="form-group mb-3">
                                    <label class="cmd-label">IDENTIFICATION_NAME</label>
                                    <select name="firearm_name" class="form-control">
                                        <?php
                                        // Dynamic Dropdown from database
                                        $f_stmt = $pdo->query("SELECT firearm_name FROM firearm_name ORDER BY firearm_name ASC");
                                        while($f = $f_stmt->fetch()) {
                                            $selected = ($f['firearm_name'] == $row['firearm_name']) ? 'selected' : '';
                                            echo "<option value='{$f['firearm_name']}' $selected>{$f['firearm_name']}</option>";
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="d-flex justify-content-between mt-4">
                                    <button type="submit" name="update_firearm" class="btn btn-tactical px-5">EXECUTE_UPDATE</button>
                                    <a href="firearms-list" class="btn btn-outline-danger px-5">ABORT</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>