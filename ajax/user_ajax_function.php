<?php
include('config.php');
$post_data=sanatize($_POST);
$get_data=sanatize($_GET);
extract($post_data);
extract($get_data);



if(isset($user_id) AND $is_coins==true)
{
$user_result=get_user_list('',$user_id);
$user_type=$user_result['user_type'];
$user_coins=call_total_coins($user_type,$user_id);
$data_to_send=array(
    'user_coins'=>$user_coins,
    'user_data'=>$user_result,
);
$data=json_encode($data_to_send);
echo $data;
exit();
die;
}



?>