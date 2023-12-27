<?php
include('include/config.php');
$_GET=sanatize($_GET);
$_POST=sanatize($_POST);
$total_pages=1;
if(isset($_GET['page_no']))
{
    $page_no=$_GET['page_no'];
    if($page_no<=0)
    {
    $page_no=1;
    }
}
else
{
    $page_no=1;
}

include('header.php');

$page_title=$_GET['page_name']." List";
$order_data=get_data('order_tbl',"order_id='".$_GET['order_id']."'" ,"s");
$item_list=get_data("item_list");

$item_data=get_data('order_item_list',"order_id='".$_GET['order_id']."'");



$investor_data=get_data('assign_investor_list',"order_id='".$_GET['order_id']."' AND client_id='".$order_data['client_id']."'");


 
// $invester_data=get_data('assign_investor_list',"order_id='".$_GET['order_id']."' AND client_id='".$order_data['client_id']."'");



 
?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-10">
        <h2>Manage Order Item</h2>
        <ol class="breadcrumb">

            <li class="breadcrumb-item">
                <a href="dashboard.php?page_name=dashboard">Assign Item</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Order Id : <?= $order_data['order_id'] ?></strong>
            </li>
            <li class="breadcrumb-item active">
                <strong>Client Name: <?= $order_data['client_name'] ?></strong>
            </li>
            <li class="breadcrumb-item active">
                <strong>Investor Name:
                    <?= $order_data['investor_name']?$order_data['investor_name']:"Not Assign" ?></strong>
            </li>


        </ol>
    </div>
    <div class="col-md-2 mt-2">
        <h2></h2>
        <ol class="breadcrumb">
            <li style="float:right;" class="breadcrumb-item active">
                <a style="color:white;" href="#" onClick="addList()" class="btn btn-sm btn-info"> Add Item
                </a>
            </li>

        </ol>
    </div>
</div>
<br>
<br>





<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">


            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>Investor</th>
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
                                <th>Submit</th>
                                <th>Delete Row</th>
                            </tr>
                        </thead>

                        <tbody id="append_list">


                            <?php $no=1; foreach ($item_data as $key => $item) {?>
                            <tr id=" row_<?= $item['item_id'] ?>" class="form-group" style="background-color:pink">
                                <td width="400%">
                                    <select style="width:120px !important" id="item_id_${td_id}" name="item_id[]"
                                        colspan=4 class="select2_demo_1 col-md-12 form-control select">
                                        <?php foreach ($investor_data as $key => $investor_list_data) { ?>
                                        <option
                                            <?php  if($investor_list_data['investor_id']==$item['investor_id']) echo "selected" ?>
                                            value="<?= $investor_list_data['investor_id']?>">
                                            <?= $investor_list_data['investor_name']?> </option>
                                        <?php  }  ?>
                                    </select>
                                </td>
                                <td width="400%">
                                    <select style="width:120px !important" id="item_id_${td_id}" name="item_id[]"
                                        colspan=4 class="select2_demo_1 col-md-12 form-control select">
                                        <?php foreach ($item_list as $key => $item_list_data) { ?>
                                        <option
                                            <?php  if($item_list_data['item_id']==$item['item_id']) echo "selected" ?>
                                            value="<?= $item_list_data['item_id']?>">
                                            <?= $item_list_data['item_name']?> </option>
                                        <?php  }  ?>
                                    </select>
                                </td>
                                <td><input style="width:120px !important" class="form-control" placeholder="Item Name"
                                        id="item_name_${td_id}" value="<?= $item['item_name_by_user'] ?>" type="text" />
                                </td>
                                <td><input style="width:120px !important" class="form-control" placeholder="Item Detail"
                                        id="item_details_${td_id}" value="<?= $item['item_details'] ?>" type="text" />
                                </td>
                                <td><input style="width:120px !important" class="form-control" placeholder="Item Remark"
                                        id="remark_${td_id}" value="<?= $item['remark'] ?>" name="remark[]"
                                        type="text" />
                                </td>
                                <td><input onkeyup="itemChange('<?= $item['item_id'] ?>')"
                                        style="width:120px !important" class="form-control" placeholder="Item Gross Wt"
                                        id="gross_wt_'<?= $item['item_id'] ?>'" value="<?= $item['gross_wt'] ?>"
                                        name="gross_wt[]" type="text" /></td>
                                <td><input onkeyup="itemChange('<?= $item['item_id'] ?>')"
                                        style="width:120px !important" class="form-control" placeholder="Item Less"
                                        id="less_'<?= $item['item_id'] ?>'" value="<?= $item['less_wt'] ?>"
                                        name="less[]" type="text" />
                                </td>
                                <td><input onkeyup="itemChange('<?= $item['item_id'] ?>')"
                                        style="width:120px !important" class="form-control" disabled
                                        placeholder="Item Net Wt" id="net_wt_'<?= $item['item_id'] ?>'"
                                        value="<?= $item['net_wt'] ?>" name="net_wt[]" type="text" /></td>
                                <td><input onkeyup="itemChange('<?= $item['item_id'] ?>')"
                                        style="width:120px !important" class="form-control" placeholder="Item Tunch"
                                        id="tunch_'<?= $item['item_id'] ?>'" value="<?= $item['tunch'] ?>"
                                        name="tunch[]" type="text" />
                                </td>
                                <td><input onkeyup="itemChange('<?= $item['item_id'] ?>')"
                                        style="width:120px !important" class="form-control" disabled
                                        placeholder="Item Fine" id="fine_'<?= $item['item_id'] ?>'"
                                        value="<?= $item['fine'] ?>" name="fine[]" type="text" /></td>
                                <td><input onkeyup="itemChange('<?= $item['item_id'] ?>')"
                                        style="width:120px !important" class="form-control" placeholder="Item Rate"
                                        id="rate_'<?= $item['item_id'] ?>'" value="<?= $item['rate'] ?>" name="rate[]"
                                        type="text" />
                                </td>
                                <td><input onkeyup="itemChange('<?= $item['item_id'] ?>')"
                                        style="width:120px !important" class="form-control" disabled
                                        placeholder="Item Value" id="value_'<?= $item['item_id'] ?>'"
                                        value="<?= $item['total_value'] ?>" name="value[]" type="text" /></td>
                                <td><input disabled onclick="submit('<?= $item['item_id'] ?>')"
                                        class="btn btn-sm btn-success" value="submit" name="submit[]" type="submit" />
                                </td>
                                <td><button disabled onclick="delete_row('<?= $item['item_id'] ?>')" value="Delete"
                                        class="btn btn-sm btn-danger">Delete</button></td>

                            </tr>
                            <?php } ?>

                        </tbody>


                        <input type="hidden" value="100000000" id="td_id" />


                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<script>
var order_id = "<?= $_GET['order_id'] ?>"

function addList() {

    var td_id = parseInt($("#td_id").val())
    $("#td_id").val(td_id + 1)

    var html = `           <tr id="row_${td_id}" class="form-group" >
                                <td width="400%">
                             
                                     <select style="width:120px !important"  id="item_id_${td_id}" name="item_id[]" colspan=4 class="select2_demo_1 col-md-12 form-control select">
         
            <?php foreach ($investor_data as $key => $invester) { ?>
            <option
              
                value="<?= $invester['investor_id']?>"> <?= $invester['investor_name']?> </option>
            <?php  }  ?>
        </select>
                   </td>
                   <td width="400%">
                             
                             <select style="width:120px !important"  id="item_id_${td_id}" name="item_id[]" colspan=4 class="select2_demo_1 col-md-12 form-control select">
 
    <?php foreach ($item_list as $key => $item) { ?>
    <option
      
        value="<?= $item['item_id']?>"> <?= $item['item_name']?> </option>
    <?php  }  ?>
</select>
           </td>
                                <td><input style="width:120px !important"  class="form-control" placeholder="Item Name"  id="item_name_${td_id}"  value="" name="item_name[]" type="text" /></td>
                                <td><input style="width:120px !important"  class="form-control"  placeholder="Item Detail"   id="item_details_${td_id}"  value="" name="item_details[]" type="text" /></td>
                                <td><input style="width:120px !important"  class="form-control"     placeholder="Item Remark"  id="remark_${td_id}"  value="" name="remark[]" type="text" /></td>
                                <td><input onkeyup="itemChange(${td_id})" style="width:120px !important"  class="form-control"    placeholder="Item Gross Wt"  id="gross_wt_${td_id}"  value="0" name="gross_wt[]" type="text" /></td>
                                <td><input onkeyup="itemChange(${td_id})" style="width:120px !important"  class="form-control"    placeholder="Item Less"  id="less_${td_id}"  value="0" name="less[]" type="text" /></td>
                                <td><input onkeyup="itemChange(${td_id})" style="width:120px !important"  class="form-control"  disabled  placeholder="Item Net Wt"  id="net_wt_${td_id}"  value="0" name="net_wt[]" type="text" /></td>
                                <td><input onkeyup="itemChange(${td_id})" style="width:120px !important"  class="form-control"    placeholder="Item Tunch"  id="tunch_${td_id}"  value="0" name="tunch[]" type="text" /></td>
                                <td><input onkeyup="itemChange(${td_id})" style="width:120px !important"  class="form-control"  disabled  placeholder="Item Fine"  id="fine_${td_id}"  value="0" name="fine[]" type="text" /></td>
                                <td><input onkeyup="itemChange(${td_id})" style="width:120px !important"  class="form-control"    placeholder="Item Rate"  id="rate_${td_id}"  value="0" name="rate[]" type="text" /></td>
                                <td><input onkeyup="itemChange(${td_id})" style="width:120px !important"  class="form-control"  disabled  placeholder="Item Value"  id="value_${td_id}"  value="0" name="value[]" type="text" /></td>
                                <td><input  onclick="submit(${td_id})" class="btn btn-sm btn-success  value="submit" name="submit[]" type="submit" /></td>
                                <td><button  onclick="delete_row(${td_id})" value="Delete" class="btn btn-sm btn-danger" >Delete</button></td>
                               
                            </tr>`

    $("#append_list").append(html)

}


function itemChange(td_id) {
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
    var rate = parseFloat($("#rate_" + td_id).val())


    $("#value_" + td_id).val(fine * rate)




}

function delete_row(td_id) {
    $('#row_' + td_id).remove();

}

function submit(td_id) {
    var item_id = $("#item_id_" + td_id).val()
    var item_name = $("#item_name_" + td_id).val()
    var item_details = $("#item_details_" + td_id).val()
    var remark = $("#remark_" + td_id).val()
    var net_wt = parseFloat($("#net_wt_" + td_id).val())
    var gross_wt = parseFloat($("#gross_wt_" + td_id).val())
    var less = parseFloat($("#less_" + td_id).val())
    var tunch = parseFloat($("#tunch_" + td_id).val())
    var fine = parseFloat($("#fine_" + td_id).val())
    var rate = parseFloat($("#rate_" + td_id).val())
    var value = parseFloat($("#value_" + td_id).val())
    submit_obj = {
        item_id: item_id,
        item_name_by_user: item_name,
        item_details: item_details,
        remark: remark,
        gross_wt: gross_wt,
        less: less,
        tunch: tunch,
        fine: fine,
        rate: rate,
        value: value,
        order_id: order_id,
    }

    $.ajax({
        url: "ajax/insertItemData",
        type: "post",
        dataType: 'json',
        data: submit_obj,
        success: function(res) {
            notify(res.status, res.msg)
            if (res.status == "success") {
                window.location.reload()
            }
        }
    });

    console.log(submit_obj)

}
</script>

<?php include('footer.php'); ?>