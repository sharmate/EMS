<?php
include 'config.php';
$postData = json_decode(file_get_contents('php://input'), true);

// 	print_r($postData);
// 	die;

// if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $postData['name'];
    $contact = $postData['mobile'];
    $email = $postData['email'];
    $profile = $postData['career_profile'];
    $target_Path = "upload/tyasuite-career/";
    $file_name = $target_Path.basename( $_FILES['uploadFile']['name'] );
    move_uploaded_file( $_FILES['uploadFile']['tmp_name'], $target_Path );
    
    
    $sql = "INSERT INTO `tyasuite_career`(`name`, `mobile`, `email`, `career_profile`, `resume`) VALUES ('".$name."', '".$contact."' ,'".$email."', '".$profile."', '".$file_name."')";
    
    
    $result = mysqli_query($db, $sql);
    
    if($result){
        $json = array("status" => 1, "msg" => "Insert Successfully!!!");
    }
    else
    {
        $json = array("status" => 0, "msg" => "Not Inserted Any Data!!!");
    }
    
    
    
    // OutPut Header
    
    header('Content-type: application/json');
    echo json_encode($json);
// }
?>
