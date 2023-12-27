<?php
include('../include/config.php');
$_POST = sanatize($_POST);
extract($_POST);

 


 



	if ($amount <= 0) {
		send_data("error", "amount can not be blank");
	}

 
	if(isset($_POST['discount']))
	{
		if ($discount < 0) {
			send_data("error", "Discount amount can not be blank");
		}
	}


	$deposit = $transaction_type == 'C' ? "deposited" : "TopUp";
	$order_data = get_data("order_tbl", "order_id='" . $order_id . "'", 's');

	//  adding 3 day extra Intersest remaing amount on partial payment
	$threedaysextrainterest = 0;
	if ($order_data['loan_amount'] != $amount) {
		$interestPerDay = ($order_data['loan_interest']) / (30);
		$threedaysextrainterest = round(3 * $interestPerDay * abs($order_data['loan_amount'] - $order_data['totalPrincipalReceived']) / 100, 2);
	}


 

	if ($amount_type == 'interest') {
		$totalInterestTillDate = $totalInterestTillDate - $amount;
	}
	$totalInterestTillDate = $totalInterestTillDate + $threedaysextrainterest;


	if ($deposit == 'TopUp') {
		$amount = -1 * abs($amount);
		$newloanamount = -$order_data['loan_amount'] + $amount;
	}



	
 

		$transaction_log = [
			'order_id' => $order_id,
			'amount' => $amount,
			'overall_type' => $amount_type,
			'date_time' => _date_time(),
			'remark' => $amount_type . "" . $deposit . "  by Customer ",
			'user_id' => $order_data['client_id'],
			'user_type' => 'client',
			'date' => _date(),
			'creator_id' => $_SESSION['user_data']['id'],
			'customer_remark' => $customer_remark,
			// 'new_amount'=>$new_amount,
		];
 


	if ($deposit == 'TopUp') { 

		// $order_update=[
		// 	'LastPrincipalRecivedDate'=>_date(),
		// 	'totalInterestTillDate'=>$totalInterestTillDate,
		// 	'loanTopUpAmount'=>abs($amount),
		// 	'loanTopUpdate'=>_date(),
		// 	'discount'=>$discount,
		// 	'loan_amount'=>abs($newloanamount),
		// 	]; 
		$update_amount = [
			'end_date' => _date(),
		];
		update_array('amount_tbl', $update_amount, "order_id='" . $order_id . "' ORDER BY `id` DESC LIMIT 1");

		// UPDATE `amount_tbl` SET `end_date` = '2023-12-18' WHERE `order_id` = '7' ORDER BY `id` DESC LIMIT 1;

		$insert_amount = [
			'amount' => $amount,
			'order_id' => $order_id,
			'start_date' => _date(),

		];
		$updateloan_amount = [
			'loan_amount' => abs($newloanamount),  
		];


		  insert_array("amount_tbl", $insert_amount);
		  update_array('order_tbl', $updateloan_amount, "order_id='" . $order_id . "'");
	} 
	else
	 {

		if ($discount >= 0) {
			$order_update = [
				'LastPrincipalRecivedDate' => _date(),
				'totalInterestTillDate' => $totalInterestTillDate, 
				'discount' => $discount,
				'3dayinstrest' => $threedaysextrainterest,
				'partially_close' => 0,
			];
		}
		else
		{
			$order_update = [
			'LastPrincipalRecivedDate' => _date(),
			'totalInterestTillDate' => $totalInterestTillDate,  
			'3dayinstrest' => $threedaysextrainterest,
			 
		];

		}


		
		update_array('order_tbl', $order_update, "order_id='" . $order_id . "'");
	}
	$tans = insert_array("transaction_log", $transaction_log);
	
	$order = getOrderDataByOrderId($order_id, [], true);

	send_data("success", "Amount successfully updated");
	$_SESSION['genrate_recipt'] = $tans['insert_id'];
 
	