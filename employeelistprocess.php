<?php
include 'config.php';

 //$json = file_get_contents('php://input');

// if(empty($json))
// {
//     return FALSE;
// }

//print_r($json);

//$postData = json_decode($json, true);
$tmpArray = array();
$tmpStr = "SELECT * FROM `employee` WHERE role='user'";

$tmpRes = mysqli_query($db, $tmpStr);


if($tmpRes-> num_rows > 0)
{
    while ($row = mysqli_fetch_assoc($tmpRes)) {
       // print_r($row);
       
        array_push($tmpArray, $row);
        
    }
}


//print_r($tmpResult);


mysqli_query($db, $tmpStr);

$output = array();
$output['status'] = true;
//$output['Response'] = $tmpRes;
$output['message'] = "employee list";
$output['emplist'] = $tmpArray;

echo json_encode($output);
