<?php
include('include/config.php');
$_GET=sanatize($_GET);
$_POST=sanatize($_POST);
include('header.php');
?>

            <div class="row wrapper border-bottom white-bg page-heading">

                <div class="col-sm-4">
                    <h2><?= ucfirst(label_name($_GET['page_name']));?></h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard.php?page_name=dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong><?= $_SESSION['name']; ?> (<?= $_SESSION['usercode']?>)</strong>
                        </li>
                    </ol>
                </div>
            </div> 

         
<?php include('footer.php'); ?>