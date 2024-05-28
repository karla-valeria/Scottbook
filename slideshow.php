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
      $page_title = 'My Pictures';
        
      // header and menu for website layout, and loginbox class
      include 'include_files/header.inc.php';
      include 'include_files/menu.inc.php';
      include 'include_files/loginbox_class.inc.php';
    ?>

    <div class="main">
      <div class="slideshow">
        <?php
          // pick random row from images table to display
          $dbh = new Dbh();
          $query = "SELECT * FROM images WHERE id = '".rand(1,7)."'";
          $result = $dbh->query($query);
          $row = $result->fetch_assoc();

          $url = $row['url'];
          $title = $row['title'];
          $caption = $row['caption'];

          echo '<img src="'.$url.'" id="picture">';
          echo '<div class="caption"><h2>'.$title.'</h2>';
          echo '<p>'.$caption.'</p>';
        ?>
        <!-- button for sliding through pictures -->
        <form class="slideshow-btn" action="slideshow.php" method="get">
          <button type="submit" class="slideshow-btn" id="submit" name="submit">></button>
        </form></div>
      </div>
    </div>
    
    <!-- Footer of website layout -->
    <?php include 'include_files/footer.inc.php'; ?>
</body>
</html>