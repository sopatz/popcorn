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
    <h1>Shows</h1>

<?php //This is how to pass the user's ID to any page
  session_start();
  $user_ID = $_SESSION["user_ID"];
  if (!$user_ID){
    die("<p>Looks like you're not logged in</p>");
  }
  echo "Your user ID is " . $user_ID; //Just for testing purposes
?>

<?php
include '/users/kent/student/sopatz/config.inc';
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

        //Checks to see if the series is watchlisted, then echos the button to add/remove from watchlist
        $query = "SELECT * FROM watchlist WHERE watchlist.user_ID = '" .$user_ID. "' AND watchlist.series_ID = '" .$row[ID]. "';";
        $q_result = $conn->query($query);
        
        $check = $q_result->num_rows;
        if ($check == 0) {
          echo '<th style="width: 10%;"><form method="GET"> 
                      <button class="popbutton" type="submit" name="add" value="'. $row[ID] .'">Add to Watchlist</button>
                    </form>
                </th>';
        }
        else{
          echo '<th style="width: 10%;"><form method="GET"> 
                    <button class="popbutton" type="submit" name="remove" value="'. $row[ID] .'">Remove from Watchlist</button>
                  </form>
                </th>';
        }


    echo "</tr>";
}

echo '</table>';
?>

<?php
//Functions to add/remove things from watchlist
if(array_key_exists('add', $_GET)) { 
  //echo "add button pressed";
  add_to_watchlist(); 
} 
if(array_key_exists('remove', $_GET)) { 
  //echo "remove button pressed";
  remove_from_watchlist(); 
} 


function add_to_watchlist() { 
  include '/users/kent/student/sopatz/config.inc';
  $conn = new mysqli($servername, $username, $password, $dbname);
  $user_ID = $_SESSION["user_ID"];

  if ($conn->connect_error){
    echo '<p>Connetcion Failed!</p>';
    die("Connetction Failed:" . $conn->connect_error);
  }
  $added_series = $_GET["add"];
  //echo "<br>Series added: " . $added_series;
  $insert = "INSERT INTO watchlist (user_ID, series_ID) VALUES ('". $user_ID ."', '". $added_series. "')";
  $result = $conn->query($insert);
  //echo "<br>Result: " . $result;
  if ($result == 1) {
    //echo "The series has been successfully submitted";
    echo "<script>window.location.href='series_list.php';</script>";
  }
  else echo "Series failed to add, please try again";
}

function remove_from_watchlist() { 
  include '/users/kent/student/sopatz/config.inc';
  $conn = new mysqli($servername, $username, $password, $dbname);
  $user_ID = $_SESSION["user_ID"];

  if ($conn->connect_error){
    echo '<p>Connetcion Failed!</p>';
    die("Connetction Failed:" . $conn->connect_error);
  }
  $removing_series = $_GET["remove"];
  //echo "<br>Series removed: " . $added_series;
  $insert = "DELETE FROM watchlist WHERE user_ID = '". $user_ID ."' AND series_ID = '". $removing_series. "';";
  $result = $conn->query($insert);
  //echo "<br>Result: " . $result;
  if ($result == 1) {
    //echo "The series has been successfully submitted";
    echo "<script>window.location.href='series_list.php';</script>";
  }
  else echo "Series failed to add, please try again";
}
?>

</body>
