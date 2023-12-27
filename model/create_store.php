<?php
include('../include/config.php');
$user_data=sanatize($_POST['UserData']);
unset($_POST['UserData']);
$store_data=sanatize($_POST);
if(!isset($store_data) || !isset($user_data))
{
	invalid();
}
if(empty($store_data['store_id']))
{
    $check_user=count_data('user_tbl',"username='".$user_data['username']."' AND user_type='admin'");
    if($check_user)
    {
        $_SESSION['notify']=['type'=>'error','msg'=>'User Already Register'];
        header("location:../create_store?store_type=".$store_data['store_type']."");
        die();
        exit();
    }
    if($store_data['store_type']=='store')
    {
        $user_data['user_type']='admin';
    }
    else
    {
        $user_data['user_type']='branch_manager';
    }

    if($store_data['store_type']=='branch')
    {
        $store_data['parent_store_id']=$store_data['store_id'];
        $store_data['is_branch']=1;
    }
    
    $user_data['email']=$user_data['username'];
    $store_data['create_date']=_date_time();

    $store_id=insert_array('store_tbl',$store_data)['insert_id'];
    $user_data['store_id']=$store_id;
    unset($user_data['user_id']);
    $insert=insert_array('user_tbl',$user_data);
  
    $_SESSION['notify']=['type'=>'success','msg'=>$store_data['store_type'].' has been created successfully'];
    header("location:../store_list?store_type=".$store_data['store_type']."");
    die();
    exit();
}
else
{
     $store_id=$store_data['store_id'];
     update_array('user_tbl',$user_data,"id='".$user_data['user_id']."'");
     update_array('store_tbl',$store_data,"store_id='".$store_data['store_id']."'");
     $_SESSION['notify']=['type'=>'success','msg'=>$store_data['store_type'].' has been Updated successfully'];
    header("location:../store_list?store_type=".$store_data['store_type']."");
    die();
    exit();
}



?>
