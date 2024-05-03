<html>

  <head>
    <link rel=stylesheet href="allPages.css">
    <style>
      p {
        text-align: center;
        position: relative;
        top: 73%;
        color: white;
        font-weight: bold;
      }
    </style>
  </head>

  <body>
    <div class="centerbox"></div>
    <div class="centerform">
      <h1 style="text-align: center; bottom: relative;">Log in</h1><br>
      <form action="log_in.php" method=post>
        Username: <input type=text size=30 name="username"><p></p>
        Password: <input type=password size=30 name="password"><p></p><br>
        <input type=submit class="popbutton" style="padding: 20px 40px" value="Submit">
        <input type=hidden name="form_submitted" value="1">
      </form>
    </div>

  <?php
    if ($_POST["form_submitted"] == "1") {
      include '../config.inc';
      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
          die("Connection Failed: " . $conn->connect_error);
      }

      $check_username = $conn->real_escape_string($_POST["username"]);
      $check_password = $conn->real_escape_string($_POST["password"]);

      $sql = "SELECT * FROM user WHERE username = '" . $check_username . "' AND password = '" . $check_password . "'";
      $result = $conn->query($sql);
      $user_ID = $result->fetch_assoc()["ID"];
      $conn->close();

      if (is_null($user_ID)) {
        echo "<p>Log-in failed: Incorrect username or password<p>Please try again</p>";
        unset($_POST["form_submitted"]);
      }
      else {
        session_start();
        $_SESSION["user_ID"] = $user_ID;

        echo "<script>window.location.href='home.php';</script>";
      }
    }
  ?>
  <p style:"position:absolute; top:30%">Don't have an account? Sign up <a href="sign_up.php">here</a></p>

  </body>

</html>
