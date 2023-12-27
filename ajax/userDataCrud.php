<?php include('../include/config.php'); 
 $_POST=sanatize($_POST);
 $_GET=sanatize($_GET);

 $user_id=$_POST['user_id'];
 $userData = get_data("user_tbl","id='".$user_id."' AND store_id='".$store_data['store_id']."'" , "s");
echo json_encode($userData)
?>
