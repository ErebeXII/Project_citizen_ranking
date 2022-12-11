<?php

include "DBConnection.php";

function get_score_from_name($fName, $lName) {

    $query = "SELECT * FROM people WHERE `first_name` = '$fName' and `last_name` = '$lName'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);

    return $row['score'];
}

?>