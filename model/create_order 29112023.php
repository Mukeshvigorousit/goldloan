<?php
include('../include/config.php');
if(!isset($_POST))
{
	invalid();
}
$post_array=sanatize($_POST);

 

extract($_POST);


 


if(empty($_POST))
{
    header("location:../create_order");
}

if(empty($loan_amount))
{
    $_SESSION['notify']=['type'=>'error','msg'=>'Something Went Wrong'];
    header("location:../create_order?page_name='create_order'&client_id=".$_POST['client_id'].""); 
}



if(isset($_FILES['item_pic']) && $_FILES['item_pic']['error']==0)
    {
        $name = $_FILES['item_pic']['name'];
        $tmp_name = $_FILES['item_pic']['tmp_name'];
        $size = $_FILES['item_pic']['size'];
        $arr = explode(".",$name);
        $ext = end($arr);
        $new_name = time().rand(100000, 1000000).".".$ext;
        move_uploaded_file($tmp_name, "../img/item/item_full/".$new_name);
        $_POST['item_pic']=$new_name;
    }
  

    if(isset($_FILES['packet_pic']) && $_FILES['packet_pic']['error']==0)
    {
        $name = $_FILES['packet_pic']['name'];
        $tmp_name = $_FILES['packet_pic']['tmp_name'];
        $size = $_FILES['packet_pic']['size'];
        $arr = explode(".",$name);
        $ext = end($arr);
        $new_name = time().rand(100000, 1000000).".".$ext;
        move_uploaded_file($tmp_name, "../img/item/item_full/".$new_name);
        $_POST['packet_pic']=$new_name;
    }
  

    $client_data=get_data("user_tbl","id='".$_POST['client_id']."'","S");
    if(!isset($client_data) || empty($client_data) || $_POST['client_id']=='' || !isset($_POST['client_id']))
    {
        $_SESSION['notify']=['type'=>'error','msg'=>'Something Went Wrong'];
        header("location:../create_order?page_name='create_order'&client_id=".$_POST['client_id']."");
    }
      
    unset($_POST['name']);
    unset($_POST['email']);
    unset($_POST['aadhar_card']);
    unset($_POST['mobile']);

    if($_POST['order_id']=='')
    { 
    $_POST['item_name']=get_data("item_list","item_id='".$item_id."'","s")['item_name'];

   
  
   
  
    $deduct_amount=-1*($loan_amount);
    
    $_POST['create_date_time']=_date_time();
    $_POST['store_id']=$store_data['store_id'];
    $_POST['store_type']=$store_data['store_type'];
    $_POST['creater_id']=$userdata['id'];
    $_POST['creator_type']=$userdata['user_type'];
    $_POST['creator_name']=$userdata['name'];
    $_POST['client_name']=$client_data['name'];
    //$_POST['loan_amount']=$deduct_amount; 
     

   
  
    $gold_weight = dataInGram((float)$_POST['net_weight_gram_gold']); 
    // You can access the results like this:
    $_POST['weight_kg_gold'] = $gold_weight['weight_kg'];
    $_POST['weight_gm_gold'] = $gold_weight['weight_gram'];
    $_POST['weight_mlgm_gold'] = $gold_weight['weight_mlgm'];
    $_POST['total_weight_gram_gold']=(float)$_POST['net_weight_gram_gold'];


    $silver_weight = dataInGram((float)$_POST['net_weight_gram_silver']); 
    // You can access the results like this:
    $_POST['weight_kg_silver'] = $silver_weight['weight_kg'];
    $_POST['weight_gm_silver'] = $silver_weight['weight_gram'];
    $_POST['weight_mlgm_silver'] = $silver_weight['weight_mlgm'];
    $_POST['total_weight_gram_silver']=(float)$_POST['net_weight_gram_silver'];
  
    // $_POST['total_weight_gram_gold']=(dataInGram($_POST['weight_mlgm_gold'],"miligram")+$_POST['weight_gm_gold']);

   
    if($loan_date=='') 
    {
        $_POST['loan_date']=_date();
    }
    if($loan_amount<=0)
    {
        $_SESSION['notify']=['type'=>'error','msg'=>'Loan Amount Can Not Be Zero'];
        header("location:../create_order?page_name='create_order'&client_id=".$_POST['client_id']."");
        exit;
    }
 
 
    $order_id=insert_array("order_tbl",$_POST)['insert_id'];
  
    $transaction_log = [
        'amount'=>$deduct_amount,
        'user_id'=>$client_id,
        'user_type'=>'client',
        'order_id'=>$order_id,
        'overall_type'=>"principal",
        'remark'=>"Initially Debit By Company",
        'old_amount'=>0,
        'new_amount'=>$deduct_amount,
        'date_time'=>_date_time(),
    ];
    $insert_transaction = insert_array("transaction_log" , $transaction_log);
    $_SESSION['notify']=['type'=>'success','msg'=>''.$_POST['user_type'].' Created Successfully'];
    header("location:../order_list?page_name='order_list'");
}
else 
{    
    $gold_weight = dataInGram((float)$_POST['net_weight_gram_gold']); 
    // You can access the results like this:
    $_POST['weight_kg_gold'] = $gold_weight['weight_kg'];
    $_POST['weight_gm_gold'] = $gold_weight['weight_gram'];
    $_POST['weight_mlgm_gold'] = $gold_weight['weight_mlgm'];
    $_POST['total_weight_gram_gold']=(float)$_POST['net_weight_gram_gold'];


    $silver_weight = dataInGram((float)$_POST['net_weight_gram_silver']); 
    // You can access the results like this:
    $_POST['weight_kg_silver'] = $silver_weight['weight_kg'];
    $_POST['weight_gm_silver'] = $silver_weight['weight_gram'];
    $_POST['weight_mlgm_silver'] = $silver_weight['weight_mlgm'];
    $_POST['total_weight_gram_silver']=(float)$_POST['net_weight_gram_silver'];
    
    //_dx($_POST);

    update_array("order_tbl",$_POST,"order_id='".$_POST['order_id']."'");
   
     $_SESSION['notify']=['type'=>'success','msg'=>''.$_POST['user_type'].' Updated Successfully'];
    header("location:../create_order?page_name=create_order&order_id=".$_POST['order_id']."");
   
}
?>