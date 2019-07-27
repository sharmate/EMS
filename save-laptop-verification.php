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
if(!isset($postData['dateOfIssue']))
{
    $output['status'] = false;
    $output['message'] = "Please Insert Date of Issue";
    
    json_encode($output);
    exit(0);
}

if($postData['dateOfIssue'] == "")
{
    $output['status'] = false;
    $output['message'] = "Please Insert Date of Issue";
    
    json_encode($output);
    exit(0);
}
if(!isset($postData['model_company']))
{
    $output['status'] = false;
    $output['message'] = "Please Insert Company Model Name";
    
    json_encode($output);
    exit(0);
}

if($postData['model_company'] == "")
{
    $output['status'] = false;
    $output['message'] = "Please Insert Company Model Name";
    
    json_encode($output);
    exit(0);
}
if(!isset($postData['model_id']))
{
    $output['status'] = false;
    $output['message'] = "Please Insert Model ID";
    
    json_encode($output);
    exit(0);
}

if($postData['model_id'] == "")
{
    $output['status'] = false;
    $output['message'] = "Please Insert Model ID";
    
    json_encode($output);
    exit(0);
}
if(!isset($postData['serial_no']))
{
    $output['status'] = false;
    $output['message'] = "Please Insert Serial Number";
    
    json_encode($output);
    exit(0);
}

if($postData['serial_no'] == "")
{
    $output['status'] = false;
    $output['message'] = "Please Insert Serial Number";
    
    json_encode($output);
    exit(0);
}
if(!isset($postData['ram_info']))
{
    $output['status'] = false;
    $output['message'] = "Please Insert RAM Information";
    
    json_encode($output);
    exit(0);
}

if($postData['ram_info'] == "")
{
    $output['status'] = false;
    $output['message'] = "Please Insert RAM Information";
    
    json_encode($output);
    exit(0);
}
if(!isset($postData['hard_drive']))
{
    $output['status'] = false;
    $output['message'] = "Please Insert RAM Information";
    
    json_encode($output);
    exit(0);
}

if($postData['hard_drive'] == "")
{
    $output['status'] = false;
    $output['message'] = "Please Insert RAM Information";
    
    json_encode($output);
    exit(0);
}
if(!isset($postData['processor']))
{
    $output['status'] = false;
    $output['message'] = "Please Insert RAM Information";
    
    json_encode($output);
    exit(0);
}

if($postData['processor'] == "")
{
    $output['status'] = false;
    $output['message'] = "Please Insert RAM Information";
    
    json_encode($output);
    exit(0);
}
if(!isset($postData['condition']))
{
    $output['status'] = false;
    $output['message'] = "Please Select Condition";
    
    json_encode($output);
    exit(0);
}

if($postData['condition'] == "")
{
    $output['status'] = false;
    $output['message'] = "Please Select Condition";
    
    json_encode($output);
    exit(0);
}




    $tmpUserId = $postData['employee_id'];
    
    $filename = ($postData['filename']!='') ? rtrim($postData['filename'],',') : $filename = $postData['filename'];
    
    $tmpStr = "select * from laptop_verification where employee_id = '".$tmpUserId."'";
    $tmpRes = mysqli_query($db, $tmpStr);
    $tmpResult = mysqli_fetch_assoc($tmpRes);


    $tmpStr = "INSERT INTO `laptop_verification`(`employee_id`, `laptop_allowcated`, `dateOfIssue`, `model_company`, `model_id`, `serial_no`, `condition`, `issue_text`, `ram_info`, `hard_drive`, `processor`, `laptop_file`)
     VALUES ('".$postData['employee_id']."','".$postData['laptop_allowcated']."', '".$postData['dateOfIssue']."','".$postData['model_company']."','".$postData['model_id']."','".$postData['serial_no']."','".$postData['condition']."','".$postData['issue_text']."','".$postData['ram_info']."','".$postData['hard_drive']."','".$postData['processor']."', '".$filename."')";
    mysqli_query($db, $tmpStr);
    
    $output = array();
    $output['status'] = true;
    $output['message'] = "Thanks for submitted details.";
    
    echo json_encode($output);
