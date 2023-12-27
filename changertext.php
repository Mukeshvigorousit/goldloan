<?php 
include('include/config.php');


$user_data=get_data('user_tbl','','');

 


foreach ($user_data as $key => $data) {

    $_POST['id']=$data['id'];
    $_POST['name_hindi']=translateText($data['name']);
    $_POST['father_name_hindi']=translateText($data['father_name']);
    $_POST['address_hindi']=translateText($data['address']);
    $_POST['city_hindi']=translateText($data['city']);
    $_POST['state_hindi']=translateText($data['state']);

   $update=update_array('user_tbl',$_POST,"id='".$_POST['id']."'");

    
}

echo "all done";

 