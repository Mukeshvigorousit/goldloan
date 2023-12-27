<?php
include('include/config.php');
$_GET=sanatize($_GET);
$_POST=sanatize($_POST);
include('header.php');
$page_title="Inventory";
$main_cateogeory=get_data('item_list',store_where());
if(!isset($_GET['id']))
{
$table_data=column_names('item_list')['table'];   
}
else
{
$table_data=get_data('item_list',store_where("item_id='".$_GET['id']."' AND deleted_status=0"),'s'); 
}

?>

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-sm-4">
                    <h2><?= ucfirst('Manage Inventory');?></h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard.php?page_name=dashboard"><?= $page_title ?></a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong><?= ucfirst($page_title); ?></strong>
                        </li>
                    </ol>
                </div>
            </div>



            <br> 
            <br> 
           <form action="model/create_inventory" method="POST" enctype="multipart/form-data" id="form" name="form">
            <div class="row">
                  <div class="col-lg-12">
                        <div class="ibox-content">

                            <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Item Code</label>
                                    <div class="col-lg-10">
                                        <?php if(isset($_GET['id'])){?>
                                            <input readonly  name="item_code" type="text" value="<?= $table_data['item_code'] ?>" class="form-control"> 

                                        <?php } else{?>
                                            <input readonly  name="item_code" type="text" value="<?= get_code() ?>" class="form-control">
                                        <?php } ?>
                                        
                                    </div>
                                </div>
                              
                                <div class="form-group row">
                                    
                                </div>

                                <div class="form-group row">
                                  <label class="col-lg-2 col-form-label">Main Cateogeory <code>*</code></label>
                                    <div class="col-lg-4">
                                      <select onchange="change()" id="main_cat_id" name="main_cat_id" class="form-control">
                                        <option value="">Select Main Cateogeory</option>
                                        <?php  foreach (get_data('cateogeory_tbl',store_where("cat_type='main'")) as $key => $value) { ?>
                                          <option <?php if($table_data['main_cat_id']==$value['cat_id']) echo "selected"; ?> value="<?= $value['cat_id'] ?>"><?= $value['cat_name'] ?></option>
                                          <?php    }  ?>
                                      </select>
                                    </div>

                                    <label class="col-lg-2 col-form-label">Sub Cateogeory <code>*</code></label>
                                    <div class="col-lg-4">
                                      <select id="sub_cat_id" name="sub_cat_id" class="form-control">
                                          <option value="">Select Sub Cateogeory</option>
                                      </select>
                                    </div>
                                </div>

                                   <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Item Name <code>*</code></label>
                                    <div class="col-lg-4"><input required  name="item_name" type="text" value="<?= $table_data['item_name'] ?>" placeholder="Item Name" class="form-control"> 
                                    </div>
                                
                                    <label class="col-lg-2 col-form-label">Opening Stock <code>*</code></label>
                                    <div class="col-lg-4"><input required  name="starting_stock" type="text" value="<?= $table_data['starting_stock'] ?>" placeholder="Opening Stock" class="form-control"> 
                                    </div>
                                </div>




                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Cost Price <code>*</code></label>
                                    <div class="col-lg-4"><input required  name="item_cp" type="number" value="<?= $table_data['item_cp'] ?>" placeholder="Cost price" class="form-control"> 
                                    </div>
                                
                                    <label class="col-lg-2 col-form-label">Selling Price <code>*</code></label>
                                    <div class="col-lg-4"><input required  name="item_sp" type="text" value="<?= $table_data['item_sp'] ?>" placeholder="Selling Price" class="form-control"> 
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Gst<code>*</code></label>
                                    <div class="col-lg-4">
                                            <select class="form-control" name="is_gst">
                                                <option value="0">No</option>
                                                <option value="1">Yes</option>
                                            </select>
                                    </div>
                                
                                    <label class="col-lg-2 col-form-label">Gst % <small style="color:red;">(if gst yes)</small></label>
                                    <div class="col-lg-4"><input required  name="c_gst" type="text" value="<?= $table_data['c_gst'] ?>" placeholder="Gst Slab %" class="form-control"> 
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">One Click</label>
                                    <div class="col-lg-4">
                                            <select class="form-control" name="one_click_item">
                                                <option <?php if($table_data['one_click_item']==1) echo "selected"; ?> value="1">Active</option>
                                                <option <?php if($table_data['one_click_item']==0) echo "selected"; ?> value="0">Inactive</option>
                                            </select>
                                    </div>
                                
                                    <label class="col-lg-2 col-form-label">Priority <code>*</code></label>
                                    <div class="col-lg-4"><input required  name="priority" type="text" value="<?= $table_data['priority'] ?>" placeholder="Showing Priority" class="form-control"> 
                                    </div>
                                </div>

                                 <div class="form-group row">

                                        <label class="col-lg-2 col-form-label">Select Dealer</label>
                                    <div class="col-lg-4">
                                            <select id="dealer_id" name="dealer_id" class="form-control">
                                        <option value="">Select dealer</option>
                                        <?php  foreach (get_data('dealer',store_where()) as $key => $value) { ?>
                                          <option <?php if($table_data['dealer_id']==$value['dealer_id']) echo "selected"; ?> value="<?= $value['dealer_id'] ?>"><?= $value['dealer_name'] ?></option>
                                          <?php    }  ?>
                                      </select>
                                    </div>


                                    
                                    <label class="col-lg-2 col-form-label">Status <code>*</code></label>
                                    <div class="col-lg-4">
                                            <select class="form-control" name="status">
                                                <option <?php if($table_data['status']==1) echo "selected"; ?> value="1">Active</option>
                                                <option <?php if($table_data['status']==0) echo "selected"; ?> value="0">Inactive</option>
                                            </select>
                                    </div>
                                 </div>

                                 <div class="form-group row">
                                    <label class="col-lg-2 col-form-label">Item Pic <small style="color:red;">(Optional)</small> </label>
                                    <div class="col-lg-4">
                                            <input  class="form-control" type="file" name="item_pic">  
                                    </div>
                                   
                                
                                 </div>

                                


    
                                 <div class="form-group row">
                                    <div class="col-lg-offset-2 col-lg-10">
                                        <button  class="btn btn-lg btn-info" type="submit">Submit</button>
                                    </div>
                                 </div>


                                 <input type="hidden" name="store_id" value="<?= $_SESSION['store_id'] ?>">
                                 <?php if(isset($_GET['id'])){?>
                                    <input type="hidden" name="where" value="item_id=<?= $_GET['id'] ?>">

                                 <?php  } ?>
</form>

          
        </div>
     </div>    
       <script type="text/javascript">

                                function change()
                                    {
                                        var main_cat_id=document.getElementById('main_cat_id').value;
                                    sendData={
                                              'type':'get',
                                              'table_name':'cateogeory_tbl',
                                              'where':'main_cat_id='+main_cat_id
                                             }
                                        data = sendAjax('ajax/ajax_crud',sendData);
                                         $("#sub_cat_id").html('');
                                         data.data.forEach(function(value,i){          
                                          var poss=` 
                                                    <option value=${value.cat_id}>${value.cat_name}</option>   
                                                   `
                                                  $("#sub_cat_id").append(poss);
                                                   });
                                    }
                                    
        </script>
     
<?php include('footer.php'); ?>