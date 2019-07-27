<?php
error_reporting(E_ALL ^ E_NOTICE);
include 'session.php';
include 'config.php';

$userid = $_SESSION['login_userid'];
$json = file_get_contents('php://input');

if(empty($json))
{
    return FALSE;
}

$postData = json_decode($json, true);

$data = array();
$data['userid'] = $postData['userid'];

if(isset($postData['name'])) {
    $name = $postData['name'];
} else {
    $name = '';
}

$data['gender']		 = (isset($postData['gender'])) ? $postData['gender'] : null;
$data['dob']			 = (isset($postData['dob'])) ? $postData['dob'] : null;
$data['father_name']	 = (isset($postData['father_name'])) ? $postData['father_name'] : null;
$data['mother_name']	 = (isset($postData['mother_name'])) ? $postData['mother_name'] : null;
$data['father_mobile']	 = (isset($postData['father_mobile'])) ? $postData['father_mobile'] : null;
$data['mother_mobile']	 = (isset($postData['mother_mobile'])) ? $postData['mother_mobile'] : null;
$data['father_dob']	 = (isset($postData['father_dob'])) ? $postData['father_dob'] : null;
$data['mother_dob']	 = (isset($postData['mother_dob'])) ? $postData['mother_dob'] : null;
$data['marital_status'] = (isset($postData['marital_status'])) ? $postData['marital_status'] : null;
$data['anniversary_date'] = (isset($postData['anniversary_date'])) ? $postData['anniversary_date'] : null;
$data['spouse_dob'] = (isset($postData['spouse_dob'])) ? $postData['spouse_dob'] : null;
$data['spouse_name']	 = (isset($postData['spouse_name'])) ? $postData['spouse_name'] : null;
$data['spouse_mobile']	 = (isset($postData['spouse_mobile'])) ? $postData['spouse_mobile'] : null;
$data['doj']			 = (isset($postData['doj'])) ? $postData['doj'] : null;
$data['alt_contact']	 = (isset($postData['alt_contact'])) ? $postData['alt_contact'] : null;
$data['address']		 = (isset($postData['address'])) ? $postData['address'] : null;
$data['blood_group']	 = (isset($postData['blood_group'])) ? $postData['blood_group'] : null;

$tmpStr = "select id from employee_details where userid = '".$userid."'";
$tmpRes = mysqli_query($db, $tmpStr);
$tmpResult = mysqli_fetch_assoc($tmpRes);

if(empty($tmpResult)) {
    $data['added_by'] = $userid;
    $data['updated_by'] = $userid;
    $key = "";
    $value = "";
    foreach($data as $k=>$v) {
        $key.=$k.",";
        if($v) {
            $value.="'".$v."',";
        } else {
            $value.= "null".",";
        }
    }
    $key = rtrim($key,',');
    $value = rtrim($value,',');
    
    $tmpStr = "insert into employee_details (".$key.") values(".$value.")";
} else {
    $data['updated_by'] = $userid;
    $set = "";
    foreach($data as $k=>$v) {
        if($v) {
            $set .= $k."='".$v."',";
        } else {
            $set .= $k."="."null".",";
        }
    }
    $set = rtrim($set,',');
    $tmpStr = "update employee_details set ".$set." where userid=".$userid;
}

mysqli_query($db, $tmpStr);

if($name!='') {
    $tmpStr = "update employee set name = '".$name."' where employee_id = ".$userid;
    mysqli_query($db, $tmpStr);
}
//  echo json_encode($data); exit;
$output = array();
$output['status'] = true;
$output['message'] = "Profile Updated Successfully.";

echo json_encode($output);

