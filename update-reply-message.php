<?php
include 'config.php';

$json = file_get_contents('php://input');
echo $json;
if(empty($json))
{
    return FALSE;
}   
$postData = json_decode($json, true);

$tmpId = $postData['tmpId'];
// print_r($tmpId);
// die;
$tmpStr = "UPDATE reply_message,suggestion_box SET reply_message.status='".$postData['tmpStatus']."',suggestion_box.status='".$postData['tmpStatus']."' WHERE reply_message.id='".$tmpId."' AND suggestion_box.id='".$tmpId."'";
//$tmpStr = "UPDATE `reply_message` SET `status`='".$postData['tmpStatus']."' WHERE id='".$tmpId."'";
echo $tmpStr;
mysqli_query($db, $tmpStr);

$output = array();
$output['status'] = true;
$output['message'] = "Update Successfully!!!.";

echo json_encode($output);
