<?php
session_start ();
if (! (isset ( $_SESSION ['login'] ))) {
	
	header ( 'location:../index.php' );
}
include('../config/DbFunction.php');
	$obj=new DbFunction();
	$id=$_GET['id'];
$rs=$obj->showBooking1($id);
	$res=$rs->fetch_object();

?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>view booking</title>
		<link href="../bower_components/bootstrap/dist/css/bootstrap.min.css"
			rel="stylesheet">
			<link href="../bower_components/metisMenu/dist/metisMenu.min.css"
				rel="stylesheet">
				<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
				<link href="../bower_components/font-awesome/css/font-awesome.min.css"
					rel="stylesheet" type="text/css">
				</head>
				<body>
					<form method="post" >
						<div id="wrapper">
							<!--left !-->
							<?php include('leftbar.php')?>;
							
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
											<div class="panel-heading">Allottee(s) Details</div>
											<div class="panel-body">
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<div class="col-lg-2">
																<label>First Name<span id="" style="font-size:11px;color:red">*</span>	</label>
																
															</div>
															<div class="col-lg-4">
																<input class="form-control" name="fname1" value="<?php echo htmlentities($res->fname1);?>" required="required" pattern="[A-Za-z]+$" readonly>
															</div>
															<div class="col-lg-2">
																<label>Middle Name</label>
																
															</div>
															<div class="col-lg-4">
																<input class="form-control" value="<?php echo htmlentities($res->mname1);?>" name="mname1" readonly>
															</div>
														</div>
														<br><br>
														
														<div class="form-group">
															<div class="col-lg-2">
																<label>Last Name</label>
															</div>
															<div class="col-lg-4">
																<input class="form-control" value="<?php echo htmlentities($res->lname1);?>" name="lname1" pattern="[A-Za-z]+$" readonly>
															</div>
															<div class="col-lg-2">
																<label>Age</label>
															</div>
															<div class="col-lg-4">
																<input type="number" value="<?php echo htmlentities($res->age1);?>" class="form-control" name="age1"  readonly>
															</div>
														</div>
														<br><br>
														<div class="form-group">
															<div class="col-lg-2">
																<label>Occupation</label>
															</div>
															<div class="col-lg-4">
																<input class="form-control" value="<?php echo htmlentities($res->ocp1);?>" name="ocp1" pattern="[A-Za-z]+$" readonly>
															</div>
															<div class="col-lg-2">
																<label>PAN</label>
															</div>
															<div class="col-lg-4">
																<input class="form-control" value="<?php echo htmlentities($res->pan1);?>" name="pan1" readonly >
															</div>
														</div>
														<br><br>
														<div class="form-group">
															<div class="col-lg-2">
																<label>Adhaar No.</label>
															</div>
															<div class="col-lg-4">
																<input class="form-control" value="<?php echo htmlentities($res->adhaar1);?>" name="adhaar1" readonly >
															</div>
															<div class="col-lg-2">
																<label>Mobile Number</label>
															</div>
															<div class="col-lg-4">
																<input class="form-control" type="number" value="<?php echo htmlentities($res->mobno1);?>" name="mobno1"  readonly>
															</div>
														</div>
														<br><br>
														<div class="form-group">
															<div class="col-lg-2">
																<label>Alternative Mobile Number<span id="" style="font-size:11px;color:red">*</span>	</label>
																
															</div>
															<div class="col-lg-4">
																<input class="form-control" type="number" value="<?php echo htmlentities($res->amobno1);?>" name="amobno1" required="required" maxlength="10" readonly>
															</div>
															<div class="col-lg-2">
																<label>Email Id</label>
																
															</div>
															<div class="col-lg-4">
																<input class="form-control"  type="email" value="<?php echo htmlentities($res->email1);?>" name="email1" readonly>
															</div>
														</div>
														<br><br>
														
														<div class="form-group">
															<div class="col-lg-2">
																<label>Permanent Address<span id="" style="font-size:11px;color:red">*</span></label>
																
															</div>
															<div class="col-lg-4">
																<textarea class="form-control" rows="3" value="<?php echo htmlentities($res->padd1);?>" name="padd1" id="padd1"  readonly><?php echo htmlentities($res->padd1);?></textarea>
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
																<input class="form-control" name="fname2"  value="<?php echo htmlentities($res->fname2);?>" pattern="[A-Za-z]+$" readonly>
															</div>
															<div class="col-lg-2">
																<label>Middle Name</label>
																
															</div>
															<div class="col-lg-4">
																<input class="form-control" value="<?php echo htmlentities($res->mname2);?>" name="mname2" readonly>
															</div>
														</div>
														<br><br>
														
														<div class="form-group">
															<div class="col-lg-2">
																<label>Last Name</label>
															</div>
															<div class="col-lg-4">
																<input class="form-control" value="<?php echo htmlentities($res->lname2);?>" name="lname2" pattern="[A-Za-z]+$" readonly>
															</div>
															<div class="col-lg-2">
																<label>Age</label>
															</div>
															<div class="col-lg-4">
																<input type="number" class="form-control" value="<?php echo htmlentities($res->age2);?>" name="age2"  readonly>
															</div>
														</div>
														<br><br>
														<div class="form-group">
															<div class="col-lg-2">
																<label>Occupation</label>
															</div>
															<div class="col-lg-4">
																<input class="form-control" value="<?php echo htmlentities($res->ocp2);?>" name="ocp2" pattern="[A-Za-z]+$" readonly>
															</div>
															<div class="col-lg-2">
																<label>PAN</label>
															</div>
															<div class="col-lg-4">
																<input class="form-control" value="<?php echo htmlentities($res->pan2);?>" name="pan2"  readonly>
															</div>
														</div>
														<br><br>
														<div class="form-group">
															<div class="col-lg-2">
																<label>Adhaar No.</label>
															</div>
															<div class="col-lg-4">
																<input class="form-control" value="<?php echo htmlentities($res->adhaar2);?>" name="adhaar2" readonly >
															</div>
															<div class="col-lg-2">
																<label>Mobile Number</label>
															</div>
															<div class="col-lg-4">
																<input class="form-control" type="number" value="<?php echo htmlentities($res->mobno2);?>" name="mobno2" readonly >
															</div>
														</div>
														<br><br>
														<div class="form-group">
															<div class="col-lg-2">
																<label>Alternative Mobile Number</label>
																
															</div>
															<div class="col-lg-4">
																<input class="form-control" type="number" value="<?php echo htmlentities($res->amobno2);?>" name="amobno2" maxlength="10" readonly>
															</div>
															<div class="col-lg-2">
																<label>Email Id</label>
																
															</div>
															<div class="col-lg-4">
																<input class="form-control"  type="email" name="email2" readonly>
															</div>
														</div>
														<br><br>
														
														
														<div class="form-group">
															<div class="col-lg-2">
																<label>Permanent Address</label>
																
															</div>
															<div class="col-lg-4">
																<textarea class="form-control" rows="3" vvalue="<?php echo htmlentities($res->padd2);?>" name="padd2" id="padd2" readonly><?php echo htmlentities($res->padd2);?></textarea>
															</div>
														</div>
														<br><br>
														<!-- <div class="form-group">
																<div class="col-lg-2">
																		<label>Guardian Name<span id="" style="font-size:11px;color:red">*</span>	</label>
																	
																</div>
																<div class="col-lg-4">
																	<input class="form-control" name="gname" required="required" pattern="[A-Za-z]+$">
															</div> -->
															<!-- <div class="col-lg-2">
																<label>Occupation</label>
																
															</div>
															<div class="col-lg-4">
																<input class="form-control" name="ocp" id="ocp">
															</div>
															</div>
														<br><br> -->
														
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
																		<input class="form-control"  value="<?php echo htmlentities($res->project);?>" name="project" readonly>
																	</div>
																	<div class="col-lg-2">
																		<label>Wing/Building<span id="" style="font-size:11px;color:red">*</span>	</label>
																	</div>
																	<div class="col-lg-4">
																		<input class="form-control" name="wing" value="<?php echo htmlentities($res->wing);?>" required="required" readonly>
																	</div>
																</div>
																<br><br>
																
																<div class="form-group">
																	<div class="col-lg-2">
																		<label>Configuration<span id="" style="font-size:11px;color:red">*</span></label>
																	</div>
																	<div class="col-lg-4">
																		<select class="form-control" name="config"  id="config" required="required"  readonly >
																			<option VALUE="<?php echo htmlentities($res->config);?>"><?php echo htmlentities($res->config);?></option>
																			<option VALUE="Flat">Flat</option>
																			<option value="Shop">Shop</option>
																		</select>
																	</div>
																	<div class="col-lg-2">
																		<label>Number<span id="" style="font-size:11px;color:red">*</span></label>
																	</div>
																	<div class="col-lg-4">
																		<input class="form-control" name="configNo" value="<?php echo htmlentities($res->configNo);?>" required="required"  readonly>
																	</div>
																</div>
																<br><br>
																<div class="form-group">
																	<div class="col-lg-2">
																		<label>Floor<span id="" style="font-size:11px;color:red">*</span>
																	</div>
																	<div class="col-lg-4">
																		<input class="form-control" name="floor" value="<?php echo htmlentities($res->floor);?>" required="required" readonly >
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
																		<input class="form-control" value="<?php echo htmlentities($res->area);?>" name="area" required="required" readonly >
																	</div>
																	<div class="col-lg-2">
																		<label>Carpet Area (Sq. Mtr)<span id="" style="font-size:11px;color:red">*</span>
																	</div>
																	<div class="col-lg-4">
																		<input class="form-control" value="<?php echo htmlentities($res->carpetArea);?>" name="carpetArea" required="required" readonly >
																	</div>
																</div>
																<br><br>
																<div class="form-group">
																	<div class="col-lg-2">
																		<label>Enclosed Balcony Area (Sq. Mtr)<span id="" style="font-size:11px;color:red">*</span>
																	</div>
																	<div class="col-lg-4">
																		<input class="form-control" value="<?php echo htmlentities($res->balconyArea);?>" name="balconyArea" required="required" readonly >
																	</div>
																	<div class="col-lg-2">
																		<label>Terrace Carpet Area (Sq. Mtr)<span id="" style="font-size:11px;color:red">*</span>
																	</div>
																	<div class="col-lg-4">
																		<input class="form-control" value="<?php echo htmlentities($res->terraceArea);?>" name="terraceArea" required="required" readonly >
																	</div>
																</div>
																<br><br>
																<div class="form-group">
																	<div class="col-lg-2">
																		<label>Parking</label>
																	</div>
																	<div class="col-lg-4">
																		<?php
																		if (strcasecmp($res->parking,"Yes")==0){?>
																		<input type="radio" name="parking" id="Yes" value="Yes" required="required" checked > &nbsp; Yes &nbsp;
																		<?php }else{ ?>
																		<input type="radio" name="parking" id="Yes" value="Yes" disabled> &nbsp; Yes &nbsp;
																		<?php } ?>
																		<?php
																		if (strcasecmp($res->parking,"No")==0){?>
																		<input type="radio" name="parking" id="No" value="No" required="required" checked > &nbsp; No &nbsp;
																		<?php }else{ ?>
																		<input type="radio" name="parking" id="No" value="No"  disabled> &nbsp; No &nbsp;
																		<?php } ?>
																	</div>
																	<div class="col-lg-2">
																		<label>Type</label>
																	</div>
																	<div class="col-lg-4">
																		<?php
																		if (strcasecmp($res->parkingType,"covered")==0){?>
																		<input type="radio" name="parkingType" id="covered" value="covered" required="required" checked  readonly> &nbsp; Covered &nbsp;
																		<?php }else{ ?>
																		<input type="radio" name="parkingType" id="covered" value="covered" disabled> &nbsp; Covered &nbsp;
																		<?php } ?>
																		<?php
																		if (strcasecmp($res->parkingType,"openReserve")==0){?>
																		<input type="radio" name="parkingType" id="openReserve" value="openReserve" required="required" checked  readonly> &nbsp; Open Reserve &nbsp;
																		<?php }else{ ?>
																		<input type="radio" name="parkingType" id="openReserve" value="openReserve" disabled> &nbsp; Open Reserve &nbsp;
																		<?php } ?>
																		<?php
																		if (strcasecmp($res->parkingType,"No")==0){?>
																		<input type="radio" name="parkingType" id="No" value="No" required="required" checked> &nbsp; No &nbsp;
																		<?php }else{ ?>
																		<input type="radio" name="parkingType" id="No" value="No" disabled> &nbsp; No &nbsp;
																		<?php } ?>
																	</div>
																</div>
																<br><br>
																
																<div class="form-group">
																	<div class="col-lg-4">
																	</div>
																	<div class="col-lg-6"><br><br>
																		<input type="button" class="btn btn-primary" value="Edit" onclick="location.href='edit-booking.php?id=<?php echo htmlentities($res->B_id); ?>';">
																	</div>
																</div>
															</div>
															</div><!--row!-->
															
														</div>
														
													</div>
													
												</div>
												
											</div>
											
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
											
											<script>
											function showState(val) {
											
											$.ajax({
											type: "POST",
											url: "subject.php",
											data:'id='+val,
											success: function(data){
											// alert(data);
												$("#state").html(data);
											}
											});
											}
											function showDist(val) {
											
											$.ajax({
											type: "POST",
											url: "subject.php",
											data:'did='+val,
											success: function(data){
											// alert(data);
												$("#dist").html(data);
											}
											});
											
											}
											function showSub(val) {
											
											//alert(val);
											$.ajax({
											type: "POST",
											url: "subject.php",
											data:'cid='+val,
											success: function(data){
											// alert(data);
												$("#c-full").val(data);
											}
											});
											
											}
											</script>
										</form>
									</body>
								</html>