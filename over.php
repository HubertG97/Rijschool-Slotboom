<?php
//Session start & cookie param set
session_set_cookie_params(0);
session_start();
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
<<<<<<< HEAD
  <title>Slotboom</title>
=======
  <title></title>
>>>>>>> origin/master
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
      <li id="selected">
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
    <div id="space" class="col-md-12"></div>
  </div>
  <div class="row">
    <div class="col-md-2"></div>
    <div id="jumbo" class="col-md-9 jumbotron">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4 title">
          <h2>Over</h2>
        </div>
        <div class="col-md-7"></div>
      </div>
      <div class="row">
        <div id="space2" class="col-md-12"></div>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-7">
          <!-- Pricing -->

          <h3>Prijzen</h3>

          <p>Startpakket:       499,00 Euro (12 lessen incl theorie)</p>
          <p>Lesprijs:          39,00 Euro</p>
          <p>Examen:            250,00 Euro</p>
          <p>Herexamen          240,00 Euro</p>
          <p>Tussentijdse toets 210,00 Euro</p>
      </div>
      <div class="col-md-4"></div>
    </div>
  </div>
  <div class="col-md-1"></div>
    </div>
    <div class="col-md-1"></div>
    <!-- /#sidebar-wrapper -->
  <div class="footer"><p>&copy; Copyright 2016 Rijschool Frans Slotboom | KVK 24251557 | <a href="admin.php">Admin</a></p></div>
</body>
</html>