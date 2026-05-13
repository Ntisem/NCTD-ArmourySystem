<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

if(!isset($_SESSION["username"]) || $_SESSION["user_role"] !== 'Armourer') {
    header("location: login");
    exit();
}


if (isset($_POST['query']) && !empty(trim($_POST['query']))) {
    $search = "%" . trim($_POST['query']) . "%";
    $output = '<div class="list-group tactical-results-group">';

    try {
        // Use positional placeholders (?) to avoid "Invalid parameter number" error
        $sql = "
            (SELECT 'firearm' as type, firearmID as id, firearm_name as title, firearm_serial_no as subtitle, firearm_state as status 
             FROM firearms WHERE firearm_name LIKE ? OR firearm_serial_no LIKE ?)
            UNION ALL
            (SELECT 'ammunition' as type, ammoID as id, ammo_name as title, manufacturer as subtitle, booking_status as status 
             FROM ammunitions WHERE ammo_name LIKE ? OR manufacturer LIKE ?)
            UNION ALL
            (SELECT 'officer' as type, officerID as id, full_name as title, officer_service_no as subtitle, officer_status as status 
             FROM officers WHERE full_name LIKE ? OR officer_service_no LIKE ?)
            UNION ALL
            (SELECT 'admin' as type, adminID as id, fullname as title, service_no as subtitle, user_role as status 
             FROM admin_lists WHERE fullname LIKE ? OR service_no LIKE ?)
            UNION ALL
            (SELECT 'faulty_weapon' as type, faulty_weaponID as id, faulty_firearm_name as title, faulty_firearm_serial_no as subtitle, faulty_nature as status 
             FROM faulty_weapons WHERE faulty_firearm_name LIKE ? OR faulty_firearm_serial_no LIKE ?)
            UNION ALL
            (SELECT 'faulty_ammo' as type, faulty_ammoID as id, faulty_type as title, faulty_ammo_serial_no as subtitle, 'FAULTY' as status 
             FROM faulty_ammo WHERE faulty_ammo_serial_no LIKE ? OR faulty_type LIKE ?)
            LIMIT 15
        ";

        $stmt = $pdo->prepare($sql);
        
        // Pass the search variable once for every '?' placeholder in the query (12 total)
        $params = array_fill(0, 12, $search);
        $stmt->execute($params);
        
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        if ($results) {
            foreach ($results as $row) {
                $status = strtoupper($row['status']);
                $indicatorClass = 'status-available';
                
                // Tactical state mapping
                if (in_array($status, ['FAULTY', 'OFFLINE', 'MISFIRE', 'ISSUED'])) {
                    $indicatorClass = 'status-busy';
                }

                $output .= '
                <a href="search-details.php?type='.$row['type'].'&id='.$row['id'].'" class="list-group-item list-group-item-action border-0 mb-1 tactical-result-item">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="d-flex align-items-center">
                            <div class="asset-indicator '.$indicatorClass.'"></div>
                            <div class="ms-3 ml-3">
                                <p class="mb-0 font-weight-bold text-white" style="letter-spacing:1px;">'.strtoupper($row['title']).'</p>
                                <small class="text-info">ID: '.$row['subtitle'].' | SRC: '.strtoupper(str_replace('_', ' ', $row['type'])).'</small>
                            </div>
                        </div>
                        <span class="badge '.$indicatorClass.'-badge">'.$status.'</span>
                    </div>
                </a>';
            }
        } else {
            $output .= '<div class="p-3 text-danger small text-center font-weight-bold">ZERO_RESULTS_RETURNED</div>';
        }
    } catch (PDOException $e) {
        $output .= '<div class="p-3 text-danger small">SQL_LINK_FAILURE: ' . $e->getMessage() . '</div>';
    }
    $output .= '</div>';
    echo $output;
}
?>