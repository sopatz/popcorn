<html>
<head>
  <title>Watchlist</title>
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
    h2 {
      color: #000000;
      font-family: Tahoma;
      font-size: 30px;
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
    <h1>Your Watchlist</h1>

    <?php //This is how to pass the user's ID to any page
    session_start();
    $user_ID = $_SESSION["user_ID"];
    if (!$user_ID){
      die("<h2>Oops! Looks like you're not logged in</h2>");
    }
    include '../config.inc';
    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error){
      echo '<p>Connetcion Failed!</p>';
      die("Connetction Failed:" . $conn->connect_error);
    }

    $query = "SELECT * FROM series, watchlist WHERE watchlist.user_ID = ". $user_ID ." AND watchlist.series_ID = series.ID";
    $result = $conn->query($query);

    $check = $result->num_rows;
    if ($check == 0) {
      die('<h1>Mmmmmh, Nothing\'s Here</h1><h2><a href="series_list.php">Add a series!</a></h2>');
    }

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

            echo '<th style="width: 10%;"><form method="GET">
                      <button class="popbutton" type="submit" name="remove" value="'. $row[ID] .'">Remove from Watchlist</button>
                    </form>
                  </th>';
        echo "</tr>";
    }

    echo '</table>';
    ?>

<?php
//Functions to remove things from watchlist
if(array_key_exists('remove', $_GET)) {
  //echo "remove button pressed";
  remove_from_watchlist();
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
    echo "<script>window.location.href='watchlist.php';</script>";
  }
  else echo "Series failed to add, please try again";
}
?>
</body>
</html>
