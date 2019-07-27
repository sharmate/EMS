<?php
include 'config.php';

$json = file_get_contents('php://input');

if(empty($json))
{
    return FALSE;
}

$postData = json_decode($json, true);

$output = array();
$tmpStr = "INSERT INTO `filter_expense_current_employee`(`month`, `year`) VALUES ('".$postData['month']."', '".$postData['year']."')";
// print_r($tmpStr);
mysqli_query($db, $tmpStr);

$output = array();
$output['status'] = true;
$output['message'] = "Thanks you.";

echo json_encode($output);
