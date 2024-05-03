<html>
<head>
<title>Sample Video Player</title>
<link rel="stylesheet" href="allPages.css">
<style>

.center{
  width: 65%;
  margin: auto;
}

.lable{
color: #000000;
font-family: Tahoma;
font-size: 20px;
}

h1 {
  color: #000000;
  font-family: Tahoma;
  text-align: center;
  width: auto;
  margin: auto;
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
      <img src="images/logo2.png" alt="" class="logo">
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

  if ($conn->connect_error){
    echo '<p>Connetcion Failed!</p>';
    die("Connetction Failed:" . $conn->connect_error);
  }

  $find_video = "SELECT * FROM video WHERE ID = '" . $_GET["video_ID"] . "'";
  $found_video = $conn->query($find_video);
  $video = $found_video->fetch_assoc();
  echo "<h1>" . $video["title"] . "</h1><br>";

  echo "<div class='center'>
          <video width=100% height=68% controls>
            <source src=" . $video["video_reference"] . " type='video/mp4'>
          Your browser does not support the video tag.
          </video>
        </div>";

  echo "<p style='text-align:center'>" . $video["synopsis"] . "</p>";

  $conn->close();
?>

</body>
</html>
