<html>
<head>
<title>Movies List</title>
<link rel="stylesheet" href="allPages.css">
<style>
h1 {
  color: #000000;
  font-family: Tahoma;
  font-size: 40px;
  text-align: center;
  width: auto;
  margin-top: 30px;
}

table{
    font-family: Tahoma;
    text-align: center;
    width: 100%;
    padding: 0;
    margin: 0;
}
th{
    border: 3px solid #000000;
    padding: 0;
    margin: 0;
}

th input {
    background:none;
    border: none;
    padding: 0;
    font-family: Tahoma;
    text-decoration: underline;
    cursor: pointer;
    font-size:16px;
    font-weight: bold;
}

</style>

</head>

<body>
    <section>
    <div>
      <img src="images/logo2.png" alt="" class="logo">
        <ul class ="nav">
          <li><a href="home.php">Home</a></li>
          <li><a href="watchlist.php">Watchlist</a></li>
          <li><a href="#account">Account</a></li>
          <li><a href="#settings">Settings</a></li>
        </ul>
      </div>
    </section>
    <a href="start.php" class="popbutton" style="padding:15px; position:absolute; right:3%; top:50px">Logout</a>
    <h1>Remove Videos</h1>

<?php
include '../config.inc';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
  echo '<p>Connetcion Failed!</p>';
  die("Connetction Failed:" . $conn->connect_error);
}
//This page is for deleting movies from the database for testing. Will not check for session.


$query = "SELECT * FROM video";
$result = $conn->query($query);
echo '<table>';
echo "<h2>Movies/Shows</h2>";

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
        echo '<th><img src='.$row[thumbnail_reference].' style="width: 135px; height: 200px;"></th>';
        echo '<th style="width: 20%;">
                  <form action="play_video.php" method="get">
                    <input type="hidden" name="video_ID" value="'.$row[ID].'">
                    <input type="submit" value="'.$row[title].'">
                  </form>
              </th>';
        echo "<th>".$row[synopsis]."</th>";
        echo '<th style="width: 10%;">
            <form method="GET">
                <button class="popbutton" type="submit" name="delete_movie" value="'. $row[ID] .'">Delete</button>
            </form>
        </th>';
    echo "</tr>";

}

$query = "SELECT * FROM series";
$result = $conn->query($query);

echo '<table>';
echo "<h2>Series</h2>";

 while ($row = $result->fetch_assoc()) {
    echo "<tr>";
        echo '<th style="width: 135px;"><img src="'.$row[thumbnail_reference].'" style="width: 135px; height: 200px;"></th>';
        echo '<th style="width: 20%;">
                <form action="episode_list.php" method="get">
                    <input type=hidden name="series_ID" value="'.$row[ID].'">
                    <input type=submit value="'.$row[title].'">
              </form>
              </th>';
        echo "<th>".$row[synopsis]. "</th>";
        echo '<th style="width: 10%;">
            <form method="GET">
                <button class="popbutton" type="submit" name="delete_series" value="'. $row[ID] .'">Delete</button>
            </form>
        </th>';
    echo "</tr>";
    
}
echo '</table>';
?>

<?php
//Functions to remove things from watchlist
if(array_key_exists('delete_movie', $_GET)) { 
  //echo "remove button pressed";
  delete_movie(); 
} 
if(array_key_exists('delete_series', $_GET)) { 
    //echo "remove button pressed";
    delete_series(); 
  } 

function delete_movie() { 
  include '../config.inc';
  $conn = new mysqli($servername, $username, $password, $dbname);

  if ($conn->connect_error){
    echo '<p>Connetcion Failed!</p>';
    die("Connetction Failed:" . $conn->connect_error);
  }

  $deleting_movie = $_GET["delete_movie"];
  //echo "<br>Movie removed: " . $deleting_movie;
  $insert = "DELETE FROM video WHERE ID = '". $deleting_movie. "';";
  $result = $conn->query($insert);
  //echo "<br>Result: " . $result;
  if ($result == 1) {
    //echo "The series has been successfully submitted";
    echo "<script>window.location.href='remove_videos.php';</script>";
  }
  else echo "Series failed to add, please try again";
}

function delete_series() { 
    include '../config.inc';
    $conn = new mysqli($servername, $username, $password, $dbname);
  
    if ($conn->connect_error){
      echo '<p>Connetcion Failed!</p>';
      die("Connetction Failed:" . $conn->connect_error);
    }
  
    $deleting_series = $_GET["delete_series"];
    //echo "<br>Series removed: " . $deleting_movie;
    $insert = "DELETE FROM series WHERE ID = '". $deleting_series. "';";
    $result = $conn->query($insert);
    //echo "<br>Result: " . $result;
    if ($result == 1) {
      //echo "The series has been successfully submitted";
      echo "<script>window.location.href='remove_videos.php';</script>";
    }
    else echo "Series failed to add, please try again";
  }
?>
</body>
</html>
