<?php
//include('session.php');
include 'mail.php';
include 'config.php';

if(isset($_POST["name"], $_POST["contact"], $_POST["email"], $_POST["password"]))
{
    $name = $_POST["name"];
    $contact = $_POST["contact"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $role = "user";
    
    $tmpStr = "select * from employee where email = '".$email."'";
    $tmpRes = mysqli_query($db, $tmpStr);
    $tmpResult = mysqli_fetch_assoc($tmpRes);
    
    if(!empty($tmpResult))
    {
    	$output = array();
    	
    	$output['status'] = false;
    	$output['message'] = "Email already exists.";
    	
    	echo json_encode($output);
    	
    	exit(0);
    }
    
    $query = "INSERT INTO employee(name, contact, email, password, role) VALUES('".$name."', '".$contact."', '".$email."', '".$password."','".$role."')";
    if(mysqli_query($db, $query))
    {
        //echo 'Data Inserted';
        //echo $email;
         $subject = "Welcome to TYA Group";
        
        // Your e-mail address here.
        // This is where you're going to receive messages sent through the page
        $to = $email;
        //$from = 'ravi.s@intelaccounts.com'
        //$to = 'pd@intelaccounts.com';
        // $to = 'srivastavas852000@gmail.com';
        
        // From
        //$headers = "From: 'ravi.s@intelaccounts.com'";
        
        // Body
        
        $body = "
        
            <table style='background-color:#eee; height:auto; padding:10px; border:1px solid black; color:#484646; text-align: left; '>
                <tr>
                    <td colspan='2'>
                        <img src='http://tyasuite.com/img/Logo.png' alt='logo' class='img-responsive' 
                         style='width:100px; float:left;'> 
                        <h4 style='float:right;margin-top:0px;'>TYA Attendance ID</h4>
                    </td>
                    
                    
                </tr>
                <tr>
                    <td colspan='2' align='center'><h4>Welcome to TYA Group</h4></td>
                </tr>
                <tr><td>Dear $name,</span></td></tr>
                <tr><td><h6>Your Log-in Credentials :</h6><td><tr>
                <tr>
                    <th>Email : </th><td>$email</td>
                </tr>
                <tr>
                    <th>Password : </th><td>$password</td>
                </tr>
				<tr>
                    <td colspan='2'><a href = 'http://ems.tyasuite.com'>Please click here to submit your attendance.</a></td>
                </tr>
                <tr>
                    <td><p>Regards,<br>TYA Admin</p> </td>
                </tr>
                
            </table>
        ";
    
        send_mail($to, $subject, $body);
        
        $output = array();
        
        $output['status'] = true;
        $output['message'] = "Employee Added Successfully.";
        
        echo json_encode($output);
        
    } 
    else 
    {
    	$output = array();
    	
    	$output['status'] = false;
    	$output['message'] = "Some Error Occured";
    	
    	echo json_encode($output);
    }
}

?>
