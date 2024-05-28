<html>
  <head>
    <title>
      ScottBook
    </title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    
    <?php 
      // start session
      session_start();
      // Page title variable
      $page_title = 'Weather';
        
      // header and menu for website layout, and loginbox class
      include 'include_files/header.inc.php';
      include 'include_files/menu.inc.php';
      include 'include_files/loginbox_class.inc.php';
    ?>

    <div class="main">
    <?php
      $url="http://api.openweathermap.org/data/2.5/forecast?q=Phoenix,usl&APPID=5099c5feb579c7a17b030de0d009282f&units=imperial";
      $json=file_get_contents($url);
      $data=json_decode($json);
  
      echo '<h1>', $data->city->name, ' (', $data->city->country, ')</h1>';
  
      // the general information about the weather
      echo '<h2>Temperature:</h2>';
      echo '<p><strong>Current:</strong> ', $data->list[0]->main->temp, '&deg; F</p>';
      echo '<p><strong>Min:</strong> ', $data->list[0]->main->temp_min, '&deg; F</p>';
      echo '<p><strong>Max:</strong> ', $data->list[0]->main->temp_max, '&deg; F</p>';
    ?>
    </div>
    
    <!-- Footer of website layout -->
    <?php include 'include_files/footer.inc.php'; ?>
</body>
</html>