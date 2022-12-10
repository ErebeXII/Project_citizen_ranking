<?php

include 'DBConnection.php';
session_start();

if (isset($_POST['email'])) {

    
    $mail=$_POST['email'];
    $phone=$_POST['phone'];
    $id=$_POST['id'];
    
    $updateQuery = "UPDATE `people` SET `email`='$mail',`phone`='$phone' WHERE `id` = '$id'";

    if (mysqli_query($connection, $updateQuery)) {
        echo 'record Updated ?';
    } else {
        echo 'record error ?';
    }
    
} else {
    echo 'RAH';
}


?>