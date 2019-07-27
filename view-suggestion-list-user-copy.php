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
    <link href="css/chat.css" rel="stylesheet">

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
    
    <!-- chat -->
<!-- 	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"> -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.css">
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	
<!-- 	<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script> -->
<!-- <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> -->
<script type="text/javascript">

</script>

</head>

<body>

    <div id="wrapper" class="Background-side-bar">

        <!-- Navigation -->
       <nav class="navbar navbar-default navbar-static-top navbar-top"
	role="navigation" style="margin-bottom: 0">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle" data-toggle="collapse"
			data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
			<span class="icon-bar"></span> <span class="icon-bar"></span>
		</button>
		<a href="http://tyasuite.com/index.php" target="_blank">
			<img alt="tya-logo" src="img/logo.png" class="img-responsive logo">
		</a>
	</div>
	<!-- /.navbar-header -->

	<ul class="nav navbar-top-links navbar-right">

		<!-- /.dropdown -->
		<li class="dropdown"><a class="dropdown-toggle logout-fa-btn"
			data-toggle="dropdown" href="#"> <i class="fa fa-user fa-fw"></i> <i
				class="fa fa-caret-down"></i>
		</a>
			<ul class="dropdown-menu dropdown-user">
				<li>
					<a href="logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
				</li>
				<li>
					<a href="reset-password.php"><i class="fa fa-key fa-fw"></i>Reset Password</a>
				</li>
				<li>
					<a href="forgot-password.php"><i class="fa fa-key fa-fw"></i>Forgot Password</a>
				</li>
			</ul> <!-- /.dropdown-user --></li>
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
				
<!-- Chat start -->
			<div class="container-fluid h-100">
			<div class="row justify-content-center h-100 chat_row">
				<div class="col-md-4 col-xl-3 chat"><div class="card mb-sm-3 mb-md-0 contacts_card">
					<div class="card-header">
						<div class="form-group search_input dataTables_filter" id="user_data_filter" >
							<input type="search" placeholder="Search..." name="" class="form-control chat_user_serach" aria-controls="user_data">
							<span class="btn btn-primary add_suggestion_btn" data-toggle="modal" title="Add New Suggestion" data-target="#exampleModalCenter"><i class="fas fa-plus" aria-hidden="true"></i></span>
						</div>
						<!-- Modal -->
                        <div class="modal fade" data-keyboard="false" data-backdrop="static" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                          <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                              <div class="modal-header model_header_div">
                                <h4 class="modal-title text-center" id="exampleModalCenterTitle">Add New Suggestion</h4>
                              </div>
                              <div class="modal-body">
                                <form>
                                	<div class="form-group">
    									<label>Subject </label>
    									<input type="text" name="subject" id="subject" placeholder="Enter Your Subject..." class="form-control"/>
    																	
    								</div>
    								<div class="form-group">
    									<label>Message </label>
    									<textarea name="message" id="message"  placeholder="Enter Your Message..." class="form-control" style="height: 100px;"></textarea>								
    								</div> 
                                </form>
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary chat_new_close" data-dismiss="modal">Close</button>
                                <button type="button" class="save_btn save-btn">Send&nbsp;<i class="fa fa-paper-plane" aria-hidden="true"></i></button>
                              </div>
                            </div>

                          </div>
                        </div>
						
					</div>
					<div class="card-body contacts_body">
						<ul class="contacts suggestions-list">
    						<li class="employee-container">
    							
    						</li>
						</ul>
					</div>
					<div class="card-footer"></div>
				</div></div>
				<div class="col-md-8 col-xl-6 chat">
					<div class="card">
						<div class="card-header msg_head">
							<div class="activeEmploye">

							</div>
						</div>
						<div class="card-body msg_card_body user-card-body">
							<div class="reply_mesage">

							</div>
						</div>
						<div class="card-footer">
							<div class="selected_file">
							
							</div>
							<div class="reply_input">
								<label for="fileUpload" class="chat_fileupload tmp_filepload_btn"><i class="fa fa-paperclip" aria-hidden="true"></i></label>
								<input type="file" name="fileUpload" id="fileUpload" class="hidden" multiple/>
								<div class="form-group reply_msg_box">
    								<textarea name="" class="form-control type_msg input_msg" placeholder="Type your message..." id="reply_user"></textarea>
    							</div>
    							<button type="submit" class="type_msg reply_btn"><i class="fa fa-paper-plane" aria-hidden="true" style="color:#2f6386;"></i></button>
							</div>
							<div class="reopen_input" style="display: none;">
								<span class="reopen_btn reopen_suggestion">Reopen Suggestion</span>
								<hr>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
<!-- Chat End -->				
				
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
   <script type="text/javascript" src="js/dropzone.js"></script>

    
    <script type='text/javascript'>
      var tmpMonth = "<?php echo date("m"); ?>";
      var tmpYear = "<?php echo date("Y"); ?>";
      var userid = "<?php echo $_SESSION['login_userid']; ?>";
	</script>

<script type="text/javascript" language="javascript" >
var tmpEmployeeId = "<?php echo $_SESSION['login_userid']; ?>";
localStorage.setItem("employee_Id", tmpEmployeeId);
var role = "<?php echo $_SESSION['role']?>";

 $(document).ready(function(){
// 	 $(".msg_head").animate({ scrollTop: $('.msg_head').prop("scrollHeight")}, 1000);
	 localStorage.setItem('reopenStatus', 0);

	 
	 getEmployeeDetails();	
	 getActiveEmployee();
	 getReplyMessage();
	 
	 $(".emplyee_btn").click(function() {
		var tmpId = this.id;

		$('.employee-container').removeClass('active');
		$(this).parent().addClass("active");
		
		localStorage.setItem("tmpId", tmpId);
		getActiveEmployee();
		getReplyMessage();
	 });

	 $(".reply_btn").click(function(){
		 saveReplyUser();
	});

	 $('#reply_user').keypress(function (e) {
		 var key = e.which;
		 if(key == 13)  // the enter key code
		  {
			 saveReplyUser();
		    return false;  
		  }
		}); 
		
	 $('.save_btn').click(function(){
			submitSuggestionBox();
   		});

	 $('#message').keypress(function (e) {
		 var key = e.which;
		 if(key == 13)  // the enter key code
		  {
			 submitSuggestionBox();
		    return false;  
		  }
		}); 

	 $('input[type="file"]').change(function(e){
		 var fileName_icon = getIconName(name);
         var tmpFileName = e.target.files[0].name;
         localStorage.setItem("tmpFileName", tmpFileName); 
           
         var file_data = $('#fileUpload').prop('files')[0];   
		    var form_data = new FormData();                  
		    form_data.append('file', file_data);
		    console.log(file_data);
		                              
		    $.ajax({
		        url: 'suggestion_file_upload.php', 
		        dataType: 'text',  
		        cache: false,
		        contentType: false,
		        processData: false,
		        data: form_data,                         
		        type: 'post',
		        success: function(php_script_response){
		            console.log(php_script_response); // display response from the PHP script, if any
		        }
		     });
         
         var tmpFile = "";
         tmpFile += '<div class="selected_file">';
//          tmpFile += '<i class="'+iconname+' font40" aria-hidden="true"></i>';
	     tmpFile += '<img src="uploads/tmpUploads/'+fileName_icon+'" alt="image" class="img-responsive view_image"/>';
         tmpFile += '</div>';

         $('.selected_file').append(tmpFile);
         
     });

	 
 });

 function getEmployeeDetails(){
		var tmpEmployeeId = localStorage.getItem("employee_Id");
	 	var tmpData = new Object();
		tmpData.tmpEmployeeId = tmpEmployeeId;
//  		console.log(tmpEmployeeId);
	 
     var settings = {
         "async": false,
         "crossDomain": true,
         "url": "chat-get-employee-detail-user.php",
         "method": "POST",
         "processData": false,
         "data": JSON.stringify(tmpData)
     }

     var tmpEmployeeDetailsUser = new Array();

     $.ajax(settings).done(function (response) {
//          console.log(response);
         var json = JSON.parse(response);
         if(json.status == true)
         {
        	 tmpEmployeeDetailsUser = JSON.parse(response);
        	 
         }
     });
//       console.log(tmpEmployeeDetailsUser);
     var tmpEmp = '';
     var tmpReply = '';
     for(var i=0; i<tmpEmployeeDetailsUser.response.length; i++)
      {
	     	var tmpEmployee = tmpEmployeeDetailsUser.response[i];

	     	
			tmpEmp += '<li class="employee-container">'
			tmpEmp += '<span href="" type="button" id="'+tmpEmployee.id+'" class="emplyee_btn">';	
			tmpEmp += '<div class="d-flex bd-highlight">';
			tmpEmp += '<div class="user_info">';
			tmpEmp += '<div class="row">';
			tmpEmp += '<div class="row">';
			tmpEmp += '<div class="col-md-3">';
			tmpEmp += '<img src="uploads/profile_picture/'+tmpEmployee.profile_image+'" class="rounded-circle employee_img">';
			tmpEmp += '</div>';
	     	tmpEmp += '<div class="col-md-9 title_head">';
	     	tmpEmp += '<h3 class="replied-by">'+tmpEmployee.subject+' <span>'+tmpEmployee.data_added+'</span></h3>';
	     	tmpEmp += '<p class="font_subject">'+tmpEmployee.name+'</p>';
	     	tmpEmp += '</div>';
	     	tmpEmp += '</div>';
	     	tmpEmp += '</div>';
	     	tmpEmp += '</div>';
 			tmpEmp += '</div>';
 			tmpEmp += '</span>';
			tmpEmp += '</li>';

	    }
	    
     $('.suggestions-list').html(tmpEmp);

     $(".employee-container:first").addClass('active');

     if(tmpEmployeeDetailsUser.response[0] && tmpEmployeeDetailsUser.response[0].id)
	 {
	 	var tmpId = tmpEmployeeDetailsUser.response[0].id;
 		localStorage.setItem("tmpId", tmpId);
	 }
     
 }

 // active Employe 
 
 	function getActiveEmployee(){
 	 	var empTmpId = localStorage.getItem("tmpId");
 	 	var tmpData = new Object();
		tmpData.empTmpId = empTmpId;
//  		console.log(empTmpId);  
        var settings = {
            "async": false,
            "crossDomain": true,
            "url": "chat-get-active-employee-detail.php",
            "method": "POST",
            "processData": false,
            "data": JSON.stringify(tmpData)
        }

       var tmpResult = new Array();

        $.ajax(settings).done(function (response) {
	       var json = JSON.parse(response);

	           if(json.status == true)
	           {
	        	   tmpActiveEmployeeDetails = JSON.parse(response);
	           }
        });
        //console.log(tmpActiveEmployeeDetails);
        var tmpEmpAct = '';
        for(var i=0; i<tmpActiveEmployeeDetails.response.length; i++)
        {
            var tmpEmployeeAct = tmpActiveEmployeeDetails.response[i];
    // 		console.log(tmpEmployeeAct.email);
    		tmpEmpAct += '<div class="activeEmploye">';
            tmpEmpAct += '<div class="d-flex bd-highlight">';
            tmpEmpAct += '<div class="user_info_current">';
            tmpEmpAct += '<div class="row">';
            tmpEmpAct += '<div class="col-md-1">';
            tmpEmpAct += '<img src="uploads/profile_picture/'+tmpEmployeeAct.profile_image+'" class="rounded-circle employee_img">';
            tmpEmpAct += '</div>';
            tmpEmpAct += '<div class="col-md-8 title_head active_msg_con">';
            tmpEmpAct += '<h3 class="replied-by">'+tmpEmployeeAct.name+'</h3>';
            tmpEmpAct += '<p class="font_subject">'+tmpEmployeeAct.subject+'</p>';
            tmpEmpAct += '</div>';
            tmpEmpAct += '<div class="col-md-3">';
            tmpEmpAct += '<p class="suggestion-header-date"><strong>Submitted on:</strong><br />'+tmpEmployeeAct.data_added+'</p>';
            tmpEmpAct += '</div>';
            tmpEmpAct += '</div>';
            tmpEmpAct += '</div>';
            tmpEmpAct += '</div>';
            tmpEmpAct += '</div>';
        
        }
        $('.activeEmploye').html(tmpEmpAct);
        var tmpEmail = tmpEmployeeAct.email;
        var tmpName = tmpEmployeeAct.name;
		var tmpEmail = localStorage.setItem("tmpEmail", tmpEmail);
       	var tmpEmail = localStorage.setItem("tmpName", tmpName);
 	}

 	// Get reply Message
 	function getReplyMessage(){
 		var empTmpReply = localStorage.getItem("tmpId");
 	 	var tmpData = new Object();
		tmpData.empTmpReply = empTmpReply;
        var settings = {
            "async": false,
            "crossDomain": true,
            "url": "chat-get-reply-message.php",
            "method": "POST",
            "processData": false,
            "data": JSON.stringify(tmpData)
        }

       var tmpResult = new Array();

        $.ajax(settings).done(function (response) {
	       var json = JSON.parse(response);

	           if(json.status == true)
	           {
	        	   tmpReplyMessage = JSON.parse(response);
	        	   
	           }
        });
        var tmpReply = '';
        for(var i=0; i<tmpReplyMessage.response.length; i++)
        {
            var tmpRep = tmpReplyMessage.response[i];

            if(tmpRep.role == "admin")
            {
                
            	if(tmpRep.reply_type == "file"){
                	tmpReply += '<div class="reply_mesage">';
            		tmpReply += '<div class="d-flex justify-content-start mb-4 msg_cont_img">';
            		tmpReply += '<img src="uploads/profile_picture/fav3 (1).ico" class="rounded-circle admin_msg_employee_img">';
            		tmpReply += '<div class="msg_cotainer_img row"><a href="uploads/tmpUploads/'+tmpRep.reply+'"><img src="uploads/tmpUploads/'+tmpRep.reply+'" alt="reply_image" class="img-reponsive chat_reply_img"/></a></div>';
//             		tmpReply += '<div class="msg_cotainer row">'+tmpRep.reply+'</div>';
            		tmpReply += '<div class="msg_time_admin_img row">'+tmpRep.date_added+'</div>';
            		tmpReply += '</div>';
            		tmpReply += '</div>';
            	}
            	else{
            		tmpReply += '<div class="reply_mesage">';
            		tmpReply += '<div class="d-flex justify-content-start mb-4 msg_cont_img">';
            		tmpReply += '<img src="uploads/profile_picture/fav3 (1).ico" class="rounded-circle admin_msg_employee_img">';
            		tmpReply += '<div class="msg_cotainer row">'+tmpRep.reply+'</div>';
            		tmpReply += '<div class="msg_time row">'+tmpRep.date_added+'</div>';
            		tmpReply += '</div>';
            		tmpReply += '</div>';
            	}
            	
            }
            else
            {
        	 	
        	 	if(tmpRep.reply_type == "file"){
        	 		tmpReply += '<div class="reply_mesage">';
            		tmpReply += '<div class="d-flex justify-content-end mb-4 user_msg_cont_img">';
//             		tmpReply += '<div class="msg_cotainer_send">'+tmpRep.reply+'</div>';
            		tmpReply += '<div class="msg_cotainer_send_img"><a href="uploads/tmpUploads/'+tmpRep.reply+'"><img src="uploads/tmpUploads/'+tmpRep.reply+'" alt="reply_image" class="img-reponsive chat_reply_img"/></a></div>';
            		tmpReply += '<div class="meg_time_send_img">'+tmpRep.date_added+'</div>';
            		tmpReply += '<img src="uploads/profile_picture/'+tmpRep.profile_image+'" class="rounded-circle user_msg_employee_img">';
            		tmpReply += '</div>';
            		tmpReply += '</div>';
        	 	}else{
        	 		tmpReply += '<div class="reply_mesage">';
            		tmpReply += '<div class="d-flex justify-content-end mb-4 user_msg_cont_img">';
            		tmpReply += '<div class="msg_cotainer_send">'+tmpRep.reply+'</div>';
            		tmpReply += '<div class="msg_time_send">'+tmpRep.date_added+'</div>';
            		tmpReply += '<img src="uploads/profile_picture/'+tmpRep.profile_image+'" class="rounded-circle user_msg_employee_img">';
            		tmpReply += '</div>';
            		tmpReply += '</div>';
        	 	}
            }
            suggestionStatus =tmpReplyMessage.response[i].status
            if(suggestionStatus === "0"){
				$('.reply_input').show();
				$('.reopen_input').hide();
			}
			else
			{
				$('.reply_input').hide();
				$('.reopen_input').show();
			}
        }
        $('.msg_card_body').html(tmpReply);

        $(".msg_card_body").animate({ scrollTop: $('.msg_card_body').height() });
     
 	}

 	// Reply from Admin
 	
 	function saveReplyUser(){
			//console.log('test');
			var empTmpReply = localStorage.getItem("tmpId");
			var subject = $('#subject').val();
			var reply_user = $('#reply_user').val();
			var reply_type = 'file';
			 var filename = '';   
  	          if($('#fileUpload').val()!='') {
  	        	  filename = $('#fileUpload').val();
  	        	var file_name = filename.match(/[^\\/]*$/)[0];
//   	        		$('#reply_user').prop('disabled', true);
  	          } 
  	          if($('#reply_user').val() != ''){
//   	        		$('#fileUpload').prop('disabled', true);
  	        		var reply_type = '';
  	          }

			var temData = new Object();
			temData.tmpEmployeeId = tmpEmployeeId;
			temData.id = empTmpReply;
			temData.role = role;
			temData.reply_type = reply_type;
			temData.reply_user = reply_user;
			temData.file_name = file_name;
			console.log(filename);
			var settings = {
					"async" : true,
					"crossDomain" : true,
					"url": "save-reply-message-user.php",
					"method" : "POST",
					"processData" : false,
					"data" : JSON.stringify(temData)
			}
			  //var tmpResult = new Array();
			
	        $.ajax(settings).done(function (response) {
	            //var json = JSON.parse(response);
// 				console.log(response);
				$('.selected_file').hide();
				sendReplyUserMail();
				
	        });
		}
	 

 	function sendReplyUserMail(){
		//console.log("test");
		var reply_user =  $('#reply_user').val();
		var empTmpId = localStorage.getItem("tmpId");
		var tmpNa = localStorage.getItem("tmpName");
		
		$('.reply_btn i').removeClass('fa-paper-plane');
		$('.reply_btn i').addClass('fa-circle-notch fa-spin');
		$('.reply_btn i').addClass('fa-spin');
		
		var tmpReply = new Object();
		tmpReply.id = empTmpId;
		tmpReply.reply_user = reply_user;
		tmpReply.tmpName = tmpNa;
		
		
		 var settings = {
				  "async": true,
				  "crossDomain": true,
				  "url": "reply-user-mail.php",
				  "method": "POST",
				  "processData": false,
				  "data": JSON.stringify(tmpReply)
				}

				$.ajax(settings).done(function (response) {

					$('.reply_btn i').addClass('fa-paper-plane');
            		$('.reply_btn i').removeClass('fa-circle-notch fa-spin');
            		$('.reply_btn i').removeClass('fa-spin');

            		$('#reply_user').val('');
            		
					getReplyMessage();

				});
	}
 	

 // Reopen Suggestions		
	 $(".reopen_suggestion").click(function(){
		 swal({
		      title: "Are you sure?",
		      text: "You will be able to recover this replies",
		      icon: "warning",
		      buttons: [
		        'No',
		        'Yes'
		      ],
		      dangerMode: true,
		    }).then(function(isConfirm) {
		      if (isConfirm) {
		        swal({
		          title: 'Reopen',
		          text: 'Suggestions Reopen successfully!!!',
		          icon: 'success'
		        }).then(function() {
		        	reopenStatus();
		        	reopenReplyMail();
		        	getReplyMessage();
		        });
		      } else {
		        //swal("Cancelled", "Your suggection replies is not closed)", "error");
		      }
		    })
			
		 });

		// Reopen Suggestion 
			function reopenStatus(){
		    	var tmpStatus = localStorage.getItem('reopenStatus');
		    	var tmpId = localStorage.getItem('tmpId');
		    	var temData = new Object();
		    	temData.tmpId = tmpId;
		    	temData.tmpStatus = tmpStatus;
		    	
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
		        	console.log(response);

		        });
		    }

		// Mail reopen suggestion
		function reopenReplyMail(){
       	var empTmpId = localStorage.getItem("tmpId");
   		var tmpEm = localStorage.getItem("tmpEmail");
   		var tmpNa = localStorage.getItem("tmpName");
       	var tmpReply = new Object();
       	tmpReply.tmpEmailId = tmpEm;
       	tmpReply.tmpName = tmpNa;
       	tmpReply.id = empTmpId;
       	
       	 var settings = {
       			  "async": true,
       			  "crossDomain": true,
       			  "url": "reopen-reply-mail-user.php",
       			  "method": "POST",
       			  "processData": false,
       			  "data": JSON.stringify(tmpReply)
       			}
       
       			$.ajax(settings).done(function (response) {
       				 console.log(response);
       			});
       	}

       	// Add New Suggestion
       	function submitSuggestionBox()
		{

			//console.log("Test");
			var subject = $('#subject').val();
			if(subject == ""){
				swal("Error", "Please Insert Your Subject !!!");
			}
			var message = $('#message').val();
			if(message == ""){
				swal("Error", "Please Insert Your Message !!!");
			}

			$('.save_btn i').removeClass('fa-paper-plane');
			$('.save_btn i').addClass('fa fa-spinner');
			$('.save_btn i').addClass('fa-spin');
			
			var tmpData = new Object();
			tmpData.employee_id = tmpEmployeeId;
			tmpData.subject = subject;
			tmpData.message = message;

	        var settings = {
	            "async": false,
	            "crossDomain": true,
	            "url": "save-suggestion-box.php",
	            "method": "POST",
	            "processData": true,
	            "data": JSON.stringify(tmpData)
	        }
	
	       // var tmpResult = new Array();
	
	        $.ajax(settings).done(function (response) {
	        	var json = JSON.parse(response);
	        	
	        	if(json.status == true){
	        		$('.save_btn i').removeClass('fa-paper-plane');
					$('.save_btn i').addClass('fa fa-spinner');
					$('.save_btn i').addClass('fa-spin');
					
// 					$('#subject').val(' ');
// 					$('#message').val(' ');
					
// 					getReplyMessage();
					sendMailSuggestionBox();
					
	        	}
	        });
		}

       	function sendMailSuggestionBox(){
			var subject =  $('#subject').val();
			var message =  $('#message').val();
			
			var tmpData = new Object();
			tmpData.subject = subject;
			tmpData.message = message;

			 var settings = {
					  "async": true,
					  "crossDomain": true,
					  "url": "suggestion-mail.php",
					  "method": "POST",
					  "processData": false,
					  "data": JSON.stringify(tmpData)
					}

					$.ajax(settings).done(function (response) {
						location.reload();
					});
		}

//     	$('.input_msg').keydown(function(){
// 				$(".reply_btn").enable();
//         	});

		function getIconName(name){
			var extension = name.substr( (name.lastIndexOf('.') +1) ).toLowerCase();
// 			var filename = localStorage.getItem(tmpFileName);
// 			console.log(filename);
    		var iconname = '';
    		switch(extension){
//         		case 'jpg':
//     	        	iconname = filename;
//     	        	break;
//     	        case 'png':
//     	        	iconname = filename;
//     	        	break;
//     	        case 'gif':
//     	        	iconname = filename;
//     	        	break;
        		case 'txt':
    	        	iconname = 'txt.png';
    	        	break;
    	        case 'doc':
    	        	iconname = 'txt.png';
    	        	break;
    	        case 'docx':
    	        	iconname = 'txt.png';
    	        	break;
    	        case 'xlsx':
    	        	iconname = 'excel.png';
    	        	break;
    	        case 'xls':
    	        	iconname = 'excel.png';
    	        	break;
    	        case 'zip':
    	        	iconname = 'zip.png';
    	        	break;
    	        case 'rar':
    	        	iconname = 'rar.png';
    	        	break;
    	        case 'pdf':
    	        	iconname = 'pdf.png';
    	        	break;
    	        default:
    	        	iconname = 'txt.png';
            		break;
    		}
    		return iconname;
		}
</script>

</body>
</html>
