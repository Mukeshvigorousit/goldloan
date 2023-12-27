<?php
include('include/config.php');
$_GET = sanatize($_GET);
$_POST = sanatize($_POST);
include('header.php');

$print = false;
if (isset($_GET['print'])) {
    $print = true;
}

$order_data = order_detail($_GET['order_id']);
$order_store_data = store_detail($order_data['store_id']);
$client_data = user_detail($order_data['client_id']);
// $order_item_list = order_item_list($order_data['client_id']); 

$investorData = get_data("user_tbl", "id=" . $order_data['investor_id'] . " and status='1'", 's');

$item_data = get_data("order_item_list", "order_id='" . $order_data['order_id'] . "' AND client_id='" . $order_data['client_id'] . "' AND investor_id='" . $order_data['investor_id'] . "'");
$assign_investor_list = get_data("assign_investor_list", "order_id='" . $order_data['order_id'] . "' AND client_id='" . $order_data['client_id'] . "' AND investor_id='" . $order_data['investor_id'] . "'", 's');






?>

<?php if (!$print) { ?>

<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-sm-4">
        <!--<h2><?= ucfirst(label_name($_GET['page_name'])); ?></h2> -->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="dashboard.php?page_name=dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                <!--<strong><?= $_SESSION['name']; ?> (<?= $_SESSION['usercode'] ?>)</strong> -->


            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="title-action">  
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#debitCreditModal">
                Recived / Given
            </button> 
        </div>
    </div>
    <div class="col-lg-4">
            <div class="title-action">
                <a href="item_details?order_id=<?= $order_data['order_id'] ?>&page_name=print_form&print=true" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print  Investor Slip </a>
            </div>
        </div>
</div>
<?php } ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content p-xl">
                <div class="row">
                    <div class="col-sm-6">
                        <h5>From:</h5>
                        <address>
                            <h3 class="text-capitalize"><strong><?= $order_store_data['store_name']  ?></strong></h3>
                            <?= $order_store_data['store_address'] ?><br>
                            <?= $order_store_data['city'] ?> (<?= $order_store_data['state'] ?>)<br>

                            <abbr title="Phone">P:</abbr> +91-<?= $order_store_data['mobile'] ?>
                        </address>
                    </div>

                    <div class="col-sm-6 text-right">
                        <h4>To.</h4>
                        <h4 class="text-navy"><?= $investorData['name'] ?></h4>

                        <p>
                            <span><strong>Slip Date :</strong>
                                <?= date("d/m/Y")  ?></span><br>
                        </p>
                    </div>
                </div>
                <hr>

                <div class="container">
                    <div class="row">
                        <div class="col-sm col-md-3">
                            <h3 class="text-capitalize">amount paid by investor:
                                <br>इन्वेस्टर द्वारा दी गयी राशि:
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b> &#8377;
                                <?= strtoupper(abs($assign_investor_list['amount']))   ?>
                            </b>
                        </div>
                        <div class="col-sm col-md-2 mt-3">
                            <h3>In Digits
                                <br>अंकों में</br>
                            </h3>
                        </div>
                        <div class="col-sm col-md-4 mt-4">
                            <b> &#8377; <?= strtoupper(getIndianCurrency(abs($assign_investor_list['amount']))) ?>
                                <br> &#8377; <?php echo translateText(getIndianCurrency(abs($assign_investor_list['amount']))); ?> </b>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm col-md-3">
                            <h3> On Loan Amount:
                                <br> राशि पर ब्याज:
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b>
                                <?= strtoupper(abs($assign_investor_list['interest_rate']))   ?> % (Per Month)<small>(प्रति
                                    महीने)</small>
                            </b>
                        </div>
                        <div class="col-sm col-md-2 mt-3">

                        </div>
                        <div class="col-sm col-md-4 mt-4">

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm col-md-3">
                            <h3> Amount Given Date:
                                <br> राशि देने की तारीख:
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b>
                                <?= date("d/m/Y", strtotime($assign_investor_list['start_date']))  ?>
                            </b>
                        </div>
                        <div class="col-sm col-md-3">
                            <h3> Date of receipt of amount:
                                <br> राशि प्राप्त करने की तारीख:
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b>
                                <?= $assign_investor_list['end_date'] != '' ? date("d/m/Y", strtotime($assign_investor_list['end_date'])) : ''  ?>
                            </b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm col-md-3">
                            <h3> packet received date:
                                <br> पैकेट प्राप्त करने की तारीख:
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b>
                                <?= $assign_investor_list['packet_reciving_date'] != '' ? date("d/m/Y", strtotime($assign_investor_list['packet_reciving_date'])) : ''  ?>
                            </b>
                        </div>
                        <div class="col-sm col-md-3">
                            <h3> packet delivery date:
                                <br> पैकेट देने की तारीख:
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b>
                                <?= $assign_investor_list['packet_given_date'] != '' ? date("d/m/Y", strtotime($assign_investor_list['packet_given_date'])) : ''  ?>
                            </b>
                        </div>

                    </div>



                </div>

                <hr>

                <center>
                    <h3>Information Of Ornament's By Investor</h3>

                    <b> इन्वेस्टर द्वारा लिए गए आभूषण की जानकारी</b>
                </center>

                <div class="table-responsive m-t">
                    <table class="table invoice-table table-bordered solid">
                        <thead>


                            <tr>
                                <th class="text-left" width="20%">Grade</th>
                                <th class="text-left">Details</th>

                            </tr>

                        </thead>
                        <tbody>

                            <?php
                            if (isset($order_data['gold_details']) && !empty($order_data['gold_details'])) {

                            ?>
                                <tr class="form-group">
                                    <td class="text-left">
                                        <p>Gold</p>
                                    </td>
                                    <td class="text-left">
                                        <p><?= $order_data['gold_details'] ?></p>
                                    </td>

                                </tr>
                            <?php
                            }

                            if (isset($order_data['silver_details']) && !empty($order_data['silver_details'])) {

                            ?>
                                <tr class="form-group">
                                    <td class="text-left">
                                        <p>Silver</p>
                                    </td>
                                    <td class="text-left">
                                        <p><?= $order_data['silver_details'] ?></p>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>


                        </tbody>
                    </table>
                </div>




                <!-- <div class="table-responsive m-t">
                    <table class="table invoice-table table-bordered solid">
                        <thead>
                            <tr>
                                <th>Grade</th>
                                <th>Item Name</th>
                                <th>Item Details</th>
                                <th>Remarks</th>
                                <th>Gross Wt. <code>(Gm)</code></th>
                                <th>Less <code>(Gm)</code></th>
                                <th>Net Wt. <code>(Gm)</code></th>
                               
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($item_data as $key => $item) { ?>
                            <tr id=" row_<?= $item['item_id'] ?>" class="form-group">
                                <td>
                                    <p><?= $item['item_name'] ?></p>
                                </td>
                                <td>
                                    <p><?= $item['item_name_by_user'] ?></p>
                                </td>
                                <td>
                                    <p><?= $item['item_details'] ?></p>
                                </td>
                                <td>
                                    <p><?= $item['remark'] ?></p>
                                </td>
                                <td>
                                    <p><?= $item['gross_wt'] ?></p>
                                </td>
                                <td>
                                    <p><?= $item['less_wt'] ?></p>
                                </td>
                                <td>
                                    <p><?= $item['net_wt'] ?></p>
                                </td>
                              
                            </tr>
                            <?php   } ?>


                        </tbody>
                    </table>
                </div> -->












            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="debitCreditModal" tabindex="-1" role="dialog" aria-labelledby="debitCreditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="debitCreditModalLabel">Debit Credit Entry</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="table-responsive m-t">
                    <table class="table invoice-table table-bordered solid">
                        <thead style="text-align: right;">

                            <tr>
                            <th>transaction Type</th>
                                <th>Recived Type</th>


                                <th>Received Date</th>
                                <th>Submit</th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                            <td><select id="enter_type"  class=" form-control select">
                                        <option value="G">Given</option>
                                        <option value="R">Recived</option>
                                    </select>

                                </td>
                                <td><select id="transaction_type" class=" form-control select">
                                        <option value="A">Amount</option>
                                        <option value="I">Item</option>
                                    </select>

                                </td>



                                <td>
                                    <input class="form-control" type="date" id="Received_date" name="Received_date" value="">

                                </td>
                                <!-- <td> 
                                     
                                    <input class="form-control" type="hidden" id="totalInterestTillDate" value="<?= ($order_data['totalInterestTillDate']) ?>">

                                </td> -->

                                <td>
                                    <button class="btn btn-dark btn-sm" onclick="submit()"> Submit</button>
                                </td>

                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="closeButton">Close</button>
                <!-- data-dismiss="modal" -->
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div>



<script>
    var printData = "<?= $print ?>"
    if (printData) {
        window.print();
        window.onafterprint = window.close;
   
    }
</script>
<?php if (!$print) { ?>
<?php include('footer.php');
} ?>
<!-- <?php include('footer.php'); ?> -->

<script>
    var assign_investor_id = "<?= $assign_investor_list['assign_investor_id'] ?>"


    $(document).ready(function()
    {
        $("#transaction_type").html('<option value="I">Item</option>'); 
    });

    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    })

    const submit = () => {
        // var amount = $("#submit_amount").val()
        var transaction_type = $("#transaction_type").val()
        var enter_type = $("#enter_type").val()
        // var amount_type = $("#amount_type").val()
        // var totalInterestTillDate = $("#totalInterestTillDate").val()
        var Received_date = $("#Received_date").val()

        if (Received_date == '') {
            alert("Please Select Reciving Date")
            return false;
        }
        var sendData = {
            "enter_type": enter_type,
            "transaction_type": transaction_type,
            "assign_investor_id": assign_investor_id,
            "Received_date": Received_date

        }
        const res = sendAjax("ajax/updateItemData", sendData);
        notify(res.status, res.msg);
        if (res.staus == "success") {

            window.location.reload();

        }

    }

    $("#closeButton").on("click", function() {
        location.reload(true);
    });



    $('#enter_type').on("change",function(){

     

if($('#enter_type').val()=='G')
{
    $("#transaction_type").html('<option value="I">Item</option>'); 
}
else if($('#enter_type').val()=='R')
{
    $("#transaction_type").html('<option value="A">Amount</option> <option value="I">Item</option>'); 
}

    });
</script>