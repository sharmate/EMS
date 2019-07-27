<?php
	
	//include('session.php');
	include 'mail.php';
	include 'config.php';
	
	$json = file_get_contents('php://input');
	
	if(empty($json))
	{
		return FALSE;
	}
	
	$postData = json_decode($json, true);
	
	if(isset($postData["name"]) && $postData['name'] != "")
	{
      	$subject = "TYA Group | Attendance Submitted";
        
      	$to = $postData['email'];
        
        $body = "
        
            <table style='background-color:#eee; height:auto; padding:10px; border:1px solid black; color:#484646; text-align: left; max-width: 500px;'>
                <tr>
                    <td colspan='2'>
                        <img src='http://tyasuite.com/img/Logo.png' alt='logo' class='img-responsive' 
                         style='width:100px; float:left;'> 
                        <h4 style='float:right;margin-top:0px;'>TYA Attendance</h4>
                    </td>
                    
                    
                </tr>
                <tr>
                    <td colspan='2' align='center'><h4>Attendance Submitted Successfully!</h4></td>
                </tr>
                <tr><td>Dear ".$postData['name'].",</span></td></tr>
                <tr>
					<td colspan='2'><h5>Your attendance for the month of ".$postData['month']." ".$postData['year'].", has been submitted successfully.</h5></td>
				</tr>
                <tr>
                    <th width='50%'>Total Days Present: </th><td>".$postData['total_present']."</td>
                </tr>
                <tr>
                    <th width='50%'>Total Days Absent: </th><td>".$postData['total_absent']."</td>
                </tr>
				<tr>
                    <td><p>Regards,<br>TYA Admin</p> </td>
                </tr>
                
            </table>
        ";
    
        send_mail($to, $subject, $body);
        
        $output = array();
        $output['status'] = true;
        $output['message'] = "Mail Sent";
        
        echo json_encode($output);
        
        return false;
    
    }

?>
