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
      $page_title = 'Friends';
        
      // header and menu for website layout, and loginbox class
      include 'include_files/header.inc.php';
      include 'include_files/menu.inc.php';
      include 'include_files/loginbox_class.inc.php';
    ?>

    <div class="main">
      <form action="friends.php" method="get">
        <label for="username">search by username:</label>
        <input type="text" id="username" name="username">
        <button type="submit" id="submit" name="submit">Add Friend</button>
      </form>
    <?php
      $username = $_GET['username'] ?? NULL;
      $submit = $_GET['submit'] ?? NULL;

      if (isset($submit)) {
        $dbh = new Dbh();
        $query = "SELECT * FROM users WHERE name = '".$username."'";
        $result = $dbh->query($query);
        $num_rows = $result->num_rows;

        if ($num_rows != 0) {
          // insert account in friends table if user exists
          $query = "SELECT * FROM friends WHERE username = '".$username."'";
          $result = $dbh->query($query);
          $num_rows = $result->num_rows;

          // check if username is already in friends table
          if ($num_rows == 0) {
            $query = "insert into friends values (DEFAULT,'".$username."')";
            $result = $dbh->query($query);

            if ($result) {
              echo 'You added '.$username.' to your friends!';
            } else {
              echo "An error has occurred. Try again later";
            }
          } else {
            echo $username.' is already your friend';
          }
        } else {
          echo 'no results';
        }

        
      }
      // show friends table
        echo '<h2>My Friends</h2>';
        
        $query = "select * from friends";
        $result = $dbh->query($query);
        
        $num_results = $result->num_rows;
        
        // Format table with CSS with 1 px borders
        echo '<style> 
                #friends_table, #friends_table td {
                    padding: 10px;
                }
              </style>';
        
        echo '<table id="friends_table">
                <tbody>';
            
        for ($i = 0; $i < $num_results; $i++) {
          $row = $result->fetch_assoc();
        
          echo '<tr><td>'. $row['username']. '</td></td></tr>';
        }
        
        echo '</tbody>
            </table>';
        
        $result->free();
    ?>
    </div>
    
    <!-- Footer of website layout -->
    <?php include 'include_files/footer.inc.php'; ?>
</body>
</html>