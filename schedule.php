<?php
  session_start();
  include('php/roviAPI.php');
  $schedule = RoviAPI::decodeScheduleJSON();

  if (isset($_REQUEST['timezone']))
  {
    $_SESSION["timezone"] = $_REQUEST['timezone'];
    $timezone = $_SESSION["timezone"];
    $timezone = str_replace('_', ' ', $timezone);
  }

  if (isset($_SESSION['backdrop']))
  {
    $backdrop = $_SESSION['backdrop'];
  }
  else {
    $backdrop = '';
  }

  include('header.php');
?>
  <div class="background-container" style="background-image: url(<?php echo $backdrop ?>);">
  </div>
  <div class="content-container">
    <div class="schedule-container">
      <div id="schedule">
        <div id="schedule-top">
            <h1>Your local schedule:</h1>
        </div>
        <div id="schedule-main">
          <?php
            echo "<table border='0'>";

            for($i = 0; $i < count($schedule); $i++)
            {
              $utc = $schedule[$i][1];
              $dt = new DateTime($utc);
              $tz = new DateTimeZone($_SESSION["timezone"]);
              $dt->setTimezone($tz);
              $result = $dt->format('m/d/Y h:i:s A');

              $schedule[$i][1] = $result;

              echo "<tr>";
              echo "<td>" . $schedule[$i][0] . "</td><td>" . $schedule[$i][1] . "</td>";
              echo "</tr>";
            }

            echo "</table>";
          ?>
        </div>
        <div id="schedule-bottom">
          <p>Local time for <?php echo $timezone ?></p>
        </div>
      </div>
    </div>
  </div>

<?php include('footer.php'); ?>
