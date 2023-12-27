<?php

function total_admin_coins($admin_id)
{
global $con;
if(empty($admin_id OR !isset($admin_id)))
{
  return false;
}

//coins given from superadmin

$query = "SELECT SUM(amount)  total_credit FROM transaction_log WHERE admin_id = '$admin_id' AND  transaction_type = 'C' AND for_bet='0' AND overall_type='superadmin' AND old_data_status=0";
$res = mysqli_query($con, $query);
$credited = mysqli_fetch_assoc($res)['total_credit'];
$query = "SELECT SUM(amount) total_debit FROM transaction_log WHERE admin_id = '$admin_id' AND  transaction_type = 'D' AND for_bet='0' AND overall_type='superadmin' AND old_data_status=0";
$res = mysqli_query($con, $query);
$debited = mysqli_fetch_assoc($res)['total_debit'];
$total_admin_coins = $credited - $debited;


//coins given to master

$query = "SELECT SUM(amount)  total_credit FROM transaction_log WHERE admin_id = '$admin_id' AND  transaction_type = 'C' AND for_bet='0' AND overall_type='admin' AND old_data_status=0";
$res = mysqli_query($con, $query);
$credited = mysqli_fetch_assoc($res)['total_credit'];
$query = "SELECT SUM(amount) total_debit FROM transaction_log WHERE admin_id = '$admin_id' AND  transaction_type = 'D' AND for_bet='0' AND overall_type='admin' AND old_data_status=0";
$res = mysqli_query($con, $query);
$debited = mysqli_fetch_assoc($res)['total_debit'];
$total_master_given_coins = $credited - $debited;

//coins givent to downlinw other than master

$query = "SELECT SUM(amount)  total_credit FROM transaction_log WHERE admin_id = '$admin_id' AND  transaction_type = 'C' AND for_bet='0' AND overall_type!='admin' AND given_by='admin'";
$res = mysqli_query($con, $query);
$credited = mysqli_fetch_assoc($res)['total_credit'];
$query = "SELECT SUM(amount) total_debit FROM transaction_log WHERE admin_id = '$admin_id' AND  transaction_type = 'D' AND for_bet='0' AND overall_type!='admin' AND given_by='admin'";
$res = mysqli_query($con, $query);
$debited = mysqli_fetch_assoc($res)['total_debit'];
$total_given_coins_other_than_master = $credited - $debited;

return round(($total_admin_coins-($total_master_given_coins+$total_given_coins_other_than_master)),2);
}

function total_master_coins($master_id)
{
global $con;
if(empty($master_id OR !isset($master_id)))
{
  return false;
}

// coins_given_by_admin

$query = "SELECT SUM(amount)  total_credit FROM transaction_log WHERE master_id = '$master_id' AND  transaction_type = 'C' AND for_bet='0' AND overall_type='admin' AND old_data_status=0";
$res = mysqli_query($con, $query);
$credited = mysqli_fetch_assoc($res)['total_credit'];
$query = "SELECT SUM(amount) total_debit FROM transaction_log WHERE master_id = '$master_id' AND  transaction_type = 'D' AND for_bet='0' AND overall_type='admin' AND old_data_status=0";
$res = mysqli_query($con, $query);
$debited = mysqli_fetch_assoc($res)['total_debit'];
$total_master_coins = $credited - $debited; 


// coins_given_to_superagent

$query = "SELECT SUM(amount)  total_credit FROM transaction_log WHERE master_id = '$master_id' AND  transaction_type = 'C' AND for_bet='0' AND overall_type='master' AND old_data_status=0";
$res = mysqli_query($con, $query);
$credited = mysqli_fetch_assoc($res)['total_credit'];
$query = "SELECT SUM(amount) total_debit FROM transaction_log WHERE master_id = '$master_id' AND  transaction_type = 'D' AND for_bet='0' AND overall_type='master' AND old_data_status=0";
$res = mysqli_query($con, $query);
$debited = mysqli_fetch_assoc($res)['total_debit'];
$total_superaegnt_coins_given_by_master = $credited - $debited; 

// coins_given_To_downline_otherthan_superagent

// coins_given_by_admin

$query = "SELECT SUM(amount)  total_credit FROM transaction_log WHERE master_id = '$master_id' AND  transaction_type = 'C' AND for_bet='0' AND overall_type!='master' AND given_by='master'";
$res = mysqli_query($con, $query);
$credited = mysqli_fetch_assoc($res)['total_credit'];
$query = "SELECT SUM(amount) total_debit FROM transaction_log WHERE master_id = '$master_id' AND  transaction_type = 'D' AND for_bet='0' AND overall_type!='master' AND given_by='master'";
$res = mysqli_query($con, $query);
$debited = mysqli_fetch_assoc($res)['total_debit'];
$total_coins_given_by_master_other_than_superagent = $credited - $debited; 

return round(($total_master_coins-($total_superaegnt_coins_given_by_master+$total_coins_given_by_master_other_than_superagent)),2);
}


function total_superagent_coins($sa_id)
{

global $con;
if(empty($sa_id OR !isset($sa_id)))
{
  return false;
}
// coins_taken_by_master
$query = "SELECT SUM(amount)  total_credit FROM transaction_log WHERE sa_id = '$sa_id' AND  transaction_type = 'C' AND for_bet='0' AND overall_type='master' AND old_data_status=0";
$res = mysqli_query($con, $query);
$credited = mysqli_fetch_assoc($res)['total_credit'];
$query = "SELECT SUM(amount) total_debit FROM transaction_log WHERE sa_id = '$sa_id' AND  transaction_type = 'D' AND for_bet='0' AND overall_type='master' AND old_data_status=0";
$res = mysqli_query($con, $query);
$debited = mysqli_fetch_assoc($res)['total_debit'];
$total_superagent_coins = $credited - $debited;  

// coins_given_to_superagent
$query = "SELECT SUM(amount)  total_credit FROM transaction_log WHERE sa_id = '$sa_id' AND  transaction_type = 'C' AND for_bet='0' AND overall_type='super_agent' AND old_data_status=0";
$res = mysqli_query($con, $query);
$credited = mysqli_fetch_assoc($res)['total_credit'];
$query = "SELECT SUM(amount) total_debit FROM transaction_log WHERE sa_id = '$sa_id' AND  transaction_type = 'D' AND for_bet='0' AND overall_type='super_agent' AND old_data_status=0";
$res = mysqli_query($con, $query);
$debited = mysqli_fetch_assoc($res)['total_debit'];
$total_coins_give_to_agent = $credited - $debited;  


// coins_given_to_downline
$query = "SELECT SUM(amount)  total_credit FROM transaction_log WHERE sa_id = '$sa_id' AND  transaction_type = 'C' AND for_bet='0' AND overall_type!='super_agent' AND given_by='superagent'";
$res = mysqli_query($con, $query);
$credited = mysqli_fetch_assoc($res)['total_credit'];
$query = "SELECT SUM(amount) total_debit FROM transaction_log WHERE sa_id = '$sa_id' AND  transaction_type = 'D' AND for_bet='0' AND overall_type!='super_agent' AND given_by='superagent'";
$res = mysqli_query($con, $query);
$debited = mysqli_fetch_assoc($res)['total_debit'];
$total_coins_give_to_downline = $credited - $debited;


return round(($total_superagent_coins-($total_coins_give_to_agent+$total_coins_give_to_downline )),2);


}


function total_agent_coins($agent_id)
{
global $con;
if(empty($agent_id OR !isset($agent_id)))
{
  return false;
}
 
 // total_coins_taken_by_superagent

$query = "SELECT SUM(amount)  total_credit FROM transaction_log WHERE agent_id = '$agent_id' AND  transaction_type = 'C' AND for_bet='0' AND overall_type='super_agent' AND old_data_status=0";
$res = mysqli_query($con, $query);
$credited = mysqli_fetch_assoc($res)['total_credit'];
$query = "SELECT SUM(amount) total_debit FROM transaction_log WHERE agent_id = '$agent_id' AND  transaction_type = 'D' AND for_bet='0' AND overall_type='super_agent' AND old_data_status=0";
$res = mysqli_query($con, $query);
$debited = mysqli_fetch_assoc($res)['total_debit'];
$total_agent_coins = $credited - $debited;  

// total_coins_givent_to_client

$query = "SELECT SUM(amount)  total_credit FROM transaction_log WHERE agent_id = '$agent_id' AND  transaction_type = 'C' AND for_bet='0' AND overall_type='agent' AND old_data_status=0";
$res = mysqli_query($con, $query);
$credited = mysqli_fetch_assoc($res)['total_credit'];
$query = "SELECT SUM(amount) total_debit FROM transaction_log WHERE agent_id = '$agent_id' AND  transaction_type = 'D' AND for_bet='0' AND overall_type='agent' AND old_data_status=0";
$res = mysqli_query($con, $query);
$debited = mysqli_fetch_assoc($res)['total_debit'];
$total_given_coins_to_client = $credited - $debited; 

return round(($total_agent_coins-$total_given_coins_to_client),2);


}


function total_client_coins($client_id)
{
global $con;
if(empty($client_id OR !isset($client_id)))
{
  return false;
}
$query = "SELECT SUM(amount)  total_credit FROM transaction_log WHERE client_id = '$client_id' AND  transaction_type = 'C' AND old_data_status=0";
$res = mysqli_query($con, $query);
$credited = mysqli_fetch_assoc($res)['total_credit'];
$query = "SELECT SUM(amount) total_debit FROM transaction_log WHERE client_id = '$client_id' AND  transaction_type = 'D' AND old_data_status=0";
$res = mysqli_query($con, $query);
$debited = mysqli_fetch_assoc($res)['total_debit'];
$total_coins = $credited - $debited;
return $total_coins;
}



function call_total_coins($type,$id)
{
   if($type=='superadmin')
   {
    return total_superadmin_coins($id);
   }
   if($type=='admin')
   {
    return total_admin_coins($id);
   }
   if($type=='master')
   {
    return total_master_coins($id);
   }
   if($type=='superagent')
   {
    return total_superagent_coins($id);
   }
   if($type=='agent')
   {
    return total_agent_coins($id);
   }
   if($type=='client')
   {
    return total_client_coins($id);
   }
}


function used_client_limit ($client_id)
{
global $con;
$query = "SELECT SUM(amount)  total_credit FROM transaction_log WHERE client_id = '$client_id' AND  transaction_type = 'C' AND is_declare='0' AND for_bet='1'";
$res = mysqli_query($con, $query);
$credited = mysqli_fetch_assoc($res)['total_credit'];

$query = "SELECT SUM(amount) total_debit FROM transaction_log WHERE client_id = '$client_id' AND  transaction_type = 'D' AND is_declare='0' AND for_bet='1'";
$res = mysqli_query($con, $query);
$debited = mysqli_fetch_assoc($res)['total_debit'];
return $total_used_coins_before_match_declare =round($credited - $debited) ;
}



function used_limit($client_id)
{
  global $con;
  
$total_coins=call_total_coins('client',$client_id);

$query = "SELECT SUM(amount)  total_credit FROM transaction_log WHERE client_id = '$client_id' AND  transaction_type = 'C' AND is_declare='0' AND for_bet='1'";
$res = mysqli_query($con, $query);
$credited = mysqli_fetch_assoc($res)['total_credit'];

$query = "SELECT SUM(amount) total_debit FROM transaction_log WHERE client_id = '$client_id' AND  transaction_type = 'D' AND is_declare='0' AND for_bet='1'";
$res = mysqli_query($con, $query);
$debited = mysqli_fetch_assoc($res)['total_debit'];
$total_used_coins_before_match_declare =round($credited - $debited) ;

$total_used_coins=abs($total_used_coins_before_match_declare);

$show_value=abs($total_used_coins)+abs($total_coins);

return $send_array=array(
    'total_used_coins'=>$total_used_coins,
    'show_value'=>$show_value,
    'total_coins'=>$total_coins
);
}

function total_superadmin_coins($id)
{
  global $con;
$query = "SELECT SUM(amount)  total_credit FROM transaction_log WHERE superadmin_id = '$id' AND  transaction_type = 'C' AND given_by='superadmin'";
$res = mysqli_query($con, $query);
$credited = mysqli_fetch_assoc($res)['total_credit'];

$query = "SELECT SUM(amount) total_debit FROM transaction_log WHERE superadmin_id = '$id' AND  transaction_type = 'D' AND given_by='superadmin'";
$res = mysqli_query($con, $query);
$debited = mysqli_fetch_assoc($res)['total_debit'];
return $total_given_superadmin_coins =round($credited - $debited) ;
}

function overall_type($type)
{
   if($type=='admin')
   {
    return 'superadmin';
   }
   if($type=='master')
   {
    return 'admin';
   }
   if($type=='superagent')
   {
    return 'master';
   }
   if($type=='agent')
   {
    return 'super_agent';
   }
   if($type=='client')
   {
    return 'agent';
   }
}



function used_coins($user_id,$user_type)
{
global $con;
$given_by=$user_type;
if($user_type=='superagent')
{
  $user_type='sa';
}
if($user_type=='sa')
{
  $given_by='superagent';
}
$query = "SELECT SUM(amount)  total_credit FROM transaction_log WHERE ".$user_type."_id = '".$user_id."' AND  transaction_type = 'C' AND for_bet='0' AND given_by='".$given_by."'";
$res = mysqli_query($con, $query);
$credited = mysqli_fetch_assoc($res)['total_credit'];
$query = "SELECT SUM(amount) total_debit FROM transaction_log WHERE  ".$user_type."_id = '".$user_id."'  AND  transaction_type = 'D' AND for_bet='0' AND given_by='".$given_by."'";
$res = mysqli_query($con, $query);
$debited = mysqli_fetch_assoc($res)['total_debit'];
return $total_client_coins = abs($credited - $debited);  
}


function update_user_coins($parent_id,$user_id,$coins_to_be_updated)
{
global $con;
$amount=$coins_to_be_updated;
$user_result=get_user_list('',$user_id);
$parent_id=$creater_id=$parent_id;
$parent_details=get_data('users_tbl',$parent_id,'s');
$return=check_id($user_id);
$total_amount=call_total_coins($user_result['user_type'],$user_result['user_id']);
$user_used_coins=$used_coins=used_coins($user_result['user_id'],$user_result['user_type']);
$user_old_amount=$user_rest_amount=$rest_amount=$total_amount-$used_coins;
$update_amount=$amount-$rest_amount;
if($parent_details['user_type']!='superadmin')
{
   $parent_amount=call_total_coins($parent_details['user_type'],$parent_details['user_id']);
  
   if($update_amount>$parent_amount)
   {
    $status='error';
    $send_array=array('msg'=>'Please update coins for update  limit ! Thank you');
      $data_to_send=array(
      'data'=>$send_array,
      'status'=>$status
    );
    return $data_to_send;
    exit();
    die();
   }

}



if($amount<$user_used_coins)
   {
    $status='error';
    $send_array=array('msg'=>'User coin can not be less than used coins');
        $data_to_send=array(
      'data'=>$send_array,
      'status'=>$status
    );
    return $data_to_send;
    exit();
    die();
   }


   if($amount>$parent_details['fix_limit'])
   {
    $status='error';
    $send_array=array('msg'=>'User coin can not be greather than your fix limit coins');
        $data_to_send=array(
      'data'=>$send_array,
      'status'=>$status
    );
    return $data_to_send;
    exit();
    die();
   }

   $update_amount=$amount-$rest_amount;
   $transaction_type=$update_amount<=0 ?'D':'C';
   $update_array=array('fix_limit'=>$amount);
   
update_array('users_tbl',$update_array,"user_id='".$user_result['user_id']."'");
$transaction_user=$user_result['user_type'];
if($user_result['user_type']=='superagent')
{
  $transaction_user='sa';
}

$delete="DELETE FROM transaction_log WHERE overall_type='".overall_type($user_result['user_type'])."' AND for_bet=0 AND ".$transaction_user."_id='".$user_result['user_id']."'";
mysqli_query($con,$delete);

   
if($transaction_type=='C'){$mark='receive cash';}else{$mark='pay cash';}

$transaction_array=array(
  'transaction_type'=>'C',
  'amount'=>$amount,
  'user_type'=>$user_result['user_type'],
  'admin_id'=>$user_result['admin_id'],
  'superadmin_id'=>$user_result['superadmin_id'],
  'master_id'=>$user_result['master_id'],
  'agent_id'=>$user_result['agent_id'],
  'sa_id'=>$user_result['superagent_id'],
  'for_bet'=>'0',
  'remark'=>$mark.' '.$user_result['user_type'],
  'note'=>$user_result['user_type'].' coins has been updated',
  'given_by'=>$parent_details['user_type'],
  'given_id'=>$parent_details['user_id'],
  'overall_type'=>overall_type($user_result['user_type'])
);
$result=insert_array('transaction_log',$transaction_array,'');



$task_array=array(
  'user_id'=>$user_id,
  'note'=>$user_result['user_type'].' coins has been updated',
  'amount'=>$amount,
    'user_type'=>$user_result['user_type'],
    'user_match_comm'=>$user_result['user_match_comm'],
    'user_session_comm'=>$user_result['user_session_comm'],
    'user_share'=>$user_result['user_share'],
    'task_name'=>$mark.' '.$user_result['user_type'],
    'creater_id'=>$parent_details['user_id'],
    'creater_type'=>$parent_details['user_type'],
    'creater_name'=>$parent_details['name'],
    'ip'=>ip(),
    'date'=>_date(),
    'date_time'=>_date_time(),
    'user_name'=>$user_result['name']
);

$status='success';
    $send_array=array('msg'=>'Coins has been updated successfully');
        $data_to_send=array(
      'data'=>$send_array,
      'status'=>$status
    );
    return $data_to_send;
    exit();
    die();
}

function update_client_coins($client_id,$update_limit)
{
     
  $client_details=get_data('client',"id='".$client_id."'",'single');
  $parent_id=$creater_id=$client_details['creater_id'];
  $parent_details=get_data('users_tbl',"user_id='".$creater_id."'",'s');
  $user_id=$parent_details['user_id'];
  $parent_coin=$user_coin=call_total_coins($parent_details['user_type'],$parent_details['user_id']);
  $rest_user_coin=$user_coin;
  $client_coins=used_limit($client_details['id']);
  $client_total_coins=$client_coins['total_coins'];
  $client_used_limit=$client_coins['total_used_coins'];
  $client_update_limit=$update_limit;
  $status='success';

  if($update_limit<$client_used_limit)
  {
    $status='error';
    $send_array=array('msg'=>'Client coins can not be less than bloked limit','coins'=>$client_total_coins);
      $data_to_send=array(
      'data'=>$send_array,
      'status'=>$status
    );
    return $data_to_send;
    exit();
    die();
  }


  if($_SESSION['user_type']!='superadmin')
  {
  if($update_limit>$user_fix_limit)
  {/*
    $status='error';
    $send_array=array('msg'=>'Client coins can not be grether than '.$_SESSION['user_type'].' fix limit','coins'=>$client_total_coins);
    $data_to_send=array(
      'data'=>$send_array,
      'status'=>$status
    );
    return $data_to_send;
    exit();
    die();
  */}
  if(($update_limit-$client_total_coins)>$rest_user_coin)
  {
    $status='error';
    $send_array=array('msg'=>'You have '.$rest_user_coin.' Coins Please update coins for update client limit ! Thank you','coins'=>$client_total_coins);
  }
   }
    
    $real_update_limit=$update_limit-$client_total_coins-$client_coins['total_used_coins'];
  $transaction_type = $real_update_limit<0 ? 'D' : 'C';
  if($transaction_type=='D')
  {
      $real_update_limit=-1*$real_update_limit;
  }

  if($status!='error')
  {
     
  $transaction_array=array(
  'transaction_type'=>$transaction_type,
  'amount'=>$real_update_limit,
  'user_type'=>'client',
  'admin_id'=>$client_details['admin_id'],
  'superadmin_id'=>$client_details['superadmin_id'],
  'master_id'=>$client_details['master_id'],
  'agent_id'=>$client_details['agent_id'],
  'sa_id'=>$client_details['superagent_id'],
  'client_id'=>$client_id,
  'given_by'=>$parent_details['user_type'],
  'given_id'=>$parent_details['user_id'],
  'for_bet'=>'0',
  'remark'=>'Update '.$update_limit.' coins',
  'note'=>'Update Coins',
  'overall_type'=>'agent'
);
     //_dx($transaction_array);
$result=insert_array('transaction_log',$transaction_array,'');
/*$update_array=array('FixLimit'=>$_POST['fix_limit']);
$update=update_array('client',$update_array,"id='".$_POST['client_id']."'");*/

if (!empty($client_detail)) 
{
    $AutoLimit = $client_detail['AutoLimit'];
}
  else
  {
      $AutoLimit = '';
  }
  
  $auto_limit=get_data('autolimit_tbl','client_id='.$client_id,'single');
  $autolimit_data=array(
    'max_autolimit'=>$update_limit,
    'autolimit_status'=>$AutoLimit,
    'client_id'=>$client_id,
    'agent_id'=>$client_details['agent_id'],
    'master_id'=>$client_details['master_id'],
    'sa_id'=>$client_details['sa_id'],
    'superadmin_id'=>$client_details['superadmin_id'],
    'admin_id'=>$client_details['admin_id'],

  );
  if(!empty($auto_limit))
  {  
     $update=update_array('autolimit_tbl',$autolimit_data,'client_id'.$client_id);

  }
  else
  {
    $insert=insert_array('autolimit_tbl',$autolimit_data);
  }

  $task_array=array(
  'user_id'=>$user_id,
  'note'=>'Update Limit From'.$client_total_coins.' to'.$update_limit,
  'amount'=>$update_limit,
    'user_type'=>'client',
    'user_match_comm'=>$client_details['MatchCommissionClient'],
    'user_session_comm'=>$client_details['SessionCommissionClient'],
    'user_share'=>$client_details['MatchShare'],
    'task_name'=>$client_details['ClientName'].'('.$client_details['ClientCode'].')',
    'creater_id'=>$_SESSION['user_id'],
    'creater_type'=>$_SESSION['user_type'],
    'creater_name'=>$_SESSION['name'],
    'ip'=>ip(),
    'date'=>_date(),
    'date_time'=>_date_time(),
    'user_name'=>$client_details['ClientName'].'('.$client_details['ClientCode'].')'
);
$result=insert_array('user_history_log',$task_array,'');

$status='success';
$send_array=array('msg'=>'Coins has been updated successfully','coins'=>$update_limit);
}

$data_to_send=array(
      'data'=>$send_array,
      'status'=>$status
    );
    return $data_to_send;
    exit();
    die();
}

?>