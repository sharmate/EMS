<?php
include 'config.php';
if(isset($_POST["id"]))
{
    $query = "DELETE FROM employee WHERE employee_id = '".$_POST["id"]."'";
    if(mysqli_query($db, $query))
    {
        echo 'Data Deleted';
    }
}
?>