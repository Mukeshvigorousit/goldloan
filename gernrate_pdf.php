<?php
require_once __DIR__ . '/vendor/autoload.php';
include('include/config.php');
// Create an instance of the class:
// $mpdf = new \Mpdf\Mpdf();
$mpdf = new \Mpdf\Mpdf(['utf-8', 'A4']);

$mpdf->AddPageByArray([
    'margin-bottom' =>0, 
    'margin-top' =>10, 
]);

$fontPath = 'fonts/NotoSansDevanagari.ttf';

$mpdf->useAdobeCJK = true;
$mpdf->autoScriptToLang = true;
$mpdf->autoLangToFont = true;

$mpdf->SetBasePath($fontPath);




$_GET = sanatize($_GET);
$_POST = sanatize($_POST);

 

 
if($_GET['action']=='download_form')
{
    
    $order_data = order_detail($_GET['order_id']);
$order_store_data = store_detail($order_data['store_id']);
$client_data = user_detail($order_data['client_id']);
$item_data = get_data("order_item_list", "order_id='" . $order_data['order_id'] . "'");



// _dx($client_data['pan_card_pic']);


$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
 
</style>
<body>'; 

$html='<table width="100%" style="font-size:12px;" >
<tr>
<td>From:</td>  
<td style="text-align:right">Invoice No.:</td>
</tr>
<tr>
<td ><b> ' . $order_store_data['store_name'] . ' </b></td> 
<td  style="text-align:right;color:#1FABB5;"><b> INV-' . $order_data['order_id'] . '</b></td>
</tr>
<tr>
<td ><b> ' . $order_store_data['store_address'] . '</td>  
<td  style="text-align:right">Loan Date : <b> ' . date("d/m/Y", strtotime($order_data['loan_date'])) . ' </b></td>
</tr>
<tr>
<td ><b>' . $order_store_data['city'] . ' (' . $order_store_data['state'] . ') </b></td> 
<td  style="text-align:right">Office Time : 11:00 AM TO 07:45 PM <b> ';

echo $order_data['loan_finish_date'] != '' ? date("d/m/Y", strtotime($order_data['loan_finish_date'])) : '';

$html .= ' </b></td>
</tr>
<tr>
<td ><b>Phone: +91-' . $order_store_data['mobile'] . '</b></td>

<td ></td>

</tr>
</table>
<table width="100%" style="font-size:12px;">
<tr>
<td colspan="5"><hr></td>
</tr>
<tr> 
<td>Customer Name : <br> ऋण ग्राहक नाम :</td>
<td style="font-size:12px;"><b>' . strtoupper($client_data['name']) . ' <br> '.$client_data['name_hindi'].'</b></td> 
<td>Father/Husband Name : <br> पिता/पति का नाम :</td>
<td><b>' . strtoupper($client_data['father_name']) . ' <br> '.$client_data['father_name_hindi'].'</b></td> 
<td>';

if(isset($client_data['client_pic']) && $client_data['client_pic']!=null)
 {

$html.='<img src="' . getcwd() . '\\img\\item\\item_full\\' . $client_data['client_pic'] . '" style="width:80px;"/>';
 }

 
$html.='</td></tr>
</table>


<table width="100%" style="font-size:12px;">
<tr> 
<td>Mobile No: <br> मोबाइल नंबर :</td>
<td ><b>' . strtoupper($client_data['mobile']) . '</b></td>
<td>Full Address : <br> पूरा पता :</td>
<td ><b>' . strtoupper($client_data['address']) . ' ' . strtoupper($client_data['city']) . ' ' . strtoupper($client_data['state']) . '<br> '.$client_data['address_hindi'].' '.$client_data['city_hindi'].' ( '.$client_data['state_hindi'].' )</b></td> 
</tr>


<tr> 
<td>Owner Of Jewellery: <br> आभूषण का मालिक :</td>
<td><b>' . strtoupper($order_data['owner_of_jewellery']) . ' <br>'.$order_data['owner_of_jewellery_hindi'].' </b></td>
<td>Jewellery Purchased From: <br> आभूषण कहाँ से खरीदा :</td>
<td><b>' . strtoupper($order_data['jewellery_purchased_from']) . ' <br>'.$order_data['jewellery_purchased_from_hindi'].' </b></td>

</tr>

<tr> 
<td>Jewellery Purchased From: <br> आभूषण कहाँ से खरीदा :</td>
<td><b>' . strtoupper($client_data['alter_mobile']) . '</b></td>
<td> </td>
<td></td> 
</tr>';

if($order_data['net_weight_gram_gold']>0)
{
    $gold_net_weight = dataInGram((float)$order_data['net_weight_gram_gold']);
    $html.='<tr> 
<td>Net Weight Of Gold : <br>  सोने का शुद्ध वजन :</td> 
<td><b> ' . ( $gold_net_weight['weight_kg'] != '0' ? strtoupper($gold_net_weight['weight_kg']) . '<small> ( Kg/किलोग्राम) </small>+' : ''). ' ' . ($gold_net_weight['weight_gram'] != '0' ? strtoupper($gold_net_weight['weight_gram']) . '<small> (Gm/ग्राम) </small>' : '') . '' . ($gold_net_weight['weight_mlgm'] != '0' ? " + ".strtoupper($gold_net_weight['weight_mlgm']) . '<small> (MlGm/मिलीग्राम) </small>' : '' ) . '</b></td> 
<td></td> 
<td></td> 
</tr>
 ';  
}

if($order_data['total_weight_gram_gold']>0)
{
    $total_weight_gram_gold = dataInGram((float)$order_data['total_weight_gram_gold']);
    $html.='<tr> 
<td>Gold Gross Weight : <br>  सोना सकल वजन :</td> 
<td><b> ' . ( $total_weight_gram_gold['weight_kg'] != '0' ? strtoupper($total_weight_gram_gold['weight_kg']) . '<small> ( Kg/किलोग्राम) </small>+' : ''). ' ' . ($total_weight_gram_gold['weight_gram'] != '0' ? strtoupper($total_weight_gram_gold['weight_gram']) . '<small> (Gm/ग्राम) </small>' : '') . '' . ($total_weight_gram_gold['weight_mlgm'] != '0' ? " + ".strtoupper($total_weight_gram_gold['weight_mlgm']) . '<small> (MlGm/मिलीग्राम) </small>' : '' ) . '</b></td> 
<td></td> 
<td></td> 
</tr>
 ';  
}


if($order_data['gold_approx_weight']>0)
{
    $gold_approx_weight = dataInGram((float)$order_data['gold_approx_weight']);
    $html.='<tr> 
<td>Gold (approx) Weight : <br>  सोना (लगभग) वजन :</td> 
<td><b> ' . ( $gold_approx_weight['weight_kg'] != '0' ? strtoupper($gold_approx_weight['weight_kg']) . '<small> ( Kg/किलोग्राम) </small>+' : ''). ' ' . ($gold_approx_weight['weight_gram'] != '0' ? strtoupper($gold_approx_weight['weight_gram']) . '<small> (Gm/ग्राम) </small>' : '') . '' . ($gold_approx_weight['weight_mlgm'] != '0' ? " + ".strtoupper($gold_approx_weight['weight_mlgm']) . '<small> (MlGm/मिलीग्राम) </small>' : '' ) . '</b></td> 
<td></td> 
<td></td> 
</tr>
 ';  
}



if($order_data['total_weight_gram_silver']>0)
{
    $total_weight_gram_silver = dataInGram((float)$order_data['total_weight_gram_silver']);
    $html.='<tr> 
<td>Net Weight Of Silver : <br>  चाँदी का शुद्ध वजन :</td> 
<td><b> ' . ( $total_weight_gram_silver['weight_kg'] != '0' ? strtoupper($total_weight_gram_silver['weight_kg']) . '<small> ( Kg/किलोग्राम) </small>+' : ''). ' ' . ($total_weight_gram_silver['weight_gram'] != '0' ? strtoupper($total_weight_gram_silver['weight_gram']) . '<small> (Gm/ग्राम) </small>' : '') . '' . ($total_weight_gram_silver['weight_mlgm'] != '0' ? " + ".strtoupper($total_weight_gram_silver['weight_mlgm']) . '<small> (MlGm/मिलीग्राम) </small>' : '' ) . '</b></td> 
<td></td> 
<td></td> 
</tr>
 ';  
}

if($order_data['net_weight_gram_silver']>0)
{
    $net_weight_gram_silver = dataInGram((float)$order_data['net_weight_gram_silver']);
    $html.='<tr> 
<td>Silver Gross Weight : <br>  चाँदी सकल वजन :</td> 
<td><b> ' . ( $net_weight_gram_silver['weight_kg'] != '0' ? strtoupper($net_weight_gram_silver['weight_kg']) . '<small> ( Kg/किलोग्राम) </small>+' : ''). ' ' . ($net_weight_gram_silver['weight_gram'] != '0' ? strtoupper($net_weight_gram_silver['weight_gram']) . '<small> (Gm/ग्राम) </small>' : '') . '' . ($net_weight_gram_silver['weight_mlgm'] != '0' ? " + ".strtoupper($net_weight_gram_silver['weight_mlgm']) . '<small> (MlGm/मिलीग्राम) </small>' : '' ) . '</b></td> 
<td></td> 
<td></td> 
</tr>
 ';  
}


if($order_data['silver_approx_weight']>0)
{
    $silver_approx_weight = dataInGram((float)$order_data['silver_approx_weight']);
    $html.='<tr> 
<td>silver (approx) Weight : <br>  चाँदी (लगभग) वजन :</td> 
<td><b> ' . ( $silver_approx_weight['weight_kg'] != '0' ? strtoupper($silver_approx_weight['weight_kg']) . '<small> ( Kg/किलोग्राम) </small>+' : ''). ' ' . ($silver_approx_weight['weight_gram'] != '0' ? strtoupper($silver_approx_weight['weight_gram']) . '<small> (Gm/ग्राम) </small>' : '') . '' . ($silver_approx_weight['weight_mlgm'] != '0' ? " + ".strtoupper($silver_approx_weight['weight_mlgm']) . '<small> (MlGm/मिलीग्राम) </small>' : '' ) . '</b></td> 
<td></td> 
<td></td> 
</tr>
 ';  
}
 

// . strtoupper($order_data['weight_gm_gold']) . '<small> ( Gm/ग्राम)</small> + ' . strtoupper($order_data['weight_mlgm_gold']) . '<small> (MlGm/मिलीग्राम)</small>  
$html.='  
<tr>

<td>Loan Amount Taken <br>  By Customer: <br> ग्राहक द्वारा ली गई ऋण राशि:</td>
<td> <b> &#8377;' . strtoupper(abs($order_data['loan_amount'])) . ' </b></td>
<td>In Digits <br> अंकों में </td>
<td><b>&#8377; ' . strtoupper(getIndianCurrency(abs($order_data['loan_amount']))) . ' <br> &#8377; '.translateText(getIndianCurrency(abs($order_data['loan_amount']))).'</b></td>

</tr>
<tr>

<td>Interest On Loan Amount: <br>ऋण राशि पर ब्याज:</td>
<td><b>' . strtoupper(abs($order_data['loan_interest'])) . ' % (Per Month) <br> <small>(प्रति महीने)</small></b></td>
<td></td>
<td></td>
 
</tr>
<tr>

<td>Time In Month For <br> Complete Loan Amount: <br>ऋण राशि जमा करने का समय (महीने में):</td>
<td colspan="3"><b> ' . strtoupper(abs($order_data['loan_period_month'])) . ' Month <br> <small> (महीने)</small> </b></td>
 
</tr>
<tr>
<td colspan="4"><hr></td>
</tr>

</table>'; 

$html.='<table width="100%" style="font-size:12px;">
<tr >
<td style="text-align:center;"><b> Information Of Loan Ornament' . "'" . 's By Customer <br> ऋण ग्राहक द्वारा रखे गए ऋण आभूषण रखने की जानकारी</b> </td>
</tr>
</table>

<table class="table invoice-table table-bordered solid" border="1" width="100%" style="border-spacing: 0;font-size:12px;">
<thead>


    <tr>
 
        <th class="text-left" width="20%" style="text-align:left;padding:10px;">Grade</th>
        <th class="text-left" style="text-align:left;padding:10px;">Details</th> 
     
    </tr>
   
</thead>
<tbody >';

 
if(isset($order_data['gold_details']) && !empty($order_data['gold_details']))

  {
    $html .= '<tr >
                    <td class="text-left" style="text-transform: capitalize;padding:10px;"><b> Gold </b></td>
                    <td class="text-left" style="text-transform: capitalize;padding:10px;"><b> ' . $order_data['gold_details'] . ' </b></td>
                    
                </tr>';
}
 
if(isset($order_data['silver_details']) && !empty($order_data['silver_details']))

  {
    $html .= '<tr >
                    <td class="text-left" style="text-transform: capitalize;padding:10px;"><b> Silver </b></td>
                    <td class="text-left" style="text-transform: capitalize;padding:10px;"><b> ' . $order_data['silver_details'] . ' </b></td>
                    
                </tr>';
}

 

$html .= '
</table>
 <hr> 
<p class="text-left" style="font-size:14px;">
    मेरे द्वारा गिरवी रखी गई रकम को छुड़ाने की आखरी तारीख <b><u>'.date_convertor(loan_last_date($order_data['loan_date'],$order_data['loan_period_month'])).'</u></b> रहेगी। यदि इस दिनांक तक मेरे द्वारा रकम का ब्याज जमा नहीं किया गया या रकम नहीं छुड़ाई गई तो मैं आपको अधिकार देता हूँ / देती हूँ कि आप स्वयं रकम गलाकर, बेचकर मूल जमा कर लेवें । रकम छुड़ाने की आखरी दिनांक के बाद मेरा कोई दावा मान्य नहीं होगा। ना ही मेरे द्वारा कोई रकम का हिसाब मांगा जाएगा ।
    </p>
        <table><tr style="text-align:center;">
            <td colspan="3">';
            if(isset($client_data['client_signature_pic']) && $client_data['client_signature_pic']!=null)
            {
                $html.='<img src="' . getcwd() . '\\img\\item\\item_full\\' . $client_data['client_signature_pic'] . '" style="width:120px;height:50px;"/> ';
            
            }


            $html.='<br>  Customer Signature <br></td>
            <td colspan="4">     </td>
        </tr> 
    </table>  ';

    $mpdf->WriteHTML($html); 
 
    $mpdf->AddPage();

    $html ='<table width="100%" style="text-align:center;font-size:10px;" > 
    <tr>
 
<td colspan="2">';
// _dx($client_data);
 if(isset($client_data['pan_card_pic']) && $client_data['pan_card_pic']!=null)
 {
 $html.='
 <img src="' . getcwd() . '\\img\\item\\item_full\\' . $client_data['pan_card_pic'] . '" style="width:200px;"/><br><br><b> PAN Card </b><br><br> 
' ;
} 
$html.=' </td>
</tr>
<tr>
<td>';

 if(isset($client_data['aadhar_card_pic_front']) && $client_data['aadhar_card_pic_front']!=null)
 {
 $html.='<img src="' . getcwd() . '\\img\\item\\item_full\\' . $client_data['aadhar_card_pic_front'] . '" style="width:200px;"/><br><br><b> Aadhar Card Front <br><br></b></td>' ;
} 
 if(isset($client_data['aadhar_card_pic_back']) && $client_data['aadhar_card_pic_back']!=null)
 {
 $html.='<td><img src="' . getcwd() . '\\img\\item\\item_full\\' . $client_data['aadhar_card_pic_back'] . '" style="width:200px;"/><br><br><b> Aadhar Card Back <br><br></b></td>
 
 </tr>
 <tr>' ;
} 
 if(isset($client_data['item_pic']) && $client_data['aadhar_card_pic_front']!=null)
 {
 $html.='<td colspan="2"><img src="' . getcwd() . '\\img\\item\\item_full\\' . $order_data['item_pic'] . '" style="width:500px;"/ ><br><br><b>Jewellery  Photo</b> </td>
 
 </tr>' ;
} 


$html.='


</table> 
';
$mpdf->WriteHTML($html);



 

$html .= '</body>
</html>';


// echo $html;
// $mpdf->WriteHTML($html);

$mpdf->Output('INV-' . $order_data['order_id'] . '.pdf', 'D');
    
}

else if($_GET['action']=='print_slip')
{

 
    $tran_log = get_data("transaction_log","log_id=".$_GET['transation_id']."",'s');
    $client_data = user_detail($tran_log['user_id']);
 
 
 
 
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<table class="table invoice-table table-bordered solid" border="0" width="60%" style="border-spacing: 0;">
<thead> 

    <tr> 
        <th class="text-left"  style="text-align:left;padding:10px;">Order ID</th>
        <th class="text-left" style="text-align:left;padding:10px;">'.$tran_log['order_id'].'</th>  
    </tr>
    <tr> 
        <th class="text-left"  style="text-align:left;padding:10px;">Client Name</th>
        <th class="text-left" style="text-align:left;padding:10px;">'.$client_data['name'].'</th>  
    </tr>
    <tr> 
        <th class="text-left"  style="text-align:left;padding:10px;">Amount</th>
        <th class="text-left" style="text-align:left;padding:10px;">₹ '.abs($tran_log['amount']).'</th>  
    </tr>
    <tr> 
        <th class="text-left"  style="text-align:left;padding:10px;">Date</th>
        <th class="text-left" style="text-align:left;padding:10px;">'.date('m/d/Y h:i:s A', strtotime($tran_log['date_time'])).'</th>  
    </tr>
    <tr> 
        <th class="text-left"  style="text-align:left;padding:10px;">Remark</th>
        <th class="text-left" style="text-align:left;padding:10px;">'.$tran_log['customer_remark'].'</th>  
    </tr>
   
</thead>
<tbody >'; 
 
 

 $html .= '</table>'; 

$html .= '</body>
</html>'; 


 
$mpdf->WriteHTML($html);

 
$mpdf->Output("Receipt_".$tran_log['log_id'] . '.pdf', 'D');

 
 
 

} 
 
else
{ 
    
$order_data = order_detail($_GET['order_id']);
$order_store_data = store_detail($order_data['store_id']);
$client_data = user_detail($order_data['client_id']);
 

$investorData = get_data("user_tbl","id=".$order_data['investor_id']." and status='1'",'s');
 
$item_data = get_data("order_item_list", "order_id='" . $order_data['order_id'] . "' AND client_id='".$order_data['client_id'] ."' AND investor_id='".$order_data['investor_id']."'");
$assign_investor_list = get_data("assign_investor_list", "order_id='" . $order_data['order_id'] . "' AND client_id='".$order_data['client_id'] ."' AND investor_id='".$order_data['investor_id']."'",'s');


//   $total_time= getDaysByTwoDates($assign_investor_list['start_date'],$assign_investor_list['end_date']);
 

//   $sub_struct_month = ($total_time / 30) ;
//   $sub_struct_month = floor($sub_struct_month); 
//   $sub_struct_days = ($total_time % 30); // the rest of days
//   $total_time = $sub_struct_month." Months ".$sub_struct_days." Days ";



 
$html = '<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<table width="100%" >
<tr>
<td>From:</td>  
<td style="text-align:right">To,</td>
</tr>
<tr>
<td ><b> ' . $order_store_data['store_name'] . ' </b></td> 
<td  style="text-align:right;color:#1FABB5;"><b>' . $investorData['name'] . '</b></td>
</tr>
<tr>
<td ><b> ' . $order_store_data['store_address'] . '</td>  
<td  style="text-align:right">Date : <b> ' . date("d/m/Y") . ' </b></td>
</tr>
<tr>
<td ><b>' . $order_store_data['city'] . ' (' . $order_store_data['state'] . ') </b></td> 
<td></td> 
</tr>
<tr>
<td ><b>Phone: +91-' . $order_store_data['mobile'] . '</b></td>

<td ></td>

</tr>
</table>



<table width="100%" >
<tr> 
<td style="text-align:center;font-size:15px;"><h3> Details of funds taken from investors <br> निवेशक से लिए गए धन का विवरण </h3></td>
</tr>

<tr> 
<td style="text-align:center;"><b>Amount : </b> ' . $assign_investor_list['amount'] . ' </td>
</tr>
<tr> 
<td style="text-align:center;"><b>interest Rate :</b> ' . $assign_investor_list['interest_rate'] . ' %  (Per Month) <small>(प्रति महीने)</td>
</tr>


 
</table>
<table class="table invoice-table table-bordered solid" border="1" width="100%" style="border-spacing: 0;">
<thead>


    <tr>
 
        <th class="text-left" width="20%" style="text-align:left;padding:10px;">Item Type</th>
        <th class="text-left" style="text-align:left;padding:10px;">Item Details</th> 
     
    </tr>
   
</thead>
<tbody >'; 
if(isset($order_data['gold_details']) && !empty($order_data['gold_details']))

  {
    $html .= '<tr >
                    <td class="text-left" style="text-transform: capitalize;padding:10px;"><b> Gold </b></td>
                    <td class="text-left" style="text-transform: capitalize;padding:10px;"><b> ' . $order_data['gold_details'] . ' </b></td>
                    
                </tr>';
}
if(isset($order_data['silver_details']) && !empty($order_data['silver_details']))

  {
    $html .= '<tr >
                    <td class="text-left" style="text-transform: capitalize;padding:10px;"><b> Silver </b></td>
                    <td class="text-left" style="text-transform: capitalize;padding:10px;"><b> ' . $order_data['silver_details'] . ' </b></td>
                    
                </tr>';
}

 $html .= '</table>';



$html .= '</body>
</html>'; 


// <tr> 
// <td style="text-align:center;"><b>Amount Given Date :</b> ' . date("d/m/Y", strtotime($assign_investor_list['start_date'])) . ' </td>
// </tr>
// <tr> 
// <td style="text-align:center;"><b>Amount Recived Date :</b> ' . date("d/m/Y", strtotime($assign_investor_list['end_date'])) . ' </td>
// </tr>
// <tr> 
// <td style="text-align:center;"><b>Total Intrest :</b> ' . $assign_investor_list['totalInterestTillDate'] . ' </td>
// </tr>
// <tr> 
// <td style="text-align:center;"><b>Total Days :</b> ' . getDaysByTwoDates($assign_investor_list['start_date'],$assign_investor_list['end_date']) . ' Days </td>
// </tr>
// <td  style="text-align:right">Recived Date :' . date("d/m/Y", strtotime($assign_investor_list['end_date'])) . ' <b> ';

// echo date("d-M-Y h:m:s");

// $html .= ' </b></td> 


//    echo $html;
$mpdf->WriteHTML($html);

// // $mpdf->Output('final.pdf', 'I');
$mpdf->Output($order_data['order_id'] . '.pdf', 'D');

// $mpdf->Output('temp/'.$filename, 'I');
 
// echo 'temp/'.$filename;


}



// // Write some HTML code:
// $mpdf->WriteHTML($html);
// echo "run";
// // Save the PDF to a file
// $mpdf->Output('example.pdf', 'I');
