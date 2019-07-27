<?php
	include ('session.php');
	require_once './inc/common-functions.php';
	
	//Serial Number
	$cmd1 = 'wmic bios get serialnumber';
	$tmpData = shell_exec($cmd1);
	$tmpSerialNo = explode("SerialNumber ", $tmpData)[1];
	$tmpSerialNo = trim($tmpSerialNo);
	
	//Model Name
	$cmd2 = 'wmic csproduct get name';
	$tmpData = shell_exec($cmd2);
	$tmpModelNo = explode("Name ", $tmpData)[1];
	$tmpModelNo = trim($tmpModelNo);
	
	//Vendor Name
	$cmd3 = 'wmic csproduct get vendor';
	$tmpData = shell_exec($cmd3);
	$tmpVendorName = explode("Vendor ", $tmpData)[1];
	$tmpVendorName = trim($tmpVendorName);
	
	//Ram Information
	$cmd4 = 'systeminfo | findstr /C:"Total"';
	$tmpData = shell_exec($cmd4);
	$tmpRamInfo = explode("Total Physical Memory:  ", $tmpData)[1];
	$tmpRamInfo = trim($tmpRamInfo);
	
	//Processor Information
	$cmd5 = 'wmic cpu get name';
	$tmpData = shell_exec($cmd5);
	$tmpProcessor = explode("Intel(R) Core(TM) ", $tmpData)[1];
	$tmpProcessor = trim($tmpProcessor);
	
	//current Date
	$date = date('m/d/Y', time());
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">
	<title>Laptop Verification | EMS</title>
	
	<link rel="icon" href="img/fav3.ico">
	<link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
	<link href="./dist/css/sb-admin-2.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="./vendor/morrisjs/morris.css" rel="stylesheet">
	<link href="./vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
	
	<link href="./css/bootstrap-datepicker.css" rel="stylesheet" type="text/css" />
	
	 <link rel="stylesheet" type="text/css" href="css/main.css" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <style type="text/css">
    
    	.act-label {
		    width: 100%;
		    cursor: pointer;
		    margin-bottom: 0;
		}
		
		.add-table input {
		    border: none;
		    padding: 5px;
		}
		
		.btn-group-lg>.btn, .btn-lg {
		    padding: 10px 16px !important;
		    font-size: 18px;
		    line-height: 1.3333333;
		    border-radius: 6px;
		}
		
		.add-table input {
		    border: none;
		    padding: 5px;
		    border-bottom: 1px solid #ccc;
		    width: 80px;
		}
		
		.add-table th {
		    width: 100px;
		}
		
		
		.instructions {
		    float: left;
		}
		
		.dropzoneuploadedfiles div {
			padding: 5px 5px;
		}
		    
		.dropzoneuploadedfiles p {
			font-size: 14px;
			margin-left: 28%;
			display: none;
		}    
		
		.font50 {
			font-size : 50px;
			margin-left: 20%;
			margin-bottom: 10%;
		}
		.deleteimage {
			font-size: 20px;
			padding: 0px 0px;
			position: absolute;
			right: 18%;
			cursor: pointer;
			bottom: 21%;
		}
		.dropzone{
		    width: 535px !important;
            margin-left: 0px;
            margin-top: 0px;
            height: 140px !important;
		}
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
	                    	<a href="laptop-list-admin.php" class="back-arrow"><i class="fa fa-arrow-left"></i></a>
	                    <?php } else { ?>
	<!--                    <a href="add.php" class="back-arrow"><i class="fa fa-arrow-left"></i></a> -->
	                    <?php } ?>
	                    <i class="fa fa-user"></i> <span class="user-title"></span>
					</h1>
					<hr />
				</div>
				<div class="conatiner">
					<div class="row">
						
						<div class="col-md-12">
							<div class="row main-div laptop_verification_div">
								
									<h2 class="text-center laptop_main_header">Laptop Verification</h2>
									<div class="form-group laptop_radio">
										<label>Laptop Allocated : </label>
										<input type="radio" id="laptop_allowcated" name="laptop_allowcated" value="yes" class="yes_radio">YES
										<input type="radio" id="laptop_allowcated" name="laptop_allowcated" value="no"  class="no_radio">NO
											
									</div>
									<div id="form_data" style="display: none;">
        								<div class="col-md-6">
        									<div class="form-group">
        										<label>Date Of Issue : </label>
        										<input type="date" id="dateOfIssue" name="dateOfIssue" class="form-control" placeholder="Select Date"/>
        										
        									</div>
        									<div class="form-group">
        										<label>Model No : </label>
        										<input type="text" id="model_id" name="model_id" class="form-control"  value="<?php echo $tmpModelNo; ?>"/>
        										
        									</div>
        									
        									
        									<div class="form-group">
        										<label>RAM Information : </label>
        										<input type="text" id="ram_info" name="ram_info" class="form-control"  value="<?php echo $tmpRamInfo; ?>"/>
    
        									</div>
        									<div class="form-group">  										
    											<label>Processor : </label>
    											<input type="text" id="processor" name="processor" class="form-control"  value="<?php echo $tmpProcessor; ?>"/>
    
        									</div>
    
        								</div>
        								<div class="col-md-6">
        									<div class="form-group">
        										<label>Company Model : </label>
        										<input type="text" id="model_company" name="model_company" class="form-control" value="<?php echo $tmpVendorName; ?>"/>
        										
        									</div>
        									<div class="form-group">
        										<label>Serial No : </label>
        										<input type="text" id="serial_no" name="serial_no" class="form-control" value="<?php echo $tmpSerialNo; ?>"/>
        											
        									</div>
        									<div class="form-group">
        										<label>Hard Drive : </label>
        										<input type="text" id="hard_drive" name="hard_drive" class="form-control" placeholder="For eg. 100GB"/>
        											
        									</div>
        									<div class="form-group">
        										<label>Condition : </label>
        										<select class="form-control" id="condition"> 
        											<option value="">-- Select condition --</option>
        											<option value="perfectly Working">Perfectly Working</option>
        											<option value="Working with issue">Working with issue</option>
        											<option>Not Working</option>
        										</select>	
        									</div>
        									<div class="form-group">
        										<input type="text" id="issue_text" name="issue_text" class="form-control" placeholder="Enter Your Issue" style="display:none;">
        										
        									</div>
        								</div>
        								<div class="col-md-12">
            	                            <div class="row">
                	                            <div class="col-md-6">
                	                            	<div class="panel panel-info pull-right laptop_upload_file">
                							            <div class="panel-heading">Upload Files</div>
                							            <div class="panel-body">
                							                <div class="dropzone" data-url="laptop_file_upload.php"></div>
                							            </div>
                							        </div>
                						        </div>
                	                            <div class="col-md-6 drop_file">
                	                            	<label style="margin-bottom: 10px">Uploaded Files :</label>
                	                            	<input type="hidden" class="uploadedfiles">
                	                            	<div class="dropzoneuploadedfiles">
                
                	                            	</div>
                	                            	
                	                            </div>
            							    </div>    
                           				</div>	
    								</div>
    								
    								<div>
                            			<input type="button" value="Reset" id="reset" name="reset" class=" btn btn-lg btn-warning reset-btn reset_btn_laptop">
										<input type="button" value="Save & Submit" id="submit" name="submit" class=" btn btn-lg btn-success submit-btn submit-attendance-btn submit_btn_laptop">
	                            	</div>
								</div>
								
							</div>
							
								
									
							
							
						</div>
						
					</div>
				
			</div>
		</div>
	</div>
	
	<!-- Footer -->
	<section class="footer-div">
    	<div class="container footer_laptop_verification">
    		<div class="row">
    			 <p class="text-center footer-copyright">&copy; Copyright <?php echo date("Y");?> All rights reserved to TYASuite Software Solutions Pvt. Ltd.</p>
    		</div>
    	</div>
    </section> 
<!-- Footer -->
	
	<script src="./vendor/jquery/jquery.min.js"></script>
	<script src="./vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="./vendor/metisMenu/metisMenu.min.js"></script>
	<script src="./vendor/raphael/raphael.min.js"></script>
	<script src="./dist/js/sb-admin-2.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script src="./js/bootstrap-datepicker.js"></script>
	 <script type="text/javascript" src="js/dropzone.js"></script>
	
	
	<script type='text/javascript'>

    	var tmpEmployeeId = "<?php echo $_SESSION['login_userid']; ?>";
    
   		$(document).ready(function(){

   			var tmpId = localStorage.getItem('empId');
	
			if(tmpId && tmpId !== "")
			{
				tmpEmployeeId = tmpId;
			}

   			getEmployeeDetails();

   			getLaptopVerification();

   			$('.submit-btn').click(function(){
   				submitLaptopVerification();
   	   		});

   	   		//upload Laptop file start
   	   		
   			$(".dropzone").dropzone({
		        url: 'laptop_file_upload.php',//$(this).attr('data-url')
		        margin: 20,
		        width: 300,
	            height: 200, 
		        params:{
		            'action': 'save'
		        },
		        success: function(res, index){
		        	var tmpId = localStorage.getItem('empId');
		        	var tmpEmployeeId = "<?php echo $_SESSION['login_userid']; ?>";
					if(tmpId && tmpId !== "")
					{
						tmpEmployeeId = tmpId;
					}
		            var name = res.response.replace("\n", "");
		            var iconname = getIconName(name);
		            var html = '';
		            var filename = '';
		            filename = $('.uploadedfiles').val()+name+',';
		            $('.uploadedfiles').val(filename);
		            html += '<div class="col-md-2">';
		            html += 	'<i class="fa fa-trash deleteimage expense_deleteimage" title="delete" aria-hidden="true" data-name="'+name+','+'"></i>';
	            	html += 	'<a href="uploads/laptop_verification/'+tmpEmployeeId+'/'+name+'" target="_blank">';
		            html += 		'<i class="'+iconname+' font50" aria-hidden="true"></i>';
// 					html += 		'<img src="uploads/laptop_verification/'+tmpEmployeeId+'/'+name+'" alt="image" class="img-responsive"/>';
		            html += 		'<br><p>View</p>';
		            html += 	'</a>';
		            html += '</div>';
		            
		            $('.dropzoneuploadedfiles').append(html);
		        }
		    });

			$(document).on('click','.deleteimage',function(e) {
    		    var filenames = $(".uploadedfiles").val();
    		    var delfilename = $(this).attr('data-name');
    		    if (filenames.indexOf(delfilename) > -1) {
    		    	filenames = filenames.replace(delfilename,"");
    		    }    
    		    $(".uploadedfiles").val(filenames);
    		    $(this).parent().hide();
    	    });
	     
   	   		//upload Laptop file end
   	   		
    	});

		$('.reset-btn').click(function(){

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

		function submitLaptopVerification()
		{

			//console.log("Test");
			var laptop_allowcated = $('input[name=laptop_allowcated]:checked').val();

			var dateOfIssue = "";
			var model_company  = "";
			var model_id  = "";
			var serial_no  = "";
			var condition  = "";
			var issue_text  = "";
			var ram_info  = "";
			var hard_drive = "";
			var processor  = "";

			if(laptop_allowcated === "yes")
			{
    			dateOfIssue = $('#dateOfIssue').val();
    			if(dateOfIssue == ""){
    				swal("Error", "Please insert date of Issue !!!");
    			}
    			model_company  = $('#model_company').val();
    			if(model_company == ""){
    				swal("Error", "Please insert Company Model Name !!!");
    			}
    			model_id  = $('#model_id').val();
    			if(model_id == ""){
    				swal("Error", "Please insert Model Number !!!");
    			}
    			serial_no  = $('#serial_no').val();
    			if(serial_no == ""){
    				swal("Error", "Please insert Serial Number !!!");
    			}
    			condition  = $('#condition').val();
    			if(condition == ""){
    				swal("Error", "Please select condition !!!");
    			}
    			issue_text  = $('#issue_text').val();
    			ram_info  = $('#ram_info').val();
    			if(ram_info == ""){
    				swal("Error", "Please insert RAM information !!!");
    			}
    			hard_drive = $('#hard_drive').val();
    			if(hard_drive == ""){
    				swal("Error", "Please insert Hard Drive !!!");
    			}
    			processor  = $('#processor').val();
    			if(processor == ""){
    				swal("Error", "Please insert Processor Configration !!!");
    			}
    			
    			 var filename = '';   
   	          if($('.uploadedfiles').val()!='') {
   	        	  filename = $('.uploadedfiles').val();
   	          }    

    			
			}

			var tmpData = new Object();
			tmpData.employee_id = tmpEmployeeId;
			tmpData.dateOfIssue = dateOfIssue;
			tmpData.model_company = model_company;
			tmpData.model_id = model_id;
			tmpData.serial_no = serial_no;
			tmpData.condition = condition;
			tmpData.issue_text = issue_text;
			tmpData.ram_info = ram_info;
			tmpData.hard_drive = hard_drive;
			tmpData.processor = processor;
			tmpData.laptop_allowcated = laptop_allowcated;
			 tmpData.filename = filename;

 			console.log(filename);

			//return false;
			
	          
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "save-laptop-verification.php",
	            "method": "POST",
	            "processData": true,
	            "data": JSON.stringify(tmpData)
	        }
	
	       // var tmpResult = new Array();
	
	        $.ajax(settings).done(function (response) {
		        //console.log(response);
	           var json = JSON.parse(response);

	           if(json.status == true)
	           {
	        	   getLaptopVerification();
		           swal('Success', json.message, "success");
		          	disableFields();
	           }
	           else
	           {
		           swal('Error', json.message, "error");
	           }


	        });
		}

		function getLaptopVerification()
		{
			var tmpData = new Object();
			tmpData.employee_id = tmpEmployeeId;
			  
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "get-laptop-verification.php",
	            "method": "POST",
	            "processData": false,
	            "data": JSON.stringify(tmpData)
	        }
	
	       // var tmpResult = new Array();
	
	        $.ajax(settings).done(function (response) {
	           var json = JSON.parse(response);

	           if(json.status == true)
	           {
					console.log(json.response.laptop_file);
	        	 //get Image start
					var laptop_file = [];
	            	var name = '';
	            	var html = '';
	            	var filename = '';
	            	if(json.response.laptop_file != "") 
	            	{
	            		var tmpId = localStorage.getItem('empId');
			        	var tmpEmployeeId = "<?php echo $_SESSION['login_userid']; ?>";
						if(tmpId && tmpId !== "")
						{
							tmpEmployeeId = tmpId;
						}
	      	          
						laptop_file = json.response.laptop_file.split(',');
		            	for(var i=0; i<laptop_file.length;i++) {
		            		name = laptop_file[i];
		            		filename += name+',';
		            	    var iconname = getIconName(name);
		            		html += '<div class="col-md-2">';
		            		html += 	'<i class="fa fa-trash deleteimage" title="delete" aria-hidden="true" data-name="'+name+','+'"></i>';
		            		html += 	'<a href="uploads/laptop_verification/'+tmpEmployeeId+'/'+name+'" target="_blank">';
		            		html += 		'<i class="'+iconname+' font50" aria-hidden="true"></i>';
		            		html += 		'<br><p>View</p>';
		            		html += 	'</a>';
		            		html += '</div>';
		            	}
		            	$('.uploadedfiles').val(filename);
		            	$('.dropzoneuploadedfiles').append(html);
	            	}
					//get image end
	        	   if(json.response.laptop_allowcated && json.response.laptop_allowcated != "")
	        	   {
	        	   	$('#laptop_allowcated').prop('checked', true);
	        	   	$('#form_data').show();
	        	   	
	        	   	
	        	   }
	        	   if(json.response.laptop_allowcated && json.response.laptop_allowcated != "" && json.response.laptop_allowcated == "no")
	        	   {
	        	   	$('#laptop_allowcated').prop('checked', true);
	        	   	$('#form_data').hide();
	        	   	$('.yes_radio').hide();
	        	   	
	        	   }
	        	   
	        	   if(json.response.dateOfIssue && json.response.dateOfIssue != "")
	        	   {
	        	   	$('#dateOfIssue').val(json.response.dateOfIssue);
	        	   }
	        	   if(json.response.model_company && json.response.model_company != "")
	        	   {
	        	   	$('#model_company').val(json.response.model_company);
	        	   }
	        	   if(json.response.model_id && json.response.model_id != "")
	        	   {
	        	   	$('#model_id').val(json.response.model_id);
	        	   }
	        	   if(json.response.serial_no && json.response.serial_no != "")
	        	   {
	        	   	$('#serial_no').val(json.response.serial_no);
	        	   }
	        	   if(json.response.condition && json.response.condition != "")
	        	   {
	        	   	$('#condition').val(json.response.condition);
	        	   }
	        	   if(json.response.issue_text && json.response.issue_text != "")
	        	   {
	        	   	$('#issue_text').val(json.response.issue_text);
	        	   	$('#issue_text').show();
	        	   }
	        	   if(json.response.ram_info && json.response.ram_info != "")
	        	   {
	        	   	$('#ram_info').val(json.response.ram_info);
	        	   }
	        	   if(json.response.hard_drive && json.response.hard_drive != "")
	        	   {
	        	   	$('#hard_drive').val(json.response.hard_drive);
	        	   }
	        	   if(json.response.processor && json.response.processor != "")
	        	   {
	        	   	$('#processor').val(json.response.processor);
	        	   }

					
	        	   disableFields();
	           }
	        });
		}

		function disableFields()
		{
			
     	   $('#dateOfIssue').attr("disabled", true);
     	  $('#model_company').attr("disabled", true);
     	 $('#model_id').attr("disabled", true);
     	$('#serial_no').attr("disabled", true);
     	$('#condition').attr("disabled", true);
     	$('#issue_text').attr("disabled", true);
     	$('#ram_info').attr("disabled", true);
     	$('#hard_drive').attr("disabled", true);
     	$('#processor').attr("disabled", true);
     	
		$('.laptop_upload_file').hide();
     	   $('.submit-btn').hide();
     	   $('.reset-btn').hide();
		}

		$('#condition').change(function(){
			if ( this.value == 'Working with issue')
			  {
			    $("#issue_text").show();
			  }
			  else
			  {
			    $("#issue_text").hide();
			  }
			});
		$('.yes_radio').click(function(){
				show();
				
			});
		$('.no_radio').click(function(){
			hide();
			
		});
		  
		function hide(){
			  document.getElementById('form_data').style.display ='none';
			}
		function show(){
			  document.getElementById('form_data').style.display = 'block';
			}

		function resetForm(){
			$('input[name=dateOfIssue').val('');
			$('input[name=model_company').val('');
			$('input[name=model_id').val('');
			$('input[name=serial_no').val('');
			$('input[name=condition').val('');
			$('input[name=issue_text]').val();
			$('input[name=ram_info]').val();
			$('input[name=processor]').val();
			
		}


// 		$("#serial_no").hover(function(){

// 			$('#serial_no_info').show();
// 		});

		
		$("#processor").hover(function(){

			$('#processor_info').toggle();
		});

		 function getIconName(name)
		    {
		    	var extension = name.substr( (name.lastIndexOf('.') +1) ).toLowerCase();;
	    		var iconname = '';
	    	    switch(extension) {
	    	        case 'jpg':
	    	        	iconname = 'fa fa-file-image-o';
	    	        	break;
	    	        case 'png':
	    	        	iconname = 'fa fa-file-image-o';
	    	        	break;
	    	        case 'gif':
	    	        	iconname = 'fa fa-file-image-o';
	    	        	break;
	    	        case 'txt':
	    	        	iconname = 'fa fa-file-text';
	    	        	break;
	    	        case 'doc':
	    	        	iconname = 'fa fa-file-text';
	    	        	break;
	    	        case 'docx':
	    	        	iconname = 'fa fa-file-text';
	    	        	break;
	    	        case 'xlsx':
	    	        	iconname = 'fa fa-file-excel-o';
	    	        	break;
	    	        case 'xls':
	    	        	iconname = 'fa fa-file-excel-o';
	    	        	break;
	    	        case 'zip':
	    	        	iconname = 'fa fa-file-archive-o';
	    	        	break;
	    	        case 'rar':
	    	        	iconname = 'fa fa-file-archive-o';
	    	        	break;
	    	        case 'pdf':
	    	        	iconname = 'fa fa-file-pdf-o';
	    	        	break;
	    	        default:
	    	        	iconname = 'fa fa-file';
		        		break;
	    	    }
	    	    return iconname;
		    }    

		
</script>
    
</body>
</html>
