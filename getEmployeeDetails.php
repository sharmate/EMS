<?php
include 'config.php';

$json = file_get_contents('php://input');

if(empty($json))
{
    return FALSE;
}

$postData = json_decode($json, true);

 $tmpUserId = $postData['userid'];

$tmpStr = "select employee_id, name, email, contact, role from employee where employee_id = '".$tmpUserId."'";
$tmpRes = mysqli_query($db, $tmpStr);
$tmpResult = mysqli_fetch_assoc($tmpRes);

if(empty($tmpResult))
{
	$output = array();
	$output['status'] = false;
	$output['message'] = "Employee Not Found";
	
	echo json_encode($output);
	
	exit(0);
}

$output = array();
$output['status'] = true;
$output['response']= $tmpResult;

echo json_encode($output);
