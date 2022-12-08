<?php
session_start();
include 'DBConnection.php';

if (!(isset($_SESSION['status']))) {
    header("Location: login.php");
}

if ($_SESSION['status'] > 0) {
    echo '<script>console.log("Not high enough status")</script>';
    header("Location: main_page.php");
}

$idToModify = $_GET['id'];
$query = "SELECT * FROM people WHERE ID = '$idToModify'";
$result = mysqli_query($connection, $query);
$count = mysqli_num_rows($result);
if ($count < 1) {
    echo 'pb';
} 
$row = mysqli_fetch_assoc($result);

if (isset($_POST['btnUpdate'])) {
    $fname = $_POST['txtFname'];
    $lname = $_POST['txtLname'];
    $email = $_POST['txtEmail'];

    // TODO : Add the option to change other user's info

    // TODO : Change the query once the DB Rows are fully set
    $updateQuery = "UPDATE `people` SET `firstname` = '$fname', `lastname` = '$lname', `email` = '$email' WHERE ID = $idToModify ";
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
<h2>This is Edit User Profile for admins</h2>
<!-- Admin can modify any user info -->
<!-- TODO : Update form when DB is fully defined -->
<form action="#" method="post">
    Firstname <input type="text" name="txtFname" value="<?php echo $row['first_name']; ?>"><br>
    Lastname <input type="text" name="txtLname" value="<?php echo $row['last_name']; ?>"><br>
    Email Address <input type="text" name="txtEmail" value="<?php echo $row['email']; ?>"><br>
    Phone number <input type="text" name="txtEmail" value="<?php echo $row['phone']; ?>"><br>
    <input type="submit" value="Update Information" name="btnUpdate">
</form>
</body>
</html>