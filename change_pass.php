<html>
  <head>
    <link rel="stylesheet" href="allPages.css">
    <title>Password Changer</title>
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

  <div class="centerbox" style="height:385px"></div>
  <div class="centerform">
    <h1 style="text-align: center; bottom: relative;">Change Password</h1><br>
    <form action="change_pass.php" method=post>
      Current Password: <input type=password size=30 name="current_pass"><p></p>
      New Password: <input type=password size=30 name="new_pass"><p></p>
      Confirm New Password: <input type=password size=30 name="new_pass2"><p></p><br>
      <input type=submit class="popbutton" style="padding: 20px 40px" value="Submit">
      <input type=hidden name="form_submitted" value="1">
    </form>
    <a href="account.php" style="color:red">Cancel</a>
  </div>

  <?php
    if($_POST["form_submitted"] == "1") {
      include '../config.inc';
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
        die("Connection Failed: " . $conn->connect_error);
      }

      $get_password = $conn->query("SELECT password FROM user WHERE ID = '" . $user_ID . "'");
      if ($get_password->fetch_assoc()["password"] == $_POST["current_pass"]) {
        if ($_POST["new_pass"] != $_POST["new_pass2"]) {
          echo "<p>New passwords do not match. Try again</p>";
        }
        else if ($_POST["new_pass"] == $_POST["current_pass"]){
          echo "<p>New password cannot be the same as old password</p>";
        }
        else {
          $conn->query("UPDATE user SET password = '" . $_POST["new_pass"] . "' WHERE ID = '" . $user_ID . "'");
          $conn->close();
          echo "<script>window.location.href='account.php';</script>";
        }
      }
      else {
        echo "<p>Incorrect password. Please try again.</p>";
      }
      $conn->close();
    }
  ?>

  </body>

</html>
