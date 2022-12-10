

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" href="https://images.emojiterra.com/google/noto-emoji/v2.034/512px/1f396.png">
  <link href="../css/user_list.css" rel="stylesheet">
  <link href="../css/classes.css" rel="stylesheet">
  <title>User List</title>
</head>
<body>
  <form id="search_form" action="" method="post">
    <h2>Search Someone</h2>

    <div>
      <label for="first_name">First Name</label>
      <input type="text" id="first_name" class="text-input" name="txtFName" placeholder="Enter the first name"><br /><br>
    </div>
    <div>
      <label for="last_name">Last Name</label>
      <input type="text" id="last_name" class="text-input" name="txtLName" placeholder="Enter the last name"><br /><br>
    </div>
    <input type="submit" value="Search" class="orange_yellow_btn" name="searchBtn">
  </form>

  <h2 id="table_title">User List</h2>
  <table>
    <tbody><tr>
      <th>ID</th>
      <th>last name</th>
      <th>Edit</th>
      <th>Delete</th>

<?php
session_start();
include 'DBConnection.php';
if (isset($_SESSION["status"])) {
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
            while ($row = mysqli_fetch_assoc($results)) {
                echo '<tr>';
                echo '<td>' . $row['id'] .'</td>';
                echo '<td>' . $row['last_name'] .'</td>';
                if ($row['status_person'] != 0) {
                    echo '<td><a href=editProfileAdmin.php?id=' . $row['id'] .'>Edit</a></td>';
                    echo '<td><a href=deleteProfileAdmin.php?id=' . $row['id'] .'>Delete</a></td>';
                } else {
                    echo '<td>Unavailible</td>';
                    echo '<td>Unavailible</td>';
                }
                echo '</th>';
            }
        } else {

            // This is a simple admin, the difference is the admin doesn't see other admins
            if (isset($_POST['searchBtn'])) {
                // if we are searching for someone
                $firstName = $_POST['txtFName'];
                $lastName = $_POST['txtLName'];
                $query = "SELECT * FROM people WHERE `last_name` = '$lastName' AND `first_name` = '$firstName' AND `status_person` >= '$currentStatus'";
            } else {
                $query = "SELECT * FROM people where `status_person` >= '$currentStatus'";
            }
            $results = mysqli_query($connection, $query);
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
    </tbody>
  </table>
</body>


</html>