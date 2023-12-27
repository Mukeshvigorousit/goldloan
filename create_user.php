<?php
include('include/config.php');
$_GET = sanatize($_GET);
$_POST = sanatize($_POST);
extract($_GET);
$edit = false;
$isClient = false;
if ($create_user_type == 'investor' && !$is_admin) {
    invalid();
}
$where = "1=1";
if (isset($_GET['user_id']) && !empty($_GET['user_id'])) {
    $edit = true;
    $where = "id='" . $_GET['user_id'] . "'";
}
$page_title = "Create " . $_GET['create_user_type'];
if (!isset($_GET['id'])) {
    $table_data = column_names('user_tbl')['table'];
} else {
    $table_data = get_data('user_tbl', "id='" . $_GET['id'] . "'", 's');
    if ($table_data['user_type'] == 'investor' && !$is_admin) {
        invalid();
    }
}
include('header.php');
$page_title = $_GET['page_name'];
$createUser = $_GET['create_user_type'];
if ($createUser == 'client') {
    $isClient = true;
}
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
        <h2><?= ucfirst('Manage ' . $page_title . ''); ?></h2>
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
<form action="model/create_user" method="POST" enctype="multipart/form-data" id="form" name="form">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Name<code>*</code></label>
                    <div class="col-lg-4">
                        <input required name="name" id="name" type="text" value="<?= $table_data['name'] ?>" class="form-control">
                    </div>
                    <label class="col-lg-2 col-form-label">Email</label>
                    <div class="col-lg-4">
                        <input name="email" id="email" type="text" value="<?= $table_data['email'] ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Aadhar No</label>
                    <div class="col-lg-4">
                        <input name="aadhar_card" id="aadhar_card" type="text" value="<?= $table_data['aadhar_card'] ?>" class="form-control">
                    </div>
                    <label class="col-lg-2 col-form-label">Mobile no</label>
                    <div class="col-lg-4">
                        <input name="mobile" id="mobile" type="text" value="<?= $table_data['mobile'] ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Alternative Mobile no</label>
                    <div class="col-lg-4">
                        <input name="alter_mobile" id="alter_mobile" type="text" value="<?= $table_data['alter_mobile'] ?>" class="form-control">
                    </div>

                    <?php if($isClient ) {
                      
                        ?>
                          <label class="col-lg-2 col-form-label">Client Occupation</label>
                    <div class="col-lg-4">
                        <input name="client_occupation" id="client_occupation" type="text" value="<?= $table_data['client_occupation'] ?>" class="form-control">
                    </div>

                        <?php
                    }
                  ?>


                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Password </label>
                    <div class="col-lg-4">
                        <input name="password" id="password" type="text" value="<?= $table_data['password'] ?>" class="form-control">
                    </div>
                    <label class="col-lg-2 col-form-label">Father / Husband Name</label>
                    <div class="col-lg-4">
                        <input name="father_name" id="father_name" type="text" value="<?= $table_data['father_name'] ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">State</label>
                    <div class="col-lg-4">
                        <input name="state" id="state" type="text" value="<?= $table_data['state'] ?>" class="form-control">
                    </div>
                    <label class="col-lg-2 col-form-label">City</label>
                    <div class="col-lg-4">
                        <input name="city" id="city" type="text" value="<?= $table_data['city'] ?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">DOB</label>
                    <div class="col-lg-4">
                        <input name="dob" id="dob" type="date" value="<?= $table_data['dob'] ?>" class="form-control">
                    </div>
                    <label class="col-lg-2 col-form-label">Nomination</label>
                    <div class="col-lg-4">
                        <input name="nomination" id="nomination" type="text" value="<?= $table_data['nomination'] ?>" class="form-control">
                    </div>
                </div>
                <!-- <?php if ($isClient) { ?>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Purity Checked By <code>*</code> </label>
                        <div class="col-lg-4">
                            <input name="purity_checked_by" id="purity_checked" type="text" value="<?= $table_data['purity_checked_by'] ?>" class="form-control">
                        </div>
                    </div>
                <?php  } ?> -->
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Remark</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" name="remark"><?= $table_data['remark'] ?></textarea>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Address</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" name="address"><?= $table_data['address'] ?></textarea>
                    </div>
                </div>
                <input type="hidden" name="id" value="<?= $table_data['id'] ?>">
                <input type="hidden" name="user_type" value="<?= $_GET['page_name'] ?>">
                <?php if ($_GET['create_user_type'] == 'client') { ?>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Client Photo<small style="color:red;"> (Optional)</small> </label>
                        <div class="col-lg-4">
                            <input class="form-control" type="file" name="client_pic">
                        </div>
                        <?php if (!empty($table_data['client_pic'])) { ?>
                            <div class="col-lg-4">
                                <img height="100" width="100" src="./img/item/item_full/<?= $table_data['client_pic'] ?>"><br>
                                <label class="col-lg-2 col-form-label"><a href="./img/item/item_full/<?= $table_data['client_pic'] ?>" download> Downlaod</a>
                                </label>
                            </div>
                        <?php } ?>
                        <label class="col-lg-2 col-form-label">Client Signature<small style="color:red;"> (Optional)</small> </label>
                        <div class="col-lg-4">
                            <input class="form-control" type="file" name="client_signature_pic">
                        </div>
                        <?php if (!empty($table_data['client_signature_pic'])) { ?>
                            <div class="col-lg-4">
                                <img height="100" width="100" src="./img/item/item_full/<?= $table_data['client_signature_pic'] ?>"><br>
                                <label class="col-lg-2 col-form-label"><a href="./img/item/item_full/<?= $table_data['client_signature_pic'] ?>" download> Downlaod</a>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Client Aadhar Card Front<small style="color:red;"> (Optional)</small> </label>
                        <div class="col-lg-4">
                            <input class="form-control" type="file" name="aadhar_card_pic_front">
                        </div>
                        <?php if (!empty($table_data['aadhar_card_pic_front'])) { ?>
                            <div class="col-lg-4">
                                <img height="100" width="100" src="./img/item/item_full/<?= $table_data['aadhar_card_pic_front'] ?>"><br>
                                <label class="col-lg-2 col-form-label"><a href="./img/item/item_full/<?= $table_data['aadhar_card_pic_front'] ?>" download> Downlaod</a>
                                </label>
                            </div>
                        <?php } ?>
                        <label class="col-lg-2 col-form-label">Client Aadhar Card Back<small style="color:red;"> (Optional)</small> </label>
                        <div class="col-lg-4">
                            <input class="form-control" type="file" name="aadhar_card_pic_back">
                        </div>
                        <?php if (!empty($table_data['aadhar_card_pic_back'])) { ?>
                            <div class="col-lg-4">
                                <img height="100" width="100" src="./img/item/item_full/<?= $table_data['aadhar_card_pic_back'] ?>"><br>
                                <label class="col-lg-2 col-form-label"><a href="./img/item/item_full/<?= $table_data['aadhar_card_pic_back'] ?>" download> Downlaod</a>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="form-group row"> 
                    
                        <label class="col-lg-2 col-form-label">Client Pan Card<small style="color:red;"> (Optional)</small> </label>
                        <div class="col-lg-4">
                            <input class="form-control" type="file" name="pan_card_pic">
                        </div>
                        <?php if (!empty($table_data['pan_card_pic'])) { ?>
                            <div class="col-lg-4">
                                <img height="100" width="100" src="./img/item/item_full/<?= $table_data['pan_card_pic'] ?>"><br>
                                <label class="col-lg-2 col-form-label"><a href="./img/item/item_full/<?= $table_data['pan_card_pic'] ?>" download> Downlaod</a>
                                </label>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Jewellery Bill<small style="color:red;"> (Optional)</small> </label>
                    <div class="col-lg-4">
                            <input  class="form-control" type="file" name="jewellery_bill_pic">  
                    </div> 
                    <?php if (!empty($table_data['jewellery_bill_pic'])) { ?> 
                        <div class="col-lg-4">
                            <img height="100" width="100" src="./img/item/item_full/<?= $table_data['jewellery_bill_pic'] ?>"><br>
                            <label class="col-lg-2 col-form-label"><a  href="./img/item/item_full/<?= $table_data['jewellery_bill_pic'] ?>" download > Downlaod</a>
                            </label>
                        </div> 
                    <?php } ?>
                </div> -->
                <?php } ?>
                <div class="form-group row">
                    <div class="col-lg-6">
                        <button class="btn btn-info" value="submit">Submit</button>
                    </div>
                </div>
            </div>
</form>
<br>
<br>
<?php include('footer.php'); ?>