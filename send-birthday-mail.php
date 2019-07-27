<?php

include('mail.php');
include 'config.php';

$query = "SELECT aos.*, employee.name, employee.email FROM employee_details as aos, employee where employee.employee_id = aos.userid and month(dob) = month(now()) AND dayofmonth(dob) = dayofmonth(now())";
$result = mysqli_query($db, $query);

while ($row = mysqli_fetch_assoc($result)) {
    $dob = $row['dob'];
    $email = $row['email'];
    $name = $row['name'];
    
//     echo $dob;
//     echo $email;


  
        header('Content-Type: application/json');
        $subject = "Birthday Wishes";
        $to = $email;
        //$to = 'pd@intelaccounts.com';
        //$to = 'srivastavas852000@gmail.com';
       
        $body = "
            
            <center><table style=' text-align: justify; width:80%; font-size:16px; height:auto;padding:20px;  border:1px solid black; color:#484646; text-align: left; '>
                <tr>
                    <td>
                    <img src='http://tyasuite.com/img/Logo.png' alt='logo' class='img-responsive' style='margin-top: -25px !important; float:right;'/>
                    </td>
                </tr>
                <tr>
                    <td><p>Dear $name,</p></td>
                </tr>
                        
                <tr>
                    <td style='text-align:center;'>
                        <p>Many Many Happy Returns Of The Day <strong>!!! Happy Birth Day !!!</strong></p><br>
                        <p>May your special day be filled with</p>
                        <p>Tones of Happy Moments and Beautiful Flowers,</p>
                        <p>Good Friends and Joyful Hours!</p>
                        <p>Wishing you a very Happy Birthday!</p><br>
                    </td>
                </tr>
                
                <tr>
                    <td><center><img src='http://ems.tyasuite.com/img/1.png' alt='image' class='img-responsive'></center></td>
                </tr>
                <tr>
                    <td style='line-height:5px;'><br>
                        <p><strong>Regards,</strong></p>
                        <p>TYA Admin</p>
                    </td>
                </tr>
                        
            </table></center>
        ";

       send_mail($to, $subject, $body);
        
        // Results
        
 
        
}

echo json_encode([
    "result" => true,
    "message" => "Birthday Wishes Sent Successfully."
]);
