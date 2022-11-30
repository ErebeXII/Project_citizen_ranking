<?php

include 'DBConnection.php';

if (isset($_POST['btnRegister'])) {
    if ($_POST['pwd'] != $_POST['confirmPwd']) {
        echo 'The confirmation is not the same as the password';
    } else {

    }
}

$txtPwd = $_POST['txtPwd'];
$txtLName = $_POST['txtLName']
$txtFName = $_POST['txtFName'];
$txtBDay = $_POST['txtBDay'];
$txtPOB = $_POST['txtPOB'];
$txtCity = $_POST['txtCity'];
$txtStreet = $_POST['txtStreetNB'] . $_POST['txtStreetName'];
$txtPhone = $_POST['txtPhone'];

$query = INSERT INTO `mock_data`(`pwd`, `last_name`, `first_name`, `birthday`, `place_of_birth`, `city`, `street`, `phone`, `violation_class_1`, `violation_class_2`, `violation_class_3`) VALUES ('$txtPwd','$txtLname','$txtFname','$txtBDay','$txtPOB','$txtCity','$txtStreet','$txtPhone','0','0','0');

if (mysqli_query($connection, $query)) {
    echo 'Less gooooooo';
} else {
    echo 'Shimata';
}

?>