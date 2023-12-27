<?php
include('../include/config.php');
$_POST=sanatize($_POST);
extract($_POST);
if(!isset($investor_id) || $investor_id=='' )
{
    send_data("error","Item Id Required");
    die();
    exit();
}



 

$investor_name=user_detail($investor_id)['name'];
$order_detail = order_detail($order_id);
$client_id=$order_detail['client_id'];
$client_name=$order_detail['client_name'];

$insertArray = [
    "order_id"=>$order_id,
    "investor_id"=>$investor_id,
    "client_id"=>$client_id,
    "client_name"=>$client_name,
    "investor_name"=>$investor_name,
    "packet_name"=>$packet_name,
    "start_date"=>$start_date,
    "status"=>$status,
    "amount"=>round($amount,2),
    "interest_rate"=>round($interest_rate,2),
    "store_id"=>$store_data['store_id'],
    "store_type"=>$store_data['store_type'],
    "creator_id"=>$userdata['id'],
    "remark"=>$remark,
    "insert_date"=>_date_time()
];


 
$order_update=[
	'investor_id'=>$investor_id, 
    'investor_name'=>$investor_name,
	];


$order_item_list=[
	'investor_id'=>$investor_id,  
	];

 
insert_array("assign_investor_list",$insertArray);
update_array('order_tbl',$order_update,"order_id='".$order_id."'");
update_array('order_item_list',$order_item_list,"order_item_list_id='".$order_item_list_id."'");


$transaction_log = [
    'user_id'=>$investor_id,
    'user_type'=>'investor',
    'amount'=>$amount,
    'date_time'=>_date_time(),
    'remark'=>"Amount taken by ".$store_data['store_name'],
    'overall_type'=>"investorAmount",
    'order_id'=>$order_id,
    'date'=>_date()
];

insert_array("transaction_log",$transaction_log);
getOrderDataByOrderId($order_id,"",true);
send_data("success","Assign Investor Successfully");
exit();
die();

?>