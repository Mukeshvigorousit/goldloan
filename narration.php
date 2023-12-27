<?php


include('include/config.php');
$_GET = sanatize($_GET);
$_POST = sanatize($_POST);
$order_id = $_GET['order_id'];
$order_data = order_detail($_GET['order_id']);
$order_store_data = store_detail($order_data['store_id']);
$client_data = user_detail($order_data['client_id']);
$narration_data=get_data('narration_tbl',"order_id='".$order_id."'");

 
$print = false;
if (isset($_GET['print'])) {
    $print = true;
}
// _dx($_SESSION['user_data']['id']);
$order_data = getOrderDataByOrderId($order_id, $order_data);
include('header.php');
?>
<?php if (!$print) { ?>
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-lg-4">
            <h2>Narration</h2>
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                Narration Details
                </li>
                <li class="breadcrumb-item active">
                    <strong><a href="#"><?= $order_data['client_name'] ?> (<?= $order_data['order_id'] ?>)</a></strong>
                </li>
            </ol>
        </div>
        <div class="col-lg-4">
            <div class="title-action">
                <?php
                if (isset($_SESSION['genrate_recipt'])) {
                ?>
                    <a href="gernrate_pdf?transation_id=<?= $_SESSION['genrate_recipt'] ?>&action=print_slip" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print
                        Slip </a>
                <?php
                    unset($_SESSION['genrate_recipt']);
                }
                ?>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#debitCreditModal">
                    Add Narration
                </button>
            </div>
        </div>
        <div class="col-lg-4">
            <!-- <div class="title-action">
                <a href="print_form?order_id=<?= $order_data['order_id'] ?>&page_name=print_form&print=true" target="_blank" class="btn btn-primary"><i class="fa fa-print"></i> Print
                    Form </a>
            </div> -->
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
                            <h3><strong><?= $order_store_data['store_name'] ?></strong></h3>
                            <?= $order_store_data['store_address'] ?><br>
                            <?= $order_store_data['city'] ?> (<?= $order_store_data['state'] ?>)<br>
                            <abbr title="Phone">P:</abbr> +91-<?= $order_store_data['mobile'] ?>
                        </address>
                    </div>
                    <div class="col-sm-6 text-right">
                        <h4>Invoice No.</h4>
                        <h4 class="text-navy">INV-<?= $order_data['order_id'] ?></h4>
                        <!-- <span>To:</span>
                        <address>
                            <strong>Corporate, Inc.</strong><br>
                            112 Street Avenu, 1080<br>
                            Miami, CT 445611<br>
                            <abbr title="Phone">P:</abbr> (120) 9000-4321
                        </address> -->
                        <p>
                            <span><strong>Loan
                                    Date :</strong>
                                <?= date("d/m/Y", strtotime($order_data['loan_date']))  ?></span><br>
                            <span><strong>Due
                                    Date :</strong>
                                <?= date_convertor(loan_last_date($order_data['loan_date'], $order_data['loan_period_month']), 'd/m/Y') ?>
                            </span>
                        </p>
                    </div>
                </div>
                <hr>
                <div class="container">
                    <div class="row">
                        <div class="col-sm col-md-3">
                            <h3>Customer Name :
                                <br>ऋण ग्राहक नाम :
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b><?= strtoupper($client_data['name']) ?> <br><?php echo $client_data['name_hindi']; ?> </b>
                        </div>
                        <div class="col-sm col-md-3">
                            <h3>Father/Husband Name :
                                <br>पिता/पति का नाम :
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b> <?= strtoupper($client_data['father_name']) ?> <br> <?php echo $client_data['father_name_hindi']; ?></b>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm col-md-3">
                            <h3>Mobile No:
                                <br>मोबाइल नंबर :
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b><?= strtoupper($client_data['mobile']) ?>
                            </b>
                        </div>
                        <div class="col-sm col-md-3">
                            <h3>Full Address :
                                <br>पूरा पता :
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b> <?= strtoupper($client_data['address']) ?> <?= strtoupper($client_data['city']) ?>
                                (<?= strtoupper($client_data['state']) ?>)
                                <br>
                                <?php echo $client_data['address_hindi'] ?> <?php echo $client_data['city_hindi'] ?> (<?php echo $client_data['state_hindi'] ?>)
                            </b>
                        </div>
                    </div>
                   
                </div>
                <hr>
                <center>
                    <h3>Narration Details</h3>
                    <!-- <b> ऋण ग्राहक द्वारा रखे गए ऋण आभूषण रखने की जानकारी</b> -->
                </center>
                <style>
                </style>
               
                <div class="table-responsive m-t">
                    <table class="table invoice-table table-bordered solid">
                        <thead>
                            <tr>
                                <th>Narration Id</th>
                                <th>Narration Type</th>
                                <th>Narration Text</th>  
                                <th>Date/Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                             
                            foreach ($narration_data as $key => $narration) {
                               
                            ?>
                                <tr id=" row_<?= $narration['narration_id'] ?>" class="form-group">
                                    <td>
                                        <p><?= $narration['narration_id'] ?></p>
                                    </td> 
                                    <td>
                                        <p><?= $narration['narration_type'] ?></p>
                                    </td>
                                    <td>
                                        <p><?= $narration['narration_text'] ?></p>
                                    </td>
                                    <td>
                                        <p><?= date('d-m-Y h:i:s A', strtotime($narration['created_on'])); ?></p>
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
                        <thead style="text-align: center;">
                            <tr>
                                <th>Narration Type</th>
                                <th>Narration Text</th> 
                                <th>Submit</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td> 
                                <input class="form-control" type="text" id="narration_type" value="">
                                </td>
                               
                                <td>
                                    <input class="form-control" type="text" id="narration_text" value="">
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
        var narration_type = $("#narration_type").val()
        var narration_text = $("#narration_text").val() 
        if (narration_type == '') {
            alert("Please insert Narration Properly")
            return false;
        }
        if (narration_text == '') {
            alert("Please insert Narration Text")
            return false;
        }
        var sendData = {
            "narration_type": narration_type,
            "narration_text": narration_text, 
            "order_id": order_id, 
        }
        const res = sendAjax("ajax/insertNarrationData", sendData);
        notify(res.status, res.msg);
        if (res.staus == "success") {
            window.location.reload();
        }
    }
    $("#closeButton").on("click", function() {
        // location.reload(true);
        window.location.reload();
    });
</script>
<?php if (!$print) { ?>
<?php include('footer.php');
} ?>