<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Search someone</h2>
    <form id="search_form" action="" method="post">
          <div>
              <label for="first name">First Name</label><br />
              <input type="text" class="text-input" name="txtFName" placeholder="Enter the first name"><br /><br>
          </div>
          <div>
              <label for="last name">Last Name</label><br />
              <input type="text" class="text-input" name="txtLName" placeholder="Enter the last name"><br /><br>
          </div>

          <br>

          <input type="submit" value="search" class="orange_yellow_btn" name="searchBtn">
      </form>
    <h2>User List</h2>
    
</body>
</html>

<?php

session_start();
include 'DBConnection.php';


if (isset($_SESSION["status"])) {
    echo 'Hello Mr./Ms.' . $_SESSION['last_name'] . '<br>';
    $currentStatus = $_SESSION["status"];
    if ($currentStatus < 2) {
        if ($currentStatus == 0) {
             // If this is a super-admin
            if (isset($_POST['searchBtn'])) {
                // if we are searching for someone
                $firstName = $_POST['txtFName'];
                $lastName = $_POST['txtLName'];
                $query = "SELECT * FROM people WHERE `last_name` = '$lastName' AND `first_name` = '$firstName'";
            } else {
                $query = "SELECT * FROM people";
            }
            
            $results = mysqli_query($connection, $query);

            echo "
            <h1>User List :</h1>
            <table>
            <tr>
                <th>ID</th>
                <th>last name</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>";
            while ($row = mysqli_fetch_assoc($results)) {
                echo '<tr>';
                echo '<td>' . $row['id'] .'</td>';
                echo '<td>' . $row['last_name'] .'</td>';
                if ($row['status'] != 0) {
                    echo '<td> Edit </td>';
                    echo '<td> Delete </td>';
                }
                echo '</th>';
            }
        } else {

            // This is a simple admin, the difference is the admin doesn't see other admins
            if (isset($_POST['searchBtn'])) {
                // if we are searching for someone
                $firstName = $_POST['txtFName'];
                $lastName = $_POST['txtLName'];
                $query = "SELECT * FROM people WHERE `last_name` = '$lastName' AND `first_name` = '$firstName' AND `status` >= '$currentStatus'";
            } else {
                $query = "SELECT * FROM people where status >= '$currentStatus'";
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
        }
        
        
    } else {
        // Simple user
        echo 'Not high enough to see other users';
    }
    
    
    echo '</table>';
} else {
    echo 'not logged in';
}





?>

