<html>
<head>
<title>Home Page</title>
<link rel="stylesheet" href="allPages.css">
<style>

.center{
  position: absolute;
  left: 28%;
}

h1 {
  color: #000000;
  font-family: Tahoma;
  font-size: 40px;
  text-align: center;
  width: auto;
  margin-top: 30px;
}

h2 {
  color: #000000;
  font-family: Tahoma;
  font-size: 30px;
  text-align: center;
  width: auto;
  margin: auto;
  position:relative;
  left: 25%;
}

.movies {
  float: left;
  padding: 0px;
  width: 33%;
}

.tv {
  float: left;
  padding: 0px;
  width: 33%;
  position:relative;
  left: 25%;
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

  include '../config.inc';
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error) {
      die("Connection Failed: " . $conn->connect_error);
  }

  $select_color = "SELECT color FROM user WHERE ID = '" . $user_ID . "'";
  $result = $conn->query($select_color);
  $back_color = $result->fetch_assoc()["color"];
  $_SESSION["back_color"] = $back_color;

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

<div>
  <h1>Welcome to Popcorn</h1>
</div>

<div style="margin-right: auto; margin-left: auto; width: 90%; display: flex; align-items: center; justify-content: center;">
  <div style="margin: 50px;">
    <a href="movies_list.php"><img src="images/movie-clapper-open-svgrepo-com.svg" alt="movie pic" style="width: 275px;"></a>
    <div style="display: flex; margin-top: 30px;"><a href="movies_list.php" style="text-decoration:none; color:black; font-size: xxx-large; margin:auto;"><strong>Movies</strong></a></div>
</div>
  <div style="margin: 50px;">
    <a href="series_list.php"><img src="images/television-televisions-svgrepo-com.svg" alt="tv pic" style="width: 275px;"></a>
    <div style="display: flex; margin-top: 30px;"><a href="series_list.php" style="text-decoration:none; color:black; font-size: xxx-large; margin:auto;"><strong>Series</strong></a></div>
</div>
</div>

<a href="start.php" class="popbutton" style="padding:15px; position:absolute; right:3%; top:50px">Logout</a>
<h3>For Testing:</h3>
  <a href="add_series.php" style="color:black;">Add series</a><br>
  <a href="add_video.php" style="color:black;">Add video</a><br>
  <a href="remove_videos.php" style="color:black;">Remove video/series</a><br>
  <a href="log_in.php" style="color:black;">Login</a>

</body>
</html>
