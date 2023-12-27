<?php

include('../include/config.php');
$page_name=$_POST['page_name'];
if(isset($_POST['password_update']))
{
if(!isset($_POST))
{
	invalid();
}
$post_array=sanatize($_POST['user']);

$data= update_array('user_tbl', $post_array,'user_id='.$post_array['user_id']);



	$_SESSION['notify']=['type'=>'success','msg'=>''.$page_name.' password updated successfully'];
	if(isset($_POST['self']))
	{
		header("location:../password.php?list_type=".$page_name."&page_name=".$page_name."&self=true");
	}

}


?>