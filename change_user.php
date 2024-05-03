<html>
  <head>
    <link rel="stylesheet" href="allPages.css">
    <title>Username Changer</title>
    <style>
      p {
        text-align: center;
        position: relative;
        top: 75%;
      }
    </style>
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

  <div class="centerbox" style="height:52%; width:30%"></div>
  <div class="centerform">
    <h1 style="text-align: center; bottom: relative; text-decoration:underline;">Change Username</h1><br>
    <?php
      include '../config.inc';
      $conn = new mysqli($servername, $username, $password, $dbname);
      $pull_username = $conn->query("SELECT username FROM user WHERE ID = '" . $user_ID . "'");
      $current_username = $pull_username->fetch_assoc()["username"];
      echo "<p> Current Username: " . $current_username . "</p>";
      $conn->close();
    ?>
    <form action="change_user.php" method=post>
      New Username: <input type=username size=30 name="new_username"><p></p><br>
      <input type=submit class="popbutton" style="padding: 20px 40px" value="Submit">
      <input type=hidden name="form_submitted" value="1">
    </form>
    <a href="account.php" style="color:red">Cancel</a>
  </div>

  <?php
    if($_POST["form_submitted"] == "1") {
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
      }
      if ($current_username == $_POST["new_username"]) {
        echo "<p>Can't make new username the same as your current username.</p>";
      }
      else {
        $updated = $conn->query("UPDATE user SET username = '" . $_POST["new_username"] . "' WHERE ID = '" . $user_ID . "'");
        if (!$updated) {
          echo "<p>That username is already taken</p>";
          $conn->close();
          unset($_POST["form_submitted"]);
        }
        else {
          echo "<script>window.location.href='account.php';</script>";
        }
      }
      $conn->close();
    }
  ?>

  </body>

</html>

