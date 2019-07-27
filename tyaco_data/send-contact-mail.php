<?php

include('mail.php');

//echo $row['subject'];
$json = file_get_contents('php://input');
// print_r($postData);
// die;

$postData = json_decode($json, true);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
    
    header('Content-Type: application/json');
    $subject = "User Request";
    $to = 'ravi.s@intelaccounts.com';
    //         $to = 'pd@intelaccounts.com';
    // $to = 'srivastavas852000@gmail.com';
    
    
    $body = "
        
            <center><table style='background-color:#eee; width:80%; font-size:16px; height:auto;padding:20px;  border:1px solid black; color:#484646; text-align: left; '>
                <tr>
                    <td style='background-color:#eee;'>
                    <img src='http://www.tya.co.in/wp-content/uploads/2015/03/TYA-LOGO-FNL.png' alt='logo' class='img-responsive' style='margin-top: -25px !important; width:21%; float:right;'/>
                    </td>
                </tr>
                <tr>
                    <td><p>Dear Admin</p></td>
                </tr>
                <tr>
                    <td><p>List :- ".$postData['email']."</p></td>
                </tr>
                <tr>
                    <td><p>Name :- ".$postData['phone']."</p></td>
                </tr>
                <tr>
                    <td><p>Email :- ".$postData['subject']."</p></td>
                </tr>
                <tr>
                    <td><p>Contact :- ".$postData['message']."</p></td>
                </tr>
                        
                        
            </table></center>
        ";
    
    send_mail($to, $subject, $body);
    
    // Results
    echo json_encode([
        "result" => true,
        "message" => "Your message has been send, we will contact you as soon as possible."
    ]);
} else {
    echo json_encode([
        "result" => false,
        "message" => "We've found some errors.",
        "errors" => errors
    ]);
    
}
