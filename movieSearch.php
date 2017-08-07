<?php
  session_start();
  include('php/roviAPI.php');
  include('php/tmdbAPI.php');

  RoviAPI::decodeSearchJSON();
  $providers = RoviAPI::decodeZipcodeJSON();

  $backdrop = TmdbAPI::getBackdropForMovie();

  $_SESSION['backdrop'] = $backdrop;

  include('header-movie-search.php');
?>
    <div class="background-container" style="background-image: url(<?php echo $backdrop; ?>);">
    </div>
    <div class="content-container">
      <div class="container">
        <div class="grid" id="provider">
          <div class="row">
            <div class="column">
              <div id="provider-top">
                <h1>Select your local cable or satellite provider:</h1>
              </div>
            </div>
          </div>
          <form action="schedule.php" method="get">
            <input type="hidden" id="timezone" name="timezone" />
            <div class="row" id="search">

              <div class="column grow">
                <div class="flexcenter">
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
              <div class="column">
                <div class="flexcenter">
                  <!-- <input type="submit" value="submit"> -->
                  <button type="submit" class="">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                  </button>
                </div>
              </div>

            </div>
          </form>
        </div>
      </div>
    </div>

<?php include('footer.php'); ?>
