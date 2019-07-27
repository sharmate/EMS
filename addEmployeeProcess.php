<?php
include 'config.php';
$postData = json_decode(file_get_contents('php://input'), true);

print_r($postData);

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $postData['name'];
    $contact = $postData['contact'];
    $email = $postData['email'];
    $password = $postData['password'];
    $role = "user";
    
    
    $sql = "INSERT INTO `employee`(`name`, `contact`, `email`, `password`,`role`) VALUES ('".$name."','".$contact."','".$email."','".$password."', '".$role."')";
   
    
    $qry = $con->query($sql);
    
    if($qry){
        $json = array("status" => 1, "msg" => "Insert Successfully!!!");
    }
    else
    {
        $json = array("status" => 0, "msg" => "Not Inserted Any Data!!!");
    }
    
    
    
    // OutPut Header
    
    header('Content-type: application/json');
    echo json_encode($json);
}
?>