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
      $page_title = 'Admin';
        
      // header and menu for website layout, and loginbox class
      include 'include_files/header.inc.php';
      include 'include_files/menu.inc.php';
      include 'include_files/loginbox_class.inc.php';
    ?>

    <div class="main">
    <?php
      if (isset($_SESSION['valid_user'])) {
        if ($_SESSION['valid_user'] == 'admin') {
            $dbh = new Dbh();
        
            $query = "select * from users";
            $result = $dbh->query($query);
        
            $num_results = $result->num_rows;
        
            // Format table with CSS with 1 px borders
            echo '<style> 
                    #admin_table, #admin_table th, #admin_table td {
                        border-collapse: collapse;
                        padding: 10px;
                    }
                    tr:nth-child(even) {
                        background-color: pink;
                    }
                    tr:nth-child(odd) {
                      background-color: lightpink;
                  }
                    th {
                        background-color: pink;
                    }
                    #admin_table a {
                        color: black;
                    }
                  </style>';
        
            echo '<table id="admin_table">
                    <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Password</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Theme</th>
                    <th>Modify</th>
                    </thead>
                    <tbody>';
            
            for ($i = 0; $i < $num_results; $i++) {
            $row = $result->fetch_assoc();
        
            // encode input for query string url
            $encoded_username = urlencode($row['name']);
            $encoded_password = urlencode($row['password']);
            $encoded_first_name = urlencode($row['first_name']);
            $encoded_last_name = urlencode($row['last_name']);
            $encoded_full_name = urlencode($row['full_name']);
            $encoded_email = urlencode($row['email']);
            $encoded_phone_number = urlencode($row['phone']);
            $encoded_theme = urlencode($row['theme']);
        
            echo '<tr><td>'. $row['id']. '</td><td>'. $row['name'].
            '</td><td>'. $row['password'].'</td><td>'. $row['first_name'].'</td><td>'. $row['last_name'].
            '</td><td>'. $row['full_name'].'</td><td>'. $row['email'].'</td><td>'. $row['phone'].'</td><td>'. $row['theme'].'</td><td><a href="edit.php?id='.$row['id'].
            '&username='.$encoded_username.'&password='.$encoded_password.'&first_name='.$encoded_first_name.
            '&last_name='.$encoded_last_name.'&full_name='.$encoded_full_name.'&email='.$encoded_email.'&phone_number='.$encoded_phone_number.'&theme='.$encoded_theme.
            '">Edit </a><br/><a href="delete.php?id='.$row['id'].'"> Delete</a></td></tr>';
            }
        
            echo '</tbody>
                </table>';
        
            $result->free();  
        }        
      } else {
          echo 'You must be logged in as admin to access this page';
      }
    ?>
    </div>
    
    <!-- Footer of website layout -->
    <?php include 'include_files/footer.inc.php'; ?>
</body>
</html>