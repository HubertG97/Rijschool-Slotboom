<?php
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
    <div id="space" class="col-md-12"></div>
  </div>
  <div class="row">
    <div class="col-md-2"></div>
    <div id="jumbo" class="col-md-9 jumbotron"><h2>Al bijna 40 jaar ervaring!</h2>
    <h3>in regio Rotterdam, Rhoon, Barendrecht en Ridderkerk. </h3>



    </div>
    <div class="col-md-1"></div>
  <!-- /#sidebar-wrapper -->

</body>
</html>