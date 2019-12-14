<?php
session_start ();
if (! (isset ( $_SESSION ['login'] ))) {
header ( 'location:../index.php' );
}
include('../config/DbFunction.php');
$obj=new DbFunction();
$rs=$obj->showBooking();
$obj10  = new DbFunction();
$rs10 = $obj10->getTotalPackageAmount();
$res10 = $rs10->fetch_object();
if(isset($_GET['del']))
{
$obj->del_Booking(intval($_GET['del']));
}
if(isset($_POST['submit1'])){
    $information = array();
    while ($resM=$rs->fetch_object()){
        $resMD = getDue($resM->B_id);
       // var_dump($resMD->dueTillToday);
       // echo "<br>";
       if($resMD->dueTillToday != "0" ){
                $myObj = array(
                    "email" =>$resM->email1,
                    "name" =>$resM->fname1,
                    "amount" => $resMD->dueTillToday,
                );
                array_push($information,json_encode($myObj));
       		}
          }
     foreach ($information as $key => $value) {
       	$objM = json_decode($value);
       	$to = $objM->email;
        $subject = "Reminder of payment due of ".$objM->amount." Rs" ;
        $body = "Dear ".$objM->name."\n\n This mail is being written to inform you that your payment of ".$objM->amount." Rs\n\nWe kindly request you to make the payment, as we must have all our payments in on time.\n\nRegards\nBSqaure";
        $obj-> sendMail($to,$subject,$body);
     
    }
	$rs=$obj->showBooking();
    }
if(isset($_POST['submit'])){
$obj=new DbFunction();
$obj->updateDueOfAllUser();
$rs10 = $obj->getTotalPackageAmount();
$res10 = $rs10->fetch_object();
}
function getDue($id){
$obj1=new DbFunction();
$rs1=$obj1->getDue($id);
$res1=$rs1->fetch_object();
return $res1;
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
        <title>View Due</title>
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
                            <h4 class="page-header"> <?php echo strtoupper("welcome"." ".htmlentities($_SESSION['login']));?>
                            <form method="post" >
                                <div class="form-group" align="right">
                                    <input type="submit" class="btn btn-primary" name="submit1" align="right" value="Send Mail" >
                                </div>
                            </form>
                            <form method="post" >
                                <div class="form-group" align="right">
                                    <input type="submit" class="btn btn-primary" name="submit" align="right" value="Get Due Till Today" >
                                </div>
                            </form>
                            </h4>
                            
                        </div>
                        <div> 
                            <div class="col-lg-7">
                            <label class="text-uppercase" style='font-size:16px'>Total Package Amount : <?php echo htmlentities($res10->Package);?></label>
                            </div>
                            <div class="col-lg-5">
                            <label class="text-uppercase" style='font-size:16px;  text-align:left;'>Total Paid Amount : <?php echo htmlentities($res10->Paid);?></label><br>
                            </div>
                            <div class="col-lg-7">
                            <label class="text-uppercase" style='font-size:16px'>Total Pending Amount :  <?php echo htmlentities($res10->totalDue);?></label>
                            </div>
                            <div class="col-lg-5">
                            <label class="text-uppercase" style='font-size:16px; text-align:left;'>Due Amount Till Today :  <?php echo htmlentities($res10->dueTillToday);?></label><br>
                            </div>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    <!-- /.row -->
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    View Due
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    
                                    <div class="dataTable_wrapper">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>SNo</th>
                                                    <th>Name</th>
                                                    <th>Flat / Shop No.</th>
                                                    <th>Package</th>
                                                    <th>Paid</th>
                                                    <th>Total Due</th>
                                                    <th>Due</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $sn=1;
                                                while($res=$rs->fetch_object()){
                                                $res2 = getDue($res->B_id);
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td><?php echo $sn?></td>
                                                    <td width="20%"><a href="payment.php?id=<?php echo htmlentities($res->B_id); ?>"><?php echo htmlentities(strtoupper($res->fname1." ".$res->mname1." ".$res->lname1));?></a></td>
                                                    <td width="10%"><?php echo htmlentities(strtoupper($res->configNo));?></td>
                                                    <td><?php echo htmlentities($res2->Package);?></td>
                                                    <td><?php echo htmlentities(strtoupper($res2->Paid));?></td>
                                                    <td><?php echo htmlentities(strtoupper($res2->totalDue));?></td>
                                                    <td><?php echo htmlentities(strtoupper($res2->dueTillToday));?></td>
                                                    
                                                    
                                                    <!-- <td> -->
                                                    <!-- &nbsp;&nbsp;
                                                    <a href="viewBooking1.php?id=<?php echo htmlentities($res->B_id); ?>">
                                                        <p class="fa fa-eye"></p> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                        <a href="edit-booking.php?id=<?php echo htmlentities($res->B_id); ?>">
                                                            <p class="fa fa-edit"></p></a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            <a href="viewBooking.php?del=<?php echo htmlentities($res->B_id); ?>">
                                                                <p class="fa fa-times-circle"></p></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                <a href="payment.php?id=<?php echo htmlentities($res->B_id); ?>" data-toggle="tooltip" title="payment">
                                                                    <p class="fa fa-cc-visa"></p></a>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                                    <a href="viewBooking.php?del=<?php echo htmlentities($res->B_id); ?>">
                                                                        <p class="fa fa-times-circle"></p></a> -->
                                                                        <!-- </td> -->
                                                                        
                                                                    </tr>
                                                                    
                                                                    <?php $sn++;}?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- /.table-responsive -->
                                                        
                                                    </div>
                                                    <!-- /.panel-body -->
                                                </div>
                                                <!-- /.panel -->
                                            </div>
                                            <!-- /.col-lg-12 -->
                                        </div>
                                        <!-- /.row -->
                                        
                                        
                                        
                                    </div>
                                    <!-- /#page-wrapper -->
                                </div>
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