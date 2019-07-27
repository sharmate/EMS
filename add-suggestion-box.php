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
	<title>Suggestion Box | EMS</title>
	
	<link rel="icon" href="img/fav3.ico">
	<link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="./dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="./vendor/morrisjs/morris.css" rel="stylesheet">
	<link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<link href="./css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
</head>
<body>
	<div id="wrapper" class="Background-side-bar">
        <?php include 'header.php';?>
        <div id="page-wrapper">
			<div class="row">
				<div class="col-lg-12">
					<h1 class="header-top employee-list-header">
	                    <?php if ($_SESSION ['role'] == "admin") { ?>
	                    	<a href="suggestion-list-admin.php" class="back-arrow"><i class="fa fa-arrow-left"></i></a>
	                    <?php } else { ?>
	<!--                    <a href="add.php" class="back-arrow"><i class="fa fa-arrow-left"></i></a> -->
	                    <?php } ?>
	                    <i class="fa fa-user"></i> <span class="user-title"></span>
					</h1>
					<hr />
				</div>
				<div class="conatiner">
					<div class="row suggestion_div">
						<div class="col-md-6">
							<h2 class="text-header suggestion_main_header">Suggestion Box</h2>
							<div class="form-data">
								<div class="form-group">
									<label>Subject </label>
									<input type="text" name="subject" id="subject" placeholder="Enter Your Subject..." class="form-control"/>
																	
								</div>
								<div class="form-group">
									<label>Message </label>
									<textarea name="message" id="message"  placeholder="Enter Your Message..." class="form-control" style="height: 100px;"></textarea>								
								</div> 
								<div class="btn_access">
    								<button type="button" value="Reset" id="reset" name="reset" class=" btn btn-warning btn-lg reset-box">Reset</button>
    								<button type="button" value="Save & Submit" id="submit" name="submit" class=" btn btn-lg btn-success save-btn">Save & Submit</button>
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

   			var tmpId = localStorage.getItem('empId');
	
			if(tmpId && tmpId !== "")
			{
				tmpEmployeeId = tmpId;
			}

   			getEmployeeDetails();

   			getSuggestionHistory();

   			$('.save-btn').click(function(){
   				submitSuggestionBox();
   				
   	   		});
   	       
    	});

		$('.reset-box').click(function(){

			resetForm();
			});

		function getEmployeeDetails()
		{
			
			
			var tmpData = new Object();
			tmpData.userid = tmpEmployeeId;
	          
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "getEmployeeDetails.php",
	            "method": "POST",
	            "processData": false,
	            "data": JSON.stringify(tmpData)
	        }
	
	        var tmpResult = new Array();
	
	        $.ajax(settings).done(function (response) {
	            var json = JSON.parse(response);
	
	            if(json.status && json.status == true)
	            {
	            	var employeeName = '';
	
	            	tmpUser = json.response;
	                if(json.response.name && json.response.name !== "")
	                {
	               	 employeeName = json.response.name;
	                }
	
	                $('.user-title').html(employeeName);
	            }
	        });
	
		}

		function submitSuggestionBox()
		{

			//console.log("Test");
			var subject = $('#subject').val();
			if(subject == ""){
				swal("Error", "Please Insert Your Subject !!!");
			}
			var message = $('#message').val();
			if(message == ""){
				swal("Error", "Please Insert Your Message !!!");
			}
			var tmpData = new Object();
			tmpData.employee_id = tmpEmployeeId;
			tmpData.subject = subject;
			tmpData.message = message;
// 			console.log(tmpData);

// 			return false;
			
	          
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "save-suggestion-box.php",
	            "method": "POST",
	            "processData": true,
	            "data": JSON.stringify(tmpData)
	        }
	
	       // var tmpResult = new Array();
	
	        $.ajax(settings).done(function (response) {
	        	var json = JSON.parse(response);
				if(json.status == true){
					
	        	sendMailSuggestionBox();	
				}  
	        });
		}

		function getSuggestionHistory()
		{
			var tmpData = new Object();
			tmpData.id = tmpEmployeeId;
			  
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "get-suggestion.php",
	            "method": "POST",
	            "processData": false,
	            "data": JSON.stringify(tmpData)
	        }
	
	       // var tmpResult = new Array();
	
	        $.ajax(settings).done(function (response) {
	     //     var json = JSON.parse(response);

// 	           if(json.status == true)
// 	           {
	        	   
	        	  
	        	   if(response.subject && response.subject != "")
	        	   {
	        	   	$('#subject').val(json.response.subject);
	        	   }
	        	   if(response.message && response.message != "")
	        	   {
	        	   	$('#message').val(json.response.message);
	        	   }
	        	   			
// 	        	   disableFields();
// 	           }
	        });
		}

// 		function disableFields()
// 		{
			
//      	   $('#subject').attr("disabled", true);
//      	  $('#message').attr("disabled", true);
     	 

//      	   $('.save-btn').hide();
//      	   $('.reset-box').hide();
// 		}

		function resetForm(){
			$('input[name=subject').val('');
			$('textarea[name=message').val('');
		
		}


		function sendMailSuggestionBox(){
			var subject =  $('#subject').val();
			var message =  $('#message').val();
			
			var tmpData = new Object();
			tmpData.subject = subject;
			tmpData.message = message;

			 var settings = {
					  "async": true,
					  "crossDomain": true,
					  "url": "suggestion-mail.php",
					  "method": "POST",
					  "processData": false,
					  "data": JSON.stringify(tmpData)
					}

					$.ajax(settings).done(function (response) {
						 console.log(response);

				  		    if(response.status !== true)
				  		    {
// 				  		      swal('Success', "Thank you for Suggestion !!!", "success");
				  		      window.location = "view-suggestion-list-user-copy.php";
				  		    }
				  		    else
				  		    {
				  		  		swal('Error', "Thank you for Suggestion !!!", "error");
				  		    }
					});
		}

		 
			
</script>
    
</body>
</html>
