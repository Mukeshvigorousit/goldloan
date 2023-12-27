<?php
require_once __DIR__ . '/vendor/autoload.php';
include('include/config.php');
// Create an instance of the class:
// $mpdf = new \Mpdf\Mpdf();
$mpdf = new \Mpdf\Mpdf(['utf-8', 'A4']);

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
<table width="100%" >
<tr>
<td colspan="4"><hr></td>
</tr>
<tr> 
<td>Customer Name : <br> ऋण ग्राहक नाम :</td>
<td><b>' . strtoupper($client_data['name']) . ' <br> '.$client_data['name_hindi'].'</b></td> 
<td>Father/Husband Name : <br> पिता/पति का नाम :</td>
<td><b>' . strtoupper($client_data['father_name']) . ' <br> '.$client_data['father_name_hindi'].'</b></td> 
</tr>
<tr> 
<td>Mobile No: <br> मोबाइल नंबर :</td>
<td><b>' . strtoupper($client_data['mobile']) . '</b></td>
<td>Full Address : <br> पूरा पता :</td>
<td><b>' . strtoupper($client_data['address']) . ' ' . strtoupper($client_data['city']) . ' ' . strtoupper($client_data['state']) . '<br> '.$client_data['address_hindi'].' '.$client_data['city_hindi'].' ( '.$client_data['state_hindi'].' )</b></td> 
</tr>
<tr> 
<td>Mobile No: <br> वैकल्पिक मोबाइल नंबर : </td>
<td><b>' . strtoupper($client_data['alter_mobile']) . '</b></td>
<td></td>
<td><b></b></td> 
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
</tr>

<tr>
           
<td>Weight Of Gold: <br> सोने का वजन:</td>
<td ><b>' . strtoupper($order_data['weight_gm_gold']) . '<small> ( Gm/ग्राम)</small> + ' . strtoupper($order_data['weight_mlgm_gold']) . '<small> (MlGm/मिलीग्राम)</small>  </b> </td> 
<td ></td> 
<td ></td> 
</tr>
<tr> 
<td>Weight Of Silver: <br>चांदी का वजन:</td>
<td ><b> ' . ($order_data['weight_kg_silver']!='0'?strtoupper($order_data['weight_kg_silver']).'<small> ( Kg/किलोग्राम) </small>+': '') . strtoupper($order_data['weight_gm_silver']) . ' <small>(Gm/ग्राम)</small> + ' . strtoupper($order_data['weight_mlgm_silver']) . ' <small>(MlGm/मिलीग्राम) </small></b></td>
<td ></td>
<td ></td>
 
</tr>
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

</table>

<table width="100%">
<tr >
<td style="text-align:center;"><b> Information Of Loan Ornament' . "'" . 's By Customer <br> ऋण ग्राहक द्वारा रखे गए ऋण आभूषण रखने की जानकारी</b> </td>
</tr>
</table>

    <table width="100%" border="1" cellspacing="0" cellpadding="0" style="text-align:center;text-transform: capitalize;">
  
        <tr >
                    <td style="background-color:#e7eaec;text-transform: capitalize;padding:5px;">Grade</td>
                    <td style="background-color:#e7eaec;text-transform: capitalize;padding:5px;">Item Name</td>
                    <td style="background-color:#e7eaec;text-transform: capitalize;padding:5px;">Item Details</td>
                    <td style="background-color:#e7eaec;text-transform: capitalize;padding:5px;">Remarks</td>
                    <td style="background-color:#e7eaec;text-transform: capitalize;padding:5px;">Gross Wt. (Gm)</td>
                    <td style="background-color:#e7eaec;text-transform: capitalize;padding:5px;">Less (Gm)</td>
                    <td style="background-color:#e7eaec;text-transform: capitalize;padding:5px;">Net Wt. (Gm)</td>
                </tr>';
foreach ($item_data as $key => $item) {
    $html .= '<tr>
                    <td style="text-transform: capitalize;padding:10px;"><b> ' . $item['item_name'] . ' </b></td>
                    <td style="text-transform: capitalize;padding:10px;"><b> ' . $item['item_name_by_user'] . ' </b></td>
                    <td style="text-transform: capitalize;padding:10px;"><b> ' . $item['item_details'] . ' </b></td>
                    <td style="text-transform: capitalize;padding:10px;"><b> ' . $item['remark'] . ' </b></td>
                    <td style="text-transform: capitalize;padding:10px;"><b> ' . $item['gross_wt'] . ' </b></td>
                    <td style="text-transform: capitalize;padding:10px;"><b> ' . $item['less_wt'] . ' </b></td>
                    <td style="text-transform: capitalize;padding:10px;"><b> ' . $item['net_wt'] . ' </b></td>
                </tr>';
}

$html .= '</table>
        <table><tr style="text-align:center;">
            <td colspan="3"> <br>   Customer Signature <br>
            <img src="' . getcwd() . '\\img\\item\\item_full\\' . $client_data['client_signature_pic'] . '" style="width:120px;height:50px;"/> </td>
            <td colspan="4">     </td>
        </tr> 
    </table>  ';

$html .= ' 
        <table margin-top="30px;"> 

        <tr>
            <td  style="font-size:30px;text-align:center;">Term' . "'" . 's & Condition</td>
        </tr> 
        <tr>
            <td  style="font-size:20px;text-align:left;">  <p class="text-left" style="font-size:18px;">
            1. हमारे द्वारा गिरवे की रकम मियाद (तय समय तक) से ही रखी जाती है ।
            </p></td>
        </tr>  
        
        <tr>
        <td  style="font-size:20px;text-align:left;">
        <p class="text-left" style="font-size:18px;">
        2. किन्ही विशेष परिस्थितयों में रकम चोरी हो जाने या गुम हो जाने पर या भूल वश गल जाने पर ग्राहक को उतने वजन की दूसरी रकम या मिलावट काटकर रुपये का भुगतान किया जाएगा  ।
        </p>
        </td>
        </tr>
       
        <tr>
        <td  style="font-size:20px;text-align:left;">
        <p class="text-left" style="font-size:18px;">
        3. रकम ग्राहक अपनी स्वयं की गिरवी रखे यदि चोरी या रिश्तेदार की होगी तो जवाबदारी ग्राहक की रहेगी  ।
        </p>
        </td>
        </tr>
         
       
        <tr>
        <td  style="font-size:20px;text-align:left;">
        <p class="text-left" style="font-size:18px;">
        4. विशेष परिस्थितियों में रकम लोटाने में 15 से 20 दिन की देरी हो सकती है ।
        </p>
        </td>
        </tr>
       
       
        <tr>
        <td  style="font-size:20px;text-align:left;">
        <p class="text-left" style="font-size:18px;">
        5. रकम छुड़ाने के पश्चात रकम चेक कर के लेवें, बाद में कोई शिकायत मान्य नहीं होगी ।
        </p>
        </td>
        </tr>
    
       
        <tr>
        <td  style="font-size:20px;text-align:left;">
        <p class="text-left" style="font-size:18px;">
        6. रुपये जमा करने के 1 दिन बाद रकम दी जाएगी।
        </p>
        </td>
        </tr>
     
       
        <tr>
        <td  style="font-size:20px;text-align:left;">
        <p class="text-left" style="font-size:18px;">
        7. रकम के रुपये समय पर जमा नही करने पर रकम गला दी जावेगी। उसके पूर्व ग्राहक को आवश्यकता अनुसार मोबाईल किया जावेगा । आपका मोबाईल बंद आने, गुम हो जाने पर, नम्बर बदलने की सूचना नही देने पर हमारी कोई जवाबदारी नही रहेगी। 
        </p>
        </td>
        </tr> 
        <tr>
        <td  style="font-size:20px;text-align:left;">
        <p class="text-left" style="font-size:18px;">
        8. रकम छुड़ाने की तय समय सीमा के बाद या एक वर्ष के बाद ब्याज पर ब्याज (चक्रवर्ती ब्याज ) देय होगा। चक्रवर्ती ब्याज तय समय के बाद लेने या एक वर्ष के पश्चात लेने का अंतिम निर्णय हमारा रहेगा।
        </p>
        </td>
        </tr>  
    </table>
    <br></br> <br></br> <br></br> <br></br>
    <table padding-top="30px;"> 
    <tr>
    <td  style="font-size:25px;text-align:center;">
    <p class="text-left" style="font-size:30px;font-style:bolder;">
    <b><u>ग्राहक का इकरार नामा </u><b>
    </p>
    </td>
    </tr> 
    <tr>
    <td  style="font-size:20px;text-align:left;">
    <p class="text-left" style="font-size:18px;">
    मेरे द्वारा गिरवी रखी गई रकम को छुड़ाने की आखरी तारीख <b>'.date_convertor(loan_last_date($order_data['loan_date'],$order_data['loan_period_month'])).'</b> रहेगी। यदि इस दिनांक तक मेरे द्वारा रकम का ब्याज जमा नहीं किया गया या रकम नहीं छुड़ाई गई तो मैं आपको अधिकार देता हूँ / देती हूँ कि आप स्वयं रकम गलाकर, बेचकर मूल जमा कर लेवें । रकम छुड़ाने की आखरी दिनांक के बाद मेरा कोई दावा मान्य नहीं होगा। ना ही मेरे द्वारा कोई रकम का हिसाब मांगा जाएगा ।
    </p>
    </td>
    </tr> 
    <tr>
    <td style="font-size:20px;text-align:left;">
    <p class="text-left" style="font-size:18px;"> <br></br>
    <img src="' . getcwd() . '\\img\\item\\item_full\\' . $client_data['client_signature_pic'] . '" style="width:120px;height:50px;"/>  <br></br> 

    ऋण धारक हस्ताक्षर
    </p>
    </td>
    </tr>
    </table>
    
    ';

$html .= '</body>
</html>';


// echo $html;
$mpdf->WriteHTML($html);

$mpdf->Output('INV-' . $order_data['order_id'] . '.pdf', 'D');
    
}

 
// elseif($_GET['action']=='item_slip ')
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



echo "<br>";
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
<td  style="text-align:right">Recived Date :' . date("d/m/Y", strtotime($assign_investor_list['end_date'])) . ' <b> ';

echo date("d-M-Y h:m:s");

$html .= ' </b></td>
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
<tr> 
<td style="text-align:center;"><b>Amount Given Date :</b> ' . date("d/m/Y", strtotime($assign_investor_list['start_date'])) . ' </td>
</tr>
<tr> 
<td style="text-align:center;"><b>Amount Recived Date :</b> ' . date("d/m/Y", strtotime($assign_investor_list['end_date'])) . ' </td>
</tr>
<tr> 
<td style="text-align:center;"><b>Total Intrest :</b> ' . $assign_investor_list['totalInterestTillDate'] . ' </td>
</tr>
<tr> 
<td style="text-align:center;"><b>Total Days :</b> ' . getDaysByTwoDates($assign_investor_list['start_date'],$assign_investor_list['end_date']) . ' Days </td>
</tr>

 
</table>

<br><br><br><br><br><br><br><br>
<table width="100%" >
<tr> 
<td style="text-align:center;font-size:15px;">Details of goods given by the investor <br> निवेशक की दिए गए सामान का विवरण </td>
</tr>
 
</table>


<table width="100%" border="1" cellspacing="0" cellpadding="0" style="text-align:center;text-transform: capitalize;">
 
  
        <tr >
                    <td style="background-color:#e7eaec;text-transform: capitalize;padding:5px;">Grade</td>
                    <td style="background-color:#e7eaec;text-transform: capitalize;padding:5px;">Item Name</td>
                    <td style="background-color:#e7eaec;text-transform: capitalize;padding:5px;">Item Details</td>
                    <td style="background-color:#e7eaec;text-transform: capitalize;padding:5px;">Remarks</td>
                    <td style="background-color:#e7eaec;text-transform: capitalize;padding:5px;">Gross Wt. (Gm)</td>
                    <td style="background-color:#e7eaec;text-transform: capitalize;padding:5px;">Less (Gm)</td>
                    <td style="background-color:#e7eaec;text-transform: capitalize;padding:5px;">Net Wt. (Gm)</td>
                </tr>';
foreach ($item_data as $key => $item) {
    $html .= '<tr>
                    <td style="text-transform: capitalize;padding:10px;"><b> ' . $item['item_name'] . ' </b></td>
                    <td style="text-transform: capitalize;padding:10px;"><b> ' . $item['item_name_by_user'] . ' </b></td>
                    <td style="text-transform: capitalize;padding:10px;"><b> ' . $item['item_details'] . ' </b></td>
                    <td style="text-transform: capitalize;padding:10px;"><b> ' . $item['remark'] . ' </b></td>
                    <td style="text-transform: capitalize;padding:10px;"><b> ' . $item['gross_wt'] . ' </b></td>
                    <td style="text-transform: capitalize;padding:10px;"><b> ' . $item['less_wt'] . ' </b></td>
                    <td style="text-transform: capitalize;padding:10px;"><b> ' . $item['net_wt'] . ' </b></td>
                </tr>';
}

 $html .= '</table>';



$html .= '</body>
</html>'; 


//  echo $html;
$mpdf->WriteHTML($html);

// $mpdf->Output('final.pdf', 'I');
$mpdf->Output($order_data['order_id'] . '.pdf', 'D');

// $mpdf->Output('temp/'.$filename, 'I');
 
// echo 'temp/'.$filename;


}



// // Write some HTML code:
// $mpdf->WriteHTML($html);
// echo "run";
// // Save the PDF to a file
// $mpdf->Output('example.pdf', 'I');
