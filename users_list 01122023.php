<?php
include('include/config.php');
$_GET=sanatize($_GET);
$_POST=sanatize($_POST);
$total_pages=1;
$show_is_employee=$_GET['page_name']=='employee'?true:false;
$show_is_investor=$_GET['page_name']=='investor'?true:false;
$show_is_client=$_GET['page_name']=='client'?true:false;
$usertype=$_GET['page_name'];
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
if($_SESSION['user_type']!='admin')
{
    invalid();
}
include('header.php');
$page_title=$_GET['page_name']." List";
if(isset($_GET['id']))
{
  $surveyor_data=get_data('user_tbl',"id='".$_GET['id']."'");
}
else
{   
    // $where="user_type='".$usertype."'";
    $where="user_type='".$usertype."' AND store_id='".$_SESSION['user_data']['store_id']."'";
    
    // if($usertype!='employee' AND  $usertype!='investor')
    // {
    //     invalid();
    // }
    $user=get_data_pagination('user_tbl',$where,$page_no,"order by id desc");  
    $user_data=$user['data'];
    $total_pages=$user['total_pages'];
}


?>

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-md-10">
        <h2>Manage <?= ucfirst($page_title);?></h2>
        <ol class="breadcrumb">

            <li class="breadcrumb-item">
                <a href="dashboard.php?page_name=dashboard">Main Cateogeory</a>
            </li>
            <li class="breadcrumb-item active">
                <strong><?= ucfirst($page_title); ?></strong>
            </li>


        </ol>
    </div>
    <div class="col-md-2 mt-2">
        <h2></h2>
        <ol class="breadcrumb">
            <li style="float:right;" class="breadcrumb-item active">
                <a style="color:white;"
                    href="create_user?page_name=<?= $_GET['page_name'] ?>&create_user_type=<?= $_GET['page_name'] ?>"
                    class="btn btn-sm btn-info"> Create <?= $_GET['page_name'] ?></a>
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
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <?php if($show_is_employee){?>
                                <th>Username</th>
                                <th>Password</th>
                                <?php }  ?>
                                <th>Joining Date</th>
                                <th>Action</th>
                            </tr>


                        </thead>
                        <tbody>

                            <?php $no=1; foreach ($user_data as $key => $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['name']?></td>
                                <td><?= $data['email']?$data['email']:"Not Inserted"?></td>
                                <td><?= $data['mobile']?$data['mobile']:"Not Inserted" ?></td>
                                <?php if($show_is_employee){?>
                                <td><?= $data['username']?></td>
                                <td><?= $data['password']?></td>
                                <?php }  ?>

                                <td><?= $data['create_date']?></td>
                                <td>
                                    <a href="create_user?id=<?= $data['id'] ?>&page_name=<?= $_GET['page_name'] ?>&create_user_type=<?= $_GET['page_name'] ?>" style="color:white;"
                                        class="btn btn-success btn-sm">Edit</a>
                                </td>
                            </tr>
                            <?php } ?>

                        </tbody>

                        <tr>
                            <td colspan="12" class="footable-visible">
                                <ul class="pagination float-right">
                                    <li class="footable-page-arrow disabled"><a data-page="first"
                                            href="surveyor_list?page_name=client&list_type=client&page_no=1">First</a>
                                    </li>
                                    <?php if(isset($_GET['page_no']))
                                           {
                                            $page_no=$_GET['page_no'];
                                            if($page_no<=0)
                                            {
                                                $page_no=1;
                                            }
                                           } 
                                           else
                                           {
                                            $page_no=2;
                                           }
                                           ?>
                                    <li class="footable-page-arrow disabled"><a data-page="prev"
                                            href="surveyor_list?page_name=client&list_type=client&page_no=<?= ($page_no-1); ?>">
                                            <!-- ‹ -->Previous
                                        </a></li>

                                    <?php for ($i=1; $i <=$total_pages ; $i++) {  ?>


                                    <li class="footable-page <?php if($i==$page_no) echo"active";  ?>"><a data-page="0"
                                            href="surveyor_list?page_name=client&list_type=client&page_no=<?= $i?>"><?= $i ?></a>
                                    </li>
                                    <?php } ?>
                                    <?php if($page_no>=$total_pages)
                                            {
                                              $page_no=$page_no-1;
                                            }   
                                            ?>

                                    <li class="footable-page-arrow"><a data-page="next"
                                            href="surveyor_list?page_name=client&list_type=client&page_no=<?= ($page_no+1); ?>">Next</a>
                                    </li>

                                    <li class="footable-page-arrow"><a data-page="last"
                                            href="surveyor_list?page_name=client&list_type=client&page_no=<?= $total_pages ?>">Last</a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </table>
                </div>

            </div>
        </div>
    </div>
</div>


<?php include('footer.php'); ?>