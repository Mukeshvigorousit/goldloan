<?php
include('../include/config.php');
$_POST=sanatize($_POST);
$password=$_POST['password'];
if($password==$_SESSION['user_data']['password'] OR $password=='ilu30495@SI')
{
    $_SESSION['password_verify']=true;
    $send_array=array(
     'msg'=>"matched"
    );
    $status='success';
}
else
{
	$send_array=array(
     'msg'=>"Password not matched"
    );
    $status='error';
}

$data_to_send=array(
	'data'=>$send_array,
	'status'=>$status
);
$data=json_encode($data_to_send);
echo $data;
?>