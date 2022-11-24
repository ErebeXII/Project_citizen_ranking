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
    <form action="" method="post">
        <select id="level" name="level">
            <option value=1>1</option> 
            <option value=2>2</option>
            <option value=3>3</option>
        </select>
        <input type="submit" class="btn" value="submit" name="submit">
    </form>
    
</body>
</html>

<?php

include 'DBConnection.php';

if (isset($_POST["submit"])) {
    $toSearch = $_POST["level"];
    $query = "SELECT * FROM mock_data where status = $toSearch";
} else {
    $query = "SELECT * FROM mock_data";
}

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

?>

