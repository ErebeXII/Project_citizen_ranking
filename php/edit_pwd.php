<?php

include 'DBConnection.php';
session_start();

if (isset($_SESSION['uid'])) {
    $id = $_SESSION['uid'];

    if (isset($_POST['txtPwd'])) {
        $newPWD= md5($_POST['txtPwd']);
        $updateQuery = "UPDATE `people` SET `pwd`='$newPWD' WHERE `id` = '$id'";
        
        if (mysqli_query($connection, $updateQuery)) {
            echo '<script> console.log("Record updated");</script>';
        } else {
            echo '<script> console.log("Error in update");</script>';
        }
    } else {
        echo '<script> console.log("Nothing set");</script>';
    }
} else {
    header("Location: login.php");
}
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="../css/edit_pwd.css" rel="stylesheet">
  <link href="../css/classes.css" rel="stylesheet">
  <script src="../js/register.js"></script>
  <script src="../js/edit_pwd.js"></script>

  <link rel="icon" href="https://images.emojiterra.com/google/noto-emoji/v2.034/512px/1f396.png">
  <title>Edit My Password</title>
</head>

<body>

<form id="edit_pwd_form" action="" method="post">
  <h1>Edit Your Password</h1>

  <div class="popup hidden">
    <label for="password">Password</label><br>
    <input type="text" id="password" class="text-input" placeholder="Enter your password" name="txtPwd">
    <span class="popuptext" id="popup_pwd">Please enter a valid password, must be between 5 and 20 characters
                </span>
  </div>

  <div class="popup hidden">
    <label for="confirm_pwd">Confirm Your Password</label><br>
    <input type="text" id="confirm_pwd" class="text-input" placeholder="Confirm Your Password" name="txtConfirmPwd">
    <span class="popuptext" id="popup_CPwd">Please make sure that the passwords match
                </span>
  </div>

  <div id="button_div">
    <input type="button" value="My Profile" id="go_to_profile" class="orange_yellow_btn" onclick="location.href='profile_page.php'">
    <input type="button" value="Edit Password" id="edit_pwd_form_btn" class="orange_yellow_btn" onclick="submitPwdForm()">
  </div>


</form>

</body>
</html>