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

    <title>All Suggestion History | EMS</title>
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
        <?php
        	include 'header.php';	
        ?>

        <div id="page-wrapper" style="margin-top: -23px;">
                
                
                <div class="conatiner">
                
                <h1 class="header-top employee-list-header All_suggestion_main_header"><i class="fa fa-users"></i>&nbsp;&nbsp;All Suggestion History</h1>
				<hr/>

                    <div class="row">
    					<div class="card box">
    						<div class="table-responsive">
    							<br />
    							
				    			<br />
    							<div id="alert_message"></div>
    							<table id="user_data" class="table table-bordered table-striped">
    								<thead>
    									<tr>
    										
    										<th>Date</th>
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
    
    <script type='text/javascript'>
      
	</script>

<script type="text/javascript" language="javascript" >

var tmpMonth = "<?php echo date("m"); ?>";
var tmpYear = "<?php echo date("Y"); ?>";
var userid = "<?php echo $_SESSION['login_userid']; ?>";

 $(document).ready(function(){
  
  fetch_data();

  function fetch_data()
  {
   var dataTable = $('#user_data').DataTable({
    "processing" : true,
    "serverSide" : true,
    "order" : [],
    "ajax" : {
     url:"all-view-suggestions-history.php",
     type:"POST",
     data:{employee_id: userid}
    }
   });
  }


 });
 $(document).on('click', '.delete', function(){
	   var id = $(this).attr("id");
	   if(confirm("Are you sure you want to remove this?"))
	   {
	    $.ajax({
	     url:"delete-history.php",
	     method:"POST",
	     data:{id:id},
	     success:function(data){
	      $('#alert_message').html('<div class="alert alert-success">'+data+'</div>');
	      $('#user_data').DataTable().destroy();
	      
	     }
	    });
	    setInterval(function(){
	     $('#alert_message').html('');
	    }, 5000);
	   }
	  });
	
 function getSuggestionHistory(id) 
 {
     localStorage.setItem('id', id);
    
     location.href = 'view-suggestion-box.php';
 }
</script>
</body>
</html>
