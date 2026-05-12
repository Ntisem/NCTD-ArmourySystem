<?php
require_once('connections/connect-db.php');
require_once('includes/user_auth.php');

// Security Gate: Only administrators or Admins should see this data
if($_SESSION["user_role"] != 'Administrator' && $_SESSION["user_role"] != 'Admin') {
    exit('0');
}

$sql = "SELECT COUNT(*) as total FROM bookings 
        WHERE returns = 'Not-Return' 
        AND TIMESTAMPDIFF(HOUR, booking_time, NOW()) > 48";

$result = mysqli_query($connect_db, $sql);
$row = mysqli_fetch_assoc($result);

echo $row['total'] ?? 0;
?>