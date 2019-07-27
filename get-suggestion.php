<?php
include 'config.php';

$json = file_get_contents('php://input');
//echo 'test';
if(empty($json))
{
    return FALSE;
}

$postData = json_decode($json, true);
// print_r($postData);
// print_r('test');
// die;
$output = array();

if(!isset($postData['id']))
{
	$output['status'] = false;
	$output['message'] = "Please provide a valid Id";
	
	json_encode($output);
	exit(0);
}

if($postData['id'] == "")
{
	$output['status'] = false;
	$output['message'] = "Please provide a valid Id";
	
	json_encode($output);
	exit(0);
}

$tmpUserId = $postData['id'];

$tmpStr = "SELECT * FROM `suggestion_box` WHERE id='".$tmpUserId."'";
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
