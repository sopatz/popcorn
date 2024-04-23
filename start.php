<html>
  <head>
    <link rel="stylesheet" href="allPages.css">
    <title>Popcorn - Video Streaming Service</title>
  </head>
  <body>
    <?php
      session_start();
      unset($_SESSION["user_ID"]);
    ?>
    <div style="text-align:center; position:absolute; top:50%; left:50%; transform: translate(-50%, -80%);">
      <img src="images/logo.png" alt="logo" style="width:600px; height:150px;"><br>
      <a href="sign_up.php" class="popbutton" style="padding:20px 40px; position:relative; top:75px; right:30px; font-size:130%"><b>Sign Up</b></a>
      <a href="log_in.php" class="popbutton" style="padding:20px 40px; position:relative; top:75px; left:30px; font-size:130%"><b>Log In</b></a>
    </div>

  </body>
<html>

