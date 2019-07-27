<?php
include('session.php');


require_once './inc/common-functions.php';

?>
<?php 

$quary = "SELECT * FROM `enable_attendance_month`";
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
// 	$tmpYear = "2019";
// 	$tmpMonth = "01";

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

    <title>Attendance Sheet | EMS</title>
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
                                <a href="employeeList.php" class="back-arrow"><i class="fa fa-arrow-left"></i></a>
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
                <div class="row attendance_month_div">
                
                	<div class="col-md-6">
                		<div class="form-group">
                        	<select class="form-control months" id="filter_month" disabled="disabled">
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
                        	<select class="form-control years" id="filter_year" disabled="disabled">
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

                    <div class="row">
                    
                        <div class="col-md-10 add-table">
                        	
                        	<input type="button" value="Reset" id="reset" name="reset" class="btn-lg btn btn-warning reset-btn" >
                        	<input type="button" value="Submit" id="submit" name="submit" class="btn-lg btn btn-success submit-btn submit-attendance-btn submit-attendance-btn-top" >
                        
                            <table border="1">
                               <thead  class="thead-div">
                                   <tr>
                                        <th>DATE</th>
                                        <th>DAY</th>
                                        <th>PRESENT <input type="checkbox" id="present" class="thead-style"></th>
                                        <th>ABSENT <input type="checkbox" id="absent" class="thead-style"></th>
                                        <!-- <th>LEAVE <input type="checkbox" id="leave" class="thead-style"></th>
                                        <th>LOSS OF PAY <input type="checkbox" id="lop" class="thead-style"></th>
                                        <th>Weeked OFF</th> -->
                                    </tr>
                                    <tr class="total">
	                                  	<td colspan="2">Total</td>
	                                  
	                                  	<td>Present = <span id="count-checked-checkboxes-present-top">0</span></td>
	                                  	<td>Absent = <span id="count-checked-checkboxes-absent-top">0</span></td>
	                                  	<!-- <td>Leave = <span id="count-checked-checkboxes-leave">0</span></td>
	                                  	<td>Lop = <span id="count-checked-checkboxes-lop">0</span></td>
	                                  	<td>wo = <span id="count-checked-checkboxes-wo">0</span></td> -->
	                                  	
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
                            
                                    
//                                    array_push($tmpHolidayDates, "26");
//                                     $tmpHoliday = array();
//                                     $tmpHoliday['date'] = "25";
//                                     $tmpHoliday['holiday_name'] = "Republic Day";
//                                     array_push($tmpHolidays, $tmpHoliday);
                                    
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
                                             $tmpClass = "holiday";
                                         }
                                         else {
                                             $tmpClass = "";
                                         }
                                         
                                         $tmpDate = $value->date;
                                  ?>
                                   <tr class="<?php echo $tmpClass; ?> working-day wd-<?php echo $tmpDate; ?>">
                            
                                        <td><?php print_r($value->date); ?></td>
                                        <td><?php print_r($value->day); ?></td>
                                        
                                        <?php 
                                            if(in_array($value->date, $tmpHolidayDates))
                                            {
                                                $tmpIndex = array_search($value->date, $tmpHolidayDates);
                                                $tmpHoliday = $tmpHolidays[$tmpIndex];
                                        ?>
                                        <td>
                                        	<label class="act-label" for="present-<?php print_r($value->date); ?>">
                                        		<input type="checkbox" name="present" id="present-<?php print_r($value->date); ?>" 
                                        		class="holiday count-present actc present present-<?php print_r($value->date); ?> <?php print_r($value->day); ?>" value="present">
                                        	</label>
                                        </td>
                                        <td align = "center">
                                        	<?php echo $tmpHoliday['holiday_name']; ?>
                                        </td>
                                        <?php 
                                            }
                                            else
                                            {
                                            	$totalWorkingDays++;
                                        ?>
                                        <td>
                                        	<label class="act-label" for="present-<?php print_r($value->date); ?>">
                                        		<input type="checkbox" name="present" id="present-<?php print_r($value->date); ?>" 
                                        		class="count-present actc present present-<?php print_r($value->date); ?> <?php print_r($value->day); ?>" value="present">
                                        	</label>
                                        </td>
                                        <td>
                                        	<label class="act-label" for="absent-<?php print_r($value->date); ?>">
                                        		<input type="checkbox" name="absent" id="absent-<?php print_r($value->date); ?>" 
                                        		class="count-absent actc absent absent-<?php print_r($value->date); ?> <?php print_r($value->day); ?>" value="absent">
                                        	</label>	
                                        </td>
                                        
                                        <!-- <td>
                                            <label class="act-label" for="leave-<?php print_r($value->date); ?>">
                                            	<input type="checkbox" name="leave" id="leave-<?php print_r($value->date); ?>" 
                                            	class="count-leave actc leave leave-<?php print_r($value->date); ?> <?php print_r($value->day); ?>" value="leave">
                                            </label>
                                        </td>
                                        <td>
                                        	<label class="act-label" for="lop-<?php print_r($value->date); ?>">
                                            	<input type="checkbox" name="lop" id="lop-<?php print_r($value->date); ?>" 
                                            	class="count-lop actc lop lop-<?php print_r($value->date); ?> <?php print_r($value->day); ?>" value="lop">
                                        	</label>
                                        </td>
                                        <td>
                                            <label class="act-label" for="wo-<?php print_r($value->date); ?>">
                                            	<input type="checkbox" name="wo" id="wo-<?php print_r($value->date); ?>" 
                                            	class="count-wo actc wo wo-<?php print_r($value->date); ?> <?php print_r($value->day); ?>" value="wo">
                                            </label>
                                       	</td> -->
                                       	
                                       	<?php 
                                            }
                                       	?>
                                      
                                    </tr>
                               
                                     
                                  <?php 
                            
                              }?>
                                  <tr class="total">
                                  	<td colspan="2">Total</td>
                                  
                                  	<td>Present = <span id="count-checked-checkboxes-present">0</span></td>
                                  	<td>Absent = <span id="count-checked-checkboxes-absent">0</span></td>
                                  	<!-- <td>Leave = <span id="count-checked-checkboxes-leave">0</span></td>
                                  	<td>Lop = <span id="count-checked-checkboxes-lop">0</span></td>
                                  	<td>wo = <span id="count-checked-checkboxes-wo">0</span></td> -->
                                  	
                                  </tr>
                               </tbody>
                               
                            </table>
                            
                            <input type="button" value="Reset" id="reset" name="reset" class="btn-lg btn btn-warning reset-btn" >
                        	<input type="button" value="Submit" id="submit" name="submit" class="btn-lg btn btn-success submit-btn submit-attendance-btn" >
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
    // Present Start
    
    var totalWorkingDays = <?php echo $totalWorkingDays; ?>;
    var tmpUser = new Object();
    
     $(document).ready(function(){

         console.log("Total Working Days: "+totalWorkingDays);
       // Check or Uncheck All checkboxes
       $("#present").change(function(){
         var checked = $(this).is(':checked');
         if(checked){
           $(".present").each(function(){

   			//console.log($(this).hasClass("holiday"));
        	 if($(this).hasClass("holiday") == false)
        	 {
        		 $(this).prop("checked",true);
                 changeAction($(this));
        	 }
               
             
           });
         }else{
           $(".present").each(function(){
             $(this).prop("checked",false);
             changeAction($(this));
           });
         }
       });

      viewAttendance();

      $('.submit-attendance-btn').click(function(){

          //console.log("Test");

  		var wdc = 0;

  		var wds = new Array();

  		var allEmpty = true;
  		//console.log(allEmpty);

  		var tmpDays = 0;

  		var totalPresent = 0;
  		var totalAbsent = 0;
  		
  		$(".working-day").each(function(){
  			wdc++;

  			var tmpAttendanceStatus = attendanceStatus(wdc);

  			if(tmpAttendanceStatus === "")
			{
				return ;
			}

			if(tmpAttendanceStatus !== "")
			{
				allEmpty = false;
			}

			if(tmpAttendanceStatus == "P")
			{
				totalPresent++;
			}

			if(tmpAttendanceStatus == "A")
			{
				totalAbsent++;
			}
  			
  			var tmpStatus = new Object();
  			tmpStatus.date = wdc;
  			tmpStatus.status = tmpAttendanceStatus;

  			wds.push(tmpStatus);

  			if(!$('.present-'+wdc).hasClass("holiday"))
  			{
  				tmpDays++;
  			}
       	});

          if(tmpDays < totalWorkingDays)
          {
        	  swal('Error', "Please Set Attendance for all working days", "error");
        	  return false;
          }

          if(allEmpty == true)
          {
        	  swal('Error', "Please Set Attendance for at least one day", "error");

        	  return false;
          }

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

          var tmpData = new Object();
          tmpData.userid = userid;
          tmpData.month = tmpMonth;
          tmpData.year = tmpYear;
          tmpData.attendance = wds;

          var settings = {
  		  "async": false,
  		  "crossDomain": true,
  		  "url": "calenderProcess.php",
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
  		      swal('Success', "Attendance updated Successfully", "success");
  		    }
  		    else
  		    {
  		  		swal('Error', "Attendance updated Successfully", "error");
  		    }

	  		  $('.present').attr("disabled", true);
	          $('#present').attr("disabled", true);
	          $('.absent').attr("disabled", true);
	          $('#absent').attr("disabled", true);
	
	          $('.reset-btn').hide();
	          $('.submit-attendance-btn').hide();
          
  		    sendAttendanceMail(tmpUser.name, tmpUser.email, tmpMonthName, tmpYear, totalPresent, totalAbsent);
  		});
  	});

  	$('.reset-btn').click(function(){
		resetAttendance();
  	});
      
    });

     //LEAVE START
     
     $(document).ready(function(){
       // Check or Uncheck All checkboxes
       $("#leave").change(function(){
         var checked = $(this).is(':checked');
         if(checked){
           $(".leave").each(function(){
             $(this).prop("checked",true);
             changeAction($(this));
           });
         }else{
           $(".leave").each(function(){
             $(this).prop("checked",false);
             changeAction($(this));
           });
         }
       });
     
      // Changing state of CheckAll checkbox 
      $(".leave").click(function(){
     
        if($(".leave").length == $(".leave:checked").length) {
          $("#leave").prop("checked", true);
          changeAction($(this));
        } else {
          $("#leave").removeAttr("checked");
          changeAction($(this));
          
        }
    
      });
    });

     //LOP
     
      $(document).ready(function(){
       // Check or Uncheck All checkboxes
       $("#lop").change(function(){
         var checked = $(this).is(':checked');
         if(checked){
           $(".lop").each(function(){
             $(this).prop("checked",true);
             changeAction($(this));
           });
         }else{
           $(".lop").each(function(){
             $(this).prop("checked",false);
             changeAction($(this));
           });
         }
       });
     
      // Changing state of CheckAll checkbox 
      $(".lop").click(function(){
     
        if($(".lop").length == $(".lop:checked").length) {
          $("#lop").prop("checked", true);
          changeAction($(this));
        } else {
          $("#lop").removeAttr("checked");
          changeAction($(this));
          
        }
    
      });
    });
     
     // Absent Start
     
     $(document).ready(function(){
       // Check or Uncheck All checkboxes
       $("#absent").change(function(){
         var checked = $(this).is(':checked');
         if(checked){
           $(".absent").each(function(){
             $(this).prop("checked",true);

             changeAction($(this));
           });
         }else{
           $(".absent").each(function(){
             $(this).prop("checked",false);

             changeAction($(this));
           });
         }
       });
     

      $('.actc').change(function(){

    	  changeAction($(this));
		
      });
    });

     function changeAction(val)
     {
    	var tmpArray = new Array("present", "absent", "leave", "lop", "wo");

     	var tmpValue = val.val();
 		var tmpId = val.attr('id');
 		var tmpIndex = tmpId.split(tmpValue+'-')[1];

 		for(var i=0; i<tmpArray.length; i++)
 		{
 			validateCheckAll(tmpArray[i]);
 			
 			if(tmpArray[i] == tmpValue)
 			{
 				continue;
 			}

 			$('#'+tmpArray[i]+'-'+tmpIndex).prop('checked', false);
 		}

     }

     function validateCheckAll(val)
     {
    	 var c = true;
 		
  		$("."+val).each(function(){

             if(!$(this).prop("checked"))
             {
                 c = false;
             }
             
           });

         if(c == false)
         {
             $('#'+val).prop('checked', false);
         }
         else
         {
         	$('#'+val).prop('checked', true);
         }

         aggregateCounts(val);
     }

     function aggregateCounts(val)
     {
         var cc = 0;
    	 $("."+val).each(function(){

             if($(this).prop("checked"))
             {
                 cc++;
             }
             
           });

         //console.log(val+": "+cc);

         countAttendance();
     }

     var attendance = new Array();
     
    function countAttendance()
    {
    	var totalPresent = 0;
  		var totalAbsent = 0;

  		var wdc = 0;
  		
  		$(".working-day").each(function(){
  			wdc++;

  			var tmpAttendanceStatus = attendanceStatus(wdc);

			if(tmpAttendanceStatus == "P")
			{
				totalPresent++;
			}

			if(tmpAttendanceStatus == "A")
			{
				totalAbsent++;
			}
       	});

  		$('#count-checked-checkboxes-present').html(totalPresent);
        $('#count-checked-checkboxes-present-top').html(totalPresent);

        $('#count-checked-checkboxes-absent').html(totalAbsent);
        $('#count-checked-checkboxes-absent-top').html(totalAbsent);
    }
    

	function attendanceStatus(tmpDate)
	{
		var tmpStatus = "";

		if($('#present-'+tmpDate).prop('checked'))
		{
			tmpStatus = "P";
		}

		if($('#absent-'+tmpDate).prop('checked'))
		{
			tmpStatus = "A";
		}

		if($('#leave-'+tmpDate).prop('checked'))
		{
			tmpStatus = "L";
		}

		if($('#lop-'+tmpDate).prop('checked'))
		{
			tmpStatus = "LOP";
		}

		if($('#wo-'+tmpDate).prop('checked'))
		{
			tmpStatus = "WO";
		}

		return tmpStatus;
	}

	function viewAttendance()
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

		var month = $('#filter_month').val();
		var year = $('#filter_year').val();
		
		var tmpData = new Object();
		tmpData.userid = tmpEmployeeId;
        tmpData.month = month;
        tmpData.year = year;
          
        var settings = {
            "async": false,
            "crossDomain": true,
            "url": "viewProcess.php",
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

            if(json.status)
            {
            tmpResult = json.response;
            }
         });

         if(tmpResult.length <= 0)
         {
             return false;
         }
        
         attendance = JSON.parse(tmpResult.attendance);

 		<?php 
	 		//if($_SESSION['role'] != "admin")
	 		//{
 		?>
         if(attendance.length > 0)
         {
             $('.present').attr("disabled", true);
             $('#present').attr("disabled", true);
             $('.absent').attr("disabled", true);
             $('#absent').attr("disabled", true);

             $('.reset-btn').hide();
             $('.submit-attendance-btn').hide();
         }
		<?php 
			//}
		?>
         //console.log(attendance);

        for(var i=0; i<attendance.length; i++)
        {
            var tmpData = attendance[i];

            switch(tmpData.status)
            {
            	case "P":
					$('.present-'+tmpData.date).prop('checked', true);
					validateCheckAll("present");
                break;

            	case "A":
					$('.absent-'+tmpData.date).prop('checked', true);
					validateCheckAll("absent");
                break;

            	case "L":
					$('.leave-'+tmpData.date).prop('checked', true);
					validateCheckAll("leave");
                break;

            	case "LOP":
					$('.lop-'+tmpData.date).prop('checked', true);
					validateCheckAll("lop");
                break;

            	case "WO":
					$('.wo-'+tmpData.date).prop('checked', true);
					validateCheckAll("wo");
                break;
            }
        }
	}


	$(function(){
	      $('.months').on('change', function () {
	    	  updateMonth();
	          
	      });
	      $('.years').on('change', function () {
	    	  updateMonth();
	      });
	    });

    function updateMonth()
    {
    	var month = $('.months').val(); 
    	var year = $('.years').val(); 

    	window.location = "view.php?month="+month+"&year="+year;
    }

    function resetAttendance()
    {
    	$(".present").each(function(){
            $(this).prop("checked",false);
            changeAction($(this));
          });

    	$(".absent").each(function(){
            $(this).prop("checked",false);
            changeAction($(this));
          });
    }

    function sendAttendanceMail(name, email, month, year, total_present, total_absent)
    {
    	var tmpData = new Object();
        tmpData.name = name;
        tmpData.month = month;
        tmpData.year = year;
        tmpData.email = email;
        tmpData.total_present = total_present;
        tmpData.total_absent = total_absent;

        var settings = {
		  "async": true,
		  "crossDomain": true,
		  "url": "send-attendance-mail.php",
		  "method": "POST",
		  "processData": false,
		  "data": JSON.stringify(tmpData)
		}

		$.ajax(settings).done(function (response) {
			 console.log(response);
		});
    }
    
</script>
    

</body>

</html>
