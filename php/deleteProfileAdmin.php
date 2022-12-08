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

$idToDelete = $_GET['id'];
$queryInfo = "SELECT * FROM people WHERE id = '$idToDelete'";
$resultInfo = mysqli_query($connection, $queryInfo);
$rowInfo = mysqli_fetch_assoc($resultInfo);

if (isset($_POST['confirm'])) {
    $queryDelete = "DELETE FROM people WHERE `id` = $idToDelete";
    if (mysqli_query($connection, $queryDelete)) {
        header("Location:userList.php");
    } else {
        echo '<script>alert("Error in deleting the profile");</script>';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>Deleting a profile</h2>
    <form id="deleteForm" action="" method="post">
          <div>
              <span>Deleting <?php echo $rowInfo['first_name'] . " " . $rowInfo['last_name']; ?></span>
          </div>

          <input type="submit" value="confirm" class="orange_yellow_btn" name="confirm">
      </form>
    <h2>User List</h2>
    
</body>
</html>