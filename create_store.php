<?php
include('include/config.php');
$_GET=sanatize($_GET);
$_POST=sanatize($_POST);
extract($_GET);
if($store_type=='store' && !$is_superadmin)
{
    invalid();
}
if($store_type=='branch' && !$is_admin)
{
    invalid();
}
$where="1=1";
if(isset($_GET['store_id']) && !empty($_GET['store_id']))
{
    $where="store_id='".$_GET['store_id']."'";
}

$store_where=" AND store_type='store'";
if($store_type=='branch')
{
    $store_where=" AND store_type='branch'";
}

$where=$where.$store_where;



if(!isset($_GET['store_id']))
{
  $store_data=column_names('store_tbl')['table'];   
  $user_data=column_names('user_tbl')['table'];   
}
else
{
  $store_data=get_data('store_tbl',$where,'s');

  $store_id=$store_data['store_id'];
  $user_data=get_data('user_tbl',"store_id='".$store_id."' AND user_type='admin'",
's');

}

include('header.php');


$page_title=$_GET['store_type'];


?>

<style type="text/css">
hr {
    background-color: green;
}

.col-form-label {
    padding-top: calc(0.375rem + 1px);
    padding-bottom: calc(0.375rem + 1px);
    margin-bottom: 0;
    font-size: inherit;
    line-height: 1.5;
    font-weight: bold !important;
}
</style>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-4">
        <h2><?= ucfirst('Manage '.$page_title.'');?></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="dashboard.php?page_name=dashboard"><?= $page_title ?></a>
            </li>
            <li class="breadcrumb-item active">
                <strong><?= ucfirst($page_title); ?></strong>
            </li>
        </ol>
    </div>
</div>

<br>
<br>
<form action="model/create_store" method="POST" enctype="multipart/form-data" id="form" name="form">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Name<code>*</code></label>
                    <div class="col-lg-4">
                        <input required name="store_name" id="store_name" type="text"
                            value="<?= $store_data['store_name'] ?>" class="form-control">
                    </div>
                    <label class="col-lg-2 col-form-label">Email<code>*</code></label>
                    <div class="col-lg-4">

                        <input required name="email" id="email" type="text"
                            value="<?= $store_data['email'] ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Mobile<code>*</code></label>
                    <div class="col-lg-4">
                        <input required name="mobile" id="mobile" type="number"
                            value="<?= $store_data['mobile'] ?>" class="form-control">
                    </div>
                    <label class="col-lg-2 col-form-label">State</label>
                    <div class="col-lg-4">

                        <input name="state" id="state" type="text"
                            value="<?= $store_data['state'] ?>" class="form-control">
                    </div>
                </div>


                <div class="form-group row">
                   
                    <label class="col-lg-2 col-form-label">City<code>*</code></label>
                    <div class="col-lg-4">
                        <input required name="city" id="city" type="text"
                            value="<?= $store_data['city'] ?>" required class="form-control">
                    </div>

                     <label class="col-lg-2 col-form-label">Address<code>*</code></label>
                    <div class="col-lg-4">
                        <input name="store_address" id="store_address" type="text" value="<?= $store_data['store_address'] ?>"
                            required class="form-control">
                    </div>

                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Gst No </label>
                    <div class="col-lg-4">
                        <input required name="gst_no" id="gst_no" type="text" value="<?= $store_data['gst_no'] ?>"
                             class="form-control">
                    </div>

                    <label class="col-lg-2 col-form-label">Store Type<code>*</code></label>
                    <div class="col-lg-4">
                        <input required readonly name="store_type" id="store_type" type="text"
                            value="<?= $store_data['store_type']==''?$_GET['store_type']:$store_data['store_type'] ?>" required class="form-control">
                    </div>
                </div>


               


                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Address</label>
                    <div class="col-lg-10">
                        <textarea required class="form-control"
                            name="store_address"><?= $store_data['store_address']?></textarea>
                    </div>

                </div>

                <center>
                    <hr>
                    <label class="col-lg-12">
                        <h4>User Details</h4>
                    </label>
                    <hr>
                </center>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Name<code>*</code></label>
                    <div class="col-lg-4">
                        <input required name="UserData[name]" id="name" type="text"
                            value="<?= $user_data['name'] ?>" class="form-control">
                    </div>
                    <label class="col-lg-2 col-form-label">Username/Email<code>*</code></label>
                    <div class="col-lg-4">

                        <input required name="UserData[username]" id="username" type="email"
                            value="<?= $user_data['username'] ?>" class="form-control">
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Password<code>*</code></label>
                    <div class="col-lg-4">

                        <input required name="UserData[password]" id="password" type="text" value="<?= $user_data['password'] ?>"
                            class="form-control">
                    </div>

                    <label class="col-lg-2 col-form-label">UserType</label>
                    <div class="col-lg-4">
                        <select readonly class="form-control" name="UserData[user_type]">
                            <option value="<?= $user_data['user_type']?>">
                                <?= $user_data['user_type']==''?$_GET['store_type']=='store'?'admin':'Branch Manager':$user_data['user_type']    ?></option>
                            
                        </select>
                    </div>

                </div>


                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Mobile<code>*</code></label>
                    <div class="col-lg-4">
                        <input required name="UserData[mobile]" id="mobile" type="number"
                            value="<?= $user_data['mobile'] ?>" class="form-control">
                    </div>
                    <label class="col-lg-2 col-form-label">State</label>
                    <div class="col-lg-4">

                        <input name="UserData[state]" id="state" type="text"
                            value="<?= $user_data['state'] ?>" class="form-control">
                    </div>
                </div>


                <div class="form-group row">
                   
                    <label class="col-lg-2 col-form-label">City<code>*</code></label>
                    <div class="col-lg-4">
                        <input required name="UserData[city]" id="city" type="text"
                            value="<?= $user_data['city'] ?>" required class="form-control">
                    </div>

                     <label class="col-lg-2 col-form-label">Address<code>*</code></label>
                    <div class="col-lg-4">
                        <input name="UserData[address]" id="address" type="text" value="<?= $user_data['address'] ?>"
                            required class="form-control">
                    </div>

                </div>
                 
           
                 <input type="hidden" name="UserData[user_id]" value="<?= $user_data['id'] ?>">
     


                <div class="form-group row">
                    <input type="hidden" name="store_id" value="<?= $store_data['store_id'] ?>">
                    <div class="col-lg-6">
                        <button class="btn btn-info" value="submit">Submit</button>
                    </div>
                </div>
            </div>

</form>

<br>
<br>


<?php include('footer.php'); ?>