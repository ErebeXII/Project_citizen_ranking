<?php

include 'DBConnection.php';
session_start();

if (isset($_POST['address_nb'])) {

    // We're looking for the address
    
    $address_nb=$_POST['address_nb'];
    $address_street=$_POST['address_street'];
    $address_city=$_POST['address_city'];
    
    $queryAddress = "SELECT * FROM `address` WHERE city = '$address_city' AND street = '$address_street' AND street_number = '$address_nb'";
    $addressResult = mysqli_query($connection, $queryAddress);
    $addressCount = mysqli_num_rows($addressResult);

    if ($addressCount > 0) {
        if ($addressCount > 1) {
            echo '<script> console.log("WARNING : Redundancy in the DB");</script>';
        }
        // We have the address
        $row = mysqli_fetch_assoc($addressResult);
        $idAddress = $row['id_address'];
    } else {
        $queryNBAddress = "SELECT * FROM `address`";
        $addressNBResult = mysqli_query($connection, $queryNBAddress);
        $idAddress = mysqli_num_rows($addressNBResult) + 1;
        
        $queryNewAddress = "INSERT INTO `address`(`id_address`, `city`, `street`, `street_number`) VALUES ('$idAddress','$address_city','$address_street','$address_nb')";

        if (!mysqli_query($connection, $queryNewAddress)) {
            echo 'address problem';
        }
    }
    echo "$idAddress";
    
}

if (isset($_POST['email'])) {

    $mail=$_POST['email'];
    $phone=$_POST['phone'];

    $id=$_POST['id'];
    
    $updateQuery = "UPDATE `people` SET `email`='$mail',`phone`='$phone' WHERE `id` = '$id'";

    if (mysqli_query($connection, $updateQuery)) {
        echo "Damn he's good";
    } else {
        echo 'record error ?';
    }
}

if (!(isset($_POST['email']) || isset($_POST['address_nb']))) {
    echo 'nothing set';
}

?>