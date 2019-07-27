<?php
include 'config.php';

$json = file_get_contents('php://input');

if(empty($json))
{
    return FALSE;
}

//print_r($json);

$postData = json_decode($json, true);
$tmpAttendance = json_encode($postData['attendance']);
$tmpUserId = $postData['userid'];
$tmpMonth = $postData['month'];
$tmpYear = $postData['year'];

$tmpStr = "select * from employee_attendance where month='".$tmpMonth."' AND year='".$tmpYear."' AND userid='".$tmpUserId."'";
$tmpRes = mysqli_query($db, $tmpStr);
$tmpResult = mysqli_fetch_assoc($tmpRes);

if(!empty($tmpResult))
{
    $tmpStr = "update employee_attendance set attendance='".$tmpAttendance."' where id = '".$tmpResult['id']."'";
}
else {
    $tmpStr = "insert into employee_attendance set userid = '".$tmpUserId."', month='".$tmpMonth."', year='".$tmpYear."', attendance='".$tmpAttendance."'";
}

mysqli_query($db, $tmpStr);

$output = array();
$output['status'] = true;
$output['message'] = "Attendance Updated Successfully.";

echo json_encode($output);
