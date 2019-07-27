<?php
error_reporting(E_ALL ^ E_NOTICE);
include 'config.php';
include 'session.php';
$json = file_get_contents('php://input');

if(empty($json))
{
    return FALSE;
}

$postData = json_decode($json, true);
 print_r($postData);
// die;


$output = array();

if(!isset($postData['tmpEmployeeId']))
{
	$output['status'] = false;
	$output['message'] = "Please provide a valid Employee Id";
	
	json_encode($output);
	exit(0);
}

if($postData['tmpEmployeeId'] == "")
{
	$output['status'] = false;
	$output['message'] = "Please provide a valid Employee Id";
	
	json_encode($output);
	exit(0);
}

$filename = ($postData['file_name']!='') ? rtrim($postData['file_name'],',') : $filename = $postData['file_name'];

$tmpUserId = $postData['tmpEmployeeId'];
$temId= $postData['id'];

if($postData['reply_type'] == "file"){
    $tmpStr = "INSERT INTO `reply_message`(`tmpEmployeeId`, `id`, `reply`, `reply_type`, `role`) VALUES ('".$tmpUserId."', '".$temId."', '".$filename."', '".$postData['reply_type']."', '".$postData['role']."')";
}
else{
    $tmpStr = "INSERT INTO `reply_message`(`tmpEmployeeId`, `id`, `reply`, `role`) VALUES ('".$tmpUserId."', '".$temId."', '".$postData['reply_user']."', '".$postData['role']."')";
}

mysqli_query($db, $tmpStr);

$output = array();
$output['status'] = true;
$output['message'] = "Thanks for your Reply.";

echo json_encode($output);
