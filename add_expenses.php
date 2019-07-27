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

    <title>Expenses Sheet | Add</title>
	<!-- Font Aswsome -->
	<link rel="icon" href="img/fav3.ico">
	
    <!-- Bootstrap Core CSS -->
    <link href="./vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="./vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../dist/css/sb-admin-2.css" rel="stylesheet">
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
	<script>
        $(document).ready(function(){
        //$(".Sunday").css("background-color", "#dddddd");
        //$("input.diableCheck").prop("disabled", true);
        });
        //document.getElementById("myCheck").disabled = true;
    </script>

</head>

<body>

    <div id="wrapper" class="Background-side-bar">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top navbar-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <img alt="tya-logo" src="img/logo.png" class="img-responsive logo">
        <!--          <a class="" href="#" style="color:#fff; font-size:2.0rem; text-align: center;" href="#">
                	TYA Suite Attandance Sheet - <?php echo $login_session; ?>
               </a> -->
				
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
               
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar sidebar-style" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                       <!--  <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            
                        </li> -->
                        <?php 
                        
                            if($_SESSION['role'] == "admin")
                            {
                         ?>
                                
<!--                                 <li> -->
<!--                                 <a href="add.php">Add</a> -->
<!--                                 </li> -->
                                
<!--                                 <li> -->
<!--                                 <a href="view.php">View</a> -->
<!--                                 </li> -->
                                
                                <li>
                                <a href="employeeList.php">Employee List</a>
                                </li>
                           <?php 
                            }
                         
                            else
                            {
                            ?>
                                 <li>
                                <a href="add_expenses.php"  class="anchor-btn"><i class="fa fa-plus"></i>&nbsp;&nbsp;Add</a>
                                </li>
                                
                                <li>
                                <a href="expenses_view.php"  class="anchor-btn-view"><i class="fa fa-eye"></i>&nbsp;&nbsp;View</a>
                                </li>
                                
                            <?php 
                            }
                            
                            ?>                   
                            
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="header-top"><i class="fa fa-user"></i> Add Employee</h1>
                    <hr/>
                </div>
                <!-- /.col-lg-12 -->
            </div>
           
            <?php
            $temDate = date("Y");
            $temMonth = date("m");
            $arrayDays = json_decode(getDays($temDate, $temMonth));
            
            ?>
<div class="conatiner">

<div class="row">

<div class="col-md-10 add-table">
<table border="1">
   <thead  class="thead-div">
       <tr>
            <th>DATE</th>
            <th>DAY</th>
            <th>PRESENT <input type="checkbox" id="present" class="thead-style"></th>
            <th>ABSENT <input type="checkbox" id="absent" class="thead-style"></th>
            <th>LEAVE <input type="checkbox" id="leave" class="thead-style"></th>
            <th>LOSS OF PAY <input type="checkbox" id="lop" class="thead-style"></th>
            <th>Weeked OFF</th>
        </tr>
   </thead>
    
   <tbody>
    <?php
        
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

        
       array_push($tmpHolidayDates, "25");
        $tmpHoliday = array();
        $tmpHoliday['date'] = "25";
        $tmpHoliday['holiday_name'] = "Christmas";
        array_push($tmpHolidays, $tmpHoliday);
        
//         array_push($tmpHolidayDates, "26");
//         $tmpHoliday = array();
//         $tmpHoliday['date'] = "26";
//         $tmpHoliday['holiday_name'] = "Other Holidays";
//         array_push($tmpHolidays, $tmpHoliday);
    
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
            		class="count-present actc present present-<?php print_r($value->date); ?> <?php print_r($value->day); ?>" value="present">
            	</label>
            </td>
            <td colspan = "4" align = "center">
            	<?php echo $tmpHoliday['holiday_name']; ?>
            </td>
            <?php 
                }
                else
                {
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
            <td>
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
           	</td>
           	
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
      	<td>Leave = <span id="count-checked-checkboxes-leave">0</span></td>
      	<td>Lop = <span id="count-checked-checkboxes-lop">0</span></td>
      	<td>wo = <span id="count-checked-checkboxes-wo">0</span></td>
      	
      </tr>
   </tbody>
   
</table>
<input type="button" value="Submit" id="submit" name="submit" class="btn-lg btn btn-success submit-btn submit-attendance-btn" >
</div>

</div>
</div>
        </div>
    <!-- /#wrapper -->

    <!-- jQuery -->
    <script src="../vendor/jquery/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../vendor/bootstrap/js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="../vendor/raphael/raphael.min.js"></script>
    <!-- <script src="../vendor/morrisjs/morris.min.js"></script>
    <script src="../data/morris-data.js"></script> -->

    <!-- Custom Theme JavaScript -->
    <script src="../dist/js/sb-admin-2.js"></script>
     <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
    <script type='text/javascript'>
    // Present Start
     $(document).ready(function(){
       // Check or Uncheck All checkboxes
       $("#present").change(function(){
         var checked = $(this).is(':checked');
         if(checked){
           $(".present").each(function(){
             $(this).prop("checked",true);
             changeAction($(this));
           });
         }else{
           $(".present").each(function(){
             $(this).prop("checked",false);
             changeAction($(this));
           });
         }
       });
     
      // Changing state of CheckAll checkbox 
      $(".present").click(function(){
     
        if($(".present").length == $(".present:checked").length) {
          $("#present").prop("checked", true);
          changeAction($(this));
        } else {
          $("#present").removeAttr("checked");
          changeAction($(this));
          
        }
    
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
     
      // Changing state of CheckAll checkbox 
      $(".absent").click(function(){
     
        if($(".absent").length == $(".absent:checked").length) {
          $("#absent").prop("checked", true);

          changeAction($(this));
        	
        } else {
          $("#absent").removeAttr("checked");
          changeAction($(this));
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

         $('#count-checked-checkboxes-'+val).html(cc);
     }
     
    $(document).ready(function(){

        /*var $checkboxes = $('.count-present');
        var $countAbsent = $('.count-absent');
        var $countLeave = $('.count-leave');
        var $countLop = $('.count-lop');
        var $countWo = $('.count-wo');
            
        $checkboxes.change(function(){
            var countPresent = $checkboxes.filter(':checked').length;
            $('#count-checked-checkboxes-present').text(countPresent);
        });
        $countAbsent.change(function(){
             var countAbsent = $countAbsent.filter(':checked').length;
            $('#count-checked-checkboxes-absent').text(countAbsent);
        });
        $countLeave.change(function(){
            var countLeave = $countLeave.filter(':checked').length;
           $('#count-checked-checkboxes-leave').text(countLeave);
       	});
        $countLop.change(function(){
            var countLop = $countLop.filter(':checked').length;
           $('#count-checked-checkboxes-lop').text(countLop);
       	});
        $countWo.change(function(){
            var countWo = $countWo.filter(':checked').length;
           $('#count-checked-checkboxes-wo').text(countWo);
       	});*/
    
	});

	$('.submit-attendance-btn').click(function(){

		var wdc = 0;

		var wds = new Array();
		
		$(".working-day").each(function(){
			wdc++;

			var tmpAttendanceStatus = attendanceStatus(wdc);
			
			var tmpStatus = new Object();
			tmpStatus.date = wdc;
			tmpStatus.status = tmpAttendanceStatus;

			wds.push(tmpStatus);
          });

        console.log(wds);

        var tmpMonth = "<?php echo date("m"); ?>";
        var tmpYear = "<?php echo date("Y"); ?>";
        var userid = "<?php echo $_SESSION['login_userid']; ?>";

        var tmpData = new Object();
        tmpData.userid = userid;
        tmpData.month = tmpMonth;
        tmpData.year = tmpYear;
        tmpData.attendance = wds;

        var settings = {
		  "async": true,
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
  		      swal('Success', "Attendance Inserted Successfully", "success");
  		    }
  		    else
  		    {
  		  		swal('Error', "Attendance Inserted Successfully", "error");
  		    }
		});
	});

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

	
</script>
    

</body>

</html>
