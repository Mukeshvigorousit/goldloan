<?php
include('include/config.php');
extract($_GET);
$order_data=get_data('order_tbl',"order_id='".$id."'",'s');
$title=$order_data['customer_name'].$order_data['order_no'];
include('header.php');
$page_title="Bill";
$check_id=count_data('order_tbl',store_where("order_id='".$id."'"),'order_id');
if($check_id==0)
{
  invalid();
}
$store_setting=get_data('store_setting',store_where(),'s'); 
$item_list=json_decode($order_data['order_content'],true);
?>

<style type="text/css">
    input
    {
        border:none;border-color:white; 
        font-size:14px;
    }
</style>


            <div class="col-lg-12" >
                 <form action="model/create_invoice" method="post" id="my_form">
                    <div class="ibox-content p-xl">
                            <div class="row">
                                 <?php if($store_setting['show_logo']==1) {?>
                                        <img style="height: 50px; width:50px; "  src="img/store_logo/<?= $store_data['store_logo'] ?>">

                                    <?php } ?>

                                <div class="col-sm-4">
                                    <address>
                                        <h3><?= ucfirst($store_data['store_name'])?></h3>
                                        <?php if($store_setting['show_gst']==1) {?>
                                        Gst: <?= ucfirst($store_data['store_gst'])?>
                                        <?php } if($store_setting['show_address']==1) {?>
                                        <br><?= ucfirst($store_data['store_address'])?><br><?= ucfirst($store_data['store_city'])?>
                                    <?php } if($store_setting['show_contact']==1) {?>
                                        <br>
                                        <abbr title="Phone"></abbr> <?= $store_data['store_mobile'] ?>
                                    <?php } ?>
                                    </address>
                                </div>
                                <div class="col-sm-3">
                                    <h5>Bill To:</h5>
                                       <h3><?= $c_name=$order_data['customer_name']!=''?$order_data['customer_name']:'Self' ?></h3>
                                       
                                        <h4><?= $c_name=$order_data['customer_mobile']!=''?$order_data['customer_mobile']:'Not Availaible' ?></h4>
                                       
                                       <h4><?= $c_name=$order_data['customer_address']!=''?$order_data['customer_address']:'Not Availaible' ?></h4>
                                </div>

                                <div class="col-sm-4 text-right">
                                    <h4>Invoice No.</h4>
                                    <h4 class="text-navy"><?= $order_data['order_no'] ?></h4>
                                    
                                    <p>
                                        <span><strong>Invoice Date:</strong> <?= $order_data['deliver_date'] ?></span>
                                        <!-- <br>
                                        <span><strong>Invoice Time:</strong> <?= _time() ?></span> -->
                                        
                                    </p>
                                </div>
                            </div>

                            <div class="table-responsive m-t">
                               
                                <table  class="table invoice-table table-light">
                                    <thead>
                                    <tr>
                                        <td width="60%" style="font-weight:900 ; ">Item List</td>
                                        <td width="10%" style="font-weight:900 ;">Quantity</td>
                                        <td width="10%" style="font-weight:900 ;">Unit Price</td>
                                        <td width="10%" style="font-weight:900 ;">Total Price</td>    
                                    </tr>
                                    </thead>
                                
                                    <tbody>
 
                             <?php foreach ($item_list as $key => $value) { /*_d($value);*/  ?>
                                          

    <tr>

         <td width="60%"><h4><?= $value['item_name'] ?></h4></td>
         <td width="10%"><h4><?= $value['item_quantity'] ?></h4></td>
         <td width="10%"><h4><?= $value['total_item_price'] ?></h4></td>
         <td width="10%"><h4><?= $value['total_price'] ?></h4></td>
       
    </tr>
<?php  } ?>
                                    
                                    </tbody>
                                </td>
                            </tr>
                        </thead>
                                </table>
                            </div><!-- /table-responsive -->

                            <table class="table invoice-total">
                                <tbody>
                                <tr>
                                    <td><strong>Sub Total :</strong></td>
                                    <td >&#8377; <input  style="width: 12ch;" type="number" readonly name="sub_total" id="sub_total" value="<?= $order_data['order_sub_total'] ?>"></td>
                                </tr>
                                <?php if($store_setting['show_discount']==1) {?>
                                <tr>
                                    <td><strong>Discount :</strong><br></td>
                                    <td ><?php if($order_data['discount_type']=='flat') echo '&#8377;'?> <input  style="width: 12ch;" type="number"  name="discount" id="discount" value="<?= $order_data['total_discount'] ?>"> <?php if($order_data['discount_type']=='percentage'){?> % <?php }  ?></td>
                                </tr>
                                <?php } ?>
                                <?php if($store_setting['show_gst']==1) {?>
                                <tr>
                                    <td><strong>GST :</strong></td>
                                    <td >&#8377; <input  style="width: 12ch;" type="number" readonly name="gst_total" id="gst_total" value="<?= $order_data['total_tax'] ?>"></td>
                                </tr>
                                <?php } ?>
                                <tr>
                                    <td><strong>TOTAL :</strong></td>
                                    <td >&#8377; <input  style="width: 12ch;" type="number" readonly name="grand_total" id="grand_total" value="<?= $order_data['order_total_amt'] ?>"></td>
                                </tr>
                                </tbody>
                            </table>

                            <div class="text-right">
                            <!--     <a  style="color:white"  class="btn btn-primary" value="Submit"></a>    -->
                            </div>
                            <?php  if($store_setting['term_and_condition']!=''){?>
                            <center>

                            <div class="well m-t"><strong>Terms & Condition</strong><br>
                                <?= $store_setting['term_and_condition']?>
                            </div>
                        </center>
                            <?php } ?>
                              </form>
                        </div>
                </div>
                <?php require('footer.php');  ?>
            </div>
        </div>
    </form>
</div>



<script type="text/javascript">
    window.print()
</script>

