<?php

class LocationApi{
    private $key = null;
    private $error = false;

    function __construct($key = null){
        if(!empty($key)) $this->key = $key;
    }

    function info($query, $lang){
        $uri = "http://api.positionstack.com/v1/forward?access_key=".$this->key."&query=".$query."";
        $response = @file_get_contents($uri);
        if (json_encode($response) == "false") $this->error = true;
        return json_decode($response, true);
    }

    function is_error(){
        return $this->error;
    }
} 

?>