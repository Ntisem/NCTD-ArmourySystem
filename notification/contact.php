<?php
require_once('db.php');
require_once('functions.php');

 if(isset($_GET['notification'])){$uniqueid = $_GET['notification'];
 }
 seenNotification($uniqueid);

 echo 'Notification has been seen<a href="index.php>Back</a>"';
?>