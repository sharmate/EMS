<?php
include 'config.php';

$json = file_get_contents('php://input');
if(empty($json))
{
    return FALSE;
}
$postData = json_decode($json, true);

$tmpId = $postData['empTmpReply'];
$tmpStr = "SELECT aos.*, bos.*, employee_details.profile_image FROM suggestion_box AS aos, reply_message AS bos, 
            employee_details, employee WHERE aos.employee_id=employee_details.userid AND aos.id= bos.id AND bos.id='".$tmpId."' 
            AND employee.employee_id = aos.employee_id";

// $tmpResult = mysqli_fetch_array($tmpRes);

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