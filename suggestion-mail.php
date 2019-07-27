<?php

include('mail.php');
//include 'config.php';
$json = file_get_contents('php://input');
// print_r($postData);
// die;

$postData = json_decode($json, true);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  
        header('Content-Type: application/json');
        $subject = "TYA Suite Employee Suggestion";
         $to = 'ravi.s@intelaccounts.com';
        //$to = 'pd@intelaccounts.com';
        // $to = 'srivastavas852000@gmail.com';
       
        $body = "
            
            <center><table style='background-color:#eee;text-align: justify; width:80%; font-size:16px; height:auto;padding:20px;  border:1px solid black; color:#484646; text-align: left; '>
                <tr>
                    <td style='background-color:#eee;'>
                    <img src='http://tyasuite.com/img/Logo.png' alt='logo' class='img-responsive' style='margin-top: -25px !important;'/>
                    </td>
                </tr>
                <tr>
                    <td><p>Dear Admin</p></td>
                </tr>
                        
                <tr>
                    <td>
                    <p>Suggestion is the psychological process by which one person guides the thoughts, feelings, or behavior of another person.
                    Nineteenth-century writers on psychology such as William James used the in the context of a particular
                    idea which was said to suggest another when it brought that other idea to mind</p>
                    </td>
                </tr>
                
                <tr>
                    <td><p>Subject :- ".$postData['subject']."</p></td>
                </tr>
                <tr>
                    <td><p>Description :- ".$postData['message']."</p></td>
                </tr>
                
                        
            </table></center>
        ";
       //send_mail($to, $subject, $body);
        
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
