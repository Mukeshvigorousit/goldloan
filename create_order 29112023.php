<?php

include('include/config.php');

$_GET=sanatize($_GET);

$_POST=sanatize($_POST);

extract($_GET);

$where="1=1";

if(isset($_GET['order_id']) && !empty($_GET['order_id']))

{

    $where="order_id='".$_GET['order_id']."'";

}



$page_title="Create Order";

if(!isset($_GET['order_id']))

{

$order_table_data=column_names('order_tbl')['table'];   

$order_item_list_table_data=column_names('order_item_list')['table'];   

}

else

{

  $order_table_data=get_data('order_tbl',$where,'s');

  $order_item_list_table_data=get_data('order_item_list',"order_id='".$_GET['order_id']."' AND store_id='".$store_data['store_id']."'",'s');

}



$item_list=get_data("item_list");



$client_list=get_data("user_tbl","user_type='client' AND store_id='".$store_data['store_id']."' order by id DESC");





include('header.php');



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



<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-md-12">

        <select <?php echo  isset($_GET['order_id'])?"disabled":""  ?> onChange="formVisible()" name="user_id"

            id='client_id' class="select2_demo_1 form-control select">

            <option value="">Select Client</option>

            <?php foreach ($client_list as $key => $user) { ?>

            <option

                <?php if(isset($order_table_data['client_id']) AND $order_table_data['client_id']==$user['id']) echo 'selected=selected ';  ?>

                value="<?= $user['id']?>"> <?= $user['name']?> (<?= $user['mobile']?>)</option>

            <?php  }  ?>

        </select>



    </div>

</div>



<br>



<form action="model/create_order" method="POST" enctype="multipart/form-data" id="form" name="form"

    style="display:none">

    <div class="row">

        <div class="col-lg-12">

            <div class="ibox-content">



                <div class="form-group row">

                    <label class="col-lg-2 col-form-label">Name<code>*</code></label>

                    <div class="col-lg-4">

                        <input readonly required name="name" id="name" type="text" value="" class="form-control">

                    </div>

                    <label class="col-lg-2 col-form-label">Email<code>*</code></label>

                    <div class="col-lg-4">



                        <input readonly name="email" id="email" type="text" value="" class="form-control">

                    </div>

                </div>

                <div class="form-group row">

                    <label class="col-lg-2 col-form-label">Aadhar No<code>*</code></label>

                    <div class="col-lg-4">

                        <input readonly name="aadhar_card" id="aadhar_card" type="text" value="" required

                            class="form-control">

                    </div>



                    <label class="col-lg-2 col-form-label">Mobile no<code>*</code></label>

                    <div class="col-lg-4">

                        <input readonly required name="mobile" id="mobile" type="text" value="" 

                            class="form-control">

                    </div>

                    <label class="col-lg-2 col-form-label mt-4">Owner Of Jewellery  </label>
                     
                     <div class="col-lg-4 mt-4">
                         <input  name="owner_of_jewellery" id="owner_of_jewellery" type="text" value="<?= $order_table_data['owner_of_jewellery'] ?>" 
                             class="form-control">
                     </div> 



                     <label class="col-lg-2 col-form-label mt-4">Purity Checked By  </label>

                     

                    <div class="col-lg-4 mt-4">

                        <input  name="purity_checked_by" id="purity_checked" type="text" value="<?= $order_table_data['purity_checked_by'] ?>" 

                            class="form-control">

                    </div> 

                    <label class="col-lg-2 col-form-label mt-4">Jewellery Purchased From</label>
                    <div class="col-lg-4 mt-4">
                         
                    <input  name="jewellery_purchased_from" id="jewellery_purchased_from" type="text" value="<?= $order_table_data['jewellery_purchased_from'] ?>" 
                            class="form-control">                         
                                             
                    </div>  

                    <label class="col-lg-2 col-form-label mt-4">Loan Aprovied By </label>
                    <div class="col-lg-4 mt-4">
                    <input  name="loan_aprovided_by" id="loan_aprovided_by" type="text" value="<?= $order_table_data['loan_aprovided_by'] ?>" 
                            class="form-control">
                    </div>








                    <label class="col-lg-2 col-form-label mt-4">Select Item </label>

                    <div class="col-lg-4">

                        <select <?php if(isset($_GET['order_id'])) echo "disabled"; ?> name="item_id" id='item_id'

                            class=" form-control select mt-4">



                            <?php foreach ($item_list as $key => $item) { ?>

                            <option

                                <?php if(isset($order_table_data['item_id']) AND $order_table_data['item_id']==$item['item_id']) echo 'selected=selected';  ?>

                                value="<?= $item['item_id']?>"> <?= $item['item_name']?> </option>

                            <?php  }  ?>



                        </select>

                    </div>







                </div>







                <div class="form-group row" id="gold">

                    <label class="col-lg-2 col-form-label">Gold Net Weight (Gram)</label>

                    <div class="col-lg-4">

                        <input  name="net_weight_gram_gold" id="net_weight_gram_gold" type="text"

                            value="<?= $order_table_data['net_weight_gram_gold'] ?>" class="form-control">

                    </div>

                    <label class="col-lg-2 col-form-label">Gold Gross Weight (Gram)</label>

                    <div class="col-lg-4">

                        <input  name="total_weight_gram_gold" id="total_weight_gram_gold" type="text"

                            value="<?= $order_table_data['total_weight_gram_gold'] ?>" class="form-control">

                    </div>

                </div>





                <div class="form-group row" id="silver">

                    <label class="col-lg-2 col-form-label">Silver Net Weight (Gram)  </label>

                    <div class="col-lg-4">

                        <input name="net_weight_gram_silver" id="net_weight_gram_silver" type="text"

                            value="<?= $order_table_data['net_weight_gram_silver'] ?>" class="form-control">

                    </div>

                    <label class="col-lg-2 col-form-label">Silver Gross Weight (Gram) </label>

                    <div class="col-lg-4">

                        <input name="total_weight_gram_silver" id="total_weight_gram_silver" type="text"

                            value="<?= $order_table_data['total_weight_gram_silver'] ?>" class="form-control">

                    </div>



                    <label class="col-lg-2 col-form-label">Gold (approx)</label>

                    <div class="col-lg-4">

                        <input  name="gold_approx_weight" id="gold_approx_weight" type="text"

                            value="<?= $order_table_data['gold_approx_weight'] ?>" class="form-control">

                    </div>



                    <label class="col-lg-2 col-form-label">Silver (Approx) </label>

                    <div class="col-lg-4">

                        <input  name="silver_approx_weight" id="silver_approx_weight" type="text"

                            value="<?= $order_table_data['silver_approx_weight'] ?>" class="form-control">

                    </div>

                </div>



                <div class="form-group row" id="gold">

                    <label class="col-lg-2 col-form-label">Loan Amount</label>

                    <div class="col-lg-4">

                        <input  name="loan_amount" id="loan_amount" type="text"

                            value="<?= $order_table_data['loan_amount'] ?>" class="form-control">

                    </div>

                    <label class="col-lg-2 col-form-label">Loan Interest (Per Month)</label>

                    <div class="col-lg-4">

                        <input  name="loan_interest" id="loan_interest" type="text"

                            value="<?= $order_table_data['loan_interest'] ?>" class="form-control">

                    </div>



                </div>



                <div class="form-group row" id="gold">

                    <label class="col-lg-2 col-form-label">Loan Period (in Month)</label>

                    <div class="col-lg-4">

                        <input  name="loan_period_month" id="loan_period_month" type="text"

                            value="<?= $order_table_data['loan_period_month'] ?>" class="form-control">

                    </div>



                    <label class="col-lg-2 col-form-label">Loan Taken Date</label>

                    <div class="col-lg-4">

                        <input  name="loan_date" id="loan_date" type="date"

                            value="<?= $order_table_data['loan_date'] ?>" class="form-control">

                    </div>

                </div>





                <div class="form-group row">

                    <label class="col-lg-2 col-form-label">Remark</label>

                    <div class="col-lg-10">

                        <textarea  class="form-control" name="remark"><?= $order_table_data['remark']?></textarea>

                    </div>



                </div>





                <div class="form-group row">

                    <label class="col-lg-2 col-form-label">All item Pic's<small style="color:red;"> (Optional)</small> </label>

                    <div class="col-lg-4">

                            <input  class="form-control" type="file" name="item_pic">  

                    </div> 



                    <?php if(!empty($order_table_data['item_pic'])){?> 

                        <div class="col-lg-4">

                            <img height="100" width="100" src="./img/item/item_full/<?= $order_table_data['item_pic'] ?>"><br>

                            <label class="col-lg-2 col-form-label"><a  href="./img/item/item_full/<?= $order_table_data['item_pic'] ?>" download > Downlaod</a>

                            </label>

                        </div> 



                    <?php } ?>



                    <label class="col-lg-2 col-form-label">Upload Packet Pic<small style="color:red;"> (Optional)</small> </label>

                    <div class="col-lg-4">

                            <input  class="form-control" type="file" name="packet_pic">  

                    </div> 

                    <?php if(!empty($order_table_data['packet_pic'])){?> 

                        <div class="col-lg-4">

                            <img height="100" width="100" src="./img/item/item_full/<?= $order_table_data['packet_pic'] ?>"><br>

                            <label class="col-lg-2 col-form-label"><a alt="dd" href="./img/item/item_full/<?= $order_table_data['packet_pic'] ?>" download > Downlaod</a>

                            </label>

                            

                        </div> 

                    <?php } ?>

                </div>



                <div class="form-group row">

                    <div class="col-lg-6">

                        <button class="btn btn-info" value="submit">Submit</button>

                    </div>

                </div>



            </div>



            <input type="hidden" name="order_id" value="<?= $order_table_data['order_id'] ?>">

            <input type="hidden" name="client_id" id="client_id_insert" value="<?= $order_table_data['client_id'] ?>">

</form>

<br>

<br>

<script>

var client_id = "<?= $order_table_data['client_id'] ?>"

formVisible(client_id)



function formVisible(client_id) {

    if (!client_id) {

        client_id = $("#client_id").val()



    }

    if (client_id) {

        $("#form").css("display", "")

        getUserData(client_id)

        $("#client_id_insert").val(client_id)

    } else {

        $("#form").css("display", "none")



        $("#client_id_insert").value("")



    }

}



function itemVisible() {

    var item_id = $("#item_id").val()

    if (item_id == '1') {

        $("#gold").css("display", "")

        $("#silver").css("display", "none")

    } else if (item_id == '1') {

        $("#gold").css("display", "none")

        $("#silver").css("display", "")

    } else {

        $("#gold").css("display", "")

        $("#silver").css("display", "")

    }

}





function getUserData(user_id) {

    $.ajax({

        url: "ajax/userDataCrud",

        type: "post",

        dataType: 'json',

        data: {

            'user_id': user_id

        },

        success: function(res) {



            $("#name").val(res.name)

            $("#email").val(res.email)

            $("#aadhar_card").val(res.aadhar_card)

            $("#mobile").val(res.mobile)



        }

    });



}

</script>

<?php include('footer.php'); ?>