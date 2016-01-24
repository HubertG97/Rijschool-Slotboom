
<?php
//start session
session_start();

//check if user is logged in, if not user is send to login
if ($_SESSION["uid"] == "") {
    header("location: login.php");
}
    //Set uid variable with the uid from the session
    $uid = $_SESSION["uid"];

    //When button is pressed set date & time variable to the selected date & time
    if (isset($_POST['submit'])) {
        if (isset($_SESSION)) {
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $lesdate = $_POST["date"];
                $lestime = $_POST["time"];

            }
            include_once 'php/dbconfig.php';

            //Compare selected date & time to those that are already in the database
            $sql = "SELECT time, date FROM sb_rijles WHERE date = \"$lesdate\" AND time = \"$lestime\" ";
            $result = $conn->query($sql);

            //Insert date & time in the database when there is no equal combination of date & time in the database
            if ($result->num_rows == 0) {


                $sql = "INSERT INTO sb_rijles (uid, date, time)
                VALUES ('$uid', '$lesdate', '$lestime')";


                //Shows message if the insert succeeded or failed
                if ($conn->query($sql) == TRUE) {

                    echo '<script type="text/javascript">alert("New record created successfully");</script>';

                } else {
                    echo '<script type="text/javascript">alert("Error");</script>';

                }
                //close database
                $conn->close();

                header("location: inplannen.php");

            } else {
                echo '<script type="text/javascript">alert("Bezet");</script>';

            }

        }else{
            echo '<script type="text/javascript">alert("niet ingelogd");</script>';
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
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <meta charset="UTF-8">
    <title>Slotboom</title>
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
      <li id="selected">
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
                <h2>Rijles inplannen</h2>
            </div>
            <div class="col-md-1 ">
            </div>
            <div class="col-md-4 ">
                <br>
                <h3>Geplande rijlessen</h3>
            </div>
            <div class="row">
                <div id="space2" class="col-md-12"></div>
            </div>
            <div class="col-md-7"></div>
        </div>
        <div class="row">
            <div class="col-md-1"></div>
            <div class="col-md-5">

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">


        <select name="date" class="dropdown">

                <?php
                //set the first and laste date to select

                $startdate = strtotime("+2 days");
                $enddate = strtotime("+8 weeks",$startdate);

                //Generate the days to select in the form
                while ($startdate < $enddate) {
                    echo '<option value="';
                    echo date("l M d", $startdate);
                    echo '">';
                    echo date("l M d", $startdate);
                    echo '</option>';
                    echo '<br>';
                    $startdate = strtotime("+1 day", $startdate);
                }

                ?>
            </select>
                <br>
            <select name="time" class="dropdown">

            <?php
                //Select the first and last hour to select
                $starttime = mktime(8,0);
                $endtime = strtotime("+11 hours",$starttime);

                //Generate hours to select in the form
                while ($starttime < $endtime) {
                    echo '<option value="';
                    echo date("G:i", $starttime);
                    echo '">';
                    echo date("G:i", $starttime);
                    echo '</option>';
                    echo '<br>';
                    $starttime = strtotime("+1 hour", $starttime);
                }
            ?>
        </select>
            <br>
            <button type="submit" name="submit"  class="btn btn-default" value="inplannen">Inplannen</button>
            <br>
            <br>
            <br>
            <br>
            <br>
            <br>
        </form>

        </div>
            <div class="col-md-5 title">
            <?php
            include_once 'php/dbconfig.php';

            //Query to find the appointments the user already has
            $sql2 = "SELECT time, date FROM sb_rijles WHERE uid = \"$uid\" ";


            //Check if result variable is not empty
            if($result2 = $conn->query($sql2)) {

                //Show the appointments of the user in the browser
                while( ($row = mysqli_fetch_assoc($result2)))
                {

                    echo $row['date'];
                    echo " ";
                    echo $row['time'];
                    echo "<br>";


                }
            }else{
                //Message when no appointments are found
                echo "Geen rijlessen gepland";
            }
            ?>
            </div>

        </div>
    </div>
  </div>

    <!-- Footer -->
    <div class="footer"><p>&copy; Copyright 2016 Rijschool Frans Slotboom | KVK 24251557 | <a href="admin.php">Admin</a></p></div>
</body>
</html>