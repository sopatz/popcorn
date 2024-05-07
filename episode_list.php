<html>
<head>
<title>Series List</title>
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

$result = $conn->query("SELECT * FROM series WHERE ID = '" . $_GET["series_ID"] . "'");
echo "<h1>" . $result->fetch_assoc()["title"] . "</h1>";

session_start();
$user_ID = $_SESSION["user_ID"];
if (!$user_ID){
  die("<h1>Oops! Looks like you're not logged in</h1>");
}

$result = $conn->query("SELECT subsc_plan FROM user WHERE ID = '" . $user_ID . "'");
$plan = $result->fetch_assoc()["subsc_plan"];

if ($plan == "basic") {
  $query = "SELECT * FROM video, is_part_of WHERE subsc_plan_required = 'basic' AND is_part_of.video_ID = video.ID AND ID IN 
           (SELECT video_ID from is_part_of WHERE series_ID = '" . $_GET["series_ID"] . "')";
}
else {
  $query = "SELECT * FROM video, is_part_of WHERE is_part_of.video_ID = video.ID AND ID IN 
           (SELECT video_ID from is_part_of WHERE series_ID = '" . $_GET["series_ID"] . "')";
}
$result = $conn->query($query);
echo '<table>';

while ($row = $result->fetch_assoc()) {
  echo "<tr>";
  echo '<th style="width: 135px;"><img src='.$row[thumbnail_reference].' style="width: 135px; height: 200px;"></th>';
  echo '<th style="min-width: 100px;">
            <form action="play_video.php" method="get">
              <input type="hidden" name="video_ID" value="'.$row[ID].'">
              <input type="submit" value="'.$row[title].'">
            </form>
        </th>';
  echo "<th>".$row[synopsis]."</th>";
  echo '<th style="min-width: 50px;">'.$row[rating].'</th>';
  echo "<th>".$row[runtime]."</th>";
  echo "<th>Season: ".$row[season_number]."<br>Episode: ".$row[episode_number]."</th>";
  echo "</tr>";

}

echo '</table>';
?>

</body>
</html>
