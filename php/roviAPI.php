<?php

include('sig_rovi.php');

class RoviAPI
{
    //Get JSON for movie title search results
    public static function getSearchResult()
    {
        $movieTitle = $_GET['movieTitle'];
        $movieTitle = str_replace(' ', '+', $movieTitle);

        //Set movie title session variable
        $_SESSION["movieTitle"] = $movieTitle;

        $url = "http://api.rovicorp.com/search/v2.1/video/search?apikey="
                . SigGen::getAPIKey()
                . "&sig=" . SigGen::createMD5Hash(SigGen::getAPIKey())
                . "&query=" . $movieTitle
                . "&entitytype=movie&size=1";
        $contents = file_get_contents($url);

        return $contents;
    }

    //Get JSON for service providers in user requested zipcode
    public static function getZipcodeResult()
    {
        $zipCode = $_GET['zipCode'];

        $url = "http://api.rovicorp.com/TVlistings/v9/listings/services/postalcode/"
                . $zipCode
                . "/info?locale=en-US&countrycode=US&apikey="
                . SigGen::getTvAPIKey()
                . "&sig=" . SigGen::createMD5Hash(SigGen::getTvAPIKey());

        $contents = file_get_contents($url);

        return $contents;
    }

    //Get JSON for TV schedule results
    public static function getScheduleResult()
    {
        $movieTitle = $_SESSION["movieTitle"];
        $movieTitle = str_replace(' ', '+', $movieTitle);

        $serviceId = $_GET['serviceProvider'];

        $url = "http://api.rovicorp.com/data/v1.1/video/schedule?apikey="
                . SigGen::getAPIKey()
                . "&sig=" . SigGen::createMD5Hash(SigGen::getAPIKey())
                . "&video=" . $movieTitle
                . "&serviceid=" . $serviceId
                . "&country=US&language=en&count=10";

        $contents = file_get_contents($url);

        return $contents;
    }

    public static function decodeSearchJSON()
    {
        $contents = self::getSearchResult();
        $decodedResult = json_decode($contents, true);

        $results = $decodedResult['searchResponse']['results'][0]['video']['masterTitle']; //Movie Title

        //echo $results;
    }

    public static function decodeZipcodeJSON()
    {
        $contents = self::getZipcodeResult();
        $decodedResult = json_decode($contents, true);

        $results = array();
        $c = 0;

        if(is_array($decodedResult))
        {
            foreach($decodedResult['ServicesResult']['Services']['Service'] as $chunk)
            {
                $serviceID = $chunk['ServiceId'];
                $providerName = $chunk['Name'];

                $tuple = array($serviceID, $providerName);

                $results[$c] = $tuple;
                ++$c;
            }
        }

        return $results;
    }

    public static function decodeScheduleJSON()
    {
        $contents = self::getScheduleResult();
        $decodedResult = json_decode($contents, true);

        $results = array();
        $c = 0;

        if(is_array($decodedResult))
        {
            foreach($decodedResult['schedule']['airings'] as $chunk)
            {
                $TvStation = $chunk['sourceFullName'];
                $showTime = $chunk['time'];

                $tuple = array($TvStation, $showTime);

                $results[$c] = $tuple;
                ++$c;
            }
        }

        return $results;
    }
}

?>
