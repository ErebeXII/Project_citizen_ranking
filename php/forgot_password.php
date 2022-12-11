<?php

include 'DBConnection.php';

//Include required PHPMailer files
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function sendEmail()
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
    $mail->Password = "dolavmyojxhktecc";
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
    $sendTo = $_POST['email'];
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

if (isset($_POST['email'])) {
    $mail = $_POST['email'];
    $pwd = "hello"; // TODO : password generator
    $cryptedPwd = md5($pwd);

    $query = "UPDATE `people` SET `pwd`='$cryptedPwd' WHERE `email` = '$mail'";

    if (mysqli_query($connection, $query)) {
        sendEmail();
        echo '<script> console.log("modification successful");</script>';
        // header("Location: login.php");
    } else {
        echo '<script> console.log("Error in modification");</script>';
    }
}

?>