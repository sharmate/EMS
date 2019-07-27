<?php
include('session.php');


require_once './inc/common-functions.php';
$tmpYear = date("Y");
$tmpMonth = date("m");
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
	   .css-serial {
         counter-reset: serial-number; /* Set the serial number counter to 0 */
        }
        .css-serial td:first-child:before {
         counter-increment: serial-number; /* Increment the serial number counter */
         content: counter(serial-number); /* Display the counter */
        }
	
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
                
                <h1 class="header-top employee-list-header employee_list_main_header"><i class="fa fa-users"></i>&nbsp;&nbsp;Employee List</h1>
				<hr/>

                    <div class="row">
    					<div class="card box">
    						<div class="table-responsive">
    							<br />
    							<div align="right" class="employee_list_right_btn">
    								<button type="button" name="add" id="add" class="btn btn-success employee_list_add_btn" title="Add New Employee"><i class="fa fa-plus"></i></button>
    								<a href="export-employee-details.php" class="btn btn-success employee_list_export_btn" name="export" title="Employee Name"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
    							</div>
    							<br />
    							<div id="alert_message"></div>
    							<table id="user_data" class="table table-bordered table-striped css-serial">
    								<thead>
    									<tr>
    										<th>S No.</th>
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
    
    <!-- Footer start -->
    <?php 
        include 'footer.php';
    ?>
    <!-- Footer end -->

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
     url:"fetch.php",
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
   html += '<td><button type="button" name="insert" id="insert" class="btn btn-success btn-xs insert_btn"><i class="fa fa-plus" titlle = "Add"></i></button></td>';
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
    
     location.href = 'personal_info.php';
 }

 
</script>
</body>
</html>
