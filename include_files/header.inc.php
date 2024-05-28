<?php 
  echo '<header>
          <img src="images/sb_logo_v2.png" id="logo">
          <a href="index.php"><h1 id="name">ScottBook</h1></a>
          <h2 id="page-title">'.$page_title.'</h2>';
  if (isset($_SESSION['valid_user'])) {
    // insert theme here
    if ($_SESSION['theme'] == 'pink') {
      echo '<style>
        body {
          font-family: "Noto Sans JP", sans-serif;
        }
        header, #menu, footer {
          background-color: pink;
        }
        #login-out_btn {
          background-color: lightpink;
        }
        #menu {
          background-color: lightpink;
        }
        #submit {
          background-color: pink;
        }
      </style>';
    } elseif ($_SESSION['theme'] == 'green') {
      echo '<style>
        body {
          font-family: "Noto Sans JP", sans-serif;
        }
        header, #menu, footer {
          background-color: green;
        }
        #login-out_btn {
          background-color: lightgreen;
        }
        #menu {
          background-color: lightgreen;
        }
        #submit {
          background-color: green;
        }
      </style>';
    } else {
      echo '<style>
        body {
          font-family: "Noto Sans JP", sans-serif;
        }
        header, #menu, footer {
          background-color: black;
        }
        #login-out_btn {
          background-color: gray;
        }
        #menu {
          background-color: gray;
        }
        #submit {
          background-color: black;
        }
      </style>';
    }
    // make logout btn
    echo '<a href="logout.php" id="login-out_btn">Log Out</a>';
  } else {
    echo '<a href="login.php" id="login-out_btn">Log In</a>';
  }
  echo '</header>';