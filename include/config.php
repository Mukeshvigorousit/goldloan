<?php 
@ob_start();
// error_reporting(0);
// ini_set('display_errors','On');
require_once('database.php');
session_start();
require_once('constant.php');
require_once('function.php');
require_once('user_function.php');
$ip=ip();
$request_uri=$_SERVER['REQUEST_URI'];
if(isset($page_id) AND $page_id=='login')
{
  return true;
}
else
{
if(!isset($_SESSION['is_verify_logged_in']))
{
  header("location:logout");
  die;
  exit();
}
}

if(isset($_SERVER['HTTP_REFERER']))
{
  $previous_url=$load_url=$_SERVER['HTTP_REFERER'];
}
else
{
  $previous_url=$load_url='dashboard';
}
$user_type=$_SESSION['user_data']['user_type'];
$userdata=$_SESSION['user_data'];
$is_investor=$_SESSION['user_type']=='investor'?true:false;
$is_superadmin=$_SESSION['user_type']=='superadmin'?true:false;
$is_admin=$_SESSION['user_type']=='admin'?true:false;
$is_client=$_SESSION['user_type']=='client'?true:false;
$is_employee=$_SESSION['user_type']=='employee'?true:false;
$store_data=$_SESSION['store_data'];
if(!$is_superadmin)
{
  $is_branch=$store_data['is_branch']?true:false;
  $is_store=$store_data['is_branch']?false:true;
  $parent_store_id=$is_branch?$store_data['parent_store_id']:0;
}

?>