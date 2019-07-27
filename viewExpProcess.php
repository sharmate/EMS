<?php
include 'config.php';

$json = file_get_contents('php://input');

if(empty($json))
{
    return FALSE;
}

//print_r($json);

$postData = json_decode($json, true);

print_r($postData);
//$tmpAttendance = json_encode($postData['attendance']);
 $tmpUserId = $postData['userid'];
 $tmpMonth = $postData['month'];
 $tmpYear = $postData['year'];

$tmpStr = "select ea.*, employee.name as employee_name from employee_expenses as ea, employee where ea.month='".$tmpMonth."' AND ea.year='".$tmpYear."' AND ea.userid='".$tmpUserId."' AND employee.employee_id = ea.userid";
$tmpRes = mysqli_query($db, $tmpStr);
$tmpResult = mysqli_fetch_assoc($tmpRes);


//echo $tmpStr;

// print_r($tmpResult);




// if(!empty($tmpResult))
// {
//     $tmpStr = "update employee_attendance set attendance='".$tmpAttendance."' where id = '".$tmpResult['id']."'";
// }
// else {
//     $tmpStr = "insert into employee_attendance set userid = '".$tmpUserId."', month='".$tmpMonth."', year='".$tmpYear."', attendance='".$tmpAttendance."'";
// }

if(empty($tmpResult))
{
    $output = array();
    $output['status'] = false;
    $output['message'] = "Employee Expenses Not found.";
    
    echo json_encode($output);
    
    return false;
}


$output = array();
$output['status'] = true;
$output['response']= $tmpResult;
$output['message'] = "Expenses View Successfully.";

echo json_encode($output);
