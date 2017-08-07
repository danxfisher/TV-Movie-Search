<?php

include('php/tmdbAPI.php');

$goteem = TmdbAPI::getPopularMovieBackdrop();

if (isset($_SESSION['backdrop']))
{
  unset($_SESSION['backdrop']);
}

include('header.php');
?>

  <div class="background-container" style="background-image: url(<?php echo $goteem ?>);">
  </div>
  <div class="content-container">
    <div class="container">
      <div class="grid" id="search">
        <div class="row">
          <div class="column">
            <div id="search-top">
              <h1>When is my movie on TV?</h1>
            </div>
          </div>
        </div>
        <form action="movieSearch.php" method="get">
          <div class="row" id="search">

            <div class="column grow column-border">
              <input type="text" name="movieTitle" placeholder="Enter Movie Title">
            </div>
            <div class="column grow">
              <input type="text" name="zipCode" placeholder="Enter Zip Code">
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
