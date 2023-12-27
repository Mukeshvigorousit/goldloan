<?php
include('include/config.php');
$_GET = sanatize($_GET);
$_POST = sanatize($_POST);

//  $loadbytype=get_loan_by_loan_type();
// $data=get_data("order_tbl ","item_id=1",'','sum(loan_amount) as total_loan,sum(totalPrincipalReceived) as total_recived, (sum(loan_amount)-sum(totalPrincipalReceived) ) as total_remaing');





$orderIdArray = [];
$investor_list = get_data("user_tbl", "user_type='investor'");

$reportType = $_GET['report_type'];

$totalPrincipalReceivedByClient = 0;
$totalPrincipalReceivedByInvestor = 0;
$totalPrincipalPayToClient = 0;
$totalInterestReceiveFromClient = 0;
$totalInterestPayToInvestor = 0;
$totalInterestTillDate = 0;

$totalPrincipalReceivedFromInvestor = 0;
$totalInvestorIntrestPay = 0;
$totalPrincipalPayToInvestor = 0;
$totalprofit=0;



$order = get_data("order_tbl", "is_finish=0");

foreach ($order as $key => $value) {
    

    $totalPrincipalReceivedByClient += $value['totalPrincipalReceived'];
    $totalPrincipalReceivedByInvestor += $value['totalPrincipalReceivedFromInvestor'];
    $totalPrincipalPayToClient += $value['loan_amount'];
    $totalInterestReceiveFromClient += $value['totalInterestReceived'];
    $totalInterestPayToInvestor += $value['totalInvestorIntrestPay'];
    $totalInterestTillDate += $value['totalInterestTillDate'];

    $totalPrincipalReceivedFromInvestor += $value['totalPrincipalReceivedFromInvestor'];
    $totalInvestorIntrestPay += $value['totalInvestorIntrestPay'];
    $totalPrincipalPayToInvestor += $value['totalPrincipalPayToInvestor'];

    $invester_order_data = get_data("assign_investor_list", "order_id='".$value['order_id']."'",'s'); 
     
if (isset($value['totalInterestTillDate'], $invester_order_data['totalInterestTillDate'])) { 
    $value['totalprofit'] = $value['totalInterestTillDate'] - $invester_order_data['totalInterestTillDate']; 
    $totalprofit += $value['totalprofit'];
} else { 
    $value['totalprofit'] = 0;
}
$order[$key] = $value;

 
}
 

include('header.php');
?>

<div class="row wrapper border-bottom white-bg page-heading">

    <div class="col-sm-4">
        <h2><?= ucfirst($_GET['page_name']); ?></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="dashboard.php?page_name=dashboard">Dashboard</a>
            </li>
            <li class="breadcrumb-item active">
                Report Management
            </li>
        </ol>
    </div>

</div>


<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">


            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Order Id</th>
                                <th>Client Name</th>
                                <th>Purity Checked By</th>
                                <th>Loan Amount</th>
                                <th>Loan Interest</th>
                                <th>Total Interest Till Today</th>
                                <th>Interest Received</th>
                                <th>Principal Received</th>
                                <th>Total Amount Taken From Customer</th>
                                <th>Principal Recieved From Investor</th>
                                <th>Interest Pay To Investor</th>
                                <th>Principal Pay To Investor</th>
                                <th>Total Profit</th> 
                            </tr> 

                        </thead>
                        <tbody>



                            <?php $no = 1;
                            foreach ($order as $key => $data) {   ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['order_id'] ?></td>
                                    <td><?= $data['client_name'] ?></td>
                                    <td><?= $data['purity_checked_by'] ?></td>
                                    <td><?= $data['loan_amount'] ?></td>
                                    <td><?= $data['loan_interest'] ?></td>
                                    <td><?= $data['totalInterestTillDate'] ?></td>
                                    <td><?= $data['totalInterestReceived'] ?></td>
                                    <td><?= $data['totalPrincipalReceived'] ?></td>
                                    <td style="font-weight:bold; color:green"><?=
                                     ($data['loan_amount'] - $data['totalPrincipalReceived'] + $data['totalInterestTillDate'] - $data['totalInterestReceived'])
                                      ?></td>
                                    <td><?= $data['totalPrincipalReceivedFromInvestor'] ?></td>
                                    <td><?= $data['totalInvestorIntrestPay'] ?></td>
                                    <td><?= $data['totalPrincipalPayToInvestor'] ?></td>
                                    <td><?= $data['totalprofit'] ?></td>
                                </tr>
                            <?php } ?>

                        </tbody>


                        <tfoot style="background-color:pink">

                            <tr>
                                <th>Grand Total</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th><?= $totalPrincipalPayToClient  ?></th>
                                <th></th>
                                <th><?= $totalInterestTillDate ?></th>
                                <th><?= $totalInterestReceiveFromClient ?></th>
                                <th><?= $totalPrincipalReceivedByClient ?></th>
                                <th>
                                    <?= $totalPrincipalPayToClient + $totalInterestTillDate - $totalInterestReceiveFromClient - $totalPrincipalReceivedByClient
                                    ?>
                                </th>
                                <th><?= $totalPrincipalReceivedFromInvestor ?></th>
                                <th><?= $totalInvestorIntrestPay ?></th>
                                <th><?= $totalPrincipalPayToInvestor ?></th>
                                <th><?= $totalprofit ?></th>
                            </tr>

                        </tfoot>

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">


            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Total Customer</th>
                                <th>Loan Type</th> 
                                <th>Total Loan Amount</th>
                                <th>Total Loan Amount Received</th>
                                <th>Total Loan Amount Pending</th>
                            </tr>


                        </thead>
                        <tbody>

                            <?php

                            $loanbytype = get_loan_by_loan_type();
                           
                        
                            $no = 1;
                            foreach ($loanbytype as $key => $data) {
                           
                            ?>
                                <tr>
                                    <td><?= $no  ?></td>
                                    <td><?= $data['total_customer']  ?></td>
                                    <td><?= $key  ?></td> 
                                    <td><?= $data['total_loan']  ?></td>
                                    <td><?= $data['total_recived']  ?></td>
                                    <td><?= $data['total_remaing']  ?></td> 

                                </tr>

                            <?php
$no++;
                            }
                            ?>





                        </tbody>


                        <!-- <tfoot style="background-color:pink">

                            <tr>
                                <th>Grand Total</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>

                            </tr>

                        </tfoot> -->

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<?php include('footer.php'); ?>