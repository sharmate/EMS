<?php
include 'config.php';

$json = file_get_contents('php://input');

if(empty($json))
{
    return FALSE;
}

$postData = json_decode($json, true);

$output = array();
$tmpStr = "INSERT INTO `enable_attendance_month`(`month`, `year`) VALUES ('".$postData['month']."', '".$postData['year']."')";
// print_r($tmpStr);
mysqli_query($db, $tmpStr);

$output = array();
$output['status'] = true;
$output['message'] = "Thanks for your suggestions.";

echo json_encode($output);
