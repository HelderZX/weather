<?php

class WeatherApi{
    private $key    = null;
    private $error  = false;

    function __construct($key = null)
    {
        if(!empty($key)) $this->key = $key;
    }
    
    function request($endpoint = '', $params = array()){
        $uri = "https://api.openweathermap.org/".$endpoint."&appid=".$this->key."&units=metric&lang=ar";
        if(is_array($params)){
            foreach($params as $key => $value){
                if(empty($value)) continue;
                $uri .= $key .'='. urlencode($value) ."&";
            }
            $uri        = substr($uri, 0, -1);
            $response   = @file_get_contents($uri);
            $this->error = false;
            return json_decode($response, true);
        } 
        else{
            $this->error = true; 
            return false;
        }
    }

    function is_error(){
        return $this->error;
    }

    function info($lat, $lon){
        $data = $this->request('data/2.5/weather?lat='.urlencode($lat).'&lon='.urlencode($lon).'');

        if(!empty($data) && is_Array($data)){
            $this->error = false;
            return $data;
        }else{
            $this->error = true;
            return false;
        } 
    }
} 
?>