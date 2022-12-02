<?php

$host = 'localhost'; //127.0.0.1
$username = 'root'; //
$password='';
$database='projecttest'; // Replace with you rdatabase name

$connection = mysqli_connect($host,$username,$password,$database);

if($connection === false) {
    die('Error in connection' . mysqli_connect_error());
}
?>