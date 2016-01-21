<?php
//Start session & set cookie parameter
session_set_cookie_params(0);
session_start();

  //Check if user is logged in
  if (isset($_SESSION["uid"])) {
  header("location: index.php");
  echo '<script type="text/javascript">alert("Je bent al ingelogd");</script>';
}

  //Create empty variable for the password error
  $passError = "";

  //Database file
  include("php/dbconfig.php");

  //Compare username and password from the input field with the database
  if(isset($_POST['submit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $user = mysqli_real_escape_string($conn, $_POST['user']);
      $password = mysqli_real_escape_string($conn, $_POST['password']);
      $password = md5($password);
      $sql = "SELECT uid FROM sb_account WHERE user='$user' and password='$password'";
      $result = $conn->query($sql);
      $uid = mysqli_fetch_assoc($result);


  //Prepare session when user & password are correct
  if ($result->num_rows == 1) {

      //Database settings
      include("php/dbconfig.php");

      //Convert array got from the database to a string
      $uid = implode(" ",$uid);

      //Set session username & uid
      $_SESSION["user"] = $user;
      $_SESSION["uid"] = $uid;

      $uid = mysqli_real_escape_string($conn, $uid);

      //Search for first name of the user with the uid
      $sql2 = "SELECT first FROM sb_account WHERE uid='$uid'";
      $result2 = $conn->query($sql2);
      $first = mysqli_fetch_assoc($result2);

      //Convert array from database to string
      $first = implode(" ",$first);

      //Set session first name
      $_SESSION["first"] = $first;

     //set level for the session (normal user or admin)
      $level = mysqli_real_escape_string($conn, $level);
      $sql3 = "SELECT level FROM sb_account WHERE uid='$uid'";
      $result3 = $conn->query($sql3);
      $level = mysqli_fetch_assoc($result3);
      $level = implode(" ",$level);
      $_SESSION["level"] = $level;

      //redirect to inplannen page
      header("location: inplannen.php");

  } else
    //error if password is incorrect
    $passError = "Your Login Name or Password is invalid";
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
  <title></title>
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

      <li id="selected">
        <a id="sidebar-login" href="login.php">
          <?php
          //Show the name of the user when logged in
          if (isset($_SESSION["uid"])) {
            echo "Hallo "  .$_SESSION["first"];

          }else{
            echo "Log in";
          }
          ?>
        </a>
      </li>
      <li>
        <a id="sidebar-aanmelden"  href="aanmelden.php">
          <?php
          //show the sign up button or log out button
          if (isset($_SESSION["uid"])) {
            echo "Uitloggen";

          }else{
            echo "Aanmelden";
          }
          ?>
        </a>
      </li>
    </ul>
  </div>
  <div class="row">
    <div id="space3" class="col-md-12"></div>
  </div>
  <div class="row">
    <div class="col-md-2"></div>
    <div id="jumbo" class="col-md-9 jumbotron"><h3>Log in </h3>
      <form role="form" method="post" action=login.php>
        <!-- Username input field -->
        <div class="form-group">
        <label for="user">Gebruikersnaam</label>
        <input type="text" class="form-control" name="user" value="">
        <span class="error"></span>
      </div>
        <!-- password input field -->
        <div class="form-group">
        <label for="password">Wachtwoord</label>
        <input type="password" class="form-control" name="password" >
        <span class="error">* <?php echo $passError;?></span>

      </div>
        <!-- submit button -->
        <div class="form-group">
        <div class="col-sm-offset-1 col-sm-9">
          <button type="submit" name="submit"  class="btn btn-default" value="login">Log in</button>
        </div>
      </form>
    </div>
    <div class="col-md-1"></div>
    <!-- /#sidebar-wrapper -->
  </div>

  <div class="footer"><p>&copy; Copyright 2016 Rijschool Frans Slotboom | KVK 24251557 | <a href="admin.php">Admin</a></p></div>
</body>
</html>