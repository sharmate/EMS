<?php
include 'config.php';
//$postData = json_decode(file_get_contents('php://input'), true);

// 	print_r($postData);
// 	die;

if($_SERVER['REQUEST_METHOD'] == "POST"){
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $subject = $_POST['subject'];
    $target_Path = "upload/";
    $target_Path = $target_Path.basename( $_FILES['myfile']['name'] );
    move_uploaded_file( $_FILES['myfile']['tmp_name'], $target_Path );
    
    
    $sql = "INSERT INTO `upload_resume`(`name`, `email`, `contact`, `subject`, `resume`) VALUES ('".$name."', '".$email."', '".$contact."', '".$subject."', '".$target_Path."')";
    
    
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
}
?>
