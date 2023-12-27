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
    header("location:../create_dealer");
}
if($_POST['dealer_id']=='')
{ 

    $insert=insert_array('dealer',$_POST);
    $insert_id=$insert['insert_id'];


    $user_data=array(
        'user_id'=>$insert_id,
        'user_type'=>'dealer',
        'user_password'=>$_POST['dealer_password'],
        'user_username'=>$_POST['dealer_username'],
        'user_email'=>$_POST['dealer_username'],
        'user_status'=>1,
        'name'=>$_POST['dealer_name'],
        'user_name'=>$_POST['dealer_name'],
        'user_role'=>'dealer',
    );
    $insert_data=insert_array('user_tbl',$user_data);


    
    $_POST['joining_date']=_date();
    $_POST['status']=1;
    $_POST['surveyor_code']=$_POST['licence_no'];
    $_SESSION['notify']=['type'=>'success','msg'=>'Surveyor Inserted Successfully'];
    header("location:../dealer_list?page_name=dealer");
}
else 
{    
    if($user_type=='admin')
    {
    
    $update=update_array('dealer',$_POST,"dealer_id='".$_POST['dealer_id']."'");
    $_SESSION['notify']=['type'=>'success','msg'=>'Surveyor updated successfully'];
    header("location:../dealer_list?page_name=dealer");
   }
}
?>
