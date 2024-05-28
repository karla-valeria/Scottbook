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
      $page_title = 'Delete';
        
      // header and menu for website layout, and loginbox class
      include 'include_files/header.inc.php';
      include 'include_files/menu.inc.php';
      include 'include_files/loginbox_class.inc.php';
    ?>

    <div class="main">
    <?php
        // get id from query string
        $id = urldecode($_GET['id']??NULL);

        // delete record
        $delete = new LoginBox();
        $delete->deleteAccount($id);
    ?>
    </div>
    
    <!-- Footer of website layout -->
    <?php include 'include_files/footer.inc.php'; ?>
</body>
</html>