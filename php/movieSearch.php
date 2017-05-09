<?php
    session_start();
    include('roviAPI.php');
    RoviAPI::decodeSearchJSON();
    $providers = RoviAPI::decodeZipcodeJSON();
?>
<!doctype html>
<html>
  <head>
      <title>Select Provider</title>
      <link rel="stylesheet" href="../css/normalize.css">
      <link rel="stylesheet" href="../css/skeleton.css">
      <link rel="stylesheet" href="../css/styles.css">
      <script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
      <script src="http://cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js"></script>
      <script language="javascript">
          function setTimezone(){
              var tz = jstz.determine(); // Determines the time zone of the browser client
              return tz.name();
          }
          window.onload = function(){
              document.getElementById('timezone').value = setTimezone();
          }
      </script>
  </head>
  <body>
      <form action="schedule.php" method="get">
          <input type="hidden" id="timezone" name="timezone" />
          <div class="container">
              <div id="process">
                  <div id="process-top">
                      <h1>Select your local cable or satellite provider:</h1>
                  </div>
                  <div id="process-main">
                      <div class="row">
                          <div class="twelve columns">
                              <?php
                                  echo '<select name="serviceProvider">';

                                  for($i = 0; $i < count($providers); $i++)
                                  {
                                      echo '<option value='. $providers[$i][0] .' class="options">' . $providers[$i][1] . '</option>';
                                  }

                                  echo '</select>';
                              ?>
                          </div>
                      </div>
                      <div class="row">
                          <div class="twelve columns align-right">
                              <input type="submit" value="submit">
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </form>
  </body>
</html>
