<<<<<<< HEAD
<?php
   
   require_once 'app/config/config.php';
   require_once 'app/modules/weather.php';
   require_once 'app/modules/location.php';
   
   // Get Location Data
   
   $location = new LocationApi(LOCATION_API_KEY);
   $hasSearch = isset($_REQUEST['search']);
   
   if($hasSearch){
      $locationInfo = $location->info($_REQUEST['search']);
   }else{
      $locationInfo = $location->info("Inglaterra, Londres");
   }

   if($location->is_error() == false){
      $lat = $locationInfo['data'][0]['latitude'];
      $lon = $locationInfo['data'][0]['longitude'];
      $unit = $_REQUEST['unit'];
      // Get Weather Data
      $weather = new WeatherApi(WEATHER_API_KEY);
      $weatherInfo = $weather->info($lat, $lon, $unit);
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
      <select class="input-select">
         <option>Portugal</option>
         <option>Espanha</option>
         <option>França</option>
      </select>
   </nav>
   <div class="content">
      <?php if(isset($weather) && $weather->is_error() == false):?>
      <div class="left">
         <div class="border">
            <div class="card main">
               <div class="card-title">
                  <h1>
                     <?php
                        if($locationInfo['data'][0]['region'] != null)
                        echo $locationInfo['data'][0]['region'];
                        if($locationInfo['data'][0]['country'] != null)
                        echo ", ".$locationInfo['data'][0]['country'];
                     ?>
                  </h1>
               </div>
               <div class="card-content">
                  <div class="main">
                     <div>
                        <p class="main-temperature"><?php echo $weatherInfo['main']['temp'];?>º</p>
                        <p class="description"><?php echo $weatherInfo['weather'][0]['description'];?></p>
                     </div>
                     <h1>
                        <i id="icon" class="fas "></i>
                     </h1>
                  </div>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-title">
               <h1>Detalhes</h1>
            </div>
            <div class="card-content">
               <div class="details">
                  <div><i class="fa-solid fa-brain"></i></div>
                  <div>
                     <p class="description">sensasâo térmica</p>
                     <p class="description"><?php echo $weatherInfo['main']['feels_like'];?>º</p>
                  </div>
               </div>
            </div>
            <div class="card-content">
               <div class="details">
                  <div><i class="fa-solid fa-droplet"></i></div>
                  <div>
                     <p class="description">humidade</p>
                     <p class="description"><?php echo $weatherInfo['main']['humidity'];?>%</p>
                  </div>
               </div>
            </div>
            <div class="card-content">
               <div class="details">
                  <div><i class="fa-solid fa-down-left-and-up-right-to-center"></i></div>
                  <div>
                     <p class="description">pressão</p>
                     <p class="description"><?php echo $weatherInfo['main']['pressure'];?></p>
                  </div>
               </div>
            </div>
            <div class="card-content">
               <div class="details">
                  <div><i class="fa-solid fa-wind"></i></div>
                  <div>
                     <p class="description">vento</p>
                     <p class="description"><?php echo $weatherInfo['wind']['speed'];?> km/h</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php else:?>
         <div class="border error">
            <div class="card main">
               <div class="card-title">
                  <h1>Não encontrado</h1>
               </div>
               <div class="card-content">
                  <div class="main">
                     <p class="description">Sem resultados a apresentar.</p>
                  </div>
               </div>
            </div>
         </div>
      <?php endif;?>
      <div class="right">
         <div class="card">
            <form method="POST" action="/home.php">
               <div class="card-title text-center">
                  <h1>Pesquisar</h1>
               </div>
               <div class="card-content">
                  <div class="input-box">
                     <label for="search" class="input-label">Cidade/Região:</label>
                     <input type="text" id="search" name="search" class="input-search" placeholder="Ex.: Entrecampos, Lisboa">
                  </div>
                  
                  <div class="input-box">
                     <label for="switch" class="input-label">Unidade:</label>
                     <div id="switch" class="triple-toggle-button">
                        <div class="option first default"><button type="button" value="default">Kelvin</button></div>
                        <div class="option second metric"><button type="button" value="metric">Celsius</button></div>
                        <div class="option third imperial"><button type="button" value="imperial">Fahrenheit</button></div>
                     </div>
                     <input type="text" id="tempType" name="unit" value="metric" hidden>
                  </div>
                  
                  <div class="input-box">
                     <button class="button-main">Procurar</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
   <script type="text/javascript" src="js/home.js"></script>
   <script>
      var search = "";
      search = "<?php if($hasSearch) echo $_REQUEST['search']?>";
      const searchInput = document.getElementById("search");
      searchInput.value = search;

      tempType = "<?php if($hasSearch) echo $_REQUEST['unit']?>";
      document.getElementsByClassName(tempType)[0].classList.add("active");
      iconMain = "<?php if($hasSearch) echo $weatherInfo['weather'][0]['main']?>";
      icon = "";
      switch(iconMain){
         case "Clouds":
            icon = "fa-cloud";
         break;
         case "Clear":
            icon = "fa-sun";
         break;
         case "Snow":
            icon = "fa-snowflake";
         break;
         case "Rain":
            icon = "fa-cloud-showers-heavy";
         break;
         case "Drizzle":
            icon = "fa-cloud-drizzle";
         break;
         case "Thunderstorm":
            icon = "fa-bolt";
         break;
         default:
            icon = "fa-cloud";
      }
      
      document.getElementById("icon").classList.add(icon);
   </script>
</body>
</html>

=======
<?php
   require_once 'app/config/config.php';
   require_once 'app/modules/weather.php';
   require_once 'app/modules/location.php';
   
   // Get Location Data
   
   $location = new LocationApi(LOCATION_API_KEY);
   
   if(isset($_REQUEST['search'])){
      $locationInfo = $location->info($_REQUEST['search']);
   }else{
      $locationInfo = $location->info("Inglaterra, Londres");
   }

   if($location->is_error() == false){
      $lat = $locationInfo['data'][0]['latitude'];
      $lon = $locationInfo['data'][0]['longitude'];
      // Get Weather Data
      $weather = new WeatherApi(WEATHER_API_KEY);
      $weatherInfo = $weather->info($lat, $lon);
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
      <select class="input-select">
         <option>Portugal</option>
         <option>Espanha</option>
         <option>França</option>
      </select>
   </nav>
   <div class="content">
      <?php if(isset($weather) && $weather->is_error() == false):?>
      <div class="left">
         <div class="border">
            <div class="card main">
               <div class="card-title">
                  <h1>
                     <?php
                        if($locationInfo['data'][0]['region'] != null)
                        echo $locationInfo['data'][0]['region'];
                        if($locationInfo['data'][0]['country'] != null)
                        echo ", ".$locationInfo['data'][0]['country'];
                     ?>
                  </h1>
               </div>
               <div class="card-content">
                  <div class="main">
                     <div>
                        <p class="main-temperature"><?php echo $weatherInfo['main']['temp'];?>º</p>
                        <p class="description"><?php echo $weatherInfo['weather'][0]['description'];?></p>
                     </div>
                     <h1><i class="fa-solid fa-cloud-sun"></i></h1>
                  </div>
               </div>
            </div>
         </div>
         <div class="card">
            <div class="card-title">
               <h1>Detalhes</h1>
            </div>
            <div class="card-content">
               <div class="details">
                  <div><i class="fa-solid fa-brain"></i></div>
                  <div>
                     <p class="description">sensasâo térmica</p>
                     <p class="description"><?php echo $weatherInfo['main']['feels_like'];?>º</p>
                  </div>
               </div>
            </div>
            <div class="card-content">
               <div class="details">
                  <div><i class="fa-solid fa-droplet"></i></div>
                  <div>
                     <p class="description">humidade</p>
                     <p class="description"><?php echo $weatherInfo['main']['humidity'];?>%</p>
                  </div>
               </div>
            </div>
            <div class="card-content">
               <div class="details">
                  <div><i class="fa-solid fa-down-left-and-up-right-to-center"></i></div>
                  <div>
                     <p class="description">pressão</p>
                     <p class="description"><?php echo $weatherInfo['main']['pressure'];?></p>
                  </div>
               </div>
            </div>
            <div class="card-content">
               <div class="details">
                  <div><i class="fa-solid fa-wind"></i></div>
                  <div>
                     <p class="description">vento</p>
                     <p class="description"><?php echo $weatherInfo['wind']['speed'];?> km/h</p>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <?php else:?>
         <div class="border error">
            <div class="card main">
               <div class="card-title">
                  <h1>Não encontrado</h1>
               </div>
               <div class="card-content">
                  <div class="main">
                     <p class="description">Sem resultados a apresentar.</p>
                  </div>
               </div>
            </div>
         </div>
      <?php endif;?>
      <div class="right">
         <div class="card">
            <form method="POST" action="/home.php">
               <div class="card-title">
                  <h1>Pesquisar</h1>
               </div>
               <div class="card-content">
                  <div class="input-box">
                     <label for="search" class="input-label">Cidade/Região:</label>
                     <input type="text" id="search" name="search" class="input-search" placeholder="Ex.: Entrecampos, Lisboa">
                  </div>
                  
                  <div class="input-box">
                     <label for="switch" class="input-label">Unidade:</label>
                     <div id="switch" class="triple-toggle-button">
                        <div class="option first">Kelvin</div>
                        <div class="option second active">Celsius</div>
                        <div class="option third">Fahrenheit</div>
                     </div>
                  </div>
                  
                  <div class="input-box">
                     <button class="button-main">Procurar</button>
                  </div>
               </div>
            </form>
         </div>
      </div>
   </div>
    <script href="js/home.js"></script>
</body>
</html>

>>>>>>> 6d64880caa4c3d5eb96874a092e3dcb4ea914ba6
