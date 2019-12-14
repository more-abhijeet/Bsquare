<?php
session_start ();
if (! (isset ( $_SESSION ['login'] ))) {

header ( 'location:../index.php' );
}
include('../config/DbFunction.php');
$obj=new DbFunction();
$rs=$obj->getPaymentSchedule();
//$res=$obj->sendMail();
if(isset($_POST['submit']))
{
$date=$_POST['date'];
$Schedule = $_POST['schedule'];
$obj->savePaymentSchedule($date,$Schedule);
sleep(1);
$rs=$obj->getPaymentSchedule();
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
        <form method="POST">
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
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        View Due
                                    </div>
                                    <!-- /.panel-heading -->
                                    
                                    <div class="panel-body">
                                        <div class="dataTable_wrapper">
                                            <table class="table table-striped table-bordered table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th>SNo</th>
                                                        <th>Date</th>
                                                        <th>Payment Schedule</th>
                                                        <th>Percentage</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $sn=1;
                                                    while($res=$rs->fetch_object()){
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td width="5%"><?php echo $sn?></td>
                                                        <td width="10%"><input type="Date" name="date[]" value="<?php echo htmlentities(strtoupper($res->paymentDate));?>"></td>
                                                        <td><textarea cols="80" name="schedule[]" value="<?php echo htmlentities(strtoupper($res->payment_schedule));?>"><?php echo htmlentities(strtoupper($res->payment_schedule));?></textarea></td>
                                                        <td width="10%"><input  name="Percentage" value="<?php echo htmlentities(strtoupper($res->payment_percentage));?>" disabled></td>
                                                        
                                                        
                                                    </tr>
                                                    
                                                    <?php $sn++;}?>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                        <div class="col-lg-6"><br><br>
                                            <input type="submit" style="margin-left: 400px" class="btn btn-primary" name="submit" value="Save"></button>
                                        </div>
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
            </form>
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