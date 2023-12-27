<?php  
include('../include/config.php');
$_POST=sanatize($_POST);
extract($_POST);
if($amount<=0)
{
	send_data("error","amount can not be blank");
}

 

$assignData = get_data("assign_investor_list","assign_investor_id='".$_POST['assign_investor_id']."'",'s'); 
$investor_id=$assignData['investor_id'];

$order_data=get_data("order_tbl","order_id='".$order_id."'",'s');

if($amount_type=='principal')
{
	$amount_type="investorAmount";
	$transaction_type=$transaction_type=='C'?"D":"C";
}
if($amount_type=='interest')
{
	$amount_type="investorInterest";
}
$deposit = $transaction_type=='C'?"deposited":"withdraw";
$amount = $transaction_type=='D'?(-1*$amount):$amount;



$transaction_log = [
	'order_id'=>$order_id,
	'amount'=>$amount,
	'overall_type'=>$amount_type,
	'date_time'=>_date_time(),
	'remark'=>$amount_type."".$deposit."  by ".$assignData['investor_name'],
	'user_id'=>$investor_id,
	'user_type'=>'investor',
	'date'=>_date(),
];

 
insert_array("transaction_log",$transaction_log);
// $order=getOrderDataByOrderId($order_id,[],true);
send_data("success","Investor successfully updated");

?>