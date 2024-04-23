<html>
<head>
<title>Sample Video Player</title>
<link rel="stylesheet" href="allPages.css">
<style>

.center{
  width: 65%;
  margin: auto;
}

.lable{
color: #000000;
font-family: Tahoma;
font-size: 20px;
}

h1 {
  color: #000000;
  font-family: Tahoma;
  text-align: center;
  width: auto;
  margin: auto;
}

</style>
</head>

<body>
  <section>
    <div>
      <img src="images/logo2.png" alt="" class="logo">
        <ul class ="nav">
          <li><a href="home.php">Home</a></li>
          <li><a href="#favorites">Favorites</a></li>
          <li><a href="#account">Account</a></li>
          <li><a href="#settings">Settings</a></li>
        </ul>
      </div>
    </section>
<a href="start.php" class="popbutton" style="padding:15px; position:absolute; right:3%; top:50px">Logout</a>
<h1>Title of Movie</h1>

<div class="center">
   <video width="1280" height="720" controls>
    <source src="movie.mp4" type="video/mp4">
    <source src="movie.ogg" type="video/ogg">
    Your browser does not support the video tag.
  </video>
</div>

</body>
</html>
