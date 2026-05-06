
<?php  
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = mysqli_real_escape_string($connect_db,$_POST['query']);
      $query = "SELECT * FROM `firearms` WHERE firearm_serial_no like '%$query%' or 
                firearm_type like '%$query%'   or firearm_name like '%$query%'
                or firearm_class like '%$query%' or firearm_trigger_action like '%$query%' or
                firearm_trigger_type like '%$query%' or booking_status  like 
                '%$query%' or firearm_caliber like '%$query%' or 	firearm_capacity
                like '%$query%' or  firearmID  like '%$query%' or  
                firearm_state like '%$query%'";   

      $result = mysqli_query($connect_db, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li><a href="firearm-details?firearmID='.$row['firearmID'].'&firearm_serial_no='.$row['firearm_serial_no'].'" style="text-decoration:none;">
                             <code style="color:#fff;">'.$row["firearm_name"].'</code></li>';  
           }  
      }  
      else  
      {  
           $output .= '<li>No Result Found...</li>';  
      }  
      $output .= '</ul>';  
      echo $output;  
 }  
 ?> 