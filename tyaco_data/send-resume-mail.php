<?php

include('mail.php');

//echo $row['subject'];
//$json = file_get_contents('php://input');
// print_r($json);
// die;

//$postData = json_decode($json, true);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
    
    
    header('Content-Type: application/json');
    $subject = "Upload Resume From Employee";
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
                    <td><p>Name :- " .$_POST['name']."</p></td>
                </tr>
                <tr>
                    <td><p>Email :- " .$_POST['email']."</p></td>
                </tr>
                <tr>
                    <td><p>Contact :- " .$_POST['contact']."</p></td>
                </tr>
                <tr>
                    <td><p>Subject :- " .$_POST['subject']."</p></td>
                </tr>

            </table></center>
        ";
    
    $attachments = array();
    if(isset($_FILES['myfile']) && !empty($_FILES['myfile']) && $_FILES['myfile']['size'] > 0)
    {
           
            $file_name = $_FILES['myfile']['name'];
            $file_size = $_FILES['myfile']['size'];
            $file_tmp = $_FILES['myfile']['tmp_name'];
            $file_type = $_FILES['myfile']['type'];
            
            //print_r($_FILES['attachment']['name']);
            
            $file_ext = explode('.',$_FILES['myfile']['name']);
            $file_ext = strtolower(end($file_ext));
            $newFileName = "resume.".$file_ext;
            move_uploaded_file($file_tmp, $newFileName);
            array_push($attachments, $newFileName);
    }
    
    send_mail($to, $subject, $body, $attachments);
    
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
