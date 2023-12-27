<?php
include('config.php');
$post_data=sanatize($_POST);
$get_data=sanatize($_GET);
extract($post_data);
extract($get_data);

_dx($_POST);

$data_to_send=array(
	'data'=>$send_array,
	'status'=>$status
);
$data=json_encode($data_to_send);
echo $data;

?>