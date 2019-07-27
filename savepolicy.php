<?php
error_reporting(0);
header('Content-type: application/json');
$data = json_decode(file_get_contents('php://input'),true);

if(isset($data['content'])){
    include 'config.php';
    include 'session.php';
    
  $message="fail";
  mysqli_query($db,'TRUNCATE TABLE expense_policy');
  
  $return=array();
  $return['msg'] ="error";
  $return['status'] = false;
           $qry = "INSERT INTO `expense_policy`(`expense_policy`) VALUES ('".$data['content']."')";
           $result = mysqli_query($db, $qry);
           if($result!=''){
            
              $return['msg'] ="saved";
              $return['status'] = true;
              
           }
   
           $return = json_encode($return);
    echo $return;
    
}
?>