<?php
include('session.php');


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

    <title>Annual Outing Suggestions | EMS</title>
	<!-- Font Aswsome -->
	
	<link rel="icon" href="img/fav3.ico">
    <!-- Bootstrap Core CSS -->
    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="./dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="./vendor/morrisjs/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   
</head>

<body>

    <div id="wrapper"  class="Background-side-bar">

        <!-- Navigation -->
        <?php
        	include 'header.php';	
        ?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="header-top employee-list-header">
                    <?php 
                        
                            if($_SESSION['role'] == "admin")
                            {
                         ?>
                                <a href="annual-outing-suggestions-admin.php" class="back-arrow"><i class="fa fa-arrow-left"></i></a>
                           <?php 
                            }
                         
                            else
                            {
                            ?>
<!--                                 <a href="add.php" class="back-arrow"><i class="fa fa-arrow-left"></i></a> -->
                                
                            <?php 
                            }
                            
                            ?>
                    
                               <i class="fa fa-user"></i> <span class="user-title"></span>
                           
                                    
                   
                    </h1>
                    <hr/>
                </div>
                
                <div class="conatiner">

                    <div class="row">
                    
                        <div class="col-md-6 outing-suggestion-form">
                        	
                        	<form id="outing_form">
                        	<div class="row">
                        		
                        		<div class="col-md-12">
                        			<div class="show annual-outing-para-style">
                        				<p>Our Annual Picnic is happening on Feb 23 and 24. We will be leaving from Bangalore at 6:00AM in morning on Feb 23 and comeback by 10:00PM 24th Feb </p>
                        			</div>
                        			<div class="hide-div">
                        			<div class="form-group">
                        				<label class="field-label">Outing Options</label><br>
                        				<label for = "option-1" class="outing-options">
                        					<input type="radio" name="outing_option" value="saturday-sunday" id="option-1"> Saturday-Sunday
                        				</label>
                        				<br>
                        				<label for = "option-2" class="outing-options">
                        					<input type="radio" name="outing_option" value="saturday" id="option-2"> Saturday
                        				</label>
                        			</div>
                        		
                        		
                        			<div class="form-group">
                        				<label class="field-label">Preferred Location</label><br>
                        				<input type="text" class="form-control" placeholder="Enter Preferred Location" id="preferred_location">
                        			</div>
                        			
                        	
                        		
                        			<div class="form-group">
                        				<label class="field-label">Preferred Month</label><br>
                        				<select class="form-control" id="preferred_month">
                        					<option value="January">January</option>
                        					<option value="February">February</option>
                        					<option value="March">March</option>
                        				</select>
                        			</div>
                        		</div>
                        			<div class="form-group">
                        				<label class="field-label">Annual Outing Confirmation</label><br>
                        				<label>Please confirm your participation :-</label>&nbsp;&nbsp;
                        				<input type="radio" name="confirmation_status" id="confirmation_status" value="yes">YES
                        				<input type="radio" name="confirmation_status" id="confirmation_status" value="no">NO
                        			</div>
                        			
                        		</div>
                        		
                        	</div>
                        	
                        	
                        	    
                            <input type="button" value="Submit" id="submit" name="submit" class="btn-lg btn btn-success submit-btn" >
                        	<input type="reset" value="Reset" id="reset" name="reset" class="btn-lg btn btn-warning reset-btn" >
                        	
                        	
                        	</form>
                        	
                        </div>
                    	
                    	<!-- Confirm Outing Start -->
                    	
                    	<!-- Confirm Outing End -->
                    </div>
                </div>
              </div>
            </div>
         
        </div>
    <!-- /#wrapper -->
	
	<!-- Footer -->
	<?php 
	   include 'footer.php';
	?>
    <!-- jQuery -->
    <script src="./vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="./vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="./vendor/raphael/raphael.min.js"></script>
    <!-- <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="./data/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="./dist/js/sb-admin-2.js"></script>
    
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script type='text/javascript'>

    	var tmpEmployeeId = "<?php echo $_SESSION['login_userid']; ?>";
    
   		$(document).ready(function(){

   			var tmpId = localStorage.getItem('empId');
	
			if(tmpId && tmpId !== "")
			{
				tmpEmployeeId = tmpId;
			}

   			getEmployeeDetails();

   			getOutingSuggestion();


   			$('.submit-btn').click(function(){
				submitOutingSuggestion();
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

		function submitOutingSuggestion()
		{
			var outing_option = $('input[name=outing_option]:checked').val();
			var confirmation_status = $('input[name=confirmation_status]:checked').val();
			var preferred_location = $('#preferred_location').val();
			var preferred_month = $('#preferred_month').val();

// 			if(!outing_option)
// 			{
// 				swal('Error', "Please select an Outing Option", "error");

// 				return false;
// 			}

// 			if(!confirmation_status)
// 			{
// 				swal('Error', "Please select an Confirm Check", "error");

// 				return false;
// 			}
			
// 			if(preferred_location == "")
// 			{
// 				swal('Error', "Please Enter any Preferred Location", "error");

// 				return false;
// 			}

			var tmpData = new Object();
			tmpData.employee_id = tmpEmployeeId;
			tmpData.outing_option = outing_option;
			tmpData.preferred_location = preferred_location;
			tmpData.preferred_month = preferred_month;
			tmpData.confirmation_status = confirmation_status;
	          
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "save-outing-suggestion.php",
	            "method": "POST",
	            "processData": false,
	            "data": JSON.stringify(tmpData)
	        }
	
	        var tmpResult = new Array();
	
	        $.ajax(settings).done(function (response) {
	           var json = JSON.parse(response);

	           if(json.status == true)
	           {
	        	   getOutingSuggestion();
		           swal('Success', json.message, "success");
	           }
	           else
	           {
		           swal('Error', json.message, "error");
	           }
	        });
		}

		function getOutingSuggestion()
		{
			var tmpData = new Object();
			tmpData.employee_id = tmpEmployeeId;
			  
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "get-outing-suggestion.php",
	            "method": "POST",
	            "processData": false,
	            "data": JSON.stringify(tmpData)
	        }
	
	        var tmpResult = new Array();
	
	        $.ajax(settings).done(function (response) {
	           var json = JSON.parse(response);

	           if(json.status == true)
	           {
	        	   /*$("input[name=outing_option][value=" + json.response.days_option + "]").attr('checked', 'checked');
	        	   
	        	   $('#preferred_location').val(json.response.preferred_location);*/

	        	   if(json.response.confirmation_status && json.response.confirmation_status != "")
	        	   {
	        		   $("input[name=confirmation_status][value=" + json.response.confirmation_status + "]").attr('checked', 'checked');
	        		   disbleButton();
	        	   }
	        	   /*if(json.response.preferred_month && json.response.preferred_month != "")
	        	   {
	        	   	$('#preferred_month').val(json.response.preferred_month);
	        	   }*/

	        	   disableFields();
	        	  
	           }
	        });
		}

		function disableFields()
		{
			$("input[name=outing_option]").attr("disabled", true);
		
     	   $('#preferred_location').attr("disabled", true);
			
     	   $('#preferred_month').attr("disabled", true);
      	   $('.hide-div').hide();
//      	   $('.submit-btn').hide();
//      	   $('.reset-btn').hide();

 			
		}
		
		function disbleButton(){
			$("input[name=confirmation_status]").attr("disabled", true);
			$('.submit-btn').hide();
		  	   $('.reset-btn').hide();
		  	
		}
</script>
    

</body>

</html>
