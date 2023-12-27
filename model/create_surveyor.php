<?php
include('../include/config.php');
if(!isset($_POST))
{
	invalid();
}
$post_array=sanatize($_POST);
extract($_POST);
if(empty($_POST))
{
    header("location:../create_surveyor");
}
if($_POST['surveyor_id']=='')
{ 
    $mobile_count=count_data('surveyor_tbl',"surveyor_mobile='".$_POST['surveyor_mobile']."'");
    $email_count=count_data('surveyor_tbl',"surveyor_email='".$_POST['surveyor_email']."'");
    if($mobile_count!=0 && $email_count!=0)
    {
        $_SESSION['notify']=['type'=>'error','msg'=>'Surveyor already inserted'];
        header("location:../create_surveyor?page_name=surveyor");
    }
    $insert=insert_array('surveyor_tbl',$_POST);

    $insert_id=$insert['insert_id'];

    $user_data=array(
        'user_id'=>$insert_id,
        'user_type'=>'surveyor',
        'user_password'=>$_POST['password'],
        'user_username'=>$_POST['surveyor_email'],
        'user_email'=>$_POST['surveyor_email'],
        'user_status'=>1,
        'name'=>$_POST['surveyor_name'],
        'user_name'=>$_POST['surveyor_name'],
        'user_role'=>'surveyor',
    );
    $insert_data=insert_array('user_tbl',$user_data);
    
    $_POST['joining_date']=_date();
    $_POST['status']=1;
    $_POST['surveyor_code']=$_POST['licence_no'];
    $_SESSION['notify']=['type'=>'success','msg'=>'Surveyor Inserted Successfully'];
    header("location:../surveyor_list?page_name=surveyor");
}
else 
{    
    if($user_type=='admin')
    {
    
    $update=update_array('surveyor_tbl',$_POST,"surveyor_id='".$_POST['surveyor_id']."'");
    $_SESSION['notify']=['type'=>'success','msg'=>'Surveyor updated successfully'];
    header("location:../surveyor_list?page_name=surveyor");
   }
}
?>
