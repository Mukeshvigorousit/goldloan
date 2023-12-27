<?php

include('include/config.php');
$_GET = sanatize($_GET);
$_POST = sanatize($_POST);
$order_id = $_GET['order_id'];
$order_data = order_detail($_GET['order_id']);
$order_store_data = store_detail($order_data['store_id']);
$client_data = user_detail($order_data['client_id']);

$investorData = get_data("user_tbl","id=".$order_data['investor_id']." and status='1'",'s');

$assign_investor_list = get_data("assign_investor_list", "order_id='" . $order_data['order_id'] . "' AND client_id='".$order_data['client_id'] ."' AND investor_id='".$order_data['investor_id']."'",'s');

$transactionData =  $transactioData=get_data("transaction_log","order_id='".$order_id."' AND overall_type IN ('investorAmount','investorInterest')");


$order_data = getOrderDataByOrderId($order_id, $order_data);

// _dx($order_data);

  
$print = false;
if (isset($_GET['print'])) {
    $print = true;
}

 

include('header.php');

?>
<?php if (!$print) { ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-4">
            <h2>Investor Invoice</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    order Details
                </li>

                <li class="breadcrumb-item active">
                    <strong><a href="#"><?= $investorData['name'] ?> (<?= $order_data['order_id'] ?>)</a></strong>
                </li>
            </ol>
        </div>

        <div class="col-lg-4">
            <div class="title-action">

                <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#debitCreditModal">
                    Credit/Debit
                </button> -->

            </div>
        </div>

        <div class="col-lg-4">
            <div class="title-action"> 
                <a href="print_form?order_id=<?= $order_data['order_id'] ?>&page_name=print_form&print=true" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print
                    Form </a>
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
                            <h3><strong><?= $investorData['name'] ?></strong></h3> 
                            <abbr title="Phone">P:</abbr> +91-<?= $investorData['mobile'] ?>
                        </address>
                    </div>

                    <!-- <div class="col-sm-6 text-right">
                        <h4>Invoice No.</h4>
                        <h4 class="text-navy">INV-<?= $order_data['order_id'] ?></h4>
                        
                        <p>
                            <span><strong>Loan
                                    Date :</strong>
                                <?= date("d/m/Y", strtotime($order_data['loan_date']))  ?></span><br>
                            <span><strong>Due
                                    Date :</strong>

                                <?php echo $order_data['loan_finish_date'] != '' ? date("d/m/Y", strtotime($order_data['loan_finish_date'])) : ''  ?></span>
                        </p>
                    </div> -->
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
                                <?= strtoupper(abs($assign_investor_list['amount']))   ?>  <br>  &#8377;  <?php echo translateText(getIndianCurrency(abs($assign_investor_list['amount']))); ?> 
                            </b>
                        </div>
                        <div class="col-sm col-md-2 mt-3">
                            <h3>In Digits
                                <br>अंकों में</br>
                            </h3>
                        </div>
                        <div class="col-sm col-md-4 mt-4">
                            <b> &#8377; <?= strtoupper(getIndianCurrency(abs($assign_investor_list['amount']))) ?><br>  &#8377;  <?php echo translateText(getIndianCurrency(abs($assign_investor_list['amount']))); ?> </b>
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
                                <?=  date("d/m/Y", strtotime($assign_investor_list['start_date']))  ?> 
                            </b>
                        </div>
                        <div class="col-sm col-md-3">
                            <h3> Date of receipt of amount:
                                <br> राशि प्राप्त करने की तारीख:
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b>
                                <?= $assign_investor_list['end_date']!=''?date("d/m/Y", strtotime($assign_investor_list['end_date'])):''  ?> 
                            </b>
                        </div>
                    </div> 
                    <div class="row">
                        <div class="col-sm col-md-3">
                            <h3> packet delivery date:
                                <br> पैकेट देने की तारीख:
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b>
                                <?=  $assign_investor_list['packet_given_date']!=''?date("d/m/Y", strtotime($assign_investor_list['packet_given_date'])):''  ?> 
                            </b>
                        </div>
                        <div class="col-sm col-md-3">
                            <h3> packet received date:
                                <br> पैकेट प्राप्त करने की तारीख:
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b>
                                <?= $assign_investor_list['packet_reciving_date']!=''?date("d/m/Y", strtotime($assign_investor_list['packet_reciving_date'])):''  ?> 
                            </b>
                        </div>
                    </div>
                
 

                </div>

                <hr>

                <center>
                    <h3>Account Information Of Loan Ornament's By Investor</h3>

                   <b> निवेशक द्वारा ऋण आभूषण की खाता जानकारी</b>  
                </center>

                <style>

                </style>

               
                <div class="table-responsive m-t">
                    <table class="table invoice-table table-bordered solid">
                        <thead style="text-align: right;">

                            <tr>
                                <td width="70%" class="text-danger"> Total Principal Given To Investor </td>
                                <td class="text-danger"> <?=   abs($assign_investor_list['amount']) ?> </td>
                            </tr>

                            <tr>
                                <td class="text-dark"> Total Intrest Till Date (<?= _date() ?>) </td>
                                <td class="text-dark"> <?= ($assign_investor_list['totalInterestTillDate']) ?> </td>

                            </tr>

                            <tr>
                                <td style="background-color:pink" class="text-success "> Total Amount Paid Till Date (<?= _date() ?>) </td>
                                <td style="background-color:pink" class="text-success"><b> <?= $assign_investor_list['totalPrincipalPaid'] ?> </b> </td>
                            </tr>

                            <tr>
                                <td class="text-success"> Total Principal Payed </td>
                                <td class="text-success"><?= ($assign_investor_list['totalPrincipalPaid']) ?> </td>
                            </tr>

                            <tr>
                                <td class="text-info"> Total Interest Payed </td>
                                <td class="text-info"> <?= ($assign_investor_list['totalInterestPaid']) ?> </td>
                            </tr>

                            <tr>
                                <td style="background-color:pink" class="text-dark"> Total Amount Payed </td>
                                <td style="background-color:pink; font-weight: bold;" class="text-dark "> <?= $assign_investor_list['totalPrincipalPaid']+$assign_investor_list['totalInterestPaid'] ?> </td>
                            </tr>

                            <tr>
                                <td style="background-color:skyblue; color:white" class="text-dark"> The total amount to be paid to the investor </td>
                                <td style="background-color:skyblue; color:white; font-weight: bold;" class="text-dark "> <?= $assign_investor_list['amount'] - $assign_investor_list['totalPrincipalPaid'] ?> </td>
                            </tr>

                            <tr>
                                <td style="background-color:skyblue; color:white" class="text-dark"> The total Interest to be paid to the investor  </td>
                                <td style="background-color:skyblue; color:white; font-weight: bold;" class="text-dark "> <?= $assign_investor_list['totalInterestTillDate']-$assign_investor_list['totalInterestPaid'] ?> </td>
                            </tr>

                        </thead>
                    </table>
                </div>

                <div class="table-responsive m-t">
                    <table class="table invoice-table table-bordered solid">
                        <thead>
                            <tr>
                                <th>Transaction Id</th>
                                <th>Transaction Type</th>
                                <th>Amount</th>
                                <th>Reason</th>
                                <th>Balance</th>
                                <th>Remarks</th>
                                <th>Date/Time</th>

                            </tr>
                        </thead>
                        <!-- <tbody>

                       

                            <?php

                            

                            $Totalbalance = 0;

                            foreach ($transactionData as $key => $transaction) {

                                $class = "text-danger";
                                if ($transaction['amount'] >= 0) {
                                    $class = "text-success";
                                }

                                $Totalbalance += $transaction['amount'];

                            ?>
                                <tr id=" row_<?= $transaction['log_id'] ?>" class="form-group">
                                    <td>
                                        <p><?= $transaction['log_id'] ?></p>
                                    </td>
                                    <td class="<?= $class ?>">
                                        <p><?= $transaction['amount'] < 0 ? "Recived" : "Payment" ?></p>
                                    </td>
                                    <td class="<?= $class ?>">
                                        <p><?= round(abs($transaction['amount']), 2) ?></p>
                                    </td>
                                    <td>
                                        <p><?= $transaction['overall_type'] ?></p>
                                    </td>
                                    <td class="<?= $Totalbalance < 0 ? "text-danger" : "text-success"   ?>">
                                        <p><?= round(abs($Totalbalance), 2); ?></p>
                                    </td>

                                    <td>
                                        <p><?= $transaction['remark'] ?></p>
                                    </td>
                                    <td>
                                        <p><?= date('d-m-Y h:i:s A', strtotime($transaction['date_time'])); ?></p>
                                    </td>

                                </tr>
                            <?php  } ?>

                        </tbody> -->
                        <tbody>
                            <?php

                            $Totalbalance = 0;

                            foreach ($order_data['investorArray'] as $key => $transaction) {

                                $class = "text-danger";
                                if ($transaction['amount'] >= 0) {
                                    $class = "text-success";
                                }

                                $Totalbalance += $transaction['amount'];

                            ?>
                                <tr id=" row_<?= $transaction['log_id'] ?>" class="form-group">
                                    <td>
                                        <p><?= $transaction['log_id'] ?></p>
                                    </td>
                                    <td class="<?= $class ?>">
                                        <p><?= $transaction['amount'] < 0 ? "Recived" : "Payment" ?></p>
                                    </td>
                                    <td class="<?= $class ?>">
                                        <p><?= round(abs($transaction['amount']), 2) ?></p>
                                    </td>
                                    <td>
                                        <p><?= $transaction['overall_type'] ?></p>
                                    </td>
                                    <td class="<?= $Totalbalance < 0 ? "text-danger" : "text-success"   ?>">
                                        <p><?= round(abs($Totalbalance), 2); ?></p>
                                    </td>

                                    <td>
                                        <p><?= $transaction['remark'] ?></p>
                                    </td>
                                    <td>
                                        <p><?= date('d-m-Y h:i:s A', strtotime($transaction['date_time'])); ?></p>
                                    </td>

                                </tr>
                            <?php  } ?>

                        </tbody>
                    </table>
                </div>
             
            </div>
        </div>
    </div>
</div>

<br>

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
                                <th>Transaction Type</th>
                                <th>Amount Submit Type</th>
                                <th>Amount</th>
                                <th>Discount</th>
                                <th>Submit</th>
                            </tr>

                        </thead>
                        <tbody>
                            <tr>
                                <td><select id="transaction_type" class=" form-control select">
                                        <option value="C">Deposit</option>
                                        <option value="D">Withdrawl</option>
                                    </select>

                                </td>

                                <td><select id="amount_type" class=" form-control select">
                                        <option value="principal">Principal</option>
                                        <option value="interest">Interest</option>
                                    </select>

                                </td>

                                <td>
                                    <input class="form-control" type="number" id="submit_amount" value="0">

                                </td>
                                <td>

                                    <input class="form-control" type="number" id="discount" value="0">
                                    <input class="form-control" type="hidden" id="totalInterestTillDate" value="<?= ($order_data['totalInterestTillDate']) ?>">

                                </td>

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
    }

    var order_id = "<?= $_GET['order_id'] ?>"

    $('#myModal').on('shown.bs.modal', function() {
        $('#myInput').trigger('focus')
    })

    const submit = () => {
        var amount = $("#submit_amount").val()
        var transaction_type = $("#transaction_type").val()
        var amount_type = $("#amount_type").val()
        var totalInterestTillDate = $("#totalInterestTillDate").val()
        var discount = $("#discount").val()

        if (amount <= 0) {
            alert("Please insert Amount Properly")
            return false;
        }

        var sendData = {
            "amount": amount,
            "amount_type": amount_type,
            "transaction_type": transaction_type,
            "order_id": order_id,
            "totalInterestTillDate": totalInterestTillDate,
            "discount": discount,
        }
        const res = sendAjax("ajax/transactionUpdate", sendData);
        notify(res.status, res.msg);
        if (res.staus == "success") {

            window.location.reload();

        }

    }

    $("#closeButton").on("click", function() {
        location.reload(true);
    });
</script>
<?php if (!$print) { ?>
<?php include('footer.php');
} ?>