<html>
  <head>
    <link rel="stylesheet" href="allPages.css">
    <title>Settings</title>
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
    <p>Account page</p>
  </body>
</html>
