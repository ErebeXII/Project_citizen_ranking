<?php

include 'DBConnection.php';
session_start();

if (!(isset($_SESSION['uid']))) {
    header("Location: login.php");
}

if ($_SESSION['status'] == 2) {
    header("Location: main_page.php");
}

if (isset($_POST['txtVName'])) {
    $vName = $_POST['txtVName'];
    $vDate = $_POST['txtVDate'];
    $vLevel = $_POST['txtVlevel'];
    $vIDPerson = $_POST['txtVIDAddress'];
    $vIDAdress = $_POST['txtVIDPerson'];

    $queryViolations = "SELECT * FROM `violation` ORDER BY `id` DESC";
    $violationsResult = mysqli_query($connection, $queryViolations);
    $violationsRow = mysqli_fetch_assoc($violationsResult);
    $vID = $violationsRow['id'] + 1;

    $queryPerson = "SELECT * FROM `people` WHERE `id` = '$vIDPerson'";
    $personResult = mysqli_query($connection, $queryPerson);
    $personRow = mysqli_fetch_assoc($personResult);

    if ($personRow['status_person'] > $_SESSION['status']) {

        // We only allow people of higher status to add violations

        switch ($vLevel) {
            case "1" :
                $totalPoints = -3;
                break;
            case "2" :
                $totalPoints = -10;
                break;
            case "3" :
                $totalPoints = -20;
                break;
            default :
                echo '<script> console.log("Error in level");</script>';
                $totalPoints = 0;
                break;            
        }
    
        $query = "INSERT INTO `violation`(`id`, `level_violation`, `name_violation`, `date_violation`, `address_id`, `total_points`, `id_person`) VALUES ('$vID','$vLevel','$vName','$vDate','$vIDAdress','$totalPoints','$vIDPerson')";
            
        if (mysqli_query($connection, $query)) {
            echo '<script> console.log("Person added successfully");</script>';
        } else {
            echo '<script> console.log("Error in person creation");</script>';
        }
    } else {
        echo '<script> console.log("Status too low");</script>';
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
  <link href="../css/register_violation.css" rel="stylesheet">
  <link href="../css/classes.css" rel="stylesheet">
  <script src="../js/register.js"></script>
  <script src="../js/violation_register.js"></script>

  <link rel="icon" href="https://images.emojiterra.com/google/noto-emoji/v2.034/512px/1f396.png">
  <title>Register Violation</title>
</head>

<body>

  <form id="register_violation_form" action="" method="post">
    <h1>Register A Violation</h1>

    <div class="popup hidden">
      <label for="violation_name">Violation Name</label><br>
      <input type="text" id="violation_name" class="text-input" placeholder="Name of the Violation" name="txtVName">
      <span class="popuptext" id="popup_Vname">Please enter a valid name.
                    Special characters others than
                    'é','è', ' ' and '-' are forbidden.
                </span>
    </div>

    <div class="popup hidden">
      <label for="violation_date">Violation Date</label><br>
      <input type="date" id="violation_date" class="text-input"  min="1915-01-01" max="<?= date('Y-m-d'); ?>" name="txtVDate">
      <span class="popuptext" id="popup_Vdate">Please enter a valid date.
                </span>
    </div>

    <div class="popup hidden">
      <label for="violation_level">Violation Level</label><br>
      <input type="text" id="violation_level" class="text-input"  placeholder="Level of the Violation" name="txtVlevel">
      <span class="popuptext" id="popup_Vlevel">Please enter a valid Violation level
                </span>
    </div>

    <div class="popup hidden">
      <label for="violation_id_address">ID of the address of the Violation</label><br>
      <input type="text" id="violation_id_address" class="text-input"  placeholder="Id of the address of the Violation"
             name="txtVIDAddress">
      <span class="popuptext" id="popup_VIDaddress">Please enter a valid ID address
                </span>
    </div>

    <div class="popup hidden">
      <label for="violation_id_person">ID of the perpetrator(s) of the Violation</label><br>
      <input type="text" id="violation_id_person" class="text-input"  placeholder="Id of the perpetrator(s) of the Violation"
             name="txtVIDPerson">
      <span class="popuptext" id="popup_VIDperson">Please enter a valid ID person
                </span>
    </div>


    <div id="button_div">
      <input type="button" value="Go Back" id="back" class="orange_yellow_btn" onclick="window.location.href = 'userList.php'">
      <input type="button" value="Register" id="register_violation_btn" class="orange_yellow_btn" onclick="submitViolationForm()">
    </div>

  </form>

</body>
</html>