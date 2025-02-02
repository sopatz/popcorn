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
    <h1>Shows</h1>

    <div style="display: flex; text-align: center; justify-content: center; align-items: center; margin-top: 25px;  margin-bottom: 30px;">
    <div style="width: 375px; border: black 2px solid; border-radius: 20px; display: flex; text-align: center; justify-content: center; align-items: center;  background-color: white;">
    <form method="GET" style="margin: 0;">
        <table>
            <tr>
                <td><input type="text" name="search" placeholder="Search for a series" style="height: 30px; width: 300px; border: none; outline:none;"></td><td><button type="submit" style="border:none; background-color: transparent; cursor: pointer;";><img src="images/search.png" style="width:30px"></button></td>
            </tr>
        </table>
    </form>
    </div>
    </div>

<?php
include '../config.inc';
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error){
  echo '<p>Connetcion Failed!</p>';
  die("Connetction Failed:" . $conn->connect_error);
}

if(array_key_exists('search', $_GET)) {
  $search = $_GET["search"];
  //echo "<br>Search: " . $search;
  $query = "SELECT * FROM series WHERE title LIKE '%".$search."%'";
  //echo $query;
  $result = $conn->query($query);
  if ($result === false) {
    echo "Query failed: " . $conn->error;
  } else {
    //echo "Query succeeded";
  }
  if ($result->num_rows > 0) {
    echo '<table>';

    while ($row = $result->fetch_assoc()) {
      echo "<tr>";
      echo '<th style="width: 135px;"><img src='.$row[thumbnail_reference].' style="width: 135px; height: 200px;"></th>';
      echo '<th style="width: 20%;"><form action="episode_list.php" method="get">
              <input type=hidden name="series_ID" value="'.$row[ID].'">
              <input type=submit value="'.$row[title].'">
              </form>
            </th>';
      echo "<th>".$row[synopsis]."</th>";
      echo '<th style="min-width: 50px;">'.$row[rating].'</th>';

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

    die("</table>");
  } else {
    die("<h1>No results found</h1>");
  }
}

$query = "SELECT * FROM series";
$result = $conn->query($query);
echo '<table>';

 while ($row = $result->fetch_assoc()) {
  echo "<tr>";
  echo '<th style="width: 135px;"><img src='.$row[thumbnail_reference].' style="width: 135px; height: 200px;"></th>';
  echo '<th style="width: 20%;"><form action="episode_list.php" method="get">
              <input type=hidden name="series_ID" value="'.$row[ID].'">
              <input type=submit value="'.$row[title].'">
        </form>
        </th>';
  echo "<th>".$row[synopsis]."</th>";
  echo '<th style="min-width: 50px;">'.$row[rating].'</th>';

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
  include '../config.inc';
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
  include '../config.inc';
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
