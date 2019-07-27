<?php
include 'config.php';

$json = file_get_contents('php://input');

if(empty($json))
{
    return FALSE;
}

$postData = json_decode($json, true);
// print_r($postData);
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


$tmpUserId = $postData['tmpEmployeeId'];
$temId= $postData['id'];

$filename = ($postData['file_name']!='') ? rtrim($postData['file_name'],',') : $filename = $postData['file_name'];

if($postData['reply_type'] == "file"){
    $tmpStr = "INSERT INTO `reply_message`(`tmpEmployeeId`, `id`, `reply`, `reply_type`, `role`) VALUES ('".$tmpUserId."', '".$temId."', '".$filename."', '".$postData['reply_type']."', '".$postData['role']."')";
}
else{
    $tmpStr = "INSERT INTO `reply_message`(`tmpEmployeeId`, `id`, `reply`, `role`) VALUES ('".$tmpUserId."', '".$temId."', '".$postData['reply_admin']."', '".$postData['role']."')";
    
}

mysqli_query($db, $tmpStr);

$output = array();
$output['status'] = true;
$output['message'] = "Thanks for your Reply.";

echo json_encode($output);
