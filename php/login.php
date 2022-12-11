<?php
session_start();

include 'DBConnection.php';

require '../includes/PHPMailer.php';
require '../includes/SMTP.php';
require '../includes/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

if (isset($_POST['txtEmail'])) {
    echo '<script> console.log("ah ?");</script>';
    $email = $_POST['txtEmail'];
    $password = md5($_POST['txtPassword']);
    $query = "SELECT * FROM people WHERE email = '$email' AND pwd = '$password'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        // We have a match
        echo 'login successfull';
        $_SESSION['uid'] = $row['id'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['status'] = $row['status_person'];

        echo '<hr>';
        echo 'Fullname : ' . $_SESSION['last_name'] . $_SESSION['first_name'] . '<br>';

        if ($_SESSION['status'] == 2) {
            header("Location: profile_page.php");
        } else {
            header("Location: admin_choice.php");
        }
    } else {
        echo '<script>alert("Invalid Credentials")</script>';
    }
}

function sendEmail($pwd)
{

    

    //Create instance of PHPMailer
    $mail = new PHPMailer();
    //Set mailer to use smtp
    $mail->isSMTP();
    //Define smtp host
    $mail->Host = "smtp.gmail.com";
    //Enable smtp authentication
    $mail->SMTPAuth = true;
    //Set smtp encryption type (ssl/tls)
    $mail->SMTPSecure = "tls";
    //Port to connect smtp
    $mail->Port = "587";
    //Set gmail username
    $mail->Username = "romeo.gennari@gmail.com";
    //Set gmail password
    $mail->Password = "libzzjtvuspvknpc";
    //Email subject
    $mail->Subject = "Reset Password!";
    //Set sender email
    $mail->setFrom('romeo.gennari@gmail.com');
    //Enable HTML
    $mail->isHTML(true);
    //Attachment
    // $mail->addAttachment('img/attachment.png');
    //Email body
    $mail->Body = "here is your temporary password: $pwd";
    //Add recipient
    $sendTo = $_POST['txtEmailForgotPwd'];
    $mail->addAddress($sendTo);
    //$mail->addAddress('daniel.mago@apu.edu.my');
    //Finally send email
    if ($mail->send()) {
        echo '<script> console.log("Message sent.");</script>';
    } else {
        echo '<script> console.log("Message could not be sent.");</script>';
    }
    //Closing smtp connection
    $mail->smtpClose();
}

if (isset($_POST['txtEmailForgotPwd'])) {
    $mail = $_POST['txtEmailForgotPwd'];
    $pwd = "hello"; // TODO : password generator
    $cryptedPwd = md5($pwd);

    $query = "UPDATE `people` SET `pwd`='$cryptedPwd' WHERE `email` = '$mail'";

    if (mysqli_query($connection, $query)) {
        sendEmail($pwd);
        echo '<script> console.log("modification successful");</script>';
    } else {
        echo '<script> console.log("Error in modification");</script>';
    }
}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/classes.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <script src="../js/register.js"></script>
    <link rel="icon" href="https://images.emojiterra.com/google/noto-emoji/v2.034/512px/1f396.png">
    <script src="../js/login.js"></script>
    <title>Login</title>
</head>

<body>

    <div class="partyAdds">
        
    </div>

  <div id="wrapper1">
      <div onclick="location.href='main_page.html'" class="orange_yellow_btn return_main">↩</div>
      <h1>Hello Citizen !</h1>
      <form id="login_form" action="" method="post">
          <div>
              <label for="username">Username</label><br />
              <input type="text" id="username" class="text-input" name="txtEmail" placeholder="👤   Enter your email"><br /><br>
          </div>
          <div>
              <label for="password">Password</label><br />
              <input type="password" id="password" class="text-input" name="txtPassword" placeholder="🔒   Enter your password"><br />
              <p onclick="displayForgotPwd()">Forgot Password</p>
          </div>

          <br>

          <input type="submit" value="Login" id="login_btn" class="orange_yellow_btn" >
      </form>

      <form id="forgot_pwd_form" action="" method="post">
          <div class="popup hidden">
              <label for="mail_forgot_pwd">Your Account Mail</label>
              <input type="text" id="mail_forgot_pwd" class="text-input" name="txtEmailForgotPwd"
                     placeholder="Please enter your e-mail">
              <span class="popuptext" id="popup_mail_forgot_pwd">Please enter a valid e-mail
                </span>
          </div>
          <input type="button" value="Send" id="mail_forgot_pwd_btn" class="orange_yellow_btn" onclick="checkInputEmail()">
      </form>

  </div>

    <div class="partyAdds">

    </div>

</body>

</html>