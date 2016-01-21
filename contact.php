
<?php
//start session and set cookie param to 0
session_set_cookie_params(0);
session_start();

// define variables and set to empty values
$nameErr = $emailErr = $phoneErr = $messageErr = "";
$name = $email = $message = $phone = "";

//set variables for email of the contact form
$from = "Contactformulier Website";

$subject = "Contactformulier Slotboom";
$body = "From: $name\n E-Mail: $email\n Message:\n $message";
$header = "From: noreply@slotboom.com\r\n";
$header.= "MIME-Version: 1.0\r\n";
$header.= "Content-Type: text/html; charset=ISO-8859-1\r\n";
$header.= "X-Priority: 1\r\n";

//protect against SQL injection, strip unnecessary characters
function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

//Validation of input data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["name"])) {
    $nameErr = "Naam is verplicht";

  } else {
    $name = test_input($_POST["name"]);
    if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
      $nameErr = "Alleen letters toegestaan";
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
//submit the data to email to the admin
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
        <a href="#">Slotboom</a>
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
      <li id="selected">
        <a href=".php">Contact</a>
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
          <h2>Contact</h2>
        </div>
        <div class="col-md-1 ">
        </div>
        <div class="col-md-4 ">
          <br>

        </div>
        <div class="row">
          <div id="space2" class="col-md-12"></div>
        </div>
        <div class="col-md-7"></div>
      </div>
      <div class="row">
        <div class="col-md-1"></div>
        <div class="col-md-5">
          <p>WIlt u contact met ons opnemen?</p>
          <p>Stuur dan een mail of bel ons.</p>
          <p>Ook kunt u mailen via ons contact formulier hieronder.</p>
          <br>
          <!-- Contactform -->
          <form role="form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
            <div class="form-group">
              <!-- Name -->
              <label for="name">Naam</label>
              <input type="text" class="form-control" name="name" value="<?php echo $name;?>">
              <span class="error">* <?php echo $nameErr;?></span>
            </div>
            <!-- Email -->
            <div class="form-group">
              <label for="email">Email adres</label>
              <input type="email" class="form-control" name="email" value="<?php echo $email;?>">
              <span class="error">* <?php echo $emailErr;?></span>
            </div>
            <!-- Phone -->
            <div class="form-group">
              <label for="phone">Telefoon</label>
              <input type="phone" class="form-control" name="phone" value="<?php echo $phone;?>">
              <span class="error">* <?php echo $phoneErr;?></span>
            </div>
            <!-- Message -->
            <div class="form-group">
              <label for="message">Bericht:</label>
              <textarea class="form-control" rows="4" name="message" value="<?php echo $message;?>"></textarea>
            </div>
            <div>
              <!-- Submit Button -->
              <button type="submit" name="submit"  class="btn btn-default" value="aanmelden">Inschrijven</button>
            </div>
        </div>
        </form>
        <div class="col-md-1"></div>
        <div class="col-md-6">
          <!-- Google maps location -->
            <div id="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2464.532997325817!2d4.482338815961075!3d51.85122409332623!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47c43158a1606c11%3A0x66923a42abc99d6a!2sBezeel+47%2C+3162+VA+Rhoon!5e0!3m2!1snl!2snl!4v1453128355168" width="100%" height="200" frameborder="0" style="border:0" allowfullscreen></iframe>
            <hr>
              <!-- Contact information -->
              <h3>Gegevens</h3>
              <p><strong>Naam:</strong> F.H.J. Slotboom</p>
              <p><strong>Telefoon:</strong> 0622204640</p>
              <p><strong>Email:</strong> fransslotboom@gmail.com</p>
              <p><strong>Adres:</strong> Bezeel 47 3162 VA Rhoon</p>
            </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Footer -->
  <div class="footer"><p>&copy; Copyright 2016 Rijschool Frans Slotboom | KVK 24251557 | <a href="admin.php">Admin</a></p></div>
</body>
</html>