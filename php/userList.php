<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>User List</h2>
    
</body>
</html>

<?php

session_start();
include 'DBConnection.php';

if (isset($_SESSION['last_name'])) {
    echo 'Gotcha Mr./Ms.' . $_SESSION['last_name'];
}

if (isset($_SESSION["status"])) {
    $currentStatus = $_SESSION["status"]; // We define a new variable to be able to use it inside the query
    $query = "SELECT * FROM people where status >= '$currentStatus'";
    $results = mysqli_query($connection, $query);

    echo "
    <h1>User List :</h1>
    <table>
    <tr>
        <th>ID</th>
        <th>last name</th>
    </tr>";
    while ($row = mysqli_fetch_assoc($results)) {
        echo '<tr>';
        echo '<td>' . $row['id'] .'</td>';
        echo '<td>' . $row['last_name'] .'</td>';
        echo '</th>';
    }

    echo '</table>';
} else {
    echo 'not logged in';
}





?>

