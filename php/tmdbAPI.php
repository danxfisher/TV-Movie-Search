<?php

include('sig_tmdb.php');

class TmdbAPI
{

  const TMDB_API_URL = 'https://api.themoviedb.org/3/movie/';
  const TMDB_API_SEARCH_URL = 'https://api.themoviedb.org/3/search/movie/';
  const TMDB_BASEURL = 'http://image.tmdb.org/t/p/w';

  // get popular movies
  public static function getPopularMovies()
  {
    $url = self::TMDB_API_URL
            . 'popular'
            . '?api_key='
            . SigGen_TMDB::getV3APIKey();

    $contents = file_get_contents($url);

    return $contents;
  }

  public static function decodePopularMoviesJSON()
  {
    $contents = self::getPopularMovies();
    $decodedResult = json_decode($contents, true);

    $results = $decodedResult['results']; //Results

    return $results;
  }

  // get backdrop for a random movie out of the current 'popular' movies
  public static function getPopularMovieBackdrop()
  {
    $popularMovies = self::decodePopularMoviesJSON();
    $length = count($popularMovies);

    $randomMovieNumber = rand(0,$length - 1);

    return self::TMDB_BASEURL . '1920' . $popularMovies[$randomMovieNumber]['backdrop_path'];
  }

  // get movie by title
  public static function getMovieByTitle()
  {
    $movieTitle = $_SESSION["movieTitle"];
    $movieTitle = str_replace(' ', '+', $movieTitle);

    $url = self::TMDB_API_SEARCH_URL
            . '?api_key='
            . SigGen_TMDB::getV3APIKey()
            . '&query='
            . $movieTitle;

    $contents = file_get_contents($url);

    return $contents;
  }

  // get backdrop for specific movie
  public static function getBackdropForMovie()
  {
    $contents = self::getMovieByTitle();

    $decodedResult = json_decode($contents, true);
    $results = $decodedResult['results'][0];

    return self::TMDB_BASEURL . '1920' . $results['backdrop_path'];
  }
}



 ?>
