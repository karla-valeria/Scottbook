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
      $page_title = 'Contact Us';
        
      // header and menu for website layout, and loginbox class
      include 'include_files/header.inc.php';
      include 'include_files/menu.inc.php';
      include 'include_files/loginbox_class.inc.php';
    ?>

    <div class="main">
        <?php
            $name = $_GET['name'] ?? NULL;
            $email = $_GET['email'] ?? NULL;
            $subject = $_GET['subject'] ?? NULL;
            $content = $_GET['content'] ?? NULL;
            $submit = $_GET['submit'] ?? NULL;

            if(!isset($submit)) {
                // display contact form
                echo '<form method="get" action="contact.php">
                        <label for="name">Your Name:</label>
                        <input type="text" id="name" name="name"><br>

                        <label for="email">Your Email Address:</label>
                        <input type="text" id="email" name="email"><br>

                        <label for="subject">Choose a subject:</label>
                        <select name="subject" id="subject">
                            <option value="feedback">Feedback</option>
                            <option value="troubleshooting">Troubleshooting</option>
                            <option value="other">Other</option>
                        </select><br>

                        <textarea rows="7" cols="53" id="content" name="content"></textarea><br>
                        <button type="submit" id="submit" name="submit">Send</button>
                      </form>';
            } else {
                // send email and confirm
                
                $headers =  'MIME-Version: 1.0' . "\r\n"; 
                $headers .= 'From: Scottbook <valartist@gmail.com>' . "\r\n";
                $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $mail_content = 'name: '.$name.'/n
                                 email: '.$email.'/n
                                 content: '.$content;
                if ($subject == 'feedback') {
                    $to_address = 'feedback@scottbook.com';
                } if ($subject == 'troubleshooting') {
                    $to_address = 'troubleshooting@scottbook.com';
                } else {
                    $to_address = 'other@scottbook.com';
                }

                mail($to_address, $subject, $content, $headers);

                echo 'Your inquiry has been sent!';
            }   
        ?>
        
    </div>
    
    <!-- Footer of website layout -->
    <?php include 'include_files/footer.inc.php'; ?>
</body>
</html>