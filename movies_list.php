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
  margin-top: 30PX;
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
    <a href="start.html" class="popbutton" style="padding:15px; position:absolute; right:3%; top:50px">Logout</a>
    <h1>Movies</h1>

<?php
include '/users/kent/student/sopatz/config.inc';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
  echo '<p>Connetcion Failed!</p>';
  die("Connetction Failed:" . $conn->connect_error);
}

$query = "SELECT * FROM video WHERE vid_type = 'movie'";
$result = $conn->query($query);
echo '<table>';

 while ($row = $result->fetch_assoc()) {
    echo "<tr>";
        echo "<th><img src=".$row[thumbnail_reference]."></th>";
        echo "<th>".$row[title]."</th>";
        echo "<th>".$row[rating]."</th>";
        echo "<th>".$row[runtime]."</th>";
    echo "</tr>";

}

echo '</table>';
?>

</body>
