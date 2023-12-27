<?php
include('include/config.php');
$_GET=sanatize($_GET);
$_POST=sanatize($_POST);
extract($_GET);
include('header.php');
$page_title="Claim Intimation";
$dealer_list=get_data('dealer',surveyor_where());
if(!isset($_GET['id']))
{
$table_data=column_names('claim_tbl')['table'];   
}
else
{
  $table_data=$claim_data=get_data('claim_tbl',"claim_id='".$_GET['id']."'",'s');
}

$count=count_data('claim_pic_tbl',"claim_id='".$_GET['id']."'");
if($count==0)
{
    $pic_data=$table_data=column_names('claim_pic_tbl')['table'];   
}
else
{
    $pic_data=get_data('claim_pic_tbl',"claim_id='".$_GET['id']."'",'s');
}
?>

<style type="text/css">
    hr{
        background-color:green ;
    }

    .col-form-label {
    padding-top: calc(0.375rem + 1px);
    padding-bottom: calc(0.375rem + 1px);
    margin-bottom: 0;
    font-size: inherit;
    line-height: 1.5;
    font-weight: bold !important;
}

</style>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-12">
                    <h2><?= ucfirst('Upload Claim Pics');?></h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard.php?page_name=dashboard"><?= $page_title ?></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong><?= ucfirst($page_title); ?></strong>
                        </li>
                        <li class="breadcrumb-item">
                            <a href="print_photo?id=<?= $table_data['claim_id'] ?>&claim_no=<?= $table_data['claim_id'] ?>&photo=1" target='_blank' class="btn btn-primary"><i class="fa fa-print"></i> Print Photos </a>
                          
                        </li>
                        
                    </ol>
                </div>
            </div>

            <br> 
            <br> 
           <form action="model/upload_pic" method="POST" enctype="multipart/form-data" id="form" name="form">
            <center>
            <div class="row">
                  <div class="col-lg-12">
                        <div class="ibox-content">

                                  <center>
                                    <hr>
                                    <label class="col-lg-12"><h4>Upload Initial Pic</h4></label>
                                    <hr>
                                  </center>

                                <div class="form-group row">

                                    <label class="col-lg-2 col-form-label">Initial Pic 1</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="before_pic1">  
                                    </div>
                                    <div class="col-lg-2">
                                             <?php 
                                    if($pic_data['before_pic1'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['before_pic1'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['before_pic1'].'" download> Download </a> ';
                                    }
                                     ?>
                                    </div>

                                   

                                    <label class="col-lg-2 col-form-label">Initial Pic 2</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="before_pic2">  
                                    </div> 
                                    <div class="col-lg-2">
                                             <?php 
                                    if($pic_data['before_pic2'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['before_pic2'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['before_pic2'].'" download> Download </a> ';
                                    }
                                     ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Initial Pic 3</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="before_pic3">  
                                    </div>

                                    <div class="col-lg-2">
                                             <?php 
                                    if($pic_data['before_pic3'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['before_pic3'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['before_pic3'].'" download> Download </a> ';
                                    }
                                     ?>
                                    </div>

                                    <label class="col-lg-2 col-form-label">Initial Pic 4</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="before_pic4">  
                                    </div> 
                                    <div class="col-lg-2">
                                             <?php 
                                    if($pic_data['before_pic4'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['before_pic4'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['before_pic4'].'" download> Download </a> ';
                                    }
                                     ?>
                                    </div>
                                </div>

                                <center>
                                    <hr>
                                    <label class="col-lg-12"><h4>Chasis And Engine Pic</h4></label>
                                    <hr>
                                  </center>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Chasis Pic</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="  chasis_no_pic">  
                                    </div>

                                    <div class="col-lg-2">
                                             <?php 
                                    if($pic_data['chasis_no_pic'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['chasis_no_pic'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['chasis_no_pic'].'" download> Download </a> ';
                                    }
                                     ?>
                                    </div>

                                    <label class="col-lg-2 col-form-label">Engine Pic</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="engine_no_pic">  
                                    </div> 
                                     <?php 
                                    if($pic_data['engine_no_pic'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['engine_no_pic'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['engine_no_pic'].'" download> Download </a> ';
                                    }
                                     ?>
                                </div>
                                 

                                  <center>
                                    <hr>
                                    <label class="col-lg-12"><h4>After Repair Pic</h4></label>
                                    <hr>
                                  </center>
                                 


                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">After Pic 1</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="after_pic1">  
                                    </div>

                                     <?php 
                                    if($pic_data['after_pic1'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['after_pic1'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['after_pic1'].'" download> Download </a> ';
                                    }
                                     ?>

                                    <label class="col-lg-2 col-form-label">After Pic 2</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="after_pic2">  
                                    </div> 

                                    <?php 
                                    if($pic_data['after_pic2'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['after_pic2'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['after_pic2'].'" download> Download </a> ';
                                    }
                                     ?>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">After Pic 3</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="after_pic3">  
                                    </div>

                                    <?php 
                                    if($pic_data['after_pic3'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['after_pic3'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['after_pic3'].'" download> Download </a> ';
                                    }
                                     ?>

                                    <label class="col-lg-2 col-form-label">After Pic 4</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="after_pic4">  
                                    </div> 
                                    <?php 
                                    if($pic_data['after_pic4'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['after_pic4'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['after_pic4'].'" download> Download </a> ';
                                    }
                                     ?>
                                </div>

                                 <center>
                                    <hr>
                                    <label class="col-lg-12"><h4>Salvage Pic And Selfie</h4></label>
                                    <hr>
                                  </center>


                               
                                

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Salvage Pic</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="  salvage_pic">  
                                    </div>
                                    <?php 
                                    if($pic_data['salvage_pic'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['salvage_pic'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['salvage_pic'].'" download> Download </a> ';
                                    }
                                     ?>

                                    <label class="col-lg-2 col-form-label">Selfie Pic</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="selfie_pic">  
                                    </div> 

                                    <?php 
                                    if($pic_data['selfie_pic'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['selfie_pic'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['selfie_pic'].'" download> Download </a> ';
                                    }
                                     ?>
                                </div>

                                 <center>
                                    <hr>
                                    <label class="col-lg-12"><h4>Parts Pic</h4></label>
                                    <hr>
                                  </center>


                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Parts Pic 1</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="pic_1">  
                                    </div>

                                     <?php 
                                    if($pic_data['pic_2'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_2'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_2'].'" download> Download </a> ';
                                    }
                                     ?>


                                    <label class="col-lg-2 col-form-label">Parts Pic 2</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="pic_2">  
                                    </div> 

                                     <?php 
                                    if($pic_data['pic_3'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_3'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_3'].'" download> Download </a> ';
                                    }
                                     ?>

                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Parts Pic 3</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="pic_3">  
                                    </div>

                                     <?php 
                                    if($pic_data['pic_3'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_3'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_3'].'" download> Download </a> ';
                                    }
                                     ?>

                                    <label class="col-lg-2 col-form-label">Parts Pic 4</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="pic_4">  
                                    </div> 

                                     <?php 
                                    if($pic_data['pic_4'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_4'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_4'].'" download> Download </a> ';
                                    }
                                     ?>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Parts Pic 5</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="pic_5">  
                                    </div>
                                     <?php 
                                    if($pic_data['pic_5'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_5'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_5'].'" download> Download </a> ';
                                    }
                                     ?>

                                    <label class="col-lg-2 col-form-label">Parts Pic 6</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="pic_6">  
                                    </div>

                                     <?php 
                                    if($pic_data['pic_6'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_6'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_6'].'" download> Download </a> ';
                                    }
                                     ?> 
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Parts Pic 7</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="pic_7">  
                                    </div>

                                     <?php 
                                    if($pic_data['pic_7'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_7'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_7'].'" download> Download </a> ';
                                    }
                                     ?>

                                    <label class="col-lg-2 col-form-label">Parts Pic 8</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="pic_8">  
                                    </div> 

                                     <?php 
                                    if($pic_data['pic_8'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_8'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_8'].'" download> Download </a> ';
                                    }
                                     ?>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Parts Pic 9</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="pic_9">  
                                    </div>

                                     <?php 
                                    if($pic_data['pic_9'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_9'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_9'].'" download> Download </a> ';
                                    }
                                     ?>

                                    <label class="col-lg-2 col-form-label">Parts Pic 10</label>
                                    <div class="col-lg-2">
                                            <input class="form-control" type="file" name="pic_10">  
                                    </div> 

                                     <?php 
                                    if($pic_data['pic_10'])
                                    {
                                        echo '<img download style="height:120px; width:80px;" src="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_10'].'" /><br> <a href="img/claim/'.$table_data['claim_no'].'/'.$pic_data['pic_10'].'" download> Download </a> ';
                                    }
                                     ?>
                                </div>


                                <div class="form-group row">
                                    <input type="hidden" name="claim_id" value="<?= $_GET['id'] ?>">
                                    <div class="col-lg-6">
                                            <button class="btn btn-info" value="submit">Submit</button>  
                                    </div>                 
                                </div>
            </div>
           
          </form>
</center>
          <br>
          <br>

              
<?php include('footer.php'); ?>