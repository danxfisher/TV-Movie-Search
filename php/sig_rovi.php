<?php

class SigGen
{
    public static function getTimeStamp()
    {
        return time();
    }

    public static function getSharedSecret()
    {
        return "ENTER_SHARED_SECRET";
    }

    //API key for search (movie title)
    public static function getAPIKey()
    {
        return "ENTER_API_KEY_FOR_SEARCH";
    }

    //API key for schedule, providers, and movie description
    public static function getTvAPIKey()
    {
        return "ENTER_API_KEY_FOR_SCHEDULE";
    }

    //for Movie Title info
    public static function createSearchMD5Hash()
    {
        $string = self::getAPIKey() . self::getSharedSecret() . self::getTimeStamp();

        $md = md5($string);
        return $md;
    }

    //for Zipcode info
    public static function createZipcodeMD5Hash()
    {
        $string = self::getTvAPIKey() . self::getSharedSecret() . self::getTimeStamp();

        $md = md5($string);
        return $md;
    }
    public static function createMD5Hash($apiKey)
    {
        $string = $apiKey . self::getSharedSecret() . self::getTimeStamp();

        $md = md5($string);
        return $md;
    }
}

?>
