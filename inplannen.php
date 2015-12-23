
<?php



if(isset($_POST['submit'])) {
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $lesdate = $_POST["date"];
        $lestime = $_POST["time"];

    }
        include_once 'php/dbconfig.php';

        $sql = "SELECT time, date FROM rijles WHERE date = \"$lesdate\" AND time = \"$lestime\" ";
        $result = $conn->query($sql);


        if ($result->num_rows == 0) {


            $sql = "INSERT INTO rijles (date, time)
VALUES ('$lesdate', '$lestime')";

            if ($conn->query($sql) == TRUE) {
                echo '<script type="text/javascript">alert("New record created successfully");</script>';
            } else {
                echo '<script type="text/javascript">alert("Error");</script>';
                // echo   "Error: " . $sql . "<br>" . $conn->error;
            }

            $conn->close();

        } else {
            echo '<script type="text/javascript">alert("Bezet");</script>';
            // echo   "Error: " . $sql . "<br>" . $conn->error;
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

        <form method="post" action="<?php echo $_SERVER["PHP_SELF"];?>">


        <select name="date" class="dropdown">

                <?php
                $startdate = strtotime("+2 days");
                $enddate = strtotime("+8 weeks",$startdate);

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
                $starttime = mktime(8,0);
                $endtime = strtotime("+11 hours",$starttime);

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

        </form>






    </div>

    <!-- /#sidebar-wrapper -->

</body>
</html>