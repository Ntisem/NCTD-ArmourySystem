<?php
require_once('connections/connect-db.php');
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE bookingID = ?");
    $stmt->execute([$id]);
    $b = $stmt->fetch();

    if($b) {
        echo '
        <div class="row tactical-data">
            <div class="col-md-6 border-right border-info">
                <h6 class="text-info small">01_OFFICER_INTEL</h6>
                <p><b>NAME:</b> '.$b['to_officer'].'</p>
                <p><b>ISSUER:</b> '.$b['armourer_issuer'].'</p>
                <p><b>TIME:</b> '.$b['booking_time'].'</p>
                <p><b>DUTY LOC:</b> '.$b['duty_location'].'</p>
            </div>
            <div class="col-md-6">
                <h6 class="text-info small">02_ASSET_DATA</h6>
                <p><b>WEAPON:</b> '.$b['firearm_name'].'</p>
                <p><b>SERIAL:</b> '.$b['firearm_serial_no'].'</p>
                <p><b>AMMO:</b> '.$b['ammunition_name'].' ('.$b['number_of_rounds'].' rounds)</p>
                <p><b>FIREARM STATE:</b> '.$b['firearm_state'].'</p>
            </div>
            <div class="col-12 mt-3 pt-3 border-top border-secondary">
                <h6 class="text-info small">03_MISSION_REMARKS</h6>
                <p>'.$b['comment'].'</p>
                <div class="p-2 border border-info text-center mt-3">
                    STATUS: <span class="text-'.($b['returns'] == 'Returned' ? 'success' : 'danger').'">'.strtoupper($b['returns']).'</span>
                </div>
            </div>
        </div>';
    }
}
?>