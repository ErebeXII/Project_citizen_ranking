<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/classes.css" rel="stylesheet">
    <link href="../css/main_page.css" rel="stylesheet">
    <script src="../js/main_page.js"></script>
    <link rel="icon" href="https://images.emojiterra.com/google/noto-emoji/v2.034/512px/1f396.png">
    <title>Citizen Ranking</title>
</head>

<?php

session_start();
include 'DBConnection.php';

$query = "SELECT * FROM `people` ORDER BY `total_points` DESC";
$results = mysqli_query($connection, $query);

if (isset($_POST['txtLName']) && isset($_POST['txtFName'])) {
    $firstName = $_POST['txtFName'];
    $lastName = $_POST['txtLName'];
    $peopleQuery = "SELECT * FROM people WHERE `last_name` = '$lastName' AND `first_name` = '$firstName'";
    $resultsPeople = mysqli_query($connection, $peopleQuery);
    echo "<script>console.log('$firstName');</script>";
    echo "<script>console.log('$lastName');</script>";
    while ($rowPeople = mysqli_fetch_assoc($resultsPeople)) {   
        
        echo "<script>console.log('A result has been sent');</script>";

        $scoreToSend = $rowPeople['total_points'];
        $FNameToSend = $rowPeople['first_name'];
        $LNameToSend = $rowPeople['last_name'];
        
        echo "<script>searchCitizen('$scoreToSend', '$FNameToSend', '$LNameToSend');</script>";
    }
} else {
    echo "<script>console.log('nothing set');</script>";
}




?>

<body>

<header>
    <div id="go_register_btn" class="orange_yellow_btn" onclick="location.href='register.html'">Register</div>
    <div id="header_title"><h1>Welcome Citizen !</h1></div>
    <div id="go_login_btn" class="orange_yellow_btn" onclick="location.href='login.html'">LogIn</div>

</header>

<div id="wrapper1">

    <div id="emoji_title" onclick="funnierEmoji()">
        <h1>
            &#128512
        </h1>
    </div>

    <div id="user_results">
        <p id="result_data">
            data
        </p>
    </div>

    <form id="form_search_citizen" method="post" action="">
        <div id="input_citizen">
            <input type="text" id="first_name_input" class="text-input"  placeholder="First Name" name="txtFName">
            <p style="font-size: 20pt">|</p>
            <input type="text" id="last_name_input" class="text-input"  placeholder="Last Name" name="txtLName">
        </div>
        <input id="search_button" type="submit" class="myButtons orange_yellow_btn" value="Search">
        <input id="ranking_button" type="button" class="myButtons dark_orange_pink_btn" onclick="rankingTable()" value="Rankings">
    </form>

</div>

<div id="hidden_wrapper1" class="fixTableHead scrollable_div">
    <table id="ranking_table" >

        <thead>
            <tr>
                <th>Rank</th>
                <th>Last Name</th>
                <th>First Name</th>
                <th>Score</th>
            </tr>
        </thead>
        <tbody id="ranking_table_body">
            <?php
                for ($i=0; $i<100; $i++) {
                    $row = mysqli_fetch_assoc($results);
                    $firstName = $row['first_name'];
                    $lastName = $row['last_name'];
                    $score = $row['total_points'];
                    echo "<script>loadTableFromPHP('$i', '$firstName', '$lastName', $score);</script>";
                }
            ?>
        </tbody>

</table>
</div>

<div id="wrapper2">
<div id="party_adds">
    adds
</div>
</div>

</body>
</html>