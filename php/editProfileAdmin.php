<?php
session_start();
include 'DBConnection.php';

$uid = $_GET['ID'];
$query = "SELECT * FROM people WHERE ID = '$uid'";
$result = mysqli_fetch_assoc($connection, $query);
$row = mysqli_fetch_assoc($result);

if (isset($_POST['btnUpdate'])) {
    $fname = $_POST['txtFname'];
    $lname = $_POST['txtLname'];
    $email = $_POST['txtEmail'];

    // TODO : Add the option to change other user's info

    // TODO : Change the query once the DB Rows are fully set
    $updateQuery = "UPDATE `people` SET `firstname` = '$fname', `lastname` = '$lname', `email` = '$email' WHERE ID = $uid ";
    if (mysqli_query($connection, $updateQuery)) {
        echo "Profile has been updated !";
        header("Location:list3.php");
    } else {
        echo "error in updating the record";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<body>
<h2>This is Edit User Profile for user</h2>
<!-- Admin can modify any user info -->
<!-- TODO : Update form when DB is fully defined -->
<form action="#" method="post">
    Firstname <input type="text" name="txtFname" value="<?php echo $row['firstname']; ?>"><br>
    Lastname <input type="text" name="txtLname" value="<?php echo $row['lastname']; ?>"><br>
    Email Address <input type="text" name="txtEmail" value="<?php echo $row['email']; ?>"><br>
    Phone number <input type="text" name="txtEmail" value="<?php echo $row['email']; ?>"><br>
    City <input type="text" name="txtEmail" value="<?php echo $row['email']; ?>"><br>
    Street <input type="text" name="txtEmail" value="<?php echo $row['email']; ?>"><br>
    Street number <input type="text" name="txtEmail" value="<?php echo $row['email']; ?>"><br>
    <input type="submit" value="Update Information" name="btnUpdate">
</form>
</body>
</html>