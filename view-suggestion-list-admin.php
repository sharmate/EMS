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

    <title>Suggestion List | EMS</title>
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
                <!--  <a class="navbar-brand" style="color:#fff; font-size:2.0rem;" href="#">TYA Suite Attandance Sheet - Admin</a>
-->
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle logout-fa-btn" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        
                        <li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar sidebar-style" role="navigation">
                <?php include 'sidebar.php'; ?>
            </div>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper" style="margin-top: -23px;">
                
                
                <div class="conatiner">
                
                <h1 class="header-top employee-list-header suggestion_admin_header"><i class="fa fa-users"></i>&nbsp;&nbsp;Employee Suggestion List</h1>
				<hr/>

                    <div class="row">
    					<div class="card box">
    						<div class="table-responsive suggestion_admin_table">
    							
    							<div align="right" class="suggestion_admin_right_btn">
    								<a href="export-suggestion-list.php" class="btn btn-success export_suggestion_list_btn" name="export" title="Excel Suggestion List"><i class="fa fa-file-excel-o" aria-hidden="true"></i></a>
    							</div>
    							<br />
    							<div id="alert_message"></div>
    							<table id="user_data" class="table table-bordered table-striped">
    								<thead>
    									<tr>
    										<th>Name</th>
    										<th>Email</th>
    										<th>Contact</th>
    										<th>Subject</th>
    										<th>Message</th>
    										<th>Status</th>
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
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
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
     url:"all-suggestion-list-admin.php",
     type:"POST"
    }
   });
  }

 });


 function viewEmployeeSuggestion(id, suggestedById) 
 {
     localStorage.setItem('id', id);
     localStorage.setItem('suggested_by', suggestedById);
     localStorage.setItem('status', 1);
    
     location.href = 'view-suggestion-box.php';
 }
 
</script>

<script>
function updateStatus(){
	var tmpStatus = localStorage.getItem('status');
	var tmpEmpId = localStorage.getItem('suggested_by');
	var tmpId = localStorage.getItem('id');
	var temData = new Object();
	temData.tmpEmpId = tmpEmpId;
	temData.tmpId = tmpId;
	temData.tmpStatus = tmpStatus;
	//alert(tmpId);
	//console.log(tmpStatus);
	
	var settings = {
			"async" : true,
			"crossDomain" : true,
			"url": "update-reply-message.php",
			"method" : "POST",
			"processData" : false,
			"data" : JSON.stringify(temData)
	}
	  //var tmpResult = new Array();
	
    $.ajax(settings).done(function (response) {
//     	if(response.status !== true)
// 		    {
// 		      swal('Success', "Update Successfully !!!", "success");
// 		    }
// 		    else
// 		    {
// 		  		swal('Error', "Update Successfully !!!", "error");
// 		    }
    });
}

/* Closed mail */
 
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
 
 
function closeReplyMail(){
	//alert('test');
	var suggestedById = localStorage.getItem('suggested_by');
	var tmpEmployee = getEmployeeById(suggestedById);
	var tmpId = localStorage.getItem('id');
	console.log(suggestedById);
	console.log("Employee email: "+tmpEmployee.email);
	console.log("Employee Name: "+tmpEmployee.name);
	
	var tmpReply = new Object();
	tmpReply.tmpEmailId = tmpEmployee.email;
	tmpReply.tmpName = tmpEmployee.name;
	tmpReply.id = tmpId;
	
	
	
	 var settings = {
			  "async": true,
			  "crossDomain": true,
			  "url": "close-reply-mail.php",
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
</script>
</body>
</html>
