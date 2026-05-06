
<?php  require_once('connections/connect-db.php');?>
<?php  
require_once('functions.php');
require_once('includes/user_auth.php');
?>
<?php
//fetch.php;
if(isset($_POST["view"])){
	if($_POST["view"] != ''){
		mysqli_query($connect_db,"update `daily_activities` set seen_status='1' where seen_status='0'");
	}
	
	$query=mysqli_query($connect_db,"select * from `daily_activities` order by activityLogID desc limit 6");
	$output = '';
 
	if(mysqli_num_rows($query) > 0){
	while($row = mysqli_fetch_array($query)){
	$output .= '
	<a class="dropdown-item preview-item">
	<div class="preview-thumbnail">
		<div class="preview-icon bg-dark rounded-circle">
		<i class="mdi mdi-calendar text-success"></i>
		</div>
	</div>
	<div class="preview-item-content">
		<p class="preview-subject mb-1">'.$row['bookings'].'</p>
		<p class="text-muted ellipsis mb-0">'.$row['action_taken'].'</p>
	</div>
	</a>
	<div class="dropdown-divider"></div>
	';
	}
	}
	else{
	$output .= '<p class="p-3 mb-0 text-center">No Notification</p>';
	}
	
	$query1=mysqli_query($connect_db,"select * from `daily_activities` where seen_status='0'");
	$count = mysqli_num_rows($query1);
	$data = array(
		'notification'   => $output,
		'unseen_notification' => $count
	);
	echo json_encode($data);
	
}
?>