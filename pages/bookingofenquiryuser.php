<?php
session_start ();

if (! (isset ( $_SESSION ['login'] ))) {

    header ( 'location:../index.php' );
}
include('../config/DbFunction.php');
    $obj=new DbFunction();
    $id=$_GET['id'];
    $rs=$obj->showStudents1($id);
    $res=$rs->fetch_object();

    if(isset($_POST['submit'])){
     $obj->booking($_POST['fname1'],$_POST['mname1'],$_POST['lname1'],$_POST['age1'],$_POST['ocp1'],$_POST['pan1'],$_POST['adhaar1'],$_POST['mobno1'],$_POST['amobno1'], $_POST['email1'], $_POST['padd1'],$_POST['fname2'],$_POST['mname2'],$_POST['lname2'],$_POST['age2'],$_POST['ocp2'],$_POST['pan2'],$_POST['adhaar2'],$_POST['mobno2'], $_POST['amobno2'],$_POST['email2'],$_POST['padd2'],$_POST['project'],$_POST['wing'],$_POST['config'],$_POST['configNo'],$_POST['floor'],$_POST['area'],$_POST['carpetArea'],$_POST['balconyArea'],$_POST['terraceArea'],$_POST['parking'],$_POST['parkingType']);
    // require_once("payment.php");

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
        <title>booking</title>
        <link href="../bower_components/bootstrap/dist/css/bootstrap.min.css"
            rel="stylesheet">
            <link href="../bower_components/metisMenu/dist/metisMenu.min.css"
                rel="stylesheet">
                <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
                <link href="../bower_components/font-awesome/css/font-awesome.min.css"
                    rel="stylesheet" type="text/css">
                </head>
                <body>

                        <div id="wrapper">
                            <?php include('leftbar.php');?>
                            <div id="page-wrapper">
                                <div class="row page-header">
                                    <div class="col-lg-6">
                                        <h4 > <?php echo strtoupper("welcome to booking process");?></h4>

                                    </div>
                                 <form method="post">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Allottee(s) Details</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <div class="col-lg-2">
                                                                <label>First Name<span id="" style="font-size:11px;color:red">*</span>	</label>

                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input class="form-control" name="fname1" required="required" pattern="[A-Za-z]+$" value="<?php echo htmlentities($res->fname);?>">
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <label>Middle Name</label>

                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input class="form-control" name="mname1" value="<?php echo htmlentities($res->mname);?>">
                                                            </div>
                                                        </div>
                                                        <br><br>

                                                        <div class="form-group">
                                                            <div class="col-lg-2">
                                                                <label>Last Name</label>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input class="form-control" name="lname1" pattern="[A-Za-z]+$" value="<?php echo htmlentities($res->lname);?>">
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <label>Age</label>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input type="number" class="form-control" name="age1" >
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                        <div class="form-group">
                                                            <div class="col-lg-2">
                                                                <label>Occupation</label>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input class="form-control" name="ocp1" pattern="[A-Za-z]+$" value="<?php echo htmlentities($res->ocp);?>">
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <label>PAN</label>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input class="form-control" name="pan1" >
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                        <div class="form-group">
                                                            <div class="col-lg-2">
                                                                <label>Adhaar No.</label>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input class="form-control" name="adhaar1" >
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <label>Mobile Number</label>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input class="form-control" type="number" name="mobno1" value="<?php echo htmlentities($res->mobno);?>">
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                        <div class="form-group">
                                                            <div class="col-lg-2">
                                                                <label>Alternative Mobile Number<span id="" style="font-size:11px;color:red">*</span>	</label>

                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input class="form-control" type="number" name="amobno1" required="required" maxlength="10">
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <label>Email Id</label>

                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input class="form-control"  type="email" name="email1" value="<?php echo htmlentities($res->emailid);?>">
                                                            </div>
                                                        </div>
                                                        <br><br>

                                                        <div class="form-group">
                                                            <div class="col-lg-2">
                                                                <label>Permanent Address<span id="" style="font-size:11px;color:red">*</span></label>

                                                            </div>
                                                            <div class="col-lg-4">
                                                                <textarea class="form-control" rows="3" name="padd1" id="padd1" ><?php echo htmlentities($res->padd);?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel panel-default">
                                            <div class="panel-heading">Allottee(s) Details</div>
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="form-group">
                                                            <div class="col-lg-2">
                                                                <label>First Name</label>

                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input class="form-control" name="fname2"  pattern="[A-Za-z]+$">
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <label>Middle Name</label>

                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input class="form-control" name="mname2">
                                                            </div>
                                                        </div>
                                                        <br><br>

                                                        <div class="form-group">
                                                            <div class="col-lg-2">
                                                                <label>Last Name</label>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input class="form-control" name="lname2" pattern="[A-Za-z]+$">
                                                            </div>
                                                            <div class="col-lg-2">
                                                                <label>Age</label>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <input type="number" class="form-control" name="age2" >
                                                            </div>
                                                        </div>
                                                        <br><br>
                                                        <div class="form-group">		    <div class="col-lg-2">
                                                            <label>Occupation</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input class="form-control" name="ocp2" pattern="[A-Za-z]+$">
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label>PAN</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input class="form-control" name="pan2" >
                                                        </div>
                                                    </div>
                                                    <br><br>
                                                    <div class="form-group">
                                                        <div class="col-lg-2">
                                                            <label>Adhaar No.</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input class="form-control" name="adhaar2" >
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label>Mobile Number</label>
                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input class="form-control" type="number" name="mobno2" >
                                                        </div>
                                                    </div>
                                                    <br><br>
                                                    <div class="form-group">
                                                        <div class="col-lg-2">
                                                            <label>Alternative Mobile Number</label>

                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input class="form-control" type="number" name="amobno2" maxlength="10">
                                                        </div>
                                                        <div class="col-lg-2">
                                                            <label>Email Id</label>

                                                        </div>
                                                        <div class="col-lg-4">
                                                            <input class="form-control"  type="email" name="email2">
                                                        </div>
                                                    </div>
                                                    <br><br>


                                                    <div class="form-group">
                                                        <div class="col-lg-2">
                                                            <label>Permanent Address</label>

                                                        </div>
                                                        <div class="col-lg-4">
                                                            <textarea class="form-control" rows="3" name="padd2" id="padd2"></textarea>
                                                        </div>
                                                    </div>
                                                    <br><br>

                                                </div>
                                                <br><br>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="panel panel-default">
                                                <div class="panel-heading">Flat/Shop Details</div>
                                                <div class="panel-body">
                                                    <div class="row">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <div class="col-lg-2">
                                                                    <label>Name of Project</label>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <input class="form-control"  name="project" value="B-Square" readonly>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <label>Wing/Building<span id="" style="font-size:11px;color:red">*</span>	</label>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <input class="form-control" name="wing" required="required" >
                                                                </div>
                                                            </div>
                                                            <br><br>

                                                            <div class="form-group">
                                                                <div class="col-lg-2">
                                                                    <label>Configuration<span id="" style="font-size:11px;color:red">*</span></label>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <select class="form-control" name="config"  id="config" required="required" >
                                                                        <option VALUE="">SELECT</option>
                                                                        <option VALUE="Flat">Flat</option>
                                                                        <option value="Shop">Shop</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <label>Number<span id="" style="font-size:11px;color:red">*</span></label>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <input class="form-control" name="configNo" required="required" >
                                                                </div>
                                                            </div>
                                                            <br><br>
                                                            <div class="form-group">
                                                                <div class="col-lg-2">
                                                                    <label>Floor<span id="" style="font-size:11px;color:red">*</span>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <input class="form-control" name="floor" required="required" >
                                                                </div>
                                                                <div class="col-lg-2">

                                                                </div>
                                                                <div class="col-lg-4">

                                                                </div>
                                                            </div>
                                                            <br><br>
                                                            <div class="form-group">
                                                                <div class="col-lg-2">
                                                                    <label>Area (Sq. Mtr)<span id="" style="font-size:11px;color:red">*</span>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <input class="form-control" name="area" required="required" >
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <label>Carpet Area (Sq. Mtr)<span id="" style="font-size:11px;color:red">*</span>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <input class="form-control" name="carpetArea" required="required" >
                                                                </div>
                                                            </div>
                                                            <br><br>
                                                            <div class="form-group">
                                                                <div class="col-lg-2">
                                                                    <label>Enclosed Balcony Area (Sq. Mtr)<span id="" style="font-size:11px;color:red">*</span>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <input class="form-control" name="balconyArea" required="required" >
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <label>Terrace Carpet Area (Sq. Mtr)<span id="" style="font-size:11px;color:red">*</span>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <input class="form-control" name="terraceArea" required="required" >
                                                                </div>
                                                            </div>
                                                            <br><br>
                                                            <div class="form-group">
                                                                <div class="col-lg-2">
                                                                    <label>Parking</label>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <input type="radio" name="parking" id="Yes" value="Yes"> &nbsp; Yes &nbsp;
                                                                    <input type="radio" name="parking" id="No" value="No"> &nbsp; No &nbsp;
                                                                </div>
                                                                <div class="col-lg-2">
                                                                    <label>Type</label>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <input type="radio" name="parkingType" id="covered" value="covered"> &nbsp; Covered &nbsp;
                                                                    <input type="radio" name="parkingType" id="openReserve" value="openReserve"> &nbsp; Open Reserve &nbsp;
                                                                    <input type="radio" name="parkingType" id="No" value="No"> &nbsp; No &nbsp;
                                                                </div>
                                                            </div>
                                                            <br><br>


                                                            <br><br>
                                                            <div class="col-lg-4">
                                                            </div>
                                                            <div class="col-lg-6"><br><br>
                                                                <input type="submit" class="btn btn-primary" name="submit" value="Register"></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">

                                            </div>
                                        </div>
                                        </div><!--row!-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
    <!-- jQuery -->
    <script src="../bower_components/jquery/dist/jquery.min.js"
        type="text/javascript"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"
        type="text/javascript"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../bower_components/metisMenu/dist/metisMenu.min.js"
        type="text/javascript"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js" type="text/javascript"></script>

</body>

</html>
