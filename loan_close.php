<?php
include('include/config.php');


 
$_GET = sanatize($_GET);
$_POST = sanatize($_POST);
$order_id = $_GET['order_id'];
$order_data = order_detail($_GET['order_id']);
$order_store_data = store_detail($order_data['store_id']);
$client_data = user_detail($order_data['client_id']);
$print = false;
if (isset($_GET['print'])) {
    $print = true;
}
// _dx($_SESSION);


// _dx($_SESSION['user_data']['id']);
$order_data = getOrderDataByOrderId($order_id, $order_data);



// _dx($order_data);
 
include('header.php');
?>
<?php if (!$print) { ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-4 mt-3">
            Order ID : <b><?= strtoupper($order_id) ?> </b> <br>
                
                <br><br>

            Customer Name : <b><?= strtoupper($client_data['name']) ?> </b> <br>
                ऋण ग्राहक नाम : <b> <?php echo $client_data['name_hindi']; ?> </b> 

                <br><br>
                Father/Husband Name :  <b><?= strtoupper($client_data['father_name']) ?> </b> <br>
                पिता/पति का नाम : <b> <?php echo $client_data['father_name_hindi']; ?> </b> 

                <br><br>
          
               <br><br> 
        </div>
        <div class="col-lg-4 mt-3">
        Mobile No: <b><?= strtoupper($client_data['mobile']) ?></b> <br>
               मोबाइल नंबर : <b><?= strtoupper($client_data['mobile']) ?> </b> 


                <br><br>
                Full Address :  <b> <?= strtoupper($client_data['address']) ?> <?= strtoupper($client_data['city']) ?>
                                (<?= strtoupper($client_data['state']) ?>) </b> <br>
                पूरा पता : <b> <?php echo $client_data['address_hindi'] ?> <?php echo $client_data['city_hindi'] ?> (<?php echo $client_data['state_hindi'] ?>) </b> 

               

               <br><br> 
        </div>


        <div class="col-lg-4 mt-3">
        Loan Amount Taken By Customer:<b><b> &#8377;
                                <?= strtoupper(abs($order_data['loan_amount']))   ?>
                            </b> <br>
        ग्राहक द्वारा ली गई ऋण राशि:  
                                 &#8377; <?php echo translateText(getIndianCurrency(abs($order_data['loan_amount']))); ?> </b>


                <br><br>
               Interest On Loan Amount: <b> <?= strtoupper($order_data['loan_interest']) ?> % (Per Month) </b> <br>
                ऋण राशि पर ब्याज: <b> <?= strtoupper($order_data['loan_interest']) ?> % (प्रति महीने)  </b> 

               

               <br><br> 
        </div>



  
    </div>
<?php } ?>
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content p-xl">



       

            <div class="table-responsive m-t">
                    <table class="table invoice-table table-bordered solid">
                        <thead style="text-align: right;">
                            <tr>
                                <th>Transaction Type</th>
                                <th>Amount Submit Type</th>
                                <th>Amount</th>
                                <th>Discount</th>
                                <th>Narration</th>
                                <th>Submit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><select id="transaction_type" class=" form-control select">
                                        <option value="C">Deposit</option>
                                        <option value="D">Loan Topup</option>
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
                                   
                                </td>
                                <td>
                                <input class="form-control" type="hidden" id="totalInterestTillDate" value="<?= ($order_data['totalInterestTillDate']) ?>">
                                    <input class="form-control" type="text" id="customer_remark" value="">
                                </td>
                                <td>
                                    <button class="btn btn-dark btn-sm" onclick="submit()"> Submit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>


         
                 
                
                 
                <hr>
                <center>
                    <h3>Account Information Of Loan Ornament's By Customer</h3>
                    <!-- <b> ऋण ग्राहक द्वारा रखे गए ऋण आभूषण रखने की जानकारी</b> -->
                </center>
                <style>
                </style>
                <div class="table-responsive m-t">
                    <table class="table invoice-table table-bordered solid">
                        <thead style="text-align: right;">
                            <tr>
                                <td width="70%" class="text-danger"> Total Principal Given To Client </td>
                                <td class="text-danger"> <?= abs($order_data['totalprincipalAmountPay']) ?> </td>
                            </tr>
                            <tr>
                                <td class="text-dark"> Total Intrest Till Date (<?php echo $order_data['is_finish'] == 1 ? $order_data['loan_finish_date'] : _date() ?>) </td>
                                <td class="text-dark"> <?= ($order_data['totalInterestTillDate']) ?> </td>
                            </tr>
                            <tr>
                                <td style="background-color:pink" class="text-success "> Total Amount Paid Till Date (<?php echo $order_data['is_finish'] == 1 ? $order_data['loan_finish_date'] : _date() ?>) </td>
                                <td style="background-color:pink" class="text-success"><b> <?= $order_data['totalAmountPaidTillDate'] ?> </b> </td>
                            </tr>
                            <tr>
                                <td class="text-success"> Total Principal Received </td>
                                <td class="text-success"><?= ($order_data['totalprincipalAmountReceived']) ?> </td>
                            </tr>
                            <tr>
                                <td class="text-info"> Total Interest Received </td>
                                <td class="text-info"> <?= ($order_data['totalClientInterestAmountReceived']) ?> </td>
                            </tr>
                            <tr>
                                <td class="text-secondary"> Total Discount Given </td>
                                <td class="text-secondary"> <?= ($order_data['discount']) ?> </td>
                            </tr>
                            <tr>
                                <td style="background-color:pink" class="text-dark"> Total Amount Received </td>
                                <td style="background-color:pink; font-weight: bold;" class="text-dark "> <?= $order_data['totalAmountReceivedTillDate'] ?> </td>
                            </tr>
                            <tr>
                                <td style="background-color:skyblue; color:white" class="text-dark"> Total Amount Has To Be Taken From CLient </td>
                                <td style="background-color:skyblue; color:white; font-weight: bold;" class="text-dark ">
                                    <?= $order_data['totalprincipalAmountRest']-$order_data['discount'] ?>
                                </td>
                            </tr>
                            <tr>
                                <td style="background-color:skyblue; color:white" class="text-dark"> Total Interest Has To Be Taken From CLient </td>
                                <td style="background-color:skyblue; color:white; font-weight: bold;" class="text-dark "> <?= $order_data['totalRestInterest'] ?> </td>
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
                        <tbody>
                            <?php
                            $Totalbalance = 0;
                            foreach ($order_data['allArray'] as $key => $transaction) {
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
                                        <!-- <p><?= $transaction['amount'] < 0 ? "Debit" : "Credit" ?></p> -->
                                        <p><?= $transaction['amount'] < 0 ? "Payment Paid" : "Payment Recived" ?></p>
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
                            <?php  }
                            if ($order_data['is_finish'] != 0) {
                            ?>
                                <tr class="form-group ">
                                    <td colspan="7" class="text-center text-success">
                                        <p><b>Loan Close Narration : <?= $order_data['loan_close_narration'] ?> </b> </p>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm col-md-6">
                            <h3>Customer Signature
                                <br>
                                <img src="img/item/item_full/<?php echo $client_data['client_signature_pic']; ?>" alt="" width="150px;" height="80px;">
                                <!-- <b> <br>........................................................ </b> -->
                            </h3>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<!-- 
<div class="modal fade" id="debitCreditModal" tabindex="-1" role="dialog" aria-labelledby="debitCreditModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="width:800px !important">
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
                                <th>Narration</th>
                                <th>Submit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <form action="">

                              
                                <td><select id="transaction_type" class=" form-control select">
                                        <option value="C">Deposit</option>
                                        <option value="D">Loan Topup</option>
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
                                    <input class="form-control" type="text" id="customer_remark" value="">
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
                 
                <button type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div>
    </div>
</div> -->


<!-- 

<div class="modal fade" id="loanclose" tabindex="-1" role="dialog" aria-labelledby="loancloseLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loancloseLabel">Loan Close Narration</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="table-responsive m-t">
                    <table class="table invoice-table table-bordered solid">
                        <thead style="text-align: right;">
                            <tr>
                                <th>Loan Close Date</th>
                                <th>Narration</th>
                                <th>Submit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <input class="form-control" type="date" id="date" max="<?php echo date('Y-m-d'); ?>">
                                </td>
                                <td>
                                    <input class="form-control" type="text" id="loan_close_narration" value="">
                                    <input class="form-control" type="hidden" id="order_id" value="<?= ($order_data['order_id']) ?>">
                                </td>
                                <td>
                                    <button class="btn btn-dark btn-sm" onclick="loansubmit()"> Submit</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" id="loancloseButton">Close</button>
              
            </div>
        </div>
    </div>
</div> -->
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
    var amount = $("#submit_amount").val();
    var transaction_type = $("#transaction_type").val();
    var amount_type = $("#amount_type").val();
    var totalInterestTillDate = $("#totalInterestTillDate").val();
    var customer_remark = $("#customer_remark").val();
    var discount = $("#discount").val()


    if (amount <= 0) {
        alert("Please insert Amount Properly");
        return false;
    }

    var sendData = {
        "amount": amount,
        "amount_type": amount_type,
        "transaction_type": transaction_type,
        "order_id": order_id,
        "totalInterestTillDate": totalInterestTillDate,
        "customer_remark": customer_remark,
        "discount": discount,
    };

    const res = sendAjax("ajax/transactionUpdate", sendData);
    notify(res.status, res.msg);

    if (res.status === "success") {
        // The window.location.reload(true); line is not necessary if you're using setTimeout
        setTimeout(function () {
            location.reload();
        }, 3000);
    }
};

   
</script>
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