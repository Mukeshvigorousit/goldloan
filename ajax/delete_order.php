<?php
include('../include/config.php');
$_POST=sanatize($_POST);
extract($_POST); 

 
    
    $order_data=[
        'status'=>'0', 
        ];
         
    update_array('order_tbl',$order_data,"order_id='".$order_id."'");

    send_data("success","Order Delete successfully");
//  echo 'success'; 
 



 