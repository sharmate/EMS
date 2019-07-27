<?php
include('session.php');


require_once './inc/common-functions.php';
include('mail.php');
if(isset($_POST['submit']))
{
    $email = $_POST['email'];
    $result = mysqli_query($db,"SELECT * FROM `employee` WHERE `email`='".$email."'");
    $row = mysqli_fetch_assoc($result);
    $fetch_user_id=$row['email'];
    $email_id=$row['email'];
    $password=$row['password'];
    if($email == $fetch_user_id) {
        $to = $email_id;
        $subject = "Forgot Password";
        $txt = "Your password is : $password.";
        
        send_mail($to,$subject,$txt);
//         echo '<script>swal("Success", "Check Your Mail", "success")</script>';
           echo '<script>alert("sent successfully");</script>';

    }
    else{
//         echo '<script>swal("Error", "Invalid Username", "error")</script>';
    }
}
?>