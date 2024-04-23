<html>

  <head> </head>

  <body>

    <form action="log_in.php" method=get>
      Username: <input type=text size=30 name="username"><p></p>
      Password: <input type=password size=30 name="password"><p></p>
      <input type=submit value="Submit">
      <input type=hidden name="form_submitted" value="1">
    </form>

  <?php
    if (isset($_GET["form_submitted"])) {
      include '../config.inc';
      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
          die("Connection Failed: " . $conn->connect_error);
      }

      $check_username = $conn->real_escape_string($_GET["username"]);
      $check_password = $conn->real_escape_string($_GET["password"]);

      $sql = "SELECT * FROM user WHERE username = '" . $check_username . "' AND password = '" . $check_password . "'";
      $result = $conn->query($sql);
      $user_ID = $result->fetch_assoc()["ID"];
      $conn->close();

      if (is_null($user_ID)) {
        echo "Log-in failed: Incorrect username or password<p>Please try again</p>";
      }
      else {
        session_start();
        $_SESSION["user_ID"] = $user_ID;

        echo "<script>window.location.href='home.php';</script>";
      }
    }

  ?>

  </body>

</html>
