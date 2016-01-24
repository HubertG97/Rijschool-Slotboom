<?php
//session start & cookie parameter set
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
  <title>Slotboom</title>
</head>
<body>
<div id="fb-root"></div>
<script>(function(d, s, id) {
    var js, fjs = d.getElementsByTagName(s)[0];
    if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
    js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.5";
    fjs.parentNode.insertBefore(js, fjs);
  }(document, 'script', 'facebook-jssdk'));</script>


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
    <div class="col-md-9 jumbotron" id="jumbohome">
      <!-- Homepage content -->
      <h2>Welkom bij rijschool Slotboom!</h2>
      <br>
      <p>Wil je beginnen met rijlessen, maar weet je nog niet welke rijschool je gaat kiezen?</p>
      <p>Ben jij op zoek naar een rijschool met veel ervaring? Een instructeur met veel geduld en aandacht?</p>
      <p>Dan is rijschool Slotboom de juiste keus!</p>
      <p>Met al bijna 40 jaar ervaring in de regio Rotterdam, Rhoon, Ridderkerk en Barendrecht zal je gegarandeerd slagen!</p>
      <br>
      <p>Er wordt gereden in een Mercedes B-klasse in de bovengenoemde regio's.</p>
      <p>Het startpakket bestaat uit 12 lessen met theorieboek en een online oefenomgeving.</p>
      <p>Eventueel kan er een lespakket samengesteld worden afhankelijk van aanvangsniveau, na overleg
        te bepalen bij uw eerste les.</p>




    </div>

    <div class="col-md-1"></div>
  </div>
  <div class="row">
    <div class="col-md-2"></div>
        <div class="col-md-9 jumbotron" id="jumbo2">
          <div class="row">
            <div class="col-md-4 ">
              <!-- Facebook review -->
              <div class="panel panel-default">
                <div id="fb-root"></div><script>(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.3";  fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/sophie.vanoosten/posts/937485649651835:0"><p>Zojuist in 1 keer geslaagd door rijschool Slotboom! Altijd gezellige lessen gehad en superveel tips gekregen van Frans, echt een aanrader!</p>Geplaatst door <a href="https://www.facebook.com/sophie.vanoosten">Sophie van Oosten</a> op&nbsp;<a href="https://www.facebook.com/sophie.vanoosten/posts/937485649651835:0">woensdag 7 oktober 2015</a></blockquote></div></div>
            </div>

            <div class="col-md-4 ">
              <!-- Facebook review -->
              <div class="panel panel-default">
                <div id="fb-root"></div><script>(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.3";  fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/hubert.getrouw/posts/954018001323930:0"><p>Vandaag geslaagd voor mijn rijbewijs! Hele gezellige en leerzame lessen gehad met Frans! Hij neemt goed de tijd voor je en is erg duidelijk. Bedankt voor alles!</p>Geplaatst door <a href="https://www.facebook.com/hubert.getrouw">Hubert Getrouw</a> op&nbsp;<a href="https://www.facebook.com/hubert.getrouw/posts/954018001323930:0">donderdag 27 augustus 2015</a></blockquote></div></div>
            </div>

            <div class="col-md-4 ">
              <!-- Facebook review -->
              <div class="panel panel-default">
                <div id="fb-root"></div><script>(function(d, s, id) {  var js, fjs = d.getElementsByTagName(s)[0];  if (d.getElementById(id)) return;  js = d.createElement(s); js.id = id;  js.src = "//connect.facebook.net/nl_NL/sdk.js#xfbml=1&version=v2.3";  fjs.parentNode.insertBefore(js, fjs);}(document, 'script', 'facebook-jssdk'));</script><div class="fb-xfbml-parse-ignore"><blockquote cite="https://www.facebook.com/melvin.kraat/posts/400536210157186:0"><p>Rijbewijs net gehaald! Frans is een uitstekende instructeur en tevens ook een geweldig persoon om naast je te hebben in...</p>Geplaatst door <a href="https://www.facebook.com/melvin.kraat">Melvin Kraat</a> op&nbsp;<a href="https://www.facebook.com/melvin.kraat/posts/400536210157186:0">woensdag 14 oktober 2015</a></blockquote></div></div>
            </div>
            </div>
          </div>
        </div>
        </div>
    <div class="col-md-1"></div>
  </div>
  <!-- /#sidebar-wrapper -->
<div class="footer"><p>&copy; Copyright 2016 Rijschool Frans Slotboom | KVK 24251557 | <a href="admin.php">Admin</a></p></div>


</body>
</html>