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
      <li><a href="movies_list.html">Favorites</a></li>
      <li><a href="#account">Account</a></li>
      <li><a href="#settings">Settings</a></li>
    </ul>
  </div>
</section>

<h1>Welcome to Popcorn</h1>

<?php
  session_start();
  $user_ID = $_SESSION["user_ID"];
  echo "Your user ID is " . $user_ID;
?>

<div class="center">
  <section class="movies">
    <img src="images/placeholder.png" alt="movie pic">
    <h2>Movies</h2>
  </section>
  <section class="tv">
    <img src="images/placeholder.png" alt="tv pic">
    <h2>Tv</h2>
  </section>
</div>

</body>
</html>
