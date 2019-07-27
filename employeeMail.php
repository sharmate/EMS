<?php

include('mail.php');


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
    
    
    // $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    
    
    //$model = new ContactModel($_POST['Career']);
    header('Content-Type: application/json');
    if($model->isValid()) {
        // Email message, change it whatever you wish
        $subject = "TYA Suite Career Form Data";
        
        // Your e-mail address here.
        // This is where you're going to receive messages sent through the page
         $to = 'ravi.s@intelaccounts.com';
        //$to = 'pd@intelaccounts.com';
        // $to = 'srivastavas852000@gmail.com';
        
        // From
        $headers = "From: {$model->email}";
        
        // Body
        
        $body = "
        
            <table style='background-color:#eee; height:300px; font-size:20px; padding:10px; border:1px solid black; color:#484646; text-align: left; '>
            
                <tr>
                    <th>Name : </th><td>{$model->name}</td>
                </tr>
                <tr>
                    <th>Mobile No : </th><td>{$model->mobile}</td>
                </tr>
                <tr>
                    <th>Email : </th><td>{$model->email}</td>
                </tr>
                <tr>
                    <th>Profile : </th><td>{$model->profile}</td>
                </tr>
                
            </table>
        ";
        
        $attachments = array();
        
        
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
            "errors" => $model->errors
        ]);
    }
}
