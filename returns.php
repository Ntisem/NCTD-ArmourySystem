<?php require_once('connections/connect-db.php'); ?>
<?php 
require_once('functions.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] != 'Armourer') {
    header("location: login");
    exit();
}

$firearm_name = "GENERAL"; 
if(isset($_GET['firearm-name']) && $_GET['firearm-name'] != ''){
    $firearm_name = mysqli_real_escape_string($connect_db, $_GET['firearm-name']);
    $sql = "SELECT * FROM `bookings` WHERE `firearm_name` = '$firearm_name' ORDER BY `bookingID` DESC";
    $firearm_result = mysqli_query($connect_db, $sql);
    if(mysqli_num_rows($firearm_result) > 0){
        $row = mysqli_fetch_assoc($firearm_result);
        $firearm_name = $row['firearm_name'];
        $_SESSION['firearm_name'] = $firearm_name;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>GPS ARMOURY SYSTEM - <?php echo $firearm_name; ?> RETURNS HISTORY</title>
    
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="dist/css/theme.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
 <link rel="shortcut icon" href="assets/images/favicon.png" />
    <style>
        :root {
            --neon-cyan: #00f2ff;
            --neon-amber: #ffab00;
            --dark-panel: #0a0c10;
        }

        body { background-color: #05070a; font-family: 'Roboto Mono', monospace; }

        /* --- Remove Underlines & Tactical Links --- */
        a, a:hover { text-decoration: none !important; }
        
        .officer-link {
            color: var(--neon-cyan) !important;
            font-weight: 700;
            letter-spacing: 0.5px;
            transition: 0.3s;
        }
        .officer-link:hover { text-shadow: 0 0 8px var(--neon-cyan); }

        /* --- Redesigned Tactical Buttons --- */
        .dt-button, .btn-light.create-new-button {
            background: rgba(0, 242, 255, 0.05) !important;
            border: 1px solid var(--neon-cyan) !important;
            color: var(--neon-cyan) !important;
            border-radius: 2px !important;
            text-transform: uppercase;
            font-size: 11px !important;
            font-weight: 700;
            padding: 8px 15px !important;
            margin-right: 5px;
        }
        .dt-button:hover {
            background: var(--neon-cyan) !important;
            color: #000 !important;
            box-shadow: 0 0 10px var(--neon-cyan);
        }

        /* --- Table Styling --- */
        #administrators-list { border: 1px solid rgba(0, 242, 255, 0.1) !important; }
        #administrators-list thead th { 
            background-color: var(--dark-panel);
            color: var(--neon-cyan);
            border-bottom: 2px solid var(--neon-cyan) !important;
            font-family: 'Orbitron', sans-serif;
            font-size: 0.7rem;
        }
        .badge-outline-success {
            border: 1px solid #28a745;
            color: #28a745;
            background: transparent;
        }


        /* --- BUTTON COLOR REFINEMENT --- */

/* Amber Button (Outstanding) */
.cmd-btn-amber {
    background: rgba(255, 171, 0, 0.05);
    border: 1px solid var(--neon-amber);
    color: var(--neon-amber) !important;
}
.cmd-btn-amber:hover {
    background: var(--neon-amber);
    color: #000 !important;
    box-shadow: 0 0 15px rgba(255, 171, 0, 0.5);
}

/* Cyan Button (Filter) */
.cmd-btn-cyan {
    background: rgba(0, 242, 255, 0.05);
    border: 1px solid var(--neon-cyan);
    color: var(--neon-cyan) !important;
}
.cmd-btn-cyan:hover {
    background: var(--neon-cyan);
    color: #000 !important;
    box-shadow: 0 0 15px rgba(0, 242, 255, 0.5);
}

/* --- DROPDOWN VISIBILITY FIX --- */
.tactical-dropdown {
    background-color: #05070a !important; /* Matches your background */
    border: 1px solid var(--neon-cyan) !important;
    box-shadow: 0 10px 30px rgba(0,0,0,0.8);
    padding: 0;
    margin-top: 10px !important;
}
.dropdown-menu .dropdown-item {
   background-color: #05070a !important; /* Matches your background */
    padding: 8px 15px;
    line-height: 14px;
    border-radius: 4px;
    -webkit-border-radius: 4px;
    -moz-border-radius: 4px;
}

.tactical-item {
    color: #8a8d93 !important;
    font-family: 'Roboto Mono', monospace;
    font-size: 11px;
    padding: 12px 20px;
    border-bottom: 1px solid rgba(0, 242, 255, 0.05);
    transition: 0.2s;
}

.tactical-item:hover {
    background: rgba(0, 242, 255, 0.1) !important;
    color: var(--neon-cyan) !important;
    padding-left: 25px; /* Subtle slide effect */
}

/* Fix for the dropdown arrow/caret color */
.dropdown-toggle::after {
    color: var(--neon-cyan);
}
        
    </style>
</head>
<body>
    <div class="container-scroller">
        <?php require_once('includes/sidebar.php'); ?>
        
        <div class="container-fluid page-body-wrapper">
            <?php require_once('includes/navbar.php'); ?>
            
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="page-header">
                        <h3 class="page-title"><span style="color:var(--neon-amber);"><?php echo $firearm_name; ?></span> RETURNS_LOG</h3>
                       <nav aria-label="breadcrumb">
                      <div class="tactical-btn-group d-flex align-items-center">
                          <a href="not-returns-firearms" class="cmd-btn cmd-btn-amber me-2 p-2">
                              <i class="mdi mdi-alert-decagram-outline me-1"></i>
                              <span class="cmd-text">OUTSTANDING_LOG</span>
                          </a>

                          <div class="dropdown">
                              <button class="cmd-btn cmd-btn-cyan dropdown-toggle p-2" type="button" id="weaponSelect" data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="mdi mdi-crosshairs-gps me-1"></i>
                                  <span class="cmd-text">FILTER_BY_ARMAMENT</span>
                              </button>
                              <ul class="menu-menu dropdown-menu dropdown-menu-dark tactical-dropdown border-info" aria-labelledby="weaponSelect">
                                  <?php
                                      $wp_query = mysqli_query($connect_db, "SELECT * FROM `firearm_name` ORDER BY `firearm_nameID` ASC");
                                      while($wp_row = mysqli_fetch_assoc($wp_query)) {
                                          echo '<li><a class="dropdown-item tactical-item" href="returns?firearm-name='.$wp_row['firearm_name'].'">'.$wp_row['firearm_name'].'</a></li>';
                                      }
                                  ?>
                              </ul>
                          </div>
                      </div>
                  </nav>
                    </div>

                    <div class="row">
                        <div class="col-12">
                            <div class="card bg-dark border-secondary">
                                <div class="card-body">
                                    <table id="administrators-list" class="table table-dark table-hover table-responsive">
                                        <thead>
                                            <tr>
                                                <th>TIMESTAMP</th>
                                                <th>OFFICER_OPERATOR</th>
                                                <th>WEAPON_TYPE</th>
                                                <th>AMMO_METRICS</th>
                                                <th>STATUS</th>
                                                <th>DEPLOYMENT_LOC</th>
                                                <th>ACTIONS</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $bk_query = mysqli_query($connect_db, "SELECT * FROM `bookings` WHERE `returns` = 'Returned' AND `firearm_name` = '$firearm_name' ORDER BY `bookingID` DESC");
                                            while ($row = mysqli_fetch_array($bk_query)) {
                                            ?>
                                            <tr>
                                                <td><?php echo $row['returned_time']; ?></td>
                                                <td>
                                                    <a href="#booking-details-<?php echo $row['bookingID']; ?>" data-toggle="modal" class="officer-link">
                                                        <img src="assets/images/officer_images/<?php echo $row['officer_image']; ?>" class="img-xs rounded-circle mr-2" />
                                                        <span><?php echo strtoupper($row['to_officer']); ?></span>
                                                    </a>
                                                </td>
                                                <td><?php echo $row['firearm_name']; ?></td>
                                                <td>
                                                    <code class="text-info">B:<?php echo $row['number_of_rounds']; ?></code>
                                                    <code class="text-success">R:<?php echo $row['ammo_returned']; ?></code>
                                                </td>
                                                <td>
                                                    <label class="badge badge-outline-success"><?php echo $row['returns']; ?></label>
                                                </td>
                                                <td><?php echo $row['duty_location']; ?></td>
                                                <td class="text-center">
                                                    <a href="#edit-return-firearm-<?php echo $row['officerID'].'&'.$row['bookingID']; ?>" data-toggle="modal">
                                                        <i class="mdi mdi-playlist-edit text-success"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php 
                                                include('actions_modals.php'); 
                                                include('actions.php');
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php require_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>

    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>

    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/buttons.print.min.js"></script>

    <script>
    $(function () {
        $("#administrators-list").DataTable({
            "responsive": true, 
            "autoWidth": false,
            "order": [[0, "desc"]],
            "dom": 'Bfrtip',
            "buttons": [
                { extend: 'copy', className: 'dt-button' },
                { extend: 'csv', className: 'dt-button' },
                { extend: 'excel', className: 'dt-button' },
                { extend: 'pdf', className: 'dt-button' },
                { extend: 'print', className: 'dt-button' }
            ],
            "columnDefs": [
                // Automatically hide less critical columns to keep the UI focused on 4 main columns
                { "targets": [2, 5, 6], "visible": false } 
            ]
        });
    });
    </script>
</body>
</html>