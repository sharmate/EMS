<?php
include 'config.php';
$json = file_get_contents('php://input');
if(empty($json))
{
    return FALSE;
}
$postData = json_decode($json, true);
// $employeeId = $postData['tmpEmployeeId'];
// echo $employeeId;

$tmpStr = "SELECT aos.*, bos.*, employee_details.profile_image FROM suggestion_box as aos, employee as bos, employee_details WHERE
 aos.employee_id=employee_details.userid AND employee_details.userid= bos.employee_id AND aos.employee_id='".$postData['tmpEmployeeId']."'";
// echo $tmpStr;
// $tmpResult = mysqli_fetch_array($tmpRes);
if(isset($_POST["search"]["value"]))
{
    $tmpStr .= ' AND aos.subject LIKE "%'.$_POST["search"]["value"].'%"';
}

$tmpStr .= ' ORDER BY aos.id DESC';
$tmpRes = mysqli_query($db, $tmpStr);
$tmpData = array();
while ($tmpResult = mysqli_fetch_assoc($tmpRes)) {
    if(empty($tmpResult))
    {
        $output = array();
        $output['status'] = false;
        $output['message'] = "No Record Found";
        
        //echo json_encode($output);
        
        continue;
    }
    
    
    array_push($tmpData, $tmpResult);
    
}

$output = array();
$output['status'] = true;
$output['response'] = $tmpData;
echo json_encode($output);