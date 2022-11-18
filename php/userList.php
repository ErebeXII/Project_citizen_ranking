<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Select the user level :</h2>
    <form action="#" method="post">
        <select id="level" name="level">
            <option value=1>1</option> 
            <option value=2>2</option>
            <option value=3>3</option>
        </select>
    </form>
    <input type="submit" class="btn" value="submit" name="submit">
</body>
</html>

<?php

include 'DBConnection.php';

if (isset($_POST["submit"])) {
    $toSearch = $_POST["level"];
    $query = "SELECT * FROM users where userLevel = $toSearch";
} else {
    $query = "SELECT * FROM users";
}

$results = mysqli_query($connection, $query);

echo "
<h1>User List :</h1>
<table>
<tr>
    <th>ID</th>
    <th>Email</th>
</tr>";
while ($row = mysqli_fetch_assoc($results)) {
    echo '<tr>';
    echo '<td>' . $row['ID'] .'</td>';
    echo '<td>' . $row['email'] .'</td>';
    echo '</th>';
}
echo '</table>';

?>

