<?php
include('include/config.php');
if($_SESSION['user_type']=='owner')
{
include('match_header.php');
}
else
{
include('header.php');    
}
if(isset($_GET['self']))
{
    $_GET['id']=$_SESSION['user_id'];
    //$_GET['page_name']=trim($_SESSION['user_type']);
}

?>

            <div class="row wrapper border-bottom white-bg page-heading">

                <div class="col-sm-4">
                    <h2><?= ucfirst('<b>Change Password</b>');?></h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="index.html">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong><?= $_SESSION['name']; ?> )</strong>
                        </li>
                    </ol>
                </div>
            </div> 


            <div class="wrapper wrapper-content animated fadeInRight">
               <div class="row">
                <div class="col-lg-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Change Password</h5>
                            <div class="ibox-tools">
                               <!--  <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                                    <i class="fa fa-wrench"></i>
                                </a> -->
                                
                               <!--  <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a> -->
                            </div>
                        </div>
                        
                        <div class="ibox-content table-responsive" style="padding: 15px 20px 56px;">
                           

                            <form class="form-horizontal" action="model/update" method="POST">
                                <!-- <div class="hr-line-dashed"></div> -->
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label">NEW PASSWORD</label>
                                    <div class="col-sm-10">              
                                      <input required="required" type="password" id="user_password" name="user[password]" class="form-control login_text_field" placeholder="NEW" password="">
                                    </div>
                                </div>
                                <input id="selected" name="user[user_id]" type="hidden" value="<?= $_GET['id'] ?>">
                                <input id="selected" name="page_name" type="hidden" value="<?= $_GET['page_name'] ?>">
                                <input id="selected" name="password_update" type="hidden" value="<?= $_GET['page_name'] ?>">
                                <?php if(isset($_GET['self'])){ ?>
                                 <input id="selected" name="self" type="hidden" value="<?= $_GET['self'] ?>">
                             <?php } ?>
                                <div class="hr-line-dashed"></div>

                                <div class="form-group"><label class="col-sm-2 control-label">Confirm Password</label>
                                    <div class="col-sm-10">              
                                      <input required type="password" id="user_confirm_password"  class="form-control login_text_field" placeholder="Confirm" password="">
                                    </div>
                                </div>
                               

                                <div class="form-group">
                                    <div class="col-sm-4 col-sm-offset-2">
                                        <input type="submit" class="btn btn-primary change_password_btn" value="Save Changes" id="submit">
                                    </div>
                                </div>
                                 </form>
                        </div>
                    </div>         
                </div>
            </div>
        </div>
<script>

        $(document).ready(function(){
         $("#submit").click(function(){
            var validate=true;
  var pass = $("#user_password").val();
  var confirm_pass = $("#user_confirm_password").val();
  if(pass!=confirm_pass)
  {
    notify('error','password not matching');
  }

  return validate;
});
        });
</script>
         
<?php include('footer.php'); ?>