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

    <title>T-Shirt type | EMS</title>
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
       <?php include 'header.php';?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="header-top employee-list-header">
                    <?php 
                        
                            if($_SESSION['role'] == "admin")
                            {
                         ?>
                                <a href="tshirt-suggestions-admin.php" class="back-arrow"><i class="fa fa-arrow-left"></i></a>
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
                    
                        <div class="col-md-10 outing-suggestion-form">
                        	
                        	<form id="outing_form">
                        	    <div class="row">
                        	    	<div class="col-md-6">
                        	    		<h1 class="t_shirt_header">T-Shirt Type</h1>
                        	    		<div class="form-group t_shirt_size_select">
                        	    			<label>Select Your T-Shirt Size : </label>
                        	    			<select class="form-control" id="preferred_tshirt_size">
                        	    				<option value="">-- Select your suitable size --</option>
                        	    				<option value="small">Small</option>
                        	    				<option value="medium">Medium</option>
                        	    				<option value="large">Large</option>
                        	    				<option value="XL">XL</option>
                        	    				<option value="XXL">XXL</option>
                        	    				
                        	    			</select>
                        	    		</div>
                        	    	</div>
                        	    </div>
                                <input type="button" value="Submit" id="submit" name="submit" class="btn-lg btn btn-success submit-btn" >
                            	<input type="reset" value="Reset" id="reset" name="reset" class="btn-lg btn btn-warning reset-btn" >
                            	
                            	
                        	</form>
                        	
                        </div>
                    
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

   			getTshirtSuggestion();

   			$('.submit-btn').click(function(){
				submitTshirtSuggestion();
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

		function submitTshirtSuggestion()
		{
		
			var preferred_tshirt_size = $('#preferred_tshirt_size').val();

			if(preferred_tshirt_size == ""){
				swal("Error", "Please select any T-shirt size !!!");
			}
			

			var tmpData = new Object();
			tmpData.employee_id = tmpEmployeeId;
			tmpData.preferred_tshirt_size = preferred_tshirt_size;
	          
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "save-tshirt-suggestion.php",
	            "method": "POST",
	            "processData": false,
	            "data": JSON.stringify(tmpData)
	        }
	
	        var tmpResult = new Array();
	
	        $.ajax(settings).done(function (response) {
	           var json = JSON.parse(response);

	           if(json.status == true)
	           {
	        	   //getOutingSuggestion();
		           swal('Success', json.message, "success");
		           disableFields();
	           }
	           else
	           {
		           swal('Error', json.message, "error");
	           }
	        });
		}

		function getTshirtSuggestion()
		{
			var tmpData = new Object();
			tmpData.employee_id = tmpEmployeeId;
			  
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "get-tshirt-suggestion.php",
	            "method": "POST",
	            "processData": false,
	            "data": JSON.stringify(tmpData)
	        }
	
	        var tmpResult = new Array();
	
	        $.ajax(settings).done(function (response) {
	           var json = JSON.parse(response);

	           if(json.status == true)
	           {
	        	  
	        	   if(json.response.preferred_tshirt_size && json.response.preferred_tshirt_size != "")
	        	   {
	        	   	$('#preferred_tshirt_size').val(json.response.preferred_tshirt_size);
	        	   }

	        	   disableFields();
	           }
	        });
		}

		function disableFields()
		{
			
     	   $('#preferred_tshirt_size').attr("disabled", true);

     	   $('.submit-btn').hide();
     	   $('.reset-btn').hide();
		}
</script>
    

</body>

</html>
