<?php
session_set_cookie_params(0);
session_start();
if (isset($_SESSION["uid"])) {
  header("location: index.php");
  echo '<script type="text/javascript">alert("Je bent al ingelogd");</script>';
}
$passError = "";
include("php/dbconfig.php");

if(isset($_POST['submit'])) {
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $user = mysqli_real_escape_string($conn, $_POST['user']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $password = md5($password);
  $sql = "SELECT uid FROM sb_account WHERE user='$user' and password='$password'";
  $result = $conn->query($sql);
  $uid = mysqli_fetch_assoc($result);
 // var_dump($uid);



  if ($result->num_rows == 1) {

    include("php/dbconfig.php");

    $uid = implode(" ",$uid);


    $_SESSION["user"] = $user;
    $_SESSION["uid"] = $uid;

    $uid = mysqli_real_escape_string($conn, $uid);
    $sql2 = "SELECT first FROM sb_account WHERE uid='$uid'";
    $result2 = $conn->query($sql2);
    $first = mysqli_fetch_assoc($result2);

   // var_dump($first);
    $first = implode(" ",$first);

    $_SESSION["first"] = $first;
  //  echo $_SESSION["first"];

      header("location: inplannen.php");

  } else
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
      <li id="selected">

        <a  href="index.php">Home</a>

      </li>
      <li>
        <a href="#">Over</a>
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
        <a id="sidebar-login" href="login.php"><?php
          if (isset($_SESSION["uid"])) {
            echo "Hallo, "  .$_SESSION["first"];

          }else{
            echo "Log in";
          }

          ?></a>
      </li>
      <li>
        <a id="sidebar-aanmelden"  href="aanmelden.php"><?php
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
    <div id="space3" class="col-md-12"></div>
  </div>
  <div class="row">
    <div class="col-md-2"></div>
    <div id="jumbo" class="col-md-9 jumbotron"><h3>Log in </h3>
      <form role="form" method="post" action=login.php>
      <div class="form-group">
        <label for="user">Gebruikersnaam</label>
        <input type="text" class="form-control" name="user" value="">
        <span class="error"></span>
      </div>
      <div class="form-group">
        <label for="password">Wachtwoord</label>
        <input type="text" class="form-control" name="password" >
        <span class="error">* <?php echo $passError;?></span>

      </div>
      <div class="form-group">
        <div class="col-sm-offset-1 col-sm-9">
          <button type="submit" name="submit"  class="btn btn-default" value="login">Log in</button>
        </div>
      </form>
    </div>
    <div class="col-md-1"></div>
    <!-- /#sidebar-wrapper -->

</body>
</html>