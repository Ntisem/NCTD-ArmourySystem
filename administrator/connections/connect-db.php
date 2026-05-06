<?php
	//for MySQLi Procedural
	session_start();
	$connect_db = mysqli_connect('localhost', 'root', '', 'gps_armoury_database');
	if(!$connect_db){
	    die("Connection failed: " . mysqli_connect_error());
	}
?>