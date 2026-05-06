<?php
 require_once('db.php');
 function notifications(){
    echo'
      <div class="nf-all">
        <div class="nf-area">
            <button class="btn-noti" id="nf-btn"><i class="bi bi-bell"></i></button> 
            <span id="nf-n">0</span>
        </div>
        <div class="nf-message" id="notifications"> Nothing</div>
       </div>
    ';
 }

 function seenNotification($uniqueid){
  $db = new Connect;
  global $tbl_Notifications;

  $seenNoti = $db ->prepare("UPDATE $tbl_Notifications SET noti_seen = 'seen' WHERE 
  noti_uniqueid = $uniqueid");
  $seenNoti -> execute();
}
?> 