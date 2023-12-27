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
$order_id=$order_data['order_id'];
$assign_investor_list=get_data('assign_investor_list',"order_id='".$_GET['order_id']."'");



$order_item_list=get_data('order_item_list',"order_id='".$_GET['order_id']."' AND investor_id=0");
//   _dx($order_data['gold_details']);
//   _dx($order_data);

$investor_list = get_data("user_tbl","user_type='investor'");
// _dx($order_data);
 

$transactionData =  $transactioData=get_data("transaction_log","order_id='".$order_id."' AND overall_type IN ('investorAmount','investorInterest')");


 
// _dx($assign_investor_list);
foreach ($assign_investor_list as $key => $list) {
    // $order_data1=get_data('order_item_list',"order_id='".$_GET['order_id']."' AND investor_id='".$list['investor_id']."'" ,"s"); 
 
   $update=updateInvestorData($list['investor_id'],$order_id,$list, $order_data, $transactioData ,$update=true);
   $assign_investor_list[$key]['totalPrincipalPaid']=$update['totalPrincipalPaid'];
   $assign_investor_list[$key]['totalPrincipalReceived']=$update['totalPrincipalReceived'];
   $assign_investor_list[$key]['totalInterestPaid']=$update['totalInterestPaid'];
   $assign_investor_list[$key]['totalInterestTillDate']=$update['totalInterestTillDate'];
   if(isset($order_data['gold_details']))
   { 
       $assign_investor_list[$key]['packet_details']=$order_data['gold_details'];
   }
   else
   {
    $assign_investor_list[$key]['packet_details']=$order_data['silver_details'];
   }

}

?>





<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-6">
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
                <strong>Loan Amount: <?= $order_data['loan_amount'] ?></strong>
            </li>
            <li class="breadcrumb-item active">
                <strong>Loan Interest: <?= $order_data['loan_interest'] ?></strong>
            </li>
            <li class="breadcrumb-item active">
                <strong>Loan Date: <?= $order_data['loan_date'] ?></strong>
            </li>
            <!-- <li class="breadcrumb-item active">
                <strong>Investor Name:
                    <?= $order_data['investor_name']?$order_data['investor_name']:"Not Assign" ?></strong>
            </li> -->


        </ol>
    </div>
     <div class="col-md-4">
        <div class="title-action">

            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#debitCreditModal">
              Credit/Debit Investor
            </button>

            
        </div>
    </div>
    <div class="col-md-2 mt-2">
        <h2></h2>
        <ol class="breadcrumb">
            <li style="float:right;" class="breadcrumb-item active">
                <a style="color:white;" href="#" onClick="addList()" class="btn btn-sm btn-info"> Add Investor
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
                                <th>Investor Name</th>
                                <th>Item Name</th>
                                <th>Amount</th>
                                <th>Interest Rate</th>
                                <th>Interest Start Date</th>
                                
                                <th>Packet Name</th>
                                <th>Status</th>
                                <th>Remark</th>
                                <th>Total Principal Paid</th>
                                <th>Total Interest Till Date</th>
                                <th>Total Interest Paid</th>
                                <th>Submit</th>
                                <th>Delete Row</th>
                            </tr>
                        </thead>

                        <tbody id="append_list">


                            <?php $no=1; foreach ($assign_investor_list as $key => $investor_data) {?>
                            <tr id=" row_<?= $investor_data['assign_investor_id'] ?>" class="form-group" style="background-color:pink">
                                <td width="400%">
                                   <input style="width:120px !important" class="form-control" placeholder="Name"
 value="<?= $investor_data['investor_name'] ?>" type="text" />
                                </td>
                                <td width="400%">
                                   <input style="width:120px !important" class="form-control" placeholder="Name"
 value="<?= $investor_data['packet_details'] ?>" type="text" />
                                </td>
                                <td><input style="width:120px !important" class="form-control" placeholder="Amount"
                                        id="amount_${td_id}" value="<?= $investor_data['amount'] ?>" type="text" />
                                </td>
                                <td><input style="width:120px !important" class="form-control" placeholder="Intererast Rate"
                                        id="interest_rate_${td_id}" value="<?= $investor_data['interest_rate'] ?>" type="number" />
                                </td>
                                <td><input style="width:120px !important" class="form-control" placeholder="Start Date"
                                        id="interest_rate_${td_id}" value="<?= $investor_data['start_date'] ?>" type="text" />
                                </td>
                                
                                <td><input style="width:120px !important" class="form-control" placeholder="Start Date"
                                        id="interest_rate_${td_id}" value="<?= $investor_data['packet_name'] ?>" type="text" /></td>
                                        <td><input style="width:120px !important" class="form-control" placeholder="Start Date"
                                        id="interest_rate_${td_id}" value="<?= $investor_data['status'] ?>" type="text" /></td>
                                <td><b><?= $investor_data['remark'] ?></b>
                                </td>

                                <td><input style="width:120px !important; background-color:lightcyan;" class="form-control" placeholder="Start Date"
                                        id="interest_rate_${td_id}" value="<?= $investor_data['totalPrincipalPaid'] ?>" type="text" />
                                </td>
                                <td><input style="width:120px !important; background-color:lightcyan;" class="form-control" placeholder="Start Date"
                                        id="interest_rate_${td_id}" value="<?= $investor_data['totalInterestTillDate'] ?>" type="text" />
                                </td>
                                <td><input style="width:120px !important; background-color:skyblue" class="form-control" placeholder="Start Date"
                                        id="interest_rate_${td_id}" value="<?= $investor_data['totalInterestPaid'] ?>" type="text" />
                                </td>
                                
                            
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


<div class="modal fade " id="debitCreditModal" tabindex="-1" role="dialog" aria-labelledby="debitCreditModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="debitCreditModalLabel">Debit Credit Entry Investor</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="table-responsive m-t">
                    <table class="table invoice-table table-bordered solid">
                        <thead  style="text-align: right;">

                            <tr>
                               <th>Select Investor</th>
                                <th>Amount&nbsp;Submit Type</th>
                               <th>Transaction Type</th> 
                               <th>Amount</th>
                               <th>Submit</th>
                            </tr>

                            

                        </thead>
                        <tbody>
                            <tr>
                                <td><select id="select_investor_type_id"  class=" form-control select">
                                    <?php   foreach ($assign_investor_list as $key => $assignedInvestor) {?>
                                      
                                    <option  <?php if($assignedInvestor['status']!="active" ) echo "disabled";  ?>  value="<?= $assignedInvestor['assign_investor_id'] ?>"><?= $assignedInvestor['investor_name'] ?> (<?= $assignedInvestor['amount'] ?>)</option>
                                   <?php } ?>
                                   
                                </select>
                                    
                                </td>   

                                

                                <td><select  id="amount_type" class=" form-control select">
                                    <option value="principal">Principal</option>
                                    <option value="interest">Interest</option>
                                </select>
                                    
                                </td> 
                                  <td><select id="transaction_type"  class=" form-control select">
                                    <!--<option value="C">Deposit</option>-->
                                    <!--<option value="D">Withdraw</option>-->
                                </select>
                                    
                                </td> 

                                 <td><input class="form-control" type="number" id="submit_amount" value="0">
                                    
                                </td>   

                                <td>
                                    <button class="btn btn-dark btn-sm" onclick="investorSubmit()"> Submit</button>
                                </td>
                           
                                
                            </tr>
                        </tbody>
                    </table>
                </div>


        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
<script>

    $(document).ready(function()
    {
        $("#transaction_type").html('<option value="C">Deposit</option><option value="D">Withdraw</option>'); 
    });
var order_id = "<?= $_GET['order_id'] ?>"

function addList() {



 
    var td_id = parseInt($("#td_id").val())
    $("#td_id").val(td_id + 1)

    var html = `           
    <tr id="row_${td_id}" class="form-group" >
    <td width="400%">
                             
                             <select style="width:120px !important"  id="investor_id_${td_id}" name="investor_id[]" colspan=4 class="select2_demo_1 col-md-12 form-control select">
 
    <?php foreach ($investor_list as $key => $investor) { ?>
    <option
      
        value="<?= $investor['id']?>"> <?= $investor['name']?> </option>
    <?php  }  ?>
</select>
           </td>
   

                                <td width="400%">
                                <input style="width:120px !important"  class="form-control" placeholder="Amount"  id="order_item_list_id_${td_id}"  value="<?=$order_data['gold_details']?>" name="order_item_list_id[]" type="text" readonly />
                             
                                   
                   </td>
                               
                                <td><input style="width:120px !important"  class="form-control" placeholder="Amount"  id="amount_${td_id}"  value="0" name="amount[]" type="number" /></td>
                                <td><input style="width:120px !important"  class="form-control"  placeholder="Interest Rate"   id="interest_rate_${td_id}"  value="0" name="interest_rate[]" type="number" /></td>
                                <td><input style="width:120px !important"  class="form-control"  placeholder="Start Date"   id="start_date_${td_id}"  value="" name="start_date[]" type="date" /></td>
                                <td><input style="width:200px !important"  class="form-control"     placeholder="Packet Name"  id="packet_name_${td_id}"  value="" name="packet_name[]" type="text" /></td>
                                <td>
                               <select style="width:120px !important" id="status_${td_id}" name="status[]"
                                        colspan=4 class="select2_demo_1 col-md-12 form-control select">
                                        <option value='active'>Active</option>
                                        <option class"test-success" value='complete'>Complete</option>
                                        <option value='cancel'>Cancel</option>
                                            
                                    </select>
                                </td>
                                <td>
                                <textarea required id="remark_${td_id}" placeholder="Remark"> </textarea>
                                </td>
                                
                                
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
    var investor_id = $("#investor_id_" + td_id).val()
    var packet_name = $("#packet_name_" + td_id).val()
    var remark = $("#remark_" + td_id).val()
    var start_date = $("#start_date_" + td_id).val()
    var status = $("#status_" + td_id).val()
    var amount = parseFloat($("#amount_" + td_id).val())
    var interest_rate = parseFloat($("#interest_rate_" + td_id).val())
    var order_item_list_id = parseFloat($("#order_item_list_id_" + td_id).val())

    if(amount<=0)
    {
        alert("amount Is required");
        return false;
    }
    if(interest_rate<=0)
    {
        alert("Interest Rate Is required");
        return false;
    }
    if(packet_name=='')
    {
        alert("Packet Name Is required");
        return false;
    }
   
    submit_obj = {
        investor_id: investor_id,
        packet_name: packet_name,
        remark: remark,
        amount: amount,
        interest_rate: interest_rate,
        start_date: start_date,
        order_id: order_id,
        status: status,
        order_item_list_id:order_item_list_id,
    }

    console.log(submit_obj)

    $.ajax({
        url: "ajax/insertInvestor",
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




function investorSubmit()
{

   var amount = $("#submit_amount").val()
   var transaction_type = $("#transaction_type").val()
   var amount_type = $("#amount_type").val()
   var assign_investor_id = $("#select_investor_type_id").val()

    
    if(amount<=0)
    {
        alert("Please insert Amount Properly")
        return false;
    }

   
   var sendData = {
      "amount":amount,
      "amount_type":amount_type,
      "transaction_type":transaction_type,
      "order_id":order_id,
      "assign_investor_id":assign_investor_id,
   }

   const res =  sendAjax("ajax/investorUpdate",sendData)
   if(res.staus=="success")
   {
    notify(res.status , res.msg);
    window.location.reload();
   }else{
    notify(res.status , res.msg);
   }
   
window.location.reload();
  

}

$('#amount_type').on('change',function()
{
  

    if($('#amount_type').val()=='interest')
    {
        $("#transaction_type").html('<option value="D">Withdraw</option>'); 
    }
    else if($('#amount_type').val()=='principal')
    {
        $("#transaction_type").html('<option value="C">Deposit</option><option value="D">Withdraw</option>'); 
    }
 
   
    
})
</script>

<?php include('footer.php'); ?>