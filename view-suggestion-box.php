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
					<h1 class="header-top employee-list-header view_suggstion_main_header">
	                    <?php if ($_SESSION ['role'] == "admin") { ?>
	                    	<a href="view-suggestion-list-admin.php" class="back-arrow"><i class="fa fa-arrow-left"></i></a>
	                    <?php } else { ?>
						<a href="all-view-suggestion-history-user.php" class="back-arrow"><i class="fa fa-arrow-left"></i></a>
	                    <?php } ?>
	                    <i class="fa fa-user"></i> <span class="user-title"></span>
					</h1>
					<hr />
				</div>
				<div class="conatiner">
					<div class="row view_suggestion_main_div">
						<div class="col-md-6">
							<h2 class="text-header view_suggstion_header2"><i class="fa fa-envelope">&nbsp;</i>Suggestion Box</h2>
							<div class="form-data">
								<h3>Subject </h3>
								<div class="form-group reply-item">
									<h4 id="subject"></h4>						
								</div>
								<h3>Message </h3>
								<div class="form-group reply-item">
									<p id="message"></p>
									<p>
										<span id="data_added"></span>
									</p>
									
								</div>
								
								<h3>Replies</h3>
								<div class="form-group replies-container">
														
								</div>
								
								<div class="close_reply" id="close_message" style="display: none;">
									<i class="fa fa-times-circle-o" id="fa-close"></i>
									<p>Now your close suggestion, Thank You!!!</p>
								</div>
								
								<?php if($_SESSION ['role'] == "admin"){ ?>
    								<div class="form-group">
    									<h3 id="reply-header">Reply </h3>
    									<textarea name="reply_admin" id="reply_admin"  placeholder="Enter Your Message..." class="form-control reply_admin" style="height: 85px;"></textarea>
    									<textarea name="reply_user" id="reply_user"  placeholder="Enter Your Message..." class="form-control hidden" style="height: 85px;"></textarea>								
    								</div>
    								<input type="button" value="Reply" id="reply_admin" name="reply_admin" class=" btn btn-success btn-lg reply-admin-btn" onClick="window.location.reload();">
								<?php }?>
								<?php if($_SESSION ['role'] == "user"){ ?>
    								<div class="form-group">
    									<h3 id="reply-header">Reply </h3>
    									<textarea name="reply_user" id="reply_user"  placeholder="Enter Your Message..." class="form-control reply_user" style="height: 85px;"></textarea>								
    									<textarea name="reply_admin" id="reply_admin"  placeholder="Enter Your Message..." class="form-control hidden" style="height: 85px;"></textarea>								
    								
    								</div>
    								<input type="button" value="Reply" id="reply_user" name="reply_user" class=" btn btn-success btn-lg reply-user-btn" onClick="window.location.reload();">
								<?php }?>
								
							</div>
						</div>	
						
					</div>	
					
				</div>
				
			</div>
		</div>
	</div>
	
	
	
	<script src="./vendor/jquery/jquery.min.js"></script>
	<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="./vendor/metisMenu/metisMenu.min.js"></script>
	<script src="./vendor/raphael/raphael.min.js"></script>
	<script src="./dist/js/sb-admin-2.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="./js/bootstrap-datepicker.js"></script>
	
	
	<script type='text/javascript'>

    	var tmpEmployeeId = "<?php echo $_SESSION['login_userid']; ?>";
    	var tmpEmail = "<?php echo $_SESSION['login_user'] ?>";
    	var role = "<?php echo $_SESSION['role']?>";
		var suggestedById = "";
   		$(document).ready(function(){

   			var tmpId = localStorage.getItem('empId');
   			suggestedById = localStorage.getItem('suggested_by');
//    			var tmpStatus = localStorage.getItem('status');
//    			if(tmpStatus && tmpStatus !== ""){
//    	   			temStatusEmp = tmpStatus;
//    			}
   			//console.log(tmpStatus);
				
			if(tmpId && tmpId !== "")
			{
				tmpEmployeeId = tmpId;
			}
			var tmpId = localStorage.getItem('id');
			if(tmpId && tmpId !== "")
			{
				tmpHistoryId = tmpId;
			}

			
   			getEmployeeDetails();

   			getSuggestionHistory();

   			getReplyAdmin();
   			
   			$('.reply-admin-btn').click(function(){
   				saveReplyAdmin();
   				sendReplyAdminMail();
   			});
   	   		$('.reply-user-btn').click(function(){

   	   			sendReplyUserMail();
   	   			saveReplyUser();
   	   	   		});

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

		function getEmployeeById(employeeId)
		{

			console.log(employeeId);
			
			var tmpData = new Object();
			tmpData.userid = employeeId;
	        
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "getEmployeeDetails.php",
	            "method": "POST",
	            "processData": false,
	            "data": JSON.stringify(tmpData)
	        }
	
	        var tmpResult = new Array();

	        var employeeName = '';
	        $.ajax(settings).done(function (response) {
	            var json = JSON.parse(response);
	
	            if(json.status && json.status == true)
	            {
	            	
	
	            	tmpResult = json.response;
	                
	            }
	        });

	        //console.log(tmpResult);
	    	return tmpResult;
		}

		
		
		function getSuggestionHistory()
		{
			
			var tmpData = new Object();
			tmpData.id = tmpHistoryId;
			//console.log(tmpHistoryId);  
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "get-suggestion.php",
	            "method": "POST",
	            "processData": false,
	            "data": JSON.stringify(tmpData)
	        }
	
	       var tmpResult = new Array();
	
	        $.ajax(settings).done(function (response) {
		        //console.log(response);
	        	 var json = JSON.parse(response);

		           if(json.status == true)
		           {

 						$("#subject").html(json.response.subject);
		        	   $("#message").html(json.response.message);
		        	   $("#data_added").html(json.response.data_added);

		        	  
		           }
	        });
		}


		function sendReplyAdminMail(){
			//console.log("test");
			var reply_admin =  $('#reply_admin').val();

			var tmpEmployee = getEmployeeById(suggestedById);

			console.log(suggestedById);
			console.log("Employee email: "+tmpEmployee.email);
			console.log("Employee Name: "+tmpEmployee.name);
			
			var tmpReply = new Object();
			tmpReply.id = tmpHistoryId;
			tmpReply.reply_admin = reply_admin;
			tmpReply.tmpEmailId = tmpEmployee.email;
			tmpReply.tmpName = tmpEmployee.name;
			
			
			
			 var settings = {
					  "async": true,
					  "crossDomain": true,
					  "url": "reply-admin-mail.php",
					  "method": "POST",
					  "processData": false,
					  "data": JSON.stringify(tmpReply)
					}

					$.ajax(settings).done(function (response) {
						 console.log(response);

				  		    if(response.status !== true)
				  		    {
				  		      swal('Success', "Sent Successfully !!!", "success");
				  		    }
				  		    else
				  		    {
				  		  		swal('Error', "Sent Successfully !!!", "error");
				  		    }
					});
		}
		
		function sendReplyUserMail(){
			//console.log("test");
			var reply_user =  $('#reply_user').val();
			var tmpEmployeeName = getEmployeeById(suggestedById);

			//console.log("Employee Email: "+tmpEmployeeName.name);
			
			var tmpReply = new Object();
			tmpReply.id = tmpHistoryId;
			tmpReply.reply_user = reply_user;
			tmpReply.tmpName = tmpEmployeeName.name;
			console.log(tmpEmployeeName);
			 var settings = {
					  "async": true,
					  "crossDomain": true,
					  "url": "reply-user-mail.php",
					  "method": "POST",
					  "processData": false,
					  "data": JSON.stringify(tmpReply)
					}

					$.ajax(settings).done(function (response) {
						 console.log(response);

				  		    if(response.status !== true)
				  		    {
				  		      swal('Success', "Sent Successfully !!!", "success");
				  		    }
				  		    else
				  		    {
				  		  		swal('Error', "Sent Successfully !!!", "error");
				  		    }
					});
		}

		function saveReplyAdmin(){
			//console.log('test');
			var subject = $('#subject').val();
			var reply_admin = $('#reply_admin').val();
			if(reply_admin == ""){
				swal("Error", "Please Insert Your Reply !!!");
			}
			
			var temData = new Object();
			temData.tmpEmployeeId = tmpEmployeeId;
			temData.id = tmpHistoryId;
			temData.role = role;
			
			
			//console.log(role);
			
			temData.reply_admin = reply_admin;

			var settings = {
					"async" : true,
					"crossDomain" : true,
					"url": "save-reply-message-admin.php",
					"method" : "POST",
					"processData" : false,
					"data" : JSON.stringify(temData)
			}
			  //var tmpResult = new Array();
			
	        $.ajax(settings).done(function (response) {
	            //var json = JSON.parse(response);
				console.log(response);

				//sendReplyAdminMail();
	        });
		}

		function saveReplyUser(){
			//console.log('test');
			var subject = $('#subject').val();
			var reply_user = $('#reply_user').val();
			if(reply_user == ""){
				swal("Error", "Please Insert Your Reply !!!");
			}
			
			var temData = new Object();
			temData.tmpEmployeeId = tmpEmployeeId;
			temData.id = tmpHistoryId;
			temData.role = role;
			console.log(role);
			
			temData.reply_user = reply_user;

			var settings = {
					"async" : true,
					"crossDomain" : true,
					"url": "save-reply-message-user.php",
					"method" : "POST",
					"processData" : false,
					"data" : JSON.stringify(temData)
			}
			  //var tmpResult = new Array();
			
	        $.ajax(settings).done(function (response) {
	            //var json = JSON.parse(response);
				console.log(response);
	        });
		}

		function getReplyAdmin(){
			//console.log('test');
			var tmpData = new Object();
			tmpData.id = tmpHistoryId;
// 			tmpData.statusId = temStatusEmp;
// 			console.log(temStatusEmp);
	       var settings = {
            "async": false,
            "crossDomain": true,
            "url": "get-reply-message.php",
            "method": "POST",
            "headers": {
              "Content-Type": "application/json",
              "Cache-Control": "no-cache"
            },
            "processData": false,
            "data": JSON.stringify(tmpData)
        }
	       
	       var tmpSuggestions = new Array();
	
	        $.ajax(settings).done(function (response) {
				
	        	var json = JSON.parse(response);
	        	//console.log(response.status);
	        	if(json.status == true)
	            {
	        		tmpSuggestions = JSON.parse(response);
	        		 
	            }
	            
				
	        	
	        });
	       
	        console.log(tmpSuggestions);
	        
	        var tmpListing = '';
	        for(var i=0; i<tmpSuggestions.response.length; i++)
 	        {
 		     	var tmpReply = tmpSuggestions.response[i];
				
 		     	tmpListing += '<div class="reply-item">';
 		     	tmpListing += '<h4 class="replied-by">'+tmpReply.replied_by_name+' <span>'+tmpReply.date_added+'</span></h4>';
 		     	tmpListing += '<p>'+tmpReply.reply+'</p>';
 		     	tmpListing += '</div>';

 		     	suggestedById = tmpReply.tmpEmployeeId;

 		     	 //console.log(tmpSuggestions.response[i].status);
 		    	   if(tmpSuggestions.response[i].status == 1){
 		        	console.log(tmpSuggestions);
 			            DisableField();
 		         	}
 		    }

 		    $('.replies-container').html(tmpListing);
 		
 		  
		}

		
		function DisableField(){
			//console.log('test');
			//$(".reply-item").html('disabled',true);
			$('#close_message').show();
			$('#reply_admin').hide();
			$('#reply_user').hide();
			$('.reply-user-btn').hide();
			$('.reply-admin-btn').hide();
			$('#reply-header').hide();
		}
		
</script>

    
</body>
</html>
