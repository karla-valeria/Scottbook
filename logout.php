<!DOCTYPE html>
<html lang="en">
<head>
    <title>
      ScottBook
    </title>
    <link rel="stylesheet" href="style.css" />
  </head>
<body>
  <?php
  session_start();
  unset($_SESSION['valid_user']);
  session_destroy();

  // Page title variable
  $page_title = 'Logout';
        
  // header and menu for website layout, and loginbox class
  include 'include_files/header.inc.php';
  include 'include_files/menu.inc.php';
  ?>
  <div class="main">
    <p>You've been successfully logged out!</p>
  </div>

  <?php include 'include_files/footer.inc.php'; ?>
</body>
</html>
