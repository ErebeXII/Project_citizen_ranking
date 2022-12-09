<?php

session_start();
include 'DBConnection.php';

$query = "SELECT * FROM `people` ORDER BY `total_points` DESC";
$results = mysqli_query($connection, $query);

?>

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
    <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
    <link rel="icon" href="https://images.emojiterra.com/google/noto-emoji/v2.034/512px/1f396.png">
    <title>Citizen Ranking</title>
</head>
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
    <form id="form_search_citizen" method="post" action="">
        <input class="input" role="textbox" id="input_citizen" name="input_citizen" data-placeholder="Tell us who you are" contenteditable>
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
        
    </div>
</div>


</body>
</html>