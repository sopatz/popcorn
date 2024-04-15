<html>

  <head></head>
  <body>
    <p>This is home page</p>

    <?php
      session_start();
      $user_ID = $_SESSION["user_ID"];
      echo "Your user ID is " . $user_ID;
    ?>

  </body>

</html>
