<?php
include('../include/config.php');
$item_pic='';
if(!isset($_POST))
{
	invalid();
}
$post_array=sanatize($_POST);

if($_FILES['item_pic']['error']==0)
    {
        $name = $_FILES['item_pic']['name'];
        $tmp_name = $_FILES['item_pic']['tmp_name'];
        $size = $_FILES['item_pic']['size'];
        $arr = explode(".",$name);
        $ext = end($arr);
        $new_name = time().rand(100000, 1000000).".".$ext;
        move_uploaded_file($tmp_name, "../img/item/item_full/".$new_name);
        //createNewImageSize($new_name,$_FILES['item_pic']['tmp_name'],'10','20','img/item/item_thumnails',$new_name);
        $_POST['item_pic']=$new_name;
        $post_array['item_pic']=$_POST['item_pic'];
    }
    $post_array['item_code']=get_code();
    $post_array['store_id']=$_SESSION['store_id'];

$insert=insert_array('item_list',$post_array);
$_SESSION['notify']=['type'=>'success','msg'=>' Store created successfully'];
header("location:../inventory?page_name=inventory");


?>
