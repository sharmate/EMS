<?php
include ('session.php');
require_once './inc/common-functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Personal Information | List</title>
	
	<link rel="icon" href="img/fav3.ico">
	<link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="./dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="./vendor/morrisjs/morris.css" rel="stylesheet">
	<link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<link href="./css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
	<style type="text/css">
		body {
		    font-family: inherit;
		}
		
		/* Hide all steps by default: */

	</style>
</head>
<body>
	<div id="wrapper" class="Background-side-bar">
        <?php include 'header.php';?>
        <div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="header-top employee-list-header">
	                    <?php if ($_SESSION ['role'] == "admin") { ?>
	                    	<a href="employeeList.php" class="back-arrow"><i class="fa fa-arrow-left"></i></a>
	                    <?php } else { ?>
	<!--                    <a href="add.php" class="back-arrow"><i class="fa fa-arrow-left"></i></a> -->
	                    <?php } ?>
	                    <i class="fa fa-user"></i> <span class="user-title"></span>
					</h1>
					<hr />
				</div>
				<div class="conatiner">
					<div class="row">
						<div class="col-md-11 outing-suggestion-form">
							
							<div class="row">
								
                        		<div class="col-md-4 employee-list-header">
	                        		<form action="uploadprofilepicture.php" method="post" enctype="multipart/form-data" id="uploadimgform" autocomplete="off">
		                        		<div class="col-md-12">
		                        			<div class="form-group">
		                        				<image id="profileImage" src="img/empty_profile_image2.png" class="img-responsive personal_info_profile_pic"/>
												<input id="profile_photo" type="file" name="image" placeholder="Photo" capture accept="image/*" class="img-responsive personal_info_profile_pic"  style="max-width: 100%; display: none;">
		                        			</div>
		                        		</div>
		                        		<div class="col-md-12 personal_info_mobile_email">
		                        			<i class="fa fa-phone"></i>&nbsp;&nbsp;<span id="phoneno"></span><br>
		                        			<i class="fa fa-envelope"></i>&nbsp;&nbsp;<span id="emailid"></span>
	                        			</div>
	                        			
	                        			<input type="submit" value="Upload Image" id="uploadprf" name="uploadprf" style="display: none;">
                        			</form>
                        		</div>	
                        		
                        		<div class="card col-md-8 personal_info_card">
    <!-- Personal Information end-->
    							<div class="tab">
                        			<div class="col-lg-12">
										<h3>
                    	                    <span style="color: #2f6387;">About You</span>
										</h3>
										<hr>
									</div>
									
									<div class="col-md-6">
	                        			<div class="form-group">
	                        				<label class="field-label">Employee Name</label>
	                        				<input type="text" class="form-control" placeholder="Enter Employee Name" id="name">
	                        			</div>
	                        		</div>
				
                        			<div class="col-md-6">
	                        			<div class="form-group">
	                        				<label class="field-label">Gender</label><br>
	                        				<select class="form-control" id="gender">
	                        					<option value="0">--Select Gender--</option>
	                        					<option value="male">Male</option>
	                        					<option value="female">Female</option>
	                        				</select>
	                        			</div>
	                        		</div>
	                        		
	                        		<div class="col-md-6">
	                        			<div class="form-group">
	                        				<label class="field-label">Your Date of Birth</label><br>
	                        				<div class='input-group date' id='dob_div'>
							                    <input type='text' class="form-control" id="dob" readonly />
							                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
	                        			</div>
	                        		</div>
	                        		
	                        		<div class="col-md-6">
	                        			<div class="form-group">
	                        				<label class="field-label">Date of Joining</label><br>
	                        				<div class='input-group date' id='doj_div'>
							                    <input type='text' class="form-control" id='doj' readonly />
							                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
	                        			</div>
	                        		</div>
	                        		
	                        		<div class="col-md-6">
	                        			<div class="form-group">
	                        				<label class="field-label">Alternate Mobile No.</label><p id="alt_mobile_error" style="display : none; color : red;"></p>
	                        				<input type="text" class="form-control" placeholder="Enter Alernate Mobile No." id="alt_mobile" onkeypress="return isNumberKey(event)" maxlength="10">
	                        			</div>
	                        		</div>
	                        		
	                        		<div class="col-md-6">
	                        			<div class="form-group">
	                        				<label class="field-label">Blood Group</label><br>
	                        				<select class="form-control" id="bgroup">
	                        					<option value="0">--Select Blood Group--</option>
	                        					<option value="A+">A+</option>
	                        					<option value="A-">A-</option>
	                        					<option value="B+">B+</option>
	                        					<option value="B-">B-</option>
	                        					<option value="AB+">AB+</option>
	                        					<option value="AB-">AB-</option>
	                        					<option value="O+">O+</option>
	                        					<option value="O-">O-</option>
	                        				</select>
	                        			</div>
	                        		</div>
	                        		
	                        		<div class="col-md-12">
	                        			<div class="form-group">
	                        				<label class="field-label">Address</label><br>
	                        				<textarea class="form-control" placeholder="Enter Your Address" id="address"></textarea>
	                        			</div>
	                        		</div>
	                        	</div>
	 <!-- Personal Information end-->   
	                     	
	<!-- Parents Information start -->
	                        	<div class="tab">	
	                        		<div class="col-lg-12">
										<h3>
                    	                    <span style="color: #2f6387;">Parents Information</span>
										</h3>
										<hr>
									</div>
	                        		
	                        		<div class="col-md-6">
	                        			<div class="form-group">
	                        				<label class="field-label">Father's Name</label>
	                        				<input type="text" class="form-control" placeholder="Enter Father's Name" id="father_name">
	                        			</div>
	                        		</div>
	                        		
	                        		<div class="col-md-6">
    	                        		<div class="form-group">
    	                        				<label class="field-label">Mother's Name</label>
    	                        				<input type="text" class="form-control" placeholder="Enter Mother's Name" id="mother_name">
	                        			</div>
	                        			
	                        		</div>
	                        		
	                        		<div class="col-md-6">
	                        			<div class="form-group">
	                        				<label class="field-label">Father's Mobile No.</label><p id="fa_mobile_error" style="display : none; color : red;"></p>
	                        				<input type="text" class="form-control" placeholder="Enter Father's Mobile No." id="father_mobile" onkeypress="return isNumberKey(event)" maxlength="10">
	                        			</div>
	                        		</div>
	                        		
	                        		<div class="col-md-6">
	                        			<div class="form-group">
	                        				<label class="field-label">Mother's Mobile No.</label><p id="mo_mobile_error" style="display : none; color : red;"></p>
	                        				<input type="text" class="form-control" placeholder="Enter Mother's Mobile No." id="mother_mobile" onkeypress="return isNumberKey(event)" maxlength="10">
	                        			</div>
	                        		</div>
	                        		
	                        		<div class="col-md-6">
	                        			
	                        			<div class="form-group">
	                        				<label class="field-label">Father's Date of Birth</label><br>
	                        				<div class='input-group date' id='fa_dob_div'>
							                    <input type='text' class="form-control" id="fa_dob" readonly />
							                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
	                        			</div>
	                        		</div>
	                        		
	                        		<div class="col-md-6">
	                        			<div class="form-group">
	                        				<label class="field-label">Mother's Date of Birth</label><br>
	                        				<div class='input-group date' id='mo_dob_div'>
							                    <input type='text' class="form-control" id="mo_dob" readonly />
							                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
							                    </span>
							                </div>
	                        			</div>
	                        		</div>
	                        	</div>
	<!-- Parents Information End -->
	
	<!-- Relationship Information Start -->
								<div class="tab">
	                        		<div class="col-lg-12">
										<h3>
                    	                    <span style="color: #2f6387;">Relationship Information</span>
										</h3>
										<hr>
									</div>
	                        		<div class="row">
    	                        		<div class="col-md-6">
    	                        			<div class="form-group">
    	                        				<label class="field-label">Marital Status</label><br>
    	                        				<select class="form-control" id="marital_status">
    	                        					<option value="0">--Select Marital Status--</option>
    	                        					<option value="married">Married</option>
    	                        					<option value="unmarried">Unmarried</option>
    	                        				</select>
    	                        			</div>
    	                        		</div>
    	                        		
	                        		</div>
	                        		<div class="row">
	                        			<div class="col-md-6">
        	                        		<div class="form-group spouse_name" style="display : none;">
        	                        				<label class="field-label">Spouse Name</label>
        	                        				<input type="text" class="form-control" placeholder="Enter Mother's Name" id="spouse_name">
    	                        			</div>
    	                        			
    	                        		</div>
    	                        		<div class="col-md-6 sp_mobile" style="display : none;">
    	                        			<div class="form-group">
    	                        				<label class="field-label">Spouse's Mobile No.</label><p id="sp_mobile_error" style="display : none; color : red;"></p>
    	                        				<input type="text" class="form-control" placeholder="Enter Spouse's Mobile No." id="sp_mobile" onkeypress="return isNumberKey(event)" maxlength="10">
    	                        			</div>
    	                        		</div>
    	                        		
    	                        		
	                        		</div>
	                        		<div class="row">
	                        			<div class="col-md-6 spouse_dob" style="display : none;">
    	                        			<div class="form-group">
    	                        				<label class="field-label">Spouse  Date of Birth</label><br>
    	                        				<div class='input-group date' id='spouse_div'>
    							                    <input type='text' class="form-control" id="spouse_dob" readonly />
    							                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
    							                    </span>
    							                </div>
    	                        			</div>
    	                        		</div>
    	                        		<div class="col-md-6 anniversary" style="display : none;">
    	                        			<div class="form-group">
    	                        				<label class="field-label">Anniversary Date</label><br>
    	                        				<div class='input-group date' id='anniversary_div'>
    							                    <input type='text' class="form-control" id="anniversary" readonly />
    							                    <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span>
    							                    </span>
    							                </div>
    	                        			</div>
    	                        		</div>
    	                        		
	                        		</div>
	                        	</div>
	<!-- Relationship Information Start -->
	                        		
	                     
	                        		<input type="button" value="Reset" id="reset" name="reset" class="btn-lg btn btn-warning reset-btn">
									<input type="button" value="Submit" id="submit" name="submit" class="btn-lg btn btn-success submit-btn submit-attendance-btn">
                        		</div>
                        	</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<?php 
	   include 'footer.php';
	?>
	
	<script src="./vendor/jquery/jquery.min.js"></script>
	<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="./vendor/metisMenu/metisMenu.min.js"></script>
	<script src="./vendor/raphael/raphael.min.js"></script>
	<script src="./dist/js/sb-admin-2.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="./js/bootstrap-datepicker.js"></script>
	<script type='text/javascript'>
		 var tmpEmployeeId = "<?php echo $_SESSION['login_userid']; ?>";
	
	     $(document).ready(function(){
	    	 showEmpMobile();
	    	 getProfileDetails();
	     });
	     
	     $(function () {
	    	 var d = new Date();
	    	 var month = d.getMonth()+1;
	    	 var day = d.getDate();

	    	 var output = d.getFullYear() + '-' +
	    	     (month<10 ? '0' : '') + month + '-' +
	    	     (day<10 ? '0' : '') + day;
    	     var date = new Date(d.getFullYear(), month, day);
		     
	    		$("#dob_div").datepicker({ autoclose: true, format: 'yyyy-mm-dd', maxDate: '0' });
	    	 $( "#anniversary_div" ).datepicker({ autoclose: true, format: 'yyyy-mm-dd' });
	    	 $( "#spouse_div" ).datepicker({ autoclose: true, format: 'yyyy-mm-dd' });
	    	 $( "#doj_div" ).datepicker({ autoclose: true, format: 'yyyy-mm-dd' });
	    	 $( "#fa_dob_div" ).datepicker({ autoclose: true, format: 'yyyy-mm-dd' });
	    	 $( "#mo_dob_div" ).datepicker({ autoclose: true, format: 'yyyy-mm-dd' });
    	  	
    	  	$("#marital_status").on('change', function () {
        	  	var marital_status = $("#marital_status").val();
        	  	if(marital_status == 'married') {
            	  	$(".anniversary").show('slow');
            	  	$(".sp_mobile").show('slow');
            	  	$(".spouse_name").show('slow');
            	  	$(".spouse_dob").show('slow');
        	  	} else {
        	  		$(".anniversary").hide('slow');
            	  	$(".sp_mobile").hide('slow');
            	  	$(".spouse_name").hide('slow');
            	  	$(".spouse_dob").hide('slow');
        	  	}  	 	
    	  	});

    	  	$("#profileImage").on('click', function () {
    	  		$("#profile_photo").trigger("click");
    	  	});  	
    	  	
    	  	$("#profile_photo").on('change', function () {
        	  	$("#uploadprf").trigger("click");	 	
    	  	});
    	  	
    	  	$('#uploadimgform').on('submit',function(e) {
    	        e.preventDefault();
    	        var formData = new FormData(this);

    	        $.ajax({
    	            type:'POST',
    	            url: $(this).attr('action'),
    	            data:formData,
    	            cache:false,
    	            contentType: false,
    	            processData: false,
    	            success:function(data){
    	            	var data = JSON.parse(data);
    	                if(data.status) {
    	                	swal('Success',"Image Uploaded Successfully", "success");
    	                	$("#profileImage").attr("src","uploads/profile_picture/"+data.image_name);
    	                } else {
        	                swal('Error', data.message , "error");
    	                }        
    	            },
    	            error: function(data){
    	            	console.log('error');
    	                console.log(data);
    	            }
    	        });
    	    });

    	  	$("#submit").on('click', function () {
    	  		//e.preventDefault();
    	  		var tmpData = new Object();
    	  		tmpData.userid = tmpEmployeeId;
				var errorflag = 0;
				if($("#name").val()!=''){
    	  			tmpData.name = $("#name").val();
    	  		}
    	  		if($("#gender").val()!='0'){
    	  			tmpData.gender = $("#gender").val();
    	  		}
    	  		if($("#dob").val()!=''){
    	  			tmpData.dob = $("#dob").val();
    	  		}
    	  		if($("#father_name").val()!=''){
    	  			tmpData.father_name = $("#father_name").val();
    	  		}
    	  		if($("#mother_name").val()!=''){
    	  			tmpData.mother_name = $("#mother_name").val();
    	  		}
    	  		if($("#father_mobile").val()!=''){
    	  			if($("#father_mobile").val().length==10){
    	  				tmpData.father_mobile = $("#father_mobile").val();
    	  				$('#fa_mobile_error').hide();
    	  			} else {
        	  			if(errorflag == 0) {
        	  				swal('Error', 'Please enter 10 digit mobile number', "error");
        	  			}	
        	  			$('#fa_mobile_error').html('Please enter 10 digit mobile number');
        	  			$('#fa_mobile_error').show();
        	  			errorflag = 1;
    	  			}		
    	  		} else {
    	  			$('#fa_mobile_error').hide();
    	  		}
    	  		if($("#mother_mobile").val()!=''){
    	  			if($("#mother_mobile").val().length==10){
    	  				tmpData.mother_mobile = $("#mother_mobile").val();
    	  				$('#mo_mobile_error').hide();
    	  			} else {
        	  			if(errorflag == 0) {
        	  				swal('Error', 'Please enter 10 digit mobile number', "error");
        	  			}	
        	  			$('#mo_mobile_error').html('Please enter 10 digit mobile number');
        	  			$('#mo_mobile_error').show();
        	  			errorflag = 1;
    	  			}		
    	  		} else {
    	  			$('#mo_mobile_error').hide();
    	  		}
    	  		if($("#fa_dob").val()!=''){
    	  			tmpData.father_dob = $("#fa_dob").val();
    	  		}
    	  		if($("#mo_dob").val()!=''){
    	  			tmpData.mother_dob = $("#mo_dob").val();
    	  		}
    	  		if($("#anniversary").val()!=''){
    	  			tmpData.anniversary_date = $("#anniversary").val();
    	  		}
    	  		if($("#marital_status").val()!='0'){
    	  			tmpData.marital_status = $("#marital_status").val();
    	  		}
    	  		if($("#spouse_name").val()!=''){
    	  			tmpData.spouse_name = $("#spouse_name").val();
    	  		}
    	  		if($("#spouse_dob").val()!=''){
    	  			tmpData.spouse_dob = $("#spouse_dob").val();
    	  		}
	  			if($("#sp_mobile").val()!=''){
    	  			if($("#sp_mobile").val().length==10){
    	  				tmpData.spouse_mobile = $("#sp_mobile").val();
    	  				$('#sp_mobile_error').hide();
    	  			} else {
    	  				if(errorflag == 0) {
    	  					swal('Error', 'Please enter 10 digit mobile number', "error");
    	  				}
        	  			$('#sp_mobile_error').html('Please enter 10 digit mobile number');
        	  			$('#sp_mobile_error').show();
        	  			errorflag = 1;
    	  			}
    	  		}
    	  		if($("#doj").val()!=''){
    	  			tmpData.doj = $("#doj").val();
    	  		}
    	  		if($("#alt_mobile").val()!=''){
    	  			if($("#alt_mobile").val().length==10){
    	  				tmpData.alt_contact = $("#alt_mobile").val();
    	  				$('#alt_mobile_error').hide();
    	  			} else {
    	  				if(errorflag == 0) {
    	  					swal('Error', 'Please enter 10 digit mobile number', "error");
    	  				}
        	  			$('#alt_mobile_error').html('Please enter 10 digit mobile number');
        	  			$('#alt_mobile_error').show();
        	  			errorflag = 1;
    	  			}
    	  		} else {
    	  			$('#alt_mobile_error').hide();
    	  		}	
    	  		if($("#address").val()!=''){
    	  			tmpData.address = $("#address").val();
    	  		}
    	  		if($("#bgroup").val()!='0'){
    	  			tmpData.blood_group = $("#bgroup").val();
    	  		}

    	  		if(errorflag > 0) {
        	  		return false;
    	  		}	
    	          
    	        var settings = {
    	            "async": false,
    	            "crossDomain": true,
    	            "url": "saveProfileDetails.php",
    	            "method": "POST",
    	            "processData": false,
    	            "data": JSON.stringify(tmpData)
    	        }
    	
    	        var tmpResult = new Array();
    	
    	        $.ajax(settings).done(function (response) {
        	        console.log(response);
    	           var json = JSON.parse(response);

    	           if(json.status == true)
    	           {
    		           swal('Success', json.message, "success");
    	           }
    	           else
    	           {
    		           swal('Error', json.message, "error");
    	           }
    	        });
    	  	});
    	    
    	 });
     
		function showEmpMobile()
		{
			var tmpId = localStorage.getItem('empId');
		
			if(tmpId && tmpId !== "")
			{
				tmpEmployeeId = tmpId;
			}
			
			var tmpData = new Object();
			tmpData.userid = tmpEmployeeId;
	        
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "getEmployeeDetails.php",
	            "method": "POST",
	            "headers": {
	              "Content-Type": "application/json",
	              "Cache-Control": "no-cache"
	            },
	            "processData": false,
	            "data": JSON.stringify(tmpData)
	        };
		
	        var tmpResult = new Array();
	
	        $.ajax(settings).done(function (response) {
	            var json = JSON.parse(response);
	            if(json.status && json.status == true)
	            {
	            	var employeeName = '';
	            	var phoneno = '';
	            	var emailid = '';
		
	            	tmpUser = json.response;
	                if(json.response.name && json.response.name !== "")
	                {
	               	 employeeName = json.response.name;
	                }
		
	                if(json.response.contact && json.response.contact !== "")
	                {
	                	phoneno = json.response.contact;
	                }
		
	                if(json.response.email && json.response.email !== "")
	                {
	                	emailid = json.response.email;
	                }
	
	                $('.user-title').html(employeeName);
	                $('#name').val(employeeName);
	                $('#phoneno').html(phoneno);	
	                $('#emailid').html(emailid);
	            }
	        });
		}

		function getProfileDetails() 
		{
			var tmpId = localStorage.getItem('empId');
			
			if(tmpId && tmpId !== "")
			{
				tmpEmployeeId = tmpId;
			}
			
			var tmpData = new Object();
			tmpData.userid = tmpEmployeeId;
	        
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "getProfileDetails.php",
	            "method": "POST",
	            "headers": {
	              "Content-Type": "application/json",
	              "Cache-Control": "no-cache"
	            },
	            "processData": false,
	            "data": JSON.stringify(tmpData)
	        };
	
	        var tmpResult = new Array();
	
	        $.ajax(settings).done(function (response) {
	            var json = JSON.parse(response);
	            if(json.status && json.status == true)
	            {
	            	response = json.response;
	            	if(response.profile_image && response.profile_image !== "")
	                {
	            		$("#profileImage").attr("src","uploads/profile_picture/"+response.profile_image);
	                }
	            	if(response.gender && response.gender !== ""){
						$("#gender").val(response.gender);
	    	  		}
	    	  		if(response.dob && response.dob !== ""){
						$("#dob").val(response.dob);
	    	  		}
	    	  		if(response.father_name && response.father_name !== ""){
	    	  			$("#father_name").val(response.father_name);
	    	  		}
	    	  		if(response.mother_name && response.mother_name !== ""){
	    	  			$("#mother_name").val(response.mother_name);
	    	  		}
	    	  		if(response.father_mobile && response.father_mobile !== ""){
	    	  			$("#father_mobile").val(response.father_mobile);
	    	  		}
	    	  		if(response.mother_mobile && response.mother_mobile !== ""){
	    	  			$("#mother_mobile").val(response.mother_mobile);
	    	  		}
	    	  		if(response.father_dob && response.father_dob !== ""){
						$("#fa_dob").val(response.father_dob);
	    	  		}
	    	  		if(response.mother_dob && response.mother_dob !== ""){
						$("#mo_dob").val(response.mother_dob);
	    	  		}
    	  			if(response.anniversary_date && response.anniversary_date !== ""){
        	  			$("#anniversary").val(response.anniversary_date);
        	  		}
    	  			if(response.spouse_mobile && response.spouse_mobile !== ""){
        	  			$("#sp_mobile").val(response.spouse_mobile);
        	  		}
    	  			if(response.marital_status && response.marital_status !== ""){
        	  			$("#marital_status").val(response.marital_status);
        	  			if(response.marital_status == 'married') {
                    	  	$(".anniversary").show('slow');
                    	  	$(".sp_mobile").show('slow');
                    	  	$(".spouse_name").show('slow');
                    	  	$(".spouse_dob").show('slow');
                	  	}
        	  		}
    	  			if(response.anniversary_date && response.anniversary_date !== ""){
        	  			$("#anniversary").val(response.anniversary_date);
        	  		}
    	  			if(response.spouse_name && response.spouse_name !== ""){
        	  			$("#spouse_name").val(response.spouse_name);
        	  		}
    	  			if(response.spouse_dob && response.spouse_dob !== ""){
        	  			$("#spouse_dob").val(response.spouse_dob);
        	  		}
    	  			if(response.spouse_mobile && response.spouse_mobile !== ""){
        	  			$("#sp_mobile").val(response.spouse_mobile);
        	  		}
        	  		
	    	  		if(response.doj && response.doj !== ""){
	    	  			$("#doj").val(response.doj);
	    	  		}
	    	  		if(response.alt_contact && response.alt_contact !== ""){
	    	  			$("#alt_mobile").val(response.alt_contact);
	    	  		}
	    	  		if(response.address && response.address !== ""){
	    	  			$("#address").val(response.address);
	    	  		}
	    	  		if(response.blood_group && response.blood_group !== ""){
	    	  			$("#bgroup").val(response.blood_group);
	    	  		}
	            }
	        });
		}
		function isNumberKey(evt){
		    var charCode = (evt.which) ? evt.which : event.keyCode
		    if (charCode > 31 && (charCode < 48 || charCode > 57))
		        return false;
		    return true;
		}
	</script>

	
</body>
</html>
