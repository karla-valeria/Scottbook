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
      $page_title = 'Login';
        
      // header and menu for website layout, and loginbox class
      include 'include_files/header.inc.php';
      include 'include_files/menu.inc.php';
      include 'include_files/loginbox_class.inc.php';
    ?>

    <div class="main">
    <?php
    // display form on page and authenticate login
    $login = new LoginBox();
    $username = $_GET['username'] ?? NULL;
    $password = $_GET['password'] ?? NULL;
    $submit = $_GET['submit'] ?? NULL;

    if (isset($submit)) {
      $login->authenticate_input($username, $password);
    } else {
        // try catch block when trying to display form
        try
        {
        if (!isset($login)) {
            throw new Exception("LoginBox object has not been instantiated");
        }
        else {
            echo $login->login_form();
        }
        }
        catch (Exception $e)
        {
        echo "an error has ocurred: ". $e->getMessage();
        }

        // Sign up link
        echo 'or <a href="signup.php">Sign Up</a>';
    }
  ?>
    </div>
    
    <!-- Footer of website layout -->
    <?php include 'include_files/footer.inc.php'; ?>
</body>
</html>