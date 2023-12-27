<?php 

include('include/config.php'); 
$_GET=sanatize($_GET);
$_POST=sanatize($_POST);
$order_data=order_detail($_GET['order_id']);
$order_store_data=store_detail($order_data['store_id']);
$client_data = user_detail($order_data['client_id']);

// _dx($client_data);

$item_data=get_data("order_item_list","order_id='".$order_data['order_id']."'");
include('header.php');

$print=false;

if(isset($_GET['print']))
{  
    $print=true; 
}


?>
<?php  if(!$print){ ?>
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-8">
        <h2>Invoice</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="#"><?= $order_data['client_name'] ?></a>
            </li>

            <li class="breadcrumb-item active">
                <strong>Form</strong>
            </li>
        </ol>
    </div>
    <div class="col-lg-4">
        <div class="title-action">

            <!--<a href="print_form?order_id=<?= $order_data['order_id'] ?>&page_name=print_form&print=true" target="_blank"-->
            <!--    class="btn btn-primary"><i class="fa fa-print"></i> Print-->
            <!--    Form </a>-->
              
                <a href="gernrate_pdf?order_id=<?= $order_data['order_id'] ?>&action=download_form" 
                class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i> Download
                Form </a>
                <!-- target="_blank" -->
        </div>
    </div>
</div>
<?php } ?>
<div class="wrapper wrapper-content animated fadeInRight">

    <div class="row">
        <div class="col-lg-12">
            <div class="ibox-content p-xl">
                <div class="row">
                    <div class="col-sm-6">
                        <h5>From:</h5>
                        <address>
                            <h3 class="text-capitalize"><strong><?= $order_store_data['store_name'] ?></strong></h3>
                            <?= $order_store_data['store_address'] ?><br>
                            <?= $order_store_data['city'] ?> (<?= $order_store_data['state'] ?>)<br>

                            <abbr title="Phone">P:</abbr> +91-<?= $order_store_data['mobile'] ?>
                        </address>
                    </div>

                    <div class="col-sm-6 text-right">
                        <h4>Invoice No.</h4>
                        <h4 class="text-navy">INV-<?= $order_data['order_id'] ?></h4>
                        <!-- <span>To:</span>
                        <address>
                            <strong>Corporate, Inc.</strong><br>
                            112 Street Avenu, 1080<br>
                            Miami, CT 445611<br>
                            <abbr title="Phone">P:</abbr> (120) 9000-4321
                        </address> -->
                        <p>
                            <span><strong>Loan
                                    Date :</strong>
                                <?= date("d/m/Y", strtotime($order_data['loan_date']))  ?></span><br>
                            <span><strong> 
                                    Date :</strong>
                                <?php echo  date('d/m/Y h:i:s A'); ?></span>
                        </p>
                    </div>
                </div>
                <hr>

                <div class="container">
                    <div class="row">
                        <div class="col-sm col-md-3">
                            <h3>Customer Name :
                                <br>ऋण ग्राहक नाम :
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b><?= strtoupper($client_data['name']) ?> 
                            <br><?php echo$client_data['name_hindi']; ?> 
                        
                        </b>
                        </div>
                        <div class="col-sm col-md-3">
                            <h3>Father/Husband Name :
                                <br>पिता/पति का नाम :
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b> <?= strtoupper($client_data['father_name']) ?>
                        <br>  <?php echo $client_data['father_name_hindi']; ?>  </b> 
                        </div>
                    </div>
                             <div class="row">
                        <div class="col-sm col-md-3">
                            <h3>Alternative Mobile No:
                                <br>वैकल्पिक मोबाइल नंबर :
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b><?= strtoupper($client_data['mobile']) ?></b>
                        </div>
                        <div class="col-sm col-md-3">
                            <h3>Full Address :
                                <br>पूरा पता :
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b> <?= strtoupper($client_data['address']) ?> <?= strtoupper($client_data['city']) ?>
                                (<?= strtoupper($client_data['state']) ?>)
                            _
                                <br>  
                              <?php    echo $client_data['address_hindi'] ?>  <?php echo $client_data['city_hindi'] ?> (<?php echo $client_data['state_hindi'] ?>)
                                  </b> 
                            </b>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm col-md-3">
                            <h3>Alternative Mobile No:
                                <br>वैकल्पिक मोबाइल नंबरर :
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b><?= strtoupper($client_data['alter_mobile']) ?></b>
                        </div>
                        <div class="col-sm col-md-3">
                             
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            
                        </div>
                    </div>
              


                    <div class="row">
                        <div class="col-sm col-md-3">
                            <h3>Weight Of Gold:
                                <br>सोने का वजन:
                            </h3>
                        </div>
                        <div class="col-sm col-md-6 mt-3">
                            <b>
                                <?= strtoupper($order_data['weight_gm_gold']) ?><small> ( Gm/ग्राम) </small> +
                                <?= strtoupper($order_data['weight_mlgm_gold']) ?> <small> (MlGm/मिलीग्राम)</small></b>
                        </div>
                        <div class="col-sm col-md-1 mt-3">

                        </div>
                        <div class="col-sm col-md-2 mt-3">

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm col-md-3">
                            <h3>Weight Of Silver:
                                <br>चांदी का वजन:
                            </h3>
                        </div>
                        <div class="col-sm col-md-6 mt-3">
                            <b> <?php echo $order_data['weight_kg_silver']!='0'?strtoupper($order_data['weight_kg_silver']).'<small> ( Kg/किलोग्राम) </small>+': '' ?>                          
                            <?= strtoupper($order_data['weight_gm_silver']) ?><small> ( Gm/ग्राम) </small> +
                            <?= strtoupper($order_data['weight_mlgm_silver']) ?><small> (MlGm/मिलीग्राम)</small></b>
                        </div>
                        <div class="col-sm col-md-1 mt-3">

                        </div>
                        <div class="col-sm col-md-2 mt-3">

                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm col-md-3">
                            <h3>Loan Amount Taken By Customer:
                                <br>ग्राहक द्वारा ली गई ऋण राशि:
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b> &#8377;
                                <?= strtoupper(abs($order_data['loan_amount']))   ?>
                            </b>
                        </div>
                        <div class="col-sm col-md-2 mt-3">
                            <h3>In Digits
                                <br>अंकों में</br>
                            </h3>
                        </div>
                        <div class="col-sm col-md-4 mt-4">
                            <b> &#8377; <?= strtoupper(getIndianCurrency(abs($order_data['loan_amount']))) ?>
                            <br>  &#8377;  <?php echo translateText(getIndianCurrency(abs($order_data['loan_amount']))); ?>  </b> 
                        
                        </b>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm col-md-3">
                            <h3>Interest On Loan Amount:
                                <br>ऋण राशि पर ब्याज:
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b>
                                <?= strtoupper(abs($order_data['loan_interest']))   ?> % (Per Month)<small>(प्रति
                                    महीने)</small>
                            </b>
                        </div>
                        <div class="col-sm col-md-2 mt-3">

                        </div>
                        <div class="col-sm col-md-4 mt-4">

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm col-md-3">
                            <h3>Time In Month For Complete Loan Amount:
                                <br>ऋण राशि जमा करने का समय (महीने में):
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b>
                                <?= strtoupper(abs($order_data['loan_period_month']))   ?> Month<small>(महीने)</small>
                            </b>
                        </div>
                        <div class="col-sm col-md-2 mt-3">

                        </div>
                        <div class="col-sm col-md-4 mt-4">

                        </div>
                    </div>
                     <div class="row">
                        <div class="col-sm col-md-3">
                            <h3>Remark:
                                <br>टिप्पणी:
                            </h3>
                        </div>
                        <div class="col-sm col-md-3 mt-3">
                            <b class="text-capitalize">
                                <?= $order_data['remark']   ?> <br>
                                <?php echo translateText($order_data['remark']); ?>
                            </b>
                        </div>
                        <div class="col-sm col-md-2 mt-3">

                        </div>
                        <div class="col-sm col-md-4 mt-4">

                        </div>
                    </div>

                </div>

                <hr>

                <center>
                    <h3>Information Of Loan Ornament's By Customer</h3>

                    <b> ऋण ग्राहक द्वारा रखे गए ऋण आभूषण रखने की जानकारी</b>
                </center>




                <div class="table-responsive m-t">
                    <table class="table invoice-table table-bordered solid">
                        <thead>
                            <tr>
                                <th>Grade</th>
                                <th>Item Name</th>
                                <th>Item Details</th>
                                <th>Remarks</th>
                                <th>Gross Wt. <code>(Gm)</code></th>
                                <th>Less <code>(Gm)</code></th>
                                <th>Net Wt. <code>(Gm)</code></th>
                                <!-- <th>Tunch <code>(%)</code></th>
                                <th>Fine <code>(Gm)</code></th>
                                <th>Rate <code>(Per Gm)</code></th>
                                <th>Value</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            <?php  foreach ($item_data as $key => $item) { ?>
                            <tr id=" row_<?= $item['item_id'] ?>" class="form-group">
                                <td>
                                    <p><?= $item['item_name'] ?></p>
                                </td>
                                <td>
                                    <p><?= $item['item_name_by_user'] ?></p>
                                </td>
                                <td>
                                    <p><?= $item['item_details'] ?></p>
                                </td>
                                <td>
                                    <p><?= $item['remark'] ?></p>
                                </td>
                                <td>
                                    <p><?= $item['gross_wt'] ?></p>
                                </td>
                                <td>
                                    <p><?= $item['less_wt'] ?></p>
                                </td>
                                <td>
                                    <p><?= $item['net_wt'] ?></p>
                                </td>
                                <!-- <td>
                                    <p><?= $item['tunch'] ?></p>
                                </td>

                                <td>
                                    <p><?= $item['fine'] ?></p>
                                </td>
                                <td>
                                    <p><?= $item['rate'] ?></p>
                                </td>

                                <td>
                                    <p><?= $item['total_value'] ?></p>
                                </td> -->
                            </tr>
                            <?php   } ?>


                        </tbody>
                    </table>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="col-sm col-md-6">
                            <h3>Customer Signature
                                <br>
                                <!-- <b>  -->
                                    <img src="img/item/item_full/<?php echo $client_data['client_signature_pic'];?>" alt="" width="150px;" height="80px;">
                            
                                <!-- <br>........................................................ </b> -->
                            </h3>
                        </div>
                        <div class="col-sm col-md-6 mt-3">

                        </div>

                    </div>

                </div>





                <!-- <table class="table invoice-total">
                    <tbody>
                        <tr>
                            <td><strong>Sub Total :</strong></td>
                            <td>$1026.00</td>
                        </tr>
                        <tr>
                            <td><strong>TAX :</strong></td>
                            <td>$235.98</td>
                        </tr>
                        <tr>
                            <td><strong>TOTAL :</strong></td>
                            <td>$1261.98</td>
                        </tr>
                    </tbody>
                </table> -->
                <!-- <div class="text-right">
                    <button class="btn btn-primary"><i class="fa fa-dollar"></i> Make A Payment</button>
                </div> -->

                <div class="well m-t">
                    <center>
                        <h1 class=""><b>Term's & Condition </b></h1>
                    </center>
                <p class="text-left" style="font-size:18px;"    >
                1. हमारे द्वारा गिरवे की रकम मियाद (तय समय तक) से ही रखी जाती है । <br><br>
                2. किन्ही विशेष परिस्थितयों में रकम चोरी हो जाने या गुम हो जाने पर या भूल वश गल जाने पर ग्राहक को उतने वजन की दूसरी रकम या मिलावट काटकर रुपये का भुगतान किया जाएगा ।<br><br>
                3. रकम ग्राहक अपनी स्वयं की गिरवी रखे यदि चोरी या रिश्तेदार की होगी तो जवाबदारी ग्राहक की रहेगी । <br><br>
                4. विशेष परिस्थितियों में रकम लोटाने में 15 से 20 दिन की देरी हो सकती है । <br><br>
                5. रकम छुड़ाने के पश्चात रकम चेक कर के लेवें, बाद में कोई शिकायत मान्य नहीं होगी ।<br><br>
                6. रुपये जमा करने के 1 दिन बाद रकम दी जाएगी।<br><br>
                7. रकम के रुपये समय पर जमा नही करने पर रकम गला दी जावेगी। उसके पूर्व ग्राहक को आवश्यकता अनुसार मोबाईल किया जावेगा । आपका मोबाईल बंद आने, गुम हो जाने पर, नम्बर बदलने की सूचना नही देने पर हमारी कोई जवाबदारी नही रहेगी। <br><br>
                8. रकम छुड़ाने की तय समय सीमा के बाद या एक वर्ष के बाद ब्याज पर ब्याज (चक्रवर्ती ब्याज ) देय होगा। चक्रवर्ती ब्याज तय समय के बाद लेने या एक वर्ष के पश्चात लेने का अंतिम निर्णय हमारा रहेगा। <br><br>
   <br><br>
   </p>
   

 

                
                </div>



                <div class="well m-t">
                    <center>
                        <h1 class=""><b><u>ग्राहक का इकरार नामा </u></b></h1>
                    </center>
                <p class="text-left" style="font-size:18px;"    >
                मेरे द्वारा गिरवी रखी गई रकम को छुड़ाने की आखरी तारीख <b><?= date_convertor(loan_last_date($order_data['loan_date'],$order_data['loan_period_month'])) ?></b> रहेगी। यदि इस दिनांक तक मेरे द्वारा रकम का ब्याज जमा नहीं किया गया या रकम नहीं छुड़ाई गई तो मैं आपको अधिकार देता हूँ / देती हूँ कि आप स्वयं रकम गलाकर, बेचकर मूल जमा कर लेवें । रकम छुड़ाने की आखरी दिनांक के बाद मेरा कोई दावा मान्य नहीं होगा। ना ही मेरे द्वारा कोई रकम का हिसाब मांगा जाएगा ।<br><br>
   </p>
   

<img src="img/item/item_full/<?php echo $client_data['client_signature_pic'];?>" alt="" width="150px;" height="80px;"> <br>

&nbsp; ऋण धारक हस्ताक्षर

                
                </div>
                
            </div>
        </div>
    </div>
</div>

<br>
<script>
var printData = "<?= $print ?>"
if (printData) {
    window.print();
}
</script>
<?php  if(!$print){ ?>
<?php include('footer.php'); } ?>