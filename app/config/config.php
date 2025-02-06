<?php
    declare(strict_types=1);
    define('__ROOT__',  dirname(dirname(dirname(__FILE__))));
    
    require_once('vendor/autoload.php');

    $dotenv = Dotenv\Dotenv::createImmutable(__ROOT__);
    $dotenv->load();

    define('WEATHER_API_KEY', $_ENV['WEATHER_API_KEY']);
    define('LOCATION_API_KEY', $_ENV['LOCATION_API_KEY']);
?>