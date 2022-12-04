<?php
session_start();

include 'DBConnection.php';

if (isset($_POST['submit'])) {
    $email = $_POST['txtEmail'];
    $password = md5($_POST['txtPassword']);
    $query = "SELECT * FROM people WHERE email = '$email' AND pwd = '$password'";
    $result = mysqli_query($connection, $query);
    $row = mysqli_fetch_assoc($result);
    $count = mysqli_num_rows($result);
    if ($count == 1) {
        // We have a match
        echo 'login successfull';
        $_SESSION['uid'] = $row['id'];
        $_SESSION['last_name'] = $row['last_name'];
        $_SESSION['first_name'] = $row['first_name'];
        $_SESSION['status'] = $row['status'];

        echo '<hr>';
        echo 'Fullname : ' . $_SESSION['last_name'] . $_SESSION['first_name'] . '<br>';

        if ($row['status'] == 2) {
            header("Location: profile_page.php");
        } else {
            header("Location: userList.php");
        }
    } else {
        echo '<script>alert("Invalid Credentials")</script>';
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../css/classes.css" rel="stylesheet">
    <link href="../css/login.css" rel="stylesheet">
    <link rel="icon" href="https://images.emojiterra.com/google/noto-emoji/v2.034/512px/1f396.png">
    <title>Login</title>
</head>

<body>

    <div class="partyAdds">
        
    </div>

  <div id="wrapper1">
      <div onclick="location.href='main_page.html'" class="orange_yellow_btn return_main">↩</div>
      <h1>Hello Citizen !</h1>
      <form id="login_form" action="" method="post">
          <div>
              <label for="username">Email</label><br />
              <input type="text" id="username" class="text-input" name="txtEmail" placeholder="👤   Enter your email"><br /><br>
          </div>
          <div>
              <label for="password">Password</label><br />
              <input type="password" id="password" class="text-input" name="txtPassword" placeholder="🔒   Enter your password"><br />
              <a href="">Forgot Password</a>
          </div>

          <br>

          <input type="submit" value="Login" id="login_btn" class="orange_yellow_btn" name="submit">
      </form>
  </div>

    <div class="partyAdds">

    </div>

</body>

</html>