<?php
include 'config.php';
if(isset($_POST["id"]))
{
    $query = "DELETE FROM annual_outing_suggestions WHERE employee_id = '".$_POST["id"]."'";
    if(mysqli_query($db, $query))
    {
        echo 'Data Deleted';
    }
}
?>