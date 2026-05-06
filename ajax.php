<?php



if(isset($_GET['call_type']))
{
	$call_type = $_GET['call_type'];

	if($call_type == "rifle")
	{
		echo json_encode(array(
			'status'=>'success',
			'title'=> 'jQuery Page',
			'description' => 'jQuery description',
			'url' => 'jquery/'.$call_type.'.php',
			'data'=>'God is good'
		));
	}
	
	else if($call_type == "other-assets")
	{
		echo json_encode(array(
			'status'=>'success',
			'title'=> 'Home Page',
			'description' => 'Home description',
			'url' => '',
			'data'=>'This is <strong>Home</strong> data coming from ajax url'
		));
	}
	
}