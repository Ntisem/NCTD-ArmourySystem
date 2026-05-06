<?php
// session_start();
if(isset($_POST['type']) && $_POST['type']=='ajax'){
	if((time()-$_SESSION['LAST_ACTIVE_TIME'])>900){
		echo "logout";
	}
}else{
	if(isset($_SESSION['LAST_ACTIVE_TIME'])){
		if((time()-$_SESSION['LAST_ACTIVE_TIME'])>900){
			header('location:logout');	
			die();
		}
	}
	$_SESSION['LAST_ACTIVE_TIME']=time();
	$redirect_link_var = $_SESSION['page_url'];
	if(!isset($_SESSION['IS_LOGIN'])){
		header('location:login?page_url='.$redirect_link_var.'');
		die();
	}
}
?>