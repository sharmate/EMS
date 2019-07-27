<?php
include 'config.php';

$json = file_get_contents('php://input');

if(empty($json))
{
    return FALSE;
}

//print_r($json);

$postData = json_decode($json, true);
// print_r($postData);die;
$tmpExpenses = json_encode($postData['expenses']);
$tmpUserId = $postData['userid'];
$tmpMonth = $postData['month'];
$tmpYear = $postData['year'];
$isFinal = $postData['is_final'];
$filename = ($postData['filename']!='') ? rtrim($postData['filename'],',') : $filename = $postData['filename'];

$tmpStr = "select * from employee_expenses where month='".$tmpMonth."' AND year='".$tmpYear."' AND userid='".$tmpUserId."'";
$tmpRes = mysqli_query($db, $tmpStr);
$tmpResult = mysqli_fetch_assoc($tmpRes);

if(!empty($tmpResult))
{
    $tmpStr = "update employee_expenses set is_final = '".$isFinal."', expenses='".$tmpExpenses."', date_updated='".date("Y-m-d h:is:s")."', files='".$filename."' where id = '".$tmpResult['id']."'";
}
else {
    $tmpStr = "insert into employee_expenses set is_final = '".$isFinal."', userid = '".$tmpUserId."', month='".$tmpMonth."', year='".$tmpYear."', expenses='".$tmpExpenses."', files='".$filename."'";
}

mysqli_query($db, $tmpStr);

$output = array();
$output['status'] = true;
$output['message'] = "Expenses Updated Successfully.";

echo json_encode($output);
