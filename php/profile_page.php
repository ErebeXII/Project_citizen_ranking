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
    $addressId = $row['current_address_id'];
    $queryAddress = "SELECT * FROM `address` WHERE `id_address` = '$addressId'";
    $resultAddress = mysqli_query($connection, $queryAddress);
    $rowAddress = mysqli_fetch_assoc($resultAddress);

    if ($row['status_person'] == 0) {
        $gender = 'assault helicopter';
    } else {
        $gender = $row['gender'];
    }

    $queryViolations = "SELECT * FROM violation WHERE `id_person` = '$uid'";
    $resultViolations = mysqli_query($connection, $queryViolations);
    $totalViolations = 0;
    while ($rowViolations = mysqli_fetch_assoc($resultViolations)) {
        $totalViolations += $rowViolations['total_points'];
    }
    
}

?>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>

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
    <script src="../js/register.js"></script>
    <title>Your Page</title>
</head>
<body>

<div id="wrapper1">
    <div id="pp">
        <img src="" alt="profile_picture" id="pp_img">
    </div>

    <div id="personal_data" class="scrollable_div">

        <div >
            <h3>Last Name</h3>
            <p id="last_name"></p>
        </div>
        <div >
            <h3>First Name</h3>
            <p id="first_name"></p>
        </div >

        <div >
            <h3>Date Of Birth</h3>
            <p id="bday"></p>
        </div>
        <div >
            <h3>Place Of Birth</h3>
            <p id="birth_place"></p>
        </div>


        <div class="popup hidden">
            <h3>Current Address</h3>
                <span id="current_address_nb"></span>
                <span id="current_address_street"></span>
                <span id="current_address_city"></span>

            <span class="popuptext" id="popup_address">Please enter a valid address.
                </span>
        </div>
        <div class="popup hidden">
            <h3>E-Mail</h3>
            <span id="mail_data"></span>
            <span class="popuptext" id="popup_mail">Please enter a valid e-mail address.
                </span>
        </div>

        <div class="popup hidden">
            <h3>Phone Number</h3>
            <span id="phone_data"></span>
            <span class="popuptext" id="popup_phone">Please enter a valid phone number with the following format : 000 000 0000
                </span>
        </div>


        <div id="data_btns">
            <div id="logout_bnt" class="orange_yellow_btn" onclick="window.location.href = 'logout.php'">LogOut</div>
            <div id="edit_btn" class="orange_yellow_btn" onclick="editPersonalData()">&#9999;&#65039;</div>
        </div>

    </div>

</div>

<div id="wrapper2">
    <div id="score_detail">
        <h2 id="score_detail_title">Get Your Citizen Score Detail Here And Try To Improve It 👍</h2>

        <div>
            <label for="progress_societal_status">Societal Status :</label>
            <div  id="progress_societal_status" class="progress">
                <div class="progress_done_minus">

                </div>
                <div class="progress_done_plus">

                </div>
            </div>
            <p id="progress_societal_status_detail"></p>
        </div>

        <div>
            <label for="progress_public_spirit">Public Spirit :</label>
            <div id="progress_public_spirit" class="progress">
                <div class="progress_done_minus">

                </div>
                <div class="progress_done_plus">

                </div>
            </div>
            <p id="progress_public_spirit_detail"></p>
        </div>

        <div>
            <label for="progress_party_fidelity">Party Fidelity :</label>
            <div id="progress_party_fidelity" class="progress">
                <div class="progress_done_minus">

                </div>
                <div class="progress_done_plus">

                </div>
            </div>
            <p id="progress_party_fidelity_detail"></p>
        </div>
    </div>
</div>

</body>
<?php
    $jsonToPass1 = json_encode($row);
    $jsonToPass2 = json_encode($rowAddress);
    echo "<script>loadProfilePage('$jsonToPass1', '$jsonToPass2', '$totalViolations');</script>"; ?>

</html>

