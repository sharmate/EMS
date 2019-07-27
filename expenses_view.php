<?php
include('session.php');

require_once './inc/common-functions.php';
?>
<?php 

$quary = "SELECT * FROM `enable_expense_month`";
$result = mysqli_query($db, $quary);
while ($row = mysqli_fetch_assoc($result)) {
    $tmpYear = $row['year'];
    $tmpMonth = $row['month'];
}
?>
<?php 
    
// 	$tmpYear = date("Y");
//     $tmpMonth = date("m");

// 	$tmpYear = "2019";
// 	$tmpMonth = "1";

    if(isset($_GET['month']) && $_GET['month'] != "")
    {
        $tmpMonth = $_GET['month'];
    }
    
    if(isset($_GET['year']) && $_GET['year'] != "")
    {
        $tmpYear = $_GET['year'];
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

    <title>Expenses Sheet | EMS</title>
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
    
    <link rel="stylesheet" type="text/css" href="css/main.css" />
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    <script src="js/dropzone.js"></script>
    
    <style type="text/css">
    
    	body {
		    font-family: inherit;
		}
    	
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
		
		.any_other_remark, .client_reimbursement_remark, .dinner_remark, .lunch_remark, .convence_remark, .travel_remark
		{
			display: none;
			color: #006287;
		}
		
		.submit-expense-btn {
		    margin-right: 10px;
		    margin-bottom: 10px;
		}
		
		.submit-btn {
		    float: right;
		    margin-top: 25px;
		    min-width: 200px;
		}
		
		.instructions {
		    float: left;
		}
		
		.expense-dropzone {
/* 		    width: 500px; */
		    height: 200px;
		    float: left;
		    background-color: #eee;
		    border-radius: 10px;
		    border: 2px dashed #ccc;
		    margin-top: 10px;
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
		.tmp_dropzone{
		  width: 100% !important;
		}
    </style>
   
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
                                <a href="expense-view-admin.php" class="back-arrow"><i class="fa fa-arrow-left"></i></a>
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
                <div class="row expense_sheet_div_row1">
                
                	<div class="col-md-6">
                		<div class="form-group">
                        	<select class="form-control months" id="filter_month" readonly>
                        		<option value=''>--- Select Month ---</option>
                                <option value='1' <?php if($tmpMonth == '1'){ echo 'selected'; } ?>>Janaury</option>
                                <option value='2' <?php if($tmpMonth == '2'){ echo 'selected'; } ?>>February</option>
                                <option value='3' <?php if($tmpMonth == '3'){ echo 'selected'; } ?>>March</option>
                                <option value='4' <?php if($tmpMonth == '4'){ echo 'selected'; } ?>>April</option>
                                <option value='5' <?php if($tmpMonth == '5'){ echo 'selected'; } ?>>May</option>
                                <option value='6' <?php if($tmpMonth == '6'){ echo 'selected'; } ?>>June</option>
                                <option value='7' <?php if($tmpMonth == '7'){ echo 'selected'; } ?>>July</option>
                                <option value='8' <?php if($tmpMonth == '8'){ echo 'selected'; } ?>>August</option>
                                <option value='9' <?php if($tmpMonth == '9'){ echo 'selected'; } ?>>September</option>
                                <option value='10' <?php if($tmpMonth == '10'){ echo 'selected'; } ?>>October</option>
                                <option value='11' <?php if($tmpMonth == '11'){ echo 'selected'; } ?>>November</option>
                                <option value='12' <?php if($tmpMonth == '12'){ echo 'selected'; } ?>>December</option>
                        	</select>
                        </div>
                	</div>
                	<div class="col-md-6">
                		<div class="form-group">
                        	<select class="form-control years" id="filter_year" readonly>
                        		<option>--- Select year ---</option>
                        		<?php 
                        		  for($i = 2010; $i<2050; $i++)
                        		  {
                        		?>
                        		<option value="<?php echo $i; ?>" <?php if($tmpYear == $i){ echo 'selected'; } ?>><?php echo $i; ?></option>
                        		<?php  
                        		  }
                        		?>
                        	</select>
                        </div>
                	</div>
                	<div class="col-md-2 hidden">
                		<button onclick="viewAttendance()" class="btn btn-success filter-btn" style="cursor: pointer;"><i class="fa fa-filter"></i>&nbsp;&nbsp;Filter</button>
                	</div>
                	
                	
                </div>
                
                
                <div class="conatiner">

                    <div class="row expense_sheet_div_row2">
                    
                    	<div class="instructions">
                    		<ol>
                    			<li>
                    				Please ensure all the expenses, claimed are genuine.
                    			</li>
                    			<li>
                    				Please ensure all the expenses, claimed are as per Company Policy .
                    			</li>
                    			<li>
                    				Please ensure no one else, other than you has claimed the same expenditure, being claimed by you.
                    			</li>
                    			<li>
                    				Please ensure you have not already claimed the same expenditure from the client.
                    			</li>
                    		</ol>
                    	</div>
                    
                    	<div class="col-md-10 add-table">
                        	
                        	<input type="button" value="Reset" id="reset" name="reset" class="btn-lg btn btn-warning reset-btn expense_sheet_resetbtn" >
                        	<input type="button" value="Save & Submit" id="submit" name="submit" class="btn-lg btn btn-success submit-btn save-expense-btn expense_sheet_Savebtn" >
                        	<input type="button" value="Save" id="save" name="save" class="btn-lg btn btn-success submit-btn submit-expense-btn expense_sheet_Savebtn" >
                        	
                        	<table border="1" style="margin-top: 10px;">
                               <thead  class="thead-div">
                                   <tr>
                                        <th style="padding: 0 15px;">DATE</th>
                                        <th>DAY</th>
                                        <th>CONVEYANCE Exp</th>
                                        <th>MOBILE Exp </th>
                                        <th>LUNCH Exp </th>
                                        <th>DINNER Exp </th>
                                        <th>TRAVEL Exp </th>
                                        <th>CLIENT RE-EMBASEMENT Exp </th>
                                        <th>ANY OTHER Exp </th>
                                        <th style="padding: 0 15px;">Supporting Attached</th>
                                        <th style="padding: 0 15px;">Total</th>
                                    </tr>
                                    <tr class="total">
	                                  	<td colspan="2">Total</td>	                                  
	                                  	<td><span class="total_convence_exp">0</span></td>
                                        <td><span class="total_mobile_exp">0</span></td>
                                        <td><span class="total_lunch_exp">0</span></td>
                                        <td><span class="total_dinner_exp">0</span></td>
                                        <td><span class="total_travel_exp">0</span></td>
                                        <td><span class="total_client_reimbursement_exp">0</span></td>
	                                  	<td><span class="total_any_other_exp">0</span></td>
	                                  	<td></td> 
	                                  	<td><span class="total_expense">0</span></td>                	
	                               </tr>
                               </thead>
                                
                               <tbody>
                                <?php                                
                                    
                                    $arrayDays = json_decode(getDays($tmpYear, $tmpMonth));
                                    
                                    $tmpHolidayDates = array();
                                    $tmpHolidays = array();
                                
                                    foreach ($arrayDays as $value)
                                    {
                                       // print_r($value->);                                        
                                       // exit();
                                        
                                        $tmpDay = $value->day;
                                        $temDay = '';
                                        
                                        if(strtolower($tmpDay) == "sunday" )
                                        {
                                            array_push($tmpHolidayDates, $value->date);
                                            
                                            $tmpHoliday = array();
                                            $tmpHoliday['date'] = $value->date;
                                            $tmpHoliday['holiday_name'] = $value->day;
                                            
                                            array_push($tmpHolidays, $tmpHoliday);
                                        }
                                    }
                            
                                    
                                    array_push($tmpHolidayDates, "26");
                                    $tmpHoliday = array();
                                    $tmpHoliday['date'] = "26";
                                    $tmpHoliday['holiday_name'] = "Republic Day";
                                    array_push($tmpHolidays, $tmpHoliday);
                                    
                        //         array_push($tmpHolidayDates, "26");
                        //         $tmpHoliday = array();
                        //         $tmpHoliday['date'] = "26";
                        //         $tmpHoliday['holiday_name'] = "Other Holidays";
                        //         array_push($tmpHolidays, $tmpHoliday);
                            
                                    $totalWorkingDays = 0;
                                
                                     foreach ($arrayDays as $value) 
                                     {
                                         $tmpDay = $value->day;
                                         
                                         if(in_array($value->date, $tmpHolidayDates))
                                         {
                                         	$tmpClass = "holiday holiday-".$value->date;
                                         	$tmpHolidayIndex = 'holiday_index="'.$value->date.'"';
                                         }
                                         else {
                                             $tmpClass = "";
                                             $tmpHolidayIndex = "";
                                         }
                                         
                                         $tmpDate = $value->date;
                                  ?>
                                   <tr class="<?php echo $tmpClass; ?> working-day wd-<?php echo $tmpDate; ?>">
                            
                                        <td><?php print_r($value->date); ?></td>
                                        <td style="padding: 0 15px; text-align: left;"><?php print_r($value->day); ?></td>
                                        <td>
                                            <label class="act-label" for="convence_exp-<?php print_r($value->date); ?>">
                                                <input type="text" <?php echo $tmpHolidayIndex; ?> name="convence_exp" class="<?php echo $tmpClass; ?> convence_exp" id="convence_exp-<?php print_r($value->date); ?>" 
                                                 value="">
                                                <input type="text" name="convence_remark" class="convence_remark" 
                                                 	id="convence_remark-<?php print_r($value->date); ?>" placeholder="Remarks" value="">
                                            </label>
                                        </td>
                                        <td>
                                            <label class="act-label" for="mobile_exp-<?php print_r($value->date); ?>">
                                                <input type="text" <?php echo $tmpHolidayIndex; ?> name="mobile_exp" class="<?php echo $tmpClass; ?> mobile_exp" id="mobile_exp-<?php print_r($value->date); ?>" 
                                                 value="">
                                            </label>
                                        </td>
                                        <td>
                                            <label class="act-label" for="lunch_exp-<?php print_r($value->date); ?>">
                                                <input type="text" <?php echo $tmpHolidayIndex; ?> name="lunch_exp" class="<?php echo $tmpClass; ?> lunch_exp" id="lunch_exp-<?php print_r($value->date); ?>" 
                                                 value="">
                                                 
                                                 <input type="number" min="1" name="lunch_remark" class="lunch_remark" 
                                                 	id="lunch_remark-<?php print_r($value->date); ?>" placeholder="No of Persons" value="">
                                            </label>
                                        </td>
                                        <td>
                                            <label class="act-label" for="dinner_exp-<?php print_r($value->date); ?>">
                                                <input type="text" <?php echo $tmpHolidayIndex; ?> name="dinner_exp" class="<?php echo $tmpClass; ?> dinner_exp" id="dinner_exp-<?php print_r($value->date); ?>" 
                                                 value="">
                                                 
                                                 <input type="number" min="1" name="dinner_remark" class="dinner_remark" 
                                                 	id="dinner_remark-<?php print_r($value->date); ?>" placeholder="No of Persons" value="">
                                            </label>
                                        </td>
                                        <td>
                                            <label class="act-label" for="travel_exp-<?php print_r($value->date); ?>">
                                                <input type="text" <?php echo $tmpHolidayIndex; ?> name="travel_exp" class="<?php echo $tmpClass; ?> travel_exp" id="travel_exp-<?php print_r($value->date); ?>" 
                                                 value="">
                                                <input type="text" name="travel_remark" class="travel_remark" 
                                                 	id="travel_remark-<?php print_r($value->date); ?>" placeholder="Remarks" value="">
                                            </label>
                                        </td>
                                        <td>
                                            <label class="act-label" for="client_reimbursement_exp-<?php print_r($value->date); ?>">
                                                <input type="text" <?php echo $tmpHolidayIndex; ?> name="client_reimbursement_exp" class="<?php echo $tmpClass; ?> client_reimbursement_exp" id="client_reimbursement_exp-<?php print_r($value->date); ?>" 
                                                 value="">
                                                 
                                                 <input type="text" name="client_reimbursement_remark" class="client_reimbursement_remark" 
                                                 	id="client_reimbursement_remark-<?php print_r($value->date); ?>" placeholder="Enter Remark" value="">
                                            </label>
                                        </td>
                                        <td>
                                            <label class="act-label" <?php echo $tmpHolidayIndex; ?> for="any_other_exp-<?php print_r($value->date); ?>">
                                                <input type="text" name="any_other_exp" class="<?php echo $tmpClass; ?> any_other_exp" id="any_other_exp-<?php print_r($value->date); ?>" 
                                                 value="">
                                                 
                                                 <input type="text" name="any_other_remark" class="any_other_remark" 
                                                 	id="any_other_remark-<?php print_r($value->date); ?>" placeholder="Enter Remark" value="">
                                            </label>
                                        </td>
                                        <td>
                                            <label class="act-label" <?php echo $tmpHolidayIndex; ?> for="supporting_attached-<?php print_r($value->date); ?>">
                                                <input type="checkbox" name="supporting_attached" class="<?php echo $tmpClass; ?> supporting_attached" id="supporting_attached-<?php print_r($value->date); ?>" 
                                                 value="">
                                            </label>
                                        </td>
                                        <td>
                                            <label class="act-label" id="total_day_expense-<?php print_r($value->date); ?>"></label>
                                        </td>
                                    </tr>
                               
                                     
                                  <?php 
                            
                              }
                              ?>
                                  <tr class="total">
                                  	<td colspan="2">Total</td>                                  
                                  	<td><span class="total_convence_exp">0</span></td>
                                   	<td><span class="total_mobile_exp">0</span></td>
                                    <td><span class="total_lunch_exp">0</span></td>
                                    <td><span class="total_dinner_exp">0</span></td>
                                    <td><span class="total_travel_exp">0</span></td>
                                    <td><span class="total_client_reimbursement_exp">0</span></td>
	                                <td><span class="total_any_other_exp">0</span></td>
	                                <td></td>
	                                <td><span class="total_expense">0</span></td>	
                                  </tr>
                               </tbody>
                               
                            </table>
                            
                            <div style="height: 10px;"></div>
                            
                            <div class="col-md-12">
	                            <div class="row">

	                            	<div class="col-md-6 dropzone-container">
		                            	<div class="panel panel-info pull-left" style="width: 100%; max-height: 50%;">
								            <div class="panel-heading">Upload Files</div>
								            <div class="panel-body">
								                <div class="dropzone tmp_dropzone" data-url="expanses_file_upload.php"></div>
								            </div>
								        </div>

							        </div>
							        
							        <div class="col-md-6">
		                            	<label style="margin-bottom: 10px">Uploaded Files :</label>
		                            	<input type="hidden" class="uploadedfiles">
		                            	<div class="row dropzoneuploadedfiles">
											
		                            	</div>
		                            	
		                            	<input type="button" value="Reset" id="reset" name="reset" class="btn-lg btn btn-warning reset-btn expense_sheet_resetbtn" >
			                        	<input type="button" value="Save & Submit" id="submit" name="submit" class="btn-lg btn btn-success submit-btn save-expense-btn expense_sheet_Savebtn" >
			                        	<input type="button" value="Save" id="save" name="save" class="btn-lg btn btn-success submit-btn submit-expense-btn expense_sheet_Savebtn" >
			                        	
		                            </div>
	                            
                            </div>

                        </div>
                        
                    </div>
                </div>
              </div>
            </div>
         
        </div>
    <!-- /#wrapper -->

	<!-- Footer -->
	<section class="footer-div">
    	<div class="container footer_expense">
    		<div class="row">
    			 <p class="text-center footer-copyright">&copy; Copyright <?php echo date("Y");?> All rights reserved to TYASuite Software Solutions Pvt. Ltd.</p>
    		</div>
    	</div>
    </section> 
<!-- Footer -->
	
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
    <script type="text/javascript" src="js/dropzone.js"></script>
<!--     <script type="text/javascript" src="js/main.js"></script> -->
    
    <script type='text/javascript'>
    // Present Start
    
	    var totalWorkingDays = <?php echo $totalWorkingDays; ?>;
	    // var totalconvence_exp = "convence_exp-"+<?php print_r($value->date); ?>;
	    var tmpUser = new Object();
    
     	$(document).ready(function(){

        	//console.log("Total Working Days: "+totalWorkingDays);
        	//var myDropzone = new Dropzone("#expense-dropzone", { url: "upload-file.php"});
	
	   		getEmployeeDetails();

	   		getEmployeeExpense();
	
	      	$('.submit-expense-btn').click(function(){
	    	  submitExpense();
	  		});

	  		$('.save-expense-btn').click(function(){
	    	  finalSave();
	  		});
	
		  	$('.reset-btn').click(function(){
				resetExpense();
		  	});

		  	$('.client_reimbursement_exp').change(function(){
				var tmpValue = $(this).val();

				var tmpId = $(this).attr("id");
				var tmpIndex = tmpId.split("client_reimbursement_exp-")[1];
				
				if(tmpValue !== "" && parseInt(tmpValue) > 0)
				{
					$('#client_reimbursement_remark-'+tmpIndex).show();
					$('#client_reimbursement_remark-'+tmpIndex).focus();
				}
				else
				{
					$('#client_reimbursement_remark-'+tmpIndex).val('');
					$('#client_reimbursement_remark-'+tmpIndex).hide();
				}
			});

		  	$('.any_other_exp').change(function(){
				var tmpValue = $(this).val();

				var tmpId = $(this).attr("id");
				var tmpIndex = tmpId.split("any_other_exp-")[1];
				
				if(tmpValue !== "" && parseInt(tmpValue) > 0)
				{
					$('#any_other_remark-'+tmpIndex).show();
					$('#any_other_remark-'+tmpIndex).focus();
				}
				else
				{
					$('#any_other_remark-'+tmpIndex).val('');
					$('#any_other_remark-'+tmpIndex).hide();
				}
			});

		  	$('.dinner_exp').change(function(){
				var tmpValue = $(this).val();

				var tmpId = $(this).attr("id");
				var tmpIndex = tmpId.split("dinner_exp-")[1];
				
				if(tmpValue !== "" && parseInt(tmpValue) > 0)
				{
					$('#dinner_remark-'+tmpIndex).show();
					$('#dinner_remark-'+tmpIndex).focus();
				}
				else
				{
					$('#dinner_remark-'+tmpIndex).val('');
					$('#dinner_remark-'+tmpIndex).hide();
				}
			});

		  	$('.lunch_exp').change(function(){
				var tmpValue = $(this).val();

				var tmpId = $(this).attr("id");
				var tmpIndex = tmpId.split("lunch_exp-")[1];
				
				if(tmpValue !== "" && parseInt(tmpValue) > 0)
				{
					$('#lunch_remark-'+tmpIndex).show();
					$('#lunch_remark-'+tmpIndex).focus();
				}
				else
				{
					$('#lunch_remark-'+tmpIndex).val('');
					$('#lunch_remark-'+tmpIndex).hide();
				}
			});

		  	$('.convence_exp').change(function(){
				var tmpValue = $(this).val();

				var tmpId = $(this).attr("id");
				var tmpIndex = tmpId.split("convence_exp-")[1];
				
				if(tmpValue !== "" && parseInt(tmpValue) > 0)
				{
					$('#convence_remark-'+tmpIndex).show();
					$('#convence_remark-'+tmpIndex).focus();
				}
				else
				{
					$('#convence_remark-'+tmpIndex).val('');
					$('#convence_remark-'+tmpIndex).hide();
				}
			});

		  	$('.travel_exp').change(function(){
				var tmpValue = $(this).val();

				var tmpId = $(this).attr("id");
				var tmpIndex = tmpId.split("travel_exp-")[1];
				
				if(tmpValue !== "" && parseInt(tmpValue) > 0)
				{
					$('#travel_remark-'+tmpIndex).show();
					$('#travel_remark-'+tmpIndex).focus();
				}
				else
				{
					$('#travel_remark-'+tmpIndex).val('');
					$('#$tmpLocations-'+tmpIndex).hide();
				}
			});

			$('.convence_exp').change(function(){
				aggregateExpenses();
			});

			$('.mobile_exp').change(function(){
				aggregateExpenses();
			});

			$('.lunch_exp').change(function(){
				aggregateExpenses();
			});

			$('.dinner_exp').change(function(){
				aggregateExpenses();
			});

			$('.travel_exp').change(function(){
				aggregateExpenses();
			});

			$('.client_reimbursement_exp').change(function(){
				aggregateExpenses();
			});

			$('.any_other_exp').change(function(){
				aggregateExpenses();
			});

			$(".dropzone").dropzone({
		        url: 'expanses_file_upload.php',//$(this).attr('data-url')
		        margin: 20,
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
	            	html += 	'<a href="uploads/expanses/'+tmpEmployeeId+'/'+name+'">';

		            html += 	'<i class="fa fa-trash deleteimage" title="delete" aria-hidden="true" data-name="'+name+','+'"></i>';
	            	html += 	'<a href="uploads/expanses/'+tmpEmployeeId+'/'+name+'" target="_blank">';

		            html += 		'<i class="'+iconname+' font50" aria-hidden="true"></i>';
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
	      
	    });  	
	
	    function getEmployeeDetails()
	    {
	    	var tmpEmployeeId = "<?php echo $_SESSION['login_userid']; ?>";
	
			var tmpId = localStorage.getItem('empId');
			
			//console.log(tmpEmployeeId);
			if(tmpId && tmpId !== "")
			{
				tmpEmployeeId = tmpId;
			}
	
			//console.log(tmpId);
			
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

	    function finalSave()
	    {
	    	swal({
	    		  title: "Are you sure?",
	    		  text: "Once submitted, you will not be able to update again!",
	    		  icon: "warning",
	    		  buttons: true,
	    		  dangerMode: false,
	    		})
	    		.then((finalSave) => {
	    		  if (finalSave) {

	    			  	var isHolidayExpense = false;
						var tmpHolidaysIndex = new Array();
	    			  
	    			  $(".holiday").each(function(){
		    			  var tmpValue = $(this).val();

		   			  if(tmpValue !== "" && parseInt(tmpValue) > 0)
		    			  {
			    			  var holidayIndex = $(this).attr("holiday_index");

			    			  if($.inArray( holidayIndex, tmpHolidaysIndex) < 0)
			    			  {
			    				  tmpHolidaysIndex.push(holidayIndex);
			    			  }
		    				  isHolidayExpense = true;
		    			  }
	    			  });

	    			  var totalHolidays = tmpHolidaysIndex.length;

	    			  if(isHolidayExpense == true)
	    			  {
	    				  raiseHolidayDisclaimer(totalHolidays);
	    			  }
	    			  else
	    			  {
	    			  	raiseDisclaimer();
	    			  }
	    		  }
	    		});
	    }

	    function raiseHolidayDisclaimer(totalHolidays = 0)
	    {
	    	swal({
	    		  title: "Disclaimer",
	    		  text: "You are claiming expense for "+totalHolidays+" no of Sundays/Holidays. Please confirm that you have taken approval from senior for working on Sunday/Holiday.",
	    		  icon: "warning",
	    		  dangerMode: false,
	    		  buttons: {
	    			    cancel: "Cancel",
	    			    finalSave: {
	    			      text: "Yes",
	    			      value: "1",
	    			    }
		    		}
	    		})
	    		.then((finalSave) => {
	    		  if (finalSave) {
	    			  raiseDisclaimer();
	    		  }
	    		});
	    }

	    function raiseDisclaimer()
	    {
	    	swal({
	    		  title: "Disclaimer",
	    		  text: "I hereby confirm that all the expenses are genuine, client related or reimbursable as per expense policy of the company. I hereby further confirm that no one else has cliamed the same expediture from the company or I or anyone else has not claimed the same expenditure from the client.",
	    		  icon: "warning",
	    		  dangerMode: false,
	    		  button: "Yes",
	    		})
	    		.then((finalSave) => {
	    		  if (finalSave) {
	    			  submitExpense("1");
	    		  }
	    		});
	    }
	
	    function submitExpense(isFinal = "0")
	    {
		    
	    	var wdc = 0;
	
	  		var wds = new Array();
	
	  		var allEmpty = true;
	
	  		var tmpDays = 0;

	  		var isValidData = true;
	  		
	  		$(".working-day").each(function(){
	  			wdc++;
	            // alert(wdc);
	  			var tmpExpensesStatus = getDayExpense(wdc);

	  			//console.log(tmpExpensesStatus);

	  			if(tmpExpensesStatus == false)
	  			{
	  				isValidData = false;
	  				return;
	  			}
	            
	  			wds.push(tmpExpensesStatus);
	
	  			if(!$('.convence_exp-'+wdc).hasClass("holiday"))
	  			{
	  				tmpDays++;
	  			}
	       	});

	       	if(isValidData == false)
	       	{
		       	return false;
	       	}

	  		//console.log(wds);
	
	          var tmpMonth = "<?php echo $tmpMonth; ?>";
	          var tmpYear = "<?php echo $tmpYear; ?>";
	          var userid = "<?php echo $_SESSION['login_userid']; ?>";
	
	          var monthNames = ["January", "February", "March", "April", "May", "June",
	        	  "July", "August", "September", "October", "November", "December"
	        	];
	
	          var tmpMonthName = monthNames[tmpMonth-1];
	
	          var tmpEmployeeId = localStorage.getItem('empId');
	
	          if(tmpEmployeeId && tmpEmployeeId !== "")
	          {
	          userid = tmpEmployeeId;
	          }

	          var filename = '';   
	          if($('.uploadedfiles').val()!='') {
	        	  filename = $('.uploadedfiles').val();
	          }      
	          
	          var tmpData = new Object();
	          tmpData.userid = userid;
	          tmpData.month = tmpMonth;
	          tmpData.year = tmpYear;
	          tmpData.expenses = wds;
	          tmpData.is_final = isFinal;
	          tmpData.filename = filename;
				
	          var settings = {
	  		  "async": false,
	  		  "crossDomain": true,
	  		  "url": "calenderExpenses.php",
	  		  "method": "POST",
	  		  "headers": {
	  		    "Content-Type": "application/json",
	  		    "Cache-Control": "no-cache"
	  		  },
	  		  "processData": false,
	  		  "data": JSON.stringify(tmpData)
	  		}
	
	  		$.ajax(settings).done(function (response) {
	  			 var json = JSON.parse(response);
	
	  		    if(json.status)
	  		    {
	  		      swal('Success', "Expenses updated Successfully", "success");

		  		    if(isFinal == "1")
	            	{
	            		disableFields();
	            	}
	  		    }
	  		    else
	  		    {
	  		  		swal('Error', "Expenses updated Successfully", "error");
	  		    }
	
	  		});
	    }

	    function getDayExpense(tmpIndex)
	    {
			var tmpConvenceExp = $('#convence_exp-'+tmpIndex).val();
			var tmpConvenceRemark = $('#convence_remark-'+tmpIndex).val();
			var tmpMobileExp = $('#mobile_exp-'+tmpIndex).val();
			var tmpLunchExp = $('#lunch_exp-'+tmpIndex).val();
			var tmpLunchRemark = $('#lunch_remark-'+tmpIndex).val();
			var tmpDinnerExp = $('#dinner_exp-'+tmpIndex).val();
			var tmpDinnerRemark = $('#dinner_remark-'+tmpIndex).val();
			var tmpTravelExp = $('#travel_exp-'+tmpIndex).val();
			var tmpTravelRemark = $('#travel_remark-'+tmpIndex).val();
			var tmpClientReimbursementExp = $('#client_reimbursement_exp-'+tmpIndex).val();
			var tmpClientReimbursementRemark = $('#client_reimbursement_remark-'+tmpIndex).val();
			var tmpAnyOtherExp = $('#any_other_exp-'+tmpIndex).val();
			var tmpAnyOtherRemark = $('#any_other_remark-'+tmpIndex).val();
			var tmpSupportingAttached = "0";

			if($('#supporting_attached-'+tmpIndex).prop('checked'))
			{
				tmpSupportingAttached = "1";
			}

			if(tmpClientReimbursementExp !== "" && parseInt(tmpClientReimbursementExp) > 0 && tmpClientReimbursementRemark === "")
			{
				swal('Error', "Please enter Client Reimbursement Remark for "+tmpIndex+"-<?php echo $tmpMonth."-".$tmpYear; ?>", "error");
				return false;
			}

			if(tmpAnyOtherExp !== "" && parseInt(tmpAnyOtherExp) > 0 && tmpAnyOtherRemark === "")
			{
				swal('Error', "Please enter Any Other Remark for "+tmpIndex+"-<?php echo $tmpMonth."-".$tmpYear; ?>", "error");
				return false;
			}

			if(tmpDinnerExp !== "" && parseInt(tmpDinnerExp) > 0 && tmpDinnerRemark === "")
			{
				swal('Error', "Please enter No. of Persons for Dinner on "+tmpIndex+"-<?php echo $tmpMonth."-".$tmpYear; ?>", "error");
				return false;
			}

			if(tmpLunchExp !== "" && parseInt(tmpLunchExp) > 0 && tmpLunchRemark === "")
			{
				swal('Error', "Please enter No. of Persons for Lunch on "+tmpIndex+"-<?php echo $tmpMonth."-".$tmpYear; ?>", "error");
				return false;
			}

			if(tmpConvenceExp !== "" && parseInt(tmpConvenceRemark) > 0 && tmpConvenceRemark === "")
			{
				swal('Error', "Please enter Conveyance Remark "+tmpIndex+"-<?php echo $tmpMonth."-".$tmpYear; ?>", "error");
				return false;
			}

			if(tmpTravelExp !== "" && parseInt(tmpTravelRemark) > 0 && tmpTravelRemark === "")
			{
				swal('Error', "Please enter Travel Expense Remark "+tmpIndex+"-<?php echo $tmpMonth."-".$tmpYear; ?>", "error");
				return false;
			}

		   	var tmpObject = new Object();
		   	tmpObject.date = tmpIndex;
			tmpObject.convence_exp = tmpConvenceExp;
			tmpObject.convence_remark = tmpConvenceRemark;
			tmpObject.mobile_exp = tmpMobileExp;
			tmpObject.lunch_exp = tmpLunchExp;
			tmpObject.lunch_remark = tmpLunchRemark;
			tmpObject.dinner_exp = tmpDinnerExp;
			tmpObject.dinner_remark = tmpDinnerRemark;
			tmpObject.travel_exp = tmpTravelExp;
			tmpObject.travel_remark = tmpTravelRemark;
			tmpObject.client_reimbursement_exp = tmpClientReimbursementExp;
			tmpObject.client_reimbursement_remark = tmpClientReimbursementRemark;
			tmpObject.any_other_exp = tmpAnyOtherExp;
			tmpObject.any_other_remark = tmpAnyOtherRemark;
			tmpObject.supporting_attached = tmpSupportingAttached;

			return tmpObject;
	    }

	    function getEmployeeExpense()
	    {
		    //console.log(tmpUser);

		    var tmpMonth = "<?php echo $tmpMonth; ?>";
	        var tmpYear = "<?php echo $tmpYear; ?>";

		    var tmpData = new Object();
			tmpData.userid = tmpUser.employee_id;
			tmpData.month = tmpMonth;
			tmpData.year = tmpYear;
	          
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "get-employee-expenses.php",
	            "method": "POST",
	            "headers": {
	              "Content-Type": "application/json",
	              "Cache-Control": "no-cache"
	            },
	            "processData": false,
	            "data": JSON.stringify(tmpData)
	        }
	
	        var tmpExpenses = new Array();
	
	        $.ajax(settings).done(function (response) {
		      // console.log(response);
	            var json = JSON.parse(response);

				//console.log(json);
	            if(json.status == true)
	            {
	            	tmpExpenses = JSON.parse(json.response.expenses);
	            	var files = [];
	            	var name = '';
	            	var html = '';
	            	var filename = '';
	            	if(json.response.files != "" && json.response.files != null) 
	            	{
						//console.log(json.response.files);
	            		files = json.response.files.split(',');
		            	for(var i=0; i<files.length;i++) {
		            		name = files[i];
		            		filename += name+',';
		            	    var iconname = getIconName(name);
		            		html += '<div class="col-md-2">';
		            		html += 	'<i class="fa fa-trash deleteimage" title="delete" aria-hidden="true" data-name="'+name+','+'"></i>';
		            		html += 	'<a href="uploads/expanses/'+tmpUser.employee_id+'/'+name+'" target="_blank">';
		            		html += 		'<i class="'+iconname+' font50" aria-hidden="true"></i>';
		            		html += 		'<br><p>View</p>';
		            		html += 	'</a>';
		            		html += '</div>';
		            	}
		            	$('.uploadedfiles').val(filename);
		            	$('.dropzoneuploadedfiles').append(html);
	            	}

	            	//disableFields();
	            	
	            	if(json.response.is_final == "1")
	            	{
	            		disableFields();
	            	}
	            }
	            
	        });
// 	        console.log('test');
       // console.log(tmpExpenses);

	        for(var i=0; i<tmpExpenses.length; i++)
	        {
		        var tmpExpense = tmpExpenses[i];
		        //console.log(tmpExpense);
				$('#convence_exp-'+tmpExpense.date).val(tmpExpense.convence_exp);
				$('#convence_remark-'+tmpExpense.date).val(tmpExpense.convence_remark);
				$('#mobile_exp-'+tmpExpense.date).val(tmpExpense.mobile_exp);
				$('#lunch_exp-'+tmpExpense.date).val(tmpExpense.lunch_exp);
				$('#lunch_remark-'+tmpExpense.date).val(tmpExpense.lunch_remark);
				$('#dinner_exp-'+tmpExpense.date).val(tmpExpense.dinner_exp);
				$('#dinner_remark-'+tmpExpense.date).val(tmpExpense.dinner_remark);
				$('#travel_exp-'+tmpExpense.date).val(tmpExpense.travel_exp);
				$('#travel_remark-'+tmpExpense.date).val(tmpExpense.travel_remark);
				$('#client_reimbursement_exp-'+tmpExpense.date).val(tmpExpense.client_reimbursement_exp);
				$('#client_reimbursement_remark-'+tmpExpense.date).val(tmpExpense.client_reimbursement_remark);
				$('#any_other_exp-'+tmpExpense.date).val(tmpExpense.any_other_exp);
				$('#any_other_remark-'+tmpExpense.date).val(tmpExpense.any_other_remark);

				if(tmpExpense.supporting_attached == "1")
				{
					$('#supporting_attached-'+tmpExpense.date).prop('checked', true);
				}

				if(tmpExpense.client_reimbursement_remark !== "")
				{
					$('#client_reimbursement_remark-'+tmpExpense.date).show();
				}

				if(tmpExpense.any_other_remark !== "")
				{
					$('#any_other_remark-'+tmpExpense.date).show();
				}

				if(tmpExpense.dinner_remark !== "")
				{
					$('#dinner_remark-'+tmpExpense.date).show();
				}

				if(tmpExpense.lunch_remark !== "")
				{
					$('#lunch_remark-'+tmpExpense.date).show();
				}

				if(tmpExpense.convence_remark !== "")
				{
					$('#convence_remark-'+tmpExpense.date).show();
				}

				if(tmpExpense.travel_remark !== "")
				{
					$('#travel_remark-'+tmpExpense.date).show();
				}
	        }
			
	        aggregateExpenses();
	    }

	    function aggregateExpenses()
	    {
	    	var wdc = 0;
	    	var convence_exp = 0;
			var mobile_exp = 0;
			var lunch_exp = 0;
			var dinner_exp = 0;
			var travel_exp = 0;
			var client_reimbursement_exp = 0;
			var any_other_exp = 0;
	    	
	    	$(".working-day").each(function(){

	    		var totalDayExpense = 0;
	    		
	    		wdc++;
	    		var tmp_convence_exp = $('#convence_exp-'+wdc).val();
	    		var tmp_mobile_exp = $('#mobile_exp-'+wdc).val();
	    		var tmp_lunch_exp = $('#lunch_exp-'+wdc).val();
	    		var tmp_dinner_exp = $('#dinner_exp-'+wdc).val();
	    		var tmp_travel_exp = $('#travel_exp-'+wdc).val();
	    		var tmp_client_reimbursement_exp = $('#client_reimbursement_exp-'+wdc).val();
	    		var tmp_any_other_exp = $('#any_other_exp-'+wdc).val();

	    		if(tmp_convence_exp !== "" && parseInt(tmp_convence_exp) > 0)
	    		{
	    			totalDayExpense += parseInt(tmp_convence_exp);
	    			convence_exp += parseInt(tmp_convence_exp);
	    		}

	    		if(tmp_mobile_exp !== "" && parseInt(tmp_mobile_exp) > 0)
	    		{
	    			totalDayExpense += parseInt(tmp_mobile_exp);
	    			mobile_exp += parseInt(tmp_mobile_exp);
	    		}

	    		if(tmp_lunch_exp !== "" && parseInt(tmp_lunch_exp) > 0)
	    		{
	    			totalDayExpense += parseInt(tmp_lunch_exp);
	    			lunch_exp += parseInt(tmp_lunch_exp);
	    		}

	    		if(tmp_dinner_exp !== "" && parseInt(tmp_dinner_exp) > 0)
	    		{
	    			totalDayExpense += parseInt(tmp_dinner_exp);
	    			dinner_exp += parseInt(tmp_dinner_exp);
	    		}

	    		if(tmp_travel_exp !== "" && parseInt(tmp_travel_exp) > 0)
	    		{
	    			totalDayExpense += parseInt(tmp_travel_exp);
	    			travel_exp += parseInt(tmp_travel_exp);
	    		}

	    		if(tmp_client_reimbursement_exp !== "" && parseInt(tmp_client_reimbursement_exp) > 0)
	    		{
	    			totalDayExpense += parseInt(tmp_client_reimbursement_exp);
	    			client_reimbursement_exp += parseInt(tmp_client_reimbursement_exp);
	    		}

	    		if(tmp_any_other_exp !== "" && parseInt(tmp_any_other_exp) > 0)
	    		{
	    			totalDayExpense += parseInt(tmp_any_other_exp);
	    			any_other_exp += parseInt(tmp_any_other_exp);
	    		}

	    		$('#total_day_expense-'+wdc).html(totalDayExpense);
									    	
	    	});

	    	//console.log(convence_exp);

	    	$('.total_convence_exp').html(convence_exp);
	    	$('.total_mobile_exp').html(mobile_exp);
	    	$('.total_lunch_exp').html(lunch_exp);
	    	$('.total_dinner_exp').html(dinner_exp);
	    	$('.total_travel_exp').html(travel_exp);
	    	$('.total_client_reimbursement_exp').html(client_reimbursement_exp);
	    	$('.total_any_other_exp').html(any_other_exp);

	    	var totalExpense = convence_exp+mobile_exp+lunch_exp+dinner_exp+travel_exp+client_reimbursement_exp+any_other_exp;

	    	$('.total_expense').html(totalExpense);
	    }

	    function disableFields()
	    {
		    console.log("Test");
		    
	    	$('.convence_exp').attr("disabled", true);
	    	$('.convence_remark').attr("disabled", true);
	    	$('.mobile_exp').attr("disabled", true);
	    	$('.lunch_exp').attr("disabled", true);
	    	$('.lunch_remark').attr("disabled", true);
	    	$('.dinner_exp').attr("disabled", true);
	    	$('.dinner_remark').attr("disabled", true);
	    	$('.travel_exp').attr("disabled", true);
	    	$('.travel_remark').attr("disabled", true);
	    	$('.client_reimbursement_exp').attr("disabled", true);
	    	$('.client_reimbursement_remark').attr("disabled", true);
	    	$('.any_other_exp').attr("disabled", true);
	    	$('.any_other_remark').attr("disabled", true);
	    	$('.supporting_attached').attr("disabled", true);

	    	$('.submit-expense-btn').hide();
	    	$('.save-expense-btn').hide();
	    	$('.reset-btn').hide();

	    	$('.deleteimage').hide();
	    	$('.dropzone-container').hide();
	    }

	    function resetExpense()
	    {
	    	swal({
	    		  title: "Are you sure?",
	    		  text: "Once deleted, you will not be able to recover the data again!",
	    		  icon: "warning",
	    		  buttons: true,
	    		  dangerMode: true,
	    		})
	    		.then((finalSave) => {
	    		  if (finalSave) {
	    			  	$('.convence_exp').val('');
	    			  	$('.convence_remark').val('');
	    		    	$('.mobile_exp').val('');
	    		    	$('.lunch_exp').val('');
	    		    	$('.lunch_remark').val('');
	    		    	$('.dinner_exp').val('');
	    		    	$('.dinner_remark').val('');
	    		    	$('.travel_exp').val('');
	    		    	$('.travel_remark').val('');
	    		    	$('.client_reimbursement_exp').val('');
	    		    	$('.client_reimbursement_remark').val('');
	    		    	$('.any_other_exp').val('');
	    		    	$('.any_other_remark').val('');
	    		    	$('.supporting_attached').prop('checked', false);

	    		    	aggregateExpenses();
	    		  }
	    		});
	    }

	    function getIconName(name)
	    {
	    	var extension = name.substr( (name.lastIndexOf('.') +1) ).toLowerCase();;
    		var iconname = '';
    	    switch(extension) {
    	        case 'jpg':
    	        	iconname = 'fa fa-file-image-o';
    	        	break;

    	        case 'jpeg':
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
