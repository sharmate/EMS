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

    <title>Forgot Password | EMS</title>
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
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <div id="wrapper"  class="Background-side-bar">

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
                <!--<a class="navbar-brand" href="#" style="color:#fff; font-size:2.0rem;">TYA Suite Attandance Sheet - <?php echo $login_session; ?></a>
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
                        
                        <li>
                        	<a href="logout.php"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                        <li>
                        	<a href="reset-password.php"><i class="fa fa-sign-out fa-fw"></i> Reset Password</a>
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
                <!-- forgot Passwoprd -->
                <div class="conatiner">
                	<div class="row">
                    	<div class="col-md-4">
                    		
                    		<form action="" method="post">
                    			
                    			<div class="card forgot-card">
                    				<h2 class="forgot-header">Forgot Password</h2>
                    				<div class="form-group">
                    					<input type="email" id="email" name="email" required="required" class="form-control" placeholder="Enter your email...">
                    				</div>
                    				<input type="submit" class="btn btn-lg btn-block btn-success" value="Submit" name="submit">
                    			</div>
                    			
                    		</form>
                    	</div>
                    	<div class="col-md-8"></div>
                    </div>
                </div>
                <?php
                include('mail.php');
                if(isset($_POST['submit']))
                {
                    $email = $_POST['email'];
                    $result = mysqli_query($db,"SELECT * FROM `employee` WHERE `email`='".$email."'");
                    $row = mysqli_fetch_assoc($result);
                	$fetch_user_id=$row['email'];
                	$email_id=$row['email'];
                	$password=$row['password'];
                	if($email == $fetch_user_id) {
                				$to = $email_id;
                                $subject = "Forgot Password";
                                $txt = "
                                <center><table style='background-color:#eee; width:80%; font-size:16px; height:auto;padding:20px;  border:1px solid black; color:#484646; text-align: left; '>
                <tr>
                    <td><p>Your Password is :- ".$password."</p></td>
                    <td style='background-color:#eee;'>
                        <img src='http://tyasuite.com/img/Logo.png' alt='logo' class='img-responsive' style='margin-top: -25px !important;float:right;'/>                    
                    </td>    
                </tr>
              
                <tr>
                    <td colspan='2'><p>Login Here : <a href='http://ems.tyasuite.com/'>http://ems.tyasuite.com/</a></p></td>
                </tr>
              
            </table></center>


                                ";
                                
                                send_mail($to,$subject,$txt);
                                echo '<script>swal("Success", "Check Your Mail", "success")</script>';
                			}
                				else{
                					echo '<script>swal("Error", "Invalid Username", "error")</script>';
                				}
                }
                ?>
             	<!-- Foprgot Password End -->
            </div>
         
        </div>
    <!-- /#wrapper -->

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
    
    
    
    <script type='text/javascript'>

    	var tmpEmployeeId = "<?php echo $_SESSION['login_userid']; ?>";
    
   		$(document).ready(function(){

   			var tmpId = localStorage.getItem('empId');
	
			if(tmpId && tmpId !== "")
			{
				tmpEmployeeId = tmpId;
			}

   			getEmployeeDetails();

   			
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

</script>
    

</body>

</html>
