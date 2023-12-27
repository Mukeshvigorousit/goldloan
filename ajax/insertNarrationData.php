<?php
include('../include/config.php');
$_POST=sanatize($_POST);
extract($_POST);
 
 
 



  
$insertArray = [
    "order_id"=>$order_id,
    "narration_type"=>$narration_type,
    "narration_text"=>$narration_text, 
    "creator_id"=>$_SESSION['user_data']['id'], 
    "created_on"=>_date_time(), 
]; 

 
 
insert_array("narration_tbl",$insertArray);

send_data("success","Narration Insert Successfully");
exit();
die();

?>