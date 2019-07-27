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

    <title>Employee List | Attendance Page</title>
	<!-- Font Aswsome -->
	
	
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
	<script>
        $(document).ready(function(){
        //$(".Sunday").css("background-color", "#dddddd");
        //$("input.diableCheck").prop("disabled", true);
        });
        //document.getElementById("myCheck").disabled = true;
    </script>

</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">TYA Attandance Sheet - <?php echo $login_session; ?></a>

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

            <div class="navbar-default sidebar" role="navigation">
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
                                	<li>
                                	<a href="addEmployee.php">Add Employee</a>
                                	</li>
<!--                                 <li> -->
<!--                                 <a href="add.php">Add</a> -->
<!--                                 </li> -->
                                
<!--                                 <li> -->
<!--                                 <a href="view.php">View</a> -->
<!--                                 </li> -->
                                
                                <li>
                                <a href="employeeList.php">Employeelist</a>
                                </li>
                           <?php 
                            }
                         
                            else
                            {
                            ?>
                                 <li>
                                <a href="add.php">Add</a>
                                </li>
                                
                                <li>
                                <a href="view.php">View</a>
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
                    <h1 class="page-header">Add Employee</h1>
                </div>
                
                <div class="conatiner">

                    <div class="row">
                    	<div class="col-md-4 col-md-offset-4">
                        <div class="login-panel panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Add New Employee</h3>
                            </div>
                            <div class="panel-body">
                                <form role="form" action="" method="post">
                                    <fieldset>
                                    	<div class="form-group">
                                            <input class="form-control" placeholder="Full Name" name="fullname" type="text" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Contact" name="contact" type="number" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                        </div>
                                        <!-- Change this to a button or input when using this as a form -->
                                        <input type="submit" name="addEmployee" value="Add" class="btn btn-lg btn-success btn-block">
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>                 
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
    
    <script type='text/javascript'>
    // Present Start
     $(document).ready(function(){

      viewempAttendance();

          var tmpMonth = "<?php echo date("m"); ?>";
          var tmpYear = "<?php echo date("Y"); ?>";
          var userid = "<?php echo $_SESSION['login_userid']; ?>";

      
    });


	function viewempAttendance()
	{
		
		   var tmpObject = new Object();
		     
	         var settings = {
	         "async": false,
	         "crossDomain":true,
	         "url": "employeelistprocess.php",
	         "method": "POST",
	         "processData": false,
	         "contentType": "application/json",
	         "mimeType": "multipart/form-data",
	         "data": JSON.stringify(tmpObject)
	         }

	           $.ajax(settings).done(function (response) {
	           var json = JSON.parse(response);
	          
	          console.log(json);

	          var emplist = json.emplist;
			for(var a=0; a<emplist.length; a++)
			{
				  
				  var tmpData = '';
				  tmpData += '<tr>';
                  tmpData += '<td>'+emplist[a].employee_id+'</td>';
                  tmpData += '<td>'+emplist[a].name+'</td>';
                  
                  tmpData += '<td>'+emplist[a].email+'</td>';
                 tmpData += '<td><a href="view.php?id='+emplist[a].employee_id+'"><input type="button" name="view" class="btn  btn-success" value="View"/></a></td>';
                          
                  tmpData += '</tr>';

                  $('#uploaded_company_table tbody').append(tmpData);
								
			}
        });

	} 
</script>
</body>
</html>
