<?php
include 'config.php';

$json = file_get_contents('php://input');
if(empty($json))
{
    return FALSE;
}   
$postData = json_decode($json, true);

$tmpId = $postData['id'];
// print_r($tmpId);
// die;
// if(status == 1){
//     $tmpStr1 = "UPDATE reply_message,suggestion_box SET reply_message.status='".$postData['statusId']."',suggestion_box.status='".$postData['statusId']."' WHERE reply_message.$tmpId=suggestion_box.$tmpId";
    
//     $tmpRes1 = mysqli_query($db, $tmpStr1);
//     if(empty($tmpRes1))
//     {
//         $output = array();
//         $output['status'] = false;
//         $output['message'] = "Sucessfully Update Your Status";
        
//         //echo json_encode($output);
        
//         continue;
//     }
// }

$tmpStr = "SELECT rm.*, employee.name as replied_by_name FROM `reply_message` as rm, employee where rm.id='".$tmpId."' AND employee.employee_id = rm.tmpEmployeeId ORDER BY reply_mesage_id DESC";
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
