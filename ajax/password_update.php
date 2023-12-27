<?php 
include('../include/config.php');
if(isset($_SESSION['password_verify']))
    unset($_SESSION['password_verify']);
$update_array=$_POST['update_data'];
$where=$_POST['where'];
$tbl_name=$_POST['name'];

$count=count_data($tbl_name,$where);
if($count==0)
{   
 $insert=insert_array($tbl_name,$update_array);
 $send_array=array(
  'msg'=>'successfully insert',
 );
 $status='success';
}
else
{
 $data=update_array($tbl_name,$update_array,$where);
 $send_array=array(
  'msg'=>'successfully update',
 );
 $status='success';
}

$data_to_send=array(
	'data'=>$send_array,
	'status'=>$status
);
$data=json_encode($data_to_send);
echo $data;


?>