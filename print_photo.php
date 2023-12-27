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

unset($pic_data['pic_id']);
unset($pic_data['claim_id']);
?>


            <div class="row">
                  <div class="col-lg-12">
                        <div class="ibox-content">
                                <div class="form-group row">
                                    	<?php foreach ($pic_data as $key => $value) 
                                    	{  if($value!=''){  ?>
                                 <div class="col-sm-6">
                                   <img style="height: 600px; width:350px; margin-top: 15px;" src="img/claim/<?= $table_data['claim_no']?>/<?= $value ?>">
                                </div>    		
                                    <?php }	} ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
               

              
