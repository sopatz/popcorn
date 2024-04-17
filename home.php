<html>
<head>
<title>Sample Video Player</title>
<link rel="stylesheet" href="allPages.css">
<style>

.center{
  width: 65%;
  margin: auto;
}

h1 {
  color: #000000;
  font-family: Tahoma;
  font-size: 40px;
  text-align: center;
  width: auto;
  margin-top: 30PX;
}

h2 {
  color: #000000;
  font-family: Tahoma;
  font-size: 30px;
  text-align: center;
  width: auto;
  margin: auto;
}


.movies {
  float: left;
  padding: px;
  width: 33%;
}

.tv {
  float: left;
  padding: 0px;
  width: 33%;
}

.documentaries {
  float: left;
  padding: 0px;
  width: 33%;
}

</style>
</head>

<body>
<section>
<div>
  <img src="images/logo2.png" alt="" class="logo">
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
    <img src="images/placeholder.png" alt="" class="mainpics">
    <h2>Movies</h1>
  </section>
  <section class="tv">
    <img src="images/placeholder.png" alt="" class="mainpics">
    <h2>Tv</h1>
  </section>
  <section class="documentaries">
    <img src="images/placeholder.png" alt="" class="mainpics">
    <h2>Documentaries</h1>
  </section>
</div>

</body>
</html>
