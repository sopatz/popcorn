<html>
  <head>
    <link rel="stylesheet" href="allPages.css">
    <title>Passwosr Changer</title>
  </head>

  <?php
    //Testing if the user is logged in and setting the user's custom background color
    session_start();
    $user_ID = $_SESSION["user_ID"];
    if (!$user_ID){
      die("<h2>Oops! Looks like you're not logged in</h2>");
    }
    $back_color = $_SESSION["back_color"];
    echo "<body style='background-color:" . $back_color . "'>";
  ?>

  <div class="centerbox"></div>
  <div class="centerform">
    <h1 style="text-align: center; bottom: relative;">Log in</h1><br>
    <form action="change_pass.php" method=post>
      Current Password: <input type=text size=30 name="current_pass"><p></p>
      New Password: <input type=text size=30 name="new_pass"><p></p>
      <input type=submit class="popbutton" style="padding: 20px 40px" value="Submit">
      <input type=hidden name="form_submitted" value="1">
    </form>
  </div>

  <?php
    if (isset($_POST["form_submitted"])) {
      echo <p>This is a test</p>;
    }
  ?>

  </body>

</html>
