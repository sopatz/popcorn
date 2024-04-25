<html>
<head>
<title>Home Page</title>
<link rel="stylesheet" href="allPages.css">
<style>

.center{
  position: absolute;
  left: 28%;
}

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
  margin: auto;
  position:relative;
  left: 25%;
}

.movies {
  float: left;
  padding: 0px;
  width: 33%;
}

.tv {
  float: left;
  padding: 0px;
  width: 33%;
  position:relative;
  left: 25%;
}

</style>
</head>

<body>
<section>
<div>
  <img src="images/logo2.png" alt="popcorn graphic" class="logo">
    <ul class ="nav">
      <li><a href="home.php">Home</a></li>
      <li><a href="watchlist.php">Watchlist</a></li>
      <li><a href="#account">Account</a></li>
      <li><a href="#settings">Settings</a></li>
    </ul>
  </div>
</section>

<h1>Welcome to Popcorn</h1>

<?php //This is how to pass the user's ID to any page
  session_start();
  $user_ID = $_SESSION["user_ID"];
?>

<div class="center">
  <section class="movies">
    <a href="movies_list.php"><img src="images/placeholder.png" alt="movie pic"></a>
    <h2><a href="movies_list.php" style="text-decoration:none; color:black;">Movies</a></h2>
  </section>
  <section class="tv">
    <a href="series_list.php"><img src="images/placeholder.png" alt="tv pic"></a>
    <h2><a href="series_list.php" style="text-decoration:none; color:black;">Tv</a></h2>
  </section>
</div>

<a href="start.php" class="popbutton" style="padding:15px; position:absolute; right:3%; top:50px">Logout</a>

</body>
</html>
