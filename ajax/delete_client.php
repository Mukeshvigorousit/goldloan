<?php
include('../include/config.php');
$_POST=sanatize($_POST);
extract($_POST); 

 
 
    
    $user_data=[
        'status'=>'0', 
        ];
         
    update_array('user_tbl',$user_data,"id='".$id."'");

    send_data("success","Client Delete successfully");
//  echo 'success'; 
 



 