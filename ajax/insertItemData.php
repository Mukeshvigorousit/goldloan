<?php
include('../include/config.php');
$_POST=sanatize($_POST);
extract($_POST);
if(!isset($item_id) || $item_id=='' )
{
    send_data("error","Item Id Required");
    die();
    exit();
}
$item_name=item_name($item_id);
$order_detail = order_detail($order_id);
$client_id=$order_detail['client_id'];
$investor_id=$order_detail['investor_id'];

  
$insertArray = [
    "order_id"=>$order_id,
    "item_id"=>$item_id,
    "client_id"=>$client_id,
    "investor_id"=>$investor_id,
    "item_name_by_user"=>$item_name_by_user,
    "item_name"=>$item_name,
    "grade"=>$item_name,
    "gross_wt"=>round($gross_wt,2),
    "less_wt"=>round($less,2),
    "net_wt"=>round(($gross_wt-$less),2),
    "tunch"=>round($tunch,2),
    "fine"=>round($fine,2),
    "item_wt"=>round($fine,2),
    "rate"=>round($rate,2),
    "total_value"=>round($value,2),
    "store_id"=>$store_data['store_id'],
    "store_type"=>$store_data['store_type'],
    "creator_id"=>$userdata['id'],
    "remark"=>$remark,
    "item_details"=>$item_details
];



$assign_investor_list=[
	'packet_reciving_date'=>_date(), 
	];
	 
update_array('assign_investor_list',$assign_investor_list,"order_id='".$order_id."'");

 
insert_array("order_item_list",$insertArray);

send_data("success","Item Insert Successfully");
exit();
die();

?>