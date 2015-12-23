
<?php

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

        <form action="inplannen.php">


        <select name="date" class="dropdown">

                <?php
                $startdate = strtotime("+2 days");
                $enddate = strtotime("+8 weeks",$startdate);

                while ($startdate < $enddate) {
                    echo '<option value="$startdate">';
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
                    echo '<option value="$starttime">';
                    echo date("G:i", $starttime);
                    echo '</option>';
                    echo '<br>';
                    $starttime = strtotime("+1 hour", $starttime);
                }


                ?>










        </select>

        </form>






    </div>

    <!-- /#sidebar-wrapper -->

</body>
</html>