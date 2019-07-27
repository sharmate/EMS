<?php
   include("config.php");
   session_start();
   $json = file_get_contents('php://input');
   
   if(empty($json))
   {
       return FALSE;
   }
   
   $postData = json_decode($json, true);
//    print_r($postData);
//    die;
   
   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
       $id = $postData['id'];
       $newPassword = $postData['newPassword'];
       $confirmPassword = $postData['confirmPassword']; 
      
     
      if($newPassword == $confirmPassword){
          $sql = "UPDATE `employee` SET `password`='$newPassword' WHERE employee_id='$id'";
          $result = mysqli_query($db, $sql);
          if($result){
              header('location:index.php');
          }
      }
      else{
          echo "<script>

                swal('Error','Password Does Not Match!!', 'error');
            </script>";
      }
   }
?>