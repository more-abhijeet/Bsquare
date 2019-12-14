

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
	$rs2=$obj->showCountry();
	if(isset($_POST['submit'])){
	
     
     $obj->edit_std($_POST['fname'],$_POST['mname'],$_POST['lname'],$_POST['ocp'],$_POST['gender'],$_POST['company'],$_POST['designation'],$_POST['mobno'],$_POST['email'],$_POST['country'],$_POST['state'],$_POST['city'],$_POST['padd'],$_POST['cadd'],$_POST['interestedIn'],$_POST['budget'],$_POST['loanSanctioned'],$_POST['loanAmount'],$_POST['bank'],$_POST['reference'],$_GET['id']);
	
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
<title>edit students</title>
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
			<div class="panel-heading">Personal Informations</div>
			<div class="panel-body">
			<div class="row">
			<div class="col-lg-12">
			<div class="form-group">
		    <div class="col-lg-2">
			<label>First Name<span id="" style="font-size:11px;color:red">*</span>	</label>
			
			</div>
			<div class="col-lg-4">
			<input class="form-control" value="<?php echo htmlentities($res->fname);?>" name="fname" required="required" pattern="[A-Za-z]+$">
			</div>
			 <div class="col-lg-2">
			<label>Middle Name</label>
			
			</div>
			<div class="col-lg-4">
			<input class="form-control" value="<?php echo htmlentities($res->mname);?>" name="mname">
			</div>
			</div>	
			<br><br>
								
		<div class="form-group">
		    <div class="col-lg-2">
			<label>Last Name</label>
			</div>
			<div class="col-lg-4">
			<input class="form-control" name="lname" value="<?php echo htmlentities($res->lname);?>" pattern="[A-Za-z]+$">
			</div>
			 <div class="col-lg-2">
			<label>Gender</label>
			
			</div>
			<div class="col-lg-4">
			<?php 
			if (strcasecmp($res->gender,"Male")==0){?>
		 <input type="radio" name="gender" id="male" value="Male" required="required" checked> &nbsp; Male &nbsp;
		 <?php }else{ ?>
		 <input type="radio" name="gender" id="male" value="Male" required="required"> &nbsp; Male &nbsp;
		 <?php }?>
		 <?php 
			if (strcasecmp($res->gender,"female")==0){?>
		 <input type="radio" name="gender" id="female" value="female" checked> &nbsp; Female &nbsp;
		 <?php } else{?>
		 <input type="radio" name="gender" id="female" value="female"> &nbsp; Female &nbsp;
		 <?php }?>
		 <?php 
			if (strcasecmp($res->gender,"other")==0){?>
		 <input type="radio" name="gender" id="other" value="other" checked> &nbsp; Other &nbsp;
		 <?php } else{?>
		 <input type="radio" name="gender" id="other" value="other"> &nbsp; Other &nbsp;
		 <?php }?>
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
					
		     <div class="form-group">
			 <div class="col-lg-2">
			<label>Occupation<span id="" style="font-size:11px;color:red">*</span></label>
			
			</div>
			<div class="col-lg-4">
			<select class="form-control" name="ocp"  id="ocp"required="required" >
        <option VALUE="<?php echo htmlentities($res->ocp);?>"><?php echo htmlentities($res->ocp);?></option>
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
			<input class="form-control" value="<?php echo htmlentities($res->company);?>" name="company" required="required" >
			</div>	
			</div> 	
			<br><br>
			 <div class="form-group">
			 	<div class="col-lg-2">
			<label>Designation<span id="" style="font-size:11px;color:red">*</span>	</label>
			
			</div>
			<div class="col-lg-4">
			<input class="form-control" value="<?php echo htmlentities($res->designation);?>" name="designation" required="required" >
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
			<input class="form-control" type="number" value="<?php echo htmlentities($res->mobno);?>" name="mobno" required="required" maxlength="10">
			</div>
			 <div class="col-lg-2">
			<label>Email Id</label>
			
			</div>
			<div class="col-lg-4">
			<input class="form-control"  value="<?php echo htmlentities($res->emailid);?>" type="email" name="email">
			</div>
			</div>	
			<br><br>
								
		<div class="form-group">
		    <div class="col-lg-2">
			<label>Country</label>
			</div>
			<div class="col-lg-4">
			<select class="form-control" name="country" id="country" onchange="showState(this.value)"
			required="required"  value="<?php echo htmlentities($res->country);?>">			
			<option VALUE="">Select Country</option>
				<?php while($res3=$rs2->fetch_object()){?>							
			
   			<option VALUE="<?php echo htmlentities($res3->id);?>"><?php echo htmlentities($res3->name)?></option>
                        
                        
                    <?php }?>   </select>
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
			<textarea class="form-control" rows="3" name="padd" id="padd"><?php echo htmlentities($res->padd);?></textarea>
			</div>
			</div>	
			<br><br><br><br>
					
		     
			<br><br>
			
			
					
		     <div class="form-group">
			 <div class="col-lg-2">
			<label>Correspondence Address<span id="" style="font-size:11px;color:red">*</span>
			
			</div>
			<div class="col-lg-4">
      <textarea class="form-control" rows="3" name="cadd"  id="cadd"><?php echo htmlentities($res->cadd);?></textarea>
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
				<?php 
				if (strcasecmp($res->interestedIn,"1BHK")==0){?>
				 <input type="checkbox" name="interestedIn" id="1BHK" value="1BHK" required="required" checked> &nbsp; 1BHK &nbsp;
				 <?php }else{ ?>	
				 <input type="checkbox" name="interestedIn" id="1BHK" value="1BHK"> &nbsp; 1BHK &nbsp;
				 <?php }?>
				 <?php 
				if (strcasecmp($res->interestedIn,"2BHK")==0){?>
				 <input type="checkbox" name="interestedIn" id="2BHK" value="2BHK" required="required" checked> &nbsp; 2BHK &nbsp;
				 <?php }else{ ?>
				 <input type="checkbox" name="interestedIn" id="2BHK" value="2BHK"> &nbsp; 2BHK &nbsp;
				 <?php }?>
				 <?php 
				 if (strcasecmp($res->interestedIn,"Shop")==0){?>
				 <input type="checkbox" name="interestedIn" id="Shop" value="Shop" required="required" checked> &nbsp; Shop &nbsp;
				 <?php }else{ ?>	
				 <input type="checkbox" name="interestedIn" id="Shop" value="Shop"> &nbsp; Shop &nbsp;
				 <?php }?>
				</div>
				<div class="col-lg-2">
				<label>Budget<span id="" style="font-size:11px;color:red">*</span>	</label>
				
				</div>
				<div class="col-lg-4">
				<input class="form-control" value="<?php echo htmlentities($res->budget);?>" name="budget" required="required" >
				</div>
			</div>
				<br><br>
			<div class="form-group">
			  	<div class="col-lg-2">
				<label>Is loan sanctioned</label>
				</div>
				<div class="col-lg-4">
				 <?php	
				 if (strcasecmp($res->loanSanctioned,"Yes")==0){?>
				 <input type="radio" name="loanSanctioned" id="Yes" value="Yes" required="required" checked> &nbsp; Yes &nbsp;
				 <?php } else{ ?>	
				 <input type="radio" name="loanSanctioned" id="Yes" value="Yes"> &nbsp; Yes &nbsp;
				 <?php }?>
				 <?php
				 if (strcasecmp($res->loanSanctioned,"No")==0){?>
				 <input type="radio" name="loanSanctioned" id="No" value="No" required="required" checked> &nbsp; No &nbsp;
				 <?php }else{ ?>	
				 <input type="radio" name="loanSanctioned" id="No" value="No"> &nbsp; No &nbsp;
				 <?php }?>
				</div>
				<div class="col-lg-2">
				<label>Loan amount sanctioned<span id="" style="font-size:11px;color:red">*</span>	</label>
				
				</div>
				<div class="col-lg-4">
				<input class="form-control" value="<?php echo htmlentities($res->loanAmount);?>" name="loanAmount">
				</div>
			</div>
			<br><br>			
			<div class="form-group">
		  	 	<div class="col-lg-2">
				<label>Bank</label>
				</div>
				<div class="col-lg-4">
				<input class="form-control" value="<?php echo htmlentities($res->bank);?>" name="bank">
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
				<?php 
				 if (strcasecmp($res->reference,"Newspaper")==0){?>
				 <input type="checkbox" name="reference" id="Newspaper" value="Newspaper" required="required" checked> &nbsp; Newspaper &nbsp;
				 <?php }else{ ?>	
				 <input type="checkbox" name="reference" id="Newspaper" value="Newspaper"> &nbsp; Newspaper &nbsp;
				 <?php }?>
				 <?php 
				 if (strcasecmp($res->reference,"Internet")==0){?>
				 <input type="checkbox" name="reference" id="Internet" value="Internet" required="required" checked> &nbsp; Internet &nbsp;
				 <?php }else{ ?>	
				 <input type="checkbox" name="reference" id="Internet" value="Internet"> &nbsp; Internet &nbsp;
				 <?php }?>
				 <?php 
				 if (strcasecmp($res->reference,"Cable T.V")==0){?>
				 <input type="checkbox" name="reference" id="Cable T.V" value="Cable T.V" required="required" checked> &nbsp; Cable T.V &nbsp;
				 <?php }else{ ?>	
				 <input type="checkbox" name="reference" id="Cable T.V" value="Cable T.V"> &nbsp; Cable T.V &nbsp;
				 <?php }?>
				 <?php 
				 if (strcasecmp($res->reference,"Walking")==0){?>
				 <input type="checkbox" name="reference" id="Walking" value="Walking" required="required" checked> &nbsp; Walking &nbsp;
				 <?php }else{ ?>	
				 <input type="checkbox" name="reference" id="Walking" value="Walking"> &nbsp; Walking &nbsp;
				 <?php }?>
				 <?php 
				 if (strcasecmp($res->reference,"Hoarding")==0){?>
				 <input type="checkbox" name="reference" id="Hoarding" value="Hoarding" required="required" checked> &nbsp; Hoarding &nbsp;
				 <?php }else{ ?>	
				 <input type="checkbox" name="reference" id="Hoarding" value="Hoarding"> &nbsp; Hoarding &nbsp;
				 <?php }?>
				 <?php 
				 if (strcasecmp($res->reference,"Radio")==0){?>
				 <input type="checkbox" name="reference" id="Radio" value="Radio" required="required" checked> &nbsp; Radio &nbsp;
				 <?php }else{ ?>	
				 <input type="checkbox" name="reference" id="Radio" value="Radio"> &nbsp; Radio &nbsp;
				 <?php }?>
				 <?php 
				 if (strcasecmp($res->reference,"Exhibition")==0){?>
				 <input type="checkbox" name="reference" id="Exhibition" value="Exhibition" required="required" checked> &nbsp; Exhibition &nbsp;
				 <?php }else{ ?>	
				 <input type="checkbox" name="reference" id="Exhibition" value="Exhibition"> &nbsp; Exhibition &nbsp;
				 <?php }?>
				 <?php 
				 if (strcasecmp($res->reference,"Other")==0){?>
				 <input type="checkbox" name="reference" id="Other" value="Other" required="required" checked> &nbsp; Other &nbsp;
				 <?php }else{ ?>	
				 <input type="checkbox" name="reference" id="Other" value="Other"> &nbsp; Other &nbsp;
				 <?php }?>
				</div>
			</div>

			</div>


		  </div>		
			<br>
		
	<div class="form-group">
	<div class="col-lg-4">
	</div>
	<div class="col-lg-6"><br><br>
	<input type="submit" class="btn btn-primary" name="submit" value="Update"></button>
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
