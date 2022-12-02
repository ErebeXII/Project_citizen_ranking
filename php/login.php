<?php
session_start();

include 'DBConnection.php';

if (isset($_POST['submit'])) {
    $email = $_POST['txtEmail'];
    $password = $_POST['txtPassword']; // We should md5 it but this is a WIP
    $query = "SELECT * FROM mock_data WHERE last_name = '$email' AND pwd = '$password'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        // We have a match
        echo 'login successfull';
        $_SESSION['uid'] = $row['id'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['status'] = $row[]

        echo '<hr>';
        echo 'Fullname : ' . $_SESSION['last_name'] . $_SESSION['first_name'] . '<br>';

        header("Location: userList.php");
    } else {
        echo 'invalid credentials';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login page</title>
</head>
<body>
    <h2>Login :</h2>
    <form action="" method="post">
       Last name : <input type="text" name="txtEmail">
       Password : <input type="password" name="txtPassword">
        <input type="submit" value="submit" name="submit">
    </form>
    
</body>
</html>