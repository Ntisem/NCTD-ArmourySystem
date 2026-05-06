<?php
require_once('connections/connect-db.php');

if (isset($_POST['query']) && !empty(trim($_POST['query']))) {
    $search = "%" . trim($_POST['query']) . "%";
    $output = '<div class="list-group tactical-results-group">';

    try {
        // The column aliases (type, id, title, status) must match across all UNION branches
        $sql = "
            (SELECT 
                'firearm_type' as type, 
                firearmID as id, 
                CONCAT(firearm_name, ' [', firearm_serial_no, ']') as title, 
                firearm_state as status 
             FROM firearms 
             WHERE firearm_name LIKE :q OR firearm_serial_no LIKE :q)
            UNION
            (SELECT 
                'rank' as type, 
                officerID as id, 
                full_name as title, 
                officer_service_no as status 
             FROM officers 
             WHERE full_name LIKE :q OR officer_service_no LIKE :q)
            UNION
            (SELECT 
                'ammo_type' as type, 
                ammoID as id, 
                ammo_name as title, 
                'IN_STOCK' as status 
             FROM ammunitions 
             WHERE ammo_name LIKE :q)
            LIMIT 10
        ";

        $stmt = $pdo->prepare($sql);
        $stmt->execute(['q' => $search]);
        $results = $stmt->fetchAll();

        if ($results) {
            foreach ($results as $row) {
                $statusStr = strtoupper($row['status']);
                $statusClass = 'status-unknown';
                
                // Mapping statuses to CSS classes
                if (strpos($statusStr, 'GOOD') !== false || strpos($statusStr, 'STOCK') !== false || strpos($statusStr, 'ACTIVE') !== false) {
                    $statusClass = 'status-available';
                } elseif (strpos($statusStr, 'ISSUED') !== false || strpos($statusStr, 'OFFLINE') !== false) {
                    $statusClass = 'status-busy';
                }

                $output .= '
                <a href="view-asset.php?type='.$row['type'].'&id='.$row['id'].'" class="list-group-item list-group-item-action border-0 mb-1 tactical-result-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="asset-indicator '.$statusClass.'"></div>
                            <div class="ms-3">
                                <p class="mb-0 font-weight-bold text-white">'.strtoupper($row['title']).'</p>
                                <small class="text-muted">TYPE: '.strtoupper($row['type']).'</small>
                            </div>
                        </div>
                        <span class="badge '.$statusClass.'-badge">'.$statusStr.'</span>
                    </div>
                </a>';
            }
        } else {
            $output .= '<div class="p-3 text-danger small text-center">NO_MATCHING_INTEL_FOUND</div>';
        }
    } catch (PDOException $e) {
        // Logging the actual error helps with debugging
        $output .= '<div class="p-3 text-danger small">ERR_DATABASE_LINK_FAILURE: ' . $e->getMessage() . '</div>';
    }
    
    $output .= '</div>';
    echo $output;
}