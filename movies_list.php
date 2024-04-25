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
    <h1>Movies</h1>

<?php
include '../config.inc';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
  echo '<p>Connetcion Failed!</p>';
  die("Connetction Failed:" . $conn->connect_error);
}
session_start();
$user_ID = $_SESSION["user_ID"];
if (!$user_ID){
  die("<h1>Oops! Looks like you're not logged in</h1>");
}

$result = $conn->query("SELECT subsc_plan FROM user WHERE ID = '" . $user_ID . "'");
$plan = $result->fetch_assoc()["subsc_plan"];

if ($plan == "basic") {
  $query = "SELECT * FROM video WHERE vid_type = 'movie' AND subsc_plan_required = 'basic'";
}
else {
  $query = "SELECT * FROM video WHERE vid_type = 'movie'";
}
$result = $conn->query($query);
echo '<table>';

while ($row = $result->fetch_assoc()) {
    echo "<tr>";
        echo "<th><img src=".$row[thumbnail_reference]."></th>";
        echo "<th><form action='play_video.php' method=get>
                    <input type=hidden name='video_ID' value=$row[ID]>
                    <input type=submit value=$row[title]>
              </form>
              </th>";
        echo "<th>".$row[rating]."</th>";
        echo "<th>".$row[runtime]."</th>";
    echo "</tr>";

}

echo '</table>';
?>

</body>
