<html>
  <head>
    <title>
      ScottBook
    </title>
    <link rel="stylesheet" href="style.css" />
  </head>
  <body>
    
    <?php 
      session_start();
      // Page title variable
      $page_title = 'Homepage';
        
      // header and menu for website layout
      include 'include_files/header.inc.php';
      include 'include_files/menu.inc.php';
    ?>

    <div class="main">
      <p>Welcome to ScottBook
        <?php
          if (isset($_SESSION['full_name'])) {
            echo ', '.$_SESSION['full_name'];
          }?>
      </p>
    </div>
    
    <!-- Footer of website layout -->
    <?php include 'include_files/footer.inc.php'; ?>
</body>
</html>