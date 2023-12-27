<!DOCTYPE html>
<html>
    <meta http-equiv="content-type" content="text/html;charset=utf-8" />

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title><?= isset($store_data['store_name'])?$store_data['store_name']:'Gold Erp' ?></title>
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="font-awesome/css/font-awesome.css" rel="stylesheet">
        <link href="css/animate.css" rel="stylesheet">
        <link href="css/style.css" rel="stylesheet">
        <!-- Toastr style -->
        <link href="css/plugins/toastr/toastr.min.css" rel="stylesheet">

        <!-- Gritter -->
        <link href="js/plugins/gritter/jquery.gritter.css" rel="stylesheet">
        <link href="css/plugins/select2/select2.min.css" rel="stylesheet">
        <link href="css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
        <link href="css/plugins/textSpinners/spinners.css" rel="stylesheet">
        <script src="js/socket.io.js"></script>
        <style type="text/css">
        .marquee {
            width: 100%;
            overflow: hidden;
            border: 0px solid #ccc;
            background: #1FABB5;
            color: #fff;
            padding: 5px 1px;
            margin-right: 15%;
            margin-bottom: 13px;
        }
        
        .loader {
    z-index: 9;
    position: fixed;
    
    top: 40%;
    left: 50%;
    
}

.loader img {
    border-radius: 50%;
    width: 50%;
    height: 100%;
    animation: spin 1s linear infinite;
}

 
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}

        </style>
        <script src="js/jquery-3.1.1.min.js"></script>
    </head>

    <body class="fixed-sidebar">
        <div id="wrapper">
            <nav class="navbar-default navbar-static-side" role="navigation">
                <div class="sidebar-collapse">
                    <ul class="nav metismenu" id="side-menu">
                        <li class="nav-header">
                            <div class="dropdown profile-element">
                                <center>
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                        <span class="block m-t-xs font-bold"><?= strtoupper($userdata['name']) ?></span>
                                        <span class="text-muted text-xs block"><?= $_SESSION['user_type'] ?><b
                                                class="caret"></b></span>
                                    </a>
                                </center>
                                <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                    <li><a class="dropdown-item" href="#">Profile</a></li>
                                    <!-- <li><a class="dropdown-item" href="#">Contacts</a></li> -->
                                    <li><a class="dropdown-item" href="logout">Logout</a></li>
                                </ul>
                            </div>
                            <div class="logo-element">
                                <?= site_name ?>
                            </div>
                        </li>


                        <li class="<?= active('home'); ?>">
                            <a href="home?page_name=home"><i class="fa fa-tachometer" aria-hidden="true"></i> <span
                                    class="nav-label ">Dashboard</span></a>
                        </li>


                        <?php if($is_superadmin){?>

                        <li class="<?= active('store'); ?>">
                            <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Store
                                    Management</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level" aria-expanded="true">
                                <li class="<?= active('store'); ?>"><a href="store_list?store_type=store">Manage
                                        Store</a></li>

                            </ul>
                        </li>
                        <?php  } ?>

                        <li class="<?= active('branch'); ?> ">
                            <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Receipt
                                    Management</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level" aria-expanded="true">
                                <li> <a href="#"  data-toggle="modal" data-target="#debitcreditamount">Deposite Prinicple Instrest</a> </li>
                                <li> <a href="#"  data-toggle="modal" data-target="#loanclose">Loan Close</a> </li> 
                                <li> <a href="users_list?page_name=investor&page_no=1">Investor Ledger</a></li>
                                <li> <a href="users_list?page_name=investor&page_no=1">Net Profit</a></li> 
           
                            </ul>
                        </li>



                        <?php  if($is_admin){?>
                        <li class="<?= active('branch'); ?> ">
                            <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Branch
                                    Management</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level" aria-expanded="true">
                                <li><a href="create_store?store_type=branch&page_name=branch">Create Branch</a></li>
                                <li><a href="store_list?store_type=branch&page_name=branch">Branch List</a></li>
                                <!-- <li><a href="create_branch">Assign Branch Manager</a></li> -->
                            </ul>
                        </li>
                        <li class="<?= active('userlog'); ?> ">
                            <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Log
                                    Management</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level" aria-expanded="true">
                            <li><a href="userlog?log_type=userWise&page_name=userlog">Order Wise Report</a></li>
                                <!-- <li><a href="userReport?log_type=userWise&page_name=report2">User Wise Report</a></li> -->
                                <!-- <li><a href="create_branch">Assign Branch Manager</a></li> -->
                            </ul>
                        </li>
                        <li class="<?= active('packet_approval'); ?> ">
                            <a href="index.html"><i class="fa fa-th-large"></i> <span class="nav-label">Packet
                                    Management</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level" aria-expanded="true">
                            <li><a href="packet_approval?log_type=packetApproval&page_name=packet_approval">Packet Report</a></li>
                                <!-- <li><a href="userReport?log_type=userWise&page_name=report2">User Wise Report</a></li> -->
                                <!-- <li><a href="create_branch">Assign Branch Manager</a></li> -->
                            </ul>
                        </li>




                        <li class="<?= active('investor'); ?>">
                            <a href="users_list?page_name=investor&page_no=1">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="nav-label ">Investor Manager</span>
                            </a>
                        </li>

                        <li class="<?= active('employee'); ?>">
                            <a href="users_list?page_name=employee&page_no=1">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span class="nav-label ">Employee Manager</span>
                            </a>
                        </li>
                        <?php } ?>


                        

                        <li class="<?= active('client'); ?>">
                            <a href="users_list?page_name=client&page_no=1">
                                <i class="fa fa-users" aria-hidden="true"></i>
                                <span class="nav-label ">Client Manager</span>
                            </a>
                        </li>


                        <li class="<?= active('create_order'); ?>">
                            <a href="create_order?page_name=create_order" data-method="get"><i class="fa fa-book"
                                    aria-hidden="true"></i>
                                <span class="nav-label">Create Order</span>
                            </a>
                        </li>

                        <li class="<?= active('order_list'); ?>">
                            <a href="order_list?page_name=order_list" data-method="get"><i class="fa fa-book"
                                    aria-hidden="true"></i>
                                <span class="nav-label">Order List</span>
                            </a>
                        </li>

                         <li class="<?= active('report'); ?> ">
                            <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">Report
                                    Management</span> <span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level" aria-expanded="true">
                                <li><a href="report?report_type=orderWise&page_name=report">Order Wise Report</a></li>
                                <li><a href="investorReport?report_type=investorWise&page_name=report">Investor Wise Report</a></li>
                                 
                                
                                
                            </ul>
                        </li>

                    </ul>

                </div>
            </nav>
            <div class="loader" style="display: none;">
    <img src="img/loader.gif" alt="Loading...">
</div>
            <div id="page-wrapper" class="gray-bg">
                <div class="row border-bottom">
                    <nav class="navbar navbar-static-top  " role="navigation" style="margin-bottom: 0">
                        <div class="navbar-header">
                            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary " href="#"><i
                                    class="fa fa-bars"></i> </a>
                        </div>
                        <ul class="nav navbar-top-links navbar-right">
                            <li>
                                <span
                                    class="m-r-sm text-muted welcome-message"><?=  isset($store_data['store_name'])?$store_data['store_name']:'Superadmin' ?>
                                </span>
                            </li>
                            <li>
                                <a href="logout">
                                    <i class="fa fa-sign-out"></i> <b>Sign Out</b>
                                </a>
                            </li>
                        </ul>

                    </nav>
                </div>