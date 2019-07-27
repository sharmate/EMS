<?php
error_reporting(E_ALL ^ E_NOTICE);
include 'session.php';
include 'config.php';

	$userid = $_SESSION['login_userid'];
	
	$file_array= explode('.',$_FILES['files']['name'][0]);
	$length = sizeof($file_array);
	$file_ext = $file_array[$length - 1];
	
	$file_name = '';
	for($i=0;$i<$length-1;$i++) {
		$file_name .= $file_array[$i];
	}
	$file_name .= time();
	$file_name .= '.'.$file_ext;
	
	if (!file_exists('uploads/expanses/'.$userid)) {
		mkdir('uploads/expanses/'.$userid, 0777, true);
	}
    if(!move_uploaded_file($_FILES['files']['tmp_name'][0], 'uploads/expanses/'.$userid.'/'.$file_name)){
        echo 'error';
    }
    echo $file_name;
?>

