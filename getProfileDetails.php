<?php
include 'config.php';

$json = file_get_contents('php://input');

if(empty($json))
{
    return FALSE;
}

$postData = json_decode($json, true);

 $tmpUserId = $postData['userid'];

$tmpStr = "select * from employee_details where userid = '".$tmpUserId."'";
$tmpRes = mysqli_query($db, $tmpStr);
$tmpResult = mysqli_fetch_assoc($tmpRes);

$output = array();
if(empty($tmpResult))
{
	$output['status'] = false;
	$output['message'] = "No details Found";
} else {
	$output['status'] = true;
	$output['response']= $tmpResult;
}


echo json_encode($output);
