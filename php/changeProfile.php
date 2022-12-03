<?php

include 'DBConnection.php';
session_start();



if (isset($_SESSION['uid'])) {
    $id = $_SESSION['uid'];

    if (isset($_POST['txtPhone'])) {
        $txtEmail=$_POST['txtEmail'];
        $txtPhone=$_POST['txtPhone'];
        $updateQuery = "UPDATE `people` SET `email`='$txtEmail',`phone`='$txtPhone' WHERE `id` = '$id'";
    
        if (mysqli_query($connection, $updateQuery)) {
            echo 'Record Updated';
        } else {
            echo 'Error in update';
        }
    }

    $query = "SELECT * FROM people where id = '$id'";
    $results = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($results);
    if (mysqli_num_rows($results) > 1) {
        echo 'error : multiple same ID';
    } else {
        // If the person is properly logged in :

        echo '
        <form action="" id="update_form" method="post">

            <p>Phone</p> <br>
            <input type="text" value="'.$row['phone'].'"id="txtPhone" name="txtPhone"> <br>
            <p>Email</p> <br>
            <input type="text" value="'.$row['email'].'"id="txtEmail" name="txtEmail"> <br>
            <input type="submit" form="update_form" value="Update" id="update_btn" class="orange_yellow_btn"> <br>

        </form>
        ';

    }
} else {
    echo 'error : not logged in';
}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <script src="../js/register.js"></script>
    <link href="../css/classes.css" rel="stylesheet">
    <link href="../css/register.css" rel="stylesheet">
    <link rel="icon" href="https://images.emojiterra.com/google/noto-emoji/v2.034/512px/1f396.png">
    <title>Register</title>
</head>
<body>

    <div id="wrapper1">

        <div style="width: 100%">
            <h1>Welcome new citizen!</h1>
            <div onclick="location.href='main_page.html'" class="orange_yellow_btn return_main">↩</div>
        </div>


        <h2>test</h2>

            
    </div>

</body>
</html>