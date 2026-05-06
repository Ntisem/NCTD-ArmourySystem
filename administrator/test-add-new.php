<?php  require_once('connections/connect-db.php');?>
<?php  
require_once('functions.php');
require_once('includes/user_auth.php');
?>
<?php
//insert.php
if(isset($_POST["armourer_admin_name"]))
{

	$armourer_admin_name = mysqli_real_escape_string($connect_db, $_POST['armourer_admin_name']);
	$action_taken = mysqli_real_escape_string($connect_db, $_POST['action_taken']);
    $user_role = mysqli_real_escape_string($connect_db, $_POST['user_role']);
    $booking_check = mysqli_real_escape_string($connect_db, $_POST['booking_check']);
    $bookings = mysqli_real_escape_string($connect_db, $_POST['bookings']);
    $adminID = mysqli_real_escape_string($connect_db, $_POST['adminID']);

	mysqli_query($connect_db,"insert into `daily_activities` (`adminID`,`armourer_admin_name`,`action_taken`,
    `booking_check`,`bookings`) 
    values ('$adminID','$armourer_admin_name','$action_taken','$user_role','$booking_check','$bookings')");
}
?>