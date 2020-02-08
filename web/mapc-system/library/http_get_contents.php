<?php
if(! function_exists('httpGetContents')) {
    function httpGetContents($URL){
        $ch = curl_init();
        $return = [];
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $URL);
        $return['data'] = curl_exec($ch);
        curl_close($ch);

        $return['json'] = (is_string($data)
                && is_array(json_decode($string, true))
                && (json_last_error() == JSON_ERROR_NONE)) ? true : false;

        return $return;
    }
}

// this is it
