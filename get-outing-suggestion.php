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

$tmpUserId = $postData['employee_id'];

$tmpStr = "select * from annual_outing_suggestions where employee_id = '".$tmpUserId."'";
$tmpRes = mysqli_query($db, $tmpStr);
$tmpResult = mysqli_fetch_assoc($tmpRes);

if(empty($tmpResult))
{
	$output = array();
	$output['status'] = false;
	$output['message'] = "No Record Found";
	
	echo json_encode($output);
	
	exit(0);
}

$output = array();
$output['status'] = true;
$output['response'] = $tmpResult;

echo json_encode($output);
