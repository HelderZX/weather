<?php

require_once 'app/config/config.php';
require_once 'app/modules/weather.php';
require_once 'app/modules/location.php';

// Get Location Data

$location = new LocationApi(LOCATION_API_KEY);
$hasSearch = isset($_REQUEST['search']);
$lang = $_REQUEST['langInput'] ?? "en";

if ($hasSearch && $_REQUEST['search'] != "") {
    $locationInfo = $location->info($_REQUEST['search'], $lang);
} else {
    $locationInfo = $location->info("Inglaterra, Londres", "en");
}

if ($location->is_error() == false) {
    $lat = $locationInfo['data'][0]['latitude'];
    $lon = $locationInfo['data'][0]['longitude'];
    $unit = $_REQUEST['unit'] ?? "default";
    // Get Weather Data
    $weather = new WeatherApi(WEATHER_API_KEY);
    $weatherInfo = $weather->info($lat, $lon, $lang, $unit);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather</title>
    <!-- CSS -->
    <link rel="stylesheet" href="css/home.css">
    <!-- Font Awesome -->
    <script src="https://kit.fontawesome.com/26acf264ae.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="nav-bar">
        <h1><i class="fa-solid fa-snowflake"></i></h1>
        <select id="lang" class="input-select">
            <option id="lang-en" value="en" selected></option>
            <option id="lang-pt" value="pt"></option>
            <option id="lang-es" value="es"></option>
            <option id="lang-fr" value="fr"></option>
        </select>
    </nav>
    <div class="content">
        <?php if (isset($weather) && $weather->is_error() == false) : ?>
            <div class="left">
                <div class="border">
                    <div class="card main">
                        <div class="card-title">
                            <h1>
                                <?php
                                if ($locationInfo['data'][0]['region'] != null)
                                    echo $locationInfo['data'][0]['region'] . ", ";
                                if ($locationInfo['data'][0]['country'] != null)
                                    echo $locationInfo['data'][0]['country'];
                                ?>
                            </h1>
                        </div>
                        <div class="card-content">
                            <div class="main">
                                <div class="temp">
                                    <p class="main-temperature"><?php echo $weatherInfo['main']['temp']; ?>º</p>
                                    <h1>
                                        <i id="icon" class="fas "></i>
                                    </h1>
                                </div>
                                <div class="desc">
                                    <p class="description"><?php echo $weatherInfo['weather'][0]['description']; ?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-title">
                        <h1 id="details"></h1>
                    </div>
                    <div class="card-content">
                        <div class="details">
                            <div><i class="fa-solid fa-brain"></i></div>
                            <div>
                                <p id="thermal_sensation" class="description"></p>
                                <p class="description"><?php echo $weatherInfo['main']['feels_like']; ?>º</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="details">
                            <div><i class="fa-solid fa-droplet"></i></div>
                            <div>
                                <p id="humidity" class="description"></p>
                                <p class="description"><?php echo $weatherInfo['main']['humidity']; ?>%</p>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="details">
                            <div><i class="fa-solid fa-down-left-and-up-right-to-center"></i></div>
                            <div>
                                <p id="pressure" class="description"></p>
                                <p class="description"><?php echo $weatherInfo['main']['pressure']; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="details">
                            <div><i class="fa-solid fa-wind"></i></div>
                            <div>
                                <p id="wind" class="description"></p>
                                <p class="description"><?php echo $weatherInfo['wind']['speed']; ?> km/h</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php else : ?>
            <div class="border error">
                <div class="card main">
                    <div class="card-title">
                        <h1 id="not_found"></h1>
                    </div>
                    <div class="card-content">
                        <div class="main">
                            <p id="no_results" class="description"></p>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="right">
            <div class="card">
                <form method="POST" action="/home.php">
                    <div class="card-title text-center">
                        <h1 id="research">
                        </h1>
                    </div>
                    <div class="card-content">
                        <input type="text" id="langInput" name="langInput" hidden>

                        <div class="input-box">
                            <label id="city_region" for="search" class="input-label"></label>
                            <input type="text" id="search" name="search" class="input-search" placeholder="Ex.: Entrecampos, Lisboa">
                        </div>

                        <div class="input-box">
                            <label id="unit" for="switch" class="input-label"></label>
                            <div id="switch" class="triple-toggle-button">
                                <div class="option first default"><button type="button" value="default">Kelvin</button></div>
                                <div class="option second metric"><button type="button" value="metric">Celsius</button></div>
                                <div class="option third imperial"><button type="button" value="imperial">Fahrenheit</button></div>
                            </div>
                            <input type="text" id="tempType" name="unit" value="default" hidden>
                        </div>

                        <div class="input-box">
                            <button id="button-main" class="button-main"></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="js/lang.js"></script>
    <script type="text/javascript">
        var search = "";
        search = "<?php if ($hasSearch) echo $_REQUEST['search'] ?>";
        var tempType = "<?php if ($hasSearch) echo $_REQUEST['unit'] ?>";
        var lang = "<?php if ($hasSearch) echo $_REQUEST['langInput'] ?>";
        var iconMain = "<?php if ($hasSearch && isset($weatherInfo)) echo $weatherInfo['weather'][0]['main'] ?>";
    </script>
    <script type="text/javascript" src="js/home.js"></script>
</body>

</html>