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
    header("location:../create_claim");
}

$_POST['policy_valid_from'] = date_convertor($_POST['policy_valid_from']);
$_POST['policy_valid_upto'] =date_convertor($_POST['policy_valid_upto']);
$_POST['date_of_survey'] =date_convertor($_POST['date_of_survey']);
$_POST['date_of_loss'] =date_convertor($_POST['date_of_loss']);
$_POST['intimate_date'] = date_convertor($_POST['intimate_date']);
$_POST['vehicle_date_of_reg'] = date_convertor($_POST['vehicle_date_of_reg']);
$_POST['vehicle_reg_upto'] = date_convertor($_POST['vehicle_reg_upto']);
$_POST['driver_license_valid_upto'] = date_convertor($_POST['driver_license_valid_upto']);;
$survey_place=$_POST['place_of_survey'];

/*_dx($_POST);*/

if($_POST['claim_id']=='')
{

$count=count_data('claim_tbl',"claim_no='".$_POST['claim_no']."'");
if($count!=0)
{
    $_SESSION['notify']=['type'=>'error','msg'=>'This claim no is already registered'];
    header("location:../create_claim");
    die();
    exit();
}

if($user_type=='dealer')
{
    $_POST['dealer_id']=$_SESSION['original_data']['dealer_id'];
    $dealer_name=get_data('dealer',"dealer_id='".$_POST['dealer_id']."'",'s','dealer_name');
    $_POST['dealer_name']=$dealer_name['dealer_name'];
    $_POST['place_of_survey']=$dealer_name['dealer_name'];
}

if(isset($_POST['dealer_id']) AND $user_type!='dealer' AND $_POST['dealer_id']!='')
{
    $dealer_name=get_data('dealer',"dealer_id='".$_POST['dealer_id']."'",'s','dealer_name');
    $_POST['dealer_name']=$dealer_name['dealer_name'];
    $_POST['place_of_survey']=$dealer_name['dealer_name'];
}

if($_POST['dealer_id']=='')
{

    $_POST['place_of_survey']=$survey_place;

}

if($intimate_date=='')
{
    $_POST['intimate_date']=_date();
}

$_POST['intimate_by_id']=$_SESSION['user_id'];
$_POST['intimate_by_type']=$_SESSION['user_type'];

$folder_path = "../img/claim/".$_POST['claim_no'];
if (!file_exists($folder_path)) 
{
$mk=mkdir($folder_path, 0777, true);
chmod($folder_path, 0777);
} 


if($_FILES['intimation_pic']['error']==0)
    {
        $name = $_FILES['intimation_pic']['name'];
        $tmp_name = $_FILES['intimation_pic']['tmp_name'];
        $size = $_FILES['intimation_pic']['size'];
        $arr = explode(".",$name);
        $ext = end($arr);
        $new_name = time().rand(100000, 1000000).".".$ext;
        move_uploaded_file($tmp_name, $folder_path."/".$new_name);
        $_POST['intimation_pic']=$new_name;
        $post_array['intimation_pic']=$_POST['intimation_pic'];
    }

    if($_FILES['estimate_pic']['error']==0)
    {
        $name = $_FILES['estimate_pic']['name'];
        $tmp_name = $_FILES['estimate_pic']['tmp_name'];
        $size = $_FILES['estimate_pic']['size'];
        $arr = explode(".",$name);
        $ext = end($arr);
        $new_name = time().rand(100000, 1000000).".".$ext;
        move_uploaded_file($tmp_name, $folder_path."/".$new_name);
        $_POST['estimate_pic']=$new_name;
        $post_array['estimate_pic']=$_POST['estimate_pic'];
    }

$insert=insert_array('claim_tbl',$_POST);
$_SESSION['notify']=['type'=>'success','msg'=>'Claim intimated successfully'];
header("location:../claim_list?page_name=store");
}
else 
{    
    if($user_type!='admin' || $user_type=='surveyor')
    {
    unset($_POST['claim_no']);
    unset($_POST['dealer_id']);
    unset($_POST['policy_no']);
    }
    $update=update_array('claim_tbl',$_POST,"claim_id='".$_POST['claim_id']."'");
    $_SESSION['notify']=['type'=>'success','msg'=>'Cliam updated successfully'];
    header("location:../claim_list?page_name=store");
}
?>
