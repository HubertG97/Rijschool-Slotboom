<?php
session_set_cookie_params(0);
session_start();
if (isset($_SESSION["uid"])) {
  // remove all session variables
  session_unset();

// destroy the session
  session_destroy();
  header("location: index.php");

}
// define variables and set to empty values
$nameErr = $emailErr = $addressErr = $cityErr = $phoneErr = $passwordErr = "";
$first = $email = $last = $comment = $phone = $city = $address = $zipcode = $password = $user = "";

//Remove special characters
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
//Validate form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["first"])) {
    $firstChecker = false;
    $nameErr = "Naam is verplicht";
  } else {
    $first = test_input($_POST["first"]);
    $firstChecker = true;
    if (!preg_match("/^[a-zA-Z ]*$/", $first)) {
      $firstChecker = false;
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["password"])) {
    $passwordErr = "wachtwoord is verplicht";
    $passChecker = false;
  } else {
    $passChecker = true;
    $password = test_input($_POST["password"]);
  }

  if (strlen($password) < 4) {
    $passChecker = false;
    $passwordErr = "wachtwoord moet minimaal 4 karakters bevatten";
  } else {
    $passChecker = true;
  }

  if (empty($_POST["last"])) {
    $nameErr = "Naam is verplicht";
    $lastChecker = false;
  } else {
    $lastChecker = true;
    $last = test_input($_POST["last"]);

    if (!preg_match("/^[a-zA-Z ]*$/", $last)) {
      $lastChecker = false;
      $nameErr = "Only letters and white space allowed";
    }
  }

  if (empty($_POST["address"])) {
    $addressChecker = false;
    $addressErr = "Adres is verplicht";
  } else {
    $addressChecker = true;
    $address = test_input($_POST["address"]);

  }

  if (empty($_POST["zipcode"])) {
    $zipChecker = false;
    $zipcodeErr = "Postcode is verplicht";
  } else {
    $zipChecker = true;
    $zipcode = test_input($_POST["zipcode"]);

  }

  if (empty($_POST["city"])) {
    $cityChecker = false;
    $cityErr = "Woonplaats is verplicht";
  } else {
    $cityChecker = true;
    $city = test_input($_POST["city"]);

  }

  if (empty($_POST["user"])) {
    $userChecker = false;
    $emailErr = "Email is verplicht";
  } else {
    $userChecker = true;
    $user = test_input($_POST["user"]);
    // check if e-mail address is well-formed
    if (!filter_var($user, FILTER_VALIDATE_EMAIL)) {
      $infoChecker = false;
      $emailErr = "Email niet geldig";
    }
  }

  if (empty($_POST["phone"])) {
    $phoneErr = "Telefoonnummer is verplicht";
    $phoneChecker = false;
  } else {
    $phoneChecker = true;
    $phone = test_input($_POST["phone"]);

  }
//check if all formdata is correct
if ($firstChecker && $lastChecker && $userChecker && $passChecker && $addressChecker && $cityChecker && $zipChecker && $phoneChecker == true) {

  //send to database when submit button is pressed
  if (isset($_POST['submit'])) {

    include_once 'php/dbconfig.php';

    //add backslashes to special characters
    $first = mysqli_real_escape_string($conn, $first);
    $last = mysqli_real_escape_string($conn, $last);
    $address = mysqli_real_escape_string($conn, $address);
    $zipcode = mysqli_real_escape_string($conn, $zipcode);
    $city = mysqli_real_escape_string($conn, $city);
    $phone = mysqli_real_escape_string($conn, $phone);

    //encrypt the password
    $password = md5($password);

    //query to add account to database
    $sql = "INSERT INTO sb_account (user, password, first, last, address, zipcode, city, phone, level)
VALUES ('$user', '$password', '$first', '$last', '$address', '$zipcode', '$city', '$phone', '0')";

    //message if succeeded or failed
    if ($conn->query($sql) == TRUE) {
      echo '<script type="text/javascript">alert("New record created successfully");</script>';
    } else {
      echo '<script type="text/javascript">alert("Error");</script>';
    }
    //close database connection
    $conn->close();
  }
}
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <link media="all" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="cssb/stylesheet.css" type="text/css" charset="utf-8" />
  <link href="cssb/simple-sidebar.css" rel="stylesheet">
  <link rel="stylesheet" href="cssb/main.css" type="text/css">
  <meta charset="UTF-8">
  <title>Slotboom</title>
</head>
<body>


<div id="wrapper">

  <!-- Sidebar -->
  <div id="sidebar-wrapper">
    <ul class="sidebar-nav">
      <li class="sidebar-brand" id="sidebar-brand">
        <a href="#">
          Slotboom
        </a>
      </li>
      <li>
        <a  href="index.php">Home</a>
      </li>
      <li>
        <a href="over.php">Over</a>
      </li>
      <li>
        <a href="proefles.php">Proefles</a>
      </li>
      <li>
        <a href="inplannen.php">Rijles plannen</a>
      </li>
      <li>
        <a href="contact.php">Contact</a>
      </li>
      <li>
        <a id="sidebar-login" href="login.php">
          <?php
          //Show the name of the user when logged in
          if (isset($_SESSION["uid"])) {
            echo "Hallo "  .$_SESSION["first"];

          }else{
            echo "Log in";
          }

          ?></a>
      </li>
      <li id="selected">
        <a id="sidebar-aanmelden"  href="aanmelden.php">
          <?php
          //show the sign up button or log out button
          if (isset($_SESSION["uid"])) {
            echo "Uitloggen";

          }else{
            echo "Aanmelden";
          }

          ?></a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div id="space" class="col-md-12"></div>
  </div>
  <div class="row">
    <div class="col-md-2"></div>
    <div id="jumbo" class="col-md-9 jumbotron">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4 title">
          <h2>Aanmelden</h2>
        </div>
        <div class="col-md-7"></div>
      </div>
      <div class="row">
        <div id="space2" class="col-md-12"></div>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
          <!-- Form -->
          <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
              <div class="form-group">
                <label for="user">Email adres</label>
                <input type="email" class="form-control" name="user" value="<?php echo $user;?>">
                <span class="error">* <?php echo $emailErr;?></span>
              </div>
            <div class="form-group">
              <label for="password">Wachtwoord</label>
              <input type="password" class="form-control" name="password" value="<?php echo $password;?>">
              <span class="error">* <?php echo $passwordErr;?></span>
            </div>
            <div class="form-group">
              <label for="first">Naam</label>
              <input type="text" class="form-control" name="first" value="<?php echo $first;?>">
              <span class="error">* <?php echo $nameErr;?></span>
            </div>

            <div class="form-group">
              <label for="last">Achternaam</label>
              <input type="text" class="form-control" name="last" value="<?php echo $last;?>">
              <span class="error">* <?php echo $nameErr;?></span>
            </div>
            <div class="form-group">
              <label for="address">Adres</label>
              <input type="text" class="form-control" name="address" value="<?php echo $address;?>">
              <span class="error">* <?php echo $addressErr;?></span>
            </div>
            <div class="form-group">
              <label for="zipcode">Postcode</label>
              <input type="text" class="form-control" name="zipcode" value="<?php echo $zipcode;?>">
              <span class="error">* </span>

            </div>
            <div class="form-group">
              <label for="city">Woonplaats</label>
              <input type="text" class="form-control" name="city" value="<?php echo $city;?>">
              <span class="error">* <?php echo $cityErr;?></span>
            </div>

            <div class="form-group">
              <label for="phone">Telefoon</label>
              <input type="phone" class="form-control" name="phone" value="<?php echo $phone;?>">
              <span class="error">* <?php echo $phoneErr;?></span>
            </div>


        </div>
        <div class="form-group">
          <div class="col-sm-offset-1 col-sm-9">
            <button type="submit" name="submit"  class="btn btn-default" value="register">aanmelden</button>
          </div>
        </div>
        </form>
        </form>


      </div>
      <div class="col-md-7"></div>
    </div>




  </div>
  <div class="col-md-1"></div>
  <!-- /#sidebar-wrapper -->
  <div class="footer"><p>&copy; Copyright 2016 Rijschool Frans Slotboom | KVK 24251557 | <a href="admin.php">Admin</a></p></div>
</body>
</html>