<?php 
	include 'config.php';
	$postData = json_decode(file_get_contents('php://input'), true);

// 	print_r($postData);
// 	die;

	if($_SERVER['REQUEST_METHOD'] == "POST"){
	    $email = $postData['email'];
		$phone = $postData['phone'];
		$subject = $postData['subject'];
		$message = $postData['message'];
		 

		$sql = "INSERT INTO `enquiry`(`email`, `phone`, `subject`, `message`) VALUES ('".$email."', '".$phone."', '".$subject."', '".$message."')";


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
