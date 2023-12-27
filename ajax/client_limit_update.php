<?php
include('config.php');
$post_data=sanatize($_POST);
$get_data=sanatize($_GET);
extract($post_data);
extract($get_data);
$user_result=get_user_list('',$user_id);

if(isset($type) AND $type=='client_limit_update')
{
	$client_coins=used_limit($client_id);
	$user_limit=call_total_coins($userdata['id']);

_dx($user_limit);


	$where="user_id='".$post_data['user_id']."'";
	$update_data=update_array('users_tbl',$update_array,$where);
	if($update_data['error']==0)
	{
		$send_array=array('msg'=>'Fix Limit Updated Successfully');
		$status='success';
	}
	else
	{
		$send_array=array('msg'=>'Something went wrong');
		$status='error';
	}

	$task_array=array(
	'user_id'=>$user_id,
	'note'=>'Fix Limit',
	'fix_limit'=>$post_data['fix_limit'],
    'user_type'=>$user_result['user_type'],
    'user_match_comm'=>$user_result['user_match_comm'],
    'user_session_comm'=>$user_result['user_session_comm'],
    'user_share'=>$user_result['user_share'],
    'task_name'=>'Fix Limit'.' '.$user_result['user_type'],
    'creater_id'=>$_SESSION['user_id'],
    'creater_type'=>$_SESSION['user_type'],
    'creater_name'=>$_SESSION['name'],
    'ip'=>ip(),
    'date'=>_date(),
    'date_time'=>_date_time(),
    'user_name'=>$user_result['name']
);
$result=insert_array('user_history_log',$task_array,'');

}


$data_to_send=array(
	'data'=>$send_array,
	'status'=>$status
);
$data=json_encode($data_to_send);
echo $data;

?>