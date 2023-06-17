<?php

class LocationApi{
    private $key = null;
    private $error = false;

    function __construct($key = null){
        if(!empty($key)) $this->key = $key;
    }

    function info($query){
        $uri = "http://api.positionstack.com/v1/forward?access_key=".$this->key."&query=".$query."&limit=1";
        $response = @file_get_contents($uri);
        return json_decode($response, true);
    }

    function is_error(){
        return $this->error;
    }
} 

?>