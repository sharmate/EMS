<?php
error_reporting(E_ALL ^ E_NOTICE);
include 'session.php';
include 'config.php';



if ( 0 < $_FILES['file']['error'] ) {
    echo 'Error: ' . $_FILES['file']['error'] . '<br>';
}
else {
    move_uploaded_file($_FILES['file']['tmp_name'], 'uploads/tmpUploads/' . $_FILES['file']['name']);
}
?>

