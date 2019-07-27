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

/*if(!isset($postData['outing_option']))
{
	$output['status'] = false;
	$output['message'] = "Please provide a valid Outing Option";
	
	json_encode($output);
	exit(0);
}

if($postData['outing_option'] == "")
{
	$output['status'] = false;
	$output['message'] = "Please provide a valid Outing Option";
	
	json_encode($output);
	exit(0);
}

if(!isset($postData['preferred_location']))
{
	$output['status'] = false;
	$output['message'] = "Please provide a valid Preferred Location";
	
	json_encode($output);
	exit(0);
}

if($postData['preferred_location'] == "")
{
	$output['status'] = false;
	$output['message'] = "Please provide a valid Preferred Location";
	
	json_encode($output);
	exit(0);
}

if(!isset($postData['preferred_month']))
{
	$output['status'] = false;
	$output['message'] = "Please provide a valid Preferred Month";
	
	json_encode($output);
	exit(0);
}

if($postData['preferred_month'] == "")
{
	$output['status'] = false;
	$output['message'] = "Please provide a valid Preferred Month";
	
	json_encode($output);
	exit(0);
}*/

$tmpUserId = $postData['employee_id'];

$tmpStr = "select * from annual_outing_suggestions where employee_id = '".$tmpUserId."'";
$tmpRes = mysqli_query($db, $tmpStr);
$tmpResult = mysqli_fetch_assoc($tmpRes);

if(!empty($tmpResult))
{
	$tmpStr = "update annual_outing_suggestions set days_option = '".$postData['outing_option']."', 
				preferred_location='".$postData['preferred_location']."', confirmation_status='".$postData['confirmation_status']."', preferred_month='".$postData['preferred_month']."' where employee_id = '".$tmpUserId."'";
	mysqli_query($db, $tmpStr);
	
	$output = array();
	$output['status'] = true;
	$output['message'] = "Thanks for your suggestions.";
	
	echo json_encode($output);
	
	exit(0);
}

$tmpStr = "insert into annual_outing_suggestions set days_option = '".$postData['outing_option']."',
				preferred_location='".$postData['preferred_location']."', confirmation_status='".$postData['confirmation_status']."', preferred_month='".$postData['preferred_month']."', employee_id = '".$tmpUserId."'";
mysqli_query($db, $tmpStr);

$output = array();
$output['status'] = true;
$output['message'] = "Thanks for your suggestions.";

echo json_encode($output);
