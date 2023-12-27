<?php include('../include/config.php'); 
 $_POST=sanatize($_POST);
 $_GET=sanatize($_GET);
 extract($_POST);
 extract($_GET);
 if($user_id=='')
 {
		 $send_array=array('msg'=>'Something went wrong');
		$status='error';
		$data_to_send=array(
			'data'=>$send_array,
			'status'=>$status
);
}
 
 if($user_id!='')
 {
 	if(!isset($single))
 	{
 	$user_data=get_data('users_tbl',"user_id='".$user_id."'");	
 	}
 	else
 	{
 	$user_data=get_data('users_tbl',"user_id='".$user_id."'",'s');
 	}
   $user_data['total_coins']=call_total_coins($user_data['user_type'],$user_data['user_id']);
   $send_array=array('msg'=>'Status Updated','user_data'=>$user_data);
	$status='success';
	$data_to_send=array(
		'data'=>$send_array,
		'status'=>$status
	);
 }
$data=json_encode($data_to_send);
echo $data;
?>