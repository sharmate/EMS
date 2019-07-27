<?php
error_reporting(E_ALL ^ E_NOTICE);
include 'session.php';
include 'config.php';

	$userid = $_SESSION['login_userid'];
   if(isset($_FILES['image'])){
      $errors= array();
      //$file_name = $_FILES['image']['name'];
      $file_size =$_FILES['image']['size'];
      $file_tmp =$_FILES['image']['tmp_name'];
      $file_type=$_FILES['image']['type'];
      $file_array= explode('.',$_FILES['image']['name']);
      $length = sizeof($file_array);
      $file_ext = $file_array[$length - 1];
      
      $file_name = '';
      for($i=0;$i<$length-1;$i++) {
      	$file_name .= $file_array[$i];
      }
      $file_name .= time();
      $file_name .= '.'.$file_ext;
      
      $expensions= array("jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152){
         $errors[]='File size must be excately 2 MB';
      }
      $output = array();
      if(empty($errors)==true){
      	 if (!file_exists('uploads/profile_picture/')) {
      		 mkdir('uploads/profile_picture/', 0777, true);
      	 }
         move_uploaded_file($file_tmp,"uploads/profile_picture/".$file_name);
		 $output['status'] = true;
		 $output['message']= 'success';
		 $output['image_name']= $file_name;
      }else{
      	 $output['status'] = false;
      	 $output['message']= $errors[0];
      }
      if($output['status']) {
      	
      	$tmpStr = "select id from employee_details where userid = '".$userid."'";
      	$tmpRes = mysqli_query($db, $tmpStr);
      	$tmpResult = mysqli_fetch_assoc($tmpRes);
      	
      	if(empty($tmpResult)) {
      		$tmpStr = "insert into employee_details (userid,profile_image,added_by,updated_by) values('".$userid."','".$file_name."','".$userid."','".$userid."')";
      	} else {
      		$tmpStr = "update employee_details set profile_image='".$file_name."',updated_by='".$userid."' where userid='".$userid."'";
      	}
      	mysqli_query($db, $tmpStr);
      }
      echo json_encode($output);
   }
?>