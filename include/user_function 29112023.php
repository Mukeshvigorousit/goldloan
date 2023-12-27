<?php

function store_where()
{
  return true;
}


function all_where($where='')
{
  if(empty($where))
  {
    $where="1=1";
  }
  if($_SESSION['user_type']=='admin')
  {
         $admin_where="admin_id='".$_SESSION['user_id']."'";
  }
  else if($_SESSION['user_type']=='manager')
  {
    $admin_where="manager_id='".$_SESSION['user_id']."'";
  }
  else
  {
      $admin_where="1=1";
  }

 $where="".$admin_where." AND ".$where;
 return $where;
}

function surveyor_where($where='')
{
  return all_where($where);
}

function priority_name($priority)
{
  if($priority=='6')
  {
    $return='superadmin';
  }

  if($priority=='5')
  {
    $return='admin';
  }

  if($priority=='4')
  {
    $return='master';
  }

  if($priority=='3')
  {
    $return='superagent';
  }

  if($priority=='2')
  {
    $return='agent';
  }
  if($priority=='1')
  {
    $return='client';
  }

return $return;
}





function get_data($table_name,$where='',$single='',$specific='')
{

 
   
 
  global $con;
  if(empty($where))
  {
    $where='1=1';
  }
  if($specific!='')
  {
    
       $query="SELECT ".$specific." FROM ".$table_name." WHERE ".$where."";
  }
  else
  {
  

    $query="SELECT * FROM ".$table_name." WHERE ".$where."";
  }

 
   
  $user_res = mysqli_query($con,$query);
  $send_array=array();
  if(empty($single))
   {
     while($data=mysqli_fetch_assoc($user_res))
     {
      array_push($send_array, $data);
     }    
   }
   else
   {
     $send_array=mysqli_fetch_assoc($user_res);
   }
    return $send_array;
}


function priority($role)
{
  if($role=='superadmin')
  {
    $return= 6;
  }

  if($role=='admin')
  {
    $return= 5;
  }

  if($role=='master')
  {
    $return= 4;
  }

  if($role=='superagent')
  {
    $return= 3;
  }

  if($role=='agent')
  {
    $return= 2;
  }
  if($role=='client')
  {
    $return= 1;
  }

return $return;
}
function check_role($role)
{
 // _dx($_SESSION);
  $superadmin=6;
  $admin=5;
  $master=4;
  $superagent=3;
  $agent=2;
  $client=1;
  $session_priority=$_SESSION['user_priority'];
  $return=0;

  if($role=='superadmin')
  {
    if($session_priority>=$superadmin)
    {      
    $return=1;
    }
  }

  if($role=='admin')
  {
    if($session_priority>=$admin)
    {      
    $return=1;
    }
  }

  if($role=='master')
  {
   
    if($session_priority>=$master)
    {      
    $return=1;
    }
  }

  if($role=='superagent')
  {
    if($session_priority>=$superagent)
    {      
    $return=1;
    }
  }

  if($role=='agent')
  {
    if($session_priority>=$agent)
    {      
    $return=1;
    }
  }

return $return;
}

function label_name($role)
{

  if($role=='owner')
  {
    $return= 'owner';
  }

  if($role=='superadmin')
  {
    $return= 'superadmin';
  }

  if($role=='admin')
  {
    $return= 'admin';
  }

  if($role=='master')
  {
    $return= 'master';
  }

  if($role=='superagent')
  {
    $return= 'superagent';
  }

  if($role=='sa')
  {
    $return= 'superagent';
  }

  if($role=='agent')
  {
    $return= 'agent';
  }

return $return;
}


function max_id($id,$table_name)
{

  global $con;
  $query="SELECT MAX(".$id.") FROM ".$table_name."";
  $ress=mysqli_query($con,$query);
  $id_data=mysqli_fetch_assoc($ress)['MAX(item_id)'];
  return $id_data;

}

function get_code()
{ 
  global $con;
  $query="SELECT MAX(item_id) FROM item_list WHERE store_id=".$_SESSION['store_id']."";
  $ress=mysqli_query($con,$query);
  $id_data=mysqli_fetch_assoc($ress)['MAX(item_id)'];
  $last_id=($id_data+1);
  $return='PC000'.$last_id;
  return $return;
}

function store_code()
{ 
  global $con;
  $query="SELECT MAX(store_id) FROM store_tbl";
  $ress=mysqli_query($con,$query);
  $id_data=mysqli_fetch_assoc($ress)['MAX(store_id)'];
  $last_id=($id_data+1);
  $return='STR00'.$last_id;
  return $return;
}

function invoice_code()
{ 
  global $con;
  $query="SELECT MAX(order_id) FROM order_tbl";
  $ress=mysqli_query($con,$query);
  $id_data=mysqli_fetch_assoc($ress)['MAX(order_id)'];
  $last_id=($id_data+1);
  $return=store_code().'-'.$last_id;
  return $return;
}


function invalid()
{
  header('location:404');
}

function column_names($table) {
  global $con;
  $sql = 'DESCRIBE '.$table;
  $result = mysqli_query($con, $sql);
  $rows = array();
  while($row = mysqli_fetch_assoc($result)) 
  {
    $name=$row['Field'];
    $rows['table'][''.$name.''] = '';
  } 
  return $rows;
}

function sanatize($array)
{
  global $con;
  $post_array=array();
  foreach ($array as $key => $value) {
    $post_array[$key]=trim(mysqli_real_escape_string($con,$value));
  }
  return $post_array;
}

function insert_array($table, $data, $exclude = array()) {
    global $con;
     $fields = $values = array();
    if( !is_array($exclude) ) $exclude = array($exclude);
    foreach( array_keys($data) as $key ) {
        if( !in_array($key, $exclude) ) {
            $fields[] = "`$key`";
            $values[] = "'" . $data[$key] . "'";
        } 
    }
    $fields = implode(",", $fields);
    $values = implode(",", $values);
    if( mysqli_query($con,"INSERT INTO `$table` ($fields) VALUES ($values)") ) {
        return array( "error" => 0,
                      "insert_id" => mysqli_insert_id($con),
                      "affected_rows" => mysqli_affected_rows($con),
                      "info" => mysqli_info($con)
                    );
    } else {
        return array( "error" => mysqli_error($con) );
    }
}




function update_array($table, $data, $where)
{

  
global $con;
$final= $fields = $values = array();


if(!empty($table) AND !empty($data) AND !empty($where)){
foreach ($data as $key => $value) {
  $fields[]="`$key`= '" . $value . "'";
}
$final=implode(",", $fields);

 
  $query="UPDATE `$table` SET ".$final." WHERE ".$where."";
 
//_d($query);
if(mysqli_query($con,$query))
{
  return array( "error" => 0,
                      "insert_id" => mysqli_insert_id($con),
                      "affected_rows" => mysqli_affected_rows($con),
                      "info" => mysqli_info($con)
                    );
}
else
{
  return array( "error" => mysqli_error($con) );
}
}
}

function check_id($id)
{
global $con;   
$self_id=$_SESSION['user_id'];
$query="SELECT user_id FROM users_tbl WHERE ".$_SESSION['user_type']."_id='".$_SESSION['user_id']."' AND user_id='".$id."'";
$res=mysqli_query($con,$query);
$data=mysqli_num_rows($res);
if($data=='1')
{
  return true;
}
else
{
  invalid();
}
}

function check_client_id($id)
{
global $con;   
$self_id=$_SESSION['user_id'];
$query="SELECT id FROM client WHERE ".$_SESSION['user_type']."_id='".$_SESSION['user_id']."' AND id='".$id."'";
$res=mysqli_query($con,$query);
$data=mysqli_num_rows($res);
if($data=='1')
{
  return true;
}
else
{
  invalid();
}
}

function pagination($table_name,$where='',$page_no='')
{  
  if(empty($page_no))
        {
          $page_no=1;
        }
        $where=$where!=''?$where:"1=1";
        $no_of_records_per_page =10;
        $offset = ($page_no-1) * $no_of_records_per_page;
        $where="".$where." AND 1=1 LIMIT $offset, $no_of_records_per_page";
        $data=get_data($table_name,$where);
        $total_count = count($data);
        $total_pages = ceil($total_count / $no_of_records_per_page);
         
         return $send_array=array(
            'data'=>$data,
            'total_pages'=>$total_pages
         );  
}


function count_data($table_name,$where='',$id='')
{ global $con;
  if(empty($where))
  {
    $where='1=1';
  }
  $query="SELECT * FROM ".$table_name." WHERE ".$where."";
  if($id!='')
  {
    $query="SELECT ".$id." FROM ".$table_name." WHERE ".$where."";
  }

  $user_res = mysqli_query($con,$query);
  return mysqli_num_rows($user_res);
}



function cricket_pagination($table_name,$where='',$page_no='')
{  
  if(empty($page_no))
        {
          $page_no=1;
        }
        $where=$where!=''?$where:"1=1";
        $no_of_records_per_page =20;
        $count=count_data($table_name,$where);
        $offset = ($page_no-1) * $no_of_records_per_page;
        $where="".$where." AND 1=1 order by id desc LIMIT $offset, $no_of_records_per_page";
        $data=get_data($table_name,$where);
        $total_count = $count;
        $total_pages = ceil($total_count / $no_of_records_per_page);
         
         return $send_array=array(
            'data'=>$data,
            'total_pages'=>$total_pages 
         );  
}

function get_data_pagination($table_name,$where='',$page_no='',$order_by='')
{  
  if(empty($page_no))
        {
          $page_no=1;
        }
        $where=$where!=''?$where:"1=1";
        $no_of_records_per_page =50000;
        $count=count_data($table_name,$where);
        $offset = ($page_no-1) * $no_of_records_per_page;
         $where="".$where." AND 1=1 ".$order_by." LIMIT $offset, $no_of_records_per_page";
        $data=get_data($table_name,$where);
        //_dx($data);
        $total_count = $count;
        $total_pages = ceil($total_count / $no_of_records_per_page);
         return $send_array=array(
            'data'=>$data,
            'total_pages'=>$total_pages 
         );  
}

function get_location()
{  
  global $con;
  $url="http://ip-api.com/json";
  $data=api_data_curl_no_header($url,true);
  return json_decode($data);
}

function update_login_details($user_id)
{
  
  $user_data=get_data('users_tbl',"user_id='".$user_id."'",'s');
  extract($user_data);
  $domain=domain;
  $send_url=$user_type.'.'.$domain;
  if($user_type=='superagent')
  {
    $send_url="super".$domain;
  }
  $msg="Dear ".$user_type." Your username is ".$username." and password is ".$password." AND login url is ".$send_url;
  _d($msg);





$senderId="DEMOOS";
$serverUrl="msg.msgclub.net";
$authKey="13e050bf582cbdd05af4ec7247bd1bf9";
$route="1";
   //Prepare you post parameters

    $postData = array(
       'mobileNumbers' => $mobile,        
        'smsContent' => $msg,
        'senderId' => $senderId,
        'routeId' => $route,        
        "smsContentType" =>'english'
    );


    $data_json = json_encode($postData);

    $url="http://".$serverUrl."/rest/services/sendSMS/sendGroupSms?AUTH_KEY=".$authKey;

    // init the resource

    $ch = curl_init();
    curl_setopt_array($ch, array(
        CURLOPT_URL => $url,
        CURLOPT_HTTPHEADER => array('Content-Type: application/json','Content-Length: ' . strlen($data_json)),
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => $data_json,
        CURLOPT_SSL_VERIFYHOST => 0,
        CURLOPT_SSL_VERIFYPEER => 0
    ));

    $output = curl_exec($ch);
    
    curl_close($ch);

    return $output;

}

function dateDiff($date1, $date2)
{
    $date1_ts = strtotime($date1);
    $date2_ts = strtotime($date2);
    $diff = $date2_ts - $date1_ts;
    return round($diff / 86400);
}



function createNewImageSize($imagename,$tempimagename,$width,$height,$newlocation,$newimage)
{
    $imagePart = explode('.',$imagename);
    $extension = end($imagePart);
    $extension = strtolower($extension);
    $allowedExtension = array('jpg','png','jpeg','pjpeg','gif');
    
    if(!in_array($extension,$allowedExtension))
     {
        $result = 0;  
     }
     else
     {
    //$renameImage = rename($image,$pid.'_1_1');    
     
    $path =  $tempimagename;  

    $mime = getimagesize($path);

    if($mime['mime']=='image/png'){ $src_img = imagecreatefrompng($path); }
    if($mime['mime']=='image/jpg'){ $src_img = imagecreatefromjpeg($path); }
    if($mime['mime']=='image/jpeg'){ $src_img = imagecreatefromjpeg($path); }
    if($mime['mime']=='image/pjpeg'){ $src_img = imagecreatefromjpeg($path); }
    if($mime['mime']=='image/gif'){ $src_img = imagecreatefromjpeg($path); }
    
    $old_x  =   imagesx($src_img);
    $old_y  =   imagesy($src_img);
    
    if($height == "" || $height ==0)
    {
    $ratio_orig = $old_x/$old_y;
    
        if($ratio_orig > 1)
        {
        $height = $width/$ratio_orig;
        $width = $width;
        }
        else
        {
        $height = $width;       
        $width = $width*$ratio_orig;        
        }
    }
    // For Image Creation
           
    $dst_img = imagecreatetruecolor($width,$height);
    imagecopyresampled($dst_img,$src_img,0,0,0,0,$width,$height,$old_x,$old_y); 
    // New save location
    $new_thumb_loc = $newlocation.'/'.$newimage.'.'.$extension;
    
    if($mime['mime']=='image/png'){ $result = imagepng($dst_img,$new_thumb_loc,8); }
    if($mime['mime']=='image/jpg'){ $result = imagejpeg($dst_img,$new_thumb_loc,80); }
    if($mime['mime']=='image/jpeg'){ $result = imagejpeg($dst_img,$new_thumb_loc,80); }
    if($mime['mime']=='image/pjpeg'){ $result = imagejpeg($dst_img,$new_thumb_loc,80); }
    if($mime['mime']=='image/gif'){ $result = imagejpeg($dst_img,$new_thumb_loc,80); }
    
    imagedestroy($dst_img); 
    imagedestroy($src_img);
     }
     
    return $result;
}


function convert_key_array($array_data,$array_key)
    {   

        $send_array=[];
        $key_array=[];
        foreach ($array_data as $key => $value) 
        {
            if(!array_key_exists($value[$array_key], $send_array))
            {
                $send_array[$value[$array_key]]=$value; 
                array_push($key_array,$value[$array_key]);
            }
        }
        $key_data=implode(',',$key_array);
        $return['array_data']=$send_array;
        $return['key_array']=$key_data;
        return $return;
    }

    function convert_array_multi_data($array_data,$array_key)
    {   

        $send_array=[];
        foreach ($array_data as $key => $value) 
        {
          if(!array_key_exists($value[$array_key], $send_array))
          {
            $send_array[$value[$array_key]][0]=$value;
          }
          else
          {
            array_push($send_array[$value[$array_key]],$value);
            
          }
        }
  
        return $send_array;
    }
?>