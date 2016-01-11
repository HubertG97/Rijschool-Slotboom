<?php
session_set_cookie_params(0);
session_start();
// define variables and set to empty values

$nameErr = $emailErr = $phoneErr = $messageErr = "";
$name = $email = $message = $phone = "";

$from = "Contactformulier Website";

$subject = "Contactformulier Slotboom";
$body = "From: $name\n E-Mail: $email\n Message:\n $message";
$header = "From: noreply@slotboom.com\r\n";
$header.= "MIME-Version: 1.0\r\n";
$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$header.= "X-Priority: 1\r\n";


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Naam is verplicht";

  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
      $nameErr = "Only letters and white space allowed";
    }
  }






    if (empty($_POST["email"])) {
      $emailErr = "Email is verplicht";
    } else {
      $email = test_input($_POST["email"]);
      // check if e-mail address is well-formed
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Email niet geldig";
      }
    }

    if (empty($_POST["phone"])) {
      $phoneErr = "Telefoonnummer is verplicht";
    } else {
      $phone = test_input($_POST["phone"]);

    }

    if (empty($_POST["message"])) {
      $messageErr = "Vul een bericht in";
    } else {
      $message = test_input($_POST["message"]);
    }

  }
  if(isset($_POST['submit'])) {
    if(!$nameErr && !$emailErr && !$phoneErr && !$messageErr){
      if (mail ('hubertgetrouw@gmail.com', $subject, $body, $header)) {
        echo '<script type="text/javascript">alert("Email verzonden");</script>';
      } else {
        echo '<script type="text/javascript">alert("Error");</script>';


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
    <div id="jumbo" class="col-md-9 jumbotron">
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4 title">
          <h2>Proefles aanvragen</h2>
        </div>
        <div class="col-md-7"></div>
      </div>
      <div class="row">
        <div id="space2" class="col-md-12"></div>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-4">
          <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
              <label for="name">Naam</label>
              <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
              <span class="error">* <?php echo $nameErr;?></span>
            </div>
            <div class="form-group">
              <label for="email">Email adres</label>
              <input type="email" class="form-control" name="email" value="<?php echo $email;?>">
              <span class="error">* <?php echo $emailErr;?></span>
            </div>
            <div class="form-group">
              <label for="phone">Telefoon</label>
              <input type="phone" class="form-control" name="phone" value="<?php echo $phone;?>">
              <span class="error">* <?php echo $phoneErr;?></span>
            </div>
            <div class="form-group">
              <label for="message">Bericht:</label>
              <textarea class="form-control" rows="4" name="message" value="<?php echo $message;?>"></textarea>
            </div>

        </div>
        <div class="form-group">
          <div class="col-sm-offset-1 col-sm-9">
            <button type="submit" name="submit"  class="btn btn-default" value="aanmelden">Inschrijven</button>
          </div>
        </div>
        </form>



      </div>
      <div class="col-md-7"></div>
    </div>



  </div>
  <div class="col-md-1"></div>
  <!-- /#sidebar-wrapper -->

</body>
</html>