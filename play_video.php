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

<body>
  <section>
    <div>
      <img src="images/logo2.png" alt="" class="logo">
        <ul class ="nav">
          <li><a href="home.php">Home</a></li>
          <li><a href="#favorites">Favorites</a></li>
          <li><a href="#account">Account</a></li>
          <li><a href="#settings">Settings</a></li>
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
          <video width='1280' height='720' controls>
            <source src=" . $video["video_reference"] . " type='video/mp4'>
          Your browser does not support the video tag.
          </video>
        </div>";

  echo "<p style='text-align:center'>" . $video["synopsis"] . "</p>";

  $conn->close();
?>

</body>
</html>
