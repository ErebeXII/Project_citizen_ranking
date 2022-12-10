<?php
include 'DBConnection.php';
session_start();

$uid = $_GET['id'];
$queryPerson = "SELECT * FROM people WHERE `id` = '$uid'";
$resultPerson = mysqli_query($connection, $queryPerson);
$rowPerson = mysqli_fetch_assoc($resultPerson);
$currentAddressId = $rowPerson['current_address_id'];
$queryCurrentAddress = "SELECT * FROM `address` WHERE `id_address` = '$currentAddressId'";
$resultCurrentAddress = mysqli_query($connection, $queryCurrentAddress);
$rowCurrentAddress = mysqli_fetch_assoc($resultCurrentAddress);

if (!(isset($_SESSION['uid']))) {
    header("Location: login.php");
}

if ($_SESSION['status'] == 2) {
    header("Location: main_page.php");
}

if (!isset($_GET["id"])) {
    
    header("Location: userList.php");
}

if (isset($_POST['txtPwd'])) {
    $txtPwd = $_POST['txtPwd'];
    $cryptedPwd = md5($txtPwd);
    $txtLName = $_POST['txtLName'];
    $txtFName = $_POST['txtFName'];
    $txtBDay = $_POST['txtBDay'];
    $txtPOB = $_POST['txtPOB'];
    $txtCity = $_POST['txtCity'];
    $txtStreetNB = strval($_POST['txtStreetNB']);
    $txtStreetName = $_POST['txtStreetName'];
    $txtPhone = $_POST['txtPhone'];
    $txtEmail = $_POST['txtEmail'];


    // We look to see if we already have the address in memory
    $queryAddress = "SELECT * FROM `address` WHERE city = '$txtCity' AND street = '$txtStreetName' AND street_number = '$txtStreetNB'";
    $addressResult = mysqli_query($connection, $queryAddress);
    $addressCount = mysqli_num_rows($addressResult);

    if ($addressCount > 0) {
        if ($addressCount > 1) {
            echo '<script> console.log("WARNING : Redundancy in the DB");</script>';
        }
        // We have the address
        $row = mysqli_fetch_assoc($addressResult);
        $idAddress = $row['id_address'];
    } else {
        $queryNBAddress = "SELECT * FROM `address`";
        $addressNBResult = mysqli_query($connection, $queryNBAddress);
        $idAddress = mysqli_num_rows($addressNBResult) + 1;
        
        $queryNewAddress = "INSERT INTO `address`(`id_address`, `city`, `street`, `street_number`) VALUES ('$idAddress','$txtCity','$txtStreetName','$txtStreetNB')";

        if (mysqli_query($connection, $queryNewAddress)) {
            echo '<script> console.log("Address Added");</script>';
        } else {
            echo '<script> console.log("Error in address creation");</script>';
        }
    }

    // The id of the person is the number of persons in the DB + 1
    // IRL This could pose a problem if multiple try to create a profile at the same time

    $queryNBPeople = "SELECT * FROM people";
    $NBPeopleResult = mysqli_query($connection, $queryNBPeople);
    $IdPeople = mysqli_num_rows($NBPeopleResult) + 1;

    $query = "UPDATE `people` SET `pwd`='$cryptedPwd',`last_name`='$txtLName',`first_name`='$txtFName',`birthday`='$txtBDay',`place_of_birth`='$txtPOB',`current_address_id`='$idAddress',`previous_address_id`='$currentAddressId',`email`='$txtEmail',`phone`='$txtPhone' WHERE `id` = '$uid'";
    
    if (mysqli_query($connection, $query)) {
        echo '<script> console.log("Person added successfully");</script>';
        header("Location: edit_page.php?id=$uid");
    } else {
        echo '<script> console.log("Error in person creation");</script>';
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
  <script src="../js/register.js"></script>
<script src="../js/edit_page.js"></script>
  <link href="../css/classes.css" rel="stylesheet">
  <link href="../css/register.css" rel="stylesheet">
  <link rel="icon" href="https://images.emojiterra.com/google/noto-emoji/v2.034/512px/1f396.png">
  <title>Edit User</title>
</head>
<body>

<div id="wrapper1">

  <div style="width: 100%">
    <h1 id="title_edit">Edit User</h1>
    <div onclick="javascript:history.back()" class="orange_yellow_btn return_main">↩</div>
  </div>


  <form action="" id="edit_form" method="post">


    <div class="popup hidden">
      <label for="firstname">First Name</label><br>
      <input type="text" id="firstname" class="text-input"  placeholder="Firstname" name="txtFName">
      <span class="popuptext" id="popup_fname">Please enter a valid first name.
                    Spaces and special characters others than
                    'é','è' and '-' are forbidden.
                </span>
    </div >

    <div class="popup hidden">
      <label for="lastname">Last Name</label><br>
      <input type="text" id="lastname" class="text-input" placeholder="Enter your surname" name="txtLName">
      <span class="popuptext" id="popup_lname">Please enter a valid last name.
                    Spaces and special characters others than
                    'é','è' and '-' are forbidden.
                </span>
    </div>

    <div class="popup hidden">
      <label for="bday">Birthday</label><br>
      <input type="date" id="bday" class="text-input"  min="1915-01-01" max="<?= date('Y-m-d'); ?>" name="txtBDay">
      <span class="popuptext" id="popup_bday">Please enter a valid date.
                </span>
    </div>

    <div class="popup hidden">
      <label for="place_birth">Place Of Birth</label><br>
      <input id="place_birth" list="dlCities" class="text-input" placeholder="Enter your place of birth" name="txtPOB">
      <span class="popuptext" id="popup_pbirth">Please enter a valid city name.
                </span>
      <datalist id="dlCities"></datalist> <script>load_dlCities()</script>

    </div>

    <div class="popup hidden">
      <label for="current_address_street">Current Address</label><br>
      <input type="number" id="current_address_n" class="text-input"  placeholder="N°" style="width: 10%" name="txtStreetNB">
      <input type="text" id="current_address_street" class="text-input"  placeholder="Street Name" style="width: 42%" name="txtStreetName">
      <input list="dlCities" id="current_address_city" class="text-input"  placeholder="City" style="width: 35%" name="txtCity">
      <span class="popuptext" id="popup_address">Please enter a valid address.
                </span>
    </div>

    <div class="popup hidden">
      <label for="phone_n">Phone N°(optional)</label><br>
      <input type="text" id="phone_n" class="text-input"  placeholder="Enter Your Phone Number" name="txtPhone">
      <span class="popuptext" id="popup_phone">Please enter a valid phone number with the following format : 000 000 0000
                </span>
    </div>

    <div class="popup hidden">
      <label for="e-mail">E-Mail (optional)</label><br>
      <input type="email" id="e-mail" class="text-input"  placeholder="Enter Your e-mail" name="txtEmail">
      <span class="popuptext" id="popup_mail">Please enter a valid e-mail address.
                </span>
    </div>


    <div class="popup hidden">
      <label for="password">Password</label><br>
      <input id="password" class="text-input" placeholder="Enter your password" name="txtPwd">
      <span class="popuptext" id="popup_pwd1">Please enter a valid password must be less than 20 characters.
                </span>
    </div>

    <div class="popup hidden">
      <label for="confirm_password">Confirm Password</label><br>
      <input id="confirm_password" class="text-input"  placeholder="Verify your password">
      <span class="popuptext" id="popup_pwd2">Please makes sure the passwords match.
                </span>
    </div>

  </form>

  <input type="button" form="edit_form" value="Edit User" id="edit_btn" class="orange_yellow_btn" onclick="submitEditForm()">
</div>

<?php
    $jsonToPass1 = json_encode($rowPerson);
    $jsonToPass2 = json_encode($rowCurrentAddress);
    echo "<script>loadUser('$jsonToPass1', '$jsonToPass2');</script>"; ?>

</body>
</html>