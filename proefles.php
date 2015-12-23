<?php
// define variables and set to empty values
$nameErr = $emailErr = $addressErr = $cityErr = $phoneErr = "";
$first = $email = $last = $comment = $phone = $city = $address = $zipcode = "";


function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["first"])) {
    $nameErr = "Naam is verplicht";

  } else {
    $first = test_input($_POST["first"]);
    if (!preg_match("/^[a-zA-Z ]*$/", $first)) {
      $nameErr = "Only letters and white space allowed";
    }
  }


  if (empty($_POST["last"])) {
    $nameErr = "Naam is verplicht";
  } else {
    $last = test_input($_POST["last"]);


    if (!preg_match("/^[a-zA-Z ]*$/", $last)) {
      $nameErr = "Only letters and white space allowed";
    }

    if (empty($_POST["address"])) {
      $addressErr = "Adres is verplicht";
    } else {
      $address = test_input($_POST["address"]);

    }

    if (empty($_POST["zipcode"])) {
      $zipcodeErr = "Postcode is verplicht";
    } else {
      $zipcode = test_input($_POST["zipcode"]);

    }

    if (empty($_POST["city"])) {
      $cityErr = "Woonplaats is verplicht";
    } else {
      $city = test_input($_POST["city"]);

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

    if (empty($_POST["comment"])) {
      $comment = "";
    } else {
      $comment = test_input($_POST["comment"]);
    }

  }
  if(isset($_POST['submit'])) {

  include_once 'php/dbconfig.php';




    $first = mysqli_real_escape_string($conn, $first);
    $last = mysqli_real_escape_string($conn, $last);
    $address = mysqli_real_escape_string($conn, $address);
    $zipcode = mysqli_real_escape_string($conn, $zipcode);
    $city = mysqli_real_escape_string($conn, $city);
    $phone = mysqli_real_escape_string($conn, $phone);
    $comment = mysqli_real_escape_string($conn, $comment);




  $sql = "INSERT INTO proefles (first, last, address, zipcode, city, email, phone, comment)
VALUES ('$first', '$last', '$address', '$zipcode', '$city', '$email', '$phone', '$comment')";

 if ($conn->query($sql) == TRUE) {
 echo '<script type="text/javascript">alert("New record created successfully");</script>';
  } else {
   echo '<script type="text/javascript">alert("Error");</script>';
 // echo   "Error: " . $sql . "<br>" . $conn->error;
 }

  $conn->close();
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
        <a href="#">Rijles plannen</a>
      </li>
      <li>
        <a href="#">Contact</a>
      </li>

      <li>
        <a id="sidebar-login" href="#">Log in</a>
      </li>
      <li>
        <a id="sidebar-aanmelden"  href="#">Aanmelden</a>
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

          </div>
          <div class="form-group">
            <label for="city">Woonplaats</label>
            <input type="text" class="form-control" name="city" value="<?php echo $city;?>">
            <span class="error">* <?php echo $cityErr;?></span>
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
            <label for="comment">Comment:</label>
            <textarea class="form-control" rows="4" name="comment"></textarea>
          </div>

          </div>
        <div class="form-group">
          <div class="col-sm-offset-1 col-sm-9">
            <button type="submit" name="submit"  class="btn btn-default" value="aanmelden">Inschrijven</button>
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

</body>
</html>