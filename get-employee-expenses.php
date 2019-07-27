<?php
include 'config.php';

$json = file_get_contents('php://input');

if(empty($json))
{
    return FALSE;
}

$postData = json_decode($json, true);

$tmpUserId = $postData['userid'];
$tmpMonth = $postData['month'];
$tmpYear = $postData['year'];

$tmpStr = "select * from employee_expenses where month='".$tmpMonth."' AND year='".$tmpYear."' AND userid='".$tmpUserId."'";
$tmpRes = mysqli_query($db, $tmpStr);
$tmpResult = mysqli_fetch_assoc($tmpRes);

if(empty($tmpResult))
{
	$output = array();
	$output['status'] = false;
	$output['message'] = "No Records Found";
	
	echo json_encode($output);
	
	return false;
}

$output = array();
$output['status'] = true;
$output['response'] = $tmpResult;

echo json_encode($output);
