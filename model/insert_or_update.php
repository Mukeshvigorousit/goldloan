<?php
include('../include/config.php');
$_GET=sanatize($_GET);
$_POST=sanatize($_POST);
extract($_POST);
extract($_GET);
$previus_url=$_SERVER['HTTP_REFERER'];
if(isset($return_url))
{
	$previus_url=$return_url;
}
if(isset($_POST['table_name']) AND !isset($_POST['where']))
{
	$table_name=$_POST['table_name'];
	unset($_POST['table_name']);
	$query=insert_array($table_name,$_POST);
}
else
{   
	$table_name=$_POST['table_name'];
	unset($_POST['table_name']);
	$where=$_POST['where'];
	unset($_POST['where']);
	$query=update_array($table_name,$_POST,$where);
}

$error=$query['error'];
if($error=='0')
{
  $_SESSION['notify']=['type'=>'success','msg'=>'SuccessFully']; 
  header("location:".$previus_url);
  exit();
}
else
{ 

	$_SESSION['notify']=['type'=>'error','msg'=>'something_went_wrong']; 
  header("location:".$previus_url);
  exit();
}

?>