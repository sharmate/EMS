<?php
include('session.php');


require_once './inc/common-functions.php';
$tmpYear = date("Y");
//$tmpMonth = date("m");
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Employee List | EMS</title>
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
	 <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css" rel="stylesheet" />
	 
	 <style type="text/css">
	 
	 </style>
</head>

<body>

    <div id="wrapper" class="Background-side-bar">

        <!-- Navigation -->
        <?php
        	include 'header.php';	
        ?>

        <div id="page-wrapper" style="margin-top: -23px;">
                
                
                <div class="conatiner">
                
                <h1 class="header-top employee-list-header employee_list_main_header"><i class="fa fa-users"></i>&nbsp;&nbsp;Employee Attendance List</h1>
				<hr/>

                    <div class="row">
    					<div class="card box">
    						<div class="table-responsive">
    							<br />
    							<div align="right" class="employee_list_right_btn">
    								<button class="btn btn-success enable_month_btn employee_list_filter_btn" name="filter" title="Enable Month"><i class="fa fa-gear" aria-hidden="true"></i></button>
<!--     								<button type="button" name="add" id="add" class="btn btn-success employee_attendance_list_add_btn" title="Add New Employee"><i class="fa fa-plus"></i></button> -->
									<button class="btn btn-success export_btn employee_attendance_list_export_btn" name="export" title="Excel Attendance"><i class="fa fa-file-excel-o" aria-hidden="true"></i></button>
									<button class="btn btn-success filter_attendance_btn employee_attendance_list_view_btn" name="filter_view" title="view Employee"><i class="fa fa-filter" aria-hidden="true"></i></button>
    						
								</div>

    							<br />
    							<div id="alert_message"></div>
    							<table id="user_data" class="table table-bordered table-striped">
    								<thead>
    									<tr>
    										<th>Name</th>
    										<th>Email</th>
    										<th>contact</th>
    										<th>password</th>	
    										<th>Action</th>
    									</tr>
    								</thead>
    
    								<tbody>
    								</tbody>
    							</table>
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
    
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.10.15/js/dataTables.bootstrap.min.js"></script>
  
 
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert-dev.js"></script>
    
    <script type='text/javascript'>
      var tmpMonth = "<?php echo date("m"); ?>";
      var tmpYear = "<?php echo date("Y"); ?>";
      var userid = "<?php echo $_SESSION['login_userid']; ?>";
	</script>

<script type="text/javascript" language="javascript" >
 $(document).ready(function(){
  
  fetch_data();
  function fetch_data()
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"get-employee-attendance.php",
     type:"POST"
    }
   });
  }
  
  function update_data(id, column_name, value)
  {
   $.ajax({
    url:"update.php",
    method:"POST",
    data:{id:id, column_name:column_name, value:value},
    success:function(data)
    {
     $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
     $('#user_data').DataTable().destroy();
     fetch_data();
    }
   });
   setInterval(function(){
    $('#alert_message').html('');
   }, 5000);
  }

  $(document).on('blur', '.update', function(){
   var id = $(this).data("id");
   var column_name = $(this).data("column");
   var value = $(this).text();
   update_data(id, column_name, value);
  });
  
  $('#add').click(function(){
   var html = '<tr>';
   html += '<td contenteditable id="data1"></td>';
   html += '<td contenteditable id="data2"></td>';
   html += '<td contenteditable id="data3"></td>';
   html += '<td contenteditable id="data4"></td>';
//    html += '<td contenteditable id="data5"></td>';
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs insert_btn"><i class="fa fa-plus"></i></button></td>';
   html += '</tr>';
   $('#user_data tbody').prepend(html);
  });
  
  $(document).on('click', '#insert', function(){
   var name = $('#data1').text();
   var email = $('#data2').text();
   var contact = $('#data3').text();
   var password = $('#data4').text();
   var role = $('#data5').text();
   if(name != '' && email != '' && contact !='' && password !='')
   {
    $.ajax({
     url:"insert.php",
     method:"POST",
     data:{name:name, email:email, contact:contact, password:password},
     success:function(data)
     {
         var json = JSON.parse(data);

         if(json.status == true)
         {
		      $('#alert_message').html('<div class="alert alert-success">'+json.message+'</div>');
		      $('#user_data').DataTable().destroy();
		      fetch_data();
         }
         else
         {
        	 $('#alert_message').html('<div class="alert alert-danger">'+json.message+'</div>');
		 }
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
   else
   {
    alert("Both Fields is required");
   }
  });
  
  $(document).on('click', '.delete', function(){
   var id = $(this).attr("id");
   if(confirm("Are you sure you want to remove this?"))
   {
    $.ajax({
     url:"delete.php",
     method:"POST",
     data:{id:id},
     success:function(data){
      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
      $('#user_data').DataTable().destroy();
      fetch_data();
     }
    });
    setInterval(function(){
     $('#alert_message').html('');
    }, 5000);
   }
  });
 });

 function viewempAttendance(empId) 
 {
     localStorage.setItem('empId', empId);
    
     location.href = 'view-employee.php';
 }

 //Filter for export excel
 
 $('.export_btn').click(function(){
	 swal({
		  title: "Filter For Export Excel",
		  text: "<form action='' id='form_data' method='post' style='padding-left:25px;padding-right:25px;'><div class='form-group'><select class='form-control years' id='filterYear' name='filterYear'><?php for($i = 2010; $i<2050; $i++){?><option value='<?php echo $i; ?>' <?php if($tmpYear == $i){ echo 'selected'; } ?>><?php echo $i; ?></option><?php }?> required='required'></select></div><div class='form-group'><select class='form-control months' id='filterMonth' name='filterMonth'  required='required'><option value=''>--- Select Month ---</option><option value='01'>Janaury</option><option value='2'>February</option><option value='3'>March</option><option value='4'>April</option><option value='5'>May</option><option value='6'>June</option><option value='7'>July</option><option value='8'>August</option><option value='9'>September</option><option value='10'>October</option><option value='11'>November</option><option value='12'>December</option></select></div></form>",
          html: true,
		  showCancelButton: true,
		  confirmButtonColor: "#5cb85c",
		  confirmButtonText: "Submit",
		  closeOnConfirm: false,
		  animation: "slide-from-top",
		  inputPlaceholder: "Write something"
		}, function() {
		 
		  var year = document.getElementById('filterYear').value;
		  var month = document.getElementById('filterMonth').value;
		  var tmpData = new Object();
			tmpData.year = year;
			tmpData.month = month;
	         console.log(month);
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "export.php",
	            "method": "POST",
	            "processData": false,
	            "data": JSON.stringify(tmpData)
	        }
	        $.ajax(settings).done(function (response) {
				var json = JSON.parse(response);
				location.href = json.file_url;
				swal("Success","File downloaded Successfully","success");
	        });
		});
	 });

 	//Filter for view attendance
 	
 	$('.filter_attendance_btn').click(function(){
	 swal({
		  title: "Filter for present employee",
		  text: "<form action='' id='form_data' method='post' style='padding-left:25px;padding-right:25px;'><div class='form-group'><select class='form-control years' id='filter-year' name='filter-year'><?php for($i = 2010; $i<2050; $i++){?><option value='<?php echo $i; ?>' <?php if($tmpYear == $i){ echo 'selected'; } ?>><?php echo $i; ?></option><?php }?> required='required'></select></div><div class='form-group'><select class='form-control months' id='filter-month' name='filter-month'  required='required'><option value=''>--- Select Month ---</option><option value='01'>Janaury</option><option value='2'>February</option><option value='3'>March</option><option value='4'>April</option><option value='5'>May</option><option value='6'>June</option><option value='7'>July</option><option value='8'>August</option><option value='9'>September</option><option value='10'>October</option><option value='11'>November</option><option value='12'>December</option></select></div></form>",
          html: true,
		  showCancelButton: true,
		  confirmButtonColor: "#5cb85c",
		  confirmButtonText: "Filter",
		  closeOnConfirm: false,
		  animation: "slide-from-top",
		  inputPlaceholder: "Write something"
		}, function() {


		  var month = document.getElementById('filter-month').value;
		  var year = document.getElementById('filter-year').value;
		  var tmpData = new Object();
		  	tmpData.month = month;
			tmpData.year = year;
			
			console.log(month);
			console.log(year);
	          
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "save-filter-employee-month.php",
	            "method": "POST",
	            "processData": false,
	            "data": JSON.stringify(tmpData)
	        }
	        $.ajax(settings).done(function (response) {
// 				var json = JSON.parse(response);
				location.reload();
// 				swal("Success","Selected month view successfully!!! ","success");
	        });
		});
	 });

	 // Enable Month and Year

	 $('.enable_month_btn').click(function(){
	 swal({
		  title: "Enable Attendance Month",
		  text: "<form action='' id='form_data' method='post' style='padding-left:25px;padding-right:25px;'><div class='form-group'><select class='form-control years' id='enable_year' name='enable_year'><?php for($i = 2010; $i<2050; $i++){?><option value='<?php echo $i; ?>' <?php if($tmpYear == $i){ echo 'selected'; } ?>><?php echo $i; ?></option><?php }?> required='required'></select></div><div class='form-group'><select class='form-control months' id='enable_month' name='enable_month'  required='required'><option value=''>--- Select Month ---</option><option value='01'>Janaury</option><option value='2'>February</option><option value='3'>March</option><option value='4'>April</option><option value='5'>May</option><option value='6'>June</option><option value='7'>July</option><option value='8'>August</option><option value='9'>September</option><option value='10'>October</option><option value='11'>November</option><option value='12'>December</option></select></div></form>",
          html: true,
		  showCancelButton: true,
		  confirmButtonColor: "#5cb85c",
		  confirmButtonText: "Enable Month",
		  closeOnConfirm: false,
		  animation: "slide-from-top",
		  inputPlaceholder: "Write something"
		}, function() {
		 
		  var year = document.getElementById('enable_year').value;
		  var month = document.getElementById('enable_month').value;
		  var tmpData = new Object();
			tmpData.year = year;
			tmpData.month = month;
			console.log(month);
	          
	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "save-enable-month.php",
	            "method": "POST",
	            "processData": false,
	            "data": JSON.stringify(tmpData)
	        }
	        $.ajax(settings).done(function (response) {
// 				var json = JSON.parse(response);
				swal("Success","Current month enabled successfully!!! ","success");
	        });
		});
	 });

</script>
</body>
</html>
