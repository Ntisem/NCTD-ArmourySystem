<?php  
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');
if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}

$u_name = $_SESSION['fullname'] ?? 'SYSTEM_USER';
$a_id   = $_SESSION['adminID'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>HQ COMMAND | ASSET CATEGORY REGISTRY</title>
    <link rel="stylesheet" href="assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendors/css/vendor.bundle.base.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css">
    <style>
        :root { --neon-cyan: #00f2ff; --neon-green: #00ffa3; --neon-red: #ff4b2b; }
        .tactical-card { background: #0b0e14; border: 1px solid #1a1f2b; }
        .text-cyan { color: var(--neon-cyan); }
        .t-toast { position: fixed; top: 20px; right: 20px; padding: 15px 25px; z-index: 10000; border-left: 5px solid; background: #1a1f2b; color: #fff; display: none; font-family: 'JetBrains Mono', monospace; }
        .t-success { border-color: var(--neon-green); box-shadow: 0 0 10px rgba(0, 255, 163, 0.3); }
        .t-error { border-color: var(--neon-red); box-shadow: 0 0 10px rgba(255, 75, 43, 0.3); }
        
        /* DataTables Custom Styling */
        .dataTables_wrapper .dataTables_length select, 
        .dataTables_wrapper .dataTables_filter input { 
            background: #12151e; border: 1px solid #1a1f2b; color: white; border-radius: 4px; 
        }
        .dt-buttons .btn { background: #12151e; border: 1px solid var(--neon-cyan); color: var(--neon-cyan); margin-right: 5px; transition: 0.3s; }
        .dt-buttons .btn:hover { background: var(--neon-cyan); color: #000; }
        .page-item.active .page-link { background-color: var(--neon-cyan); border-color: var(--neon-cyan); color: #000; }
        .page-link { background: #12151e; border: 1px solid #1a1f2b; color: var(--neon-cyan); }
    </style>
</head>
<body>
    <div id="toast-container"></div>
    <div class="container-scroller">
       <?php include_once('includes/sidebar.php');?>
       <div class="page-body-wrapper">
            <?php include_once('includes/navbar.php');?>
            <div class="main-panel">
                <div class="content-wrapper">
                    
                    <div class="card tactical-card mb-4">
                        <div class="card-body">
                            <h4 class="card-title text-cyan">[REGISTRY_UPLINK]: ADD_NEW_CATEGORY</h4>
                            <form action="functions-add-new-categories.php" method="POST" class="row">
                                <input type="hidden" name="adminID" value="<?= $a_id ?>">
                                <input type="hidden" name="armourer_admin_name" value="<?= $u_name ?>">
                                
                                <div class="col-md-4">
                                    <label class="small text-muted">MANUFACTURER</label>
                                    <input type="text" name="new_manufacturer" id="ac_manufacturer" class="form-control mb-1" required placeholder="e.g. GLOCK" onkeyup="checkField('manufacturer')">
                                    <div id="status-manufacturer" style="min-height: 20px;"></div>
                                </div>
                                <div class="col-md-4">
                                    <label class="small text-muted">CALIBER</label>
                                    <input type="text" name="new_caliber" id="ac_caliber" class="form-control mb-1" required placeholder="e.g. 9X19MM" onkeyup="checkField('caliber')">
                                    <div id="status-caliber" style="min-height: 20px;"></div>
                                </div>
                                <div class="col-md-4">
                                    <label class="small text-muted">CATEGORY/TYPE</label>
                                    <input type="text" name="new_firearm_category" id="ac_category" class="form-control mb-1" required placeholder="e.g. PISTOL" onkeyup="checkField('category')">
                                    <div id="status-category" style="min-height: 20px;"></div>
                                </div>
                                <div class="col-12 mt-2">
                                    <button type="submit" name="add_new_firearm_category" class="btn btn-primary btn-sm">COMMIT_TO_DATABASE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="card tactical-card">
                        <div class="card-body">
                            <h4 class="card-title text-cyan mb-4">[DATABASE_QUERY]: MASTER_CATEGORY_LIST</h4>
                            <div class="table-responsive">
                                <table class="table table-dark table-hover" id="categoryTable">
                                    <thead>
                                        <tr>
                                            <th>MANUFACTURER</th>
                                            <th>CALIBER</th>
                                            <th>CATEGORY</th>
                                            <th class="text-center">ACTIONS</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $stmt = $pdo->query("SELECT * FROM firearm_categories ORDER BY firearm_categoryID DESC");
                                        while($row = $stmt->fetch()):
                                        ?>
                                        <tr>
                                            <td><?= htmlspecialchars($row['firearm_manufacturer']) ?></td>
                                            <td><?= htmlspecialchars($row['firearm_caliber']) ?></td>
                                            <td><?= htmlspecialchars($row['firearm_category']) ?></td>
                                            <td class="text-center">
                                                <button class="btn btn-xs btn-outline-info" onclick="openEditModal('<?= $row['firearm_categoryID'] ?>','<?= $row['firearm_manufacturer'] ?>','<?= $row['firearm_caliber'] ?>','<?= $row['firearm_category'] ?>')">EDIT</button>
                                                <button class="btn btn-xs btn-outline-danger" onclick="openDeleteModal('<?= $row['firearm_categoryID'] ?>','<?= $row['firearm_category'] ?>')">DELETE</button>
                                            </td>
                                        </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <?php include_once('includes/footer.php');?>
            </div>
       </div>
    </div>
    <?php include('includes/modals/category-modals.php'); // Suggested: Move modals to an include for cleanliness ?>
    <script src="assets/vendors/js/vendor.bundle.base.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
    $(document).ready(function() {
        // Initialize DataTable
        $('#categoryTable').DataTable({
            dom: '<"d-flex justify-content-between align-items-center mb-3"Bf>rt<"d-flex justify-content-between align-items-center mt-3"ip>',
            buttons: [
                { extend: 'print', className: 'btn btn-sm', text: '<i class="mdi mdi-printer"></i> PRINT' },
                { extend: 'excel', className: 'btn btn-sm', text: '<i class="mdi mdi-file-excel"></i> EXCEL' },
                { extend: 'pdf', className: 'btn btn-sm', text: '<i class="mdi mdi-file-pdf"></i> PDF' }
            ],
            language: { search: "_INPUT_", searchPlaceholder: "SEARCH REGISTRY..." }
        });

        // Toast handling
        const params = new URLSearchParams(window.location.search);
        if(params.has('status')) {
            let status = params.get('status');
            let msg = status === 'success' ? '[SIGNAL]: DATA_COMMITTED' : (status === 'updated' ? '[SIGNAL]: REGISTRY_UPDATED' : '[SIGNAL]: OPERATION_FAILED');
            let type = (status === 'error' || status === 'conflict') ? 't-error' : 't-success';
            const t = $(`<div class="t-toast ${type}">${msg}</div>`);
            $('#toast-container').append(t);
            t.fadeIn().delay(3000).fadeOut();
            window.history.replaceState({}, '', window.location.pathname);
        }
    });

    // availability Check Fix
    function checkField(type) {
        let val, span, dbColumn;
        if (type === 'manufacturer') { 
            val = $("#ac_manufacturer").val(); 
            span = "#status-manufacturer"; 
            dbColumn = 'firearm_manufacturer';
        } else if (type === 'caliber') { 
            val = $("#ac_caliber").val(); 
            span = "#status-caliber"; 
            dbColumn = 'firearm_caliber';
        } else { 
            val = $("#ac_category").val(); 
            span = "#status-category"; 
            dbColumn = 'firearm_category';
        }

        if (val.trim().length > 1) {
            $.post("checkFirearmCategoryAvailability.php", { 
                type: dbColumn,
                value: val 
            }, function(data) {
                $(span).html(data);
            });
        } else {
            $(span).empty();
        }
    }

    function openEditModal(id, man, cal, cat) {
        $("#upd_id").val(id);
        $("#upd_man").val(man);
        $("#upd_cal").val(cal);
        $("#upd_cat").val(cat);
        $("#updateModal").modal('show');
    }

    function openDeleteModal(id, name) {
        $("#del_id").val(id);
        $("#del_label").text(name);
        $("#deleteModal").modal('show');
    }
    </script>
</body>
</html>