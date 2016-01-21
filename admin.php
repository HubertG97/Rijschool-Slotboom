<?php
//Session start & cookie param set
session_set_cookie_params(0);
session_start();

//Check if user has admin rights
if($_SESSION["level"] == "2"){
  $access = true;
}else {
  header("location: index.php");
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
          <h2>Admin</h2>
        </div>
        <div class="col-md-7"></div>
      </div>
      <div class="row">
        <div id="space2" class="col-md-12"></div>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-9">
          <h3>Rijlessen</h3>
          <br>
          <br>
          //Tabel with oerview of all the appointments that are made
          <table id="table1">
            <thead>
            <tr>
              <td>Naam</td>
              <td>Achternaam</td>
              <td>Adres</td>
              <td>Postcode</td>
              <td>Plaats</td>
              <td>Telefoon</td>
              <td>Datum</td>
              <td>Tijd</td>
            </tr>
            </thead>
            <tbody>
          <?php
          //Generate columns with data of the appointment and the user
          if($access) {
            include_once 'php/dbconfig.php';

            //Join query to find the matching user with the appointment id and show them
            $sql2 = "SELECT a.first, a.last, a.address, a.zipcode, a.city, a.phone, r.date, r.time FROM sb_account a INNER JOIN sb_rijles r
          ON a.uid = r.uid;";
            $result2 = $conn->query($sql2);

            //Create rows with user information and appointment information
            if (mysqli_fetch_assoc($result2)) {
              while (($row = mysqli_fetch_assoc($result2))) {

                echo "<tr>";
                echo "<td>". $row['first']."</td>";
                echo "<td>". $row['last']."</td>";
                echo "<td>". $row['address']."</td>";
                echo "<td>". $row['zipcode']."</td>";
                echo "<td>". $row['city']."</td>";
                echo "<td>". $row['phone']."</td>";
                echo "<td>". $row['date']."</td>";
                echo "<td>". $row['time']."</td>";
                echo "</tr>";
              }
            } else {
              echo "Geen rijlessen gepland";
            }

          }else{
            header("location: index.php");
          }
          ?>
          </tbody>
          </table>
        </div>
        <div class="col-md-2"></div>
      </div>
    </div>
    <div class="col-md-1"></div>
  </div>
  <div class="col-md-1"></div>
  <!-- /#sidebar-wrapper -->
  <div class="footer"><p>&copy; Copyright 2016 Rijschool Frans Slotboom | KVK 24251557 | <a href="admin.php">Admin</a></p></div>
</body>
</html>