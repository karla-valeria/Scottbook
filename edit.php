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
      $page_title = 'Edit';
        
      // header and menu for website layout, and loginbox class
      include 'include_files/header.inc.php';
      include 'include_files/menu.inc.php';
      include 'include_files/loginbox_class.inc.php';
    ?>

    <div class="main">
    <?php
        // decode query string input
        $id = urldecode($_GET['id']??NULL);
        $username = urldecode($_GET['username']??NULL);
        $password = urldecode($_GET['password']??NULL);
        $first_name = urldecode($_GET['first_name']??NULL);
        $last_name = urldecode($_GET['last_name']??NULL);
        $full_name = urldecode($_GET['full_name']??NULL);
        $email = urldecode($_GET['email']??NULL);
        $phone_number = urldecode($_GET['phone_number']??NULL);
        $theme = urldecode($_GET['theme']??NULL);
        $submit = $_GET['submit']??NULL;

        $form_fields = array("id"=>$id, "username"=>$username, "password"=>$password,
        "first_name"=>$first_name, "last_name"=>$last_name, "full_name"=>$full_name, "email"=>$email,
        "phone_number"=>$phone_number, "theme"=>$theme);

        $edit = new LoginBox();
        echo $edit->editAccountForm($form_fields);

        // edit account record
        if (isset($submit)) {
            $edit->editAccount($form_fields);
        }
    ?>
    </div>
    
    <!-- Footer of website layout -->
    <?php include 'include_files/footer.inc.php'; ?>
</body>
</html>