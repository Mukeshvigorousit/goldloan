<?php
include('include/config.php');
$_GET=sanatize($_GET);
$_POST=sanatize($_POST);
extract($_GET);
$total_pages=1;
if($store_type=='store' && !$is_superadmin)
{
    invalid();
}

if($store_type=='branch' && !$is_admin)
{
    invalid();
}

$where="store_type='store'";

if($store_type=='branch')
{
    $where="store_type='branch'";
}




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
$page_title=$store_type." List";
if(isset($_GET['store_id']))
{
  $where=$where." AND store_id='".$_GET['store_id']."'";
  $store_data=get_data('store_tbl',$where);
}
else
{   
 
    $user=get_data_pagination('store_tbl',$where,$page_no,"order by store_id desc");  
    $store_data=$user['data'];
    $total_pages=$user['total_pages'];
}


if(!empty($store_data)){
    $store_data=convert_key_array($store_data,'store_id');
    $store_id_array=$store_data['key_array'];
    $store_data=$store_data['array_data'];
    $user_data=get_data('user_tbl',"store_id IN (".$store_id_array.") AND user_type IN ('admin','branch_manager')",'','store_id,id,name,email,mobile,city,username,password');

    if(!empty($user_data))
    {
        $user_data=convert_key_array($user_data,'store_id')['array_data'];
    }
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
                    href="create_store?store_type=<?= $_GET['store_type'] ?>&create_user_type=<?= $_GET['store_type'] ?>"
                    class="btn btn-sm btn-info"> Create <?= $store_type ?></a>
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
                                <th>S no</th>
                                <th>Name</th>
                                <th>email/mobile</th>
                                <th> <?= $store_type ?> Manager</th>

                                <th>Username</th>
                                <th>Password</th>
                                <th>Joining Date</th>
                                <th>Action</th>
                            </tr>


                        </thead>
                        <tbody>

                            <?php  $no=1; foreach ($store_data as $key => $data) { 
                                $user_name='Not Assign';
                                $user_id=0;
                                if(isset($user_data[$data['store_id']]))
                                {
                                    $user= $user_data[$data['store_id']];
                                    $user_name=$user['name'];
                                    $user_id=$user['id'];
                                }
                                ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['store_name']?></td>
                                <td><?= $data['email']?>/<br><?= $data['mobile']?></td>
                                <td><?=  isset($user['name'])?$user['name']:"" ?></td>
                                <td><?=  isset($user['username'])?$user['username']:"" ?></td>
                                <td><?=  isset($user['password'])?$user['password']:"" ?></td>
                                <td><?= $data['create_date']?></td>
                                <td>
                                    <a href="create_store?store_id=<?= $data['store_id'] ?>& store_type=<?= $data['store_type'] ?>"
                                        style="color:white;" class="btn btn-success btn-sm">Edit</a>
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