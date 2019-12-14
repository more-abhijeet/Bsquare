<?php
session_start ();
if (! (isset ( $_SESSION ['login'] ))) {

	header ( 'location:../index.php' );
}
include('../config/DbFunction.php');
	$obj=new DbFunction();
	$rs1=$obj->showCountry();
	if(isset($_POST['submit'])){


$obj->register($_POST['fname'],$_POST['mname'],$_POST['lname'],$_POST['ocp'],$_POST['gender'],$_POST['company'],$_POST['designation'],$_POST['mobno'],$_POST['email'],$_POST['country'],$_POST['state'],$_POST['city'],$_POST['padd'],$_POST['cadd'],$_POST['interestedIn'],$_POST['budget'],$_POST['loanSanctioned'],$_POST['loanAmount'],$_POST['bank'],$_POST['reference']);
                                       // action="<?php echo htmlspecialchars($_SERVER["payment.php?id=".]);"
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
		<title>register</title>
		<link href="../bower_components/bootstrap/dist/css/bootstrap.min.css"
			rel="stylesheet">
			<link href="../bower_components/metisMenu/dist/metisMenu.min.css"
				rel="stylesheet">
				<link href="../dist/css/sb-admin-2.css" rel="stylesheet">
				<link href="../bower_components/font-awesome/css/font-awesome.min.css"
					rel="stylesheet" type="text/css">
				</head>
				<body>
					<form method="post">
						<div id="wrapper">
							<?php include('leftbar.php');?>
							<div id="page-wrapper">
								<div class="row">
									<div class="col-lg-12">
										<h4 class="page-header"> <?php echo strtoupper("welcome"." ".htmlentities($_SESSION['login']));?></h4>
									</div>
								</div>

								<div class="row">
									<div class="col-lg-12">
										<div class="panel panel-default">
											<div class="panel-heading">Personal Informations</div>
											<div class="panel-body">
												<div class="row">
													<div class="col-lg-12">
														<div class="form-group">
															<div class="col-lg-2">
																<label>First Name<span id="" style="font-size:11px;color:red">*</span>	</label>
																
															</div>
															<div class="col-lg-4">
																<input class="form-control" name="fname" required="required" pattern="[A-Za-z]+$">
															</div>
															<div class="col-lg-2">
																<label>Middle Name</label>
																
															</div>
															<div class="col-lg-4">
																<input class="form-control" name="mname">
															</div>
														</div>
														<br><br>
														
														<div class="form-group">
															<div class="col-lg-2">
																<label>Last Name</label>
															</div>
															<div class="col-lg-4">
																<input class="form-control" name="lname" pattern="[A-Za-z]+$">
															</div>
															<div class="col-lg-2">
																<label>Gender</label>
																
															</div>
															<div class="col-lg-4">
																<input type="radio" name="gender" id="male" value="Male"> &nbsp; Male &nbsp;
																<input type="radio" name="gender" id="female" value="feale"> &nbsp; Female &nbsp;
																<input type="radio" name="gender" id="other" value="other"> &nbsp; Other &nbsp;
															</div>
														</div>
														<br><br>
														
														<div class="form-group">
															<div class="col-lg-2">
																<label>Occupation<span id="" style="font-size:11px;color:red">*</span></label>
																
															</div>
															<div class="col-lg-4">
																<select class="form-control" name="ocp"  id="ocp"required="required" >
																	<option VALUE="">SELECT</option>
																	<option VALUE="Service">Service</option>
																	<option value="Business">Business</option>
																	<option value="Professional">Professional</option>
																	<option value="Others">Others</option>
																	
																</select>
															</div>
															<div class="col-lg-2">
																<label>Company<span id="" style="font-size:11px;color:red">*</span>	</label>
																
															</div>
															<div class="col-lg-4">
																<input class="form-control" name="company" required="required" >
															</div>
														</div>
														<br><br>
														<div class="form-group">
															<div class="col-lg-2">
																<label>Designation<span id="" style="font-size:11px;color:red">*</span>	</label>
																
															</div>
															<div class="col-lg-4">
																<input class="form-control" name="designation" required="required" >
															</div>
														</div>
													</div>
													<br><br>
												</div>
											</div>
										</div>
										
										<div class="row">
											<div class="col-lg-12">
												<div class="panel panel-default">
													<div class="panel-heading">Contact Informations</div>
													<div class="panel-body">
														<div class="row">
															<div class="col-lg-12">
																<div class="form-group">
																	<div class="col-lg-2">
																		<label>Mobile Number<span id="" style="font-size:11px;color:red">*</span>	</label>
																		
																	</div>
																	<div class="col-lg-4">
																		<input class="form-control" type="number" name="mobno" required="required" maxlength="10">
																	</div>
																	<div class="col-lg-2">
																		<label>Email Id</label>
																		
																	</div>
																	<div class="col-lg-4">
																		<input class="form-control"  type="email" name="email">
																	</div>
																</div>
																<br><br>
																
																<div class="form-group">
																	<div class="col-lg-2">
																		<label>Country</label>
																	</div>
																	<div class="col-lg-4">
																		<select class="form-control" name="country" id="country" onchange="showState(this.value)"  >	<option VALUE="">Select Country</option>
																		<?php while($res=$rs1->fetch_object()){?>
																		<option VALUE="<?php echo htmlentities($res->id);?>"><?php echo htmlentities($res->name)?></option>
																		<?php }?>
																	</select>
																</div>
																<div class="col-lg-2">
																	<label>State</label>
																</div>
																<div class="col-lg-4">
																	<select name="state" id="state"  class="form-control" onchange="showDist(this.value)" >
																		<option value="">Select State</option>
																	</select>
																</div>
																
															</div>
															
															<br><br><br><br>
															<div class="form-group">
																<div class="col-lg-2">
																	<label>City<span id="" style="font-size:11px;color:red">*</span>	</label>
																	
																</div>
																<div class="col-lg-4">
																	<select name="city" id="dist"  class="form-control" onchange="" >
																		<option value="">Select City</option>
																	</select>
																</div>
																<div class="col-lg-2">
																	<label>Permanent Address<span id="" style="font-size:11px;color:red">*</span></label>
																	
																</div>
																<div class="col-lg-4">
																	<textarea class="form-control" rows="3" name="padd" id="padd"></textarea>
																</div>
															</div>
															<br><br><br><br>
															
															
															<br><br>
															
															
															
															<div class="form-group">
																<div class="col-lg-2">
																	<label>Correspondence Address<span id="" style="font-size:11px;color:red">*</span>
																	
																</div>
																<div class="col-lg-4">
																	<textarea class="form-control" rows="3" name="cadd"  id="cadd"></textarea>
																</div>
																<div class="col-lg-2">
																	
																	
																	
																</div>
																<div class="col-lg-4">
																	
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
														<div class="panel-heading">Choice Related</div>
														<div class="panel-body">
															<div class="row">
																
																<div class="col-lg-12">
																	<div class="form-group">
																		<div class="col-lg-2">
																			<label>Interested In</label>
																		</div>
																		<div class="col-lg-4">
																			<input type="checkbox" name="interestedIn" id="1BHK" value="1BHK"> &nbsp; 1BHK &nbsp;
																			<input type="checkbox" name="interestedIn" id="2BHK" value="2BHK"> &nbsp; 2BHK &nbsp;
																			<input type="checkbox" name="interestedIn" id="Shop" value="Shop"> &nbsp; Shop &nbsp;
																		</div>
																		<div class="col-lg-2">
																			<label>Budget<span id="" style="font-size:11px;color:red">*</span>	</label>
																			
																		</div>
																		<div class="col-lg-4">
																			<input class="form-control" name="budget" required="required" >
																		</div>
																	</div>
																	<br><br>
																	<div class="form-group">
																		<div class="col-lg-2">
																			<label>Is loan sanctioned</label>
																		</div>
																		<div class="col-lg-4">
																			<input type="radio" name="loanSanctioned" id="Yes" value="Yes"> &nbsp; Yes &nbsp;
																			<input type="radio" name="loanSanctioned" id="No" value="No"> &nbsp; No &nbsp;
																		</div>
																		<div class="col-lg-2">
																			<label>Loan amount sanctioned<span id="" style="font-size:11px;color:red">*</span>	</label>
																			
																		</div>
																		<div class="col-lg-4">
																			<input class="form-control" name="loanAmount">
																		</div>
																	</div>
																	<br><br>
																	<div class="form-group">
																		<div class="col-lg-2">
																			<label>Bank</label>
																		</div>
																		<div class="col-lg-4">
																			<input class="form-control" name="bank">
																		</div>
																		<div class="col-lg-6">
																		</div>
																	</div>
																	<br><br>
																	<div class="form-group">
																		<div class="col-lg-2">
																			<label>Reference</label>
																		</div>
																		<div class="col-lg-10">
																			<input type="checkbox" name="reference" id="Newspaper" value="Newspaper"> &nbsp; Newspaper &nbsp;
																			<input type="checkbox" name="reference" id="Internet" value="Internet"> &nbsp; Internet &nbsp;
																			<input type="checkbox" name="reference" id="Cable T.V" value="Cable T.V"> &nbsp; Cable T.V &nbsp;
																			<input type="checkbox" name="reference" id="Walking" value="Walking"> &nbsp; Walking &nbsp;
																			<input type="checkbox" name="reference" id="Hoarding" value="Hoarding"> &nbsp; Hoarding &nbsp;
																			<input type="checkbox" name="reference" id="Radio" value="Radio"> &nbsp; Radio &nbsp;
																			<input type="checkbox" name="reference" id="Exhibition" value="Exhibition"> &nbsp; Exhibition &nbsp;
																			<input type="checkbox" name="reference" id="Other" value="Other"> &nbsp; Other &nbsp;
																		</div>
																	</div>
																</div>
															</div>
															<br>
															
															<div class="form-group">
																<div class="col-lg-4">
																</div>
																<div class="col-lg-6"><br><br>
																	<input type="submit" class="btn btn-primary" name="submit" value="Register"></button>
																</div>
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
								</body>
							</html>