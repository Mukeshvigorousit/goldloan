<?php
include('include/config.php');
$_GET = sanatize($_GET);
$_POST = sanatize($_POST);
$selected_date = "";
if (isset($_POST['seleted_date'])) {
    $url = $_SERVER['REQUEST_URI'];
    $url_parts = parse_url($url);
    parse_str($url_parts['query'], $query_params);
    unset($query_params['selected_date']);
    unset($query_params['order_id']);
    $new_query_string = http_build_query($query_params);
    $new_url = $_SERVER['PHP_SELF']  . '?' . $new_query_string;
    header("location:" . $new_url . "&selected_date=" . $_POST['seleted_date'] . "");
 
}
if (isset($_POST['order_id'])) {
    $url = $_SERVER['REQUEST_URI'];
    $url_parts = parse_url($url);
    parse_str($url_parts['query'], $query_params);
    unset($query_params['order_id']);
    $new_query_string = http_build_query($query_params);
    $new_url = $_SERVER['PHP_SELF']  . '?' . $new_query_string;
    header("location:" . $new_url . "&order_id=" . $_POST['order_id'] . "");
}

if (isset($_GET['selected_date'])) {
    $selected_date = $_GET['selected_date'];
}

if(isset($_POST['update_status']))
{ 

    
 if($_POST['status']==1)
 {
    $updateArray=[
        'approval_status'=>$_POST['status'],
        'approver_id'=>$_SESSION['user_data']['id'],
        'approver_name'=>$_SESSION['name'],
    ]; 
    // update_array("assign_investor_list", $updateArray, "assign_investor_id='" . $_POST['assign_investor_id'] . "'");
 }
 else
 {
    $updateArray=[
        'approval_status'=>0,
        'approver_id'=>'',
        'approver_name'=>'',
    ]; 

 }
update_array("assign_investor_list", $updateArray, "assign_investor_id='" . $_POST['assign_investor_id'] . "'");

}

include('header.php');
?>
 
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-sm-6">
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
    <div class="col-sm-4">
        <h2></h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <form action="" class="form-inline" method="post">
                    <input name="seleted_date" id="seleted_date" type="date" value="<?= $selected_date ?>" class="form-control" max="<?php echo date('Y-m-d'); ?>">
                    <input type="submit" class="btn btn-success mx-2" value="submit">
                </form>
            </li>
        </ol>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-content">
                <?php 
if (isset($_GET['selected_date']) && !isset($_GET['order_id'])) {
    $selected_date = $_GET['selected_date'];
    $order_log = get_data('assign_investor_list', "insert_date BETWEEN '" . date('d-m-Y 00:00:00', strtotime($selected_date)) . "' AND '" . date('d-m-Y 23:59:59', strtotime($selected_date)) . "' ");

    // _dx($order_log);
 
                ?>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Order Id</th>
                                <th>Item Name</th>
                                <!-- <th>Creatored By</th> -->
                                <!-- <th>Loan Amount</th> -->
                                <!-- <th>Loan Interest</th> -->
                                <th>Date Time</th>
                                <th>Status</th>
                                <th>Packet Status</th>
                                <th>Packet Approved By</th>
                                <th>Action</th>
                          
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            if (isset($order_log)) {
                                $no = 1;
                                foreach ($order_log as $key => $data) {   ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['order_id'] ?></td>
                                        <td><?= $data['packet_name'] ?></td>
                                        <!-- <td><?= $data['creator_name'] ?></td> -->
                                        <!-- <td><?= $data['loan_amount'] ?></td> -->
                                        <!-- <td><?= $data['loan_interest'] ?></td> -->
                                        <td><?= $data['insert_date'] ?></td>
                                        <td><?= $data['status'] ?></td>
                                        <td><?= $data['approval_status']==0?'Aproval Pending':'Aproved' ?></td>
                                        <td><?= $data['approver_name']!=''?$data['approver_name']:'' ?></td>
                                        <td> 
                                        <form action="" class="form-inline" method="post">
                    <input name="order_id" id="order_id" type="hidden" value="<?= $data['order_id'] ?>" class="form-control" >
                    <input type="submit" class="btn btn-success mx-2" value="Change Status">
                </form>

                                        
                                    </td> 
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>


                <?php
                }
                if (isset($_GET['order_id'])) {

                    $order_id = $_GET['order_id'];
                    $assign_investor_data = get_data('assign_investor_list', "order_id='" .$order_id . "' ",'s');


?>
 
<form action="packet_approval.php?log_type=packetApproval&page_name=packet_approval&selected_date=<?=$selected_date?>" method="POST"  name="form" style="display:block">
    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content">

                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Order Id<code>*</code></label>
                    <div class="col-lg-4">
                        <input readonly required  type="text" value="<?=$assign_investor_data['order_id']?>" class="form-control">
                    </div>
                    <label class="col-lg-2 col-form-label">Item Name<code>*</code></label>
                    <div class="col-lg-4">

                        <input readonly  type="text" value="<?=$assign_investor_data['packet_name']?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Date <code>*</code></label>
                    <div class="col-lg-4">
                        <input readonly required  type="text" value="<?=$assign_investor_data['insert_date']?>" class="form-control">
                    </div>
                    <label class="col-lg-2 col-form-label">Status<code>*</code></label>
                    <div class="col-lg-4">

                        <input readonly  type="text" value="<?=$assign_investor_data['status']?>" class="form-control">
                    </div>
                </div>
                <div class="form-group row">
                    <label class="col-lg-2 col-form-label">Date <code>*</code></label>
                    <div class="col-lg-4">
                    <select style="width:120px !important"   name="status" colspan=4 class="select2_demo_1 col-md-12 form-control select">
                                     
                                     
                                         

                                      
                                    
                                        <option value="0"> Pending </option>
                                        <option value="1"> Approved </option>

                                      
                                 
        </select>
                    </div>
                  
                    <div class="col-lg-4">

                       
                    </div>
                </div>
                <div class="form-group row">
                    
                    <div class="col-lg-4">
                        <input type="hidden" name="assign_investor_id" value="<?=$assign_investor_data['assign_investor_id']?>">
                   <button name="update_status"  class="btn btn-success">Approved</button>
                    </div>
                  
                   
                </div>


                

 

 

        

 

                

                
                
 

                

            </div>

            



</form>
<?php
                }
                ?>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>