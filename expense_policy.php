<?php
//error_reporting(0);

include('session.php');


require_once './inc/common-functions.php';
function read_docx($filename){
    
    $striped_content = '';
    $content = '';
    
    if(!$filename || !file_exists($filename)) return false;
    
    $zip = zip_open($filename);
    if (!$zip || is_numeric($zip)) return false;
    
    while ($zip_entry = zip_read($zip)) {
        
        if (zip_entry_open($zip, $zip_entry) == FALSE) continue;
        
        if (zip_entry_name($zip_entry) != "word/document.xml") continue;
        
        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));
        
        zip_entry_close($zip_entry);
    }
    zip_close($zip);
    $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
    $content = str_replace('</w:r></w:p>', "\r\n", $content);
    $striped_content = strip_tags($content);
    
    return $striped_content;
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

    <title>Expense Policy | EMS</title>
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    
    
     <link href="external/google-code-prettify/prettify.css" rel="stylesheet">
<!--     <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-combined.no-icons.min.css" rel="stylesheet"> -->
    <link href="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/css/bootstrap-responsive.min.css" rel="stylesheet">
		<link href="http://netdna.bootstrapcdn.com/font-awesome/3.0.2/css/font-awesome.css" rel="stylesheet">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
		<script src="external/jquery.hotkeys.js"></script>
    <script src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.3.1/js/bootstrap.min.js"></script>
    <script src="external/google-code-prettify/prettify.js"></script>
		<link href="index.css" rel="stylesheet">
    <script src="bootstrap-wysiwyg.js"></script>
   
   <style>
   .wd
   {
   width:100px;
   float: unset;
   }
   img
   {
   width:80%;
   }
   </style>
</head>

<body>

    <div id="wrapper"  class="Background-side-bar">
        <!-- Navigation -->
        <?php include 'header.php';?>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="header-top employee-list-header">
                    <?php 
                        
                            if($_SESSION['role'] == "admin")
                            {
                         ?>
<!--                                 <a href="tshirt-suggestions-admin.php" class="back-arrow"><i class="fa fa-arrow-left"></i></a> -->
                           <?php 
                            }
                         
                            else
                            {
                            ?>
<!--                                 <a href="add.php" class="back-arrow"><i class="fa fa-arrow-left"></i></a> -->
                                
                            <?php 
                            }
                            
                            ?>
                    
                                <i class="fa fa-user"></i>&nbsp;<?php echo strtoupper($row['name']);?>
                           
                                    
                   
                    </h1>
                    <hr/>
                </div>
                
               
                
                
                
                  <?php 
                        
                            if($_SESSION['role'] == "admin")
                            {
                         ?>
		
<div class="container">

  <div class="hero-unit">
  
  <div class="pull-right expense_policy_admin_table">
	<div>
                        	<h2 class="header-expense expense_policy_header">Expense Policy</h2>

                        </div>
                        
                        <br>
                       
	<div id="alerts"></div>
    <div class="btn-toolbar btn_toobar"  data-role="editor-toolbar" data-target="#editor">
      <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font"><i class="icon-font"></i><b class="caret"></b></a>
          <ul class="dropdown-menu">
          </ul>
        </div>
      <div class="btn-group">
        <a class="btn dropdown-toggle" data-toggle="dropdown" title="Font Size"><i class="icon-text-height"></i>&nbsp;<b class="caret"></b></a>
          <ul class="dropdown-menu">
          <li><a data-edit="fontSize 5"><font size="5">Huge</font></a></li>
          <li><a data-edit="fontSize 3"><font size="3">Normal</font></a></li>
          <li><a data-edit="fontSize 1"><font size="1">Small</font></a></li>
          </ul>
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="bold" title="Bold (Ctrl/Cmd+B)"><i class="icon-bold"></i></a>
        <a class="btn" data-edit="italic" title="Italic (Ctrl/Cmd+I)"><i class="icon-italic"></i></a>
        <a class="btn" data-edit="strikethrough" title="Strikethrough"><i class="icon-strikethrough"></i></a>
        <a class="btn" data-edit="underline" title="Underline (Ctrl/Cmd+U)"><i class="icon-underline"></i></a>
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="insertunorderedlist" title="Bullet list"><i class="icon-list-ul"></i></a>
        <a class="btn" data-edit="insertorderedlist" title="Number list"><i class="icon-list-ol"></i></a>
        <a class="btn" data-edit="outdent" title="Reduce indent (Shift+Tab)"><i class="icon-indent-left"></i></a>
        <a class="btn" data-edit="indent" title="Indent (Tab)"><i class="icon-indent-right"></i></a>
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="justifyleft" title="Align Left (Ctrl/Cmd+L)"><i class="icon-align-left"></i></a>
        <a class="btn" data-edit="justifycenter" title="Center (Ctrl/Cmd+E)"><i class="icon-align-center"></i></a>
        <a class="btn" data-edit="justifyright" title="Align Right (Ctrl/Cmd+R)"><i class="icon-align-right"></i></a>
        <a class="btn" data-edit="justifyfull" title="Justify (Ctrl/Cmd+J)"><i class="icon-align-justify"></i></a>
      </div>
      <div class="btn-group">
		  <a class="btn dropdown-toggle" data-toggle="dropdown" title="Hyperlink"><i class="icon-link"></i></a>
		    <div class="dropdown-menu input-append">
			    <input class="span2" placeholder="URL" type="text" data-edit="createLink"/>
			    <button class="btn" type="button">Add</button>
        </div>
        <a class="btn" data-edit="unlink" title="Remove Hyperlink"><i class="icon-cut"></i></a>

      </div>
      
      <div class="btn-group">
        <a class="btn" title="Insert picture (or just drag & drop)" id="pictureBtn"><i class="icon-picture"></i></a>
        <input type="file" data-role="magic-overlay" data-target="#pictureBtn" data-edit="insertImage" />
      </div>
      <div class="btn-group">
        <a class="btn" data-edit="undo" title="Undo (Ctrl/Cmd+Z)"><i class="icon-undo"></i></a>
        <a class="btn" data-edit="redo" title="Redo (Ctrl/Cmd+Y)"><i class="icon-repeat"></i></a>
      </div>
      <input type="text" data-edit="inserttext" id="voiceBtn" x-webkit-speech="">
    </div>

    <div id="editor" class="editer-view">
     <?php
    	if(isset($_SESSION['file']))
    	{
    	if($_SESSION['file']!=""&&$_SESSION['file']!=null)
    	{
    	$my_file =$_SESSION['file'];
     	echo $my_file;
    	}
    	}
    	else 
    	{
    	   
    	    $result = mysqli_query($db, "select expense_policy from expense_policy");
    	    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    	    
    	    print_r($row['expense_policy']);
    	}
    
       ?>
    </div>
    
    <div class="form-group">
        <button type="submit" class="btn btn-success btn-lg" id="savebtn">Submit</button>

    </div>
  </div>

</div>
</div>
                
                
              </div>
            </div>
         
        </div>
        
        <?php 
                            }
                            else {
                               
        ?>
        
        <div class="container" >
        <h2 class="header-expense">Expense Policy</h2>
        	<div class="view-data">
                <?php 
                
                $result = mysqli_query($db, "select expense_policy from expense_policy");
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                
                print_r($row['expense_policy']);
                ?>
            </div>
        </div>
        
        <?php 
                            
                            
                            }?>
    <!-- /#wrapper -->
	
	<!-- Footer -->
	<section class="footer-div-expense">
    	<div class="container footer_expense_policy">
    		<div class="row">
    			 <p class="text-center footer-copyright">&copy; Copyright <?php echo date("Y");?> All rights reserved to TYASuite Software Solutions Pvt. Ltd.</p>
    		</div>
    	</div>
    </section> 
<!-- Footer -->
    <!-- jQuery -->

    <!-- Bootstrap Core JavaScript -->

    <!-- Metis Menu Plugin JavaScript -->
    <script src="./vendor/metisMenu/metisMenu.min.js"></script>

    <!-- Morris Charts JavaScript -->
    <script src="./vendor/raphael/raphael.min.js"></script>
  
<script>
  $(function(){
    function initToolbarBootstrapBindings() {
      var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier', 
            'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
            'Times New Roman', 'Verdana'],
            fontTarget = $('[title=Font]').siblings('.dropdown-menu');
      $.each(fonts, function (idx, fontName) {
          fontTarget.append($('<li><a data-edit="fontName ' + fontName +'" style="font-family:\''+ fontName +'\'">'+fontName + '</a></li>'));
      });
      $('a[title]').tooltip({container:'body'});
    	$('.dropdown-menu input').click(function() {return false;})
		    .change(function () {$(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');})
        .keydown('esc', function () {this.value='';$(this).change();});

      $('[data-role=magic-overlay]').each(function () { 
        var overlay = $(this), target = $(overlay.data('target')); 
        overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
      });
      if ("onwebkitspeechchange"  in document.createElement("input")) {
        var editorOffset = $('#editor').offset();
        $('#voiceBtn').css('position','absolute').offset({top: editorOffset.top, left: editorOffset.left+$('#editor').innerWidth()-35});
      } else {
        $('#voiceBtn').hide();
      }
	};
	function showErrorAlert (reason, detail) {
		var msg='';
		if (reason==='unsupported-file-type') { msg = "Unsupported format " +detail; }
		else {
			console.log("error uploading file", reason, detail);
		}
		$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>'+ 
		 '<strong>File upload error</strong> '+msg+' </div>').prependTo('#alerts');
	};
    initToolbarBootstrapBindings();  
	$('#editor').wysiwyg({ fileUploadError: showErrorAlert} );
    window.prettyPrint && prettyPrint();
  });
</script>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-37452180-6', 'github.io');
  ga('send', 'pageview');
</script>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "http://connect.facebook.net/en_GB/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));
 </script>

<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="http://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>




    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    
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
	   		
		
	});

   	   		
   		
//     	});
   	 


		function getEmployeeDetails()
		{
			console.log("test");
			
// 			var tmpData = new Object();
// 			tmpData.userid = tmpEmployeeId;
	          
// 	        var settings = {
// 	            "async": false,
// 	            "crossDomain": true,
// 	            "url": "getEmployeeDetails.php",
// 	            "method": "POST",
// 	            "processData": false,
// 	            "data": JSON.stringify(tmpData)
// 	        }
	
// 	        var tmpResult = new Array();
	
// 	        $.ajax(settings).done(function (response) {
// 	            var json = JSON.parse(response);
	
// 	            if(json.status && json.status == true)
// 	            {
// 	            	var employeeName = '';
	
// 	            	tmpUser = json.response;
// 	                if(json.response.name && json.response.name !== "")
// 	                {
// 	               	 employeeName = json.response.name;
// 	                }
// 					console.log(employeeName);
// 	                $('.user-title').html(employeeName);
// 	            }
// 	        });
	
		}

// 		$('#uploadimgform').on('submit',function(e) {
//             e.preventDefault();
//             var formData = new FormData(this);
//             if(policy_file=="")
//             {
//         	 swal('Error', "Please enter choose docx file", "error");

//        	       return false;

//             }

            $.ajax({
                type:'POST',
                url: $(this).attr('action'),
                data:formData,
                cache:false,
                contentType: false,
                processData: false,
                success:function(data){

                    console.log(data)
                   
                    if(data== 'success') {
                        swal('Success',"File Uploaded Successfully", "success");
                        window.location='';
                        
                    } else {
                        console.log(data);
                        swal('Error', data , "error");
                        window.location='';
                    }        
                },
                error: function(data){
                    console.log(data);
                }
            });
        });
	

		
</script>
    

<script>



      $('#savebtn').click(function(){

        
  		
  			
  			var content=$("#editor").html();
//   			console.log(content);

          if(content=="")
          {
        	  swal('Error', "Please enter content", "error");

        	  return false;
          }

         
          var tmpData = new Object();
       
          tmpData.content = content;
          tmpData.addedby="1";
        

          var settings = {
          		  "async": true,
          		  "crossDomain": true,
          		  "url": "savepolicy.php",
          		  "method": "POST",
          		  "processData": false,
          		  "data": JSON.stringify(tmpData)
          		}

         

  		$.ajax(settings).done(function (response) {
  			 var json =response;
  			 console.log(json)
  		     if(json.status)
  		    {
  		      swal('Success',json.msg, "success");
  		    }
  		    else
  		    {
  		  		swal('Error',json.msg, "error");
  		    }

	  		 
  		});
  	});
      
    	</script>
</body>

</html>
