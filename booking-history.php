<?php  
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

// Security Check
if(!isset($_SESSION["username"]) || ($_SESSION["user_role"] != 'Armourer' && $_SESSION["user_role"] != 'SuperAdmin')) {
    header("location: login");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>NCTD // DEPLOYMENT_LOG_HISTORY</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;700&family=Roboto+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    
    <style>
        :root {
            --neon-cyan: #00f2ff;
            --neon-amber: #f9a602;
            --tactical-bg: #05070a;
            --glass-overlay: rgba(0, 242, 255, 0.03);
        }

        body { 
            background-color: var(--tactical-bg); 
            font-family: 'Roboto Mono', monospace; 
            color: #e0e0e0;
        }

        /* --- TACTICAL TABLE STYLING --- */
        .table-responsive-tactical {
            background: rgba(10, 12, 16, 0.95);
            border: 1px solid rgba(0, 242, 255, 0.2);
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5);
            border-radius: 4px;
            padding: 20px;
        }

        .table thead th {
            font-family: 'Orbitron', sans-serif;
            color: var(--neon-cyan);
            border-bottom: 2px solid var(--neon-cyan) !important;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 0.75rem;
        }

        .table td { 
            border-color: rgba(255, 255, 255, 0.05) !important;
            vertical-align: middle;
        }

        /* --- SEARCH/FILTER PANEL --- */
        .search-vault {
            background: linear-gradient(180deg, #0a0c10 0%, #05070a 100%);
            border: 1px solid var(--neon-amber);
            padding: 15px;
            margin-bottom: 25px;
        }

        .btn-tactical {
            background: transparent;
            border: 1px solid var(--neon-cyan);
            color: var(--neon-cyan);
            font-family: 'Orbitron', sans-serif;
            transition: all 0.3s;
        }

        .btn-tactical:hover {
            background: var(--neon-cyan);
            color: #000;
            box-shadow: 0 0 15px var(--neon-cyan);
        }

        .status-badge {
            font-weight: bold;
            padding: 5px 10px;
            border-radius: 0;
            border: 1px solid;
            font-size: 0.65rem;
        }

        .status-overdue { border-color: #ff3e3e; color: #ff3e3e; background: rgba(255, 62, 62, 0.1); }
        .status-returned { border-color: var(--neon-cyan); color: var(--neon-cyan); background: rgba(0, 242, 255, 0.1); }
    </style>
</head>

<body>
    <div class="container-scroller">
        <?php require_once('includes/sidebar.php'); ?>
        <div class="container-fluid page-body-wrapper">
            <?php require_once('includes/navbar.php'); ?>
            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <div class="search-vault">
                        <form id="filterForm" class="row align-items-end">
                            <div class="col-md-3">
                                <label class="small text-amber">START_DATE</label>
                                <input type="date" name="start_date" class="form-control bg-dark text-white border-secondary">
                            </div>
                            <div class="col-md-3">
                                <label class="small text-amber">END_DATE</label>
                                <input type="date" name="end_date" class="form-control bg-dark text-white border-secondary">
                            </div>
                            <div class="col-md-3">
                                <label class="small text-amber">STATUS_FILTER</label>
                                <select name="status" class="form-control bg-dark text-white border-secondary">
                                    <option value="ALL">ALL_DEPLOYMENTS</option>
                                    <option value="Not-Return">OUTSTANDING</option>
                                    <option value="Returned">SECURED</option>
                                </select>
                            </div>
                            <div class="col-md-3">
                                <button type="button" onclick="applyTacticalFilter()" class="btn btn-tactical w-100">RUN_QUERY</button>
                            </div>
                        </form>
                    </div>

                    <div class="table-responsive-tactical">
                        <div class="d-flex justify-content-between mb-4">
                            <h3 class="font-orbitron text-cyan"> > DEPLOYMENT_LOG_ARCHIVE</h3>
                            <div class="btn-group">
                                <a href="audit_engine.php?type=master" target="_blank" class="btn btn-outline-warning btn-sm">PDF_MASTER_AUDIT</a>
                                <a href="audit_firearms_overdue.php" target="_blank" class="btn btn-outline-danger btn-sm">PDF_OVERDUE_LOG</a>
                            </div>
                        </div>

                        <table id="tactical-history" class="table text-white">
                            <thead>
                                <tr>
                                    <th>TIMESTAMP</th>
                                    <th>OPERATOR_ID</th>
                                    <th>ASSET_ID</th>
                                    <th>MUNITIONS</th>
                                    <th>STATUS</th>
                                    <th>LOCATION</th>
                                    <th>OP_CODE</th>
                                </tr>
                            </thead>
                            <tbody>
                                </tbody>
                        </table>
                    </div>
                </div>
                <?php require_once('includes/footer.php'); ?>
            </div>
        </div>
    </div>

    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/datatables/jquery.dataTables.min.js"></script>
    
    <script>
    $(document).ready(function() {
        var table = $('#tactical-history').DataTable({
            "responsive": true,
            "dom": 'Bfrtip',
            "buttons": ['excel', 'pdf', 'print'],
            "pageLength": 15,
            "order": [[0, "desc"]],
            "language": {
                "search": "SCAN_DATABASE:",
                "paginate": { "previous": "[PREV]", "next": "[NEXT]" }
            }
        });

        // Advanced Time-Period Filtering
        $.fn.dataTable.ext.search.push(
            function(settings, data, dataIndex) {
                var start = $('#start_date').val();
                var end = $('#end_date').val();
                var date = data[0].substring(0, 10); // Extract YYYY-MM-DD from Timestamp

                if (start === "" && end === "") return true;
                if (start === "" && date <= end) return true;
                if (end === "" && date >= start) return true;
                if (date <= end && date >= start) return true;
                return false;
            }
        );
    });

    function applyTacticalFilter() {
        $('#tactical-history').DataTable().draw();
    }
    </script>
</body>
</html>