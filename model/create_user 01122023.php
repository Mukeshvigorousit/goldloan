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
    header("location:../create_user");
}

 if(empty($_POST['password']))
 {
  $_POST['password']=rand(1111,99999);
 }

//  _dx($_POST);

//  if(isset($_FILES['client_signature_pic']) && $_FILES['client_signature_pic']['error']==0)
//     {
//         $name = $_FILES['client_signature_pic']['name'];
//         $tmp_name = $_FILES['client_signature_pic']['tmp_name'];
//         $size = $_FILES['client_signature_pic']['size'];
//         $arr = explode(".",$name);
//         $ext = end($arr);
//         $new_name = time().rand(100000, 1000000).".".$ext;
//         move_uploaded_file($tmp_name, "../img/item/item_full/".$new_name);
//         $_POST['client_signature_pic']=$new_name;
//     }

if (isset($_FILES['client_signature_pic']) && $_FILES['client_signature_pic']['error'] == 0) {
    $name = $_FILES['client_signature_pic']['name'];
    $tmp_name = $_FILES['client_signature_pic']['tmp_name'];
    $size = $_FILES['client_signature_pic']['size'];
    
    // Check if the file has a JPG extension
    $allowedExtensions = array('jpg');
    $arr = explode(".", $name);
    $ext = strtolower(end($arr));  
    
    if (in_array($ext, $allowedExtensions)) {
        $new_name = time() . rand(100000, 1000000) . "." . $ext;
        move_uploaded_file($tmp_name, "../img/item/item_full/" . $new_name);
        $_POST['client_signature_pic'] = $new_name;
    } else {
        $_SESSION['notify'] = ['type' => 'error', 'msg' => 'Only JPG files are allowed']; 
        header("location:../create_user?id=" . $_POST['id'] . "&page_name=" . $_POST['user_type']."&create_user_type=".$_POST['user_type']); 
        exit;  
    }
}


 



    if( isset($_FILES['client_pic']) &&  $_FILES['client_pic']['error']==0)
    {
        $name = $_FILES['client_pic']['name'];
        $tmp_name = $_FILES['client_pic']['tmp_name'];
        $size = $_FILES['client_pic']['size'];
        $arr = explode(".",$name);
        $ext = end($arr);
        $new_name = time().rand(100000, 1000000).".".$ext;
        move_uploaded_file($tmp_name, "../img/item/item_full/".$new_name);
        $_POST['client_pic']=$new_name;
    }


    if(isset($_FILES['jewellery_bill_pic']) && $_FILES['jewellery_bill_pic']['error']==0)
    {
        $name = $_FILES['jewellery_bill_pic']['name'];
        $tmp_name = $_FILES['jewellery_bill_pic']['tmp_name'];
        $size = $_FILES['jewellery_bill_pic']['size'];
        $arr = explode(".",$name);
        $ext = end($arr);
        $new_name = time().rand(100000, 1000000).".".$ext;
        move_uploaded_file($tmp_name, "../img/item/item_full/".$new_name);
        $_POST['jewellery_bill_pic']=$new_name;
    }

    if(isset($_FILES['aadhar_card_pic']) && $_FILES['aadhar_card_pic']['error']==0)
    {
        $name = $_FILES['aadhar_card_pic']['name'];
        $tmp_name = $_FILES['aadhar_card_pic']['tmp_name'];
        $size = $_FILES['aadhar_card_pic']['size'];
        $arr = explode(".",$name);
        $ext = end($arr);
        $new_name = time().rand(100000, 1000000).".".$ext;
        move_uploaded_file($tmp_name, "../img/item/item_full/".$new_name);
        $_POST['aadhar_card_pic']=$new_name;
    }

    if(isset($_FILES['pan_card_pic']) && $_FILES['pan_card_pic']['error']==0)
    {
        $name = $_FILES['pan_card_pic']['name'];
        $tmp_name = $_FILES['pan_card_pic']['tmp_name'];
        $size = $_FILES['pan_card_pic']['size'];
        $arr = explode(".",$name);
        $ext = end($arr);
        $new_name = time().rand(100000, 1000000).".".$ext;
        move_uploaded_file($tmp_name, "../img/item/item_full/".$new_name);
        $_POST['pan_card_pic']=$new_name;
    }
    
    $_POST['name_hindi']=translateText($_POST['name']);
    $_POST['father_name_hindi']=translateText($_POST['father_name']);
    $_POST['address_hindi']=translateText($_POST['address']);
    $_POST['city_hindi']=translateText($_POST['city']);
    $_POST['state_hindi']=translateText($_POST['state']);

    

if($_POST['id']=='')
{ 
    $_POST['create_date']=_date_time();
    $_POST['username']=$_POST['email'];
    $_POST['store_id']=$store_data['store_id'];
    $_POST['creater_id']=$userdata['id'];
    $_POST['creater_type']=$userdata['user_type'];
    $_POST['alter_mobile']=$userdata['alter_mobile'];
    $check=count_data('user_tbl',"name='".$_POST['name']."'");
    if($check)
    {
      $_SESSION['notify']=['type'=>'error','msg'=>'Name Already register'];
        header("location:../create_user?page_name=".$_POST['user_type']."&create_user_type=".$_POST['user_type']."");
    }
    $insert=insert_array('user_tbl',$_POST);
    $insert_id=$insert['insert_id'];
    $_SESSION['notify']=['type'=>'success','msg'=>''.$_POST['user_type'].' Created Successfully'];
    header("location:../users_list?page_name=".$_POST['user_type']."&create_user_type=".$_POST['user_type']."");
}
else 
{    
     
    
    $user=get_data('user_tbl',"id='".$_POST['id']."'",'s');
    $_POST['alter_mobile']=$_POST['alter_mobile']; 
   
    if($user['email']!=$_POST['email'])
    {
        $check=count_data('user_tbl',"email='".$_POST['email']."'");
        if($check)
        {
          $_SESSION['notify']=['type'=>'error','msg'=>'User Email Already register'];
            header("location:../create_user?page_name=".$_POST['user_type']."&create_user_type=".$_POST['user_type']."&id='".$_POST['id']."'");
        }

      $_POST['username']=$_POST['email'];
      
    }
    if($user['mobile']!=$_POST['mobile'])
    {
        $check=count_data('user_tbl',"mobile='".$_POST['mobile']."'");
        if($check)
        {
          $_SESSION['notify']=['type'=>'error','msg'=>'User Mobile Already register'];
            header("location:../create_user?page_name=".$_POST['user_type']."&create_user_type=".$_POST['user_type']."&id='".$_POST['id']."'");
        }
    }
    
    
 

   $update=update_array('user_tbl',$_POST,"id='".$_POST['id']."'");

   if($update)
   {
     $_SESSION['notify']=['type'=>'success','msg'=>''.$_POST['user_type'].' Updated Successfully'];
    header("location:../users_list?page_name=".$_POST['user_type']."&create_user_type=".$_POST['user_type']."");
   }
}
?>