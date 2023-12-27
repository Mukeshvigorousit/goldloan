<?php
include('../include/config.php');
if(!isset($_POST))
{
	invalid();
}
$post_array=sanatize($_POST);
$claim_no=get_data('claim_tbl',"claim_id='".$_POST['claim_id']."'",'s','claim_no')['claim_no'];
$folder_path = "../img/claim/".$claim_no;
foreach ($_FILES as $key => $value) 
{   

	extract($value);
	if($error==0)
	{
			        $arr = explode(".",$name);
			        $ext = end($arr);
			        $new_name = time().rand(100000, 1000000).".".$ext;
			        move_uploaded_file($tmp_name, $folder_path."/".$new_name);
			        $_POST[$key]=$new_name;
			       
	}

	
}
$count=count_data('claim_pic_tbl',"claim_id='".$_POST['claim_id']."'");
if($count==0)
{
	insert_array('claim_pic_tbl',$_POST);
}
else
{
	update_array('claim_pic_tbl',$_POST,"claim_id='".$_POST['claim_id']."'");
}

  $_SESSION['notify']=['type'=>'success','msg'=>'Photos Has been updated successfully'];
  header("location:../upload_pic?id=".$_POST['claim_id']."");


?>