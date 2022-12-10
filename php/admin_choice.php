<?php
include 'DBConnection.php';
session_start();

if (!(isset($_SESSION['uid']))) {
    header("Location: login.php");
}

if ($_SESSION['status'] == 2) {
    header("Location: main_page.php");
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="../css/admin_choice.css">
    <link rel="stylesheet" href="../css/classes.css">

  <title>Choose Where to Go</title>
</head>
<body>

    <div>
        <h1>Hello Admin, Please Choose where to go</h1>
        <div id="wrapper1">
            <div id="go_to_profile"  class="orange_yellow_btn" onclick="window.location.href = 'profile_page.php'">
                Go To Your Profile Page
            </div>

            <div id="go_to_userList" class="orange_yellow_btn" onclick="window.location.href = 'userList.php'">
                Go To The User List
            </div>
        </div>
    </div>


</body>
</html>