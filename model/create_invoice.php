<?php
include('../include/config.php');
if(!isset($_POST))
{
	invalid();
}
extract($_POST);

/*_dx($_POST);*/
$store_setting=get_data('store_setting',store_where("store_id='".$_SESSION['store_id']."'"),'s');
if(empty($item_id))
{
	$_SESSION['notify']=['type'=>'error','msg'=>'Please Select atleast one product'];
	header("location:../bill?page_name=invoice");
	exit();
}

$customer_array=array(
	'name'=>$customer_name,
	'mobile'=>$customer_mobile,
	'store_id'=>$_SESSION['store_id'],
	'last_purchase_date'=>_date(),
	'address'=>$customer_address
);

$customer_count=count_data('customer_tbl',"mobile='".$customer_mobile."'");
if($customer_count==0)
{   
	$customer_array['registration_date']=_date();
	$customer_array['creater_id']=$_SESSION['user_id'];
	$customer_array['created_id']=$_SESSION['user_type'];
	$customer=insert_array('customer_tbl',$customer_array);
	$customer_id=$customer['insert_id'];
}
else
{   $customer_data=get_data('customer_tbl',store_where("mobile='".$customer_mobile."'"),'s');
    $customer_id=$customer_data['customer_id'];
	$customer=update_array('customer_tbl',$customer_array,"mobile='".$customer_mobile."'");
}

$final_array=array();
foreach ($item_id as $key => $value) 
{   
	$array_push=array(
		'item_name'=>$item_name[$key],
		'item_quantity'=>$item_quantity[$key],
		'total_item_price'=>$total_item_price[$key],
		'total_price'=>$item_quantity[$key]*$total_item_price[$key]
	);
	array_push($final_array,$array_push);
}

$final_array=json_encode($final_array);

$discount=isset($discount)?$discount:0;
$gst_total=isset($gst_total)?$gst_total:0;
$grand_total=isset($grand_total)?$grand_total:0;
$send_array=array(
	'order_content'=>$final_array,
	'total_discount'=>$discount,
	'total_tax'=>$gst_total,
	'order_total_amt'=>$grand_total,
	'deliver_date'=>_date(),
	'status'=>1,
	'customer_id'=>$customer_id,
	'order_no'=>invoice_code(),
	'discount_type'=>$store_setting['discount_type'],
	'customer_name'=>$customer_name,
	'customer_mobile'=>$customer_mobile,
	'customer_address'=>$customer_address,
	'order_sub_total'=>$sub_total,
	'store_id'=>$_SESSION['store_id'],
);

    $insert_order=insert_array('order_tbl',$send_array);
    $id=$insert_order['insert_id'];

    $_SESSION['notify']=['type'=>'success','msg'=>'Success'];
	header("location:../simple_printer?id=".$id);
	exit();



?>