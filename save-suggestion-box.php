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




if(!isset($postData['subject']))
{
	$output['status'] = false;
	$output['message'] = "Please Insert Your Subject";
	
	json_encode($output);
	exit(0);
}

if($postData['subject'] == "")
{
	$output['status'] = false;
	$output['message'] = "Please Insert Your Subject";
	
	json_encode($output);
	exit(0);
}
if(!isset($postData['message']))
{
    $output['status'] = false;
    $output['message'] = "Please Insert Your Message";
    
    json_encode($output);
    exit(0);
}

if($postData['message'] == "")
{
    $output['status'] = false;
    $output['message'] = "Please Insert Your Message";
    
    json_encode($output);
    exit(0);
}
$tmpUserId = $postData['employee_id'];
//$tmpId = $postData['id'];
$status = 0;

// $tmpStr = "select * from suggestion_box where id = '".$tmpId."'";
// $tmpRes = mysqli_query($db, $tmpStr);
// $tmpResult = mysqli_fetch_assoc($tmpRes);

// if(!empty($tmpResult))
// {
// 	$tmpStr = "update tshirt_suggestions set preferred_tshirt_size = '".$postData['preferred_tshirt_size']."' where employee_id = '".$tmpUserId."'";
// 	mysqli_query($db, $tmpStr);
	
// 	$output = array();
// 	$output['status'] = true;
// 	$output['message'] = "Thanks for your suggestions.";
	
// 	echo json_encode($output);
	
// 	exit(0);
// }

$tmpStr = "INSERT INTO `suggestion_box`(`employee_id`, `subject`, `message`, `status`) VALUES ('".$tmpUserId."', '".$postData['subject']."', '".$postData['message']."', '".$status."')";
mysqli_query($db, $tmpStr);

$tmpStr = "select max(id) as last_suggestion_id from suggestion_box";
$tmpRes = mysqli_query($db, $tmpStr);
$tmpResult = mysqli_fetch_assoc($tmpRes);

if(!empty($tmpResult))
{
    $lastSuggestionId = $tmpResult['last_suggestion_id'];
    
    $tmpStr = "INSERT INTO `reply_message`(`tmpEmployeeId`, `id`, `reply`, `role`) VALUES ('".$tmpUserId."', '".$lastSuggestionId."', '".$postData['message']."', 'user')";
    mysqli_query($db, $tmpStr);
}

$output = array();
$output['status'] = true;
$output['message'] = "Thanks for your suggestions.";

echo json_encode($output);
