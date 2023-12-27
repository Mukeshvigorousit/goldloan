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
    $new_query_string = http_build_query($query_params);
    $new_url = $_SERVER['PHP_SELF']  . '?' . $new_query_string;
    header("location:" . $new_url . "&selected_date=" . $_POST['seleted_date'] . "");
}
if (isset($_GET['selected_date'])) {
    $selected_date = $_GET['selected_date'];
    $order_log = get_data('order_tbl', "create_date_time BETWEEN '" . date('d-m-Y 00:00:00', strtotime($selected_date)) . "' AND '" . date('d-m-Y 23:59:59', strtotime($selected_date)) . "' ");
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
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Order Id</th>
                                <th>Item Name</th>
                                <th>Creatored By</th>
                                <th>Loan Amount</th>
                                <th>Loan Interest</th>
                                <th>Date Time</th>
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
                                        <td><?= $data['item_name'] ?></td>
                                        <td><?= $data['creator_name'] ?></td>
                                        <td><?= $data['loan_amount'] ?></td>
                                        <td><?= $data['loan_interest'] ?></td>
                                        <td><?= $data['create_date_time'] ?></td>
                                    </tr>
                            <?php }
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include('footer.php'); ?>