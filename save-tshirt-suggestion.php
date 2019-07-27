<?php
include 'config.php';

$json = file_get_contents('php://input');

if(empty($json))
{
    return FALSE;
}

$postData = json_decode($json, true);

$output = array();

if(!isset($postData['employee_id']))
{
	$output['status'] = false;
	$output['message'] = "Please provide a valid Employee Id";
	
	json_encode($output);
	exit(0);
}

if($postData['employee_id'] == "")
{
	$output['status'] = false;
	$output['message'] = "Please provide a valid Employee Id";
	
	json_encode($output);
	exit(0);
}




if(!isset($postData['preferred_tshirt_size']))
{
	$output['status'] = false;
	$output['message'] = "Please provide a valid Preferred T-Shirt size";
	
	json_encode($output);
	exit(0);
}

if($postData['preferred_tshirt_size'] == "")
{
	$output['status'] = false;
	$output['message'] = "Please provide a valid Preferred T-Shirt size";
	
	json_encode($output);
	exit(0);
}

$tmpUserId = $postData['employee_id'];

$tmpStr = "select * from tshirt_suggestions where employee_id = '".$tmpUserId."'";
$tmpRes = mysqli_query($db, $tmpStr);
$tmpResult = mysqli_fetch_assoc($tmpRes);

if(!empty($tmpResult))
{
	$tmpStr = "update tshirt_suggestions set preferred_tshirt_size = '".$postData['preferred_tshirt_size']."' where employee_id = '".$tmpUserId."'";
	mysqli_query($db, $tmpStr);
	
	$output = array();
	$output['status'] = true;
	$output['message'] = "Thanks for your suggestions.";
	
	echo json_encode($output);
	
	exit(0);
}

//$tmpStr = "insert into tshirt_suggestions set preferred_tshirt_size = '".$postData['preferred_tshirt_size']."', employee_id = '".$tmpUserId."'";
$tmpStr = "INSERT INTO `tshirt_suggestions`(`employee_id`, `preferred_tshirt_size`) VALUES ('".$tmpUserId."', '".$postData['preferred_tshirt_size']."')";
// print_r($tmpStr);
mysqli_query($db, $tmpStr);

$output = array();
$output['status'] = true;
$output['message'] = "Thanks for your suggestions.";

echo json_encode($output);
