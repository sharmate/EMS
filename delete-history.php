<?php
include 'config.php';
if(isset($_POST["id"]))
{
    $query = "DELETE FROM suggestion_box WHERE id = '".$_POST["id"]."'";
    if(mysqli_query($db, $query))
    {
        echo 'Data Deleted';
    }
}
?>