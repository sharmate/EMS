<?php
//include('session.php');
include 'config.php';
if(isset($_POST["id"]))
{
    $value = mysqli_real_escape_string($db, $_POST["value"]);
    $query = "UPDATE employee SET ".$_POST["column_name"]."='".$value."' WHERE employee_id = '".$_POST["id"]."'";
  // echo $query;
  // die();
    //print_r($query);
    if(mysqli_query($db, $query))
    {
        echo 'Data Updated';
    }
}
?>
