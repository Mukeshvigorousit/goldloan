<?php
include('include/config.php');
$_GET=sanatize($_GET);
$_POST=sanatize($_POST);

 

$query_string=$_SERVER['REDIRECT_QUERY_STRING'];
$orderIdArray=[];
$investor_list = get_data("user_tbl","user_type='investor'");
$reportType = $_GET['report_type'];
$investor_id='';
$investorAssignData=[];
 $totalPrinciaplReceived = 0;
    $totalPrinciaplPaid = 0;
    $totalInterestPaid = 0;
    $totalInterestTillDate = 0;
    
    
if(isset($_GET['investor_id']))
{
    $investor_id = $_GET['investor_id'];
    $investorAssignData = get_data("assign_investor_list","investor_id='".$investor_id."' AND status='active'");
    $totalPrinciaplReceived = 0;
    $totalPrinciaplPaid = 0;
    $totalInterestPaid = 0;
    $totalInterestTillDate = 0;
    foreach ($investorAssignData as $key => $value) {
        $totalPrinciaplReceived +=$value['amount'];
        $totalPrinciaplPaid +=$value['totalPrincipalPaid'];
        $totalInterestPaid +=$value['totalInterestPaid'];
        $totalInterestTillDate +=$value['totalInterestTillDate'];
     
    }
}


// _dx( $investorAssignData);

 

include('header.php');
?>

            <div class="row wrapper border-bottom white-bg page-heading">

                <div class="col-sm-6">
                    <h2><?= ucfirst($_GET['page_name']);?></h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="dashboard.php?page_name=dashboard">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">
                           Report Management
                        </li>
                    </ol>
                </div>


                <div class="col-sm-4">
                    <h2></h2>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <select id="investor_id" class="form-control" onchange="selectInvestor()">
                            <option  value="">Select Investor</option>
                                <?php  foreach ($investor_list as $key => $list) { ?>
                                   <option <?php  if($investor_id==$list['id']) echo "selected" ?>  value="<?= $list['id'] ?>"><?= $list['name'] ?></option>
                              <?php  } ?>
                            </select>
                        </li>
                        
                    </ol>
                </div>

            </div> 


<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">


            <div class="ibox-content">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover dataTables-example">
                        <thead>
                            <tr>
                                <th>Sno</th>
                                <th>Order Id</th>
                                <th>Client Name</th>
                                <th>Amount Received</th>
                                <th>Interest Rate</th>
                                <th>Total Interest Till Today</th>
                                <th>Total Paid Intresest</th>
                                <th>Total Paid Principal</th>
                                <th>Item Details</th>
                                <th>Order Details</th>
                                <th>Download</th>
                                
                               
                            </tr>


                        </thead>
                        <tbody>

                           

                            <?php $no=1; foreach ($investorAssignData as $key => $data) { ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= $data['order_id']?></td>
                                <td><?= $data['client_name']?></td>
                                <td><?= $data['amount']?></td>
                                <td><?= $data['interest_rate']?></td>
                                <td><?= $data['totalInterestTillDate']?></td>
                                <td><?= $data['totalInterestPaid']?></td>
                                <td><?= $data['totalPrincipalPaid']?></td>
                                <td>
                                    
                                    <a href="item_details?order_id=<?= $data['order_id'] ?>&client_id=<?= $data['client_id']?>&assign_investor_id=<?= $data['assign_investor_id']?>&page_name=itemReport" class="btn btn-primary" > Item Details </a>
                                
                                     
                                </td>
                                <td>
                                     <a href="investor_details?order_id=<?= $data['order_id'] ?>&client_id=<?= $data['client_id']?>&assign_investor_id=<?= $data['assign_investor_id']?>" class="btn btn-primary" >  Order Details </a>
                                
                                     
                                
                                </td>
                                <td>
                                    <!-- <?php  
 $assign_investor_list = get_data("assign_investor_list", "order_id='" . $data['order_id'] . "' AND client_id='".$data['client_id'] ."' AND investor_id='".$data['investor_id']."'",'s');

 if(!empty($data['end_date']))
 { ?>
   <a href="gernrate_pdf?order_id=<?= $data['order_id'] ?>&action=item_slip" 
    class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i>Girvi Slip </a>  
    <?php
 } 

                                    ?> -->
                                     <a href="gernrate_pdf?order_id=<?= $data['order_id'] ?>&action=item_slip" 
    class="btn btn-primary" ><i class="fa fa-file-pdf-o"></i> Girvi Slip </a>  
                                
                                </td>
                                
                            </tr>
                            <?php } ?>

                        </tbody>


                        <tfoot style="background-color:pink">

                             <tr>
                                <th>Grand Total</th>
                                <th></th>
                                <th></th>
                               
                                <th><?=  $totalPrinciaplReceived   ?></th>
                                <th></th>
                                <th><?= $totalInterestTillDate ?></th>
                                <th><?= $totalInterestPaid  ?></th>
                                <th><?= $totalPrinciaplPaid ?></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                
                            </tr>

                        </tfoot>

                    </table>
                </div>

            </div>
        </div>
    </div>
</div>

<script type="text/javascript">

   var query_string = "<?= $query_string ?>"
   const selectInvestor=()=>{
       var investor_id = $("#investor_id").val()
       window.location.href = "investorReport?report_type=investorWise&page_name=report&investor_id="+investor_id
    }

    // $(document).on('click','#download_slip',function(){
    //     var order_id=$(this).data("order_id");
    //     var client_id=$(this).data("client_id");
    //     var assign_investor_id=$(this).data("assign_investor_id");


      
    // });

    // function download_slip()
    // {
    //     alert("dfadfad");
    //     alert($(this).data("order_id"));
    //     var order_id=$(this).data('order_id');
    //     alert(order_id);
    // }
</script>
         
<?php include('footer.php'); ?>