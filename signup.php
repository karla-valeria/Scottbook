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
      $page_title = 'Sign Up';
        
      // header and menu for website layout, and loginbox class
      include 'include_files/header.inc.php';
      include 'include_files/menu.inc.php';
      include 'include_files/loginbox_class.inc.php';
    ?>

    <div class="main">
    <?php
      $signup = new LoginBox();
    
      // Get input data into array
      $username = $_GET['username'] ?? NULL;
      $password = $_GET['password'] ?? NULL;
      $first_name = $_GET['first_name'] ?? NULL;
      $last_name = $_GET['last_name'] ?? NULL;
      $full_name = $_GET['full_name'] ?? NULL;
      $email = $_GET['email'] ?? NULL;
      $phone_number = $_GET['phone_number'] ?? NULL;
      $theme = $_GET['theme'] ?? NULL;
  
      $form_fields = array("username"=>$username, "password"=>$password,
    "first_name"=>$first_name, "last_name"=>$last_name, "full_name"=>$full_name, "email"=>$email,
    "phone_number"=>$phone_number, "theme"=>$theme);
  
      $submit = $_GET['submit'] ?? NULL;
  
      if (isset($submit)) {
        // process sign up form
        $signup->createAccount($form_fields);
      } else {
        // display sign up form
        echo $signup->getAccountForm();
      }
    ?>
    </div>
    
    <!-- Footer of website layout -->
    <?php include 'include_files/footer.inc.php'; ?>
</body>
</html>