<?php
session_start();
include 'DBConnection.php';

if (!(isset($_SESSION['uid']))) {
    header("Location: login.php");
} else {

    if (isset($_POST['edit'])) {
        // put the edit query here

        $updateQuery = "UPDATE `people` SET `email`='$txtEmail',`phone`='$txtPhone' WHERE `id` = '$id'";
    }

    $uid = $_SESSION['uid'];
    $query = "SELECT * FROM people WHERE `id` = '$uid'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $addressId = $row['current_adress_id'];
    $queryAddress = "SELECT * FROM `address` WHERE `id` = '$addressId'";
    $resultAddress = mysqli_query($connection, $queryAddress);
    $rowAddress = mysqli_fetch_assoc($resultAddress);

    if ($row['status'] == 0) {
        $gender = 'assault helicopter';
    } else {
        $gender = $row['gender'];
    }
    echo "<script>updatePP('$gender');</script>";
    echo "<sript>loadProfilePage(json_encode($row));</script>;";
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
    <link href="../css/profile_page.css" rel="stylesheet">
    <link rel="icon" href="https://images.emojiterra.com/google/noto-emoji/v2.034/512px/1f396.png">
    <script src="../js/profile_page.js"></script>
    <title>Your Page</title>
</head>
<body>

<div id="wrapper1">
    <div id="pp">

    </div>

    <div id="personal_data" class="scrollable_div">

        <div >
            <h3>Last Name</h3>
            <p><?php echo $row['last_name']?></p>
        </div>
        <div>
            <h3>First Name</h3>
            <p><?php echo $row['first_name']?></p>
        </div>

        <div>
            <h3>Date Of Birth</h3>
            <p><?php echo $row['birthday']?></p>
        </div>
        <div>
            <h3>Place Of Birth</h3>
            <p><?php echo $row['place_of_birth']?></p>
        </div>


        <div>
            <h3>Current Address</h3>
            <span id="current_address"><?php echo $rowAddress['street_number'] . " " . $rowAddress['street'] . " " . $rowAddress['city']?></span>
        </div>
        <div>
            <h3>E-Mail</h3>
            <span id="mail_data"><?php echo $row['email']?></span>
        </div>

        <div>
            <h3>Phone Number</h3>
            <span id="phone_data"><?php echo $row['phone']?></span>
        </div>


        <div id="data_btns">
            <div id="logout_bnt" class="orange_yellow_btn">LogOut</div>
            <div id="edit_btn" class="orange_yellow_btn" onclick="editPersonalData()">&#9999;&#65039;</div>
        </div>

    </div>

</div>

<div id="wrapper2">
    <div id="score_detail">

    </div>
</div>

</body>
</html>