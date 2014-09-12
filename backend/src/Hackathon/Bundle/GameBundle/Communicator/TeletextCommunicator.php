<?php

namespace Hackathon\Bundle\GameBundle\Communicator;

class TeletextCommunicator
{

    private static $channel = 'SRFInfo';
    private static $page = '595';
    private static $apiEndpoint = 'http://webtest2.swisstxt.ch/TeletextPublishApi/pages/';


    public static function post($text)
    {
        var_dump($text);
        $ch = curl_init(self::$apiEndpoint . self::$channel . '/' . self::$page);

        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $text);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: text/plain'));

//        curl_setopt($ch, CURLOPT_VERBOSE, true);

        $result = curl_exec($ch);
        curl_close($ch);


        // TODO: Return a usable value, if POST fails
        //return $result;
    }


}
