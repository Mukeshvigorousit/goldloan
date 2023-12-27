<?php
include('include/config.php');
$_GET=sanatize($_GET);
$_POST=sanatize($_POST);
include('header.php');
$total_customer=count_data('user_tbl',"user_type='client'");
$total_investor=count_data('user_tbl',"user_type='investor'");
$total_employee=count_data('user_tbl',"user_type='employee'");
$total_employee=count_data('user_tbl',"user_type='employee'");

// $order_data = get_data('order_tbl', "create_date_time BETWEEN '" . date('d-m-Y 00:00:00', strtotime(date('d-m-Y') . ' +2 days')) . "' AND '" . date('d-m-Y 23:59:59', strtotime(date('d-m-Y') . ' +2 days')) . "' AND warning_status=1");
$order_data = get_data('order_tbl', "warning_date='".date('Y-m-d', strtotime(date('d-m-Y') . ' +2 days'))."' AND warning_status=1");
 

$orderNo = count_data("order_tbl");
?>
          <div class="row">
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-primary float-right">Total</span>
                        </div>
                        <h5>Customer Register</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-12">
                                <h1 class="no-margins"><?= $total_customer ?></h1>
                                <div class="font-bold text-navy"><?= rand(1,99)?>% <i class="fa fa-level-up"></i> <small>Rapid pace</small></div>
                            </div>
                            <!-- <div class="col-md-6">
                                <h1 class="no-margins">206,12</h1>
                                <div class="font-bold text-navy">22% <i class="fa fa-level-up"></i> <small>Slow pace</small></div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-success float-right">Total</span>
                        </div>
                        <h5>Investor</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="no-margins"><?= $total_investor ?></h1>
                                <div class="font-bold text-navy"><?= rand(1,99)?>% <i class="fa fa-level-up"></i> <small>Rapid pace</small></div>
                            </div>
                            <!-- <div class="col-md-6">
                                <h1 class="no-margins">206,12</h1>
                                <div class="font-bold text-navy">22% <i class="fa fa-level-up"></i> <small>Slow pace</small></div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-danger float-right">Total</span>
                        </div>
                        <h5>Running Order</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            <div class="col-md-6">
                                <h1 class="no-margins"><?= $orderNo ?></h1>
                                <div class="font-bold text-navy"><?= rand(1,99)?>%<i class="fa fa-level-up"></i> <small>Rapid pace</small></div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>

            
            
        </div>

        <div class="row">
        <div class="col-lg-8">
                <div class="ibox ">
                    <div class="ibox-title">
                        <div class="ibox-tools">
                            <span class="label label-danger float-right">Total</span>
                        </div>
                        <h5>Warning Order</h5>
                    </div>
                    <div class="ibox-content">

                        <div class="row">
                            
                            <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example " wi>
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>order Id</th>
                                <th>Client Name</th>
                                <th>Mobile</th>
                                <th>Address</th>
                                <th>Loan Amount</th>
                                <th>Loan Date</th> 
                                <th>Action</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1;
                            foreach ($order_data as $key => $data) {
                                $clintdata = get_data('user_tbl', "id='" . $data['client_id'] . "'", 's');
                            ?>
                                <tr>
                                    <td><?= $no++ ?></td>
                                    <td><?= $data['order_id'] ?></td>
                                    <td><?= $data['client_name'] ?></td>
                                    <td><?= $clintdata['mobile'] ?></td>
                                    <td><?= $clintdata['address'] ?></td>
                                    <td><?= $data['loan_amount'] ?></td>
                                    <td><?= $data['loan_date'] ?></td>
                                 
                                   
                                   
                                    <td>
                                        <a href="javascript:void(0);" style="color:white;" class="btn btn-danger btn-sm" onclick="close_warning(<?= $data['order_id'] ?>)">Close Warning</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>


                               
                            
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>



 
                
    

 

       

         
<?php include('footer.php'); ?>

<script>
        function close_warning(id) {
        

        Swal.fire({
            title: "Do you want to Close Warning ?",
            showCancelButton: true,
            confirmButtonText: "Close",
            icon: 'warning'
        }).then((result) => {
            if (result.isConfirmed) {

        



                  var sendData = {
                    "order_id": id,
                }
                const res = sendAjax("ajax/update_warning", sendData);
                notify(res.status, res.msg);
                
                if (res.staus == "success") {
                    Swal.fire("Deleted!", "", "success").then(() => {
                        window.location.reload();
                    });
                } else {
                    window.location.reload();
                }

            }

        }); 
        
        


        



    } 
</script>