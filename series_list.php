<html>
<head>
<title>Sample Video Player</title>
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
      <img src="logo2.png" alt="" class="logo">
        <ul class ="nav">
          <li><a href="home.html">Home</a></li>
          <li><a href="test.html">Favorites</a></li>
          <li><a href="#account">Account</a></li>
          <li><a href="#settings">Settings</a></li>
        </ul>
      </div> 
    </section>

    <h1>Movies</h1>
    <?php
include '../config.inc';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
  echo '<p>Connetcion Failed!</p>';
  die("Connetction Failed:" . $conn->connect_error);
}



$query = "SELECT * FROM series";
$result = $conn->query($query);
echo '<table>';

 while ($row = $result->fetch_assoc()) {
    echo "<tr>";
        echo "<th><img src=".$row[thumbnail_reference]."></th>";
        echo "<th>".$row[title]."</th>";
        echo "<th>".$row[rating]."</th>";
        echo "<th>".$row[num_of_eps]. "</th>";
    echo "</tr>";

}

echo '</table>';


?>
</body>
