<html>
  <head>
    <link rel="stylesheet" href="allPages.css">
    <title>Settings</title>
    <style>

    .center {
      margin: auto;
      width: 20%;
      padding: 20px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }

    .hideform {
      display: none;
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
    <section>
      <div>
        <img src="images/logo2.png" alt="popcorn graphic" class="logo">
        <ul class ="nav">
          <li><a href="home.php">Home</a></li>
          <li><a href="watchlist.php">Watchlist</a></li>
          <li><a href="account.php">Account</a></li>
          <li><a href="settings.php">Settings</a></li>
        </ul>
      </div>
    </section>
    <a href="start.php" class="popbutton" style="padding:15px; position:absolute; right:3%; top:50px">Logout</a>

    <?php
      include '../config.inc';
      $conn = new mysqli($servername, $username, $password, $dbname);
      if ($conn->connect_error) {
          die("Connection Failed: " . $conn->connect_error);
      }

      $user_query = "SELECT * FROM user WHERE ID = '" . $user_ID . "'";
      $user_result = $conn->query($user_query);
      while ($user_info = $user_result->fetch_assoc()) {
        echo "<h1>" . $user_info["username"] . "</h1>";
        echo "<p>Subscription Plan: " . $user_info["subsc_plan"] . "</p>";
        echo "<p>Subscription Renewal Date: " . $user_info["subsc_renew_date"] . "</p>";
        echo "<p>Location: " . $user_info["location"] . "</p>";
      }
      $conn->close();
    ?>

    <br>
    <a href="change_user.php" class="popbutton" style="padding:10px 15px;">Change Username</a>
    <a href="change_pass.php" class="popbutton" style="padding:10px 15px;">Change Password</a>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <div class="center hideform">
      <h2>Are you sure you want to delete your account?</h2>
      <p>This cannot be undone.</p>
      <div style="display:flex; flex-direction:row; align-items:center;">
        <form action="account.php" method=get>
          <input type=submit class="popbutton" style="padding:10px;" value="Yes">
          <input type=hidden name="account_deletion" value="1">
        </form>
        <button id="close" class="popbutton" style="padding:10px; margin-left:10px; margin-bottom:4%;">No</button>
      </div>
    </div>

    <?php
      if (isset($_GET["account_deletion"])) {
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection Failed: " . $conn->connect_error);
        }
        $conn->query("DELETE FROM user WHERE ID = '" . $user_ID . "'");
        $conn->close();
        echo "<script>window.location.href='start.php';</script>";
      }
    ?>

    <br><br><br>
    <button id="show" class="popbutton" style="box-shadow: 0px 0px 7px 11px rgba(255,49,49,0.59);">Delete Account</button>
    <script>
      $('#show').on('click', function () {
        $('.center').show();
        $(this).hide();
      })

      $('#close').on('click', function () {
        $('.center').hide();
        $('#show').show();
      })
    </script>

  </body>
</html>
