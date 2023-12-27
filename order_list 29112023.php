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
if(isset($_GET['id']))
{
  $order_data=get_data('order_tbl',"order_id='".$_GET['order_id']."' group by order_id DESC");
}
else
{   
    $where="1=1";
    // $where =$where. " AND store_id='".$store_data['store_id']."'";
     $where =$where. " AND store_id='".$store_data['store_id']."' AND status='1'";
    $order=get_data_pagination('order_tbl',$where,$page_no,"order by order_id desc");  
    $order_data=$order['data'];
    $total_pages=$order['total_pages'];
}




?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-10">
        <h2>Manage Order</h2>
        <ol class="breadcrumb">

            <li class="breadcrumb-item">
                <a href="dashboard.php?page_name=dashboard">Main Cateogeory</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Order List</strong>
            </li>


        </ol>
    </div>
    <div class="col-md-2 mt-2">
        <h2></h2>
        <ol class="breadcrumb">
            <li style="float:right;" class="breadcrumb-item active">
                <a style="color:white;" href="create_order?page_name=create_order" class="btn btn-sm btn-info"> Create
                    Order</a>
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
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>order Id</th>
                                <th>Client Name</th>
                                <th>Loan Amount</th>
                                <th>Loan Date</th>
                                <!-- <th>Investor Name</th> -->
                                <th>Item Name</th>
                                <th>Interest Rate</th>
                                <th>Loan Tenuare</th>
                                <th>Assign Item</th>
                                <th>Assign Investor</th>
                                <th>Receipt</th>
                                <th>Download Form</th>
                                <th>Action</th>
                                 <th>Delete</th>
                            </tr>


                        </thead>
                        <tbody>

                            <?php $no=1; foreach ($order_data as $key => $data) { ?>
                            <tr>
                                <td><?= $no++?></td>
                                <td><?= $data['order_id'] ?></td>
                                <td><?= $data['client_name']?></td>
                                <td><?= $data['loan_amount']?></td>
                                <td><?= $data['loan_date']?></td>
                                <!-- <td><?= $data['investor_name']?$data['investor_name']:"Not Assign"   ?></td> -->
                                <td><?= $data['item_name']?></td>
                                <td><?= $data['loan_interest']?></td>
                                <td><?= $data['loan_period_month']?> Month</td>
                                <td>
                                    <a href="create_item?order_id=<?= $data['order_id'] ?>&page_name=create_item"
                                        style="color:white;" class="btn btn-danger btn-sm">Assign Item</a>
                                </td>
                                <td>
                                    <a href="assign_investor_to_order?order_id=<?= $data['order_id'] ?>&page_name=create_item"
                                        style="color:white;" class="btn btn-primary btn-sm">Assign Investor</a>
                                </td>
                                <td>
                                    <a href="order_details?order_id=<?= $data['order_id'] ?>&page_name=order_details"
                                        style="color:white;" class="btn btn-warning btn-sm">Order Details</a>
                                </td>

                                <td>
                                    <a href="print_form?order_id=<?= $data['order_id'] ?>&page_name=print_form"
                                        style="color:white;" class="btn btn-dark btn-sm">View Form</a>
                                </td>

                                <td>
                                    <a href="create_order?order_id=<?= $data['order_id'] ?>&page_name=create_order"
                                        style="color:white;" class="btn btn-success btn-sm">Edit</a>
                                </td>
                                   <td>
                                        <a href="javascript:void(0);" style="color:white;" class="btn btn-danger btn-sm" onclick="delete_order(<?= $data['order_id'] ?>)">Delete</a>
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


<?php include('footer.php'); ?>
<script>
    function delete_order(order_id) {
        $(".loader").css('display', 'none');
        $(".loader").hide();
        Swal.fire({
            title: "Do you want to Delete this?",

            showCancelButton: true,
            confirmButtonText: "Delete",
        }).then((result) => { 
            if (result.isConfirmed) {

                var sendData = {
                    "order_id": order_id,
                }
                const res = sendAjax("ajax/delete_order", sendData);
                notify(res.status, res.msg);
                if (res.staus == "success") {
                    Swal.fire("Deleted!", "", "success").then(() => {
                        window.location.reload();
                    });
                } else {

                    window.location.reload();
                }
            }
            else
            {
                window.location.reload();
            }
        });

    }
</script>