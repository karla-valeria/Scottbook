<?php

    // this class programmatically creates a login page
    class LoginBox
    {
      // holds string for submit button label
      protected $submit_btn_label = 'Submit';

      // Constructor sets submit
      function __construct($label='Login')
      {
        $this->submit_btn_label = $label;
      }

      // returns a login form string
      function login_form() {
        return '<form action="login.php" method="get" id="login_form">
                  <label for="username">Username</label><br>
                  <input type="text" id="username" name="username" placeholder="username"><br>
                  <label for="password">Password</label><br>
                  <input type="text" id="password" name="password" placeholder="password"><br>
                  <button type="submit" name="submit" id="submit">'. $this->submit_btn_label.'</button>
                </form>';
      }

      // returns form with fields in users table
      function getAccountForm() {
        return '<form action="signup.php" method="get">
                  <h2>Create an Account</h2><br>
                  <input type="text" id="username" name="username" placeholder="username"><br>
            
                  <input type="text" id="password" name="password"placeholder="password"><br>
            
                  <input type="text" id="first_name" name="first_name" placeholder="first name"><br>
            
                  <input type="text" id="last_name" name="last_name" placeholder="last name"><br>

                  <input type="text" id="full_name" name="full_name" placeholder="full name"><br>
            
                  <input type="text" id="email" name="email" placeholder="email"><br>
            
                  <input type="text" id="phone_number" name="phone_number" placeholder="phone number (optional)"><br>

                  <label for="theme">Choose a theme:</label>
                  <select name="theme" id="themes">
                    <option value="pink">Pink</option>
                    <option value="green">Green</option>
                    <option value="black">Black</option>
                  </select><br>
            
                  <button type="submit" name="submit" id="submit">Sign Up</button>
                </form>';
      }

      // returns form with fields to edit account
      function editAccountForm($form_fields) {
        $form = '<form action="edit.php" method="get">
        <input type="hidden" id="id" name="id" value="'.$form_fields['id'].'"><br>

        <label for="username">username:</label><br>
        <input type="text" id="username" name="username" value="'.$form_fields['username'].'"><br>

        <label for="password">password:</label><br>
        <input type="text" id="password" name="password" value="'.$form_fields['password'].'"><br>

        <label for="first_name">first name:</label><br>
        <input type="text" id="first_name" name="first_name" value="'.$form_fields['first_name'].'"><br>

        <label for="last_name">last name:</label><br>
        <input type="text" id="last_name" name="last_name" value="'.$form_fields['last_name'].'"><br>

        <label for="full_name">full name:</label><br>
        <input type="text" id="full_name" name="full_name" value="'.$form_fields['full_name'].'"><br>

        <label for="email">email:</label><br>
        <input type="text" id="email" name="email" value="'.$form_fields['email'].'"><br>

        <label for="phone_number">phone number (optional):</label><br>
        <input type="text" id="phone_number" name="phone_number" value="'.$form_fields['phone_number'].'"><br>

        <label for="theme">Choose a theme:</label>
        <select name="theme" id="themes">';

        if ($form_fields['theme'] == 'pink') {
          $form .= '<option value="pink" selected="selected">Pink</option>
                  <option value="green">Green</option>
                  <option value="black">Black</option>';
        } elseif ($form_fields['theme'] == 'green') {
          $form .= '<option value="pink">Pink</option>
                  <option value="green" selected="selected">Green</option>
                  <option value="black">Black</option>';
        } else {
          $form .= '<option value="pink">Pink</option>
                  <option value="green">Green</option>
                  <option value="black" selected="selected">Black</option>';
        }

        $form .= '</select><br>

        <button type="submit" name="submit" id="submit">Update</button>
      </form>';

        return $form;
      }

      // write new user record in mysql database users table
      function createAccount($form_fields) {
        // validate all fields are entered
        if (!$form_fields['username'] || !$form_fields['password'] ||
      !$form_fields['first_name'] || !$form_fields['last_name'] ||
      !$form_fields['full_name'] || !$form_fields['email'] || !$form_fields['theme']) {
          echo "You have not entered all the required fields. Please try again";
          return;
        }

        // validate phone number
        if ($form_fields['phone_number'] != '') {
          if (!preg_match("/^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/", $form_fields['phone_number'])) {
             "The phone number you entered is invalid. Please try again";
            return;
          }
        }

        // validate email
        if (!preg_match("/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/", 
      $form_fields['email'])) {
        echo "The email you entered is invalid. Please try again";
        return;
        }  

        // insert record
        $dbh = new Dbh();

        // escape special chars in input
        $name = $dbh->real_escape_string($form_fields['username']);
        $password = $dbh->real_escape_string($form_fields['password']);
        $first_name = $dbh->real_escape_string($form_fields['first_name']);
        $last_name = $dbh->real_escape_string($form_fields['last_name']);
        $full_name = $dbh->real_escape_string($form_fields['full_name']);
        $email = $dbh->real_escape_string($form_fields['email']);
        $phone_number = $dbh->real_escape_string($form_fields['phone_number']);
        $theme = $dbh->real_escape_string($form_fields['theme']);

        // verify username doesn't already exist in DB
        $username_query = "SELECT * FROM users WHERE name = '".$name."'";
        $username_result = $dbh->query($username_query);
        $username_num_rows = $username_result->num_rows;

        if ($username_num_rows != 0) {
          echo 'username already exists';
        } else {
          // insert record in db
          $query = "insert into users values (DEFAULT,'".$name."', MD5('"
        .$password."'), '".$first_name."', '"
        .$last_name."', '".$full_name."', '".$email."', '".$phone_number."', '".$theme."')";
      
          $result = $dbh->query($query);

          if ($result) {
            echo 'You have created an account! Login <a href="login.php">here</a>.';
          } else {
            echo "An error has occurred. Your account was not created";
          }
        } 
      }

      //
      function editAccount($form_fields) {
        // validate all fields are entered
        if (!$form_fields['username'] || !$form_fields['password'] ||
      !$form_fields['first_name'] || !$form_fields['last_name'] ||
      !$form_fields['full_name'] || !$form_fields['email'] || !$form_fields['theme']) {
          echo "You have not entered all the required fields. Please try again";
          return;
        }

        // validate phone number
        if ($form_fields['phone_number'] != '') {
          if (!preg_match("/^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/", $form_fields['phone_number'])) {
             "The phone number you entered is invalid. Please try again";
            return;
          }
        }

        // validate email
        if (!preg_match("/^[a-zA-Z0-9_\-\.]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$/", 
      $form_fields['email'])) {
        echo "The email you entered is invalid. Please try again";
        return;
        }  

        // insert record
        $dbh = new Dbh();

        // escape special chars in input
        $id = $dbh->real_escape_string($form_fields['id']);
        $name = $dbh->real_escape_string($form_fields['username']);
        $password = $dbh->real_escape_string($form_fields['password']);
        $first_name = $dbh->real_escape_string($form_fields['first_name']);
        $last_name = $dbh->real_escape_string($form_fields['last_name']);
        $full_name = $dbh->real_escape_string($form_fields['full_name']);
        $email = $dbh->real_escape_string($form_fields['email']);
        $phone_number = $dbh->real_escape_string($form_fields['phone_number']);
        $theme = $dbh->real_escape_string($form_fields['theme']);

        $query = "UPDATE users SET name = '".$name."', password = MD5('".$password."'), first_name = '".$first_name
        ."', last_name = '".$last_name."', full_name = '".$full_name."', email = '".$email."', phone = '".$phone_number."', theme = '".$theme."' WHERE id = ".$id."";
        
        $result = $dbh->query($query);

        if ($result) {
          echo 'You have successfully edited account!';
        } else {
          echo "An error has occurred. Your account was not created";
        }
      }

      // deletes record in db
      function deleteAccount($id) {
        // update record in DB
        $dbh = new Dbh();

        $query = "DELETE from users WHERE id = ".$id;
        $result = $dbh->query($query);
        if ($result) {
          echo 'You have successfully deleted this account!';
        } else {
          echo "An error has occurred. Your account was not created";
        }
      }

      // changes label of submit btn in form
      function change_submit_label($label) {
        // displays error if label is empty str
        try
        {
          if ($label == '') {
            throw new Exception("label cannot be empty string");
          } else {
            $this->submit_btn_label = $label;
          }
        }
        catch(Exception $e)
        {
          echo $e->getMessage();
        }
      }

      // authenticates username and password
      function authenticate_input($username_input, $password_input) {
        // displays appropriate error for which value does not match
        try
        {
          if (!empty($username_input) && !empty($password_input)) {
            // Authentication logic
            $username_input = addslashes($username_input);
            $password_input = addslashes($password_input);
            $query = "SELECT id FROM Users WHERE name = '$username_input' and password = MD5('$password_input')";

            // connect to db
            $dbh = new Dbh();

            $result = $dbh->query($query);

            // Check the number of records returned, if any, then login successful
            if ($result->num_rows == 1 ) {
              $_SESSION['valid_user'] = $username_input;
              echo 'You are logged in!';

              $theme_query = "SELECT theme FROM users WHERE name = '".$username_input."'";
              $theme_result = $dbh->query($theme_query);
              $row = $theme_result->fetch_assoc();
              $color = $row['theme'];
              $_SESSION['theme'] = $color;
            } else {
              throw new Exception("incorrect login");
            }
          } else {
            throw new Exception("Empty fields");
          }
        }
        catch(Exception $e)
        {
          echo "An error has ocurred: ". $e->getMessage();
          
        }
      }
    }
?>