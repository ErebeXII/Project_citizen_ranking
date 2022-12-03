<?php

include 'DBConnection.php';

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
            echo 'WARNING : Redundancy in the DB';
        }
        // We have the address
        $row = mysqli_fetch_assoc($addressResult);
        $idAddress = $row['id'];
    } else {
        $queryNBAddress = "SELECT * FROM `address`";
        $addressNBResult = mysqli_query($connection, $queryNBAddress);
        $idAddress = mysqli_num_rows($addressNBResult) + 1;
        
        $queryNewAddress = "INSERT INTO `address`(`id`, `city`, `street`, `street_number`) VALUES ('$idAddress','$txtCity','$txtStreetName','$txtStreetNB')";

        if (mysqli_query($connection, $queryNewAddress)) {
            echo 'Address Added';
        } else {
            echo 'Error in address creation';
        }
    }

    // The id of the person is the number of persons in the DB + 1
    // IRL This could pose a problem if multiple try to create a profile at the same time

    $queryNBPeople = "SELECT * FROM people";
    $NBPeopleResult = mysqli_query($connection, $queryNBPeople);
    $IdPeople = mysqli_num_rows($NBPeopleResult) + 1;


    $query = "INSERT INTO `people`(`id`, `psw_visi`, `pwd`, `last_name`, `first_name`, `birthday`, `place_of_birth`, `current_adress_id`, `previous_address_id`, `email`, `phone`, `status`) VALUES ('$IdPeople','$txtPwd','$cryptedPwd','$txtLName','$txtFName','$txtBDay','$txtPOB','$idAddress',0,'$txtEmail','$txtPhone',2)";  

    if (mysqli_query($connection, $query)) {
        echo 'Less gooooooo';
    } else {
        echo 'Shimata';
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
    <link href="../css/classes.css" rel="stylesheet">
    <link href="../css/register.css" rel="stylesheet">
    <link rel="icon" href="https://images.emojiterra.com/google/noto-emoji/v2.034/512px/1f396.png">
    <title>Register</title>
</head>
<body>

    <div id="wrapper1">

        <div style="width: 100%">
            <h1>Welcome new citizen!</h1>
            <div onclick="location.href='main_page.html'" class="orange_yellow_btn return_main">↩</div>
        </div>


        <form action="" id="register_form" method="post">


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
                <span class="popuptext" id="popup_phone">Please enter a valid phone number, maximum 12 digits.
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
                <input type="password" id="password" class="text-input" placeholder="Enter your password" name="txtPwd">
                <span class="popuptext" id="popup_pwd1">Please enter a valid password must be less than 20 characters.
                </span>
            </div>

            <div class="popup hidden">
                <label for="confirm_password">Confirm Password</label><br>
                <input type="password" id="confirm_password" class="text-input"  placeholder="Verify your password">
                <span class="popuptext" id="popup_pwd2">Please makes sure the passwords match.
                </span>
            </div>

        </form>

            <input type="submit" form="register_form" value="Register" id="register_btn" class="orange_yellow_btn" onclick="submitRegisterForm()">
    </div>

</body>
</html>