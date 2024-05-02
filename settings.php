<html>
  <head>
    <link rel="stylesheet" href="allPages.css">
    <title>Settings</title>
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
        <img src="images/logo2.png" alt="popcorn graphic" class="logo">
        <ul class ="nav">
          <li><a href="home.php">Home</a></li>
          <li><a href="watchlist.php">Watchlist</a></li>
          <li><a href="account.php">Account</a></li>
          <li><a href="settings.php">Settings</a></li>
        </ul>
      </div>
    </section>
    <a href="start.php" class="popbutton" style="padding:15px; position:absolute; right:3%; top:50px">Logout</a>

    <div class="centerform">
    <form action="settings.php" method=post>
      <label for="color" style="font-size:150%; text-decoration:underline;"><b>Select Background Color: </b></label><p></p>
      <span style="display: inline; float: none;"></span>
      <select id="color" name="color" class="form-control" style="font-size:130%; border:1px solid black;">
        <option value="#DA1035">Red</option>
        <option value="#990000">Dark Red</option>
        <option value="#FF5423">Tomato</option>
        <option value="#FF8674">Salmon</option>
        <option value="#FFA500">Orange</option>
        <option value="#F6BE00">Orange Yellow</option>
        <option value="#FFFFC2">Pastel Yellow</option>
        <option value="#F9DB24">Gold</option>
        <option value="#FFFF33">Yellow</option>
        <option value="#ADFC3E">Chartreuse</option>
        <option value="#CFE0C3">Pale Green</option>
        <option value="#5FFB17">Lime Green</option>
        <option value="#4CC417">Green</option>
        <option value="#347C17">Dark Green</option>
        <option value="#7FFFD4">Aquamarine</option>
        <option value="#40E0D0">Turquoise</option>
        <option value="#008B8B">Teal</option>
        <option value="#E0FFFF">Sky Blue</option>
        <option value="#6495ED">Light Blue</option>
        <option value="#0020F2">Blue</option>
        <option value="#0000AF">Dark Blue</option>
        <option value="#8A2BE2">Blue Violet</option>
        <option value="#D462FF">Light Purple</option>
        <option value="#A74AC7">Purple</option>
        <option value="#B048B5">Orchid Purple</option>
        <option value="#FF00FF">Magenta</option>
        <option value="#FCDFFF">Cotton Candy</option>
        <option value="#F9B7FF">Light Pink</option>
        <option value="#FF33AA">Hot Pink</option>
        <option value="#C12283">Dark Fuchsia</option>
        <option value="#CD7F32">Bronze</option>
        <option value="#C58917">Cinnamon</option>
        <option value="#ECE5B6">Tan</option>
        <option value="#B1907F">Light Brown</option>
        <option value="#806517">Brown</option>
        <option value="#644117">Dark Brown</option>
        <option value="#7F462C">Sepia</option>
        <option value="#8A865D">Khaki</option>
        <option value="#D3D3D3">Light Gray</option>
        <option value="#A8A9AD">Gray</option>
        <option value="#F8F0E3">Cream</option>
        <option value="#FEFCFF">White</option>
      </select><p></p>
      <br><br>
      <input type=submit class="popbutton" style="padding: 20px 40px" value="Save">
      <input type="hidden" name="form_submitted" value="1">
    </form>
    </div>

    <?php
    if (isset($_POST["form_submitted"])) {
      include '../config.inc';
      $conn = new mysqli($servername, $username, $password, $dbname);

      if ($conn->connect_error) {
          die("Connection Failed: " . $conn->connect_error);
      }
      $update_color = "UPDATE user SET color = '" . $_POST["color"] . "' WHERE ID = '" . $user_ID . "'";
      $conn->query($update_color);
      $select_color = "SELECT color FROM user WHERE ID = '" . $user_ID . "'";
      $result = $conn->query($select_color);
      $back_color = $result->fetch_assoc()["color"];
      $_SESSION["back_color"] = $back_color;
      echo "<script>window.location.href='settings.php';</script>";
      $conn->close();
    }
    ?>

  </body>

<html>

