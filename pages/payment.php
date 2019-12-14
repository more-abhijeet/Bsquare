<?php
session_start ();
if (! (isset ( $_SESSION ['login'] ))) {
    header ( 'location:../index.php' );
}
include('../config/DbFunction.php');
$obj=new DbFunction();
$id=$_GET['id'];
$rs=$obj->showPayment($id);
if($rs==null){
    $rs=$obj->create_payment_Details($id);
}
$res=$rs->fetch_object();
$index = 0;
$paymentDetails = array();
foreach($res as $key){
    $paymentDetails[$index] = $key;
    $index++;
}
$package_amount =  json_decode($paymentDetails[4]);
$amount = json_decode($paymentDetails[1]);
$payment_status = json_decode($paymentDetails[2]);
$paymentDate = json_decode($paymentDetails[5]);
$pendingPayment = json_decode($paymentDetails[7]);
$paymentReceivedTable = unserialize($paymentDetails[6]);
$totalPending = json_decode($paymentDetails[8]);
function getPaymentScheduleById($id){
    $obj = new DbFunction($id);
    $rs = $obj->getPaymentScheduleById($id);
    $res = $rs->fetch_object();
    return $res;
}

if(isset($_POST['submit1'])){
    //$obj->updateDueAmountBydate($id);
    $payment = $obj->addPayment($_POST['addAmount'],$id);
    $paymentReceivedTable =  unserialize(($payment->fetch_object())->payment);
    header ( 'location:payment.php?id='.$id );
}

// if(isset($_POST['submit2'])){
//     $obj2=new DbFunction();
//     // $obj2->store_payment_due_details($id,$_POST['package_amount'],$_POST['config'],$paymentDate);
// }

if(isset($_POST['submit'])){
    $rs = $obj->store_Package_Amount($_POST['package_amount'],$id);
    $res=$rs->fetch_object();
    header ( 'location:payment.php?id='.$id );
    $index = 0;
    $data = array();
    foreach($res as $key){
        $data[$index] = $key;
        $index++;
    }
    $package_amount =  json_decode($data[4]);
    $amount = json_decode($data[1]);
    $pendingPayment = json_decode($data[7]);
    $totalPending = json_decode($paymentDetails[8]);
}

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Payment</title>
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
        <link href="../bower_components/metisMenu/dist/metisMenu.min.css" rel="stylesheet">
        <link href="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.css" rel="stylesheet">
        <link href="../bower_components/datatables-responsive/css/dataTables.responsive.css" rel="stylesheet">
        <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
        <link href="../bower_components/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="wrapper">
            <!-- Navigation -->
            <?php include('leftbar.php')?>;
            <nav>
                <div id="page-wrapper">

                    <div class="row">
                        <div class="col-lg-12">
                            <h4 class="page-header"> <?php echo strtoupper("welcome"." ".htmlentities($_SESSION['login']));?></h4>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <form method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            Payment Details
                                        </div>
                                        <!-- /.panel-heading -->
                                        <div class="panel-body">
                                            <div class="dataTable_wrapper">
                                                <form method="post">
                                                    <div class="form-group">
                                                        <div class="col-lg-2">
                                                            <label>Total package</label>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <?php if(sizeof($paymentReceivedTable) > 0){ 
                                                                    if(($package_amount)!=0 && ($paymentReceivedTable[0])["amount"] != 0){?>
                                                            <input class="form-control" name="package_amount" value="<?php echo htmlentities($package_amount);?>" readonly >
                                                            <?php } }else{?>
                                                            <input class="form-control" name="package_amount" value="<?php echo htmlentities($package_amount);?>"  >
                                                            <?php } ?>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <input type="submit" class="btn btn-primary" name="submit" value="Get Payment Details" >
                                                        </div>
                                                        <div class="col-lg-2" style="text-align: right;">
                                                            <label>Payment</label>
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <input class="form-control" name="addAmount" value=""  >
                                                        </div>
                                                        <input type="submit" class="btn btn-primary" name="submit1" value="Add Payment" >
                                                    </div>
                                                </form>        
                                            </div>
                                            <table class="table table-striped table-bordered table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th>S No</th>
                                                        <th>Payment Date</th>
                                                        <th>Payment Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if(sizeof($paymentReceivedTable)>0){
                                                    for($i =0; $i<sizeof($paymentReceivedTable);$i++){
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td><?php echo ($i+1) ?></td>
                                                        <td ><?php echo ($paymentReceivedTable[$i])["date"];?></td>
                                                        <td width="40%"><?php echo htmlentities(($paymentReceivedTable[$i])["amount"]);?></td>
                                                        </td>
                                                    </tr>
                                                    <?php  } } ?>
                                                </tbody>
                                            </table>
                                            <table class="table table-striped table-bordered table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th>S No</th>
                                                        <th>Payment Date</th>
                                                        <th>Payment Schedule</th>
                                                        <th>Percentage</th>
                                                        <th>Amount</th>
                                                        <th>Total Pending Payment</th>
                                                        <th>Pending Payment By Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $arr = array("hgh","key1","key2","key3","key4","key5","key6","key7","key8","key9","key10","key11","key12","key13","key14");
                                                    for($i =1; $i<15;$i++){
                                                    $xyz = $arr[$i];
                                                    $paymentSchedule = getPaymentScheduleById($i);
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td width="6%"><?php echo $i ?></td>
                                                        <td width="11%"><?php echo $paymentSchedule->paymentDate;?></td>
                                                        <td width="40%"><?php echo htmlentities($paymentSchedule->payment_schedule);?></td>
                                                        <td width="11%"><?php echo htmlentities($paymentSchedule->payment_percentage);?>%</td>
                                                        <td width="9%"><?php echo htmlentities($amount->$xyz);?></td>
                                                        <td width="10%"><?php echo htmlentities($totalPending->$xyz);?>
                                                        <td width="10%"><?php echo htmlentities($pendingPayment->$xyz);?>
                                                    </tr>
                                                    <?php  } ?>
                                                </tbody>
                                            </table>
                                            <div class="col-lg-6">
                                                <!-- <input type="submit" style="margin-left: 400px" class="btn btn-primary"   name="submit2" value="Save"> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- /.table-responsive -->
                
                <!-- /#wrapper -->
                <!-- jQuery -->
                <script src="../bower_components/jquery/dist/jquery.min.js"></script>
                <!-- Bootstrap Core JavaScript -->
                <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
                <!-- Metis Menu Plugin JavaScript -->
                <script src="../bower_components/metisMenu/dist/metisMenu.min.js"></script>
                <!-- DataTables JavaScript -->
                <script src="../bower_components/datatables/media/js/jquery.dataTables.min.js"></script>
                <script src="../bower_components/datatables-plugins/integration/bootstrap/3/dataTables.bootstrap.min.js"></script>
                <!-- Custom Theme JavaScript -->
                <script src="../dist/js/sb-admin-2.js"></script>
                <!-- Page-Level Demo Scripts - Tables - Use for reference -->
                <script>
                $(document).ready(function() {
                $('#dataTables-example').DataTable({
                responsive: true
                });
                });
                </script>
            </body>
        </html>