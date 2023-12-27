<?php 
require_once __DIR__.'/../vendor/autoload.php';

use Stichoza\GoogleTranslate\GoogleTranslate;
 

date_default_timezone_set('Asia/Kolkata');
$date_time = date("d-m-Y H:i:s");
$time = date("H:i:s");
$date = date('d-m-Y');
$insert_date = date('Y-m-d');

function _d($data = '')
{

  echo "<pre>", print_r($data);
}

function _dx($data)
{

  echo "<pre>", print_r($data);
  die();
}

function date_convertor($date, $input = '')
{
  $method = "d-m-Y"; 

  if (empty($input)) { 
    $date = date($method, strtotime($date));
  } else { 
 
    $date = date($input, strtotime($date));
  }
 
  return $date;
}

function user_type($type)
{
  if ($type == 1) {
    return 'superadmin';
  } else if ($type == 2) {
    return 'admin';
  } else if ($type == 3) {
    return 'master';
  } else if ($type == 4) {
    return 'superagent';
  } else if ($type == 5) {
    return 'agent';
  } else {
    return false;
  }
}

function page_backdoor($user_type)
{
  global $con;
  $query = "SELECT page_name FROM page_backdoor WHERE user_type='$user_type'";
  $result = mysqli_query($con, $query);
  $send_array = array();
  while ($fetch_data = mysqli_fetch_assoc($result)) {
    array_push($send_array, $fetch_data);
  }
  return $send_array;
}
function get_backdoor($url)
{
  global $con;
  $query = "SELECT * FROM backdoor WHERE user_type='employee' AND url='$url'";
  $res = mysqli_query($con, $query);
  return $data = mysqli_num_rows($res);
}

function api_data_curl_1($url, $post_fields = null, $headers = null)
{
  $ch = curl_init();
  $timeout = 5;
  $headers = [
    'Authorization:Restrictedapi',

  ];
  curl_setopt($ch, CURLOPT_URL, $url);
  if ($headers && !empty($headers)) {
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  }
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
  }
  curl_close($ch);
  return $data;
}
function api_data_curl_no_header($url, $post_fields = null, $headers = null)
{
  $ch = curl_init();
  $timeout = 5;
  $headers = [
    'Authorization:Restrictedapi',

  ];
  curl_setopt($ch, CURLOPT_URL, $url);
  if ($headers && !empty($headers)) {
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
  }
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  if (curl_errno($ch)) {
    echo 'Error:' . curl_error($ch);
  }
  curl_close($ch);
  return $data;
}

function ip()
{
  if (!empty($_SERVER['HTTP_CLIENT_IP']))   //check ip from share internet
  {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
  } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))   //to check ip is pass from proxy
  {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
  } else {
    $ip = $_SERVER['REMOTE_ADDR'];
  }

  return $ip;
}

function user_log()
{
  global $con;
  global $id;
  date_default_timezone_set('Asia/Kolkata');

  $ip = ip();
  $date_time = date("d-m-Y H:i:s");
  $get_data = '';
  $post_data = '';
  $load_url = '';
  $request_uri = $_SERVER['REQUEST_URI'];
  $user_type = 'admin';
  if (isset($_SERVER['HTTP_REFERER'])) {
    $load_url = $_SERVER['HTTP_REFERER'];
  }
  if (isset($_GET)) {
    $get_data = json_encode($_GET);
  }
  if (isset($_POST)) {
    $post_data = json_encode($_POST);
  }
  $query = "INSERT INTO user_log_tbl(user_id,user_type,ip_address,time_inserted,hit_url,previous_url,get_data,post_data)  VALUES('$id','$user_type','$ip','$date_time','$request_uri','$load_url','$get_data','$post_data')";
  mysqli_query($con, $query);
  return true;
}

function is_client($client_id)
{
  global $con;
  global $master_id;
  global $load_url;
  $query = "SELECT id FROM client WHERE id=$client_id";

  $res = mysqli_query($con, $query);
  $num = mysqli_num_rows($res);
  if ($num == 1) {
    $status = 1;
    return true;
  } else {
    $_SESSION['error_msg'] = 'Unauthorised use';
    header('location:dashboard.php');
    exit();
    die;
    return false;
  }
}

function _date()
{
  date_default_timezone_set('Asia/Kolkata');
  return  date('d-m-Y');
}

function loan_last_date($date,$time='0')
{
 

   
  return date('Y-m-d', strtotime($date. ' + '.$time.' months'));
}
function _time()
{
  date_default_timezone_set('Asia/Kolkata');
  return  date("H:i:s");
}
function _date_time()
{
  date_default_timezone_set('Asia/Kolkata');
  return  date("d-m-Y H:i:s");
}

function color($value)
{
  if ($value < 0) {
    return  "<h4 style='color:#FF0000;'>" . $value . "</h4>";
  } else {
    return  "<h4 style='color:#008000;'>" . $value . "</h4>";
  }
}

function active($page_name)
{
  if (isset($_GET['page_name'])) {
    if ($_GET['page_name'] == $page_name) {
      return "active";
    }
  } else {
    return true;
  }
}

// function dataInGram($value, $unit = '')
// {
//   $return = $value;
//   if (empty($unit)) {
//     $unit = 'miligram';
//   }
//   if ($unit == 'miligram') {
//     $return = ($value / 1000);
//   }

//   if ($unit == 'kilogram') {
//     $return = ($value * 1000);
//   }

//   return $return;
// } 
 
 

function dataInGram($netWeightInGrams) {
  // Conversion factors
  $grams_to_kg = 0.001;
  $grams_to_mg = 1000;

  // Convert to kilograms, grams, and milligrams
  $weightInKilograms = floor($netWeightInGrams * $grams_to_kg);
  $remainingGrams = floor(($netWeightInGrams - $weightInKilograms));
  $weightInMilligrams = ($netWeightInGrams-$remainingGrams) * $grams_to_mg;

  // Prepare the result in an associative array
  $result = array(
      'weight_kg' => $weightInKilograms,
      'weight_gram' => $remainingGrams,
      'weight_mlgm' => $weightInMilligrams
  );

  return $result;
}


 

function send_data($status = '', $msg = '', $data = '')
{
  $status = empty($status) ? 'error' : $status;
  $msg = empty($msg) ? '' : $msg;
  $data = empty($data) ? [] : $data;
  $send_data = [
    'data' => $data,
    'msg' => $msg,
    'status' => $status
  ];
  echo json_encode($send_data);
}

function item_name($item_id)
{
  return get_data("item_list", "item_id='" . $item_id . "'", 's')['item_name'];
}
function order_detail($order_id)
{
  return get_data("order_tbl", "order_id='" . $order_id . "'", 's');
}
function store_detail($store_id)
{
  return get_data("store_tbl", "store_id='" . $store_id . "'", 's');
}
function user_detail($user_id)
{
  return get_data("user_tbl", "id='" . $user_id . "'", 's');
}


function order_item_list($user_id)
{
   return get_data("user_tbl","id='".$user_id."'",'s');
}

function getIndianCurrency(float $number)
{
  $decimal = round($number - ($no = floor($number)), 2) * 100;
  $hundred = null;
  $digits_length = strlen($no);
  $i = 0;
  $str = array();
  $words = array(
    0 => '', 1 => 'one', 2 => 'two',
    3 => 'three', 4 => 'four', 5 => 'five', 6 => 'six',
    7 => 'seven', 8 => 'eight', 9 => 'nine',
    10 => 'ten', 11 => 'eleven', 12 => 'twelve',
    13 => 'thirteen', 14 => 'fourteen', 15 => 'fifteen',
    16 => 'sixteen', 17 => 'seventeen', 18 => 'eighteen',
    19 => 'nineteen', 20 => 'twenty', 30 => 'thirty',
    40 => 'forty', 50 => 'fifty', 60 => 'sixty',
    70 => 'seventy', 80 => 'eighty', 90 => 'ninety'
  );
  $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
  while ($i < $digits_length) {
    $divider = ($i == 2) ? 10 : 100;
    $number = floor($no % $divider);
    $no = floor($no / $divider);
    $i += $divider == 10 ? 1 : 2;
    if ($number) {
      $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
      $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
      $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural . ' ' . $hundred : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural . ' ' . $hundred;
    } else $str[] = null;
  }
  $Rupees = implode('', array_reverse($str));
  $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
  return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
}

function getDaysByTwoDates($date1, $date2)
{
  $date1 = strtotime($date1);
  $date2 = strtotime($date2);
  $diff = $date2 - $date1;
  $days = floor($diff / (60 * 60 * 24));
  return $days;
}

function getOrderDataByOrderId($order_id, $order_data = [], $update = false)
{

  if (empty($order_data)) {
    $order_data = order_detail($order_id);
  }
 
  $clientInterestArray = [];
  $investorInterestArray = [];
  $principalArray = [];
  $investorArray = [];
  $allArray = [];

  $totalClientInterestAmountReceived = 0;
  $totalInvestorInterestAmount = 0;
  $totalprincipalAmount = 0;
  $totalprincipalAmountReceived = 0;
  $totalprincipalAmountPay = 0;
  $totalinvestorAmount = 0;
  $totalInvestorAmountReceived = 0;
  $totalInvestorAmountPaid = 0;

  $orderGrandTotalCustomer = 0;
  $totalInvestorIntrestPay = 0;

  
  $transactionLog = get_data("transaction_log", "order_id='" . $order_id . "' ");

  foreach ($transactionLog as $key => $value) {
    if ($value['overall_type'] == 'principal') {
      $totalprincipalAmount += $value['amount'];
      if ($value['amount'] < 0) {
        $totalprincipalAmountPay += $value['amount'];
      }
      if ($value['amount'] > 0) {
        $totalprincipalAmountReceived += $value['amount'];
      }
      array_push($principalArray, $value);
      array_push($allArray, $value);
    }

    if ($value['overall_type'] == 'investorAmount') {
      $totalinvestorAmount += $value['amount'];
      if ($value['amount'] > 0) {
        $totalInvestorAmountReceived += $value['amount'];
      }
      if ($value['amount'] < 0) {
        $totalInvestorAmountPaid += $value['amount'];
      }
      array_push($investorArray, $value);
    }

    if ($value['overall_type'] == 'investorInterest') {
      $totalInvestorInterestAmount += $value['amount'];
      array_push($investorArray, $value);
    }

    if ($value['overall_type'] == 'interest') {
      $totalClientInterestAmountReceived += $value['amount'];
      array_push($clientInterestArray, $value);
      array_push($allArray, $value);
    }
  }

$oldintrest=$order_data['totalInterestTillDate'];

  $totalprincipalAmountRest = -$totalprincipalAmountPay - $totalprincipalAmountReceived;

  $order_data['totalprincipalAmountRest'] = $totalprincipalAmountRest;
  $order_data['totalprincipalAmountPay'] = abs($totalprincipalAmountPay);
  $order_data['totalprincipalAmountReceived'] = $totalprincipalAmountReceived;
  $order_data['totalClientInterestAmountReceived'] = $totalClientInterestAmountReceived;
  $order_data['totalAmountReceivedTillDate'] = $totalprincipalAmountReceived + $totalClientInterestAmountReceived;

  $amountArray = get_data("amount_tbl", "order_id='" . $order_id . "' ");

  $loanDates = getDaysByTwoDates($order_data['loan_date'], _date());
  $interestPerDay = $order_data['loan_interest'] / 100;



  if($order_data['is_finish']!=1)
  {   

    $loanDates = getDaysByTwoDates($order_data['loan_date'], _date());
$interestPerDay = $order_data['loan_interest'] / 100;

if ($loanDates <= 15) { 
    $totalInterestTillDate = round(($order_data['loan_amount'] * $interestPerDay * 15) / 30, 2);
} else {
    // if ($order_data['totalInterestTillDate'] == '0' || $order_data['totalInterestTillDate'] === null) {
    //     $totalInterestTillDate = round(($order_data['loan_amount'] * $interestPerDay * $loanDates) / 30, 2);
        
    // } 
    // else { 
    //     if ($order_data['LastPrincipalRecivedDate'] != '') {
    //         $daysSinceLastPrincipalReceived = getDaysByTwoDates($order_data['LastPrincipalRecivedDate'], _date());
    //         $totalInterestTillDate = $order_data['totalInterestTillDate'] + round(($order_data['loan_amount'] * $interestPerDay * $daysSinceLastPrincipalReceived) / 30, 2);
    //        // _dx($totalInterestTillDate);
    //     } else {
    //         $totalInterestTillDate = round($loanDates * $interestPerDay * abs($order_data['loan_amount']) / 100, 2);
    //     }
    //    // _dx($totalInterestTillDate);
    // }

    
$totalInterestTillDate=0;
$interestPerDay = $order_data['loan_interest'] / 100;

$previousSum = 0;  

foreach ($amountArray as  $key => $value) {
    if ($value['end_date'] == '') {
        $loanDates = getDaysByTwoDates($value['start_date'], _date());
        $previousSum += abs($value['amount']);
        $totalInterestTillDate += round((abs($value['amount']) * $interestPerDay * $loanDates) / 30, 2);

    } else {
        $loanDates = getDaysByTwoDates($value['start_date'], $value['end_date']);
        $previousSum += abs($value['amount']);
        $totalInterestTillDate +=round(($previousSum * $interestPerDay * $loanDates) / 30, 2);
    } 
    $value['amount'] += $previousSum; 
}

 



    


 
 

 
    // $totalInterestTillDate = round(($order_data['loan_amount'] * $interestPerDay * $loanDates) / 30, 2);

}

  }
  else
  {

    $loanDates = getDaysByTwoDates($order_data['loan_date'], $order_data['loan_finish_date']);
    $interestPerDay = $order_data['loan_interest'] / 100;
    $totalInterestTillDate = round(($order_data['loan_amount'] * $interestPerDay * $loanDates) / 30, 2);
  }


 

// if($oldintrest>$totalInterestTillDate)
// {
//   $totalInterestTillDate=$oldintrest;
// }

// adding 3days extra intrest if principal payed

// if($order_data['LastPrincipalRecivedDate']==_date())
// {
 
//   $totalInterestTillDate += round((abs($previousSum-$order_data['totalPrincipalReceived']) * $interestPerDay * 3) / 30, 2);
// }
 



$order_data['totalInterestTillDate'] = $totalInterestTillDate;
 


    $totalRestInterest = round($totalInterestTillDate - $totalClientInterestAmountReceived, 2);  

  $order_data['totalRestInterest'] = $totalRestInterest; 
  $totalAmountTakenFromCLientTillDate = $totalprincipalAmountRest + $totalRestInterest;
  $order_data['totalAmountTakenFromCLientTillDate'] = $totalAmountTakenFromCLientTillDate;

  $order_data['totalAmountPaidTillDate'] = abs($totalprincipalAmountPay) + $totalInterestTillDate;

  $order_data['totalInvestorAmountReceived'] = $totalInvestorAmountReceived;
  $order_data['totalInvestorAmountPaid'] = $totalInvestorAmountPaid;

  $order_data['allArray'] = $allArray;
  $order_data['clientInterestArray'] = $clientInterestArray;
  $order_data['investorArray'] = $investorArray;
  $order_data['principalArray'] = $principalArray;

  if ($update) {

    $updateArray = [
      'totalInterestReceived' => $order_data['totalClientInterestAmountReceived'],
      'totalPrincipalReceived' => $order_data['totalprincipalAmountReceived'],
      'totalInterestTillDate' => $order_data['totalInterestTillDate'],
      'totalPrincipalPayToInvestor' => $order_data['totalInvestorAmountPaid'],
      'totalPrincipalReceivedFromInvestor' => abs($order_data['totalInvestorAmountReceived']),
      'totalInvestorIntrestPay' => $totalInvestorInterestAmount,
    ];

    $updatedata = update_array("order_tbl", $updateArray, "order_id='" . $order_id . "'");
  }

  return $order_data;
}

function updateInvestorData($investor_id, $order_id, $assignTableData, $order_data = [], $transactioData = [], $update = false)
{
  if (empty($order_data)) {
    $order_data = order_detail($order_id);
  }
  if (empty($transactioData)) {
    $transactioData = get_data("transaction_log", "user_id='" . $investor_id . "' AND order_id='" . $order_id . "'");
  }
  $totalAmountPaidToInvestor = 0;
  $totalIntrestPaidToInvestor = 0;
  $totalAmountReceivedFromInvestor = 0;
  foreach ($transactioData as $key => $transaction) {
    if ($transaction['user_id'] == $investor_id) {
      if ($transaction['overall_type'] == "investorAmount") {
        if ($transaction['amount'] < 0) {
          $totalAmountPaidToInvestor += $transaction['amount'];
        }
        if ($transaction['amount'] > 0) {
          $totalAmountReceivedFromInvestor += $transaction['amount'];
        }
      }

      if ($transaction['overall_type'] == "investorInterest") {
        $totalIntrestPaidToInvestor += $transaction['amount'];
      }
    }
  }

  $loanDates = getDaysByTwoDates($assignTableData['start_date'], _date());
  $interestPerDay = ($assignTableData['interest_rate']) / (30);
  $totalnterestTillDate = round($loanDates * $interestPerDay * abs($assignTableData['amount']) / 100, 2);

  $updateArray = [
    'totalPrincipalPaid' => abs($totalAmountPaidToInvestor),
    'totalPrincipalReceived' => abs($totalAmountReceivedFromInvestor),
    'totalInterestPaid' => abs($totalIntrestPaidToInvestor),
    'totalInterestTillDate' => abs($totalnterestTillDate)
  ];

  if ($update) {
    update_array("assign_investor_list", $updateArray, "assign_investor_id = '" . $assignTableData['assign_investor_id'] . "'");
  }

  return $updateArray;
}



function get_loan_by_loan_type()
{

  $item_list=get_data('item_list');
 
 
$totalloanbyloantypes=[]; 

  foreach($item_list as $key => $item)
  {
    $data=get_data("order_tbl ","item_id='".$item['item_id']."' AND status=1",'s','count(*) as total_customer,sum(loan_amount) as total_loan,sum(totalPrincipalReceived) as total_recived, (sum(loan_amount)-sum(totalPrincipalReceived) ) as total_remaing');


      
    $totalloanbyloantypes[$item['item_name']]=$data;

  }

  
  return  $totalloanbyloantypes;
}

function translateText($text) {
  $tr = new GoogleTranslate('en');
  $tr->setSource('en'); // Detect language automatically

  // You can set the target language dynamically if needed
  // $translator->setTarget($targetLanguage);
  $tr->setTarget('hi');

  return $tr->translate($text);
}
 


function get_pending_order()
{
  $orders = get_data("order_tbl", "status=1");

  foreach ($orders as &$order) { 

    $client = user_detail($order['client_id']);

 
    $order['client_data']['client_name']= $client['name'];
    $order['client_data']['mobile']=$client['mobile'];
    $order['client_data']['address']=$client['address']; 

  }
 
  return $orders;
}



 

 


