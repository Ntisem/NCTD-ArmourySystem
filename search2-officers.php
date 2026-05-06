
<?php  
require_once('connections/connect-db.php');
require_once('functions.php');
require_once('includes/user_auth.php');

 if(isset($_POST["query"]))  
 {  
      $output = '';  
      $query = mysqli_real_escape_string($connect_db,$_POST['query']);
      $query = "SELECT * FROM `officers` WHERE officer_service_no like '%$query%' or 
                rank like '%$query%'   or full_name like '%$query%'
                or gender like '%$query%'  or phone_no  like 
                '%$query%' or officer_email like '%$query%' or officerID like '%$query%'";   

      $result = mysqli_query($connect_db, $query);  
      $output = '<ul class="list-unstyled">';  
      if(mysqli_num_rows($result) > 0)  
      {  
           while($row = mysqli_fetch_array($result))  
           {  
                $output .= '<li><a href="officer-details?officerID='.$row['officerID'].'&officer_service_no='.$row['officer_service_no'].'" style="text-decoration:none;">
                             <code style="color:#fff;">'.$row["officer_service_no"].' '.$row["full_name"].'</code></li>';  
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