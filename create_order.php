<?php
include('include/config.php');
$_GET = sanatize($_GET);
$_POST = sanatize($_POST);
extract($_GET);
 
$where = "1=1";
if (isset($_GET['order_id']) && !empty($_GET['order_id'])) {
    $where = "order_id='" . $_GET['order_id'] . "'";
}

$page_title = "Create Order";
if (!isset($_GET['order_id'])) {
    $order_table_data = column_names('order_tbl')['table'];
    $order_item_list_table_data = column_names('order_item_list')['table'];

    $showtable="none";
} else {
    $order_table_data = get_data('order_tbl', $where, 's');
    $order_item_list_table_data = get_data('order_item_list', "order_id='" . $_GET['order_id'] . "' AND store_id='" . $store_data['store_id'] . "'", 's');
    $item_data = get_data('order_item_list', "order_id='" . $_GET['order_id'] . "'");
    $showtable="block";
}

// $item_list = get_data("item_list");

$client_list = get_data("user_tbl", "user_type='client' AND store_id='" . $store_data['store_id'] . "' order by id DESC");
$item_list = get_data("item_list");

// $item_data = get_data('order_item_list', "order_id='" . $_GET['order_id'] . "'");
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

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-12">
        <select <?php echo  isset($_GET['order_id']) ? "disabled" : ""  ?> onChange="formVisible()" name="user_id" id='client_id' class="select2_demo_1 form-control select">
            <option value="">Select Client</option>
            <?php foreach ($client_list as $key => $user) { ?>
                <option <?php if (isset($order_table_data['client_id']) and $order_table_data['client_id'] == $user['id']) echo 'selected=selected ';  ?> value="<?= $user['id'] ?>"> <?= $user['name'] ?> (<?= $user['mobile'] ?>) <?= $user['address'] ?></option>
 
            <?php  }  ?>
        </select>

    </div>
</div>

<br>

<form action="model/create_order" method="POST" enctype="multipart/form-data" id="form" name="form" style="display:none">
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
                        <input readonly name="aadhar_card" id="aadhar_card" type="text" value="" required class="form-control">
                    </div>

                    <label class="col-lg-2 col-form-label">Mobile no<code>*</code></label>
                    <div class="col-lg-4">
                        <input readonly required name="mobile" id="mobile" type="text" value="" class="form-control">
                    </div>

                    <label class="col-lg-2 col-form-label mt-4">Owner Of Jewellery </label>

                    <div class="col-lg-4 mt-4">
                        <input name="owner_of_jewellery" id="owner_of_jewellery" type="text" value="<?= $order_table_data['owner_of_jewellery'] ?>" class="form-control">
                    </div>

                    <label class="col-lg-2 col-form-label mt-4">Purity Checked By </label>

                    <div class="col-lg-4 mt-4">
                        <input name="purity_checked_by" id="purity_checked" type="text" value="<?= $order_table_data['purity_checked_by'] ?>" class="form-control">
                    </div>



                    <label class="col-lg-2 col-form-label mt-4">Jewellery Purchased From</label>
                    <div class="col-lg-4 mt-4">

                        <input name="jewellery_purchased_from" id="jewellery_purchased_from" type="text" value="<?= $order_table_data['jewellery_purchased_from'] ?>" class="form-control">

                    </div>

                    <label class="col-lg-2 col-form-label mt-4">Loan Provided By </label>
                    <div class="col-lg-4 mt-4">
                        <input name="loan_aprovided_by" id="loan_aprovided_by" type="text" value="<?= $order_table_data['loan_aprovided_by'] ?>" class="form-control">
                    </div>


                    <label class="col-lg-2 col-form-label mt-4">Select Item </label>
                    <div class="col-lg-4">
                        <select <?php if (isset($_GET['order_id'])) echo "disabled"; ?> name="item_id" id='main_item_id' class=" form-control select mt-4">

                            <?php foreach ($item_list as $key => $item) { ?>
                                <option <?php if (isset($order_table_data['item_id']) and $order_table_data['item_id'] == $item['item_id']) echo 'selected=selected';  ?> value="<?= $item['item_id'] ?>"> <?= $item['item_name'] ?> </option>
                            <?php  }  ?>

                        </select>
                    </div>



                </div>




                <div class="form-group row" id="gold">
                    <label class="col-lg-2 col-form-label">Gold Net Weight (Gram)</label>
                    <div class="col-lg-4">
                        <input name="net_weight_gram_gold" id="net_weight_gram_gold" type="text" value="<?= $order_table_data['net_weight_gram_gold'] ?>" class="form-control">
                    </div>
                    <label class="col-lg-2 col-form-label">Gold Gross Weight (Gram)</label>
                    <div class="col-lg-4">
                        <input name="total_weight_gram_gold" id="total_weight_gram_gold" type="text" value="<?= $order_table_data['total_weight_gram_gold'] ?>" class="form-control">
                    </div>
                </div>


                <div class="form-group row" id="silver">
                    <label class="col-lg-2 col-form-label">Silver Net Weight (Gram) </label>
                    <div class="col-lg-4">
                        <input name="net_weight_gram_silver" id="net_weight_gram_silver" type="text" value="<?= $order_table_data['net_weight_gram_silver'] ?>" class="form-control">
                    </div>
                    <label class="col-lg-2 col-form-label">Silver Gross Weight (Gram) </label>
                    <div class="col-lg-4">
                        <input name="total_weight_gram_silver" id="total_weight_gram_silver" type="text" value="<?= $order_table_data['total_weight_gram_silver'] ?>" class="form-control">
                    </div>

                    <label class="col-lg-2 col-form-label">Gold (approx)</label>
                    <div class="col-lg-4">
                        <input name="gold_approx_weight" id="gold_approx_weight" type="text" value="<?= $order_table_data['gold_approx_weight'] ?>" class="form-control">
                    </div>

                    <label class="col-lg-2 col-form-label">Silver (Approx) </label>
                    <div class="col-lg-4">
                        <input name="silver_approx_weight" id="silver_approx_weight" type="text" value="<?= $order_table_data['silver_approx_weight'] ?>" class="form-control">
                    </div>
                </div>

                
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Gold Details</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" name="gold_details"><?= $order_table_data['gold_details'] ?></textarea>
                    </div>

                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Silver Details</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" name="silver_details"><?= $order_table_data['silver_details'] ?></textarea>
                    </div>

                </div>

                <div class="form-group row" id="gold">
                    <label class="col-lg-2 col-form-label">Gold Purity </label>
                    <div class="col-lg-4">
                        <input name="gold_purity" id="gold_purity" type="text" value="<?= $order_table_data['gold_purity'] ?>" class="form-control">
                    </div>

                    <label class="col-lg-2 col-form-label">Silver Purity</label>
                    <div class="col-lg-4">
                        <input name="silver_purity" id="silver_purity" type="text" value="<?= $order_table_data['silver_purity'] ?>" class="form-control">
                    </div>
                </div>


                <div class="form-group row" id="gold">
                    <label class="col-lg-2 col-form-label">Loan Amount</label>
                    <div class="col-lg-4">
                        <input name="loan_amount" id="loan_amount" type="text" value="<?= $order_table_data['loan_amount'] ?>" class="form-control">
                    </div>
                    <label class="col-lg-2 col-form-label">Loan Interest (Per Month)</label>
                    <div class="col-lg-4">
                        <input name="loan_interest" id="loan_interest" type="text" value="<?= $order_table_data['loan_interest'] ?>" class="form-control">
                    </div>

                </div>

                <div class="form-group row" id="gold">
                    <label class="col-lg-2 col-form-label">Loan Period (in Month)</label>
                    <div class="col-lg-4">
                        <input name="loan_period_month" id="loan_period_month" type="text" value="<?= $order_table_data['loan_period_month'] ?>" class="form-control">
                    </div>

                    <label class="col-lg-2 col-form-label">Loan Taken Date</label>
                    <div class="col-lg-4">
                        <input name="loan_date" id="loan_date" type="date" value="<?= $order_table_data['loan_date'] ?>" class="form-control">
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Remark</label>
                    <div class="col-lg-10">
                        <textarea class="form-control" name="remark"><?= $order_table_data['remark'] ?></textarea>
                    </div>

                </div>


                <div class="form-group row" >
                    <label class="col-lg-2 col-form-label">warning</label>
                    <div class="col-lg-4">
                        <input name="warning_text" id="warning" type="text" value="<?= $order_table_data['warning_text'] ?>" class="form-control">
                    </div>

                    <label class="col-lg-2 col-form-label">Warning Date</label>
                    <div class="col-lg-4">
                        <input name="warning_date" id="warning_date" type="date" value="<?= $order_table_data['warning_date'] ?>" class="form-control">
                    </div>
                </div>


                

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">All item Pic's<small style="color:red;"> (Optional)</small> </label>
                    <div class="col-lg-4">
                        <input class="form-control" type="file" name="item_pic">
                    </div>

                    <?php if (!empty($order_table_data['item_pic'])) { ?>
                        <div class="col-lg-4">
                            <img height="100" width="100" src="./img/item/item_full/<?= $order_table_data['item_pic'] ?>"><br>
                            <label class="col-lg-2 col-form-label"><a href="./img/item/item_full/<?= $order_table_data['item_pic'] ?>" download> Downlaod</a>
                            </label>
                        </div>

                    <?php } ?>

                    <label class="col-lg-2 col-form-label">Upload Packet Pic<small style="color:red;"> (Optional)</small> </label>
                    <div class="col-lg-4">
                        <input class="form-control" type="file" name="packet_pic">
                    </div>
                    <?php if (!empty($order_table_data['packet_pic'])) { ?>
                        <div class="col-lg-4">
                            <img height="100" width="100" src="./img/item/item_full/<?= $order_table_data['packet_pic'] ?>"><br>
                            <label class="col-lg-2 col-form-label"><a alt="dd" href="./img/item/item_full/<?= $order_table_data['packet_pic'] ?>" download> Downlaod</a>
                            </label>

                        </div>
                    <?php } ?>
                </div> 
                <!-- <div class="form-group row">
                    <div class="col-lg-6"> 
                            <a style="color:white;" href="#" onClick="addList(); event.preventDefault();" class="btn btn-sm btn-info"> Add Item
                            </a>  
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox "> 
                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover itemtable" style="display:<?=$showtable?>;">
                                        <thead>
                                            <tr> 
                                                <th>Grade</th>
                                                <th>Item Name</th>
                                                <th>Item Details</th>
                                                <th>Remarks</th>
                                                <th>Gross Wt. <code>(Gm)</code></th>
                                                <th>Less <code>(Gm)</code></th>
                                                <th>Net Wt. <code>(Gm)</code></th>
                                                <th>Tunch <code>(%)</code></th>
                                                <th>Fine <code>(Gm)</code></th>
                                                <th>Rate <code>(Per Gm)</code></th>
                                                <th>Value</th> 
                                                <th>Delete Row</th>
                                            </tr>
                                        </thead> 
                                        <tbody id="append_list">

                                            <?php
                                            if (isset($item_data[0])) {
                                                $i = 1;
                                                foreach ($item_data as $item) {
                                            ?>
                                                    <tr id="row_<?= $i ?>" class="form-group">
                                                        <td>
                                                            <select style="width:120px !important" id="item_id_<?= $i ?>" name="item_id[]" colspan=4 class="select2_demo_1 col-md-12 form-control select">
                                                            <option > Select Grade </option>
                                                                <?php foreach ($item_list as $key => $item_list_data) { ?>
                                                                    <option <?php if ($item_list_data['item_id'] == $item['item_id']) echo "selected" ?> value="<?= $item_list_data['item_id'] ?>">
                                                                        <?= $item_list_data['item_name'] ?> </option>
                                                                <?php  }  ?>
                                                            </select>
                                                        </td>
                                                        <td><input style="width:120px !important" class="form-control" placeholder="Item Name" id="item_name_<?= $i ?>" value="<?= $item['item_name_by_user'] ?>" name="item_name[]" type="text"></td>
                                                        <td><input style="width:120px !important" class="form-control" placeholder="Item Detail" id="item_details_<?= $i ?>" value="<?= $item['item_details'] ?>" name="item_details[]" type="text"></td>
                                                        <td><input style="width:120px !important" class="form-control" placeholder="Item Remark" id="remark_<?= $i ?>" value="<?= $item['remark'] ?>" name="remark[]" type="text"></td>
                                                        <td><input onkeyup="itemChange(<?= $i ?>)" style="width:120px !important" class="form-control" placeholder="Item Gross Wt" id="gross_wt_<?= $i ?>" value="<?= $item['gross_wt'] ?>" name="gross_wt[]" type="text"></td>
                                                        <td><input onkeyup="itemChange(<?= $i ?>)" style="width:120px !important" class="form-control" placeholder="Item Less" id="less_<?= $i ?>" value="<?= $item['less_wt'] ?>" name="less[]" type="text"></td>
                                                        <td><input onkeyup="itemChange(<?= $i ?>)" style="width:120px !important" class="form-control" readonly placeholder="Item Net Wt" id="net_wt_<?= $i ?>" value="<?= $item['net_wt'] ?>" name="net_wt[]" type="text"></td>
                                                        <td><input onkeyup="itemChange(<?= $i ?>)" style="width:120px !important" class="form-control" placeholder="Item Tunch" id="tunch_<?= $i ?>" value="<?= $item['tunch'] ?>" name="tunch[]" type="text"></td>
                                                        <td><input onkeyup="itemChange(<?= $i ?>)" style="width:120px !important" class="form-control" readonly placeholder="Item Fine" id="fine_<?= $i ?>" value="<?= $item['fine'] ?>" name="fine[]" type="text"></td>
                                                        <td><input onkeyup="itemChange(<?= $i ?>)" style="width:120px !important" class="form-control" placeholder="Item Rate" id="rate_<?= $i ?>" value="<?= $item['rate'] ?>" name="rate[]" type="text"></td>
                                                        <td><input onkeyup="itemChange(<?= $i ?>)" style="width:120px !important" class="form-control" readonly placeholder="Item Value" id="value_<?= $i ?>" value="<?= $item['total_value'] ?>" name="value[]" type="text"></td>

                                                        <td><input type="button" onclick="delete_row(<?= $i ?>)" value="Delete" class="btn btn-sm btn-danger" value="Delete" disabled>
                                                            <input type="hidden" name="order_item_list_id[]" id="" value="<?= $item['order_item_list_id'] ?>">
                                                        </td>

                                                    </tr>

                                                <?php
                                                }
                                            }  
                                            ?>




                                        </tbody>


                                        <input type="hidden" value="1" id="td_id" />


                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div> -->



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

    function itemChange(td_id) {
        // alert(td_id);
        var gross_wt = parseFloat($("#gross_wt_" + td_id).val())
        var less = parseFloat($("#less_" + td_id).val())
        var net_wt = parseFloat($("#net_wt_" + td_id).val())
        $("#net_wt_" + td_id).val(gross_wt - less)
        console.log("net_wt", net_wt)
        var tunch = parseFloat($("#tunch_" + td_id).val())
        if (tunch > 100) {
            alert("Tunch % can ot be grater than 100 AND not less than 1")
            return false;
        }
        if (tunch != 0 && tunch > 1) {
            const latestTunch = (((gross_wt - less) * tunch) / 100)
            $("#fine_" + td_id).val(latestTunch)

        }
        var fine = parseFloat($("#fine_" + td_id).val())
        $("#fine_" + td_id).val(fine)

        var rate = parseFloat($("#rate_" + td_id).val())


        $("#value_" + td_id).val(fine * rate)




    }

    // function delete_row(td_id) {

    //     alert(td_id);
    //     if (td_id != 1) {
    //         $('#row_' + td_id).remove();

    //     } else {

    //         return false;
    //     } 
    // }


    // function addList() {
    //     var new_id = $('#append_list tr:last').attr('id');
    //     var td_id = new_id.replace("row_", "");

    //     console.log(new_id);

    //     // Convert td_id to a number and increment by 1
    //     td_id = parseInt(td_id) + 1;

    //     var html = `<tr id="row_` + td_id + `" class="form-group">

    //                <td >

    //                          <select style="width:120px !important" id="item_id_` + td_id + `" name="item_id[]" colspan="4" class="select2_demo_1 col-md-12 form-control select">

    //     <option value="1"> Gold </option>
    //     <option value="2"> Silver </option>
    //     <option value="3"> Gold + Silver </option>
    // </select>
    //        </td>
    //                             <td><input style="width:120px !important" class="form-control" placeholder="Item Name" id="item_name_` + td_id + `" value="" name="item_name[]" type="text"></td>
    //                             <td><input style="width:120px !important" class="form-control" placeholder="Item Detail" id="item_details_` + td_id + `" value="" name="item_details[]" type="text"></td>
    //                             <td><input style="width:120px !important" class="form-control" placeholder="Item Remark" id="remark_` + td_id + `" value="" name="remark[]" type="text"></td>
    //                             <td><input onkeyup="itemChange(` + td_id + `)" style="width:120px !important" class="form-control" placeholder="Item Gross Wt" id="gross_wt_` + td_id + `" value="0" name="gross_wt[]" type="text"></td>
    //                             <td><input onkeyup="itemChange(` + td_id + `)" style="width:120px !important" class="form-control" placeholder="Item Less" id="less_` + td_id + `" value="0" name="less[]" type="text"></td>
    //                             <td><input onkeyup="itemChange(` + td_id + `)" style="width:120px !important" class="form-control" disabled="" placeholder="Item Net Wt" id="net_wt_` + td_id + `" value="0" name="net_wt[]" type="text"></td>
    //                             <td><input onkeyup="itemChange(` + td_id + `)" style="width:120px !important" class="form-control" placeholder="Item Tunch" id="tunch_` + td_id + `" value="0" name="tunch[]" type="text"></td>
    //                             <td><input onkeyup="itemChange(` + td_id + `)" style="width:120px !important" class="form-control" disabled="" placeholder="Item Fine" id="fine_` + td_id + `" value="0" name="fine[]" type="text"></td>
    //                             <td><input onkeyup="itemChange(` + td_id + `)" style="width:120px !important" class="form-control" placeholder="Item Rate" id="rate_` + td_id + `" value="0" name="rate[]" type="text"></td>
    //                             <td><input onkeyup="itemChange(` + td_id + `)" style="width:120px !important" class="form-control" disabled="" placeholder="Item Value" id="value_` + td_id + `" value="0" name="value[]" type="text"></td>
    //                             <!-- <td><input onclick="submit(` + td_id + `)" class="btn btn-sm btn-success  value=" submit"="" name="submit[]" type="submit"></td>-->
    //                             <td><button onclick="delete_row(` + td_id + `)" value="Delete" class="btn btn-sm btn-danger">Delete</button></td> 

    //                         </tr>`;


    //     $("#append_list").append(html)
    // }

    function delete_row(td_id) {
        var rowCount = $("#append_list tr").length;

        Swal.fire({
            title: "Do you want to Delete this?",
            showCancelButton: true,
            confirmButtonText: "Delete",
            icon: 'warning'
        }).then((result) => {
            if (result.isConfirmed) {
                if (rowCount === 1) {
                    $(".itemtable").hide();
                    $('#row_' + td_id).remove();
                } else {
                    $('#row_' + td_id).remove();
                } 
            }

        });  
    } 

    function addList() {

        var new_id = $('#append_list tr:last').attr('id');

        if (typeof new_id === "undefined") {
            var html = `<tr id="row_1" class="form-group"> 
                   <td >   
                   <select style="width:120px !important" id="item_id_1" name="item_id[]" colspan="4" class="select2_demo_1 col-md-12 form-control select">
                   <option value="0" selected >Select Grade </option>
                   <option value="1"> Gold </option>
        <option value="2"> Silver </option>
        <option value="3"> Gold + Silver </option>
    </select>
           </td> 
           <td><input style="width:120px !important" class="form-control" placeholder="Item Name" id="item_name_1" value="" name="item_name[]" type="text"></td>
                                <td><input style="width:120px !important" class="form-control" placeholder="Item Detail" id="item_details_1" value="" name="item_details[]" type="text"></td>
                                <td><input style="width:120px !important" class="form-control" placeholder="Item Remark" id="remark_1" value="" name="remark[]" type="text"></td>
                                <td><input onkeyup="itemChange(1)" style="width:120px !important" class="form-control" placeholder="Item Gross Wt" id="gross_wt_1" value="0" name="gross_wt[]" type="text"></td>
                                <td><input onkeyup="itemChange(1)" style="width:120px !important" class="form-control" placeholder="Item Less" id="less_1" value="0" name="less[]" type="text"></td>
                                <td><input onkeyup="itemChange(1)" style="width:120px !important" class="form-control" readonly placeholder="Item Net Wt" id="net_wt_1" value="0" name="net_wt[]" type="text"></td>
                                <td><input onkeyup="itemChange(1)" style="width:120px !important" class="form-control" placeholder="Item Tunch" id="tunch_1" value="0" name="tunch[]" type="text"></td>
                                <td><input onkeyup="itemChange(1)" style="width:120px !important" class="form-control" readonly placeholder="Item Fine" id="fine_1" value="0" name="fine[]" type="text"></td>
                                <td><input onkeyup="itemChange(1)" style="width:120px !important" class="form-control" placeholder="Item Rate" id="rate_1" value="0" name="rate[]" type="text"></td>
                                <td><input onkeyup="itemChange(1)" style="width:120px !important" class="form-control" readonly placeholder="Item Value" id="value_1" value="0" name="value[]" type="text"></td>
                                <!-- <td><input onclick="submit(1)" class="btn btn-sm btn-success  value=" submit"="" name="submit[]" type="submit"></td>-->
                                <td><button onclick="delete_row(1);event.preventDefault(); " value="Delete" class="btn btn-sm btn-danger">Delete</button>
                                <input type="hidden" name="order_item_list_id[]"  value="0"></td> 
                          </tr>`;

            $("#append_list").append(html)
            $(".itemtable").show();
            return false;
        } else {
            var td_id = parseInt(new_id.replace("row_", ""));

            var html = `<tr id="row_${td_id+1}" class="form-group">
                   
                   <td >
                             
                             <select style="width:120px !important" id="item_id_${td_id+1}" name="item_id[]" colspan="4" class="select2_demo_1 col-md-12 form-control select">
 
        <option value="0" selected > Select Grade </option>
        <option value="1"> Gold </option>
        <option value="2"> Silver </option>
        <option value="3"> Gold + Silver </option>
    </select>
           </td>
                                <td><input style="width:120px !important" class="form-control" placeholder="Item Name" id="item_name_${td_id+1}" value="" name="item_name[]" type="text"></td>
                                <td><input style="width:120px !important" class="form-control" placeholder="Item Detail" id="item_details_${td_id+1}" value="" name="item_details[]" type="text"></td>
                                <td><input style="width:120px !important" class="form-control" placeholder="Item Remark" id="remark_${td_id+1}" value="" name="remark[]" type="text"></td>
                                <td><input onkeyup="itemChange(${td_id+1})" style="width:120px !important" class="form-control" placeholder="Item Gross Wt" id="gross_wt_${td_id+1}" value="0" name="gross_wt[]" type="text"></td>
                                <td><input onkeyup="itemChange(${td_id+1})" style="width:120px !important" class="form-control" placeholder="Item Less" id="less_${td_id+1}" value="0" name="less[]" type="text"></td>
                                <td><input onkeyup="itemChange(${td_id+1})" style="width:120px !important" class="form-control" readonly placeholder="Item Net Wt" id="net_wt_${td_id+1}" value="0" name="net_wt[]" type="text"></td>
                                <td><input onkeyup="itemChange(${td_id+1})" style="width:120px !important" class="form-control" placeholder="Item Tunch" id="tunch_${td_id+1}" value="0" name="tunch[]" type="text"></td>
                                <td><input onkeyup="itemChange(${td_id+1})" style="width:120px !important" class="form-control" readonly placeholder="Item Fine" id="fine_${td_id+1}" value="0" name="fine[]" type="text"></td>
                                <td><input onkeyup="itemChange(${td_id+1})" style="width:120px !important" class="form-control" placeholder="Item Rate" id="rate_${td_id+1}" value="0" name="rate[]" type="text"></td>
                                <td><input onkeyup="itemChange(${td_id+1})" style="width:120px !important" class="form-control" readonly placeholder="Item Value" id="value_${td_id+1}" value="0" name="value[]" type="text"></td>
                                <!-- <td><input onclick="submit(${td_id+1})" class="btn btn-sm btn-success  value=" submit"="" name="submit[]" type="submit"></td>-->
                                <td><button onclick="delete_row(${td_id+1}); event.preventDefault();" value="Delete" class="btn btn-sm btn-danger">Delete</button>
                                <input type="hidden" name="order_item_list_id[]"  value="0"></td> 
                               
                            </tr>`;


            $("#append_list").append(html);

            return false;
        }
    }
</script>
<?php include('footer.php'); ?>